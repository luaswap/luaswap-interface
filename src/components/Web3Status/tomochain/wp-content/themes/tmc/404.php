<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package st
 */

get_header();
$home_url = get_home_url();

if (function_exists('pll_home_url')) {
    $home_url = pll_home_url();
}
?>

	<div id="primary" class="content-area">
        <section class="error-404 not-found">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <img src="<?php echo esc_url(TMC_THEME_URI . '/assets/images/404.png'); ?>" alt="404">
                        <p><?php esc_html_e('Page not found', 'tmc'); ?></p>
                        <a href="<?php echo esc_url($home_url); ?>" class="tmc-button"><span><?php esc_html_e('Go Home', 'tmc') ?></span></a>
                    </div>
                </div>
            </div>
        </section><!-- .error-404 -->
	</div><!-- #primary -->

<?php
get_footer();
