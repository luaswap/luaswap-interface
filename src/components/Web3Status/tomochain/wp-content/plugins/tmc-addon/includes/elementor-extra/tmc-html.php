<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Tmc_Html extends Widget_Base{
    public function get_name()
    {
      return 'tmc-html';
    }
    public function get_icon()
    {
        return 'eicon-code';
    }
    public function get_title()
    {
        return esc_html__('TMC Custom HTML', 'tmc');
    }

    public function get_categories()
    {
        return [ 'tmc-introduce-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_html_option();      
    }
    private function tmc_html_option(){
      $this->start_controls_section(
        'tmc_html',
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
          'label'       => __('Heading', 'tmc' ),
          'default'     => __( 'The Heading', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'desc',
        [
          'label'       => __( 'Description', 'tmc' ),
          'type'        => Controls_Manager::WYSIWYG,
          'default'     => __( 'Default description', 'tmc' ),
          'placeholder' => __( 'Type your description here', 'tmc' ),
        ]
      );
      $this->add_control(
        'html',
        [
          'label'       => __( 'Add HTML', 'tmc' ),
          'type'        => Controls_Manager::CODE,
          'language'    => 'html',
          'rows'        => 10,
        ]
      );
      
      $this->end_controls_section();

    }
    protected function render()
    {
      $settings = $this->get_settings();
      ?>
      <div class="tmc-custom-html-widget">
          <div class="tx-heading tx-accordion">
            <?php if(!empty($settings['step'])):?>
              <span class="tx-step"><?php echo wp_kses_post($settings['step']);?></span>
            <?php endif;?>
            <?php if(!empty($settings['title'])):?>
              <h3 class="tx-title"><?php echo wp_kses_post($settings['title']);?></h3>
              <span class=tx-icon><i class="fas fa-caret-down"></i></span>
            <?php endif;?>
          </div>
          
          <div class="tx-dex-desc tx-accordion-content">
              <?php if(!empty($settings['desc'])):?>
                <div class="tx-sub-desc">
                  <?php echo wp_kses_post($settings['desc']);?>
                </div>
              <?php endif;?>
              <?php if(!empty($settings['html'])):?>
                <?php echo $settings['html'];?>
              <?php endif;?>
          </div>      

      </div>
      <?php
    }
}