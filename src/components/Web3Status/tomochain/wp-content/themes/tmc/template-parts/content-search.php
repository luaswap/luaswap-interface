<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package st
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(has_post_thumbnail()):?>
		<div class="entry-img">
			<?php tmc_post_thumbnail('post-large-thumb');?>
		</div>
	<?php endif;?>
	<div class="box-content">
		<div class="entry-header">
			<?php
	            the_title('<h3 class="entry-title"><a href="' . get_permalink(). '">', '</a></h3>');?>
			<div class="entry-meta">
				<?php tmc_post_date(); ?>
				<?php tmc_posted_by(); ?>
				
			</div>
		</div>
		<div class="entry-box">
			<?php if(get_the_excerpt()):?>
				<div class="entry-content">
					<?php
						the_excerpt();
					?>
				</div>
			<?php endif;?>
		</div>
	</div><!-- .box-content -->
</article><!-- #post-<?php the_ID(); ?> -->
