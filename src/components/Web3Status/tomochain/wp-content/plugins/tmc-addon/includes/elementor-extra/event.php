<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Event extends Widget_Base{
    public function get_name()
    {
        return 'tmc-event';
    }
    public function get_title()
    {
       return esc_html__('TMC Event', 'tmc');
    }
    public function get_icon()
    {
      return 'fa fa-text-width';
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
    private function get_event_categories() {
        $options = array();
        // Get categories for post type.
        $terms = get_terms(
            array(
            'taxonomy'   => 'event_category',
            'hide_empty' => true,
            )
        );
        if ( ! empty( $terms ) ) {
            foreach ( $terms as $term ) {
            if ( isset( $term ) ) {
                if ( isset( $term->term_id ) && isset( $term->name ) ) {
                $options[ $term->term_id ] = $term->name;
                }
            }
            }
        }

        return $options;
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'tmc_title_event',
            [
                'label' => esc_html__('General Options', 'tmc'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'e_categories',
            [
            'label'   => esc_html__( 'Categories', 'tmc' ),
            'type'    => Controls_Manager::SELECT2,
            'multiple'  => true,
            'options'   => $this->get_event_categories(),
            ]
        );
        // Order by.
        $this->add_control(
            'order_by',
            [
            'type'    => Controls_Manager::SELECT,
            'label'   => '<i class="fa fa-sort"></i> ' . esc_html__( 'Order by', 'tmc' ),
            'default' => 'default',
            'options' => [
                'default'       => esc_html__( 'Default', 'tmc' ),
                'upcomming'     => esc_html__( 'Upcoming Event', 'tmc' ),
                'past'          => esc_html__( 'Past Event', 'tmc' ),
            ],
            ]
        );
        // Order by.
        $this->add_control(
            'order',
            [
            'type'    => Controls_Manager::SELECT,
            'label'   => '<i class="fa fa-sort"></i> ' . esc_html__( 'Sort by', 'tmc' ),
            'default' => 'desc',
            'options' => [
                'asc'         => esc_html__( 'ASC', 'tmc' ),
                'desc'          => esc_html__( 'DESC', 'tmc' ),
            ],
            ]
        );
        $this->add_control(
            'post_per_page',
            [
            'label' => esc_html__( 'Post Per Page', 'tmc' ),
            'type' => Controls_Manager::NUMBER,
            'placeholder' => esc_html__( '8', 'tmc' ),
            'description' => esc_html__( '-1 = Get all post.', 'tmc' ),
            'default'     => 8,
            ]
        );
        $this->add_control(
            'items',
            [
            'label' => esc_html__( 'Display slide number', 'tmc' ),
            'type' => Controls_Manager::NUMBER,
            'placeholder' => esc_html__( '6', 'tmc' ),
            'default'     => 6,
            ]
        );
        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings();
        $e_cat    = $settings['e_categories'];
        $order_by = !empty($settings['order_by']) ? $settings['order_by'] : 'default';
        $order    = !empty($settings['order']) ? $settings['order'] : 'DESC';
        $per_page = !empty($settings['post_per_page']) ? $settings['post_per_page'] : 8;
        $items    = !empty($settings['items']) ? $settings['items'] : 6;
        $args = array(
            'post_type'     => 'tmc_event',
            'post_status'   => 'publish',
            'posts_per_page'=> $per_page,
            'order'         => $order
        );
        if('default' == $order_by){
            $args['meta_key'] = 'open_date';
            $args['orderby'] = 'meta_value_num';
        }elseif('upcomming' == $order_by){
            $args['orderby'] = 'meta_value_num';
            $args['meta_query'] = array(
            array(
                'key' => 'open_date',
                'value' => time(),
                'compare' => '>'
            )
            );
        }elseif('past' == $order_by){
            $args['orderby'] = 'meta_value_num';
            $args['meta_query'] = array(
            array(
                'key' => 'open_date',
                'value' => time(),
                'compare' => '<'
            )
            );
        }
        if(!empty($e_cat)){
            $args['tax_query'] = array(
            array(
                'taxonomy' => 'event_category',
                'field'    => 'term_id',
                'terms'    => $e_cat,
            )
            );
        }
        $e = new \WP_Query($args);
        ?>
        <div class="tmc-events-widget">
            <div class="tmc-events-wrap">
                <div class="tmc-event-dots" data-item="<?php esc_attr_e($items);?>">
                <?php if($e->have_posts()):
                    $current_time = time();
                    while ($e->have_posts()): $e->the_post();
                    $open_date = get_post_meta(get_the_ID(),'open_date',true);
                    $place = get_post_meta(get_the_ID(),'event_place',true);
                    $day = $month = '';
                    if(!empty($open_date)){
                        $day = date('d',$open_date);
                        $month = date('M Y',$open_date);
                    }?>
                    <div class="tmc-dot">
                        <?php if(!empty($day)):?>
                        <div class="tmc-event-time">
                            <h2 class="tmc-date"><?php echo esc_html($day);?></h2>
                            <span class="tmc-month-year"><?php echo esc_html($month);?></span>
                        </div>
                        <?php endif;?>
                        <div class="tmc-info">
                            <h3 class="tmc-title"><?php the_title();?></h3>
                            <?php if($current_time > $open_date):?>
                                <span class="tmc-status"><?php echo esc_html__('Past Event','tmc')?></span>
                            <?php else:?>
                                <span class="tmc-status"><?php echo esc_html__('Upcoming Event','tmc')?></span>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php endwhile;?>
                </div>
                    <div class="tmc-event-content">
                        <?php while ($e->have_posts()): $e->the_post();
                        $place = get_post_meta(get_the_ID(), 'event_place',true);?>
                        <div class="tmc-event-item">
                            <?php if ( has_post_thumbnail() ):?>
                                <div class="tmc-event-coverphoto">
                                    <?php
                                    the_post_thumbnail(
                                    'event-image', array(
                                        'class' => 'img-responsive',
                                        'alt'   => get_the_title( get_post_thumbnail_id() ),
                                    )
                                    ); ?>
                                </div>
                            <?php endif;?>
                            <div class="tmc-event-info">
                                <h2 class="tmc-event-title"><?php the_title();?></h2>
                                <?php if(!empty($place)):?>
                                <div class="tmc-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span class="tmc-place"><?php echo wp_kses_post($place);?></span>
                                </div>
                                <?php endif;?>
                                <div class="tmc-event-desc">
                                    <?php the_content();?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile;?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    <?php
    }

}