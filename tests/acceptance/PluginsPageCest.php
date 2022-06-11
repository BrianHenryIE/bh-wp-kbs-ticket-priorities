<?php

class PluginsPageCest {


	/**
	 * Login and navigate to plugins.php.
	 *
	 * @param AcceptanceTester $I The Codeception actor object.
	 */
	public function _before( AcceptanceTester $I ): void {
		$I->loginAsAdmin();

		$I->amOnPluginsPage();
	}

	/**
	 * Verify the name of the plugin has been set.
	 *
	 * @param AcceptanceTester $I The Codeception actor object.
	 */
	public function testPluginsPageForName( AcceptanceTester $I ): void {

		$I->canSee( 'BH WP KBS Ticket Priorities' );
	}

	/**
	 * Check the description displayed on plugins.php has been changed from the default.
	 *
	 * @param AcceptanceTester $I The Codeception actor object.
	 */
	public function testPluginDescriptionHasBeenSet( AcceptanceTester $I ): void {

		$default_plugin_description = "This is a short description of what the plugin does. It's displayed in the WordPress admin area.";

		$I->cantSee( $default_plugin_description );
	}

}
