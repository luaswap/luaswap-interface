<?php

namespace Elementor\Core\Kits\Documents\Tabs;

use Elementor\Controls_Manager;
use Elementor\DB;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Settings_Site_Identity extends Tab_Base {

	public function get_id() {
		return 'settings-site-identity';
	}

	public function get_title() {
		return __( 'Site Identity', 'elementor' );
	}

	protected function register_tab_controls() {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$custom_logo_src = wp_get_attachment_image_src( $custom_logo_id, 'full' );

		$this->start_controls_section(
			'section_' . $this->get_id(),
			[
				'label' => $this->get_title(),
				'tab' => $this->get_id(),
			]
		);

		$this->add_control(
			$this->get_id() . '_refresh_notice',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'Changes will be reflected in the preview only after the page reloads.', 'elementor' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_control(
			'site_name',
			[
				'label' => __( 'Site Name', 'elementor' ),
				'default' => get_option( 'blogname' ),
				'placeholder' => __( 'Choose name', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'site_description',
			[
				'label' => __( 'Site Description', 'elementor' ),
				'default' => get_option( 'blogdescription' ),
				'placeholder' => __( 'Choose Description', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'site_logo',
			[
				'label' => __( 'Site Logo', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'id' => $custom_logo_id,
					'url' => $custom_logo_src ? $custom_logo_src[0] : '',
				],
				'description' => __( 'Suggested image dimensions: 350 × 100 pixels.', 'elementor' ),
			]
		);

		$this->add_control(
			'site_favicon',
			[
				'label' => __( 'Site Favicon', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'description' => __( 'Suggested Favicon dimensions: 512 × 512 pixels.', 'elementor' ),
			]
		);

		$this->end_controls_section();
	}

	public function on_save( $data ) {
		if ( ! isset( $data['settings'] ) || DB::STATUS_PUBLISH !== $data['settings']['post_status'] ) {
			return;
		}
		if ( isset( $data['settings']['site_name'] ) ) {
			update_option( 'blogname', $data['settings']['site_name'] );
		}

		if ( isset( $data['settings']['site_description'] ) ) {
			update_option( 'blogdescription', $data['settings']['site_description'] );
		}

		if ( isset( $data['settings']['site_logo'] ) ) {
			set_theme_mod( 'custom_logo', $data['settings']['site_logo']['id'] );
		}

		if ( isset( $data['settings']['site_favicon'] ) ) {
			update_option( 'site_icon', $data['settings']['site_favicon']['id'] );
		}
	}
}
