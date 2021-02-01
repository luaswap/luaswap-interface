<?php
if(!class_exists('TMC_Roadmap')){
    /**
     * 
     */
    class TMC_Roadmap{
        
        function __construct(){
            add_action('init', array($this,'tmc_roadmap'));            
        }
        function tmc_roadmap(){

            $labels = array(
                'menu_name'          => esc_html__( 'Roadmaps', 'tmc' ),
                'singular_name'      => esc_html__( 'Single Roadmap', 'tmc' ),
                'name'               => esc_html__( 'Roadmap', 'tmc' ),
                'add_new'            => esc_html__( 'Add New', 'tmc' ) ,
                'add_new_item'       => esc_html__( 'Add New Roadmap', 'tmc' ) ,
                'edit_item'          => esc_html__( 'Edit Roadmap', 'tmc' ) ,
                'new_item'           => esc_html__( 'Add New Roadmap', 'tmc' ) ,
                'view_item'          => esc_html__( 'View Roadmap', 'tmc' ) ,
                'search_items'       => esc_html__( 'Search Roadmap', 'tmc' ) ,
                'not_found'          => esc_html__( 'No Roadmap items found', 'tmc' ) ,
                'not_found_in_trash' => esc_html__( 'No Roadmap items found in trash', 'tmc' ) ,
                'parent_item_colon'  => ''
            );

            $args = array(
                'labels'                => $labels,
                'description'           => esc_html__( 'Display Roadmap', 'tmc' ),
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
                'supports'              => array( 'title', 'editor'),
                'rewrite'               => false
            );
            register_post_type( 'tmc_roadmap', $args );

            // Register a taxonomy for Project Categories.
            $category_labels = array(
                'name'                          => esc_html__( 'Roadmap Categories', 'tmc' ) ,
                'singular_name'                 => esc_html__( 'Roadmap Category', 'tmc' ) ,
                'menu_name'                     => esc_html__( 'Roadmap Categories', 'tmc' ) ,
                'all_items'                     => esc_html__( 'All Roadmap Categories', 'tmc' ) ,
                'edit_item'                     => esc_html__( 'Edit Roadmap Category', 'tmc' ) ,
                'view_item'                     => esc_html__( 'View Roadmap Category', 'tmc' ) ,
                'update_item'                   => esc_html__( 'Update Roadmap Category', 'tmc' ) ,
                'add_new_item'                  => esc_html__( 'Add New Roadmap Category', 'tmc' ) ,
                'new_item_name'                 => esc_html__( 'New Roadmap Category Name', 'tmc' ) ,
                'parent_item'                   => esc_html__( 'Parent Roadmap Category', 'tmc' ) ,
                'parent_item_colon'             => esc_html__( 'Parent Roadmap Category:', 'tmc' ) ,
                'search_items'                  => esc_html__( 'Search Roadmap Categories', 'tmc' ) ,
                'popular_items'                 => esc_html__( 'Popular Roadmap Categories', 'tmc' ) ,
                'separate_items_with_commas'    => esc_html__( 'Separate Roadmap Categories with commas', 'tmc' ) ,
                'add_or_remove_items'           => esc_html__( 'Add or remove Roadmap Categories', 'tmc' ) ,
                'choose_from_most_used'         => esc_html__( 'Choose from the most used Roadmap Categories', 'tmc' ) ,
                'not_found'                     => esc_html__( 'No Roadmap Categories found', 'tmc' ) ,
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

            register_taxonomy('roadmap_cat', array(
                'tmc_roadmap'
            ) , $category_args);

        }
    }
    new TMC_Roadmap();
}