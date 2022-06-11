<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * frontend-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    brianhenryie/bh-wp-kbs-ticket-priorities
 */

namespace BrianHenryIE\KBS_Ticket_Priorities\WP_Includes;

use BrianHenryIE\KBS_Ticket_Priorities\KB_Support\Fixes;
use BrianHenryIE\KBS_Ticket_Priorities\KB_Support\Ticket;
use BrianHenryIE\KBS_Ticket_Priorities\KB_Support\Ticket_List_Table;
use BrianHenryIE\KBS_Ticket_Priorities\KB_Support\Ticket_UI;
use KBS_HTML_Elements;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * frontend-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 */
class BH_WP_KBS_Ticket_Priorities {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the frontend-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->set_locale();

		$this->define_fixes_hooks();

		$this->define_taxonomy_hooks();
		$this->define_ticket_hooks();
		$this->define_ticket_ui_hooks();
		$this->define_ticket_list_table_hooks();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 */
	protected function set_locale(): void {

		$plugin_i18n = new I18n();

		add_action( 'init', array( $plugin_i18n, 'load_plugin_textdomain' ) );

	}

	/**
	 * Add hooks for fixes which should hopefully be fixed upstream.
	 */
	protected function define_fixes_hooks(): void {

		$fixes = new Fixes();

		add_action( 'pre_get_posts', array( $fixes, 'admin_filter' ), 1 );
		add_filter( 'gettext_kb-support', array( $fixes, 'unwanted_text_output' ), 10, 3 );
	}

	/**
	 * Register the taxonomy with WordPress.
	 * Add the terms Low, Medium, High.
	 */
	protected function define_taxonomy_hooks(): void {

		$taxonomy = new Taxonomy();

		add_action( 'init', array( $taxonomy, 'register_priority_taxonomy' ), 11 );
		add_action( 'init', array( $taxonomy, 'register_priorities_terms' ), 12 );
	}


	/**
	 * Save the ticket priority when saving the ticket through the admin UI.
	 */
	protected function define_ticket_hooks(): void {
		$ticket = new Ticket();

		add_action( 'kbs_save_ticket', array( $ticket, 'on_save' ), 10, 2 );
	}

	/**
	 * Add the ticket priority drop-down to the save ticket metabox.
	 */
	protected function define_ticket_ui_hooks(): void {

		$loaded = function(): void {

			if ( ! function_exists( 'KBS' ) ) {
				return;
			}

			/**
			 * TODO: This is why we're adding it after plugins_loaded.
			 *
			 * @phpstan-ignore-next-line
			 * @var KBS_HTML_Elements $kbs_html
			 */
			$kbs_html = KBS()->html;

			$ticket_ui = new Ticket_UI( $kbs_html );

			add_action( 'kbs_ticket_metabox_save_after_status', array( $ticket_ui, 'print_dropdown' ) );
		};

		add_action( 'plugins_loaded', $loaded, 0 );

	}

	/**
	 * Register the column.
	 * Print the priority in the column.
	 * Add the filter above the table.
	 */
	protected function define_ticket_list_table_hooks(): void {
		$ticket_list = new Ticket_List_Table();

		add_filter( 'manage_kbs_ticket_posts_columns', array( $ticket_list, 'add_ticket_priority_to_columns' ), 20 );
		add_action( 'manage_kbs_ticket_posts_custom_column', array( $ticket_list, 'print_ticket_priority_column' ), 11, 2 );
		add_action( 'restrict_manage_posts', array( $ticket_list, 'register_filter' ), 200 );
	}
}
