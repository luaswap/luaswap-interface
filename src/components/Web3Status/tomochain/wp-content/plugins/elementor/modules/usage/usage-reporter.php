<?php
namespace Elementor\Modules\Usage;

use Elementor\Modules\System_Info\Reporters\Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor usage report.
 *
 * Elementor system report handler class responsible for generating a report for
 * the user.
 */
class Usage_Reporter extends Base {

	const RECALC_ACTION = 'elementor_usage_recalc';

	public function get_title() {
		$title = 'Elements Usage';

		if ( 'html' === $this->_properties['format'] && empty( $_GET[ self::RECALC_ACTION ] ) ) { // phpcs:ignore -- nonce validation is not require here.
			$nonce = wp_create_nonce( self::RECALC_ACTION );
			$url = add_query_arg( [
				self::RECALC_ACTION => 1,
				'_wpnonce' => $nonce,
			] );

			$title .= '<a id="elementor-usage-recalc" href="' . esc_url( $url ) . '#elementor-usage-recalc" class="box-title-tool">Recalculate</a>';
		}

		return $title;
	}

	public function get_fields() {
		return [
			'usage' => '',
		];
	}

	public function get_usage() {
		/** @var Module $module */
		$module = Module::instance();

		if ( ! empty( $_GET[ self::RECALC_ACTION ] ) ) {
			if ( empty( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], self::RECALC_ACTION ) ) {
				wp_die( 'Invalid Nonce', 'Invalid Nonce', [
					'back_link' => true,
				] );
			}

			$module->recalc_usage();

			wp_safe_redirect( remove_query_arg( self::RECALC_ACTION ) );

			die;
		}

		$usage = '';

		foreach ( $module->get_formatted_usage() as $doc_type => $data ) {
			$usage .= '<tr><td>' . $data['title'] . ' ( ' . $data['count'] . ' )</td><td>';

			foreach ( $data['elements'] as $element => $count ) {
				$usage .= $element . ': ' . $count . PHP_EOL;
			}

			$usage .= '</td></tr>';
		}

		return [
			'value' => $usage,
		];
	}

	public function get_raw_usage() {
		/** @var Module $module */
		$module = Module::instance();
		$usage = PHP_EOL;

		foreach ( $module->get_formatted_usage( 'raw' ) as $doc_type => $data ) {
			$usage .= "\t{$data['title']} : " . $data['count'] . PHP_EOL;

			foreach ( $data['elements'] as $element => $count ) {
				$usage .= "\t\t{$element} : {$count}" . PHP_EOL;
			}
		}

		return [
			'value' => $usage,
		];
	}
}
