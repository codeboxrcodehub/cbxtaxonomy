<?php

use Cbx\Taxonomy\CBXTaxonomyHelper;
use Cbx\Taxonomy\Hooks;

/**
 * Class CBXTaxonomy
 * @package Cbx\Taxonomy
 * @since 1.0.0
 */
final class CBXTaxonomy {
	/**
	 * @var null
	 * @since 1.0.0
	 */
	private static $instance = null;

	/**
	 * @var $version
	 * @since 1.0.0
	 */
	private $version;

	/**
	 * @var string $plugin_name
	 * @since 1.0.0
	 */
	private $plugin_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->version     = CBXTAXONOMY_PLUGIN_VERSION;
		$this->plugin_name = CBXTAXONOMY_PLUGIN_NAME;

		$this->include_files();



		new Hooks();//we are not using the github update checker
	}//end of method constructor

	/**
	 * Create instance
	 *
	 * @return CBXTaxonomy
	 * @since 1.0.0
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}//end method instance

	/**
	 * Include necessary files
	 *
	 * @return void
	 */
	private function include_files() {
		require_once __DIR__ . '/../lib/autoload.php';
	}//end method include_files
}//end class CBXTaxonomy