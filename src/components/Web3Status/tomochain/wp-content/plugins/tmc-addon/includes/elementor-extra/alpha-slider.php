<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Utils;

class Alpha_Slider extends Widget_Base{
    public function get_name()
    {
      return 'tmc-slider';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Slider', 'tmc');
    }
    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    /*
    * Depend Style
    */
    public function get_style_depends() {
          return [
              'swiper',
          ];
      }
    /*
    * Depend Script
    */
    public function get_script_depends() {
        return [
            'swiper',
            'tmc-addon',
        ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_alpha_tabs_option();
    }
    public function convert_to_slug($str) {
      $str = strtolower(trim($str));
      $str = preg_replace('/[^a-z0-9-]/', '-', $str);
      $str = preg_replace('/-+/', "-", $str);
      return rtrim($str, '-');
    }
    private function tmc_alpha_tabs_option(){
      $this->start_controls_section(
        'tmc_slider',
        [
            'label' => esc_html__('Slider', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
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
        'tab',
        [
          'label'     => __( 'Tab', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'     => __( 'D', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );

      $repeater->add_control(
          'color',
          [
            'label'  => esc_html__('Color', 'tmc'),
            'type'   => Controls_Manager::COLOR
          ]
      );

      $repeater->add_control(
        'title', [
          'label' => __( 'Title', 'tmc' ),
          'type' => Controls_Manager::TEXT,
          'default' => __( 'Developer hub' , 'tmc' ),
          'label_block' => true,
        ]
      );
      $repeater->add_control(
        'subtitle',
        [
          'label'     => __( 'Sub title', 'tmc' ),
          'type'      => Controls_Manager::TEXTAREA,
          'rows'      => 10,
          'default' => __( 'Dive on Tomochain technoloty, and start building.' , 'tmc' ),
          'placeholder'   => __( 'Type your sub title', 'tmc' ),
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
      $repeater->add_control(
        'button_text',
        [
          'label' => __( 'Button text', 'tmc' ),
          'type' => Controls_Manager::TEXT,
          'default' => __( 'View more' , 'tmc' ),
          'label_block' => true,
        ]
      );
      $this->add_control(
        'tab_list',
        [
          'label'   => __( 'Tab', 'tmc' ),
          'type'    => Controls_Manager::REPEATER,
          'fields'  => $repeater->get_controls(),
          'default' => [
            [
              'tab'       => __( 'D', 'tmc' ),
              'title'     => __( 'Developer hub', 'tmc' ),
              'subtitle'  => __( 'Dive on Tomochain technoloty, and start building.', 'tmc' ),
            ],
            [
              'tab'       => __( 'P', 'tmc' ),
              'title'     => __( 'Protocol & Product', 'tmc' ),
              'subtitle'  => __( 'Dive on Tomochain technoloty, and start building.', 'tmc' ),
            ],
            [
              'tab'       => __( 'S', 'tmc' ),
              'title'     => __( 'Staking', 'tmc' ),
              'subtitle'  => __( 'Dive on Tomochain technoloty, and start building.', 'tmc' ),
            ],
          ],
          'title_field' => '{{{ tab }}}',
        ]
      );

      $this->end_controls_section();
    }
    protected function render()
    {
      $settings = $this->get_settings();
      $tabs = $content_tabs = array();

      if(isset($settings['tab_list']) && is_array($settings['tab_list'])):
        foreach ($settings['tab_list'] as $key => $value) {
          $tabs[] = $value['tab'];
          // $content_tabs
        }
        $i = $j = 0;
        ?>
        <div class="tmc-slider-widget">
            <div class="tmc-slider-wrap swiper-wrapper">
              <?php foreach($settings['tab_list'] as $value):
                  $i++;
                  $image = !empty($value['image']['url']) ? $value['image']['url'] : '';
                  $tab = !empty($value['tab']) ? $value['tab'] : '';
                  $color = !empty($value['color']) ? $value['color'] : '';
                  $title = !empty($value['title']) ? $value['title'] : '';
                  $subtitle = !empty($value['subtitle']) ? $value['subtitle'] : '';
                  $subtitle = !empty($value['subtitle']) ? $value['subtitle'] : '';
                  $button_text = !empty($value['button_text']) ? $value['button_text'] : '';
                  $url = !empty($value['url']['url']) ? $value['url']['url'] : '#';
                  $link = ' href="' . esc_url( $url ) . '" ';
                  if ( isset($value['url']['is_external']) && $value['url']['is_external'] === 'on' ) {
                    $link .= ' target="_blank" ';
                  }
                  if ( isset($value['url']['nofollow']) && $value['url']['nofollow'] === 'on' ) {
                    $link .= ' rel="nofollow" ';
                  }
                ?>
                <div id="tab-<?php echo esc_attr($i);?>" class="tmc-slider-content swiper-slide" data-color="<?php echo esc_attr($color);?>" data-letter="<?php echo esc_attr($tab);?>">
                  <div class="tmc-flex-content">
                    <div class="tmc-tab-left alpha-<?php echo $this->convert_to_slug($value['tab']);?>">
                      <img src="<?php echo esc_url($image);?>">
                    </div>
                    <div class="tmc-tab-right alpha-<?php echo $this->convert_to_slug($value['tab']);?>">
                      <h3 class="c-title"><?php echo wp_kses_post($value['title']);?></h3>
                      <p class="c-subtitle"><?php echo wp_kses_post($value['subtitle']);?></p>
                      <a class="link" <?php echo $link;?>>
                        <?php echo esc_html($button_text);?>
                      </a>
                    </div>
                  </div>
                </div>
              <?php endforeach;?>
            </div>
            <div class="swiper-pagination tmc-slider-pagination"></div>
        </div>
        <?php
      endif;
    }
}