<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Utils;

class Layer_Content extends Widget_Base{
    public function get_name()
    {
      return 'tmc-layer-content';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Layer Content', 'tmc');
    }

    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_layer_content_option();      
    }
    private function tmc_layer_content_option(){
      $this->start_controls_section(
        'tmc_layer_content',
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
          'image',
          [
            'type'      => Controls_Manager::MEDIA,
            'label'     => esc_html__( 'Image', 'tmc' ),
            'default'   => [
              'url'   => Utils::get_placeholder_image_src(),
            ],
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
        'subtitle',
        [
          'label'     => __( 'Sub Title', 'tmc' ),
          'type'      => Controls_Manager::TEXTAREA,
          'rows'      => 3,
          'placeholder'   => __( 'Type your description', 'tmc' ),
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
        'url',
        [
          'label'     => __( 'Url', 'tmc' ),
          'type'      => Controls_Manager::URL,
          'placeholder'   => __( 'https://your-link.com', 'tmc' ),
          'show_external' => true,
          'default'     => [
            'url'     => '',
            'is_external' => true,
            'nofollow' => false,
          ],
        ]
      );
      $repeater->add_control(
        'url_external',
        [
          'label'     => __( 'External url', 'tmc' ),
          'type'      => Controls_Manager::SWITCHER,
          'label_on'  => __( 'Yes', 'tmc' ),
          'label_off' => __( 'No', 'tmc' ),
          'return_value' => 'yes',
          'default' => 'yes',
        ]
      );
      $repeater->add_control(
        'button_text',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Button Text', 'tmc' ),
          'default'   => esc_html__('Read more','tmc')
        ]
      );

      $this->add_control(
        'layer_content_list',
        [
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'title' => __( 'Tomo Wallet', 'tmc' ),
            ],
            [
              'title' => __( 'Tomo Stats', 'tmc' ),
            ],
            [
              'title' => __( 'Tomo Scan', 'tmc' ),
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
      $layer_content = $settings['layer_content_list'];
      $mobile_class = ( ! empty( $settings['columns_mobile'] ) ? ' tmc-mobile-' . $settings['columns_mobile'] : '' );
      $tablet_class = ( ! empty( $settings['columns_tablet'] ) ? ' tmc-tablet-' . $settings['columns_tablet'] : '' );
      $desktop_class = ( ! empty( $settings['columns'] ) ? ' tmc-desktop-' . $settings['columns'] : '' );
      $grid_class = 'tmc-grid-col'.$desktop_class . $tablet_class . $mobile_class;
      ?>
        <div class="tmc-layer-content-widget">

            <?php if(!empty($layer_content) && is_array($layer_content)):?>
              <div class="tmc-layer-content <?php echo esc_attr($grid_class)?>">
                  <?php
                    foreach ( $layer_content as $s ) {
                      $image = isset($s['image']['url']) ? $s['image']['url'] : '';
                      $title = isset($s['title']) ? $s['title'] : '';
                      $subtitle = isset($s['subtitle']) ? $s['subtitle'] : '';
                      $desc = isset($s['desc']) ? $s['desc'] : '';
                      $url = !empty($s['url']['url']) ? $s['url']['url'] : '#';
                      $link_props = ' href="' . esc_url( $url ) . '" ';
                      $button_text = $s['button_text'];
                      if ( isset($s['url']['is_external']) && $s['url']['is_external'] ) {
                        $link_props .= ' target="_blank" ';
                      }
                      if ( isset($s['url']['nofollow']) && $s['url']['nofollow'] ) {
                        $link_props .= ' rel="nofollow" ';
                      }else{
                        $link_props .= ' rel="dofollow" ';
                      }
                      ?>
                      <div class="layer-content-item tmc-grid-item">
                        <div class="st-ct-infor">
                            <div class="layer-header">
                              <?php if($image):?>
                                <img src="<?php echo esc_url($image)?>" alt="<?php echo esc_attr($title);?>">
                              <?php endif;?>
                              <h3 class="layer-title"><?php echo wp_kses_post($title);?>
                                <?php if ( $s['url_external'] == 'yes' ) {?>
                                    <span class="ftomo tomo-open-link"></span>
                                <?php };?>
                              </h3>
                              <?php if($subtitle):?>
                                <div class="sub-title"><?php echo wp_kses_post($subtitle);?></div>
                              <?php endif;?>
                            </div>
                            <div class="layer-info">
                              <a <?php echo $link_props;?>>
                                <?php if($desc):?>
                                  <div class="desc"><?php echo wp_kses_post($desc);?></div>
                                  <p class="m-0 mt-3 btn-read-more"><?php echo $button_text;?></p>
                                <?php endif;?>
                              </a>
                            </div>
                          </div>
                      </div>
                  <?php }?>
              </div>
            <?php endif;?>
        </div>
        <?php
    }
}