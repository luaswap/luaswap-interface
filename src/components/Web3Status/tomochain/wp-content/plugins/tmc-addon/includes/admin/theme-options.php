<?php
/**
 * TMC Theme Options with CMB2
 * @version 0.1.0
 */
/**
 * Hook in and general a metabox to handle a theme options page and adds a menu item.
 */
class TMC_Theme_Options {
	/**
	 * Holds an instance of the project
	 *
	 * @TMC_Theme_Options
	 **/
	/**
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {
		add_action( 'cmb2_admin_init', array($this,'tmc_general_options_metabox') );
	}
	function tmc_general_options_metabox() {
		/**====================================================
		 * Home Options
		 =====================================================*/
		$args = array(
			'id'           => 'tmc_options_page',
			'title'        => esc_html__('Tomo Settings','tmc'),
			'object_types' => array( 'options-page' ),
			'option_key'   => 'tmc_options',
			'tab_group'    => 'tmc_options',
			'tab_title'    => esc_html__('General','tmc'),
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = array($this,'tmc_options_display_with_tabs');
		}
		$options = new_cmb2_box( $args );
		$options->add_field( array(
			'name' => esc_html__('Home URL','tmc'),
			'type' => 'title',
			'id'   => 'tmc_home_custom_url'
		) );
		$options->add_field( array(
			'name' => __('Url','tmc'),
		    'desc' => __('Enter url','tmc'),
		    'id'   => 'home_custom_url',
		    'type' => 'text_url',
		) );
		$options->add_field( array(
			'name' => esc_html__('Tomochain Report','tmc'),
			'type' => 'title',
			'id'   => 'tmc_report_title'
		) );
		$options->add_field( array(
			'name' => esc_html__('Show Report','tmc'),
			'id'   => 'show_report',
			'type' => 'checkbox',
		) );
		$group_field_id = $options->add_field( array(
		    'id'          => 'tmc_report_list',
		    'type'        => 'group',
		    // 'repeatable'  => false, // use false if you want non-repeatable group
		    'options'     => array(
		        'group_title'       => __( 'Report {#}', 'tmc' ), // since version 1.1.4, {#} gets replaced by row number
		        'add_button'        => __( 'Add', 'tmc' ),
		        'remove_button'     => __( 'Remove', 'tmc' ),
		        'sortable'          => true,
		        'closed'         => true, // true to have the groups closed by default
		        // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'tmc' ), // Performs confirmation before removing group.
		    )
		) );

		$options->add_group_field( $group_field_id, array(
		    'name' => __('Title report','tmc'),
		    'id'   => 'rp_title',
		    'type' => 'text',
		    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
		) );

		$options->add_group_field( $group_field_id, array(
			'name' => __('Target Blank','tmc'),
			'id'   => 'target_blank',
			'type' => 'checkbox',
		) );

		$options->add_group_field( $group_field_id, array(
		    'name' => __('Url','tmc'),
		    'desc' => __('Enter url to the report','tmc'),
		    'id'   => 'rp_url',
		    'type' => 'text_url',
		) );

		$options->add_field( array(
			'name' => esc_html__('Social','tmc'),
			'type' => 'title',
			'id'   => 'tmc_social_title'
		) );
		$group_field_id = $options->add_field( array(
		    'id'          => 'tmc_social_list',
		    'type'        => 'group',
		    // 'repeatable'  => false, // use false if you want non-repeatable group
		    'options'     => array(
		        'group_title'       => __( 'Social {#}', 'tmc' ), // since version 1.1.4, {#} gets replaced by row number
		        'add_button'        => __( 'Add', 'tmc' ),
		        'remove_button'     => __( 'Remove', 'tmc' ),
		        'sortable'          => true,
		        'closed'         => true, // true to have the groups closed by default
		        // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'tmc' ), // Performs confirmation before removing group.
		    )
		) );

		$options->add_group_field( $group_field_id, array(
		    'name' => __('Social Name','tmc'),
		    'id'   => 'social_name',
		    'type' => 'text',
		    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
		) );

		$options->add_group_field( $group_field_id, array(
		    'name' => __('Social Icon','tmc'),
		    'id'   => 'social_icon',
		    'type' => 'text',
		    'sanitization_cb' => 'tmc_sanitize_text_callback',
		    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
		) );

