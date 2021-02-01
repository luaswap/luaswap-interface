<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package st
 */

get_header();
?>

<main id="main" class="site-main">
	<div class="container">
     	<div class="row">
     		<div class="site-content col-md-9">
     			<div class="search-result">
					<?php if ( have_posts() ) : 
						global $wp_query;?>
   						<header class="page-header">
							<h3 class="page-title">
								<?php
								/* translators: %s: search query. */
								printf( __( 'Searched %s results for: %s', 'tmc' ), $wp_query->found_posts,'<span>' . get_search_query() . '</span>' );
								?>
							</h3>
						</header><!-- .page-header -->
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
