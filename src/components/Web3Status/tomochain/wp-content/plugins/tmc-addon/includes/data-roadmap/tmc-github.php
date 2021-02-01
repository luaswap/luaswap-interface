<?php
class Tmc_Get_Github_Data{

    public $base_url = 'https://api.github.com/';
	public $repos;
    private $access_token;
    
    function __construct(){
		$this->access_token = !empty(tmc_get_roadmap_option('tmc_access_token')) ? tmc_get_roadmap_option('tmc_access_token') : '';

		add_action('wp_ajax_roadmap_ajax',array($this,'roadmap_ajax'));
		add_action('wp_ajax_nopriv_roadmap_ajax',array($this,'roadmap_ajax'));
		Tmc_Get_Github_Data::schedule_check();
		add_action('update_milestone',array($this,'update_milestone'));
		add_action('commit_export_file',array($this,'commit_export_file'));
	}
	/* Milestone */
	public static function schedule_check() {		

        if ( ! wp_next_scheduled( 'update_milestone' ) ) {
            wp_schedule_event(time(), 'twicedaily', 'update_milestone' );
        }
        if ( ! wp_next_scheduled( 'commit_export_file' ) ) {
            wp_schedule_event(time(), 'twicedaily', 'commit_export_file' );
        }

    }
    public function update_milestone(){
        $tmc = $this->roadmap_info();
		$base_url = $this->base_url;
		if(!empty($tmc) && is_array($tmc)){
			foreach ($tmc as $value) {
				$url = $base_url .'repos/tomochain/'. $value['repo'].'/milestones/'. $value['milestone'];
				$post_id = $value['id'];
				$milestone = $this->get_data_info($url);
				if($milestone !== false){
					if( (isset($milestone->closed_issues) && 0 != $milestone->closed_issues) || (isset($milestone->closed_issues) && 0 != $milestone->open_issues)){

						$in_progress = round($milestone->closed_issues/($milestone->closed_issues + $milestone->open_issues) * 100);
						update_post_meta( $post_id, 'tmc_percent', $in_progress );
						if($in_progress < 100){
							update_post_meta( $post_id, 'tmc_status', 'in-progress' );
						}else{
							update_post_meta( $post_id, 'tmc_status', 'completed' );
						}
					}
					if(isset($milestone->html_url) && !empty($milestone->html_url)){
						update_post_meta( $post_id, 'tmc_github', esc_url($milestone->html_url) );
					}
					if(isset($milestone->due_on) && !empty($milestone->due_on)){
						$due_on = str_replace("T"," ",$milestone->due_on);
						$due_on = strtotime($due_on);
						update_post_meta( $post_id, 'tmc_due_date', $due_on );
					}
					if(isset($milestone->closed_at) && !empty($milestone->closed_at)){
						$closed_at = str_replace("T"," ",$milestone->closed_at);
						$closed_at = strtotime($closed_at);
						update_post_meta( $post_id, 'tmc_release', $closed_at );
					}else{
						$closed_at = str_replace("T"," ",$milestone->updated_at);
						$closed_at = strtotime($closed_at);
						update_post_meta( $post_id, 'tmc_release', $closed_at );
					}
				}
			}
		}
		
    }
    /* Update Roadmap via API */
	public function roadmap_info(){
		$args = array(
			'post_type'      => 'tmc_roadmap',
	        'post_status'    => 'publish',
	        'posts_per_page' => -1,
		);
        $r = new WP_Query($args);
		$item = array();
		$tmc_info = array();
		if($r->have_posts()){
			while( $r->have_posts() ){
				$r->the_post();
				$item['id'] = get_the_ID();
				$item['milestone'] = get_post_meta(get_the_ID(),'tmc_milestone',true);
				$item['repo'] = get_post_meta(get_the_ID(),'tmc_repo',true);
				array_push($tmc_info, $item);
			}
			wp_reset_postdata();
			return $tmc_info;
		}
		return;
	}

	public function commit_export_file(){
		
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		WP_Filesystem();
		global $wp_filesystem;
		$commit_url = $this->base_url.'repos/tomochain/';
		$commit_number = !empty(tmc_get_roadmap_option('tmc_commit_number')) ? tmc_get_roadmap_option('tmc_commit_number') : 10;

		$repos = $this->get_repository();

		if(!empty($repos) && is_array($repos)){
			$args = array();
			$numberlimit = $data = $merges = array();
			$i = 0;
			foreach ($repos as $value) {
				$url = $commit_url . $value.'/commits';
				
				$data = $this->get_data_info($url);

				$numberlimit[$i] = array_slice($data, 0 ,$commit_number);
				$merges  = array_merge($merges,$numberlimit[$i]);
				
				$i++;
			}
			foreach ($merges as $value) {
				$date = strtotime(str_replace('T', ' ', $value->commit->committer->date));

				$args[$date][]  = array(
					'author' => $value->author->login,
					'date'   => $value->commit->committer->date,
					'message'=> $value->commit->message,
					'url'    => $value->html_url
				);
			}
			if(is_array($args) && count($args) > 0){
				krsort($args);
				$args = json_encode($args);
			}
			$c_dir = $this->create_upload_dir( $wp_filesystem );

			if(!empty($args)){
	        	$wp_filesystem->put_contents( $c_dir ."/commit.txt", $args);
	        }
	    	return $c_dir . '/commit.txt';
		}
	}

