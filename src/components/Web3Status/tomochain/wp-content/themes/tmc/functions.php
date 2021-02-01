<?php
/**
 * ST functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package st
 */
$tmc_theme = wp_get_theme();

if ( ! empty( $tmc_theme['Template'] ) ) {
	$tmc_theme = wp_get_theme( $tmc_theme['Template'] );
}

define( 'TMC_THEME_NAME', $tmc_theme['Name'] );
define( 'TMC_THEME_SLUG', $tmc_theme['Template'] );
define( 'TMC_THEME_VERSION', $tmc_theme['Version'] );
define( 'TMC_THEME_DIR', get_template_directory() );
define( 'TMC_THEME_URI', get_template_directory_uri() );
define( 'TMC_CHILD_THEME_URI', get_stylesheet_directory_uri() );
define( 'TMC_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'TMC_ASSET_URI', TMC_THEME_URI . '/assets' );
define( 'TMC_LIBS_URI', TMC_ASSET_URI . '/libs' );

if ( ! function_exists( 'tmc_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tmc_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on st, use a find and replace
		 * to change 'tmc' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tmc', TMC_THEME_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'tmc' )
		) );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'tmc_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
        ) );
        add_image_size('event-image', 1200, 628, true);
	}
endif;
add_action( 'after_setup_theme', 'tmc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tmc_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'tmc_content_width', 800 );
}
/* Register Sidebar */
add_action( 'after_setup_theme', 'tmc_content_width', 0 );

function tomochain_widgets_init() {
    register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tmc' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tmc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Publication', 'tmc' ),
		'id'            => 'p-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'tmc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Use Case', 'tmc' ),
		'id'            => 'u-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'tmc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tomochain_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tmc_enqueue_libs() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	/*
    * Enqueue Google Fonts
    */
    $opensans_url = add_query_arg( 'family',
            'Open+Sans:300,400,600,700,800|Quicksand:400,500|Bai+Jamjuree:400,500,700&amp;subset=latin-ext,vietnamese',
            'https://fonts.googleapis.com/css' );
    $roboto_url = add_query_arg( 'family',
            'Open+Sans:400,400i,600,600i,700,800|Roboto:400,400i,500,700,700i,900&display=swap&subset=vietnamese',
			'https://fonts.googleapis.com/css' );
	$nunito_url = add_query_arg( 'family',
            'Nunito+Sans:300i,400,400i,600,700,900&display=swap',
            'https://fonts.googleapis.com/css' );
    wp_enqueue_style( 'opensans', $opensans_url, null, TMC_THEME_VERSION );
	wp_enqueue_style( 'roboto', $roboto_url, null, TMC_THEME_VERSION );
	wp_enqueue_style( 'nunito', $nunito_url, null, TMC_THEME_VERSION );

    wp_enqueue_style( 'fontawesome',
        TMC_ASSET_URI . '/fonts/font-awesome/css/all.min.css',
        array(),
        null,
		false );
	wp_enqueue_style( 'fonttomochain',
        TMC_ASSET_URI . '/fonts/font-tomochain/style.css',
        array(),
        null,
        false );
	wp_register_style('tmc-style',TMC_THEME_URI . '/assets/css/tomochain.css');
	wp_enqueue_style('tmc-style');


	wp_enqueue_script( 'superfish',
        TMC_LIBS_URI . '/superfish/js/superfish.min.js',
        array(),
        null,
        true );

    wp_enqueue_script( 'hoverIntent',
        TMC_LIBS_URI . '/superfish/js/hoverIntent.js',
        array(),
        null,
        true );


	wp_enqueue_script( 'scrollme',
        TMC_LIBS_URI . '/scrollme-master/jquery.scrollme.js',
        array(),
        null,
        true );

    wp_enqueue_script( 'tmc-js',
        TMC_THEME_URI . '/assets/js/tomochain' . $suffix . '.js',
            array('jquery'),
            TMC_THEME_VERSION,
            true );

    wp_localize_script( 'tmc-js',
        'tmcParam',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        ));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tmc_enqueue_libs' );

/**
 * Custom template tags for this theme.
 */
require_once TMC_THEME_DIR . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once TMC_THEME_DIR . '/inc/template-functions.php';

/**
 * Functions add custom html use hook
 */
require_once TMC_THEME_DIR . '/inc/template-html-func.php';

/**
 * Customizer additions.
 */
require_once TMC_THEME_DIR . '/inc/customizer.php';


