<?php

class Formation_Plugin_Options_Page {

	function __construct() {

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

	}

	function admin_menu () {

		add_options_page( 'Formation Plugin Settings','Formation Plugin','manage_options','formation-plugin-options', array( $this, 'settings_page' ) );

	}

	function  settings_page () {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/views/options-page.php' );

	}

}