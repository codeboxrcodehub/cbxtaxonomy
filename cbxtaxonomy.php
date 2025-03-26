<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://codeboxr.com
 * @since             1.0.0
 * @package           cbxtaxonomy
 *
 * @wordpress-plugin
 * Plugin Name:       CBX Taxonomy
 * Plugin URI:        https://github.com/codeboxrcodehub/cbxtaxonomy
 * Description:       Custom taxonomy system for custom table/custom object types. This feature plugin is required for ComfortResume, ComfortJob and others plugins.
 * Version:           1.0.1
 *  Requires at least: 5.3
 *  Requires PHP:      8.2
 * Author:            Codeboxr
 * Author URI:        https://codeboxr.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cbxtaxonomy
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

use Cbx\Taxonomy\CBXTaxonomyHelper;

defined( 'CBXTAXONOMY_PLUGIN_NAME' ) or define( 'CBXTAXONOMY_PLUGIN_NAME', 'cbxtaxonomy' );
defined( 'CBXTAXONOMY_PLUGIN_VERSION' ) or define( 'CBXTAXONOMY_PLUGIN_VERSION', '1.0.1' );
defined( 'CBXTAXONOMY_BASE_NAME' ) or define( 'CBXTAXONOMY_BASE_NAME', plugin_basename( __FILE__ ) );
defined( 'CBXTAXONOMY_ROOT_PATH' ) or define( 'CBXTAXONOMY_ROOT_PATH', plugin_dir_path( __FILE__ ) );
defined( 'CBXTAXONOMY_ROOT_URL' ) or define( 'CBXTAXONOMY_ROOT_URL', plugin_dir_url( __FILE__ ) );

//for development purpose only
defined( 'CBXTAXONOMY_DEV_MODE' ) or define( 'CBXTAXONOMY_DEV_MODE', true );

// Include the main CBXTaxonomy class.
if ( ! class_exists( 'CBXTaxonomy', false ) ) {
	include_once CBXTAXONOMY_ROOT_PATH . 'includes/CBXTaxonomy.php';
}


register_activation_hook( __FILE__, 'activate_cbxtaxonomy' );
register_deactivation_hook( __FILE__, 'deactivate_cbxtaxonomy' );

/**
 *  * The code that runs during plugin activation.
 * The code that runs during plugin deactivation.
 */
function activate_cbxtaxonomy() {
	cbxtaxonomy();

	CBXTaxonomyHelper::load_orm();
	CBXTaxonomyHelper::active_plugin();
}//end function activate_cbxtaxonomy

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_cbxtaxonomy() {
	//cbxtaxonomy();
	//CBXTaxonomyHelper::load_orm();
}//end function deactivate_cbxtaxonomy


/**
 * Returns the main instance of CBXTaxonomy.
 *
 * @since  1.0
 */
function cbxtaxonomy() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	global $cbxtaxonomy;

	// If the global variable is not already set, initialize it
	if ( ! isset( $cbxtaxonomy ) ) {
		$cbxtaxonomy = run_cbxtaxonomy();
	}

	return $cbxtaxonomy;
}//end function cbxtaxonomy_core

/**
 * Initialize ComfortResume pro plugin
 * @since 1.0.0
 */
function run_cbxtaxonomy() {
	return CBXTaxonomy::instance();
}//end function run_cbxtaxonomy

/**
 * Init cbxtaxonomy plugin
 */
function cbxtaxonomy_init() {
	$GLOBALS['cbxtaxonomy'] = run_cbxtaxonomy();
}//end function cbxtaxonomy_init

add_action( 'plugins_loaded', 'cbxtaxonomy_init' );