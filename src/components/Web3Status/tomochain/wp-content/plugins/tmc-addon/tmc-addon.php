<?php
/**
 * Plugin Name: Tomochain Addon
 * Description: Elementor Widget Extra for Tomochain
 * Version:  1.0.0
 * Plugin URI :  https://www.tomochain.com
 * Author: Tomochain
 * Author URI:  https://www.tomochain.com
 * Text Domain: tmc
 * License: GPLv2 or later
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'TMC_Addon' ) ) {
	class TMC_Addon{

		function __construct() {
	    	$this->prefix = 'tmc';
	    	$this->define_constants();
	    	$this->define_hook();
			$this->include_files();
			add_action('init', array($this,'github_api'));
	    }
	    function define_constants() {
	    	// Plugin Folder Url
	    	if( !defined( 'TMC_ADDON_URL' ) ) {
	    		define( 'TMC_ADDON_URL', plugin_dir_url(__FILE__) );
	    	}
	    	if( !defined( 'TMC_ADDON_ASSETS' ) ) {
	    		define('TMC_ADDON_ASSETS', TMC_ADDON_URL. 'assets' );
	    	}
	    	if( !defined( 'TMC_ADDON_INCLUDES' ) ) {
	    		define('TMC_ADDON_INCLUDES', TMC_ADDON_URL. 'includes' );
	    	}
	    	// Plugin Folder Path
	        if( !defined( 'TMC_ADDON_DIR' ) ) {
				define('TMC_ADDON_DIR', plugin_dir_path(__FILE__) );
	        }
	        if( !defined( 'TMC_ADDON_INCLUDES_DIR' ) ) {
				define('TMC_ADDON_INCLUDES_DIR', TMC_ADDON_DIR. 'includes' );
	        }
	    }
	    function define_hook(){
	    	add_action( 'plugins_loaded', array($this, 'load_textdomain') );

	    	// Check Elementor require
	    	if(!$this->is_elementor_active()){
	    		add_action('admin_notices',array($this,'elemtentor_notice'));
	    	}
	    }

	    function include_files(){	    	
	    	/* Register Sidebar */
	    	require_once TMC_ADDON_INCLUDES_DIR . '/admin/sidebar-register.php';
	    	
	    	/*
			* CMB2 Custom field
			*/
			require_once TMC_ADDON_INCLUDES_DIR . '/libs/cmb2/init.php';
			if(class_exists('CMB2_Bootstrap_260')){
				require_once TMC_ADDON_INCLUDES_DIR . '/libs/cmb2-extend/condition/cmb2-condition.php';
				require_once TMC_ADDON_INCLUDES_DIR . '/admin/theme-options.php';
				require_once TMC_ADDON_INCLUDES_DIR . '/admin/page-metaboxs.php';
				require_once TMC_ADDON_INCLUDES_DIR . '/libs/cmb2-extend/google-map/cmb-field-map.php';
				require_once TMC_ADDON_INCLUDES_DIR . '/libs/cmb2-extend/select2/cmb-field-select2.php';
				require_once TMC_ADDON_INCLUDES_DIR . '/libs/cmb2-extend/ajax-search/cmb-field-ajax-search.php';
			}
			/* Register Custom Post type */
			require_once TMC_ADDON_INCLUDES_DIR . '/post-type/event.php';
			require_once TMC_ADDON_INCLUDES_DIR . '/post-type/roadmap.php';
	    	require_once TMC_ADDON_INCLUDES_DIR . '/post-type/publication.php';
	    	require_once TMC_ADDON_INCLUDES_DIR . '/post-type/usecase.php';
	    	require_once TMC_ADDON_INCLUDES_DIR . '/post-type/press.php';

	    	/* Include Shortcode*/
	    	require_once TMC_ADDON_INCLUDES_DIR . '/shortcode/shortcodes.php';

	    	/* Include Elementor Widget */
	    	require_once TMC_ADDON_INCLUDES_DIR . '/class-elementor-extra-widgets.php';
	    	
	    	/* Include Wordpress Widget */
	    	require_once TMC_ADDON_INCLUDES_DIR . '/wp-widget/widgets.php';
	    }
	    function load_textdomain() {
	        load_plugin_textdomain( 'tmc', false, TMC_ADDON_DIR . '/languages/'  );
		}

		function elemtentor_notice(){
			$plugin  = get_plugin_data(__FILE__);
			echo '
				<div id="message" class="notice notice-warning">
				    <p>' . sprintf(__('<strong>%s</strong> requires <strong><a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a></strong> plugin to be installed and activated on your site.', 'tmc'), $plugin['Name']) . '</p>
				</div>';
		}
		function is_elementor_active(){
			$active_plugins = (array) get_option( 'active_plugins' , array() );
			
			if( is_multisite() ){
				$active_plugins = array_merge($active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
			}
			
			return in_array( 'elementor/elementor.php', $active_plugins ) || array_key_exists( 'elementor/elementor.php', $active_plugins );
		}

		function github_api(){
			/* Include Roadmap - Github */
			require_once TMC_ADDON_INCLUDES_DIR . '/data-roadmap/tmc-github.php';
		}
	}
	new TMC_Addon;
}