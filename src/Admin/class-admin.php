<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    brianhenryie/bh-wp-kbs-ticket-priorities
 */

namespace BrianHenryIE\KBS_Ticket_Priorities\Admin;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */
class Admin {

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @hooked admin_enqueue_scripts
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles(): void {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$version = defined( 'BH_WP_KBS_TICKET_PRIORITIES_VERSION' ) ? BH_WP_KBS_TICKET_PRIORITIES_VERSION : '1.0.0';

		wp_enqueue_style( 'bh-wp-kbs-ticket-priorities', plugin_dir_url( __FILE__ ) . 'css/bh-wp-kbs-ticket-priorities-admin.css', array(), $version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @hooked admin_enqueue_scripts
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts(): void {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$version = defined( 'BH_WP_KBS_TICKET_PRIORITIES_VERSION' ) ? BH_WP_KBS_TICKET_PRIORITIES_VERSION : '1.0.0';

		wp_enqueue_script( 'bh-wp-kbs-ticket-priorities', plugin_dir_url( __FILE__ ) . 'js/bh-wp-kbs-ticket-priorities-admin.js', array( 'jquery' ), $version, true );

	}

}
