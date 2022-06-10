<?php
/**
 * Class Plugin_Test. Tests the root plugin setup.
 *
 * @package brianhenryie/bh-wp-kbs-ticket-priorities
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\KBS_Ticket_Priorities;

use BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\BrianHenryIE\KBS_Ticket_Priorities;

/**
 * Verifies the plugin has been instantiated and added to PHP's $GLOBALS variable.
 */
class Plugin_Integration_Test extends \Codeception\TestCase\WPTestCase {

	/**
	 * Test the main plugin object is added to PHP's GLOBALS and that it is the correct class.
	 */
	public function test_plugin_instantiated(): void {

		$this->assertArrayHasKey( 'bh_wp_kbs_ticket_priorities', $GLOBALS );

		$this->assertInstanceOf( BrianHenryIE\KBS_Ticket_Priorities::class, $GLOBALS['bh_wp_kbs_ticket_priorities'] );
	}

}
