<?php
/**
 * st Theme Customizer
 *
 * @package st
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tmc_customize_register( $wp_customize ) {
    $wp_customize->remove_control('header_textcolor');
    $wp_customize->remove_control('background_color');
    $wp_customize->remove_control('header_image');
    $wp_customize->remove_section("background_image");
    $wp_customize->remove_control('background_image');
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'tmc_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'tmc_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'tmc_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function tmc_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function tmc_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
