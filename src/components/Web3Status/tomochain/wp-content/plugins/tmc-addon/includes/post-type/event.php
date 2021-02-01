<?php
if(!class_exists('TMC_Event')){
    /**
     * 
     */
    class TMC_Event{
        
        function __construct(){
            add_action('init', array($this,'tmc_event'));
            if ( is_admin() ) {
                add_filter( 'manage_tmc_event_posts_columns', array( $this, 'add_columns' ) );
                add_action( 'manage_tmc_event_posts_custom_column', array( $this, 'set_columns_value'), 10, 2);
            }
        }
        function tmc_event(){

            $labels = array(
                'menu_name'          => esc_html__( 'Events', 'tmc' ),
                'singular_name'      => esc_html__( 'Single Event', 'tmc' ),
                'name'               => esc_html__( 'Event', 'tmc' ),
                'add_new'            => esc_html__( 'Add New', 'tmc' ) ,
                'add_new_item'       => esc_html__( 'Add New Event', 'tmc' ) ,
                'edit_item'          => esc_html__( 'Edit Event', 'tmc' ) ,
                'new_item'           => esc_html__( 'Add New Event', 'tmc' ) ,
                'view_item'          => esc_html__( 'View Event', 'tmc' ) ,
                'search_items'       => esc_html__( 'Search Event', 'tmc' ) ,
                'not_found'          => esc_html__( 'No Event items found', 'tmc' ) ,
                'not_found_in_trash' => esc_html__( 'No Event items found in trash', 'tmc' ) ,
                'parent_item_colon'  => ''
            );

            $args = array(
                'labels'                => $labels,
                'description'           => esc_html__( 'Display Event', 'tmc' ),
                'hierarchical'          => false,
                'public'                => true,
                'menu_icon'             => 'dashicons-calendar-alt',
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => false,
                'exclude_from_search'   => false,
                'publicly_queryable'    => false,           
                'capability_type'       => 'post',
                'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
                'rewrite'               => false
            );
            register_post_type( 'tmc_event', $args );

            // Register a taxonomy for Project Categories.
            $category_labels = array(
                'name'                          => esc_html__( 'Event Categories', 'tmc' ) ,
                'singular_name'                 => esc_html__( 'Event Category', 'tmc' ) ,
                'menu_name'                     => esc_html__( 'Event Categories', 'tmc' ) ,
                'all_items'                     => esc_html__( 'All Event Categories', 'tmc' ) ,
                'edit_item'                     => esc_html__( 'Edit Event Category', 'tmc' ) ,
                'view_item'                     => esc_html__( 'View Event Category', 'tmc' ) ,
                'update_item'                   => esc_html__( 'Update Event Category', 'tmc' ) ,
                'add_new_item'                  => esc_html__( 'Add New Event Category', 'tmc' ) ,
                'new_item_name'                 => esc_html__( 'New Event Category Name', 'tmc' ) ,
                'parent_item'                   => esc_html__( 'Parent Event Category', 'tmc' ) ,
                'parent_item_colon'             => esc_html__( 'Parent Event Category:', 'tmc' ) ,
                'search_items'                  => esc_html__( 'Search Event Categories', 'tmc' ) ,
                'popular_items'                 => esc_html__( 'Popular Event Categories', 'tmc' ) ,
                'separate_items_with_commas'    => esc_html__( 'Separate Event Categories with commas', 'tmc' ) ,
                'add_or_remove_items'           => esc_html__( 'Add or remove Event Categories', 'tmc' ) ,
                'choose_from_most_used'         => esc_html__( 'Choose from the most used Event Categories', 'tmc' ) ,
                'not_found'                     => esc_html__( 'No Event Categories found', 'tmc' ) ,
            );

            $category_args = array(
                'labels'            => $category_labels,
                'public'            => false,
                'show_ui'           => true,
                'show_in_nav_menus' => false,
                'show_tagcloud'     => false,
                'show_admin_column' => false,
                'hierarchical'      => true,
                'query_var'         => true,
            );

            register_taxonomy('event_category', array(
                'tmc_event'
            ) , $category_args);

        }
        // Add columns to Event
        function add_columns($columns) {
            unset(
                $columns['cb'],
                $columns['title'],
                $columns['open_date'],
                $columns['date']
            );
            $cols = array_merge(array('cb' => ('')), $columns);
            $cols = array_merge($cols, array('title' => esc_html__( 'Title', 'tmc' )));
            $cols = array_merge($cols, array('open_date' => esc_html__( 'Open Date', 'tmc' )));
            $cols = array_merge($cols, array('date' => esc_html__( 'Date', 'tmc' )));

            return $cols;
        }

        // Set values for columns
        function set_columns_value($column, $post_id) {
            switch ($column) {
                case 'open_date': {
                    $open_date = get_post_meta($post_id, "open_date", true);
                    echo date('d M Y - g:i A',$open_date);
                }
            }
        }
    }
    new TMC_Event();
}