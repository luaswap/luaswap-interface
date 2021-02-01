<?php
/**
 * Template Name: Page Sidebar
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package st
 */

get_header();
?>
	
<main id="main" class="site-main">
	<div class="container">
		<div class="row">
			<div class="site-content col-md-9">
			<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
			?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</main><!-- #main -->
<?php
get_footer();
