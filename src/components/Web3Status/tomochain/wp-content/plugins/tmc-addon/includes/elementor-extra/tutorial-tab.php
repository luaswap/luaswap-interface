<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Tutorial_Tab extends Widget_Base{
    public function get_name()
    {
      return 'tmc-tutorial-tab';
    }
    public function get_icon()
    {
        return 'eicon-tabs';
    }
    public function get_title()
    {
        return esc_html__('Tutorial Tab', 'tmc');
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
        return [ 'tmc-introduce-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_turorial_option();      
    }
    private function tmc_turorial_option(){
      $this->start_controls_section(
        'tmc_tutotial_tab',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );
      $this->add_control(
        'step',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Step', 'tmc' ),
          'default'     => __( '1', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'title',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Heading', 'tmc' ),
          'default'     => __( 'Tutorial', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'style',
        [
          'type'           => Controls_Manager::SELECT,
          'label'          => '<i class="fa fa-columns"></i> ' . esc_html__( 'Style', 'tmc' ),
          'default'        => 'style-1',
          'options'        => [
            'style-1'     => __('Style 1', 'tmc'),
            'style-2'     => __('Style 2', 'tmc'),
          ]
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
        'tab_name',
        [
          'type'        => Controls_Manager::TEXTAREA,
          'rows'        => 2,
          'label'       => esc_html__( 'Tab name', 'tmc' ),
          'description' => esc_html__('Type your description','tmc')
        ]
      );

      $repeater->add_control(
        'content',
        [
          'type'        => Controls_Manager::TEXTAREA,
          'rows'        => 5,
          'label'       => esc_html__( 'Content', 'tmc' ),
          'description' => esc_html__('Type your description','tmc')
        ]
      );

      $this->add_control(
        'tab_list',
        [
          'label' => __( 'List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'tab_name' => __( 'Tab 1', 'tmc' ),
            ],
            [
              'tab_name' => __( 'Tab 2', 'tmc' ),
            ],
            [
              'tab_name' => __( 'Tab 3', 'tmc' ),
            ],
          ],
          'title_field' => '{{{ tab_name }}}',
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
      $this->add_control(
        'custom_html',
        [
          'type'        => Controls_Manager::TEXTAREA,
          'rows'        => 5,
          'label'       => esc_html__( 'Custom HTML', 'tmc' ),
        ]
      );
      
      $this->end_controls_section();

    }
    protected function render()
    {
      $settings = $this->get_settings();
      ?>
      <div class="tmc-turotial-tab-widget">
          <div class="tx-heading tx-accordion">
            <?php if(!empty($settings['step'])):?>
              <span class="tx-step"><?php echo wp_kses_post($settings['step']);?></span>
            <?php endif;?>
            <?php if(!empty($settings['title'])):?>
              <h3 class="tx-title"><?php echo wp_kses_post($settings['title']);?></h3>
              <span class=tx-icon><i class="fas fa-caret-down"></i></span>
            <?php endif;?>
          </div>
          
          <div class="tx-tutorial-tab-content tx-accordion-content <?php echo $settings['style'];?>">
              <?php
              $list = $settings['tab_list'];
              $mobile_class = ( ! empty( $settings['columns_mobile'] ) ? $settings['columns_mobile'] : '' );
              $tablet_class = ( ! empty( $settings['columns_tablet'] ) ? $settings['columns_tablet'] : '' );
              $desktop_class = ( ! empty( $settings['columns'] ) ? $settings['columns'] : '' );

              $tabs = $contents = [];
              ?>
              <?php foreach ( $list as $l ) {
                  $c = $l['content'];
                  if($l['icon_type'] == 's_icon'){
                    $icon = $l['icon'];
                  }else{
                    $icon = $l['image']['url'];
                  }
                  array_push($tabs, array('tab_name' => $l['tab_name'],'icon_type'=>$l['icon_type'],'icon'=>$icon));
                  array_push($contents, $c);
              }?>
              <div class="tx-tab-list">
                <?php $j = 1;
                foreach($tabs as $tab){?>
                  <a class="tx-tab-item" href="#tab-<?php echo $j;?>">
                    <div class="inner">
                      <p class="tx-tab-icon">
                        <?php if($tab['icon_type'] == 's_icon'):?>
                          <?php Icons_Manager::render_icon( $tab['icon'], [ 'aria-hidden' => 'true' ], 'i' );?>
                        <?php else: ?>
                          <img src="<?php echo $tab['icon']?>" alt="<?php echo $tab['tab_name'];?>">
                        <?php endif;?>
                      </p>
                      <span><?php echo $tab['tab_name'];?></span>
                    </div>
                  </a>
                <?php $j++;
                };?>
              </div>
              <div class="tx-tab-content-wrap">
                <?php $n = 1;
                foreach($contents as $content){?>
                  <div id="tab-<?php echo $n;?>" class="tx-tab-content-item">
                    <?php echo $content;?>
                  </div>
                <?php $n++;
                };?>
              </div>
              <?php if(!empty($settings['custom_html'])):?>
                <div class="tx-tutorial-html">
                  <?php echo $settings['custom_html'];?>
                </div>
              <?php endif;?>
          </div>      

      </div>
      <?php
    }
}