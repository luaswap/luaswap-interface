<?php
$wp_the_query   = $GLOBALS['wp_the_query'];
$on_front           = get_option('show_on_front');

if ( ! have_posts() ) {
    $page_title = esc_html__( 'Nothing Found', 'tmc');
} elseif ( is_home() ) {
    if ( ($on_front == 'page' && get_queried_object_id() == get_post(get_option('page_for_posts'))->ID) || ($on_front == 'posts') ) {
        $page_title = esc_html__('Blog', 'tmc');
    }
}elseif ( is_singular('post') ) {
    $page_title = esc_html__( 'Blog','tmc' );
} elseif (is_category()) {
    $page_title = single_cat_title( '', false );
} elseif (is_tag()) {
    $page_title       = single_tag_title(esc_html__( 'Tags: ', 'tmc'), false);
} elseif (is_tax('publication_cat') || is_tax('use-case-cat')) {

    $page_title       = get_queried_object()->name;
} elseif (is_search()) {
    $page_title       = sprintf(esc_html__( 'Search results for: %s', 'tmc'), get_search_query());
} elseif (is_author()) {
    $page_title = sprintf(esc_html__('Author: %s', 'tmc'), get_the_author());
} elseif (is_day()) {
    $page_title = sprintf(esc_html__('Daily Archives: %s', 'tmc'), get_the_date());
} elseif (is_month()) {
    $page_title = sprintf(esc_html__('Monthly Archives: %s', 'tmc'), get_the_date(_x('F Y', 'monthly archives date format', 'tmc')));
} elseif (is_year()) {
    $page_title = sprintf(esc_html__('Yearly Archives: %s', 'tmc'), get_the_date(_x('Y', 'yearly archives date format', 'tmc')));
}elseif(is_singular()){
    $page_title       = get_the_title();
}elseif ( is_post_type_archive() ) {

    $post_type        = $wp_the_query->query_vars['post_type'];
    $post_type_object = get_post_type_object( $post_type );

    $page_title = $post_type_object->labels->singular_name;

}else{
    $page_title       = esc_html__( 'Archive Page','tmc' );
}
?>
<div class="tmc-page-title">
    <div class="container">
        <div class="tmc-page-inner">
            <h2><?php echo esc_html($page_title);?></h2>
        </div>
    </div>
</div>
<div class="tmc-breadcrumb-wrap">
    <div class="container">
        <?php do_action('tmc_enterprise_breadcrumb');?>
    </div>
</div>
