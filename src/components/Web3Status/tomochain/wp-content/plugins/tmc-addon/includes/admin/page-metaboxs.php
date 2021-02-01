<?php
if(!class_exists('TMC_Add_Metabox')):
	class TMC_Add_Metabox {
		/*
		 * Render metabox for Page
		*/
		public function __construct() {
			add_action( 'cmb2_admin_init', array( $this,'tmc_add_metaboxes' ));
		}
		
		/**
		 * Define the metabox and field configurations.
		 */
		public function tmc_add_metaboxes() {

			$prefix = 'tmc_';

			/*-------------------------------------------------------*
			 * Page Metabox
			 *-------------------------------------------------------*/
			
			$cmb_page = new_cmb2_box( array(
				'id'            => $prefix . 'metabox',
				'title'         => esc_html__( 'Page Options', 'tmc' ),
				'object_types'  => array( 'page' ), // Post type
				'context'       => 'normal',
				'priority'      => 'high',
				'show_names'    => true, // Show field names on the left
				// 'hookup'       => false, // Only display on frontend
		        // 'save_fields'  => false, // Not Save field
				// 'cmb_styles' => false, // false to disable the CMB stylesheet
				// 'closed'     => true, // Keep the metabox closed by default
			) );
			

			$cmb_page->add_field( array(
				'name'    => __( 'Hide Page Heading','tmc'),
				'id'      => 'hide_page_heading',
				'type'    => 'checkbox',
			) );
			$cmb_page->add_field( array(
				'name'    => __( 'Header Style','tmc'),
				'id'      => 'header_style',
				'type'    => 'select',
				'default'          => 3,
				'options'          => array(
					'' 			=> __( 'Default', 'tmc' ),
					'roadmap'   => __( 'Roadmap', 'tmc' )
				),
			) );

			/*--------------------------------------------------------------------
			* Event Metabox
			*--------------------------------------------------------------------*/
			$cmb_event = new_cmb2_box( array(
				'id'            => $prefix . 'event_metabox',
				'title'         => esc_html__( 'Event Options', 'tmc' ),
				'object_types'  => array( 'tmc_event' ), // Post type
				'context'       => 'normal',
				'priority'      => 'high',
				'show_names'    => true, // Show field names on the left
				// 'hookup'       => false, // Only display on frontend
		        // 'save_fields'  => false, // Not Save field
				// 'cmb_styles' => false, // false to disable the CMB stylesheet
				// 'closed'     => true, // Keep the metabox closed by default
			) );
			

			$cmb_event->add_field( array(
				'name' => esc_html__('Open Date','tmc'),
				'id'   => 'open_date',
				'type' => 'text_datetime_timestamp',
			) );

			$cmb_event->add_field( array(
				'name' => esc_html__('Add Close Date','tmc'),
				'desc' => esc_html__('Use when the event lasts several days','tmc'),
				'id'   => 'multi_date',
				'type' => 'checkbox',
			) );

			$cmb_event->add_field( array(
				'name' => esc_html__('Close Date','tmc'),
				'id'   => 'close_date',
				'type' => 'text_datetime_timestamp',
				'attributes' => array(
					// 'required'               => true, // Will be required only if visible.
					'data-conditional-id'    => 'multi_date',
					'data-conditional-value' => 'on',
				),
			) );
			$cmb_event->add_field( array(
				'name'    => esc_html__('Place','tmc'),
				'desc'    => esc_html__('Place of the event','tmc'),
				'id'      => 'event_place',
				'type'    => 'text',
			) );
			/*--------------------------------------------------------------------
			* Press Metabox
			*--------------------------------------------------------------------*/
			$cmb_press = new_cmb2_box( array(
				'id'            => $prefix . 'press_metabox',
				'title'         => esc_html__( 'Press Info', 'tmc' ),
				'object_types'  => array( 'tmc_press' ), // Post type
				'context'       => 'normal',
				'priority'      => 'high',
				'show_names'    => true, // Show field names on the left
				// 'hookup'       => false, // Only display on frontend
		        // 'save_fields'  => false, // Not Save field
				// 'cmb_styles' => false, // false to disable the CMB stylesheet
				// 'closed'     => true, // Keep the metabox closed by default
			) );
			

			$cmb_press->add_field( array(
				'name'    => __('Image','tmc'),
				'desc'    => __('Upload an image or enter an URL.','tmc'),
				'id'      => 'press_image',
				'type'    => 'file',
				// Optional:
				'options' => array(
					'url' => false, // Hide the text input for the url
				),
				'text'    => array(
					'add_upload_file_text' => __('Add File','tmc') // Change upload button text. Default: "Add or Upload File"
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
			$cmb_press->add_field( array(
				'name' => __( 'URL', 'tmc' ),
				'id'   => 'custom_url',
				'type' => 'text_url',
				// 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
			) );
			$cmb_press->add_field( array(
				'name' => __( 'Open in new window', 'tmc' ),
				'id'   => 'target_blank',
				'type' => 'checkbox',
				// 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
			) );
			$cmb_press->add_field( array(
				'name' => __( 'Add nofollow', 'tmc' ),
				'id'   => 'nofollow',
				'type' => 'checkbox',
				// 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
			) );
			
			/*--------------------------------------------------------------------
			* Roadmap Metabox
			*--------------------------------------------------------------------*/
			$cmb_roadmap = new_cmb2_box( array(
				'id'            => $prefix . 'roadmap_metabox',
				'title'         => esc_html__( 'Roadmap Info', 'tmc' ),
				'object_types'  => array( 'tmc_roadmap' ), // Post type
				'context'       => 'normal',
				'priority'      => 'high',
				'show_names'    => true, // Show field names on the left
				// 'hookup'       => false, // Only display on frontend
		        // 'save_fields'  => false, // Not Save field
				// 'cmb_styles' => false, // false to disable the CMB stylesheet
				// 'closed'     => true, // Keep the metabox closed by default
			) );
			$cmb_roadmap->add_field( array(
				'name'    => esc_html__('Milestone','tmc'),
				'desc'    => esc_html__('Milestone number','tmc'),
				'id'      => 'tmc_milestone',
				'type'    => 'text',
				'attributes' => array(
					'type' => 'number',
					'pattern' => '\d*',
					'placeholder' => '8'
				),
			) );
			$cmb_roadmap->add_field( array(
				'name'    => esc_html__('Repository Name','tmc'),
				'id'      => 'tmc_repo',
				'type'    => 'text',
				'attributes'    => array(
					'placeholder' => 'tomox-sdk-ui'
				),
			) );
			$cmb_roadmap->add_field( array(
				'name'    => esc_html__('Url','tmc'),
				'id'      => 'tmc_url',
				'type'    => 'text_url',
				'attributes'    => array(
					'placeholder' => 'https://example.com'
				),
			) );
			$cmb_roadmap->add_field( array(
				'name'    => __('Image'),
				'desc'    => __('Upload an image or enter an URL.','tmc'),
				'id'      => 'tmc_image',
				'type'    => 'file',
				// Optional:
				'options' => array(
					'url' => false, // Hide the text input for the url
				),
				'text'    => array(
					'add_upload_file_text' => __('Add File') // Change upload button text. Default: "Add or Upload File"
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
				'preview_size' => 'thumbnail', // Image size to use when previewing in the admin.
			) );
			$cmb_roadmap->add_field( array(
				'name'             => __('Status','tmc'),
				'id'               => 'tmc_status',
				'type'             => 'radio',
				'options'          => array(
					'completed' => __('Completed','tmc'),
                    'in-progress' => __('In Progress','tmc'),
				),
			) );

			$cmb_roadmap->add_field( array(
				'name' => __('Release','tmc'),
				'id'   => 'tmc_release',
				'type' => 'text_date',
				// 'timezone_meta_key' => 'wiki_test_timezone',
				'date_format' => 'M d, Y',
				'attributes'    => array(
					'data-conditional-id'     => 'tmc_status',
					'data-conditional-value'  => 'completed',
					'placeholder' => 'Jun 18,2020'
				),
			) );

			$cmb_roadmap->add_field( array(
				'name' => __('Due date','tmc'),
				'id'   => 'tmc_due_date',
				'type' => 'text_date',
				// 'timezone_meta_key' => 'wiki_test_timezone',
				'date_format' => 'M d, Y',
				'attributes'    => array(
					'data-conditional-id'     => 'tmc_status',
					'data-conditional-value'  => 'in-progress',
					'placeholder' => 'Jun 18,2020'
				)
			) );
			$cmb_roadmap->add_field( array(
				'name'    => esc_html__('Percent','tmc'),
				'id'      => 'tmc_percent',
				'type'    => 'text',
				'attributes'    => array(
					'data-conditional-id'     => 'tmc_status',
					'data-conditional-value'  => 'in-progress',
					'type' => 'number',
					'pattern' => '\d*',
					'placeholder' => '80'
				),
			) );
			$cmb_roadmap->add_field( array(
				'name'    => esc_html__('Github Url','tmc'),
				'id'      => 'tmc_github',
				'type'    => 'text_url',
				'attributes'    => array(
					'placeholder' => 'https://github.com'
				),
			) );
			$cmb_roadmap->add_field( array(
				'name'    => esc_html__('Document Url','tmc'),
				'id'      => 'tmc_doc',
				'type'    => 'text_url',
				'attributes'    => array(
					'placeholder' => 'https://document.com'
				),
			) );
			$cmb_roadmap->add_field( array(
				'name'    => __( 'Open new tab','tmc'),
				'id'      => 'tmc_new_tab',
				'type'    => 'checkbox',
				'default' => 1
			) );

		}
	}
	new TMC_Add_Metabox();
endif;