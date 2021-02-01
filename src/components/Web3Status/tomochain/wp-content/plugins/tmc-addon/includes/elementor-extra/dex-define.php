<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Dex_Define extends Widget_Base{
    public function get_name()
    {
      return 'tmc-dex-define';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('What is anything', 'tmc');
    }

    public function get_categories()
    {
        return [ 'tmc-introduce-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_tomox_option();      
    }
    private function tmc_tomox_option(){
      $this->start_controls_section(
        'tmc_dex_define',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );
      $this->add_control(
        'step',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Step', 'tmc' ),
          'default'     => __( '1', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'title',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Title', 'tmc' ),
          'default'     => __( 'What is TomoX?', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'desc',
        [
          'type'        => Controls_Manager::TEXTAREA,
          'label'       => __('Description', 'tmc' ),
          'rows'        => 10,
          'default'     => __( 'Default description', 'tmc' ),
          'placeholder' => __( 'Type your description here', 'tmc' ),
        ]
      );
      // Columns.
      
      $this->end_controls_section();

    }
    protected function render()
    {
      $settings = $this->get_settings();
      ?>
      <div class="tmc-tomox-widget">
          <div class="tx-heading tx-accordion">
            <?php if(!empty($settings['step'])):?>
              <span class="tx-step"><?php echo wp_kses_post($settings['step']);?></span>
            <?php endif;?>
            <?php if(!empty($settings['title'])):?>
              <h3 class="tx-title"><?php echo wp_kses_post($settings['title']);?></h3>
              <span class=tx-icon><i class="fas fa-caret-down"></i></span>
            <?php endif;?>
          </div>
          <?php if(!empty($settings['desc'])):?>
            <div class="tx-dex-desc tx-accordion-content">
                <?php echo wp_kses_post($settings['desc']);?>
            </div>
          <?php endif;?>
      </div>
      <?php
    }
}