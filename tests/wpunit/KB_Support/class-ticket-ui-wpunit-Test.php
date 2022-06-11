<?php

namespace BrianHenryIE\KBS_Ticket_Priorities\KB_Support;

use BrianHenryIE\ColorLogger\ColorLogger;
use BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\Taxonomy;
use Codeception\Stub\Expected;
use KBS_HTML_Elements;

/**
 * @coversDefaultClass \BrianHenryIE\KBS_Ticket_Priorities\KB_Support\Ticket_UI
 */
class Ticket_UI_WPUnit_Test extends \Codeception\TestCase\WPTestCase {

	/**
	 * @covers ::print_dropdown
	 */
	public function test_print_dropdown(): void {

		$kbs_html = $this->makeEmpty(
			KBS_HTML_Elements::class,
			array(
				'select' => Expected::once(
					function( array $args ) {
						$this->assertEquals( 'ticket_priority', $args['name'] );
						$this->assertEquals( 'ticket_priority', $args['id'] );
						return '';
					}
				),
			)
		);

		$logger = new ColorLogger();

		// Need to register the taxonomy first.
		$taxonomy = new Taxonomy( $logger );
		$taxonomy->register_priority_taxonomy();
		$taxonomy->register_priorities_terms();

		$sut = new Ticket_UI( $kbs_html );

		// Set the selected priority.
		add_filter(
			'wp_get_object_terms',
			function( $terms, $object_ids, $taxonomies, $args ) {
				return $terms;
			},
			10,
			4
		);

		$ticket_id = 1234;

		$sut->print_dropdown( $ticket_id );

	}

}
