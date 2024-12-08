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
 * Plugin URI:        https://wordpress.org/plugins/cbxtaxonomy
 * Description:       Custom taxonomy system for custom table/custom object types. This feature plugin is required for ComfortResume, ComfortJob and others codeboxr's plugins.
 * Version:           1.0.0
 *  Requires at least: 3.5
 *  Requires PHP:      8.2
 * Author:            Codeboxr
 * Author URI:        https://codeboxr.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cbxtaxonomy
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

defined('CBXTAXONOMY_PLUGIN_NAME') or define('CBXTAXONOMY_PLUGIN_NAME', 'cbxtaxonomy');
defined('CBXTAXONOMY_PLUGIN_VERSION') or define('CBXTAXONOMY_PLUGIN_VERSION', '1.0.0');
defined('CBXTAXONOMY_BASE_NAME') or define('CBXTAXONOMY_BASE_NAME', plugin_basename(__FILE__));
defined('CBXTAXONOMY_ROOT_PATH') or define('CBXTAXONOMY_ROOT_PATH', plugin_dir_path(__FILE__));
defined('CBXTAXONOMY_ROOT_URL') or define('CBXTAXONOMY_ROOT_URL', plugin_dir_url(__FILE__));
defined('CBXTAXONOMY_DEV_MODE') or define('CBXTAXONOMY_DEV_MODE', true);

require_once CBXTAXONOMY_ROOT_PATH . "lib/autoload.php";

register_activation_hook(__FILE__, 'activate_cbxtaxonomy');
register_deactivation_hook(__FILE__, 'deactivate_cbxtaxonomy');

/**
 *  * The code that runs during plugin activation.
 * The code that runs during plugin deactivation.
 */
function activate_cbxtaxonomy()
{
	\Cbx\Taxonomy\CBXTaxonomyHelper::load_orm();
	\Cbx\Taxonomy\CBXTaxonomyHelper::active_plugin();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_cbxtaxonomy()
{
	\Cbx\Taxonomy\CBXTaxonomyHelper::load_orm();
}


/**
 * Init cbxtaxonomy plugin
 */
function cbxtaxonomy()
{
	if (defined('CBXTAXONOMY_PLUGIN_NAME')) {
		\Cbx\Taxonomy\CBXTaxonomy::instance();
	}
}//end function cbxtaxonomy

add_action('plugins_loaded', 'cbxtaxonomy');

