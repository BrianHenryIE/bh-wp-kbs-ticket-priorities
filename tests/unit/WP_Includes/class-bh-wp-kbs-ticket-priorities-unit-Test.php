<?php
/**
 * @package brianhenryie/bh-wp-kbs-ticket-priorities
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\KBS_Ticket_Priorities\WP_Includes;

use BrianHenryIE\KBS_Ticket_Priorities\Admin\Admin;
use BrianHenryIE\KBS_Ticket_Priorities\Frontend\Frontend;
use WP_Mock\Matcher\AnyInstance;

/**
 * Class BH_WP_KBS_Ticket_Priorities_Unit_Test
 * @coversDefaultClass \BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\BH_WP_KBS_Ticket_Priorities
 */
class BH_WP_KBS_Ticket_Priorities_Unit_Test extends \Codeception\Test\Unit {

	protected function setUp(): void {
	    parent::setUp();
		\WP_Mock::setUp();
	}

	protected function tearDown(): void {
		parent::tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 * @covers ::set_locale
	 */
	public function test_set_locale_hooked(): void {

		\WP_Mock::expectActionAdded(
			'init',
			array( new AnyInstance( I18n::class ), 'load_plugin_textdomain' )
		);

		new BH_WP_KBS_Ticket_Priorities();
	}

	/**
	 * @covers ::define_admin_hooks
	 */
	public function test_admin_hooks(): void {

		\WP_Mock::expectActionAdded(
			'admin_enqueue_scripts',
			array( new AnyInstance( Admin::class ), 'enqueue_styles' )
		);

		\WP_Mock::expectActionAdded(
			'admin_enqueue_scripts',
			array( new AnyInstance( Admin::class ), 'enqueue_scripts' )
		);

		new BH_WP_KBS_Ticket_Priorities();
	}

	/**
	 * @covers ::define_frontend_hooks
	 */
	public function test_frontend_hooks(): void {

		\WP_Mock::expectActionAdded(
			'wp_enqueue_scripts',
			array( new AnyInstance( Frontend::class ), 'enqueue_styles' )
		);

		\WP_Mock::expectActionAdded(
			'wp_enqueue_scripts',
			array( new AnyInstance( Frontend::class ), 'enqueue_scripts' )
		);

		new BH_WP_KBS_Ticket_Priorities();
	}

}