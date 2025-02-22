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

		//$this->unit_testing();
		$this->load_orm();
		$this->load_plugin_textdomain();

		add_filter( 'plugin_row_meta', [ $this, 'plugin_row_meta' ], 10, 4 );

		//new Hooks();
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

	/**
	 * Load textdomain
	 *
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'cbxtaxonomy', false, CBXTAXONOMY_ROOT_PATH . 'languages/' );
	}//end method load_plugin_textdomain

	/**
	 * Load ORM using helper class
	 *
	 * @since 1.0.0
	 */
	public function load_orm() {
		$taxonomy_helper = new CBXTaxonomyHelper();
		add_action( 'init', [ $taxonomy_helper, 'load_orm' ] );
	}// end of load_orm

	/**
	 * Filters the array of row meta for each/specific plugin in the Plugins list table.
	 * Appends additional links below each/specific plugin on the plugins page.
	 *
	 * @access  public
	 *
	 * @param  array  $links_array  An array of the plugin's metadata
	 * @param  string  $plugin_file_name  Path to the plugin file
	 * @param  array  $plugin_data  An array of plugin data
	 * @param  string  $status  Status of the plugin
	 *
	 * @return  array       $links_array
	 */
	public function plugin_row_meta( $links_array, $plugin_file_name, $plugin_data, $status ) {
		if ( strpos( $plugin_file_name, CBXTAXONOMY_BASE_NAME ) !== false ) {
			if ( ! function_exists( 'is_plugin_active' ) ) {
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			}

			$links_array[] = '<a target="_blank" style="color:#005ae0 !important; font-weight: bold;" href="https://github.com/codeboxrcodehub/cbxwptaxonomy" aria-label="' . esc_attr__( 'Github Repo', 'cbxwptaxonomy' ) . '">' . esc_html__( 'Github Repo', 'cbxwptaxonomy' ) . '</a>';
			$links_array[] = '<a target="_blank" style="color:#005ae0 !important; font-weight: bold;" href="https://github.com/codeboxrcodehub/cbxwptaxonomy/releases" aria-label="' . esc_attr__( 'Download', 'cbxwptaxonomy' ) . '">' . esc_html__( 'Download Latest', 'cbxwptaxonomy' ) . '</a>';
		}

		return $links_array;
	}//end plugin_row_meta

	/**
	 * Run test hooks
	 *
	 * @since 1.0.0
	 */
	public function unit_testing() {
		if ( CBXTAXONOMY_DEV_MODE ) {
			add_action( 'cbxtaxonomy_taxable_delete_before', [
				$this,
				'cbxtaxonomy_taxable_delete_before_test'
			], 10, 3 );
			add_action( 'cbxtaxonomy_taxable_delete_after', [ $this, 'cbxtaxonomy_taxable_delete_after_test' ], 10, 3 );
			add_action( 'cbxtaxonomy_taxable_delete_failed', [
				$this,
				'cbxtaxonomy_taxable_delete_failed_test'
			], 10, 3 );

			add_action( 'cbxtaxonomy_taxonomy_delete_before', [
				$this,
				'cbxtaxonomy_taxonomy_delete_before_test'
			], 10, 3 );
			add_action( 'cbxtaxonomy_taxonomy_delete_after', [
				$this,
				'cbxtaxonomy_taxonomy_delete_after_test'
			], 10, 3 );
			add_action( 'cbxtaxonomy_taxonomy_delete_failed', [
				$this,
				'cbxtaxonomy_taxonomy_delete_failed_test'
			], 10, 3 );

			add_action( 'cbxtaxonomy_taxonomy_save_before', [ $this, 'cbxtaxonomy_taxonomy_save_before_test' ], 10, 2 );
			add_action( 'cbxtaxonomy_taxonomy_save_after', [ $this, 'cbxtaxonomy_taxonomy_save_after_test' ], 10, 2 );
			add_action( 'cbxtaxonomy_taxonomy_save_failed', [ $this, 'cbxtaxonomy_taxonomy_save_failed_test' ], 10, 2 );
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
	public function cbxtaxonomy_taxable_delete_before_test( $taxonomy_id, $type, $data ) {
		if ( function_exists( 'write_log' ) ) {
			write_log( 'before taxable delete hook $taxonomy_id=' . $taxonomy_id . ' $type=' . $type );
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
	public function cbxtaxonomy_taxable_delete_after_test( $taxonomy_id, $type, $data ) {
		if ( function_exists( 'write_log' ) ) {
			write_log( 'before taxable delete hook $taxonomy_id=' . $taxonomy_id . ' $type=' . $type );
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
	public function cbxtaxonomy_taxable_delete_failed_test( $taxonomy_id, $type, $data ) {
		if ( function_exists( 'write_log' ) ) {
			write_log( 'before taxable delete hook $taxonomy_id=' . $taxonomy_id . ' $type=' . $type );
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
	public function cbxtaxonomy_taxonomy_delete_before_test( $id, $type, $data ) {
		if ( function_exists( 'write_log' ) ) {
			write_log( $id . " here is the id => " . $type );
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
	public function cbxtaxonomy_taxonomy_delete_after_test( $id, $type, $data ) {
		if ( function_exists( 'write_log' ) ) {
			write_log( $id . " here is the id => " . $type );
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
	public function cbxtaxonomy_taxonomy_delete_failed_test( $id, $type, $data ) {
		if ( function_exists( 'write_log' ) ) {
			write_log( $id . " here is the id => " . $type );
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
	public function cbxtaxonomy_taxonomy_save_before_test( $type, $data ) {
		if ( function_exists( 'write_log' ) ) {
			write_log( "taxonomy save here is the id => " . $type );
		} else {
			error_log( "taxonomy save here is the id => " . $type );//phpcs:ignore WARNING	WordPress.PHP.DevelopmentFunctions.error_log_error_log
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
	public function cbxtaxonomy_taxonomy_save_after_test( $type, $data ) {
		if ( function_exists( 'write_log' ) ) {
			write_log( "taxonomy save here is the id => " . $type );
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
	public function cbxtaxonomy_taxonomy_save_failed_test( $type, $data ) {
		if ( function_exists( 'write_log' ) ) {
			write_log( "taxonomy save here is the id => " . $type );
		}
	}//end of cbxtaxonomy_taxonomy_save_failed_test
}//end class CBXTaxonomy