		$options->add_group_field( $group_field_id, array(
		    'name' => __('Social Url','tmc'),
		    'id'   => 'social_url',
		    'type' => 'text_url',
		) );
		/**====================================================================
		 * Header Options
		 *=====================================================================*/
		$args = array(
			'id'           => 'tmc_header_options_page',
			'menu_title'   => esc_html__('Header','tmc'), // Use menu title, & not title to hide main h2.
			'object_types' => array( 'options-page' ),
			'option_key'   => 'tmc_header_options',
			'parent_slug'  => 'tmc_options',
			'tab_group'    => 'tmc_options',
			'tab_title'    => esc_html('Header','tmc'),
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = array($this,'tmc_options_display_with_tabs');
		}
		$header_options = new_cmb2_box( $args );
		$header_options->add_field( array(
			'name' => esc_html__('Header Settings','tmc'),
			'type' => 'title',
			'id'   => 'tmc_header_title'
		) );
		$header_options->add_field( array(
			'name'    => esc_html__('Header Layout','tmc'),
			'desc'    => esc_html__('Set Header Layout','tmc'),
			'id'      => 'radio',
			'type'    => 'radio',
			'options' => array(
				'header-static' => esc_html__('Header Static','tmc'),
				'header-fixed' => esc_html('Header Fixed','tmc'),
			),
		) );
		/**====================================================================
		 * RoadMap Options
		 *=====================================================================*/
		$args = array(
			'id'           => 'tmc_roadmap_options_page',
			'menu_title'   => esc_html__('Road map','tmc'), // Use menu title, & not title to hide main h2.
			'object_types' => array( 'options-page' ),
			'option_key'   => 'tmc_roadmap_options',
			'parent_slug'  => 'tmc_options',
			'tab_group'    => 'tmc_options',
			'tab_title'    => esc_html('Road map','tmc'),
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = array($this,'tmc_options_display_with_tabs');
		}
		$roadmap_options = new_cmb2_box( $args );

		$roadmap_options->add_field( array(
			'name' 			=> esc_html__('Enter Repostoriry','tmc'),
			'type' 			=> 'text',
			'id'   			=> 'tmc_repos',
			'description' 	=> __('Repostories are separated by commas','tmc'),
			'attributes'	=> [
				'placeholder'	=> 'tomox-sdk-ui,tomoscan,tomowallet'
			]
		) );
		$roadmap_options->add_field( array(
			'name' 			=> esc_html__('Enter Commit number limit','tmc'),
			'type' 			=> 'text',
			'id'   			=> 'tmc_commit_number',
			'description' 	=> __('Default 10 commit on each repostority','tmc'),
			'attributes'	=> [
				'placeholder'	=> '10',
				'type' 			=> 'number',
				'pattern' 		=> '\d*',
				'min'			=> 1
			]
		) );

		$roadmap_options->add_field( array(
			'name' 			=> esc_html__('Github Access Token','tmc'),
			'type' 			=> 'text',
			'id'   			=> 'tmc_access_token',
			'description' 	=> __('<a href="https://help.github.com/en/github/authenticating-to-github/creating-a-personal-access-token-for-the-command-line" target="_blank"> Get github access token</a>','tmc'),
		) );
		/**==============================================================
		 * Footer Options
		 *===============================================================*/
		$args = array(
			'id'           => 'tmc_footer_options_page',
			'menu_title'   => esc_html__('Footer','tmc'), // Use menu title, & not title to hide main h2.
			'object_types' => array( 'options-page' ),
			'option_key'   => 'tmc_footer_options',
			'parent_slug'  => 'tmc_options',
			'tab_group'    => 'tmc_options',
			'tab_title'    => esc_html__('Footer','tmc'),
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = array($this,'tmc_options_display_with_tabs');
		}
		
		$footer_options = new_cmb2_box( $args );

