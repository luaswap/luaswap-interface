<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;

class Step extends Widget_Base{
    public function get_name()
    {
      return 'tmc-step';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Step', 'tmc');
    }

    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_step_option();      
    }
    private function tmc_step_option(){
      $this->start_controls_section(
        'tmc_step',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );
      // Columns.
      $this->add_responsive_control(
        'columns',
        [
          'type'           => Controls_Manager::SELECT,
          'label'          => '<i class="fa fa-columns"></i> ' . esc_html__( 'Columns', 'tmc' ),
          'default'        => 3,
          'tablet_default' => 2,
          'mobile_default' => 1,
          'options'        => [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
          ]
        ]
      );
      $repeater = new Repeater();
      $repeater->add_control(
        'add_step',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Step', 'tmc' ),
        ]
      );
      $repeater->add_control(
        'title',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Title', 'tmc' ),
        ]
      );

      $repeater->add_control(
        'desc',
        [
          'label'     => __( 'Description', 'tmc' ),
          'type'      => Controls_Manager::TEXTAREA,
          'placeholder'   => __( 'Type your description', 'tmc' ),
        ]
      );
      $repeater->add_control(
        'button_text',
        [
          'label'     => __( 'Button text', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'   => __('Read the article','tmc'),
          'placeholder'   => __( 'Type your description', 'tmc' ),
        ]
      );
      $repeater->add_control(
        'url',
        [
          'label'     => __( 'Url', 'tmc' ),
          'type'      => Controls_Manager::URL,
          'placeholder'   => __( 'https://your-link.com', 'tmc' ),
          'show_external' => true,
          'default'     => [
            'url'     => '',
            'is_external' => true,
            'nofollow' => true,
          ],
        ]
      );

      $this->add_control(
        'step_list',
        [
          'label' => __( 'Step List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'title' => __( 'Step 1', 'tmc' ),
            ],
            [
              'title' => __( 'Step 2', 'tmc' ),
            ],
            [
              'title' => __( 'Step 3', 'tmc' ),
            ]
          ],
          'title_field' => '{{{ title }}}',
        ]
      );

      $this->end_controls_section();
      
    }
    protected function render()
    {
      $settings = $this->get_settings();
      $step = $settings['step_list'];
      $mobile_class = ( ! empty( $settings['columns_mobile'] ) ? ' tmc-mobile-' . $settings['columns_mobile'] : '' );
      $tablet_class = ( ! empty( $settings['columns_tablet'] ) ? ' tmc-tablet-' . $settings['columns_tablet'] : '' );
      $desktop_class = ( ! empty( $settings['columns'] ) ? ' tmc-desktop-' . $settings['columns'] : '' );
      $grid_class = 'tmc-grid-col'.$desktop_class . $tablet_class . $mobile_class;
      ?>
        <div class="tmc-step-widget">

            <?php if(!empty($step) && is_array($step)):?>
              <div class="tmc-step-content <?php echo esc_attr($grid_class)?>">
                  <?php
                    foreach ( $step as $s ) {
                      $number_st = isset($s['add_step']) ? $s['add_step'] : '';
                      $st = isset($s['title']) ? $s['title'] : '';
                      $si = isset($s['image']['url']) ? $s['image']['url'] : '';
                      $sd = isset($s['desc']) ? $s['desc'] : '';
                      $sb = isset($s['button_text']) ? $s['button_text'] : '';
                      $s_url = !empty($s['url']['url']) ? $s['url']['url'] : '#';
                      $s_link_props = ' href="' . esc_url( $s_url ) . '" ';
                      if ( isset($s['url']['is_external']) && $s['url']['is_external'] ) {
                        $s_link_props .= ' target="_blank" ';
                      }
                      if ( isset($s['url']['nofollow']) && $s['url']['nofollow'] ) {
                        $s_link_props .= ' rel="nofollow" ';
                      }
                      ?>
                      <div class="tmc-grid-item">
                          <div class="step-header">
                            <span class="number"><?php esc_html_e($number_st);?></span>
                            <span class="step-title"><?php echo $st;?></span>
                          </div>
                          <?php if($sd):?>
                            <p class="desc"><?php echo $sd;?></p>
                          <?php endif;?>
                          <?php if($sb):?>
                            <a class="read-more" <?php echo esc_attr($s_link_props);?>><?php echo $sb?></a>
                          <?php endif;?>
                      </div>
                  <?php }?>
              </div>
            <?php endif;?>
        </div>
        <?php
    }
}