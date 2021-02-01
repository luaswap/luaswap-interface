<?php
if(!function_exists('tmc_report_list')){
	function tmc_report_list(){
		wp_enqueue_style('slick');
		wp_enqueue_script('slick');
		$lists = tmc_get_option('tmc_report_list');
		$show = tmc_get_option('show_report');
		if(!empty($show) && !empty($lists) && is_array($lists)){
			echo '<div class="tmc-top-report">';
			echo '<div class="container">';
			echo '<div class="tmc-report-list reportFade">';
			foreach ($lists as $value) {
				$target_blank = '';
				if(isset($value['target_blank']) && !empty($value['target_blank'])){
					$target_blank = 'target="_blank"';
				}
				?>
				<div class="tmc-report-item">
					<a href="<?php echo esc_url($value['rp_url']);?>" <?php echo $target_blank;?>><?php echo esc_html($value['rp_title']);?></a>
				</div>
			<?php }
			echo '</div>';
			echo '<span class="close"><i class="fas fa-times"></i></span>';
			echo '</div>';
			echo '</div>';
		}
	}
	add_action('tmc_before_site_content','tmc_report_list');
}

if(!function_exists('tmc_related_post')){
	function tmc_related_post($taxonomy = 'category'){
		global $wp_taxonomies;
		$post_type = 'post';
		if ( isset( $wp_taxonomies[ $taxonomy ] ) ) {
		 $post_type = $wp_taxonomies[ $taxonomy ]->object_type[0];
		}
		
		$excerpt_length = 20;
		$terms = wp_get_object_terms( get_the_ID(), $taxonomy, array( 'fields' => 'ids' ) );
		
		if ( is_wp_error( $terms ) || empty( $terms ) ) {
		    return array();
		}
		
		$args = array(
		    'post_type' => $post_type,
		    'post_status' => 'publish',
		    'posts_per_page' => -1,
		    'orderby' => 'post_date',
		    'order'   => 'DESC',
		    'tax_query' => array(
		      	array(
		          	'taxonomy' => $taxonomy,
		          	'field'    => 'id',
		          	'terms' => $terms
		      	)
		  	),
	    	'post__not_in' => array (get_the_ID()),
	    );
		$related_items = new WP_Query( $args );
		?>
		<div class = "tmc-related-post">
		  <h2 class="related-heading"><?php esc_html_e('Related Post','tmc');?></h2>
		    <div class="tmc-related-content">
		      <?php 
		          while ( $related_items->have_posts() ) : $related_items->the_post();
		              $permalink   = get_permalink();
		              $title_post  = get_the_title();
		              ?>
		              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		                <?php if(has_post_thumbnail()):?>
			                <div class="entry-img" style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium')?>);">
			                </div>
			            <?php endif;?>
		                <div class="box-content">
		                  	<div class="entry-header">
		                    	<?php the_title('<h3 class="entry-title"><a href="' . get_permalink(). '">', '</a></h3>');?>
		                  	</div>
		                  	<div class="entry-box">
			                    <?php if(get_the_excerpt()):?>
									<div class="entry-content">
										<?php
											echo tmc_excerpt($excerpt_length);
										?>
									</div>
								<?php endif;?>
								<a href="<?php echo get_permalink();?>"><?php echo esc_html__('Read the article','tmc');?></a>
		                  	</div>
		                </div>
		              </article>
		          <?php
		      endwhile;
		      wp_reset_postdata();
		      ?>
		    </div>
		</div>
	<?php
	}
}

add_action('tmc_enterprise_breadcrumb', 'tmc_get_enterprise_breadcrumb');

if (!function_exists('tmc_get_enterprise_breadcrumb')) {
	function tmc_get_enterprise_breadcrumb() {
		$items       = tmc_enterprise_breadcrumb_item();
		$breadcrumbs = '<ul class="breadcrumbs">';
		$breadcrumbs .= join("", $items);
		$breadcrumbs .= '</ul>';

		echo wp_kses_post($breadcrumbs);
	}
}

