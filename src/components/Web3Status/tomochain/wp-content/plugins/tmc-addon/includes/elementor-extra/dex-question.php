<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Dex_Question extends Widget_Base{
    public function get_name()
    {
      return 'tmc-dex-question';
    }
    public function get_icon()
    {
        return 'fa fa-question';
    }
    public function get_title()
    {
        return esc_html__('Asked Questions', 'tmc');
    }

    public function get_categories()
    {
        return [ 'tmc-introduce-widgets' ];
    }
    protected function _register_controls()
    {
      $this->tmc_question_option();      
    }
    private function tmc_question_option(){
      $this->start_controls_section(
        'tmc_question',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );
      $this->add_control(
        'step',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Step', 'tmc' ),
          'default'     => __( '4', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'title_heading',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Title heading', 'tmc' ),
          'default'     => __( 'Frequently asked questions', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
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
        'desc',
        [
          'type'        => Controls_Manager::TEXTAREA,
          'rows'        => 5,
          'label'       => esc_html__( 'Description', 'tmc' ),
          'description' => esc_html__('Type your description','tmc')
        ]
      );

      $this->add_control(
        'q_list',
        [
          'label' => __( 'Questions List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'title' => __( 'Question 1?', 'tmc' ),
            ],
            [
              'title' => __( 'Question 2?', 'tmc' ),
            ],
            [
              'title' => __( 'Question 3?', 'tmc' ),
            ],
          ],
          'title_field' => '{{{ title }}}',
        ]
      );

      
      $this->end_controls_section();

    }
    protected function render()
    {
      $settings = $this->get_settings();
      $q_list = $settings['q_list'];

      ?>
      <div class="tmc-question-widget">
          <div class="tx-heading tx-accordion">
            <?php if(!empty($settings['step'])):?>
              <span class="tx-step"><?php echo wp_kses_post($settings['step']);?></span>
            <?php endif;?>
            <?php if(!empty($settings['title_heading'])):?>
              <h3 class="tx-title"><?php echo wp_kses_post($settings['title_heading']);?></h3>
              <span class=tx-icon><i class="fas fa-caret-down"></i></span>
            <?php endif;?>
          </div>
          <?php if(!empty($q_list)):?>
            <div class="tx-question-desc tx-accordion-content">
                <?php foreach ( $q_list as $q ) {
                  $h = isset($q['title']) ? $q['title'] : '';
                  $d = isset($q['desc']) ? $q['desc'] : '';?>
                  <div class="tx-question-item ">
                    <div class="tx-q-heading tx-accordion">
                      <h4 class="tx-question-title"><?php echo wp_kses_post($h);?></h4>
                      <span class=tx-icon><i class="fas fa-caret-down"></i></span>
                    </div>
                    <div class="tx-question-info tx-accordion-content">
                      <?php echo wp_kses_post($d);?>
                    </div>
                  </div>
              <?php }?>
            </div>
          <?php endif;?>
      </div>
      <?php
    }
}