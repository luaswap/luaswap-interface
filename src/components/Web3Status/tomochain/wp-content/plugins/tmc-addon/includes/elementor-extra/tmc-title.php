<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;

class Tmc_Title extends Widget_Base{
    public function get_name()
    {
        return 'tmc_title_heading';
    }
    public function get_title()
    {
       return esc_html__('TMC Title', 'tmc');
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
            'label' => esc_html__('Title', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
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
        'type',
        [
          'type'    => Controls_Manager::SELECT,
          'label'   => '<i class="fa fa-sort"></i> ' . esc_html__( 'Type', 'tmc' ),
          'default' => 'type-1',
          'options' => [
            'type-1'         => esc_html__( 'Type 1', 'tmc' ),
            'type-2'         => esc_html__( 'Type 2', 'tmc' ),
          ],
        ]
      );
      $this->end_controls_section();
      $this->start_controls_section(
           'tmc_title_style',
           [
            'label' => esc_html__('Style', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
           ]
      );
      $this->add_control(
          'l_color',
          [
            'label'  => esc_html__('Color', 'tmc'),
            'type'   => Controls_Manager::COLOR,
            'selectors' => [
              '{{WRAPPER}} .tmc-title-heading' => 'color: {{VALUE}}',
            ],
          ]
      );
      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
            'name' => 'l_typography',
            'label' => esc_html__( 'Typography', 'tmc' ),
            'selector' => '{{WRAPPER}} .tmc-title-heading',
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
            '{{WRAPPER}} .tmc-title-heading-widget' => 'text-align: {{VALUE}};',
          ],
        ]
      );
      $this->end_controls_section();
    }
    protected function render()
    {
      $settings = $this->get_settings();
      $title = isset($settings['title']) ? $settings['title'] : '';
      $type = isset($settings['type']) ? $settings['type'] : 'type-1';
      $translate = -200;
      if($type == 'type-2'){
        $translate = 200;
      }
      ?>
        <div class="tmc-title-heading-widget">
          <?php if(!empty($title)):?>
            <h2 class="tmc-title-heading scrollme">
              <?php echo $title;?>
              <span
                class="animateme <?php echo esc_attr($type);?>"
                data-when="enter"
                data-from="1"
                data-to="0"
                data-opacity="0"
                data-translatex="<?php echo $translate;?>"
                data-translatey="0"
                data-rotatez="0"
              ></span>
            </h2>
          <?php endif;?>
        </div>
    <?php
    }

}