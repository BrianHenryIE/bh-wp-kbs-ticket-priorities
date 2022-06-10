<?php
/**
 *
 *
 * @package brianhenryie/bh-wp-kbs-ticket-priorities
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\KBS_Ticket_Priorities\WP_Includes;

/**
 * Class Plugin_WP_Mock_Test
 *
 * @coversDefaultClass \BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\I18n
 */
class I18n_Unit_Test extends \Codeception\Test\Unit {

	protected function setUp(): void {
	    parent::setUp();
		\WP_Mock::setUp();
	}

	protected function tearDown(): void {
		parent::tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 * Verify load_plugin_textdomain is correctly called.
	 *
	 * @covers ::load_plugin_textdomain
	 */
	public function test_load_plugin_textdomain(): void {

		global $plugin_root_dir;

        \WP_Mock::userFunction(
            'plugin_basename',
            array(
                'args'   => array(
                    \WP_Mock\Functions::type( 'string' )
                ),
                'return' => 'bh-wp-kbs-ticket-priorities',
                'times' => 1
            )
        );

        \WP_Mock::userFunction(
			'load_plugin_textdomain',
			array(
                'times' => 1,
				'args'   => array(
					'bh-wp-kbs-ticket-priorities',
					false,
					'bh-wp-kbs-ticket-priorities/languages/',
				)
			)
		);

        $i18n = new I18n();
        $i18n->load_plugin_textdomain();
	}
}
