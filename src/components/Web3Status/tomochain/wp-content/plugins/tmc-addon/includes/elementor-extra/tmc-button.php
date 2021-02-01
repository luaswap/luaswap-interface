<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Scheme_Color;
use Elementor\Repeater;

class Tmc_Button extends Widget_Base{
    public function get_name()
    {
      return 'tmc_button';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Button', 'tmc');
    }
    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_button_option();      
    }
    private function tmc_button_option(){
      $this->start_controls_section(
        'tmc_button',
        [
            'label' => esc_html__('Tmc Button', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]
      );
      $repeater = new Repeater();
      $repeater->add_control(
        'title',
        [
          'label'     => __( 'Title', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'     => __( 'Button', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
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
        'color',
        [
          'label' => __( 'Color', 'tmc' ),
          'type' => Controls_Manager::COLOR,
          'scheme' => [
            'type' => Scheme_Color::get_type(),
            'value' => Scheme_Color::COLOR_3,
          ]
        ]
      );
      $repeater->add_control(
        'bgcolor',
        [
          'label' => __( 'Background Color', 'tmc' ),
          'type' => Controls_Manager::COLOR,
          'scheme' => [
            'type' => Scheme_Color::get_type(),
            'value' => Scheme_Color::COLOR_1,
          ],
        ]
      );
      $repeater->add_control(
        'bordercolor',
        [
          'label' => __( 'Border Color', 'tmc' ),
          'type' => Controls_Manager::COLOR,
          'scheme' => [
            'type' => Scheme_Color::get_type(),
            'value' => Scheme_Color::COLOR_2,
          ],
        ]
      );
      $repeater->add_control(
        'popup',
        [
          'label'     => esc_html__( 'Use Popup', 'tmc' ),
          'type'      => Controls_Manager::SWITCHER,
          'default'   => '',
        ]
      );
      $repeater->add_control(
        'popup_content',
        [
          'type'        => Controls_Manager::TEXTAREA,
          'rows'        => 4,
          'label'       => esc_html__( 'Popup Content', 'tmc' ),
          'description' => esc_html__('Add popup content','tmc'),
          'condition'   => [
            'popup' => 'yes'
          ]
        ]
      );
      $this->add_control(
        'button_list',
        [
          'label'   => __( 'Button', 'tmc' ),
          'type'    => Controls_Manager::REPEATER,
          'fields'  => $repeater->get_controls(),
          'default' => [
            [
              'title'       => __( 'Button 1', 'tmc' ),
            ]
          ],
          'title_field' => '{{{ title }}}',
        ]
      );

      $this->add_responsive_control(
        'min_width',
        [
          'label' => __( 'Min Width', 'tmc' ),
          'type' => Controls_Manager::SLIDER,
          'size_units' => [ 'px', '%' ],
          'range' => [
            'px' => [
              'min' => 10,
              'max' => 1000,
              'step' => 5,
            ],
            '%' => [
              'min' => 0,
              'max' => 100,
            ],
          ],
          'default' => [
            'unit' => 'px',
            'size' => 250,
          ],
          'selectors' => [
            '{{WRAPPER}} .tmc-button-widget .button-link' => 'min-width: {{SIZE}}{{UNIT}};',
          ],
        ]
      );
      $this->add_responsive_control(
        'padding',
        [
          'label' => __( 'Padding', 'tmc' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em' ],
          'selectors' => [
            '{{WRAPPER}} .tmc-button-widget .button-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );
      $this->add_control(
        'text_align',
        [
          'label' => esc_html__( 'Alignment', 'tmc' ),
          'type' => Controls_Manager::CHOOSE,
          'options' => [
            'left' => [
              'title' => esc_html__( 'Left', 'tmc' ),
              'icon' => 'fa fa-align-left',
            ],
            'center' => [
              'title' => esc_html__( 'Center', 'tmc' ),
              'icon' => 'fa fa-align-center',
            ],
            'right' => [
              'title' => esc_html__( 'Right', 'tmc' ),
              'icon' => 'fa fa-align-right',
            ],
          ],
          'default' => 'left',
          'selectors'      => [
            '{{WRAPPER}} .tmc-button-widget' => 'text-align: {{VALUE}};',
          ],
        ]
      );

      $this->end_controls_section();
    }
    protected function render()
    {
      $settings = $this->get_settings();
      $button_list = $settings['button_list'];
      ?>
      <div class="tmc-button-widget">
        <?php if(!empty($button_list) && is_array($button_list)):
        $i = 0;
          foreach ($button_list as $value) {
            $i++;
            $title = $value['title'];
            $url = !empty($value['url']['url']) ? $value['url']['url'] : '#';
            $link = ' href="' .  esc_url($url) . '" ';
            if ( isset($value['url']['is_external']) && $value['url']['is_external'] ) {
              $link .= ' target="_blank" ';
            }
            if ( isset($value['url']['nofollow']) && $value['url']['nofollow'] ) {
              $link .= ' rel="nofollow" ';
            }
            $style = 'style="';

            if(isset($value['color']) && !empty($value['color'])){
              $style .= 'color:'. $value['color'] . ';';
            }
            if(isset($value['bgcolor']) && !empty($value['bgcolor'])){
              $style .= 'background-color:'. $value['bgcolor'] . ';';
            }
            if(isset($value['bordercolor']) && !empty($value['bordercolor'])){
              $style .= 'border-color:'. $value['bordercolor'] . ';';
            }
            $style .= '"';
            ?>
            <a class="button-link type-<?php echo $i;?>" <?php echo $link;?> <?php echo $style;?><?php if($value['popup'] == 'yes'):?> data-type="#type-<?php echo $i;?>" <?php endif;?>>
              <?php echo $title;?>
            </a>
            <?php if($value['popup'] == 'yes'):?>
              <div id="type-<?php echo $i;?>" class="tmc-popup-content" style="display: none;">
                <div class="container">
                  <div class="inner">
                    <a href="#" class="tmc-close-popup" data-type="#type-<?php echo $i;?>"><span class="ftomo tomo-times"></span></a>
                    <?php echo $value['popup_content'];?>
                  </div>
                </div>
              </div>
            <?php endif;?>
          <?php }?>
        <?php endif;?>
      </div>
    <?php }
}