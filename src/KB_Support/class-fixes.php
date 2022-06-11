<?php
/**
 * Fixes for bugs in KB Support required for this current to work.
 *
 * @package brianhenryie/bh-wp-kbs-ticket-priorities
 */

namespace BrianHenryIE\KBS_Ticket_Priorities\KB_Support;

/**
 * Remove a $_GET variable if it is obviously incorrect.
 * "Translate" the text string we want to hide to an empty string.
 */
class Fixes {

	/**
	 * Before the WordPress query is run, check a mal-formed query might be created and remove the troublesome
	 * querystring if necessary.
	 *
	 * @see https://github.com/WPChill/kb-support/pull/225
	 *
	 * @hooked pre_get_posts
	 *
	 * phpcs:disable WordPress.Security.NonceVerification.Recommended
	 */
	public function admin_filter(): void {
		if ( isset( $_GET['agent'] ) && ! is_numeric( $_GET['agent'] ) ) {
			unset( $_GET['agent'] );
		}
	}


	/**
	 * KB Support prints a "No callback found for post column" message which gets printed in every column
	 * defined which the plugin does not know about. This fix stops the message from appearing, so extra
	 * columns can be added.
	 *
	 * In this case, the ticket priority column.
	 *
	 * @see https://github.com/WPChill/kb-support/pull/224
	 *
	 * @hooked gettext_kb
	 *
	 * @param string $translation The text in the code, maybe already translated.
	 * @param string $text Original text in the code.
	 * @param string $domain The text domain, always kb-support because of the hook we use.
	 *
	 * @return string
	 */
	public function unwanted_text_output( string $translation, string $text, string $domain ): string {
		if ( 'No callback found for post column' === $text ) {
			return '';
		}
		return $translation;

	}


}
