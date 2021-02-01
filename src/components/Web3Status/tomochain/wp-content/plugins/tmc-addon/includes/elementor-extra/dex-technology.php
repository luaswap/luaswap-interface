<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;

class Dex_Technology extends Widget_Base{
    public function get_name()
    {
      return 'tmc-dex-tech';
    }
    public function get_icon()
    {
        return 'fa fa-cubes';
    }
    public function get_title()
    {
        return esc_html__('Advanced Technology', 'tmc');
    }

    public function get_categories()
    {
        return [ 'tmc-introduce-widgets' ];
    }
    protected function _register_controls()
    {
      $this->tmc_tech_option();      
    }
    private function tmc_tech_option(){
      $this->start_controls_section(
        'tmc_tech',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );
      $this->add_control(
        'step',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Step', 'tmc' ),
          'default'     => __( '2', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'title_heading',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Title heading', 'tmc' ),
          'default'     => __( 'Advanced Technology', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );

      $repeater = new Repeater();

      $repeater->add_control(
        'icon_type',
        [
          'label' => __( 'Icon Type', 'tmc' ),
          'type' => Controls_Manager::CHOOSE,
          'options' => [
            's_icon' => [
              'title' => __( 'Icon', 'tmc' ),
              'icon' => 'fas fa-info',
            ],
            's_image' => [
              'title' => __( 'Image', 'tmc' ),
              'icon' => 'far fa-image',
            ]
          ],
          'default' => 's_icon',
          'toggle' => true,
        ]
      );

      $repeater->add_control(
        'icon',
        [
          'label' => __( 'Icon', 'tmc' ),
          'type' => Controls_Manager::ICONS,
          'default' => [
            'value' => 'fas fa-star',
            'library' => 'solid',
          ],
          'condition' => [
              'icon_type' => 's_icon'
          ]
        ]
      );
      $repeater->add_control(
        'image',
        [
          'label'       => __( 'Choose Image', 'tmc' ),
          'type'        => Controls_Manager::MEDIA,
          'condition'   => [
            'icon_type' => 's_image'  
          ]
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
          'type'        => Controls_Manager::TEXTAREA,
          'rows'        => 5,
          'label'       => esc_html__( 'Description', 'tmc' ),
          'description' => esc_html__('Type your description','tmc')
        ]
      );

      $this->add_control(
        'tech_list',
        [
          'label' => __( 'Tech List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'title' => __( 'Sercure', 'tmc' ),
            ],
            [
              'title' => __( 'Performance', 'tmc' ),
            ],
            [
              'title' => __( 'Full Decentralization', 'tmc' ),
            ],
          ],
          'title_field' => '{{{ title }}}',
        ]
      );
      // Columns.
      $this->add_responsive_control(
        'columns',
        [
          'type'           => Controls_Manager::SELECT,
          'label'          => '<i class="fa fa-columns"></i> ' . esc_html__( 'Columns', 'tmc' ),
          'default'        => 2,
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
      
      $this->end_controls_section();

    }
    protected function render()
    {
      $settings = $this->get_settings();
      $tech_list = $settings['tech_list'];

      $mobile_class = ( ! empty( $settings['columns_mobile'] ) ? ' tmc-mobile-' . $settings['columns_mobile'] : '' );
      $tablet_class = ( ! empty( $settings['columns_tablet'] ) ? ' tmc-tablet-' . $settings['columns_tablet'] : '' );
      $desktop_class = ( ! empty( $settings['columns'] ) ? ' tmc-desktop-' . $settings['columns'] : '' );

      $item_class = ' tmc-grid-col'.$desktop_class . $tablet_class . $mobile_class;
      ?>
      <div class="tmc-tech-widget">
          <div class="tx-heading tx-accordion">
            <?php if(!empty($settings['step'])):?>
              <span class="tx-step"><?php echo wp_kses_post($settings['step']);?></span>
            <?php endif;?>
            <?php if(!empty($settings['title_heading'])):?>
              <h3 class="tx-title"><?php echo wp_kses_post($settings['title_heading']);?></h3>
              <span class=tx-icon><i class="fas fa-caret-down"></i></span>
            <?php endif;?>
          </div>
          <?php if(!empty($tech_list)):?>
            <div class="tx-tech-desc tx-accordion-content">
              <div class="<?php echo esc_attr($item_class);?>">
                <?php foreach ( $tech_list as $t ) {
                  $i = isset($t['icon']) ? $t['icon'] : '';
                  $h = isset($t['title']) ? $t['title'] : '';
                  $d = isset($t['desc']) ? $t['desc'] : '';?>
                  <div class="tx-tech-item tmc-grid-item">
                    <div class="tx-tech-icon">
                      <?php if($t['icon_type'] == 's_icon'):?>
                        <?php Icons_Manager::render_icon( $i, [ 'aria-hidden' => 'true' ], 'i' );?>
                      <?php else:?>
                          <img src="<?php echo $t['image']['url']?>" alt="<?php echo $h;?>">
                      <?php endif;?>
                    </div>
                    <h3 class="tx-tech-title"><?php echo wp_kses_post($h);?></h3>
                    <div class="tx-tech-info">
                      <?php echo wp_kses_post($d);?>
                    </div>
                  </div>
                <?php }?>
              </div>
            </div>
          <?php endif;?>
      </div>
      <?php
    }
}