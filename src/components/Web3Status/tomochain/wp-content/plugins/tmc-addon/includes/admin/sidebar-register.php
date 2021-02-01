<?php
if ( ! function_exists( 'tmc_widgets_init' ) ) :

	function tmc_widgets_init() {
		// Footer Columns (Widgetized)
		$num = tmc_get_footer_option( 'footer_column', 3 );

		for ( $i = 1; $i <= $num; $i++ ) :
			register_sidebar( 
				array( 
					'name' => __( 'TMC - Footer Column #', 'tmc' ) . $i, 
					'id' => 'tmc-footer-' . $i, 
					'before_widget' => '<div id="%1$s" class="widget %2$s">', 
					'after_widget' => '</div>', 
					'before_title' => '<h4 class="widget-title">', 
					'after_title' => '</h4>' ) );
		endfor
		;
	}
	add_action( 'widgets_init', 'tmc_widgets_init',11 );

endif;