<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;

class Dex_Start extends Widget_Base{
    public function get_name()
    {
      return 'tmc-dex-start';
    }
    public function get_icon()
    {
        return 'fa fa-rocket';
    }
    public function get_title()
    {
        return esc_html__('[DEX] How to start', 'tmc');
    }

    public function get_categories()
    {
        return [ 'tmc-introduce-widgets' ];
    }
    protected function _register_controls()
    {
      $this->tmc_start_option();      
    }
    private function tmc_start_option(){
      $this->start_controls_section(
        'tmc_start',
        [
            'label' => esc_html__('General', 'tmc'),
            'tab'  => Controls_Manager::TAB_CONTENT
        ]
      );
      $this->add_control(
        'step',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Step', 'tmc' ),
          'default'     => __( '3', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'title_heading',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Title heading', 'tmc' ),
          'default'     => __( 'How to start your own DEX', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->end_controls_section();
      // DEX Register
      $this->start_controls_section(
        'tmc_register',
        [
            'label' => esc_html__('Register', 'tmc'),
            'tab'  => Controls_Manager::TAB_CONTENT
        ]
      );
      $this->add_control(
        'r_title',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading', 'tmc' ),
          'default'     => __( 'Relayer Registration', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'r_desc',
        [
          'label'       => __( 'Description', 'tmc' ),
          'type'        => Controls_Manager::WYSIWYG,
          'default'     => __( 'Default description', 'tmc' ),
          'placeholder' => __( 'Type your description here', 'tmc' ),
        ]
      );
      $this->add_control(
        'rf_option',
        [
          'label'     => __( 'TomoRelayer Features', 'tmc' ),
          'type'      => Controls_Manager::HEADING,
          'separator' => 'after',
        ]
      );
      $this->add_control(
        'rf_heading',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading', 'tmc' ),
          'default'     => __( 'TomoRelayer Features', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $repeater = new Repeater();

      $repeater->add_control(
        'rf_icon',
        [
          'label' => __( 'Icon', 'tmc' ),
          'type' => Controls_Manager::ICONS,
          'default' => [
            'value' => 'fas fa-star',
            'library' => 'solid',
          ],
        ]
      );

      $repeater->add_control(
        'rf_title',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Title', 'tmc' ),
        ]
      );
      $repeater->add_control(
        'rf_desc',
        [
          'type'        => Controls_Manager::TEXTAREA,
          'rows'        => 5,
          'label'       => esc_html__( 'Description', 'tmc' ),
          'description' => esc_html__('Type your description','tmc')
        ]
      );

      $this->add_control(
        'rf_list',
        [
          'label' => __( 'Feature List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'rf_title' => __( 'Feature 1', 'tmc' ),
            ],
            [
              'rf_title' => __( 'Feature 2', 'tmc' ),
            ],
            [
              'rf_title' => __( 'Feature 3', 'tmc' ),
            ],
          ],
          'title_field' => '{{{ rf_title }}}',
        ]
      );
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
      $this->add_control(
        'tutorial_option',
        [
          'label'     => __( 'Tutorial', 'tmc' ),
          'type'      => Controls_Manager::HEADING,
          'separator' => 'after',
        ]
      );
      $this->add_control(
        'tutorial_heading',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading', 'tmc' ),
          'default'     => __( 'Tutorial', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'tutorial_html',
        [
          'label'       => __( 'Add HTML', 'tmc' ),
          'type'        => Controls_Manager::CODE,
          'language'    => 'html',
          'rows'        => 10,
        ]
      );
    

      $this->end_controls_section();
      // DEX Setup
      $this->start_controls_section(
        'tmc_setup',
        [
            'label' => esc_html__('Setup', 'tmc'),
            'tab'  => Controls_Manager::TAB_CONTENT
        ]
      );
      $this->add_control(
        's_title',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading', 'tmc' ),
          'default'     => __( 'DEX Setup', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        's_html',
        [
          'label'       => __( 'Add HTML', 'tmc' ),
          'type'        => Controls_Manager::CODE,
          'language'    => 'html',
          'rows'        => 30,
        ]
      );

      $this->end_controls_section();
      // Token Management
      $this->start_controls_section(
        'tmc_token_manage',
        [
            'label' => esc_html__('Token Manage', 'tmc'),
            'tab'  => Controls_Manager::TAB_CONTENT
        ]
      );
      $this->add_control(
        'tm_title',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading', 'tmc' ),
          'default'     => __( 'Relayer and token listing management', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'tm_desc',
        [
          'label'       => __( 'Description', 'tmc' ),
          'type'        => Controls_Manager::WYSIWYG,
          'default'     => __( 'Default description', 'tmc' ),
          'placeholder' => __( 'Type your description here', 'tmc' ),
        ]
      );
      $this->add_control(
        'tm_option',
        [
          'label'     => __( 'Features', 'tmc' ),
          'type'      => Controls_Manager::HEADING,
          'separator' => 'after',
        ]
      );
      $this->add_control(
        'tmf_heading',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading', 'tmc' ),
          'default'     => __( 'Features', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $repeater = new Repeater();

      $repeater->add_control(
        'tmf_icon',
        [
          'label' => __( 'Icon', 'tmc' ),
          'type' => Controls_Manager::ICONS,
          'default' => [
            'value' => 'fas fa-star',
            'library' => 'solid',
          ],
        ]
      );

      $repeater->add_control(
        'tmf_title',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Title', 'tmc' ),
        ]
      );
      $repeater->add_control(
        'tmf_desc',
        [
          'type'        => Controls_Manager::TEXTAREA,
          'rows'        => 5,
          'label'       => esc_html__( 'Description', 'tmc' ),
          'description' => esc_html__('Type your description','tmc')
        ]
      );

      $this->add_control(
        'tmf_list',
        [
          'label' => __( 'Feature List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'tmf_title' => __( 'Feature 1', 'tmc' ),
            ],
            [
              'tmf_title' => __( 'Feature 2', 'tmc' ),
            ],
            [
              'tmf_title' => __( 'Feature 3', 'tmc' ),
            ],
          ],
          'title_field'   => '{{{ tmf_title }}}',
        ]
      );
      $this->add_responsive_control(
        'tm_columns',
        [
          'type'              => Controls_Manager::SELECT,
          'label'             => '<i class="fa fa-columns"></i> ' . esc_html__( 'Columns', 'tmc' ),
          'default'           => 2,
          'tablet_default'    => 2,
          'mobile_default'    => 1,
          'options'           => [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
          ]
        ]
      );

      $this->end_controls_section();
       // DEX Optimizaion
      $this->start_controls_section(
        'tmc_optimization',
        [
            'label' => esc_html__('Optimizaion', 'tmc'),
            'tab'  => Controls_Manager::TAB_CONTENT
        ]
      );
      $this->add_control(
        'o_title',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading', 'tmc' ),
          'default'     => __( 'DEX Optimizaion', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'ol_option',
        [
          'label'     => __( 'Lending', 'tmc' ),
          'type'      => Controls_Manager::HEADING,
          'separator' => 'after',
        ]
      );
      $this->add_control(
        'ol_overlay',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading Overlay', 'tmc' ),
          'default'     => __( 'Lending', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'ol_title',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading Title', 'tmc' ),
          'default'     => __( 'Enable crypto assets P2P lending on your DEX with TomoLending', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'ol_desc',
        [
          'label'       => __( 'Description', 'tmc' ),
          'type'        => Controls_Manager::WYSIWYG,
          'default'     => __( 'Default description', 'tmc' ),
          'placeholder' => __( 'Type your description here', 'tmc' ),
        ]
      );
      $repeater = new Repeater();

      $repeater->add_control(
        'old_icon',
        [
          'label' => __( 'Icon', 'tmc' ),
          'type' => Controls_Manager::ICONS,
          'default' => [
            'value' => 'fas fa-star',
            'library' => 'solid',
          ],
        ]
      );

      $repeater->add_control(
        'old_title',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Title', 'tmc' ),
        ]
      );
      $repeater->add_control(
        'old_desc',
        [
          'type'        => Controls_Manager::TEXTAREA,
          'rows'        => 5,
          'label'       => esc_html__( 'Description', 'tmc' ),
          'description' => esc_html__('Type your description','tmc')
        ]
      );

      $this->add_control(
        'old_list',
        [
          'label' => __( 'Service List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'old_title' => __( 'Service 1', 'tmc' ),
            ],
            [
              'old_title' => __( 'Service 2', 'tmc' ),
            ],
            [
              'old_title' => __( 'Service 3', 'tmc' ),
            ],
          ],
          'title_field'   => '{{{ old_title }}}',
        ]
      );
      $this->add_responsive_control(
        'ol_columns',
        [
          'type'              => Controls_Manager::SELECT,
          'label'             => '<i class="fa fa-columns"></i> ' . esc_html__( 'Columns', 'tmc' ),
          'default'           => 2,
          'tablet_default'    => 2,
          'mobile_default'    => 1,
          'options'           => [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
          ]
        ]
      );
      $this->add_control(
        'ol_button_text',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Button text', 'tmc' ),
          'default'     => __( 'Read TomoLending Docs', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'ol_button_link',
        [
          'label'         => __( 'Button Link', 'tmc' ),
          'type'          => Controls_Manager::URL,
          'placeholder'   => __( 'https://your-link.com', 'tmc' ),
          'show_external' => true,
          'default'       => [
            'url'         => '',
            'is_external' => true,
            'nofollow'    => true,
          ],
        ]
      );

      $this->add_control(
        'ob_option',
        [
          'label'     => __( 'Bridge', 'tmc' ),
          'type'      => Controls_Manager::HEADING,
          'separator' => 'after',
        ]
      );
      $this->add_control(
        'ob_overlay',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading Overlay', 'tmc' ),
          'default'     => __( 'Lending', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'ob_title',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading Title', 'tmc' ),
          'default'     => __( 'Increase the liquidity of your DEX', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'ob_desc',
        [
          'label'       => __( 'Description', 'tmc' ),
          'type'        => Controls_Manager::WYSIWYG,
          'default'     => __( 'Default description', 'tmc' ),
          'placeholder' => __( 'Type your description here', 'tmc' ),
        ]
      );
      $this->add_control(
        'ob_feature',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Feature text', 'tmc' ),
          'default'     => __( 'Features', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );

      $repeater = new Repeater();

      $repeater->add_control(
        'obf_icon',
        [
          'label' => __( 'Icon', 'tmc' ),
          'type' => Controls_Manager::ICONS,
          'default' => [
            'value' => 'fas fa-star',
            'library' => 'solid',
          ],
        ]
      );

      $repeater->add_control(
        'obf_title',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Title', 'tmc' ),
        ]
      );
      $repeater->add_control(
        'obf_desc',
        [
          'type'        => Controls_Manager::TEXTAREA,
          'rows'        => 5,
          'label'       => esc_html__( 'Description', 'tmc' ),
          'description' => esc_html__('Type your description','tmc')
        ]
      );

      $this->add_control(
        'obf_list',
        [
          'label' => __( 'Feature List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'obf_title' => __( 'Feature 1', 'tmc' ),
            ],
            [
              'obf_title' => __( 'Feature 2', 'tmc' ),
            ],
            [
              'obf_title' => __( 'Feature 3', 'tmc' ),
            ],
          ],
          'title_field'   => '{{{ obf_title }}}',
        ]
      );
      $this->add_responsive_control(
        'ob_columns',
        [
          'type'              => Controls_Manager::SELECT,
          'label'             => '<i class="fa fa-columns"></i> ' . esc_html__( 'Columns', 'tmc' ),
          'default'           => 2,
          'tablet_default'    => 2,
          'mobile_default'    => 1,
          'options'           => [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
          ]
        ]
      );

      $this->add_control(
        'ob_turotal',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Turotal text', 'tmc' ),
          'default'     => __( 'Turotal', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'ob_html',
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
      <div class="tmc-dex-start-widget">

          <div class="tx-heading tx-accordion">
            <?php if(!empty($settings['step'])):?>
              <span class="tx-step"><?php echo wp_kses_post($settings['step']);?></span>
            <?php endif;?>
            <?php if(!empty($settings['title_heading'])):?>
              <h3 class="tx-title"><?php echo wp_kses_post($settings['title_heading']);?></h3>
              <span class=tx-icon><i class="fas fa-caret-down"></i></span>
            <?php endif;?>
          </div>

          <div class="tx-dex-start-desc tx-accordion-content">
              <div class="tx-r-layer">
                <?php if(!empty($settings['r_title'])):?>
                  <div class="tx-sub-heading tx-accordion">
                    <span class="tx-sub-number">1</span>
                    <h4 class="tx-layer-title"><?php echo wp_kses_post($settings['r_title']);?></h4>
                    <span class=tx-icon><i class="fas fa-caret-down"></i></span>
                  </div>
                <?php endif;?>
                <div class="tx-r-wrap tx-accordion-content">
                  <div class="tx-r-desc">
                    <?php echo wp_kses_post($settings['r_desc']);?>
                  </div>
                  <div class="tx-r-feature">
                    <?php 
                    $mobile_class = ( ! empty( $settings['columns_mobile'] ) ? ' tmc-mobile-' . $settings['columns_mobile'] : '' );
                    $tablet_class = ( ! empty( $settings['columns_tablet'] ) ? ' tmc-tablet-' . $settings['columns_tablet'] : '' );
                    $desktop_class = ( ! empty( $settings['columns'] ) ? ' tmc-desktop-' . $settings['columns'] : '' );
                    $item_class = 'tmc-grid-col'.$desktop_class . $tablet_class . $mobile_class;
                    $f_list = $settings['rf_list']
                    ?>
                    <?php if(!empty($settings['rf_heading'])):?>
                      <h4 class="tx-rf-heading"><?php echo $settings['rf_heading'];?></h4>
                    <?php endif;?>
                    <?php if(!empty($f_list)):?>
                      <div class="tx-rf-info">
                        <div class="<?php echo esc_attr($item_class);?>">
                          <?php foreach ( $f_list as $f ) {
                            $i = isset($f['rf_icon']) ? $f['rf_icon'] : '';
                            $h = isset($f['rf_title']) ? $f['rf_title'] : '';
                            $d = isset($f['rf_desc']) ? $f['rf_desc'] : '';?>
                            <div class="tx-rf-item tmc-grid-item">
                              <div class="tx-rf-icon">
                                <?php Icons_Manager::render_icon( $i, [ 'aria-hidden' => 'true' ], 'i' );?>
                              </div>
                              <h3 class="tx-rf-title"><?php echo wp_kses_post($h);?></h3>
                              <div class="tx-rf-info">
                                <?php echo wp_kses_post($d);?>
                              </div>
                            </div>
                          <?php }?>
                        </div>
                      </div>
                    <?php endif;?>
                  </div>
                  
                  <div class="tx-r-tutorial">
                    <?php if(!empty($settings['tutorial_heading'])):?>
                      <h4 class="tx-rt-heading"><?php echo $settings['tutorial_heading'];?></h4>
                    <?php endif;?>
                    <?php if(!empty($settings['tutorial_html'])):?>
                      <?php echo $settings['tutorial_html'];?>
                    <?php endif;?>
                  </div>                  
                </div>

              </div>
              <div class="tx-s-layer">
                <?php if(!empty($settings['r_title'])):?>
                  <div class="tx-sub-heading tx-accordion">
                    <span class="tx-sub-number">2</span>
                    <h4 class="tx-layer-title"><?php echo wp_kses_post($settings['s_title']);?></h4>
                    <span class=tx-icon><i class="fas fa-caret-down"></i></span>
                  </div>
                <?php endif;?>
                <?php if(!empty($settings['s_html'])):?>
                  <div class="tx-s-wrap tx-accordion-content">
                    <?php echo $settings['s_html'];?>
                  </div>
                <?php endif;?>
              </div>
              <div class="tx-token-layer">
                <?php if(!empty($settings['tm_title'])):?>
                  <div class="tx-sub-heading tx-accordion">
                    <span class="tx-sub-number">3</span>
                    <h4 class="tx-layer-title"><?php echo wp_kses_post($settings['tm_title']);?></h4>
                    <span class=tx-icon><i class="fas fa-caret-down"></i></span>
                  </div>
                <?php endif;?>
                <div class="tx-token-wrap tx-accordion-content">
                  <div class="tx-tm-desc">
                    <?php echo wp_kses_post($settings['tm_desc']);?>
                  </div>
                  <?php 
                  $t_mobile_class = ( ! empty( $settings['tm_columns_mobile'] ) ? ' tmc-mobile-' . $settings['tm_columns_mobile'] : '' );
                  $t_tablet_class = ( ! empty( $settings['tm_columns_tablet'] ) ? ' tmc-tablet-' . $settings['tm_columns_tablet'] : '' );
                  $t_desktop_class = ( ! empty( $settings['tm_columns'] ) ? ' tmc-desktop-' . $settings['tm_columns'] : '' );
                  $t_item_class = ' tmc-grid-col'.$t_desktop_class . $t_tablet_class . $t_mobile_class;
                  $tf_list = $settings['tmf_list']
                  ?>
                  <?php if(!empty($settings['tmf_heading'])):?>
                    <h4 class="tx-tmf-heading"><?php echo $settings['tmf_heading'];?></h4>
                  <?php endif;?>
                  <?php if(!empty($tf_list)):?>
                    <div class="tx-tmf-info<?php echo esc_attr($t_item_class);?>">
                        <?php foreach ( $tf_list as $tf ) {
                          $i = isset($tf['tmf_icon']) ? $tf['tmf_icon'] : '';
                          $h = isset($tf['tmf_title']) ? $tf['tmf_title'] : '';
                          $d = isset($tf['tmf_desc']) ? $tf['tmf_desc'] : '';?>
                          <div class="tx-tmf-item tmc-grid-item">
                            <div class="tx-tmf-icon">
                              <?php Icons_Manager::render_icon( $i, [ 'aria-hidden' => 'true' ], 'i' );?>
                            </div>
                            <h3 class="tx-tmf-title"><?php echo wp_kses_post($h);?></h3>
                            <div class="tx-tmf-info">
                              <?php echo wp_kses_post($d);?>
                            </div>
                          </div>
                      <?php }?>
                    </div>
                  <?php endif;?>
                </div>                
              </div>
              <div class="tx-optimization-layer">
                <?php if(!empty($settings['o_title'])):?>
                  <div class="tx-sub-heading tx-accordion">
                    <span class="tx-sub-number">4</span>
                    <h4 class="tx-layer-title"><?php echo wp_kses_post($settings['o_title']);?></h4>
                    <span class=tx-icon><i class="fas fa-caret-down"></i></span>
                  </div>
                <?php endif;?>
                <div class="tx-optimization-wrap tx-accordion-content">
                  <div class="tx-o-lending">
                    <div class="tx-ol-head">
                      <?php if(!empty($settings['ol_overlay'])):?>
                        <span class="tx-ol-overlay"><?php echo $settings['ol_overlay'];?></span>
                      <?php endif;?>
                      <?php if(!empty($settings['ol_title'])):?>
                        <h3 class="tx-ol-title"><?php echo $settings['ol_title'];?></h3>
                      <?php endif;?>
                    </div>
                    <?php if(!empty($settings['ol_desc'])):?>
                      <div class="tx-ol-desc">
                        <?php echo wp_kses_post($settings['ol_desc']);?>
                      </div>
                    <?php endif;?>
                    <div class="tx-ol-service">
                      <?php 
                      $ol_mobile_class = ( ! empty( $settings['ol_columns_mobile'] ) ? ' tmc-mobile-' . $settings['ol_columns_mobile'] : '' );
                      $ol_tablet_class = ( ! empty( $settings['ol_columns_tablet'] ) ? ' tmc-tablet-' . $settings['ol_columns_tablet'] : '' );
                      $ol_desktop_class = ( ! empty( $settings['ol_columns'] ) ? ' tmc-desktop-' . $settings['ol_columns'] : '' );
                      $ol_item_class = ' tmc-grid-col'.$ol_desktop_class . $ol_tablet_class . $ol_mobile_class;
                      $tf_list = $settings['old_list']?>
                      <?php if(!empty($tf_list)):?>
                      <div class="tx-ol-info<?php echo esc_attr($ol_item_class);?>">
                          <?php foreach ( $tf_list as $tf ) {
                            $i = isset($tf['old_icon']) ? $tf['old_icon'] : '';
                            $h = isset($tf['old_title']) ? $tf['old_title'] : '';
                            $d = isset($tf['old_desc']) ? $tf['old_desc'] : '';?>
                            <div class="tx-ol-item tmc-grid-item">
                              <div class="tx-ol-icon">
                                <?php Icons_Manager::render_icon( $i, [ 'aria-hidden' => 'true' ], 'i' );?>
                              </div>
                              <h3 class="tx-ol-title"><?php echo wp_kses_post($h);?></h3>
                              <div class="tx-ol-info">
                                <?php echo wp_kses_post($d);?>
                              </div>
                            </div>
                        <?php }?>
                      </div>
                    <?php endif;?>
                    </div>
                    <div class="tx-ol-button">
                      <?php
                        $ob_button_text = $settings['ol_button_text'];
                        $target = $settings['ol_button_link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $settings['ol_button_link']['nofollow'] ? ' rel="nofollow"' : '';
                        echo '<a href="' . $settings['ol_button_link']['url'] . '"' . $target . $nofollow . '>'. $ob_button_text .'</a>';
                      ?>
                    </div>
                  </div>

                  <div class="tx-o-bridge">
                    <div class="tx-ob-head">
                      <?php if(!empty($settings['ob_overlay'])):?>
                        <span class="tx-ob-overlay"><?php echo $settings['ob_overlay'];?></span>
                      <?php endif;?>
                      <?php if(!empty($settings['ob_title'])):?>
                        <h3 class="tx-ob-title"><?php echo $settings['ob_title'];?></h3>
                      <?php endif;?>
                    </div>
                    <?php if(!empty($settings['ob_desc'])):?>
                      <div class="tx-ob-desc">
                        <?php echo wp_kses_post($settings['ob_desc']);?>
                      </div>
                    <?php endif;?>
                    <div class="tx-ob-feature">
                      <?php 
                      $ob_mobile_class = ( ! empty( $settings['ob_columns_mobile'] ) ? ' tmc-mobile-' . $settings['ob_columns_mobile'] : '' );
                      $ob_tablet_class = ( ! empty( $settings['ob_columns_tablet'] ) ? ' tmc-tablet-' . $settings['ob_columns_tablet'] : '' );
                      $ob_desktop_class = ( ! empty( $settings['ob_columns'] ) ? ' tmc-desktop-' . $settings['ob_columns'] : '' );
                      $ob_item_class = ' tmc-grid-col'.$ob_desktop_class . $ob_tablet_class . $ob_mobile_class;
                      $obf_list = $settings['obf_list']?>
                      <?php if(!empty($obf_list)):?>
                      <?php if(!empty($settings['tmf_heading'])):?>
                        <h4 class="tx-ob-heading"><?php echo $settings['ob_feature'];?></h4>
                      <?php endif;?>
                      <div class="tx-obf-info<?php echo esc_attr($ob_item_class);?>">
                          <?php foreach ( $obf_list as $obf ) {
                            $i = isset($obf['obf_icon']) ? $obf['obf_icon'] : '';
                            $h = isset($obf['obf_title']) ? $obf['obf_title'] : '';
                            $d = isset($obf['obf_desc']) ? $obf['obf_desc'] : '';?>
                            <div class="tx-obf-item tmc-grid-item">
                              <div class="inner">
                                <div class="tx-obf-icon">
                                  <?php Icons_Manager::render_icon( $i, [ 'aria-hidden' => 'true' ], 'i' );?>
                                </div>
                                <h3 class="tx-obf-title"><?php echo wp_kses_post($h);?></h3>
                                <div class="tx-obf-info">
                                  <?php echo wp_kses_post($d);?>
                                </div>
                              </div>
                            </div>
                        <?php }?>
                      </div>
                    <?php endif;?>
                    </div>
                    <?php if(!empty($settings['ob_html'])):?>
                      <div class="tx-ob-tutorial">
                        <?php echo $settings['ob_html'];?>
                      </div>
                    <?php endif;?>
                  </div>
                </div>
              </div>
          </div>
      </div>
      <?php
    }
}