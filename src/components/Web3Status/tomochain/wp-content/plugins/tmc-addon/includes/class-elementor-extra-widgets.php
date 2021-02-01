<?php
/**
 * Class TMC_Elementor_Widgets
 *
 * @package     TMC_Elementor_Widgets
 * @copyright   Copyright (c) 2019, Tomochain
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */
if(!class_exists('TMC_Elementor_Widgets')){
	class TMC_Elementor_Widgets {
		/**
		 * @var TMC_Elementor_Widgets
		 */
		public static $instance = null;

		/**
		 * The version of file
		 * @var string
		 */
		public static $version = '1.0.0';

		/**
		 * Add elementor widget
		 */
		protected function init() {
			// Add category for Tomochain Widget Addon
			add_action( 'elementor/init', array( $this, 'add_elementor_category' ),9 );
			// Register Widget
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'add_elementor_widgets' ) );
			// Register Style
            add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_frontend_styles' ), 10 );
            // Register Script
            add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_frontend_scripts' ), 10 );
            // Load Style for Editor of Elementor
            //this was the missing part.
			add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_preview_styles'));
			
		}

		public function register_frontend_styles() {
			wp_register_style( 'slick',
				TMC_ADDON_ASSETS. '/vendor/slick/slick.css',
				array(),
				null
			);
			// wp_register_style( 'swiper',
			// 	TMC_ADDON_ASSETS. '/vendor/swiper/swiper.min.css',
			// 	array(),
			// 	null
			// );
		}
		public function register_frontend_scripts() {
			wp_register_script( 'slick',
				TMC_ADDON_ASSETS. '/vendor/slick/slick.min.js',
				array('jquery'),
				null,
				true
			);
			wp_register_script( 'swiper',
				TMC_ADDON_ASSETS. '/vendor/swiper/swiper.min.js',
				array('jquery'),
				null,
				true
			);
			wp_register_script( 'jquery-coundown',
				TMC_ADDON_ASSETS. '/vendor/countdown/jquery.countdown.min.js',
				array('jquery'),
				null,
				true
			);
			wp_register_script( 'tmc-addon',
				TMC_ADDON_ASSETS. '/js/tmc-addon.js',
				array('jquery'),
				null,
				true
			);
			wp_localize_script( 'tmc-addon',
				'tmcAddon',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' )
				)
			);
		}
		// 
		public function enqueue_preview_styles(){
			wp_enqueue_style('slick');
			wp_enqueue_style('swiper');
		}

		/**
		 * Add the Category for Tomochain Widget Addon
		 */
		public function add_elementor_category() {

			// Tomochain Addon
			$category_args = apply_filters( 'tmc_elementor_category_args', array(
				'slug'  => 'tmc-element-widgets',
				'title' => esc_html__( 'Tomochain Addon', 'tmc' ),
				'icon'  => 'fa fa-plug',
			) );

			\Elementor\Plugin::instance()->elements_manager->add_category(
				$category_args['slug'],
				array(
					'title' => $category_args['title'],
					'icon'  => $category_args['slug'],
				),
				1
			);
			// TomoDEX
			$i_args = apply_filters( 'tmc_introduce_args', array(
				'slug'  => 'tmc-introduce-widgets',
				'title' => esc_html__( 'Tomochain Introduce', 'tmc' ),
				'icon'  => 'fa fa-plug',
			) );
			\Elementor\Plugin::instance()->elements_manager->add_category(
				$i_args['slug'],
				array(
					'title' => $i_args['title'],
					'icon'  => $i_args['slug'],
				),
				1
			);
		}
		/**
		 * Require and instantiate Elementor Widgets
		 *
		 * @param $widgets_manager
		 */
		public function add_elementor_widgets( $widgets_manager ) {

			$elementor_widgets = $this->get_dir_files( __DIR__ . '/elementor-extra' );
			foreach ( $elementor_widgets as $widget ) {
				require_once $widget;

				$widget = basename( $widget, ".php" );

				$classname = $this->convert_filename_to_classname( $widget );
				if ( class_exists( $classname ) ) {
					$widget_object = new $classname();
					$widgets_manager->register_widget_type( $widget_object );
				}
			}
		}

		/**
		 * Returns an array of all PHP files in the specified absolute path.
		 * Inspired from jetpack's glob_php
		 *
		 * @param string $absolute_path The absolute path of the directory to search.
		 *
		 * @return array Array of absolute paths to the PHP files.
		 */
		protected function get_dir_files( $absolute_path ) {
			if ( function_exists( 'glob' ) ) {
				return glob( "$absolute_path/*.php" );
			}

			$absolute_path = untrailingslashit( $absolute_path );
			$files         = array();
			if ( ! $dir = @opendir( $absolute_path ) ) {
				return $files;
			}

			while ( false !== $file = readdir( $dir ) ) {
				if ( '.' == substr( $file, 0, 1 ) || '.php' != substr( $file, - 4 ) ) {
					continue;
				}

				$file = "$absolute_path/$file";

				if ( ! is_file( $file ) ) {
					continue;
				}

				$files[] = $file;
			}

			closedir( $dir );

			return $files;
		}

		protected function convert_filename_to_classname( $widget ) {
			$classname = ucwords( $widget, "-" );
			$classname = str_replace( '-', '_', $classname );
			$classname = '\\TMC_Elementor_Widgets\\' . $classname;
			return $classname;
		}

		/**
		 *
		 * @static
		 * @since 1.0.0
		 * @access public
		 * @return ElementorExtraWidgets
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
				self::$instance->init();
			}

			return self::$instance;
		}

		/**
		 * Throw error on object clone
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'tmc' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'tmc' ), '1.0.0' );
		}
	}
	TMC_Elementor_Widgets::instance();
}