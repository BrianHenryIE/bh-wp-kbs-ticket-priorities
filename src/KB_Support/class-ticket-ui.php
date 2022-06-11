<?php
/**
 * In the save ticket metabox, add a dropdown showing the ticket priorities.
 *
 * @package brianhenryie/bh-wp-kbs-ticket-priorities
 */

namespace BrianHenryIE\KBS_Ticket_Priorities\KB_Support;

use BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\Taxonomy;
use KBS_HTML_Elements;
use WP_Term;

/**
 * Prints the edit ticket select UI element.
 *
 * @see KBS_HTML_Elements::select()
 */
class Ticket_UI {

	/**
	 * KBS utility class for printing HTML.
	 *
	 * @uses KBS_HTML_Elements::select()
	 *
	 * @var KBS_HTML_Elements
	 */
	protected KBS_HTML_Elements $kbs_html;

	/**
	 * Constructor
	 *
	 * @param KBS_HTML_Elements $kbs_html KBS HTML helper class for consistent UI.
	 */
	public function __construct( KBS_HTML_Elements $kbs_html ) {
		$this->kbs_html = $kbs_html;
	}

	/**
	 * Print the HTML.
	 *
	 * @hooked kbs_ticket_metabox_save_after_status
	 *
	 * @param int $ticket_id The WP_Post ID of the ticket.
	 */
	public function print_dropdown( int $ticket_id ): void {

		/**
		 * The low, medium and high WP_Term objects.
		 *
		 * @var WP_Term[] $priorities
		 */
		$priorities = get_terms(
			array(
				'taxonomy'   => 'ticket_priority',
				'hide_empty' => false,
				'orderby'    => 'ID',
			)
		);

		$priorities_names = array();
		foreach ( $priorities as $priority ) {
			$priorities_names[ $priority->term_id ] = ucfirst( $priority->name ) . ' Priority';
		}

		$medium_id = array_search( 'Medium Priority', $priorities_names, true );

		/**
		 * Array of ticket_priority terms on this ticket, should be one, first one is used if more than one present.
		 *
		 * @var WP_Term[] $ticket_priority
		 */
		$ticket_priority = wp_get_object_terms( $ticket_id, Taxonomy::TAXONOMY_PRIORITY_SLUG );
		$selected        = empty( $ticket_priority ) ? $medium_id : $ticket_priority[0]->term_id;

		$args = array(
			'options'          => $priorities_names,
			'name'             => 'ticket_priority',
			'id'               => 'ticket_priority',
			'selected'         => $selected,
			'chosen'           => true, // bool which adds the .kbs_select_chosen CSS class.
			'placeholder'      => 'Priority',
			'multiple'         => false,
			'show_option_all'  => false,
			'show_option_none' => false,
			'data'             => array(),
		);

		// Bad type hinting at KBS_HTML_Elements::select().
		echo wp_kses(
			$this->kbs_html->select( $args ),
			array(
				'select' => array(
					'name'             => array(),
					'id'               => array(),
					'class'            => array(),
					'data-placeholder' => array(),
				),
				'option' => array(
					'value'    => array(),
					'selected' => array(),
				),
			)
		);
	}
}
