<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Section_Features extends Widget_Base{
    public function get_name()
    {
        return 'tmc_features';
    }
    public function get_title()
    {
       return esc_html__('TMC Features', 'tmc');
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
           'tmc_feature_title',
           [
            'label' => esc_html__('General Options', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
           ]
      );
      $this->add_control(
        'f_title',
        [
          'label'     => __( 'Title', 'tmc' ),
          'type'      => Controls_Manager::TEXTAREA,
          'rows'      => 4,
          'default'     => __( 'Features', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );
      $this->add_control(
        'f_subtitle',
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
        <div class="tmc-features-widget">
          <div class="tmc-feature-left">
            <?php if(!empty($settings['f_title'])):?>
              <h2 class="tmc-feature-title scrollme">
                <?php echo $settings['f_title']?>
                <span
                  class="animateme"
                  data-when="enter"
                  data-from="1"
                  data-to="0"
                  data-opacity="0"
                  data-translatex="-200"
                  data-translatey="0"
                  data-rotatez="0"
                ></span>
              </h2>
            <?php endif;?>
            <?php if($settings['f_subtitle']):?>
              <p class="tmc-feature-subtitle">
                <?php echo $settings['f_subtitle'];?>
              </p>
            <?php endif;?>
          </div>
          <div class="tmc-feature-right">
            <!-- <div class="scrollme">
              <div
                class="animateme"
                data-when="enter"
                data-from="1"
                data-to="0"
                data-opacity="0"
                data-translatex="-400">
              </div>
            </div> -->
          </div>
        </div>
    <?php
    }

}