<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;

class Layer_Heading extends Widget_Base{
    public function get_name()
    {
        return 'tmc_layer_heading';
    }
    public function get_title()
    {
       return esc_html__('TMC Layer Heading', 'tmc');
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
           'tmc_layer_heading',
           [
            'label' => esc_html__('General Options', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
           ]
      );
      $this->add_control(
        'layer',
        [
          'label'     => __( 'Layer', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'     => __( 'Layer 1', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );
      $this->add_control(
        'title',
        [
          'label'     => __( 'Title', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'     => __( 'Title', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );
      $this->add_control(
        'desc',
        [
          'label'     => __( 'Description', 'tmc' ),
          'type'      => Controls_Manager::TEXTAREA,
          'rows'      => 4,
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );
      $this->end_controls_section();
      $this->start_controls_section(
           'tmc_layer_style',
           [
            'label' => esc_html__('Layer', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
           ]
      );
      $this->add_control(
          'l_color',
          [
            'label'  => esc_html__('Color', 'tmc'),
            'type'   => Controls_Manager::COLOR,
            'selectors' => [
              '{{WRAPPER}} .tmc-layer-name' => 'color: {{VALUE}}',
            ],
          ]
      );
      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
            'name' => 'l_typography',
            'label' => esc_html__( 'Typography', 'tmc' ),
            'selector' => '{{WRAPPER}} .tmc-layer-name',
          ]
      );
      $this->end_controls_section();
      $this->start_controls_section(
           'tmc_title_style',
           [
            'label' => esc_html__('Title', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
           ]
      );
      $this->add_control(
          't_color',
          [
            'label'  => esc_html__('Color', 'tmc'),
            'type'   => Controls_Manager::COLOR,
            'selectors' => [
              '{{WRAPPER}} .tmc-layer-title' => 'color: {{VALUE}}',
            ],
          ]
      );
      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
            'name' => 't_typography',
            'label' => esc_html__( 'Typography', 'tmc' ),
            'selector' => '{{WRAPPER}} .tmc-layer-title',
          ]
      );
      $this->end_controls_section();
      $this->start_controls_section(
           'tmc_desc_style',
           [
            'label' => esc_html__('Description', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
           ]
      );
      $this->add_control(
          'd_color',
          [
            'label'  => esc_html__('Color', 'tmc'),
            'type'   => Controls_Manager::COLOR,
            'selectors' => [
              '{{WRAPPER}} .tmc-layer-desc' => 'color: {{VALUE}}',
            ],
          ]
      );
      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
            'name' => 'd_typography',
            'label' => esc_html__( 'Typography', 'tmc' ),
            'selector' => '{{WRAPPER}} .tmc-layer-desc',
          ]
      );
      $this->end_controls_section();
    }
    protected function render()
    {
      $settings = $this->get_settings();
      $layer = isset($settings['layer']) ? $settings['layer'] : '';
      $title = isset($settings['title']) ? $settings['title'] : '';
      $desc  = isset($settings['desc']) ? $settings['desc'] : '';
      ?>
        <div class="tmc-layer-heading-widget">
          <?php if(!empty($layer)):?>
            <h4 class="tmc-layer-name">
              <?php echo $layer;?>
            </h4>
          <?php endif;?>
          <?php if(!empty($title)):?>
            <h2 class="tmc-layer-title">
              <?php echo $title;?>
            </h2>
          <?php endif;?>
          <?php if(!empty($desc)):?>
            <p class="tmc-layer-desc">
              <?php echo wp_kses_post($desc);?>
            </p>
          <?php endif;?>
        </div>
    <?php
    }

}