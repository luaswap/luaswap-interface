<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;

class Contact extends Widget_Base{
    public function get_name()
    {
      return 'tmc-contact';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Contact', 'tmc');
    }

    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_contact_option();      
    }
    private function tmc_contact_option(){
      $this->start_controls_section(
        'tmc_contact',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );
      $this->add_control(
        'title_heading',
        [
          'label'     => __( 'Title', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'     => __( 'Contact', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
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
        'contact_type',
        [
          'type'           => Controls_Manager::SELECT,
          'label'          => '<i class="fa fa-columns"></i> ' . esc_html__( 'Type', 'tmc' ),
          'default'        => 'email',
          'options'        => [
            'email' => __('Email','tmc'),
            'url'   => __('URL','tmc'),
          ],
        ]
      );
      $repeater->add_control(
        'email',
        [
          'label'     => __( 'Email', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'condition' => [
            'contact_type' => 'email'
          ]
        ]
      );
      $repeater->add_control(
        'text',
        [
          'label'     => __( 'Text', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'condition' => [
            'contact_type' => 'url'
          ]
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
          'condition' => [
              'contact_type' => 'url'
          ]
        ]
      );

      $this->add_control(
        'contact_list',
        [
          'label' => __( 'Contact List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'title' => __( 'Contact 1', 'tmc' ),
            ],
            [
              'title' => __( 'Contact 2', 'tmc' ),
            ],
            [
              'title' => __( 'Contact 3', 'tmc' ),
            ],
            [
              'title' => __( 'Contact 4', 'tmc' ),
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
       $contact = $settings['contact_list'];
        ?>
        <div class="tmc-contact-widget">
          <?php if(!empty($settings['title_heading'])):?>
            <div class="tmc-contact-title">
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
            </div>
          <?php endif;?>

          <?php if(!empty($contact) && is_array($contact)):?>
            <div class="tmc-contact-content">
                <?php
                  foreach ( $contact as $c ) {
                    $ct = isset($c['title']) ? $c['title'] : '';
                    $type = isset($c['contact_type']) ? $c['contact_type'] : '';                    
                    ?>
                    <div class="c-item">
                        <div class="contact-title"><?php echo wp_kses_post($ct);?></div>
                        <div class="contact-info">
                          <?php if($type == 'email'){
                            $email = $c['email'];
                            ?>
                            <a href="mailto:<?php echo $email;?>"><?php esc_html_e($email);?></a>
                          <?php }else{
                            $c_url = !empty($c['url']['url']) ? $c['url']['url'] : '#';
                            $c_link_props = ' href="' . esc_url( $c_url ) . '" ';
                            if ( isset($c['url']['is_external']) && $c['url']['is_external'] ) {
                              $c_link_props .= ' target="_blank" ';
                            }
                            if ( isset($c['url']['nofollow']) && $c['url']['nofollow'] ) {
                              $c_link_props .= ' rel="nofollow" ';
                            }
                            $text = $c['text'];?>
                            <a <?php echo $c_link_props;?>><?php echo wp_kses_post($text);?></a>
                          <?php }?>                          
                        </div>
                    </div>
                <?php }?>
            </div>
          <?php endif;?>
        </div>
        <?php
    }
}