if(!function_exists('tmc_enterprise_breadcrumb_item')){
	function tmc_enterprise_breadcrumb_item(){
		global $wp_query;

		$item = array();

		/* Link to front page. */
		if( is_singular('publication') || is_singular('use-case') || is_tax('publication_cat') || is_tax('use-case-cat')){
			$item[] = '<li typeof="v:Breadcrumb"><a property="v:url" property="v:title" href="' . esc_url(home_url('/enterprise/')) . '" class="enterprise">' . esc_html__('Enterprise', 'tmc' ) . '</a></li>';
		}elseif (!is_front_page()) {
			$item[] = '<li typeof="v:Breadcrumb"><a property="v:url" property="v:title" href="' . esc_url(home_url('/')) . '" class="home">' . esc_html__('Home', 'tmc' ) . '</a></li>';
		}

		if (is_home()) {
			$home_page = get_post($wp_query->get_queried_object_id());
			$item = array_merge($item, tmc_breadcrumb_get_parents($home_page->post_parent));
			$item['last'] = get_the_title($home_page->ID);
		} /* If viewing a singular post. */
		elseif (is_singular()) {
			$post = $wp_query->get_queried_object();
			$post_id = (int)$wp_query->get_queried_object_id();
			$post_type = $post->post_type;

			$post_type_object = get_post_type_object($post_type);

			if ('post' === $wp_query->post->post_type) {
				$categories = get_the_category($post_id);
				$item = array_merge($item, tmc_breadcrumb_get_term_parents($categories[0]->term_id, $categories[0]->taxonomy));
			}

			if ('page' !== $wp_query->post->post_type) {

				/* If there's an archive page, add it. */

				if (function_exists('get_post_type_archive_link') && !empty($post_type_object->has_archive))
					$item[] = '<li typeof="v:Breadcrumb"><a property="v:url" property="v:title" href="' . get_post_type_archive_link($post_type) . '" title="' . esc_attr($post_type_object->labels->name) . '">' . $post_type_object->labels->name . '</a></li>';

				if (isset($args["singular_{$wp_query->post->post_type}_taxonomy"]) && is_taxonomy_hierarchical($args["singular_{$wp_query->post->post_type}_taxonomy"])) {
					$terms = wp_get_object_terms($post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"]);
					$item = array_merge($item, tmc_breadcrumb_get_term_parents($terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"]));
				} elseif (isset($args["singular_{$wp_query->post->post_type}_taxonomy"]))
					$item[] = get_the_term_list($post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '');
			}

			if ((is_post_type_hierarchical($wp_query->post->post_type) || 'attachment' === $wp_query->post->post_type) && $parents = tmc_breadcrumb_get_parents($wp_query->post->post_parent)) {
				$item = array_merge($item, $parents);
			}

			$item['last'] = get_the_title();
		} /* If viewing any type of archive. */
		else if (is_archive()) {

			if (is_category() || is_tag() || is_tax()) {

				$term = $wp_query->get_queried_object();
				//$taxonomy = get_taxonomy( $term->taxonomy );

				if ((is_taxonomy_hierarchical($term->taxonomy) && $term->parent) && $parents = tmc_breadcrumb_get_term_parents($term->parent, $term->taxonomy))
					$item = array_merge($item, $parents);

				$item['last'] = $term->name;
			} else if (function_exists('is_post_type_archive') && is_post_type_archive()) {
				$post_type_object = get_post_type_object(get_query_var('post_type'));
				$item['last'] = $post_type_object->labels->name;
			} else if (is_date()) {

				if (is_day())
					$item['last'] = esc_html__('Archives for ', 'tmc' ) . get_the_time('F j, Y');

				elseif (is_month())
					$item['last'] = esc_html__('Archives for ', 'tmc' ) . single_month_title(' ', false);

				elseif (is_year())
					$item['last'] = esc_html__('Archives for ', 'tmc' ) . get_the_time('Y');
			} else if (is_author())
				$item['last'] = esc_html__('Archives by: ', 'tmc' ) . get_the_author_meta('display_name', $wp_query->post->post_author);

		} /* If viewing search results. */
		else if (is_search())
			$item['last'] = esc_html__('Search results for "', 'tmc' ) . stripslashes(strip_tags(get_search_query())) . '"';

		/* If viewing a 404 error page. */
		else if (is_404())
			$item['last'] = esc_html__('Page Not Found', 'tmc' );

		if (isset($item['last'])) {
			$item['last'] = sprintf('<li><span>%s</span></li>', $item['last']);
		}

		return apply_filters('tmc_breadcrumb_items', $item);
	}
}

if (!function_exists('tmc_breadcrumb_get_parents')) {
	function tmc_breadcrumb_get_parents($post_id = '', $separator = '/') {
		$parents = array();

		if ($post_id == 0) {
			return $parents;
		}

		while ($post_id) {
			$page      = get_post($post_id);
			$parents[] = '<li typeof="v:Breadcrumb"><a property="v:url" property="v:title" href="' . get_permalink($post_id) . '" title="' . esc_attr(get_the_title($post_id)) . '">' . get_the_title($post_id) . '</a></li>';
			$post_id   = $page->post_parent;
		}

		if ($parents) {
			$parents = array_reverse($parents);
		}

		return $parents;
	}
}

if (!function_exists('tmc_breadcrumb_get_term_parents')) {
	function tmc_breadcrumb_get_term_parents($parent_id = '', $taxonomy = '', $separator = '/') {
		$parents = array();

		if (empty($parent_id) || empty($taxonomy)) {
			return $parents;
		}

		while ($parent_id) {
			$parent = get_term($parent_id, $taxonomy);
			$parents[] = '<li typeof="v:Breadcrumb"><a property="v:url" property="v:title" href="' . get_term_link($parent, $taxonomy) . '" title="' . esc_attr($parent->name) . '">' . $parent->name . '</a></li>';
			$parent_id = $parent->parent;
		}

		if ($parents) {
			$parents = array_reverse($parents);
		}

		return $parents;
	}
}