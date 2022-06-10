<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           brianhenryie/bh-wp-kbs-ticket-priorities
 *
 * @wordpress-plugin
 * Plugin Name:       Ticket Priorities for KB Support
 * Plugin URI:        http://github.com/username/bh-wp-kbs-ticket-priorities/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Requires PHP:      7.4
 * Author:            BrianHenryIE
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bh-wp-kbs-ticket-priorities
 * Domain Path:       /languages
 */

namespace BrianHenryIE\KBS_Ticket_Priorities;

use BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\Activator;
use BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\Deactivator;
use BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\BH_WP_KBS_Ticket_Priorities;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'autoload.php';

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BH_WP_KBS_TICKET_PRIORITIES_VERSION', '1.0.0' );
define( 'BH_WP_KBS_TICKET_PRIORITIES_BASENAME', plugin_basename( __FILE__ ) );
define( 'BH_WP_KBS_TICKET_PRIORITIES_PATH', plugin_dir_path( __FILE__ ) );
define( 'BH_WP_KBS_TICKET_PRIORITIES_URL', trailingslashit( plugins_url( __DIR__ ) ) );

register_activation_hook( __FILE__, array( Activator::class, 'activate' ) );
register_deactivation_hook( __FILE__, array( Deactivator::class, 'deactivate' ) );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function instantiate_bh_wp_kbs_ticket_priorities(): BH_WP_KBS_Ticket_Priorities {

	$plugin = new BH_WP_KBS_Ticket_Priorities();

	return $plugin;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and frontend-facing site hooks.
 */
$GLOBALS['bh_wp_kbs_ticket_priorities'] = instantiate_bh_wp_kbs_ticket_priorities();