    public function get_repository(){
        $repos = !empty(tmc_get_roadmap_option('tmc_repos')) ? tmc_get_roadmap_option('tmc_repos') : '';
        
		if(!empty($repos)){
			$repos = explode(',', $repos);
        }
        // else{
        //     $params = array('type' => 'all','per_page' => 100);
        //     $url = $this->base_url . '?'.http_build_query($params);
        //     $repos_info = $this->get_data_info($url);
        //     echo '<pre>';
        //     var_dump($repos_info);
        //     echo '</pre>';
		// 	if(!empty($repos_info)){
		// 		$repos = array();
		// 		foreach ($repos_info as $value) {
		// 			$repos[] = $value->name;
		// 		}
		// 	}
		// }
		return $repos;
	}

	/* =============================================
	Get Commit Content
	===============================================*/
	public function commit_info(){
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		WP_Filesystem();
		global $wp_filesystem;
		$c_dir = $this->create_upload_dir( $wp_filesystem );
		$file = $c_dir. '/commit.txt';
		if ( file_exists( $file ) ) {
			return @file_get_contents( $file );
		}else{
			return false;
		}
	}

	/* =================================================
	GET DATA VIA CURL
	====================================================*/
	function get_data_info($url){
        $headers = array(
            'User-Agent: Mozilla/5.0',
            'Content-Type: application/json',
            'Authorization: token '.$this->access_token
        );
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result = curl_exec($ch);        
        curl_close($ch);        
        if($result === false){
            return false;
        }
        return json_decode($result);
    }


    /*================================================
	GET UPLOAD URL, DIRECTOR
	================================================== */
	function upload_dir_name() {
		return apply_filters( 'upload_dir_name', 'tmc-addon' );
	}

	function upload_dir() {
		$upload_dir = wp_upload_dir();

		return $upload_dir['basedir'] . '/' . $this->upload_dir_name();
	}

	function upload_url() {
		$upload_dir = wp_upload_dir();

		return $upload_dir['baseurl'] . '/' . $this->upload_dir_name();
	}

	function create_upload_dir( $wp_filesystem = null ) {
		if( empty( $wp_filesystem ) ) {
			return false;
		}

		$upload_dir = wp_upload_dir();
		global $wp_filesystem;

		$upload_dir = $wp_filesystem->find_folder( $upload_dir['basedir'] ) . $this->upload_dir_name();

		if ( ! $wp_filesystem->is_dir( $upload_dir ) ) {
			if ( wp_mkdir_p( $upload_dir ) ) {
				return $upload_dir;
			}

			return false;
		}

		return $upload_dir;
	}

