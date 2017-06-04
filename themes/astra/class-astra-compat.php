<?php
/**
 * Astra_Compat setup
 *
 * @package bb-header-footer
 */

/**
 * Astra theme compatibility.
 */
class Astra_Compat {

	/**
	 * Instance of Astra_Compat.
	 *
	 * @var Astra_Compat
	 */
	private static $instance;

	/**
	 *  Initiator
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new Astra_Compat();

			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks() {

		$header_id = BB_Header_Footer::get_settings( 'bb_header_id', '' );
		$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', '' );

		if ( '' !== $header_id ) {
			add_action( 'template_redirect', array( $this, 'astra_setup_header' ), 10 );
			add_action( 'astra_header', array( 'BB_Header_Footer', 'get_header_content' ), 16 );
		}

		if ( '' !== $footer_id ) {
			add_action( 'template_redirect', array( $this, 'astra_setup_footer' ), 10 );
			add_action( 'astra_footer', array( 'BB_Header_Footer', 'get_footer_content' ), 16 );
		}

	}

	/**
	 * Disable header from the theme.
	 */
	public function astra_setup_header() {
		remove_action( 'astra_header', 'astra_header_markup' );
	}

	/**
	 * Disable footer from the theme.
	 */
	public function astra_setup_footer() {
		remove_action( 'astra_footer', 'astra_footer_markup' );
	}


}

Astra_Compat::instance();
