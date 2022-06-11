<?php
/**
 * Tests for the root plugin file.
 *
 * @package brianhenryie/bh-wp-kbs-ticket-priorities
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\KBS_Ticket_Priorities;

use BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\BH_WP_KBS_Ticket_Priorities;

/**
 * Class Plugin_WP_Mock_Test
 */
class Plugin_Unit_Test extends \Codeception\Test\Unit {

	protected function setUp() : void {
		parent::setUp();
		\WP_Mock::setUp();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
		parent::tearDown();
	}

	/**
	 * Verifies the plugin initialization.
	 * Verifies the plugin does not output anything to screen.
	 */
	public function test_plugin_include(): void {

		// Prevents code-coverage counting, and removes the need to define the WordPress functions that are used in that class.
		\Patchwork\redefine(
			array( BH_WP_KBS_Ticket_Priorities::class, '__construct' ),
			function() {}
		);

		// Defined in `bootstrap.php`.
		global $plugin_root_dir, $plugin_name, $plugin_basename;

		\WP_Mock::userFunction(
			'plugin_dir_path',
			array(
				'args'   => array( \WP_Mock\Functions::type( 'string' ) ),
				'return' => $plugin_root_dir . '/',
			)
		);

		\WP_Mock::userFunction(
			'plugin_basename',
			array(
				'args'   => array( \WP_Mock\Functions::type( 'string' ) ),
				'return' => $plugin_basename,
			)
		);

		\WP_Mock::userFunction(
			'plugins_url',
			array(
				'args'   => array( \WP_Mock\Functions::type( 'string' ) ),
				'return' => 'http://localhost:8080/' . $plugin_name,
				'times'  => 1,
			)
		);

		\WP_Mock::userFunction(
			'trailingslashit',
			array(
				'args'       => array( \WP_Mock\Functions::type( 'string' ) ),
				'return_arg' => true,
				'times'      => 1,
			)
		);

		ob_start();

		include $plugin_root_dir . '/bh-wp-kbs-ticket-priorities.php';

		$printed_output = ob_get_contents();

		ob_end_clean();

		$this->assertEmpty( $printed_output );

		$this->assertArrayHasKey( 'bh_wp_kbs_ticket_priorities', $GLOBALS );

		$this->assertInstanceOf( BH_WP_KBS_Ticket_Priorities::class, $GLOBALS['bh_wp_kbs_ticket_priorities'] );

	}

}
