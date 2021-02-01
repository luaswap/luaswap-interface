<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Utils;

class Tabs extends Widget_Base{
    public function get_name()
    {
      return 'tmc_tabs';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Tabs', 'tmc');
    }
    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_tabs_option();      
    }
    private function tmc_tabs_option(){
      $this->start_controls_section(
        'tmc_tab_title',
        [
            'label' => esc_html__('Title heading', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]
      );
      $this->add_control(
        'title_heading',
        [
          'label'     => __( 'Title', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'     => __( 'Ecosystem', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );
      $this->end_controls_section();

      $this->start_controls_section(
        'tmc_tab_partner',
        [
            'label' => esc_html__('Partner', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]
      );
      $this->add_control(
        'p_tab',
        [
          'label'     => __( 'Tab title', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'rows'      => 4,
          'default'     => __( 'Partner', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );
      $repeater = new Repeater();

      $repeater->add_control(
        'p_title', [
          'label' => __( 'Title', 'tmc' ),
          'type' => Controls_Manager::TEXT,
          'default' => __( 'Partner' , 'tmc' ),
          'label_block' => true,
        ]
      );
      $repeater->add_control(
        'p_image',
        [
          'type'      => Controls_Manager::MEDIA,
          'label'     => esc_html__( 'Image', 'tmc' ),
          'default'   => [
            'url'   => Utils::get_placeholder_image_src(),
          ],
        ]
      );

      $repeater->add_control(
        'p_url',
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
        'p_list',
        [
          'label' => __( 'Partner List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'p_title' => __( 'Partner 1', 'tmc' ),
            ],
            [
              'p_title' => __( 'Partner 1', 'tmc' ),
            ],
          ],
          'title_field' => '{{{ p_title }}}',
        ]
      );

      $this->end_controls_section();

      $this->start_controls_section(
        'tmc_tab_exchange',
        [
            'label' => esc_html__('Liquidity', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]
      );
      $this->add_control(
        'ex_tab',
        [
          'label'     => __( 'Tab title', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'rows'      => 4,
          'default'     => __( 'Liquidity', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );
      $repeater = new Repeater();

      $repeater->add_control(
        'ex_title', [
          'label' => __( 'Title', 'tmc' ),
          'type' => Controls_Manager::TEXT,
          'default' => __( 'Title' , 'tmc' ),
          'label_block' => true,
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
        'ex_list',
        [
          'label' => __( 'Exchange List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'ex_title' => __( 'Bibox', 'tmc' ),
            ],
            [
              'ex_title' => __( 'Kucoin', 'tmc' ),
            ],
          ],
          'title_field' => '{{{ ex_title }}}',
        ]
      );

      $this->add_control(
        'ex_custom_html', [
          'label' => __( 'Custom HTML', 'tmc' ),
          'type' => Controls_Manager::TEXTAREA,
          'placeholder' => __( 'Add custom html' , 'tmc' ),
          'label_block' => true,
        ]
      );
      $this->end_controls_section();
      $this->start_controls_section(
        'tmc_tab_wallet',
        [
            'label' => esc_html__('Wallet', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]
      );
      $this->add_control(
        'w_tab',
        [
          'label'     => __( 'Tab title', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'rows'      => 4,
          'default'     => __( 'Wallet', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );
      $repeater = new Repeater();

      $repeater->add_control(
        'w_title', [
          'label' => __( 'Title', 'tmc' ),
          'type' => Controls_Manager::TEXT,
          'default' => __( 'Wallet' , 'tmc' ),
          'label_block' => true,
        ]
      );

      $repeater->add_control(
        'w_image',
        [
          'type'      => Controls_Manager::MEDIA,
          'label'     => esc_html__( 'Image', 'tmc' ),
          'default'   => [
            'url'   => Utils::get_placeholder_image_src(),
          ],
        ]
      );

      $repeater->add_control(
        'w_url',
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
        'w_list',
        [
          'label' => __( 'Wallet', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'w_title' => __( 'Wallet 1', 'tmc' ),
            ],
            [
              'w_title' => __( 'Wallet 2', 'tmc' ),
            ],
          ],
          'title_field' => '{{{ w_title }}}',
        ]
      );

      $this->end_controls_section();
      $this->start_controls_section(
        'tmc_tab_channels',
        [
            'label' => esc_html__('Dapp Channels', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]
      );
      $this->add_control(
        'c_tab',
        [
          'label'     => __( 'Tab title', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'rows'      => 4,
          'default'     => __( 'Tab title', 'tmc' ),
        ]
      );
      $repeater = new Repeater();

      $repeater->add_control(
        'c_title',
        [
          'label' => __( 'Title', 'tmc' ),
          'type' => Controls_Manager::TEXT,
          'default' => __( 'Dapp Title' , 'tmc' ),
          'label_block' => true,
        ]
      );
      $repeater->add_control(
        'c_image',
        [
          'type'      => Controls_Manager::MEDIA,
          'label'     => esc_html__( 'Image', 'tmc' ),
          'default'   => [
            'url'   => Utils::get_placeholder_image_src(),
          ],
        ]
      );

      $repeater->add_control(
        'c_url',
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
        'c_list',
        [
          'label' => __( 'Channels', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'c_title' => __( 'Dapp 1', 'tmc' ),
            ],
            [
              'c_title' => __( 'Dapp 2', 'tmc' ),
            ],
          ],
          'title_field' => '{{{ c_title }}}',
        ]
      );

      $this->end_controls_section();      
    }
    protected function render()
    {
       $settings = $this->get_settings();
       $ex_title = $settings['ex_tab'];
       $w_title = $settings['w_tab'];
       $c_title = $settings['c_tab'];
       $p_title = $settings['p_tab'];

       $ex_list = $settings['ex_list'];
       $w_list = $settings['w_list'];
       $c_list = $settings['c_list'];
       $p_list = $settings['p_list'];

        ?>
        <div class="tmc-tabs-widget">
          <?php if(!empty($settings['title_heading'])):?>
            <h2 class="title-heading scrollme">
              <?php echo $settings['title_heading'];?>
              <span class="animateme"
                data-when="enter"
                data-from="1"
                data-to="0"
                data-opacity="0"
                data-translatex="-200"
                data-translatey=""
                data-rotatez="0">
              </span>
            </h2>
          <?php endif;?>
            <ul class="tmc-tab-title">
              <?php if(!empty($p_title)):?>
                <li class="tab-title p-tab active"><a href="#p-tab"><?php echo esc_html($p_title);?></a></li>
              <?php endif;?>
              <?php if(!empty($ex_title)):?>
                <li class="tab-title ex-tab"><a href="#ex-tab"><?php echo esc_html($ex_title);?></a></li>
              <?php endif;?>
              <?php if(!empty($w_title)):?>
                <li class="tab-title w-tab"><a href="#w-tab"><?php echo esc_html($w_title);?></a></li>
              <?php endif;?>
              <?php if(!empty($c_title)):?>
                <li class="tab-title c-tab"><a href="#c-tab"><?php echo esc_html($c_title);?></a></li>
              <?php endif;?>
            </ul>
            <?php if(!empty($p_list) && is_array($p_list)):?>
              <div id="p-tab" class="tab-content">
                <div class="row">
                  <?php
                    foreach ( $p_list as $p ) {
                      $pt = isset($p['p_title']) ? $p['p_title'] : '';
                      $pi = isset($p['p_image']['url']) ? $p['p_image']['url'] : '';
                      $p_url = !empty($p['p_url']['url']) ? $p['p_url']['url'] : '#';
                      $p_link_props = ' href="' . esc_url( $p_url ) . '" ';
                      if ( isset($p['p_url']['is_external']) && $p['p_url']['is_external'] ) {
                        $p_link_props .= ' target="_blank" ';
                      }
                      if ( isset($p['p_url']['nofollow']) && $p['p_url']['nofollow'] ) {
                        $p_link_props .= ' rel="nofollow" ';
                      }
                      ?>
                      <div class="p-item col-4 col-md-3">
                        <div class="common-logo-item"><img src="<?php echo esc_url($pi);?>" alt="<?php echo esc_attr($pt);?>"></div>
                        <!-- <a class="link" <?php //echo $p_link_props;?>>
                        </a> -->
                      </div>
                  <?php }?>
                </div>
              </div>
            <?php endif;?>
            <?php if(!empty($ex_list) && is_array($ex_list)):
              $ex_html = $settings['ex_custom_html'];
              ?>
              <div id="ex-tab" class="tab-content">
                <div class="row">
                  <?php
                    foreach ( $ex_list as $ex ) {
                      $et = isset($ex['ex_title']) ? $ex['ex_title'] : '';
                      $ei = isset($ex['image']['url']) ? $ex['image']['url'] : '';
                      $e_url = !empty($ex['url']['url']) ? $ex['url']['url'] : '#';
                      $link_props = ' href="' . esc_url( $e_url ) . '" ';
                      if ( isset($ex['url']['nofollow']) && $ex['url']['is_external'] ) {
                        $link_props .= ' target="_blank" ';
                      }
                      if ( isset($ex['url']['nofollow']) && $ex['url']['nofollow']) {
                        $link_props .= ' rel="nofollow" ';
                      }
                      ?>
                      <div class="ex-item col-4 col-md-3">
                        <div class="common-logo-item"><img src="<?php echo esc_url($ei);?>" alt="<?php echo esc_attr($et);?>"></div>
                        <!-- <a class="link" <?php //echo $link_props;?>>
                        </a> -->
                      </div>
                  <?php }?>
                </div>
                <?php if(!empty($ex_html)):?>
                  <div class="mt-2">
                    <?php echo $ex_html;?>
                  </div>
                <?php endif;?>
              </div>
            <?php endif;?>
            <?php if(!empty($w_list) && is_array($w_list)):?>
              <div id="w-tab" class="tab-content">
                <div class="row">
                  <?php
                    foreach ( $w_list as $w ) {
                      $wt = $w['w_title'];
                      $wi = isset($w['w_image']['url']) ? $w['w_image']['url'] : '';
                      $w_url = isset($w['w_url']['url']) && !empty($w['w_url']['url']) ? $w['w_url']['url'] : '#';
                      $w_link_props = ' href="' . esc_url( $w_url ) . '" ';
                      if ( isset($w['w_url']['is_external']) && $w['w_url']['is_external'] ) {
                        $w_link_props .= ' target="_blank" ';
                      }
                      if ( isset($w['w_url']['nofollow']) && $w['w_url']['nofollow'] ) {
                        $w_link_props .= ' rel="nofollow" ';
                      }
                      ?>
                      <div class="w-item col-4 col-md-3">
                        <div class="common-logo-item"><img src="<?php echo esc_url($wi);?>" alt="<?php echo esc_attr($wt);?>"></div>
                        <!-- <a class="link" <?php //echo $w_link_props;?>>
                        </a> -->
                      </div>
                  <?php }?>
                </div>
              </div>
            <?php endif;?>
            <?php if(!empty($c_list) && is_array($c_list)):?>
              <div id="c-tab" class="tab-content">
                <div class="row">
                  <?php
                    foreach ( $c_list as $c ) {
                      $ct = isset($c['c_title']) ? $c['c_title'] : '';
                      $ci = isset($c['c_image']['url']) ? $c['c_image']['url'] : '';
                      $c_url = !empty($c['c_url']['url']) ? $c['c_url']['url'] : '#';
                      $c_link_props = ' href="' . esc_url( $c_url ) . '" ';
                      if ( isset($c['c_url']['is_external']) && $c['c_url']['is_external'] ) {
                        $c_link_props .= ' target="_blank" ';
                      }
                      if ( isset($c['c_url']['nofollow']) && $c['c_url']['nofollow'] ) {
                        $c_link_props .= ' rel="nofollow" ';
                      }
                      ?>
                      <div class="c-item col-4 col-md-3">
                        <div class="common-logo-item"><img src="<?php echo esc_url($ci);?>" alt="<?php echo esc_attr($ct);?>"></div>
                        <!-- <a class="link" <?php //echo $c_link_props;?>>
                        </a> -->
                      </div>
                  <?php }?>
                </div>
              </div>
            <?php endif;?>
        </div>
        <?php
    }
}