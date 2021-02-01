<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;

class Roadmap extends Widget_Base{
    public function get_name()
    {
      return 'tmc-roadmap';
    }
    public function get_icon()
    {
        return 'fa fa-map-alt';
    }
    public function get_title()
    {
        return esc_html__('TMC Roadmap', 'tmc');
    }
    /*
    * Depend Style
    */
    // public function get_style_depends() {
    //       return [];
    //   }
    /*
    * Depend Script
    */
    public function get_script_depends() {
        return [
            'tmc-addon'
        ];
    }
    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }

    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_roadmap_option();      
    }
    private function tmc_roadmap_option(){
      $this->start_controls_section(
        'tmc_roadmap',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );
      $this->add_control(
        'cat',
        [
          'label'     => __( 'Road map filter', 'tmc' ),
          'type'      => Controls_Manager::SELECT2,
          'multiple' => true,
          'options'   => $this->get_roadmap_categories()
        ]
      );
      $this->add_control(
        'per_page',
        [
          'label'     => __( 'Post per page', 'tmc' ),
          'type'      => Controls_Manager::NUMBER,
          'default' => 10,
        ]
      );

      $this->add_control(
        'desc_for_all',
        [
          'label'     => __( 'Description for All tab', 'tmc' ),
          'type'      => Controls_Manager::TEXTAREA,
          'rows'      => 5,
          'placeholder' => __('Type your description here','tmc')
        ]
      );
      $this->add_control(
        'see_all',
        [
          'label' => __( 'See all button', 'tmc' ),
          'type' => Controls_Manager::SWITCHER,
          'label_on' => __( 'Show', 'tmc' ),
          'label_off' => __( 'Hide', 'tmc' ),
          'return_value' => 'yes',
          'default' => 'yes',
        ]
      );
      $this->add_control(
        'see_all_url',
        [
          'type'        => Controls_Manager::URL,
          'label'       => esc_html__( 'URL', 'tmc' ),
          'placeholder' => __( 'https://your-link.com', 'tmc' ),
          'show_external' => true,
          'default'       => [
            'is_external' => true,
            'nofollow'    => true,
          ],
          'condition'     => [
            'see_all' => 'yes'
          ]
        ]
      );
      $this->add_control(
        'discuss',
        [
          'label' => __( 'Discuss with out Team:', 'tmc' ),
          'type' => Controls_Manager::HEADING,
          'separator' => 'before',
        ]
      );

      $repeater = new Repeater();

		  $repeater->add_control(
        'title',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Title', 'tmc' ),
        ]
	    );
	    $repeater->add_control(
	        'url',
	        [
	          'type'        => Controls_Manager::URL,
            'label'       => esc_html__( 'URL', 'tmc' ),
            'placeholder' => __( 'https://your-link.com', 'tmc' ),
            'show_external' => true,
            'default'       => [
              'is_external' => true,
              'nofollow'    => true,
            ],
	        ]
      );
      $this->add_control(
        'items',
        [
          'label'       => esc_html__( 'Item', 'tmc' ),
          'type'        => Controls_Manager::REPEATER,
          'fields' 	  => $repeater->get_controls(),
          'default'	  => [
            [
              'title'		=> 'GitHub',
            ],
            [
              'title'		=> 'Telegram',
            ],			
          ],
          'title_field' 	=> '{{title}}',
        ]
      );

      $this->add_control(
        'resource',
        [
          'label' => __( 'Resource:', 'tmc' ),
          'type' => Controls_Manager::HEADING,
          'separator' => 'before',
        ]
      );

      $repeater = new Repeater();

		  $repeater->add_control(
        's_name',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Source name', 'tmc' ),
        ]
	    );
	    $repeater->add_control(
	        's_url',
	        [
	          'type'        => Controls_Manager::URL,
            'label'       => esc_html__( 'Source url', 'tmc' ),
            'placeholder' => __( 'https://your-link.com', 'tmc' ),
            'show_external' => true,
            'default'       => [
              'is_external' => true,
              'nofollow'    => true,
            ],
	        ]
      );
      $this->add_control(
        's_items',
        [
          'label'       => esc_html__( 'Source item', 'tmc' ),
          'type'        => Controls_Manager::REPEATER,
          'fields' 	  => $repeater->get_controls(),
          'default'	  => [
            [
              's_name'		=> 'Tomochain Document',
            ],
            [
              's_name'		=> 'Tomochain API',
            ],			
          ],
          'title_field' 	=> '{{s_name}}',
        ]
      );

      $this->end_controls_section();
      
    }
    /**
     * Get categories.
     */
    private function get_roadmap_categories() {
      $options = array();

      // Get categories for post type.
      $terms = get_terms(
        array(
          'taxonomy'   => 'roadmap_cat',
          'hide_empty' => true,
        )
      );
      if ( ! empty( $terms ) ) {
        foreach ( $terms as $term ) {
          if ( isset( $term ) ) {
            if ( isset( $term->term_id ) && isset( $term->name ) ) {
              $options[ $term->term_id ] = $term->name;
            }
          }
        }
      }

      return $options;
    }
    private function get_data_query($type){
      $settings = $this->get_settings();
      $per_page = !empty($settings['per_page']) ? $settings['per_page'] : 8;
      $args = [
        'post_type'     => 'tmc_roadmap',
        'post_status'   => 'publish',
        'post_per_page' => $per_page,
        'meta_query'    => array(
          array(
            'key'     => 'tmc_status',
            'value'   => $type
          )
        )
        // 'orderby'       => 'post_date',
        // 'order'         => 'DESC'
      ];

      $result = new \WP_Query($args);

      return $result;
    }
    protected function render(){
        $settings = $this->get_settings();
        $cats = $settings['cat'];
        $desc = $settings['desc_for_all'];
        $see_more = $settings['see_all'];
        ?>

        <div class="tmc-roadmap-widget">
          <div class="tmc-roadmap-wrap">
            <div class="tmc-roadmap-head">
              <ul class="tmc-roadmap-filter">
                <li class="selected">
                  <a href="#" data-filter="all" data-desc="<?php esc_attr_e($desc);?>"><?php echo esc_html__('All','tmc')?>                    
                  </a>
                </li>
                <?php
                if(!empty($cats)):
                  if($cats){
                    foreach ($cats as $cat) {
                      $rm = get_term_by('id',$cat,'roadmap_cat');
                    ?>
                      <li>
                        <a href="#" data-filter="<?php echo esc_attr($rm->term_id)?>" data-desc="<?php echo esc_attr(term_description($rm->term_id));?>"><?php echo esc_html($rm->name);?>
                        </a>
                      </li>
                  <?php
                    }
                  }
                endif;
                ?>
              </ul>
              <div class="tmc-term-desc"></div>
            </div>
            <div class="tmc-roadmap-content">
              <div class="row">
                <div class="tmc-roadmap-left col-lg-9">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="tmc-inner tmc-completed-wrap">
                      <h2 class="tmc-inner-title"><?php echo esc_html__('Completed','tmc')?></h2>
                        <div class="tmc-inner-box">
                          <?php $c = $this->get_data_query('completed');
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
                          endif;
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="tmc-inner tmc-in-progress-wrap">
                        <div class="main-inner">
                          <h2 class="tmc-inner-title"><?php echo esc_html__('In Progress','tmc')?></h2>
                          <div class="tmc-inner-box">
                            <?php $p = $this->get_data_query('in-progress');
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
                            endif;
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> <!-- /tmc-roadmap-left-->
                <div class="tmc-roadmap-right col-lg-3">
                  <div class="box-activities">
                    <div class="box-title">
                      <h3><?php echo esc_html__('Latest commits','tmc');?></h3>
                      <?php if($see_more){
                        $see_all_url = $settings['see_all_url'];
                        $url_info = '';
                        if($see_all_url['url']){
                          $url_info = ' href="' . esc_url($see_all_url['url']) . '" ';
                          if ( $see_all_url['is_external'] ) {
                            $url_info .= ' target="_blank" ';
                          }
                          if ( $see_all_url['nofollow'] ) {
                            $url_info .= ' rel="nofollow" ';
                          }?>                          
                        <?php }?>   
                        <a <?php echo $url_info;?>>
                            <?php echo esc_html__('See all','tmc');?>
                        </a>                     
                      <?php }?>
                    </div>
                    <div class="box_latest_commit">
                      <div class="list-recent">
                        <ul>
                        <?php 
                        $cm = new \Tmc_Get_Github_Data;
                        $commits = $cm->commit_info();
                        if(!empty($commits)){
                            $commits = json_decode($commits);
                        }
                        if( !empty($commits)){
                          foreach ($commits as $value) {
                              foreach ($value as $cl) {?>
                                <li>
                                  <?php if(isset($cl->url)){?>
                                  <a target="_blank" href="<?php echo esc_url($cl->url);?>"><?php if(isset($cl->message)){
                                          echo esc_html($cl->message)?>
                                      <?php }?>
                                  </a>
                                  <?php }?>
                                  <?php
                                  if(isset($cl->date)){
                                      $date = date_i18n('F j, Y',strtotime($cl->date)); ?>
                                      <p class="days-ago">
                                          <?php if(isset($cl->author)){?>
                                          <span><?php echo esc_html($cl->author);?></span> - <span><?php echo esc_html($date);?></span>
                                          <?php }?>
                                      </p>
                                  <?php }?>
                                </li>
                              <?php }?>
                          <?php }?>
                        <?php }?>
                          </ul>
                      </div><!-- /list-recent -->
                    </div><!-- /box_latest_commit -->
                  </div><!-- /box-activities -->
                  <div class="box-other">
                    <?php
                      $discuss = $settings['items'];
                      $resource = $settings['s_items'];
                    ?>
                    <p class="txt">
                      <?php echo esc_html__('Discuss with our Team:','tmc');?>
                      <?php if(!empty($discuss) && is_array($discuss)):
                        foreach ($discuss as $value) {
                          if($value['url']['url']){
                            $link_props1 = ' href="' . esc_url($value['url']['url']) . '" ';
                            if ( $value['url']['is_external'] ) {
                              $link_props1 .= ' target="_blank" ';
                            }
                            if ( $value['url']['nofollow'] ) {
                              $link_props1 .= ' rel="nofollow" ';
                            }?>
                            <a <?php echo $link_props1;?>>
                              <?php echo esc_html($value['title']);?>
                            </a>

                          <?php }?>                          
                        <?php }
                      endif;?>
                    </p>
                    <?php if(!empty($resource) && is_array($resource)):?>
                      <p class="txt">
                        <?php echo esc_html__('Resource:','tmc');?>
                        <?php if(is_array($resource)):
                          foreach ($resource as $value) {
                            if($value['s_url']['url']){
                              $link_props2 = ' href="' . esc_url($value['s_url']['url']) . '" ';
                              if ( $value['s_url']['is_external'] ) {
                                $link_props2 .= ' target="_blank" ';
                              }
                              if ( $value['s_url']['nofollow'] ) {
                                $link_props2 .= ' rel="nofollow" ';
                              }?>
                              <a <?php echo $link_props2;?>>
                                <?php echo esc_html($value['s_name']);?>
                              </a>
                            <?php }?>
                          <?php }
                        endif;?>
                      </p>
                      <?php endif;?>
                  </div><!-- /box-other -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
    }
}