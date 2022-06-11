<?php
/**
 * We need a taxonomy "ticket priority".
 * With entries low|medium|high
 * and assigned to tickets (posts)
 * and a default for tickets with none.
 *
 * @package brianhenryie/bh-wp-kbs-ticket-priorities
 */

namespace BrianHenryIE\KBS_Ticket_Priorities\WP_Includes;

/**
 * Registers with register_taxonomy and adds each level with wp_insert_term.
 *
 * @see register_taxonomy()
 * @see wp_insert_term()
 */
class Taxonomy {

	const TAXONOMY_PRIORITY_SLUG = 'ticket_priority';

	/**
	 * Register the new taxonomy type, "ticket_priority"
	 *
	 * @hooked init
	 * @see register_taxonomy_for_object_type()
	 */
	public function register_priority_taxonomy(): void {

		if ( ! post_type_exists( 'kbs_ticket' ) ) {
			return;
		}

		$labels = array(
			'name'          => _x( 'Priority', 'taxonomy general name' ),
			'singular_name' => _x( 'Priority', 'taxonomy singular name' ),
			'all_items'     => __( 'All Priorities' ),
		);
		$args   = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => false,
			'show_admin_column' => true,
			'query_var'         => true,
		);
		register_taxonomy( self::TAXONOMY_PRIORITY_SLUG, array( 'kbs_ticket' ), $args );

		register_taxonomy_for_object_type( self::TAXONOMY_PRIORITY_SLUG, 'kbs_ticket' );
	}

	/**
	 * Register "Low", "Medium" and "High" terms.
	 * Which will register their slugs as "low", "medium" and "high".
	 *
	 * @hooked init
	 */
	public function register_priorities_terms(): void {

		$priorities = array( 'Low', 'Medium', 'High' );

		foreach ( $priorities as $priority ) {
			if ( ! term_exists( $priority, self::TAXONOMY_PRIORITY_SLUG ) ) {
				wp_insert_term( $priority, self::TAXONOMY_PRIORITY_SLUG );
			}
		}

	}
}