		$footer_options->add_field( array(
			'name' => esc_html__('Footer Settings','tmc'),
			'type' => 'title',
			'id'   => 'tmc_footer_title'
		) );
		$footer_options->add_field( array(
			'name'             => esc_html__('Footer columns','tmc'),
			'id'               => 'footer_column',
			'desc'			   => sprintf(__('Go to <a href="%s">the widget</a> to set up the footer','tmc'),admin_url('widgets.php')),
			'type'             => 'select',
			'default'          => 3,
			'options'          => array(
				1 	=> __( '1', 'tmc' ),
				2   => __( '2', 'tmc' ),
				3   => __( '3', 'tmc' )
			),
		) );
		$footer_options->add_field( array(
			'name'    => esc_html__('Logo','tmc'),
			'desc'    => 'Upload an image or enter an URL.',
			'id'      => 'f_logo',
			'type'    => 'file',
			// Optional:
			'options' => array(
				'url' => false, // Hide the text input for the url
			),
			'text'    => array(
				'add_upload_file_text' => esc_html__('Add File','tmc') // Change upload button text. Default: "Add or Upload File"
			),
			// query_args are passed to wp.media's library query.
			'query_args' => array(
				// 'type' => 'application/pdf', // Make library only display PDFs.
				// Or only allow gif, jpg, or png images
				'type' => array(
					'image/gif',
					'image/jpeg',
					'image/png',
				),
			),
			'preview_size' => 'large', // Image size to use when previewing in the admin.
		) );
		$ctf7_arg = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
		$cf7Forms = get_posts( $ctf7_arg );
		if(!empty($cf7Forms)){
		  	// $post_ids = wp_list_pluck( $cf7Forms , 'ID' );
			$form_list = wp_list_pluck( $cf7Forms , 'post_title', 'ID' );
			$footer_options->add_field( array(
				'name'             => esc_html__('Form Subscribe','tmc'),
				'id'               => 'form_subscribe',
				'type'             => 'select',
				'options'          => $form_list
			) );
		}
		
	}
	/**
	 * A CMB2 options-page display callback override which adds tab navigation among
	 * CMB2 options pages which share this same display callback.
	 *
	 * @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
	 */
	function tmc_options_display_with_tabs( $cmb_options ) {
		$tabs = $this->tmc_options_page_tabs( $cmb_options );
		?>
		<div class="wrap cmb2-options-page option-<?php echo $cmb_options->option_key; ?>">
			<?php if ( get_admin_page_title() ) : ?>
				<h2><?php echo wp_kses_post( get_admin_page_title() ); ?></h2>
			<?php endif; ?>
			<h2 class="nav-tab-wrapper">
				<?php foreach ( $tabs as $option_key => $tab_title ) : ?>
					<a class="nav-tab<?php if ( isset( $_GET['page'] ) && $option_key === $_GET['page'] ) : ?> nav-tab-active<?php endif; ?>" href="<?php menu_page_url( $option_key ); ?>"><?php echo wp_kses_post( $tab_title ); ?></a>
				<?php endforeach; ?>
			</h2>
			<form class="cmb-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" id="<?php echo $cmb_options->cmb->cmb_id; ?>" enctype="multipart/form-data" encoding="multipart/form-data">
				<input type="hidden" name="action" value="<?php echo esc_attr( $cmb_options->option_key ); ?>">
				<?php $cmb_options->options_page_metabox(); ?>
				<?php submit_button( esc_attr( $cmb_options->cmb->prop( 'save_button' ) ), 'primary', 'submit-cmb' ); ?>
			</form>
		</div>
		<?php
	}
	/**
	 * Gets navigation tabs array for CMB2 options pages which share the given
	 * display_cb param.
	 *
	 * @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
	 *
	 * @return array Array of tab information.
	 */
	function tmc_options_page_tabs( $cmb_options ) {
		$tab_group = $cmb_options->cmb->prop( 'tab_group' );
		$tabs      = array();
		foreach ( CMB2_Boxes::get_all() as $cmb_id => $cmb ) {
			if ( $tab_group === $cmb->prop( 'tab_group' ) ) {
				$tabs[ $cmb->options_page_keys()[0] ] = $cmb->prop( 'tab_title' )
					? $cmb->prop( 'tab_title' )
					: $cmb->prop( 'title' );
			}
		}
		return $tabs;
	}
}
new TMC_Theme_Options();
function tmc_sanitize_text_callback( $value, $field_args, $field ) {

    /*
     * Do your custom sanitization. 
     * strip_tags can allow whitelisted tags
     * http://php.net/manual/en/function.strip-tags.php
     */
    $value = strip_tags( $value, '<i><p><a><br><br/>' );

    return $value;
}

function tmc_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'tmc_options', $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'tmc_options', $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}
function tmc_get_header_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'tmc_header_options', $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'tmc_header_options', $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}
function tmc_get_roadmap_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'tmc_roadmap_options', $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'tmc_roadmap_options', $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}
function tmc_get_footer_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'tmc_footer_options', $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'tmc_footer_options', $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}