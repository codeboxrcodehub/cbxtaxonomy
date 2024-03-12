<?php

namespace Cbx\Taxonomy;

use Cbx\Taxonomy\Migrations\CBXWPMigrationsTable;
use Illuminate\Database\Capsule\Manager;

/**
 * Class CBXTaxonomyHelper
 * @package Cbx\Taxonomy
 * @since 1.0.0
 */
class CBXTaxonomyHelper {

	/**
	 * loading orm dependency
	 *
	 * @since 1.0.0
	 */
	public static function load_orm() {

		/**
		 * init DB in ORM
		 */
		global $wpdb;

		$capsule = new Manager();

		$connection_params = [
			"driver"   => "mysql",
			"host"     => DB_HOST,
			"database" => DB_NAME,
			"username" => DB_USER,
			"password" => DB_PASSWORD,
			"prefix"   => $wpdb->prefix,
			//'charset'   => DB_CHARSET,
			//'collation' => DB_COLLATE,
		];

		if ( $wpdb->has_cap( 'collation' ) ) {
			if ( DB_CHARSET != '' ) {
				//$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
				$connection_params['charset'] = DB_CHARSET;
			}
			if ( DB_COLLATE != '' ) {
				//$charset_collate .= " COLLATE $wpdb->collate";
				$connection_params['collation'] = DB_COLLATE;
			}
		}

		$capsule->addConnection( apply_filters( 'cbxwpmigrations_connection_params', $connection_params ) );

		$capsule->setAsGlobal();
		$capsule->bootEloquent();
	} // end of method load_orm

	/**
	 * Active plugin
	 * @since 1.0.0
	 */
	public static function active_plugin() {
		$texonomy_migration_files = [
			'CBXWPMigrationsTable',
			'CBXTaxonomyTaxonomyTableV1D0D0',
			'CBXTaxonomyTaxableTableV1D0D0',
			'CBXTaxonomyTaxableUpdateTableV1D0D0',
			'CBXTaxonomyTableAlter',
		];

		new CBXWPMigrationsTable( $texonomy_migration_files, CBXTAXONOMY_PLUGIN_NAME );
	}//end method active plugin

}//end class CBXTaxonomyHelper