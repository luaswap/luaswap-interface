<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Stake_Profit extends Widget_Base{
    public function get_name()
    {
      return 'stake-profit';
    }
    public function get_icon()
    {
        return 'fa fa-chart-bar';
    }
    public function get_title()
    {
        return esc_html__('Stake Profit', 'tmc');
    }
    /*
    * Depend Script
    */
    public function get_script_depends() {
      return [
          'tmc-addon'
      ];
    }
    public function get_categories()
    {
        return [ 'tmc-introduce-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_stake_profit_option();      
    }
    private function tmc_stake_profit_option(){
      $this->start_controls_section(
        'stake_profit',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );

      $this->add_control(
        'title',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Title', 'tmc' ),
          'default'     => __( 'Amount of Tomo you own', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
      $this->add_control(
        'profit',
        [
          'label' => __( 'Profit percentage', 'tmc' ),
          'type' => Controls_Manager::NUMBER,
          'min' => 0,
          'max' => 100,
          'step' => 1,
          'default' => 6,
        ]
      );
      $this->add_control(
        'return_title',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => __('Title', 'tmc' ),
          'default'     => __( 'Annual Profit', 'tmc' ),
          'placeholder' => __( 'Type your text', 'tmc' ),
        ]
      );
     
      $this->end_controls_section();

    }
    protected function render()
    {
      $settings = $this->get_settings();
      ?>
      <div class="tmc-stake-profit-widget">
          <div class="tmc-stake-profit-form" data-profit="<?php echo $settings['profit'];?>">
            <div class="tmc-amount-tomo">
              <label for="tmc-amount"><?php echo $settings['title'];?></label>
              <input type="number" name="amount" id="tmc-amount" placeholder="1000">
            </div>
            <div class="tmc-return-profit">
              <label for="tmc-profit"><?php echo $settings['return_title'];?></label>
              <input type="number" name="profit" id="tmc-profit" placeholder="60">
            </div>
          </div>

      </div>
      <?php
    }
}