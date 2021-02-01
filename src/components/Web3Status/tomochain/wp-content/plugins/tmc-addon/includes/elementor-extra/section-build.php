<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Section_Build extends Widget_Base{
    public function get_name()
    {
        return 'tmc_build';
    }
    public function get_title()
    {
       return esc_html__('TMC Build on Tomochain', 'tmc');
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
           'tmc_build_title',
           [
            'label' => esc_html__('General Options', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
           ]
      );
      $this->add_control(
        'b_title',
        [
          'label'     => __( 'Title', 'tmc' ),
          'type'      => Controls_Manager::TEXTAREA,
          'rows'      => 4,
          'default'     => __( 'Build on Tomochain', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );
      $this->add_control(
        'b_subtitle',
        [
          'label'     => __( 'Sub title', 'tmc' ),
          'type'      => Controls_Manager::TEXTAREA,
          'rows'      => 10,
          'placeholder'   => __( 'Type your sub title', 'tmc' ),
        ]
      );
      $this->end_controls_section();
    }
    protected function render()
    {
      $settings = $this->get_settings();
      ?>
        <div class="tmc-build-widget">
          <div class="tmc-build-left">
          </div>
          <div class="tmc-build-right">
            <?php if(!empty($settings['b_title'])):?>
              <h2 class="tmc-build-title scrollme">
                <?php echo $settings['b_title']?>
                <span
                  class="animateme"
                  data-when="enter"
                  data-from="1"
                  data-to="0"
                  data-opacity="0"
                  data-translatex="-400"
                  data-translatey="0"
                  data-rotatez="0"
                ></span>
              </h2>
            <?php endif;?>
            <?php if($settings['b_subtitle']):?>
              <p class="tmc-build-subtitle">
                <?php echo wp_kses_post($settings['b_subtitle']);?>
              </p>
            <?php endif;?>
          </div>
        </div>
    <?php
    }

}