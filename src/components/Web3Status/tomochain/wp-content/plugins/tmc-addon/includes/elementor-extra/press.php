<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Utils;

class Press extends Widget_Base{
    public function get_name()
    {
      return 'tmc-press';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Press', 'tmc');
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

    /**
     * Get categories.
     */
    private function get_press_categories() {
      $options = array();

      // Get categories for post type.
      $terms = get_terms(
        array(
          'taxonomy'   => 'press_cat',
          'hide_empty' => true,
        )
      );
      if ( ! empty( $terms ) ) {
        foreach ( $terms as $term ) {
          if ( isset( $term ) ) {
            if ( isset( $term->slug ) && isset( $term->name ) ) {
              $options[ $term->slug ] = $term->name;
            }
          }
        }
      }

      return $options;
    }

    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_press_option();      
    }
    private function tmc_press_option(){
      $this->start_controls_section(
        'tmc_press',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );
      
      $this->add_control(
        'title_heading',
        [
          'label'     => __( 'Title', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'     => __( 'Press', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );

      $this->add_control(
        'source',
        [
          'label'     => __( 'Type', 'tmc' ),
          'type'      => Controls_Manager::SELECT,
          'default'   => 'press',
          'options'   => [
              'custom'  => __('Custom', 'tmc'),
              'press'   => __('Press Post Type', 'tmc'),
          ],    
        ]
      );

      $this->add_control(
        'cat',
        [
          'label'     => __( 'Categories', 'tmc' ),
          'type'      => Controls_Manager::SELECT2,
          'multiple'  => true,
          'options'   => $this->get_press_categories(),
          'condition' => [
            'source'  => 'press',
          ],
        ]
      );

      $this->add_control(
        'per_page',
        [
          'label'     => __( 'Post per page', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'     => 8,
          'condition' => [
            'source'  => 'press',
          ],
        ]
      );

      $this->add_control(
        'p_button_text',
        [
          'label'       => __( 'Button text', 'tmc' ),
          'type'        => Controls_Manager::TEXT,
          'default'     => __( 'Read the article', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
          'condition' => [
            'source'  => 'press',
          ],
        ]
      );

      $repeater = new Repeater();
      $repeater->add_control(
        'title',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Title', 'tmc' ),
        ]
      );
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
          'placeholder'   => __( 'Type your text', 'tmc' ),
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
        'press_list',
        [
          'label' => __( 'Article List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'title' => __( 'Article 1', 'tmc' ),
            ],
            [
              'title' => __( 'Article 2', 'tmc' ),
            ],
            [
              'title' => __( 'Article 3', 'tmc' ),
            ],
            [
              'title' => __( 'Article 4', 'tmc' ),
            ],
          ],
          'condition' => [
            'source'  => 'custom',
          ],
          'title_field' => '{{{ title }}}',
        ]
      );

      $this->end_controls_section();
      
    }
    protected function render()
    {
        $settings = $this->get_settings();
        $source   = !empty($settings['source']) ? $settings['source'] : 'press';
        if($source == 'press'){
          $cat = !empty($settings['cat']) ? $settings['cat'] : '';
          $per_page = !empty($settings['per_page']) ? $settings['per_page'] : 8;
          $args = [
            'post_type'     => 'tmc_press',
            'post_per_page' => $per_page,
            'orderby'       => 'date',
            'order'         => 'DESC'
          ];
          if(!empty($cat)){
            $args['tax_query'] = [
              [
                  'taxonomy' => 'press_cat',
                  'field' => 'term_id',
                  'terms' => $cat,
              ]
            ];
          }
        }       
        ?>
        <div class="tmc-press-widget">
          <?php if(!empty($settings['title_heading'])):?>
            <h2 class="title-heading scrollme">
              <?php echo $settings['title_heading'];?>
              <span class="animateme"
                data-when="enter"
                data-from="1"
                data-to="0"
                data-opacity="0"
                data-translatex="-200"
                data-translatey="0"
                data-rotatez="0">
              </span>
            </h2>
          <?php endif;?>

            
              <div class="tmc-press-content">
                <?php if($source == 'custom'):
                  $press = $settings['press_list'];
                  ?>
                  <?php if(!empty($press) && is_array($press)):?>
                    <?php foreach ( $press as $p ) {
                        $pt = isset($p['title']) ? $p['title'] : esc_html__('News','tmc');
                        $pi = isset($p['image']['url']) ? $p['image']['url'] : '';
                        $pd = isset($p['desc']) ? $p['desc'] : '';
                        $pb = isset($p['button_text']) ? $p['button_text'] : esc_html__('Read the article','tmc');
                        $p_url = !empty($p['url']['url']) ? $p['url']['url'] : '#';
                        $p_link_props = ' href="' . esc_url( $p_url ) . '" ';
                        if ( isset($p['url']['is_external']) && $p['url']['is_external'] ) {
                          $p_link_props .= ' target="_blank" ';
                        }
                        if ( isset($p['url']['nofollow']) && $p['url']['nofollow'] ) {
                          $p_link_props .= ' rel="nofollow" ';
                        }else{
                          $p_link_props .= ' rel="dofollow" ';
                        }
                        ?>
                        <div class="p-item">
                            <img src="<?php echo esc_url($pi);?>" alt="<?php echo esc_attr($pt);?>">
                            <p class="desc"><?php echo wp_kses_post($pd);?></p>
                            <a class="read-more" <?php echo $p_link_props;?>><?php echo $pb?></a>
                        </div>
                    <?php }?>
                  <?php endif;?>
                <?php else:
                    $press = new \WP_Query($args);
                    $button_text = $settings['p_button_text'];
                    if($press->have_posts()):
                      while ( $press->have_posts()): $press->the_post();
                        $pi = get_post_meta(get_the_ID(), 'press_image',true);
                        $url = get_post_meta(get_the_ID(), 'custom_url',true);
                        $blank = get_post_meta(get_the_ID(), 'target_blank',true);
                        $nofollow = get_post_meta(get_the_ID(), 'nofollow',true);
                        ?>

                        <div class="p-item">
                          <img src="<?php echo esc_url($pi);?>" alt="<?php the_title();?>">
                          <div class="desc"><?php the_content();?></div>
                          <a class="read-more" href="<?php echo esc_url($url);?>" <?php if($nofollow):?>rel="nofollow"<?php else:?> rel="dofollow"<?php endif;?> <?php if($blank):?>target="_blank"<?php endif;?>><?php echo esc_html($button_text);?></a>
                        </div> 
                      <?php endwhile;?>
                    <?php endif;?>
                <?php endif;?>
              </div>            
        </div>
        <?php
    }
}