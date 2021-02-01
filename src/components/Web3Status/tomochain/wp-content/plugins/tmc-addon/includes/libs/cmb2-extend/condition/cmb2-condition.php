<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0.0
 * @package           CMB2 conditional logic
 *
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
 
class CMB2_conditional_logic {
	/**
	 * This plugin's version number. Used for busting caches.
	 *
	 * @var string
	 */
	public $version = '1.0.0';
    /**
     * Construct the plugin object
     */
    public function __construct() {} 
    /**
     * Activate the plugin
     */
    public function activate() {
       add_action( 'admin_enqueue_scripts', array( $this, 'enqueues' ) );
    }
    public function enqueues() {
    	wp_enqueue_script('cmb2_conditional_logic', plugins_url( 'cmb2-condition.js', __FILE__ ),
    		array('jquery'), 
    		$this->version,
    		true
    	);
    }
} 
if( class_exists('CMB2_conditional_logic') ) {
	$CMB2_conditional_logic = new CMB2_conditional_logic();
	$CMB2_conditional_logic->activate();
}