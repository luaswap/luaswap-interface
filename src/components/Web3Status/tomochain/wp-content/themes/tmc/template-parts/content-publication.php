<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package st
 */
$classes = 'post-loop';

$excerpt_length = '20';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<div class="inner">
		<?php if(!is_singular()):?>
			<div class="entry-img">
				<?php if(has_post_thumbnail()):
						tmc_post_thumbnail('medium');
					endif;
				?>
			</div>
		<?php endif;?>
		<div class="box-content">
			<div class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
		            the_title('<h3 class="entry-title"><a href="' . get_permalink(). '">', '</a></h3>');
				endif;?>
			</div>
			<div class="entry-box">
				<?php if(is_singular()):?>
					<div class="entry-content">
						<div class="entry-meta">
							<?php 
							tmc_post_date();
							tmc_posted_by();
							tmc_terms('publication_cat');?>
						</div>
						<?php
							the_content();
						?>
					</div>					
				<?php else:?>
					<?php if(get_the_excerpt()):?>
						<div class="entry-content">
							<?php
								echo tmc_excerpt($excerpt_length);
							?>
						</div>
					<?php endif;?>
					<a href="<?php echo get_permalink();?>"><?php echo esc_html__('Read the article','tmc');?></a>
				<?php endif;?>
			</div>
		</div>
	</div>
</article>
