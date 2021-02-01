<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package st
 */
// if ( ! is_active_sidebar( 'sidebar-1' ) ) {
// 	return;
// }
?>
<div id="secondary" class="sidebar col-md-4 col-xs-12">
		<?php 
		if(is_singular('publication')){
			$sidebar = 'p-sidebar';
		}elseif(is_singular('use-case')){
			$sidebar = 'u-sidebar';
		}else{
			$sidebar = 'sidebar-1';
		}
		dynamic_sidebar( $sidebar );
		?>
</div><!-- #secondary -->
