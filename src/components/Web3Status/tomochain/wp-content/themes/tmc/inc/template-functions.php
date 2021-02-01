<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package tmc
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tmc_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    if ( function_exists('get_field') && get_field('custom_css_class') ) {
        $classes[] = get_field('custom_css_class');
    }

    return $classes;
}
add_filter( 'body_class', 'tmc_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function tmc_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'tmc_pingback_header' );

/*
* Breadcrumd
*/
function tmc_breadcrumbs(){
    // Set variables for later use
    // $here_text        = __( 'You are currently here!' );
    $home_link        = home_url('/');
    $home_text        = __( 'Home' );
    $link_before      = '<span typeof="v:Breadcrumb">';
    $link_after       = '</span>';
    $link_attr        = ' rel="v:url" property="v:title"';
    $link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $delimiter        = ' / ';              // Delimiter between crumbs &raquo;
    $before           = '<span class="current-item">'; // Tag before the current crumb
    $after            = '</span>';                // Tag after the current crumb
    $page_addon       = '';                       // Adds the page number if the query is paged
    $breadcrumb_trail = '';
    $category_links   = '';

    /** 
     * Set our own $wp_the_query variable. Do not use the global variable version due to 
     * reliability
     */
    $wp_the_query   = $GLOBALS['wp_the_query'];
    $queried_object = $wp_the_query->get_queried_object();

    // Handle single post requests which includes single pages, posts and attatchments
    if ( is_singular() ) 
    {
        /** 
         * Set our own $post variable. Do not use the global variable version due to 
         * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
         */
        $post_object = sanitize_post( $queried_object );

        // Set variables 
        $title          = apply_filters( 'the_title', $post_object->post_title );
        $parent         = $post_object->post_parent;
        $post_type      = $post_object->post_type;
        $post_id        = $post_object->ID;
        $post_link      = $before . $title . $after;
        $parent_string  = '';
        $post_type_link = '';

        if ( 'post' === $post_type ) 
        {
            // Get the post categories
            $categories = get_the_category( $post_id );
            if ( $categories ) {
                // Lets grab the first category
                $category  = $categories[0];

                $category_links = get_category_parents( $category, true, $delimiter );
                $category_links = str_replace( '<a',   $link_before . '<a' . $link_attr, $category_links );
                $category_links = str_replace( '</a>', '</a>' . $link_after,             $category_links );
            }
        }

        if ( !in_array( $post_type, ['post', 'page', 'attachment'] ) )
        {
            $post_type_object = get_post_type_object( $post_type );
            $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );

            $post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->singular_name );
        }

        // Get post parents if $parent !== 0
        if ( 0 !== $parent ) 
        {
            $parent_links = [];
            while ( $parent ) {
                $post_parent = get_post( $parent );

                $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

                $parent = $post_parent->post_parent;
            }

            $parent_links = array_reverse( $parent_links );

            $parent_string = implode( $delimiter, $parent_links );
        }

        // Lets build the breadcrumb trail
        if ( $parent_string ) {
            $breadcrumb_trail = $parent_string . $delimiter . $post_link;
        } else {
            $breadcrumb_trail = $post_link;
        }

        if ( $post_type_link )
            $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;

        if ( $category_links )
            $breadcrumb_trail = $category_links . $breadcrumb_trail;
    }

    // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
    if( is_archive() )
    {
        if (    is_category()
             || is_tag()
             || is_tax()
        ) {
            // Set the variables for this section
            $term_object        = get_term( $queried_object );
            $taxonomy           = $term_object->taxonomy;
            $term_id            = $term_object->term_id;
            $term_name          = $term_object->name;
            $term_parent        = $term_object->parent;
            $taxonomy_object    = get_taxonomy( $taxonomy );
            $current_term_link  = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
            $parent_term_string = '';

            if ( 0 !== $term_parent )
            {
                // Get all the current term ancestors
                $parent_term_links = [];
                while ( $term_parent ) {
                    $term = get_term( $term_parent, $taxonomy );

                    $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

                    $term_parent = $term->parent;
                }

                $parent_term_links  = array_reverse( $parent_term_links );
                $parent_term_string = implode( $delimiter, $parent_term_links );
            }

            if ( $parent_term_string ) {
                $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
            } else {
                $breadcrumb_trail = $current_term_link;
            }

        } elseif ( is_author() ) {

            $breadcrumb_trail = __( 'Author archive for ') .  $before . $queried_object->data->display_name . $after;

        } elseif ( is_date() ) {
            // Set default variables
            $year     = $wp_the_query->query_vars['year'];
            $monthnum = $wp_the_query->query_vars['monthnum'];
            $day      = $wp_the_query->query_vars['day'];

            // Get the month name if $monthnum has a value
            if ( $monthnum ) {
                $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                $month_name = $date_time->format( 'F' );
            }

            if ( is_year() ) {

                $breadcrumb_trail = $before . $year . $after;

            } elseif( is_month() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );

                $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

            } elseif( is_day() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
                $month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

                $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
            }

        } elseif ( is_post_type_archive() ) {

            $post_type        = $wp_the_query->query_vars['post_type'];
            $post_type_object = get_post_type_object( $post_type );

            $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;

        }
    }   

    // Handle the search page
    if ( is_search() ) {
        $breadcrumb_trail = __( 'Search query for: ' ) . $before . get_search_query() . $after;
    }

    // Handle 404's
    if ( is_404() ) {
        $breadcrumb_trail = $before . __( 'Error 404' ) . $after;
    }

    // Handle paged pages
    if ( is_paged() ) {
        $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
        $page_addon   = $before . sprintf( __( ' ( Page %s )' ), number_format_i18n( $current_page ) ) . $after;
    }

    $breadcrumb_output_link  = '';
    $breadcrumb_output_link .= '<div class="breadcrumb">';
    if (    is_home()
         || is_front_page()
    ) {
        // Do not show breadcrumbs on page one of home and frontpage
        if ( is_paged() ) {
            // $breadcrumb_output_link .= $here_text . $delimiter;
            $breadcrumb_output_link .= '<a href="' . $home_link . '">' . $home_text . '</a>';
            $breadcrumb_output_link .= $page_addon;
        }
    } else {
        // $breadcrumb_output_link .= $here_text . $delimiter;
        $breadcrumb_output_link .= '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
        $breadcrumb_output_link .= $delimiter;
        $breadcrumb_output_link .= $breadcrumb_trail;
        $breadcrumb_output_link .= $page_addon;
    }
    $breadcrumb_output_link .= '</div><!-- .breadcrumbs -->';

    return $breadcrumb_output_link;
}

