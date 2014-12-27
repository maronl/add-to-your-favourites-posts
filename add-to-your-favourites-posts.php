<?php
/**
 * The file responsible for starting the Add to your favourites posts plugin
 *
 * Wordpress plugin to add favourites posts functions. as usual not find an existing plugin meet my need at 100% so implementing my own.
 * *
 * @wordpress-plugin
 * Plugin Name: Add to your favourites posts
 * Plugin URI: https://github.com/maronl/add-to-your-favourites-posts
 * Description: Wordpress plugin to add favourites posts functions. as usual not find an existing plugin meet my need at 100% so implementing my own.
 * Version: 1.0.0
 * Author: Luca Maroni
 * Author URI: http://maronl.it
 * Text Domain: add-to-your-favourites-posts
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, then abort execution.
if (!defined('WPINC')) {
    die;
}

/**
 * Include the core class responsible for loading all necessary components of the plugin.
 */
require_once plugin_dir_path(__FILE__) . 'includes/class-atyfp-manager.php';

/**
 * Instantiates the Add to your favourites posts Manager class and then
 * calls its run method officially starting up the plugin.
 */
function run_atyfp_manager()
{

    $onlimag = new Atyfp_Manager();
    $onlimag->run();

}

// Call the above function to begin execution of the plugin.
run_atyfp_manager();