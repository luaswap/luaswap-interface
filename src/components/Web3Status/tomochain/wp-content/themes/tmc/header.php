<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package st
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php $header_style = get_post_meta(get_the_ID(),'header_style',true);
	if($header_style == 'roadmap'):
		get_template_part( 'template-parts/header/header','roadmap' );
	else: 
		get_template_part( 'template-parts/header/header','default' );

	endif;?>
	<div id="content" class="site-content">
