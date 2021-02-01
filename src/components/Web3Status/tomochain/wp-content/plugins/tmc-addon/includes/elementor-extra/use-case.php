<?php
/**
 * Elementor Post Layout Widget.
 * @since 1.0.0
 */
namespace TMC_Elementor_Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class Use_Case extends Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'tmc-usecase';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return esc_html__( 'TMC UseCase', 'tmc' );
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
		$this->tmc_usecase_option();
		$this->tmc_usecase_content();
	}

	/*
	* Recent New Option
	*/
	private function tmc_usecase_option(){
		$this->start_controls_section(
			'tmc_usecase_section',
			[
				'label' => esc_html__( 'General Options', 'tmc' )
			]
		);

		$this->add_control(
			'post_category',
			[
				'label' 	=> esc_html__( 'Category', 'tmc' ),
				'type' 		=> Controls_Manager::SELECT2,
				'multiple' 	=> true,
				'options' 	=> $this->get_post_type_categories('use-case-cat'),
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
		
		$this->end_controls_section();
	}

	/**
	 * Content > Content Options.
	 */
	private function tmc_usecase_content() {
		$this->start_controls_section(
			'tmc_usecase_content',
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

		// Default button text.
		$this->add_control(
			'tmc_btn_text',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Button text', 'tmc' ),
				'placeholder' => esc_html__( 'Read more', 'tmc' ),
				'default'     => esc_html__( 'Read more', 'tmc' ),
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

		$btn_text = $settings['tmc_btn_text'];

		// Arguments for query.
		$args = array(
			'post_type' => 'use-case',
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,

		);
		// Display posts in category.
		if ( ! empty( $settings['post_category'] )) {
			$args['tax_query'] = array(
		        array(
		            'taxonomy' => 'use-case-cat',
		            'field'    => 'slug',
		            'terms'    => $settings['post_category'],
		        )
		    );
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

		$query = new \WP_Query( $args );?>

		<div class="tmc-usecase-widget">
			<div class="tmc-usecase-content">
				<?php
				if ( $query->have_posts() ):
					while ( $query->have_posts() ):
						$query->the_post();?>
						<div class="post-item">
							<div class="post-featured" style="background-image: url(<?php echo get_the_post_thumbnail_url();?>)"></div>
							<div class="post-content">
								<h3 class="post-title"><a href="<?php echo get_permalink()?>"><?php the_title();?></a></h3>
								<p class="post-desc">
									<?php 
										if ( empty( $settings['excerpt_length'] ) ) {
											the_excerpt();
										} else {
											echo wp_trim_words( get_the_excerpt(), $settings['excerpt_length'] );
										}
									?>
								</p>
								<a href="<?php echo get_permalink()?>"><?php echo esc_html($btn_text);?></a>
							</div>
							
						</div>
					<?php endwhile;?>
				<?php endif;?>
			</div>
		</div>
<?php }
}