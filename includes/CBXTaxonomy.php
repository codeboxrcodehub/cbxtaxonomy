<?php

namespace Cbx\Taxonomy;

/**
 * Class CBXTaxonomy
 * @package Cbx\Taxonomy
 * @since 1.0.0
 */
class CBXTaxonomy
{

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
	public function __construct()
	{
		$this->version = CBXTAXONOMY_PLUGIN_VERSION;
		$this->plugin_name = CBXTAXONOMY_PLUGIN_NAME;

		//$this->unit_testing();
		$this->load_orm();
		$this->load_plugin_textdomain();
		new Hooks();
	}//end of method constructor

	/**
	 * Create instance
	 *
	 * @return CBXTaxonomy
	 * @since 1.0.0
	 */
	public static function instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}//end method instance

	/**
	 * Load textdomain
	 *
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain()
	{
		load_plugin_textdomain('cbxtaxonomy', false, CBXTAXONOMY_ROOT_PATH . 'languages/');
	}//end method load_plugin_textdomain

	/**
	 * Load ORM using helper class
	 *
	 * @since 1.0.0
	 */
	public function load_orm()
	{
		$taxonomy_helper = new CBXTaxonomyHelper();
		add_action('init', [$taxonomy_helper, 'load_orm']);
	} // end of load_orm

	/**
	 * Run test hooks
	 *
	 * @since 1.0.0
	 */
	public function unit_testing()
	{
		if (CBXTAXONOMY_DEV_MODE) {
			add_action('cbxtaxonomy_taxable_delete_before', [
				$this,
				'cbxtaxonomy_taxable_delete_before_test'
			], 10, 3);
			add_action('cbxtaxonomy_taxable_delete_after', [$this, 'cbxtaxonomy_taxable_delete_after_test'], 10, 3);
			add_action('cbxtaxonomy_taxable_delete_failed', [
				$this,
				'cbxtaxonomy_taxable_delete_failed_test'
			], 10, 3);

			add_action('cbxtaxonomy_taxonomy_delete_before', [
				$this,
				'cbxtaxonomy_taxonomy_delete_before_test'
			], 10, 3);
			add_action('cbxtaxonomy_taxonomy_delete_after', [
				$this,
				'cbxtaxonomy_taxonomy_delete_after_test'
			], 10, 3);
			add_action('cbxtaxonomy_taxonomy_delete_failed', [
				$this,
				'cbxtaxonomy_taxonomy_delete_failed_test'
			], 10, 3);

			add_action('cbxtaxonomy_taxonomy_save_before', [$this, 'cbxtaxonomy_taxonomy_save_before_test'], 10, 2);
			add_action('cbxtaxonomy_taxonomy_save_after', [$this, 'cbxtaxonomy_taxonomy_save_after_test'], 10, 2);
			add_action('cbxtaxonomy_taxonomy_save_failed', [$this, 'cbxtaxonomy_taxonomy_save_failed_test'], 10, 2);
		}
	} // end of unit_testing

	/**
	 * run before taxable delete
	 *
	 * @param $taxonomy_id
	 * @param $type
	 * @param $data
	 *
	 * @since 1.0.0
	 */
	public function cbxtaxonomy_taxable_delete_before_test($taxonomy_id, $type, $data)
	{
		if (function_exists('write_log')) {
			write_log('before taxable delete hook $taxonomy_id=' . $taxonomy_id . ' $type=' . $type);
		}
	}//end of  cbxtaxonomy_taxable_delete_before_test

	/**
	 * run after taxable delete
	 *
	 * @param $taxonomy_id
	 * @param $type
	 * @param $data
	 *
	 * @since 1.0.0
	 */
	public function cbxtaxonomy_taxable_delete_after_test($taxonomy_id, $type, $data)
	{
		if (function_exists('write_log')) {
			write_log('before taxable delete hook $taxonomy_id=' . $taxonomy_id . ' $type=' . $type);
		}

	}//end of cbxtaxonomy_taxable_delete_after_test

	/**
	 * run on failed taxable delete
	 *
	 * @param $taxonomy_id
	 * @param $type
	 * @param $data
	 *
	 * @since 1.0.0
	 */
	public function cbxtaxonomy_taxable_delete_failed_test($taxonomy_id, $type, $data)
	{
		if (function_exists('write_log')) {
			write_log('before taxable delete hook $taxonomy_id=' . $taxonomy_id . ' $type=' . $type);
		}

	}//end of cbxtaxonomy_taxable_delete_failed_test

	/**
	 * run before taxonomy delete
	 *
	 * @param $id
	 * @param $type
	 * @param $data
	 *
	 * @since 1.0.0
	 */
	public function cbxtaxonomy_taxonomy_delete_before_test($id, $type, $data)
	{
		if (function_exists('write_log')) {
			write_log($id . " here is the id => " . $type);
		}
	}//end of cbxtaxonomy_taxonomy_delete_before_test

	/**
	 * run after taxonomy delete
	 *
	 * @param $id
	 * @param $type
	 * @param $data
	 *
	 * @since 1.0.0
	 */
	public function cbxtaxonomy_taxonomy_delete_after_test($id, $type, $data)
	{
		if (function_exists('write_log')) {
			write_log($id . " here is the id => " . $type);
		}
	}//end of cbxtaxonomy_taxonomy_delete_after_test

	/**
	 * run on fail taxonomy delete
	 *
	 * @param $id
	 * @param $type
	 * @param $data
	 *
	 * @since 1.0.0
	 */
	public function cbxtaxonomy_taxonomy_delete_failed_test($id, $type, $data)
	{
		if (function_exists('write_log')) {
			write_log($id . " here is the id => " . $type);
		}
	}//end of cbxtaxonomy_taxonomy_delete_failed_test

	/**
	 * run before taxonomy save
	 *
	 * @param $type
	 * @param $data
	 *
	 * @since 1.0.0
	 */
	public function cbxtaxonomy_taxonomy_save_before_test($type, $data)
	{
		if (function_exists('write_log')) {
			write_log("taxonomy save here is the id => " . $type);
		} else {
			error_log("taxonomy save here is the id => " . $type);
		}
	}//end of cbxtaxonomy_taxonomy_save_before_test

	/**
	 * run after taxonomy save
	 *
	 * @param $type
	 * @param $data
	 *
	 * @since 1.0.0
	 */
	public function cbxtaxonomy_taxonomy_save_after_test($type, $data)
	{
		if (function_exists('write_log')) {
			write_log("taxonomy save here is the id => " . $type);
		}
	}//end of cbxtaxonomy_taxonomy_save_after_test

	/**
	 * run on fail taxonomy save
	 *
	 * @param $type
	 * @param $data
	 *
	 * @since 1.0.0
	 */
	public function cbxtaxonomy_taxonomy_save_failed_test($type, $data)
	{
		if (function_exists('write_log')) {
			write_log("taxonomy save here is the id => " . $type);
		}
	}//end of cbxtaxonomy_taxonomy_save_failed_test


}//end class CBXTaxonomy