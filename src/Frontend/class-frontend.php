<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    brianhenryie/bh-wp-kbs-ticket-priorities
 */

namespace BrianHenryIE\KBS_Ticket_Priorities\Frontend;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the frontend-facing stylesheet and JavaScript.
 */
class Frontend {

	/**
	 * Register the stylesheets for the frontend-facing side of the site.
	 *
	 * @hooked wp_enqueue_scripts
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles(): void {
		$version = defined( 'BH_WP_KBS_TICKET_PRIORITIES_VERSION' ) ? BH_WP_KBS_TICKET_PRIORITIES_VERSION : time();

		wp_enqueue_style( 'bh-wp-kbs-ticket-priorities', plugin_dir_url( __FILE__ ) . 'css/bh-wp-kbs-ticket-priorities-frontend.css', array(), $version, 'all' );

	}

	/**
	 * Register the JavaScript for the frontend-facing side of the site.
	 *
	 * @hooked wp_enqueue_scripts
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts(): void {
		$version = defined( 'BH_WP_KBS_TICKET_PRIORITIES_VERSION' ) ? BH_WP_KBS_TICKET_PRIORITIES_VERSION : time();

		wp_enqueue_script( 'bh-wp-kbs-ticket-priorities', plugin_dir_url( __FILE__ ) . 'js/bh-wp-kbs-ticket-priorities-frontend.js', array( 'jquery' ), $version, false );

	}

}
