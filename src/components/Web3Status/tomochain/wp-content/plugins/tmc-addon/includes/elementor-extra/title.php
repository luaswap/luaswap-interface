<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
class Title extends Widget_Base{
    public function get_name()
    {
        return 'tmc_title_heading';
    }
    public function get_title()
    {
       return esc_html__('TMC Title Heading', 'tmc');
    }
    public function get_icon()
    {
      return 'fa fa-text-width';
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
            'label' => esc_html__('General Options', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
           ]
      );
      $this->add_control(
        'h_title',
        [
          'label'     => __( 'Title', 'tmc' ),
          'type'      => Controls_Manager::TEXTAREA,
          'rows'      => 4,
          'default'     => __( 'TMC Title', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );
      $this->end_controls_section();
      $this->start_controls_section(
           'tmc_title_style',
           [
            'label' => esc_html__('Title Style', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
           ]
      );
      $this->add_control(
        'tmc_title_type',
        [
          'type'    => Controls_Manager::SELECT,
          'label'   => '<i class="fa fa-code"></i> ' . esc_html__( 'Sub title tag', 'tmc' ),
          'default' => 'type-1',
          'options' => [
            'type-1'=> __('Type 1','noo'),
            'type-2'=> __('Type 2','noo'),
          ],
        ]
      );
      $this->add_control(
          'color_title',
          [
            'label'  => esc_html__('Title Color', 'tmc'),
            'type'   => Controls_Manager::COLOR,
            'selectors' => [
              '{{WRAPPER}} .tmc-title-heading' => 'color: {{VALUE}}',
            ],
          ]
      );
      $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
              'name' => 'content_typography',
              'label' => esc_html__( 'Typography for Title', 'tmc' ),
              'selector' => '{{WRAPPER}} .tmc-title-heading',
            ]
        );
      $this->add_control(
           'align',
           [
               'label'  => esc_html__('Align', 'tmc'),
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
                'default' => 'center',
                'toggle' => true,
                'selectors'      => [
                  '{{WRAPPER}} .tmc-title-heading' => 'text-align: {{VALUE}};',
                ],
           ]

      );
      $this->end_controls_section();
    }
    protected function render()
    {
      $settings = $this->get_settings();
      ?>
        <div class="tmc-title-heading-widget">
          <?php if(!empty($settings['h_title'])):?>
            <h2 class="tmc-title-heading <?php echo esc_html($settings['tmc_title_type']);?>">
              <?php echo $settings['h_title']?>
            </h2>
          <?php endif;?>
        </div>
    <?php
    }

}