<?php
/*
 * Plugin Name:       Formation PLugin
 * Plugin URI:        http://github.com/davideugenepratt/plugin-base
 * Description:       Provides extra functionality to the Formation Starter Theme.
 * Version:           0.1.0
 * Author:            David Pratt
 * Author URI:        http://www.davideugenepratt.com
 * Text Domain:       formation-plugin
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */
 
if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/class-formation-plugin.php';
 
function run_formation_plugin() {
 
    $formation_plugin = new Formation_Plugin();
    $formation_plugin->run();
 
}
 
run_formation_plugin();