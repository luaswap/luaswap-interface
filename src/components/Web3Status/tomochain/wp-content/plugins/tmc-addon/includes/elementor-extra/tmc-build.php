<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Utils;

class Tmc_Build extends Widget_Base{
    public function get_name()
    {
      return 'tmc-build';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Building', 'tmc');
    }

    /*
    * Depend Style
    */
    public function get_style_depends() {
          return [
              'slick',
          ];
      }
    /*
    * Depend Script
    */
    public function get_script_depends() {
        return [
            'slick',
            'tmc-addon',
        ];
    }

    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_build_option();
    }
    private function tmc_build_option(){
      $this->start_controls_section(
        'tmc_build',
        [
            'label' => esc_html__('General', 'tmc')
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
            'nofollow' => true,
          ],
        ]
      );

      $this->add_control(
        'build_list',
        [
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'title' => __( 'Finance', 'tmc' ),
            ],
            [
              'title' => __( 'Game', 'tmc' ),
            ],
            [
              'title' => __( 'Social & Loyalty', 'tmc' ),
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
      $build = $settings['build_list'];
      ?>
        <div class="tmc-developerhub-technology-widget">

            <?php if(!empty($build) && is_array($build)):?>
              <div class="tmc-developerhub-technology-slider">
                  <?php
                    foreach ( $build as $s ) {
                      $image = isset($s['image']['url']) ? $s['image']['url'] : '';
                      $title = isset($s['title']) ? $s['title'] : '';
                      $desc = isset($s['desc']) ? $s['desc'] : '';
                      $url = !empty($s['url']['url']) ? $s['url']['url'] : '#';
                      $link_props = ' href="' . esc_url( $url ) . '" ';
                      if ( isset($s['url']['is_external']) && $s['url']['is_external'] ) {
                        $link_props .= ' target="_blank" ';
                      }
                      if ( isset($s['url']['nofollow']) && $s['url']['nofollow'] ) {
                        $link_props .= ' rel="nofollow" ';
                      }
                      ?>
                      <div class="build-item">
                          <div class="build-header">
                            <?php if($image):?>
                              <img src="<?php echo esc_url($image)?>" alt="<?php echo esc_attr($title);?>">
                            <?php endif;?>
                          </div>
                          <div class="build-info">
                            <!-- <h3 class="build-title"><a <?php //echo $link_props;?>><?php //echo esc_html($title);?></a></h3> -->
                            <h3 class="build-title"><?php echo wp_kses_post($title);?></h3>
                            <?php if($desc):?>
                              <div class="desc"><?php echo wp_kses_post($desc);?></div>
                            <?php endif;?>
                          </div>
                      </div>
                  <?php }?>
              </div>
            <?php endif;?>
        </div>
        <?php
    }
}