<?php
/**
 * Elementor Post Layout Widget.
 * @since 1.0.0
 */
namespace TMC_Elementor_Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class Post_Layout extends Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'tmc-post-layout';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return esc_html__( 'TMC Post Layout', 'tmc' );
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'fa fa-newspaper-o';
	}

	/**
	 * Get widget categories.
	 */
	public function get_categories() {
		return [ 'tmc-element-widgets' ];
	}
	/*
	* Depend Style
	*/
	public function get_style_depends() {
        return [
            'slick',
        ];
    }
	/*
	* Depend Script
	*/
	public function get_script_depends() {
        return [
            'slick',
            'tmc-addon',
        ];
    }
	/**
	 * Get categories.
	 */
	private function get_post_type_categories( $taxonomy = 'category' ) {
		$options = array();
		if ( ! empty( $taxonomy ) ) {
			// Get categories for post type.
			$terms = get_terms(
				array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => true,
				)
			);
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( isset( $term ) ) {
						if ( isset( $term->slug ) && isset( $term->name ) ) {
							$options[ $term->slug ] = $term->name;
						}
					}
				}
			}
		}

		return $options;
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Tab Content
		$this->tmc_post_layout_option();
		$this->tmc_post_layout_content();
	}

	/*
	* Recent New Option
	*/
	private function tmc_post_layout_option(){
		$this->start_controls_section(
			'tmc_post_layout_section',
			[
				'label' => esc_html__( 'General Options', 'tmc' )
			]
		);
		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Layout', 'tmc' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> array(
					'grid' 		=> esc_html__( 'Grid', 'tmc' ),
					'slider' 	=> esc_html__( 'Slider', 'tmc' ),
				),
				'default' 	=> 'grid',
			]
		);
		$this->add_control(
			'post_category',
			[
				'label' 	=> esc_html__( 'Category', 'tmc' ),
				'type' 		=> Controls_Manager::SELECT2,
				'multiple' 	=> true,
				'options' 	=> $this->get_post_type_categories('category'),
			]
		);
		// Columns.
		$this->add_responsive_control(
			'columns',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => '<i class="fa fa-columns"></i> ' . esc_html__( 'Columns', 'tmc' ),
				'default'        => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'options'        => [
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
				]
			]
		);
		// Order by.
		$this->add_control(
			'order_by',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => '<i class="fa fa-sort"></i> ' . esc_html__( 'Order by', 'tmc' ),
				'default' => 'date',
				'options' => [
					'date'          => esc_html__( 'Date', 'tmc' ),
					'title'         => esc_html__( 'Title', 'tmc' ),
					'modified'      => esc_html__( 'Modified date', 'tmc' ),
					'comment_count' => esc_html__( 'Comment count', 'tmc' ),
					'rand'          => esc_html__( 'Random', 'tmc' ),
				],
			]
		);
		// Order by.
		$this->add_control(
			'order',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => '<i class="fa fa-sort"></i> ' . esc_html__( 'Sort by', 'tmc' ),
				'default' => 'desc',
				'options' => [
					'asc'         => esc_html__( 'ASC', 'tmc' ),
					'desc'          => esc_html__( 'DESC', 'tmc' ),
				],
			]
		);
		$this->add_control(
			'post_per_page',
			[
				'label' => esc_html__( 'Post Per Page', 'tmc' ),
				'type' => Controls_Manager::NUMBER,
				'placeholder' => esc_html__( '8', 'tmc' ),
				'description' => esc_html__( '-1 = Get all post.', 'tmc' ),
				'default'     => 8,
			]
		);
		// Read more button hide.
		$this->add_control(
			'grid_pagination',
			[
				'label'     =>  esc_html__( 'Pagination', 'tmc' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'style' => ['grid'],
				]
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Loop', 'tmc' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'tmc' ),
				'label_on' => esc_html__( 'On', 'tmc' ),
				'separator' => 'before',
				'default'   => 'yes',
				'condition' => [
					'style' => 'slider',
				]
			]
		);
		$this->add_control(
			'item_center',
			[
				'label' => esc_html__( 'Item Center', 'tmc' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'tmc' ),
				'label_on' => esc_html__( 'On', 'tmc' ),
				'separator' => 'before',
				'default'   => 'yes',
				'condition' => [
					'style' => 'slider',
				]
			]
		);
		$this->add_control(
			'auto_play',
			[
				'label' => esc_html__( 'Auto Play', 'tmc' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'tmc' ),
				'label_on' => esc_html__( 'On', 'tmc' ),
				'separator' => 'before',
				'default'   => 'yes',
				'condition' => [
					'style' => 'slider',
				]
			]
		);
        $this->add_control(
            'auto_height',
            [
                'label' => esc_html__('Auto Height', 'tmc'),
                'type'     => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tmc'),
                'label_of' => esc_html__('No', 'tmc'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
					'style' => 'slider',
				]
            ]
        );
		$this->add_control(
			'show_nav',
			[
				'label' => esc_html__( 'Show Navigation', 'tmc' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'tmc' ),
				'label_on' => esc_html__( 'On', 'tmc' ),
				'separator' => 'before',
				'default'   => 'yes',
				'condition' => [
					'style' => 'slider',
				]
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Content > Content Options.
	 */
	private function tmc_post_layout_content() {
		$this->start_controls_section(
			'tmc_post_layout_content',
			[
				'label' => esc_html__( 'Content', 'tmc' ),
			]
		);

		// Length.
		$this->add_control(
			'excerpt_length',
			[
				'type'        => Controls_Manager::NUMBER,
				'label'       => '<i class="fa fa-arrows-h"></i> ' . esc_html__( 'Excerpt Length (words)', 'tmc' ),
				'placeholder' => esc_html__( 'Length of content (words)', 'tmc' ),
				'default'     => 15,
			]
		);

		// Read more button hide.
		$this->add_control(
			'tmc_post_layout_btn',
			[
				'label'     => '<i class="fa fa-check-square"></i> ' . esc_html__( 'Button', 'tmc' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);

		// Default button text.
		$this->add_control(
			'tmc_post_layout_btn_text',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Button text', 'tmc' ),
				'placeholder' => esc_html__( 'Read more', 'tmc' ),
				'default'     => esc_html__( 'Read more', 'tmc' ),
				'condition'   => [
					'tmc_post_layout_btn!'    => '',
				],
			]
		);

		$this->end_controls_section();
	}
	/**
	 * Render TMC Post Layout widget output on the frontend.
	 */
	protected function render() {

		// Get settings.
		$settings = $this->get_settings();
		$item_class = $data_slide = $grid_class = '';
		$mobile_class = ( ! empty( $settings['columns_mobile'] ) ? ' tmc-mobile-' . $settings['columns_mobile'] : '' );
		$tablet_class = ( ! empty( $settings['columns_tablet'] ) ? ' tmc-tablet-' . $settings['columns_tablet'] : '' );
		$desktop_class = ( ! empty( $settings['columns'] ) ? ' tmc-desktop-' . $settings['columns'] : '' );
		// $no_thumbnail = !has_post_thumbnail() ? ' no-post-thumbnail' : ' has-post_thumbnail';
		// $grid_class = $no_thumbnail;
		$style = $settings['style'];
		if('grid' == $style){
			$grid_class = 'tmc-grid-col'.$desktop_class . $tablet_class . $mobile_class;
			$item_class = 'tmc-grid-item';
		}elseif('slider' == $style){
			$grid_class = 'post-slick';
			$auto_play = $settings['auto_play'] == 'yes' ? true : false;
			$loop 	= $settings['loop'] == 'yes' ? true : false;
			$show_nav = $settings['show_nav'] == 'yes' ? true : false;
			$auto_height = $settings['auto_height'] == 'yes' ? true : false;
			$item_center = $settings['item_center'] == 'yes' ? true : false;
			$data_slide = array(
				'items' 	=> $settings['columns'],
				'center'	=> $item_center,
				'loop'		=> $loop,
				'autoplay'  => $auto_play,
				'autoheight'=> $auto_height,
				'show_nav'  => $show_nav,
			);
			$data_slide = 'data-slide="'.esc_attr(json_encode($data_slide) ). '"';
		}
		// Arguments for query.
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,

		);
		// Display posts in category.
		if ( ! empty( $settings['post_category'] )) {
			$cat_name = implode(',', $settings['post_category']);
			$args['category_name'] = $cat_name;
		}

		// Items to display.
		$args['posts_per_page'] = $settings['post_per_page'];

		// Order by.
		if ( ! empty( $settings['order_by'] ) ) {
			$args['orderby'] = $settings['order_by'];
		}
		// Order.
		if ( ! empty( $settings['order'] ) ) {
			$args['order'] = $settings['order'];
		}

		// Pagination.
		if ( ! empty( $settings['grid_pagination'] ) ) {
			$paged         = get_query_var( 'paged' );
			if ( empty( $paged ) ) {
				$paged         = get_query_var( 'page' );
			}
			$args['paged'] = $paged;
		}
		// Query.
		$query = new \WP_Query( $args );
		// Output.
		echo '<div class="tmc-post-layout-widget ' . $style . '">';
		echo '<div class="' . $grid_class . '" '. $data_slide .'>';
		// Query results.
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<div class="tmc-pl-item-wrap '.$item_class.'">';
				echo '<article class="tmc-pl-item">';
				// Image.
				$this->renderImage();

				echo '<div class="tmc-pl-content">';
				// Title.
				$this->renderTitle();

				// Content.
				$this->renderContent();

				// Button.
				$this->renderButton();
				echo '</div><!-- .tmc-pl-content -->';
				echo '</article>';
				echo '</div><!-- .tmc-pl-item-wrap -->';

			} // End while().

			// Pagination.
			if ( ! empty( $settings['grid_pagination'] && 'slider' !== $settings['style']) ) { ?>
				<div class="tmc-pagination">
					<?php
					$big           = 999999999;
					$totalpages    = $query->max_num_pages;
					$current       = max( 1, $paged );
					$paginate_args = array(
						'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'    => '?paged=%#%',
						'current'   => $current,
						'total'     => $totalpages,
						'show_all'  => false,
						'end_size'  => 1,
						'mid_size'  => 3,
						'prev_next' => true,
						'prev_text' => esc_html__( 'Previous', 'tmc' ),
						'next_text' => esc_html__( 'Next', 'tmc' ),
						'type'      => 'plain',
						'add_args'  => false,
					);

					$pagination = paginate_links( $paginate_args ); ?>
					<nav class="pagination">
						<?php echo $pagination; ?>
					</nav>
				</div>
				<?php
			}
		} // End if().

		// Restore original data.
		wp_reset_postdata();

		echo '</div><!-- . tmc-pl-element -->';
		if('slider' == $style && $show_nav == true){
			echo '<ul class="slick-nav">';
			echo '<li class="tmc-prev"><i class="fas fa-angle-left"></i></li>';
			echo '<li class="tmc-next"><i class="fas fa-angle-right"></i></li>';
			echo '</ul>';
		}
		echo '</div><!-- .tmc-post-layout-widget -->';

	}
	/**
	 * Render image.
	 */
	protected function renderImage() {
		$settings = $this->get_settings();

		// Check if post type has featured image.
		if ( has_post_thumbnail() ) {?>
				<div class="tmc-featured-img">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php
						the_post_thumbnail(
							'400x300', array(
								'class' => 'img-responsive',
								'alt'   => get_the_title( get_post_thumbnail_id() ),
							)
						); ?>
					</a>
				</div>
		<?php 
		}
	}
	/**
	 * Render title.
	 */
	protected function renderTitle() {
		$settings = $this->get_settings();?>

		<h3 class="tmc-pl-title mt5">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<?php
	}

	/**
	 * Render content
	 */
	protected function renderContent() {
		$settings = $this->get_settings();?>
		<div class="tmc-pl-desc">
			<p>
				<?php
				if ( empty( $settings['excerpt_length'] ) ) {
					the_excerpt();
				} else {
					echo wp_trim_words( get_the_excerpt(), $settings['excerpt_length'] );
				}
				?>
			</p>
		</div>
		<?php
	}
	/**
	 * Render button
	 */
	protected function renderButton() {
		$settings = $this->get_settings();
		if( $settings['tmc_post_layout_btn'] == 'yes' && ! empty( $settings['tmc_post_layout_btn'] ) ) { 

			?>
			<div class="tmc-pl-footer">
				<a class="read-more" href="<?php echo get_the_permalink(); ?>"
				   title="<?php echo $settings['tmc_post_layout_btn_text']; ?>"><?php echo $settings['tmc_post_layout_btn_text']; ?></a>
			</div>	
		<?php
		}
	}

}