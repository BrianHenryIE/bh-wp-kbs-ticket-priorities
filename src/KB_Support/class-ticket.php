<?php
/**
 * Save the priority as the ticket is saved.
 *
 * @package brianhenryie/bh-wp-kbs-ticket-priorities
 */

namespace BrianHenryIE\KBS_Ticket_Priorities\KB_Support;

use BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\Taxonomy;
use WP_Post;
use WP_Term;

/**
 * Functions corresponding to kb-support/includes/admin/tickets/tickets.php.
 */
class Ticket {

	/**
	 * When the ticket is being saved in the admin UI, save its priority.
	 *
	 * @hooked kbs_save_ticket
	 * @see kbs_ticket_post_save
	 *
	 * @param int     $ticket_id The WP_Post ID of the ticket.
	 * @param WP_Post $post The kbs_ticket post itself.
	 */
	public function on_save( int $ticket_id, WP_Post $post ): void {

		if ( false === check_admin_referer( 'kbs_ticket_meta_save', 'kbs_ticket_meta_box_nonce' ) ) {
			return;
		}

		if ( ! isset( $_POST['ticket_priority'] ) ) {
			return;
		}

		$new_priority = intval( $_POST['ticket_priority'] );

		/**
		 * All ticket_priority terms on the ticket already.
		 *
		 * There should only be one.
		 *
		 * If there is none, the new one will be added.
		 * If there is one and it is the same, we return early.
		 * If there is one and it has changed, it is set as the only one.
		 * If there is more than one, the new selection is set as the only one.
		 *
		 * @var WP_Term[] $ticket_priority_before
		 */
		$ticket_priority_before = wp_get_object_terms( $ticket_id, Taxonomy::TAXONOMY_PRIORITY_SLUG );

		if ( count( $ticket_priority_before ) === 1 && $ticket_priority_before[0]->term_id === $new_priority ) {
			// Unchanged.
			return;
		}

		$terms = array( $new_priority );

		wp_set_object_terms( $ticket_id, $terms, Taxonomy::TAXONOMY_PRIORITY_SLUG );

	}
}
