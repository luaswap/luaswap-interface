<?php
/**
 * tmc team.
 *
 * @since 1.0.0
 */
namespace TMC_Elementor_Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Repeater;

class Team_Member extends Widget_Base {
	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'tmc-team-member';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return esc_html__( 'TMC Team Member', 'tmc' );
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'fa fa-users';
	}

	/**
	 * Get widget categories.
	 *
	 */
	public function get_categories() {
		return [ 'tmc-element-widgets' ];
	}
    /**
	 * Register Widget controls.
	 */
	protected function _register_controls() {
		// Tab Content
		$this->tmc_team_option();
	}
	/*
	* Config
	*/
	private function tmc_team_option(){
		$this->start_controls_section(
			'tmc_team_section',
			[
				'label' => esc_html__( 'General Options', 'tmc' )
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
	        'image',
	        [
	          'type'      => Controls_Manager::MEDIA,
	          'label'     => esc_html__( 'Image', 'tmc' ),
	          'default'   => [
	            'url'   => Utils::get_placeholder_image_src(),
	          ],
	        ]
	    );
	    $repeater->add_control(
	        'title',
	        [
	          'type'      => Controls_Manager::TEXT,
	          'label'     => esc_html__( 'Name', 'tmc' ),
	        ]
	    );
	    $repeater->add_control(
	        'position',
	        [
	          'type'      => Controls_Manager::TEXT,
	          'label'     => esc_html__( 'Position', 'tmc' ),
	        ]
	    );
	    $repeater->add_control(
	    	'social1',
		    [
				'label' 	=> esc_html__( 'Social 1', 'tmc' ),
				'type' 		=> Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'icon1',
			[
				'label' 	=> esc_html__( 'Icon', 'tmc' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' 	=> 'fab fa-facebook-square',
				],
			]
		);
		$repeater->add_control(
			'link1',
			[
				'label' 		=> esc_html__( 'Link', 'tmc' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'tmc' ),
			]
		);
		$repeater->add_control(
			'social2',
			[
				'label' 	=> esc_html__( 'Social 2', 'tmc' ),
				'type' 		=> Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'icon2',
			[
				'label' 	=> esc_html__( 'Icon', 'tmc' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' 	=> 'fab fa-twitter-square',
				],
			]
		);
		$repeater->add_control(
			'link2',
			[
				'label' 		=> esc_html__( 'Link', 'tmc' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'tmc' ),
			]
		);
		$repeater->add_control(
			'social3',
			[
				'label' 	=> esc_html__( 'Social 3', 'tmc' ),
				'type' 		=> Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'icon3',
			[
				'label' 	=> esc_html__( 'Icon', 'tmc' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' 	=> 'fab fa-linkedin',
				],
			]
		);
		$repeater->add_control(
			'link3',
			[
				'label' 		=> esc_html__( 'Link', 'tmc' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'tmc' ),
			]
		);

		$repeater->add_control(
			'social4',
			[
				'label' 	=> esc_html__( 'Social 4', 'tmc' ),
				'type' 		=> Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'icon4',
			[
				'label' 	=> esc_html__( 'Icon', 'tmc' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' 	=> 'fab fa-github',
				],
			]
		);
		$repeater->add_control(
			'link4',
			[
				'label' 		=> esc_html__( 'Link', 'tmc' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'tmc' ),
			]
		);
		$this->add_control(
			'tmc_team',
			[
				'label'       => esc_html__( 'Team Item', 'tmc' ),
				'type'        => Controls_Manager::REPEATER,
				'fields' 	  => $repeater->get_controls(),
				'default'	  => [
					[
						'title'		=> 'Member 1',
						'position'	=> 'Back-end Developer'
					],
					[
						'title'		=> 'Member 2',
						'position'	=> 'Designer'
					],
					[
						'title'		=> 'Member 3',
						'position'	=> 'Frond-end'
					],				
				],
				'title_field' 	=> '{{title}}',
			]
		);
		$this->end_controls_section();
	}
	/*
	* Render Widget
	*/
	protected function render() {
		// Get settings.
		$settings = $this->get_settings();
		echo '<div class="tmc-team-widget">';
			echo '<div class="tmc-team-wrap">';
				foreach ( $settings['tmc_team'] as $value ) {
					$image = $value['image'];
					?>
					<div class="tmc-team-item">
						<div class="tmc-team-box">
							<div class="member-avatar">
								<img src="<?php echo esc_url($image['url'])?>" alt="<?php echo esc_attr($value['title']);?>">
							</div>
							<div class="team-info">
								<h3 class="team-name"><?php echo esc_html($value['title']);?></h3>
								<span class="team-position"><?php echo esc_html($value['position']);?></span>
								<ul class="social">
									<?php
									if($value['link1']['url']){
										$link_props1 = ' href="' . esc_url($value['link1']['url']) . '" ';
										if ( $value['link1']['is_external'] ) {
											$link_props1 .= ' target="_blank" ';
										}
										if ( $value['link1']['nofollow'] ) {
											$link_props1 .= ' rel="nofollow" ';
										}
									}
									if($value['link2']['url']){

										$link_props2 = ' href="' . esc_url($value['link2']['url']) . '" ';
										if ( $value['link2']['is_external'] ) {
											$link_props2 .= ' target="_blank" ';
										}
										if ( $value['link2']['nofollow'] ) {
											$link_props2 .= ' rel="nofollow" ';
										}
									}
									if($value['link3']['url']){

										$link_props3 = ' href="' . esc_url($value['link3']['url']) . '" ';
										if ( $value['link3']['is_external'] ) {
											$link_props3 .= ' target="_blank" ';
										}
										if ( $value['link3']['nofollow'] ) {
											$link_props3 .= ' rel="nofollow" ';
										}
									}
									if($value['link4']['url']){
										$link_props4 = ' href="' . esc_url($value['link4']['url']) . '" ';
										if ( $value['link4']['is_external'] ) {
											$link_props4 .= ' target="_blank" ';
										}
										if ( $value['link4']['nofollow'] ) {
											$link_props4 .= ' rel="nofollow" ';
										}
									}
									if(!empty($value['link1']['url']))
										echo '<li><a '. $link_props1 .'><i class="'. esc_attr($value['icon1']['value']) .'"></i></a></li>';
									if(!empty($value['link2']['url']))
										echo '<li><a '. $link_props2 .'><i class="'. esc_attr($value['icon2']['value']) .'"></i></a></li>';
									if(!empty($value['link3']['url']))
										echo '<li><a '. $link_props3 .'><i class="'. esc_attr($value['icon3']['value']) .'"></i></a></li>';
									if(!empty($value['link4']['url']))
										echo '<li><a '. $link_props4 .'><i class="'. esc_attr($value['icon4']['value']) .'"></i></a></li>';

									?>
								</ul>
							</div>
						</div>
					</div><!-- .tmc-team-item -->
				<?php }
			echo '</div><!-- . tmc-team-wrap -->';
		echo '</div><!-- .tmc-team-widget -->';
	}
}