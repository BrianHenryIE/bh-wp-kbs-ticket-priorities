<?php
/**
 * Tests for Admin.
 *
 * @see Admin
 *
 * @package brianhenryie/bh-wp-kbs-ticket-priorities
 * @author Brian Henry <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\KBS_Ticket_Priorities\Admin;

/**
 * Class Admin_Test
 *
 * @coversDefaultClass \BrianHenryIE\KBS_Ticket_Priorities\Admin\Admin
 */
class Admin_Test extends \Codeception\Test\Unit {

	protected function setUp(): void {
	    parent::setUp();
		\WP_Mock::setUp();
	}

	protected function tearDown(): void {
		parent::tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 * Verifies enqueue_styles() calls wp_enqueue_style() with appropriate parameters.
	 * Verifies the .css file exists.
	 *
	 * @covers ::enqueue_styles
	 * @see wp_enqueue_style()
	 */
	public function test_enqueue_styles(): void {

		global $plugin_root_dir, $plugin_name;

		// Return any old url.
		\WP_Mock::userFunction(
			'plugin_dir_url',
			array(
				'return' => $plugin_root_dir . '/Admin/',
			)
		);

		$css_file = $plugin_root_dir . '/Admin/css/bh-wp-kbs-ticket-priorities-admin.css';

		\WP_Mock::userFunction(
			'wp_enqueue_style',
			array(
				'times' => 1,
				'args'  => array( $plugin_name, $css_file, array(), '1.0.0', 'all' ),
			)
		);

		$admin = new Admin();

		$admin->enqueue_styles();

		$this->assertFileExists( $css_file );
	}

	/**
	 * Verifies enqueue_scripts() calls wp_enqueue_script() with appropriate parameters.
	 * Verifies the .js file exists.
	 *
	 * @covers ::enqueue_scripts
	 * @see wp_enqueue_script()
	 */
	public function test_enqueue_scripts(): void {

		global $plugin_root_dir, $plugin_name;

		// Return any old url.
		\WP_Mock::userFunction(
			'plugin_dir_url',
			array(
				'return' => $plugin_root_dir . '/Admin/',
			)
		);

		$handle    = $plugin_name;
		$src       = $plugin_root_dir . '/Admin/js/bh-wp-kbs-ticket-priorities-admin.js';
		$deps      = array( 'jquery' );
		$ver       = '1.0.0';
		$in_footer = true;

		\WP_Mock::userFunction(
			'wp_enqueue_script',
			array(
				'times' => 1,
				'args'  => array( $handle, $src, $deps, $ver, $in_footer ),
			)
		);

		$admin = new Admin();

		$admin->enqueue_scripts();

		$this->assertFileExists( $src );
	}
}
