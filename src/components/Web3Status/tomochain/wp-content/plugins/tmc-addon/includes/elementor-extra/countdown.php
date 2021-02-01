<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
class Countdown extends Widget_Base {

	public function get_name()
    {
      return 'tmc-countdown';
    }
    public function get_icon()
    {
        return 'far fa-clock';
    }
    public function get_title()
    {
        return esc_html__('TMC Countdown', 'tmc');
    }
    /*
    * Depend Script
    */
    public function get_script_depends() {
        return [
            'jquery-coundown',
            'tmc-addon',
        ];
    }

    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }

	protected function _register_controls()
    {
      	$this->start_controls_section(
           'tmc_title_heading',
           [
            	'label' => esc_html__('Settings', 'tmc'),
           ]
      	);
      	$this->add_control(
        	'date',
        	[
	          	'label'     => __( 'Date', 'tmc' ),
	          	'type'      => Controls_Manager::DATE_TIME,
	          	// 'picker_options' => [
	          	// 	'dateFormat' => 'Y/m/d'
	          	// ]
	          	// 'placeholder'   => __( 'Date format: 2020/10/10', 'tmc' ),
        	]
      	);
      	$this->add_control(
			'hr1',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
        	'day_text',
	        [
	          'label'     	=> __( 'Day', 'tmc' ),
	          'type'      	=> Controls_Manager::TEXT,
	          'default'     => __( 'Days', 'tmc' ),
	          'placeholder' => __( 'Type your text', 'tmc' ),
	        ]
	    );
	    $this->add_control(
        	'hour_text',
	        [
	          'label'     	=> __( 'Hour', 'tmc' ),
	          'type'      	=> Controls_Manager::TEXT,
	          'default'     => __( 'Hour', 'tmc' ),
	          'placeholder' => __( 'Type your text', 'tmc' ),
	        ]
	    );
	    $this->add_control(
        	'min_text',
	        [
	          'label'     	=> __( 'Min', 'tmc' ),
	          'type'      	=> Controls_Manager::TEXT,
	          'default'     => __( 'Min', 'tmc' ),
	          'placeholder' => __( 'Type your text', 'tmc' ),
	        ]
	    );
	    $this->add_control(
        	'sec_text',
	        [
	          'label'     	=> __( 'Sec', 'tmc' ),
	          'type'      	=> Controls_Manager::TEXT,
	          'default'     => __( 'Sec', 'tmc' ),
	          'placeholder' => __( 'Type your text', 'tmc' ),
	        ]
	    );
	    $this->add_control(
			'hr2',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'color',
			[
				'label' => __( 'Color', 'tmc' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #tmc-clock span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
	        'text_align',
	        [
	          	'label' => esc_html__( 'Alignment', 'tmc' ),
	          	'type' => Controls_Manager::CHOOSE,
	          	'options' => [
	            	'left' => [
	              	'title' => esc_html__( 'Left', 'tmc' ),
	              	'icon' => 'fa fa-align-left',
	            ],
	            'center' => [
	              	'title' => esc_html__( 'Center', 'tmc' ),
	              	'icon' => 'fa fa-align-center',
	            ],
	            'right' => [
	              	'title' => esc_html__( 'Right', 'tmc' ),
	              	'icon' => 'fa fa-align-right',
	            ],
	          ],
	          'default' => 'left',
	          'selectors'      => [
	            	'{{WRAPPER}} #tmc-clock' => 'text-align: {{VALUE}};',
	          ],
	        ]
	    );
      	$this->end_controls_section();
      
    }
    protected function render()
    {
      	$settings = $this->get_settings();
      	$date 		= !empty($settings['date']) ? $settings['date'] : '';

      	$day_text 	= !empty($settings['day_text']) ? $settings['day_text'] : __('Days', 'tmc');
      	$hour_text 	= !empty($settings['hour_text']) ? $settings['hour_text'] : __('Hour', 'tmc');
      	$min_text 	= !empty($settings['min_text']) ? $settings['min_text'] : __('Min', 'tmc');
      	$sec_text 	= !empty($settings['sec_text']) ? $settings['sec_text'] : __('Sec', 'tmc');
      	$data_text 	= [
      		'day' 	=> $day_text,
      		'hour' 	=> $hour_text,
      		'min' 	=> $min_text,
      		'sec' 	=> $sec_text,
      	];
      	$data_text = json_encode($data_text);
      	?>
        <div class="tmc-countdown-widget">
			<div id="tmc-clock" data-date="<?php esc_attr_e($date);?>" data-text="<?php echo esc_attr($data_text);?>"></div>
          	
        </div>
    <?php
    }
}