<?php
/*
 * Plugin Name:       The base files for a plugin
 * Plugin URI:        http://github.com/davideugenepratt/plugin-base
 * Description:       Single Post Meta Manager displays the post meta data associated with a given post.
 * Version:           0.1.0
 * Author:            David Pratt
 * Author URI:        http://www.davideugenepratt.com
 * Text Domain:       dep-plugin-base-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */
 
if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/class-dep-plugin-base.php';
 
function run_dep_plugin_base() {
 
    $dep_p_b = new DEP_Plugin_Base();
    $dep_p_b->run();
 
}
 
run_dep_plugin_base();