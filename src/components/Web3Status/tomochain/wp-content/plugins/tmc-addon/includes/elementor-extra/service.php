<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;

class Service extends Widget_Base{
    public function get_name()
    {
      return 'tmc_service';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Service', 'tmc');
    }
    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_text_info_option();      
    }
    private function tmc_text_info_option(){
      $this->start_controls_section(
        'tmc_text_info',
        [
            'label' => esc_html__('TMC Service', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
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
      $this->add_responsive_control(
        'icon_size',
        [
          'label' => __( 'Size', 'tmc' ),
          'type' => Controls_Manager::SLIDER,
          'range' => [
            'px' => [
              'min' => 6,
              'max' => 300,
            ],
          ],
          'selectors' => [
            '{{WRAPPER}} .tmc-text-icon' => 'font-size: {{SIZE}}{{UNIT}};',
          ],
        ]
      );

      $this ->add_control(
        'title',
        [
          'label' => esc_html__('Title', 'tmc'),
          'type'   => Controls_Manager::TEXT,
          'default' => esc_html__('TMC Title', 'tmc'),
          'placeholder' => esc_html__('Type your title here', 'tmc'),
        ]
      );
      $this->add_control(
         'text_editor',
         [
            'label' => esc_html__('Description', 'tmc'),
            'type'  => Controls_Manager::WYSIWYG,
            'default'  => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'tmc'),
            'placeholder' => esc_html__('type your description here', 'tmc'),
         ]
      );
      $this->add_control(
        'scroll_animate',
        [
          'label' => __( 'Animate', 'tmc' ),
          'type' => Controls_Manager::TEXTAREA,
          'rows' => 5,
          'default' => __( 'Default description', 'tmc' ),
          'placeholder' => __( 'Values ​​separated by |', 'tmc' ),
        ]
      );
      $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $migrated = isset( $settings['__fa4_migrated']['icon'] );
        $is_new = Icons_Manager::is_migration_allowed();
        $animate = isset($settings['scroll_animate']) ? explode('|', $settings['scroll_animate']) : array();
        ?>
        <div class="tmc-service-widget" <?php echo join(' ',$animate);?>>
          <div class="tmc-text-icon">
            <?php 
            if ( $is_new || $migrated ) {
              Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
            } elseif ( ! empty( $settings['icon'] ) ) {
              ?><i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i><?php
            }
            ?>
          </div>
          <div class="tmc-service-content">
            <?php if ( !empty( $settings['title'] ) ) : ?>
                <h3 class="tmc-title-sc">
                    <?php echo $settings['title'] ?>
                </h3>
            <?php endif; ?>
            <?php if ( !empty( $settings['text_editor'] ) ) : ?>
                <div class="tmc-subtitle-sc" >
                    <?php echo  $settings['text_editor'];?>
                </div>
            <?php endif; ?>
          </div>
        </div>
        <?php
    }
}