/**
 * Mobile menu button
 */
function tmc_mobile_menu_btn() {
    ob_start();
?>
    <div class="mobile-menu-btn hidden-lg-up">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600">
            <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
            <path d="M300,320 L540,320" id="middle"></path>
            <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
        </svg>
    </div>
<?php
    echo ob_get_clean();
}

function tmc_excerpt($limit) {
    $excerpt = wp_trim_words( get_the_excerpt(), $limit );
    $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

    return '<p>' . $excerpt . '</p>';
}

function tmc_pagination($wp_query = null) {
    if($wp_query == null){
        global $wp_query;
    }
    global$wp_rewrite;

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = wp_kses_post( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
            $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format = $wp_rewrite->using_index_permalinks() && ! tmcrpos( $pagenum_link,
        'index.php' ) ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%',
        'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links                      = paginate_links( array(
        'base'      => $pagenum_link,
        'format'    => $format,
        'total'     => $wp_query->max_num_pages,
        'current'   => $paged,
        'add_args'  => array_map( 'urlencode', $query_args ),
        'prev_text' => '<i class="fas fa-angle-left"></i>',
        'next_text' => '<i class="fas fa-angle-right"></i>',
        'type'      => 'list',
        'end_size'  => 3,
        'mid_size'  => 3,
    ) );

    if ( $links ) : ?>
        <div class="tmc-pagination posts-pagination">
            <?php echo wp_kses_post( $links ); ?>
        </div><!-- .pagination -->
    <?php
    endif;
}

if ( !function_exists('tmc_page_title') ) {
    function tmc_page_title(){
        $page_heading = '';
        if(is_page()){
            $page_heading = get_post_meta(get_the_ID(),'hide_page_heading',true);
        }
        if(empty($page_heading)){
            get_template_part( 'template-parts/page-title' );
        }
        
    }
    add_action('tmc_page_title', 'tmc_page_title', 5);
}
if ( !function_exists('tmc_comment_textarea_placeholder') ) {
    function tmc_comment_textarea_placeholder( $args ) {
        $comment = esc_html__('Comment','tmc');
        $args['comment_field']        = str_replace( 'textarea', 'textarea placeholder="'. $comment .'"', $args['comment_field'] );
        return $args;
    }
    add_filter( 'comment_form_defaults', 'tmc_comment_textarea_placeholder' );
}
/**
 * Comment Form Fields Placeholder
 *
 */
if ( !function_exists('tmc_comment_form_fields') ) {
    function tmc_comment_form_fields( $fields ) {
        $name = esc_html__('Name*','tmc');
        $email = esc_html__('Email*','tmc');
        $website = esc_html__('Website*','tmc');
        foreach( $fields as &$field ) {
            $field = str_replace( 'id="author"', 'id="author" placeholder="'. $name .'"', $field );
            $field = str_replace( 'id="email"', 'id="email" placeholder="'. $email .'"', $field );
            $field = str_replace( 'id="url"', 'id="url" placeholder="'. $website .'"', $field );
        }
        return $fields;
    }
    add_filter( 'comment_form_default_fields', 'tmc_comment_form_fields' );
}

/* Render Comments */
if (!function_exists('tmc_render_comments')) {
    function tmc_render_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
                <?php echo get_avatar($comment, $args['avatar_size']); ?>
                <div class="comment-text">
                    <div class="author">
                        <span class="author-name"><?php printf(esc_html__('%s', 'tmc'), get_comment_author_link()) ?></span>
                        <span class="comment-meta-date">
                           <span class="time">
                                <?php echo sprintf(esc_html__('%1$s ago', 'tmc') ,human_time_diff(get_comment_date('U'), current_time( 'timestamp' ))); ?>
                            </span>
                        </span>
                    </div>
                    <div class="text">
                        <?php comment_text(); ?>
                        <?php if ($comment->comment_approved == '0') : ?>
                            <em><?php esc_html_e('Your comment is awaiting moderation.', 'tmc') ?></em>
                        <?php endif; ?>
                    </div>
                    <div class="comment-meta">
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        <?php edit_comment_link(esc_html__('Edit', 'tmc'), '', '') ?>
                    </div>
                </div>
            </div>
    <?php
    }
}
if(!function_exists('tmc_search_icon_nav')){
    function tmc_search_icon_nav(){?>
        <div class="search-icon">
            <a class="icon-search-menu" href="#"><i class="fas fa-search"></i></a>
            <div class="sub-menu seach-form">
                <form action="<?php echo esc_url(home_url('/'));?>" method="GET">
                    <input type="text" name="s" placeholder="<?php esc_html_e( 'Tìm Kiếm', 'tmc' ); ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
<?php }
}
