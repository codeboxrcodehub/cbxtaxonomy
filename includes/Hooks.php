<?php

namespace Cbx\Taxonomy;

use Cbx\Taxonomy\CBXTaxonomyHelper;

class Hooks {
	public function __construct() {
		$helper          = new CBXTaxonomyHelper();
		$taxonomy_helper = new CBXTaxonomyHelper();

		add_action( 'init', [ $helper, 'load_plugin_textdomain' ] );
		add_filter( 'plugin_row_meta', [ $helper, 'plugin_row_meta' ], 10, 4 );

		add_filter( 'pre_set_site_transient_update_plugins', [
			$helper,
			'pre_set_site_transient_update_plugins'
		] );
		add_filter( 'plugins_api', [ $helper, 'plugin_info' ], 10, 3 );


		add_action( 'init', [ $taxonomy_helper, 'load_orm' ] );

		//$this->unit_testing();//don't delete this
	}

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
}//end class Hooks