	function roadmap_ajax(){
		$id  = isset($_POST['params']['id']) ? $_POST['params']['id'] : '';

    	if( !empty( $id ) ){  
		?>
			<div class="row">
				<div class="col-lg-6">
					<div class="tmc-inner tmc-completed-wrap">
						<h2 class="tmc-inner-title"><?php echo esc_html__('Completed','tmc')?></h2>
						<div class="tmc-inner-box">
							<?php $c = $this->get_data_query($id, 'completed');
								if( $c->have_posts() ):
									while( $c->have_posts() ): $c->the_post();

									$logo = get_post_meta(get_the_ID(),'tmc_image',true);
									$c_url = get_post_meta(get_the_ID(),'tmc_url',true);
									$github_url = get_post_meta(get_the_ID(),'tmc_github',true);
									$doc_url = get_post_meta(get_the_ID(),'tmc_doc',true);
									$released_date = get_post_meta(get_the_ID(),'tmc_release',true);

									if( is_numeric($released_date) && strlen($released_date) !== 8 ) {
										$released_date = date_i18n('M d, Y', $released_date);
									}
									$open_new_tab = get_post_meta(get_the_ID(),'tmc_new_tab',true) ? '__blank' : '';?>
									<div class="tmc-box-item">
										<div class="item-header">
											<?php
											if($logo){?>
												<div class="col-logo">
													<img src="<?php echo $logo;?>" alt="<?php the_title();?>">

												</div>
											<?php }?>
											<div class="col-infor">
												<div class="box-title">
													<a class="txt-name" href="<?php echo esc_url($c_url);?>" target="<?php echo esc_attr($open_new_tab);?>">
														<?php the_title();?>
													</a>
												</div>
												<div class="update-on">
													<?php if($released_date){?>
														<span><?php echo esc_html__('Released date:','tmc')?> <?php echo esc_html($released_date);?></span>
													<?php }?>
													<br>
													<?php if($github_url){?>
														<a href="<?php echo esc_url($github_url);?>" target="<?php echo esc_attr($open_new_tab);?>">
														<i class="fab fa-github"></i>
														</a>
													<?php }?>
													<?php if($doc_url){?>
														<a href="<?php echo esc_url($doc_url);?>" target="<?php echo esc_attr($open_new_tab);?>">
														<i class="fa fa-file"></i>
														</a>
													<?php }?>
												</div>
											</div>
										</div>
										<div class="item-body">
											<?php the_content();?>
										</div>
									</div><!-- box-item -->
								<?php endwhile;
							else:
								echo '<p class="not-found">' . esc_html__('Not Found','tmc') . '</p>';
							endif;
							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="tmc-inner tmc-in-progress-wrap">
						<h2 class="tmc-inner-title"><?php echo esc_html__('In Progress','tmc')?></h2>
						<div class="tmc-inner-box">
							<?php $p = $this->get_data_query($id, 'in-progress');
								if( $p->have_posts() ):
									while( $p->have_posts() ): $p->the_post();

									$logo = get_post_meta(get_the_ID(),'tmc_image',true);
									$p_url = get_post_meta(get_the_ID(),'tmc_url',true);
									$github_url = get_post_meta(get_the_ID(),'tmc_github',true);
									$doc_url = get_post_meta(get_the_ID(),'tmc_doc',true);
									$due_date = get_post_meta(get_the_ID(),'tmc_due_date',true);

									if( is_numeric($due_date) && strlen($due_date) !== 8 ) {
										$due_date = date_i18n('M d, Y', $due_date);
									}
									$per_cent = get_post_meta(get_the_ID(),'tmc_percent',true);
									$open_new_tab = get_post_meta(get_the_ID(),'tmc_new_tab',true) ? '__blank' : '';?>
									<div class="tmc-box-item">
										<div class="item-header">
										<?php
											if($logo){?>
											<div class="col-logo">
												<img src="<?php echo $logo;?>" alt="<?php the_title();?>">

											</div>
										<?php }?>
										<div class="col-infor">
											<div class="box-title">
											<a class="txt-name" href="<?php echo esc_url($p_url);?>" target="<?php echo esc_attr($open_new_tab);?>">
												<?php the_title();?>
											</a>
											</div>
											<div class="update-on">
											<div class="box-progress">
												<div class="inner-progress">
												<div class="progress-value" style="width:<?php echo esc_attr($per_cent);?>%"></div>
												</div>
												<span><?php echo esc_html($per_cent);?>%</span>
											</div>
											<?php if($due_date){?>
												<span><?php echo esc_html__('Due date:','tmc')?> <?php echo esc_html($due_date);?></span>
											<?php }?>
											<br>
											<?php if($github_url){?>
												<a href="<?php echo esc_url($github_url);?>" target="<?php echo esc_attr($open_new_tab);?>">
												<i class="fab fa-github"></i>
												</a>
											<?php }?>
											<?php if($doc_url){?>
												<a href="<?php echo esc_url($doc_url);?>" target="<?php echo esc_attr($open_new_tab);?>">
												<i class="fa fa-file"></i>
												</a>
											<?php }?>
											</div>
										</div>
									</div>
									<div class="item-body">
									<?php the_content();?>
									</div>
								</div><!-- box-item -->  
							<?php endwhile;
						else:
							echo '<p class="not-found">' . esc_html__('Not Found','tmc') . '</p>';
						endif;
						wp_reset_postdata();
						?>
						</div>
					</div>
				</div>
			</div>
		<?php wp_die();
		}?>
	<?php }

	function get_data_query($id, $type){
		$args = array(
			'post_type'      => 'tmc_roadmap',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'meta_query'     => array(
				array(
					'key'     => 'tmc_status',
					'value'   => $type
				),
			),
		);
		if('all' != $id){
			$args[ 'tax_query'] = array(
				array(
					'taxonomy' => 'roadmap_cat',
					'field'    => 'term_id',
					'terms'    => $id,
				),
			);
		}
		$results = new \WP_Query($args);

		return $results;
	}
}
new Tmc_Get_Github_Data();