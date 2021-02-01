<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;

class Tmc_Icon extends Widget_Base{
    public function get_name()
    {
      return 'tmc-icon';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Icon', 'tmc');
    }

    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_icon_option();      
    }
    private function tmc_icon_option(){
      $this->start_controls_section(
        'tmc_icon',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );
  
      $this->add_control(
        'icon',
        [
          'label' => __( 'Icon', 'tmc' ),
          'type' => Controls_Manager::ICONS,
          'default' => [
            'value' => 'fas fa-star',
            'library' => 'solid',
          ],
        ]
      );
      $this->add_control(
        'title',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Title', 'tmc' ),
        ]
      );

      $this->end_controls_section();

    }
    protected function render()
    {
      $settings = $this->get_settings();
      $title = $settings['title'];
      $icon  = $settings['icon']
      ?>
        <div class="tmc-icon-widget">
          <div class="tmc-icon-content">
            <?php if($title):?>
              <h3 class="icon-title"><?php echo esc_html($title);?></h3>
            <?php endif;?>
            <?php if($icon):?>
              <div class="icon-view">
                <?php Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ], 'i' );?>
              </div>
            <?php endif;?>
          </div>
        </div>
        <?php
    }
}