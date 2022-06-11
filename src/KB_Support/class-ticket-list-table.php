<?php
/**
 * Add a column on the KB Support ticket list showing the ticket priority.
 * Allows filtering by priority.
 *
 * @package brianhenryie/bh-wp-kbs-ticket-priorities
 */

namespace BrianHenryIE\KBS_Ticket_Priorities\KB_Support;

use BrianHenryIE\KBS_Ticket_Priorities\WP_Includes\Taxonomy;
use WP_Taxonomy;
use WP_Term;

/**
 * Registers the column, prints the column value, registers the column filter.
 *
 * @see \WP_List_Table
 * @see restrict_manage_posts()
 */
class Ticket_List_Table {

	/**
	 * Append the Priority column to the list table's columns.
	 *
	 * @hooked manage_kbs_ticket_posts_columns
	 * @param array<string, string> $columns The existing list of columns.
	 * @return array<string, string>
	 */
	public function add_ticket_priority_to_columns( array $columns ): array {
		$columns['ticket_priority'] = __( 'Priority', 'bh-wp-ticket-priority' );

		return $columns;
	}

	/**
	 * Print the ticket priority in the ticket priority column.
	 *
	 * @hooked manage_kbs_ticket_posts_custom_column
	 *
	 * @param string $column The column id, hopefully as added in the array above.
	 * @param int    $ticket_id WP_Posts ID of the ticket.
	 */
	public function print_ticket_priority_column( string $column, int $ticket_id ): void {

		if ( 'ticket_priority' !== $column ) {
			return;
		}

		/**
		 * All ticket_priority terms on this ticket. Should only every be one.
		 *
		 * @var WP_Term[] $ticket_priority
		 */
		$ticket_priority = wp_get_object_terms( $ticket_id, Taxonomy::TAXONOMY_PRIORITY_SLUG );
		$priority        = empty( $ticket_priority ) ? 'medium' : $ticket_priority[0]->name;

		echo '<span class="ticket-priority ticket-priority-' . esc_attr( $priority ) . '">' . esc_html( ucfirst( $priority ) ) . '</span>';

	}

	/**
	 * Prints the drop-down filter options and handles filtering the table when one is selected.
	 *
	 * @see https://wordpress.stackexchange.com/questions/578/adding-a-taxonomy-filter-to-admin-list-for-a-custom-post-type
	 *
	 * @hooked restrict_manage_posts
	 */
	public function register_filter(): void {
		global $typenow;
		if ( 'kbs_ticket' !== $typenow ) {
			return;
		}

		$tax_slug = Taxonomy::TAXONOMY_PRIORITY_SLUG;

		/**
		 * The taxonomy object from WordPress.
		 *
		 * @var WP_Taxonomy $priority_taxonomy
		 */
		$priority_taxonomy = get_taxonomy( $tax_slug );

		$selected = get_query_var( $tax_slug ) ?? 0;

		wp_dropdown_categories(
			array(
				'show_option_all' => (string) $priority_taxonomy->labels->all_items,
				'selected'        => $selected,
				'name'            => (string) $priority_taxonomy->query_var,
				'id'              => "filter-by-{$priority_taxonomy->query_var}",
				'value_field'     => 'slug',
				'taxonomy'        => (string) $priority_taxonomy->query_var,
				'hide_empty'      => false,
			)
		);

	}

}
