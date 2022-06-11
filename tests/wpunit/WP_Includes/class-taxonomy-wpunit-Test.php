<?php

namespace BrianHenryIE\KBS_Ticket_Priorities\WP_Includes;

use BrianHenryIE\ColorLogger\ColorLogger;

/**
 * @coversDefaultClass \BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\Taxonomy
 */
class Taxonomy_WPUnit_Test extends \Codeception\TestCase\WPTestCase {


	/**
	 * @covers ::register_priority_taxonomy
	 */
	public function test_register_priority_taxonomy(): void {

		$logger = new ColorLogger();
		$sut    = new Taxonomy( $logger );

		$r                 = unregister_taxonomy( 'ticket_priority' );
		$taxonomies_before = get_object_taxonomies( 'kbs_ticket' );
		assert( ! in_array( 'ticket_priority', $taxonomies_before, true ) );

		$sut->register_priority_taxonomy();

		$taxonomies_after = get_object_taxonomies( 'kbs_ticket' );

		$this->assertContains( 'ticket_priority', $taxonomies_after );
	}

	/**
	 * @covers ::register_priorities_terms
	 */
	public function test_register_priorities_terms(): void {

		$logger = new ColorLogger();
		$sut    = new Taxonomy( $logger );

		$sut->register_priority_taxonomy();
		assert( in_array( 'ticket_priority', get_object_taxonomies( 'kbs_ticket' ), true ) );

		$sut->register_priorities_terms();

		$terms = get_terms(
			array(
				'taxonomy'   => 'ticket_priority',
				'hide_empty' => false,
			)
		);

		$this->assertCount( 3, $terms );

	}

}
