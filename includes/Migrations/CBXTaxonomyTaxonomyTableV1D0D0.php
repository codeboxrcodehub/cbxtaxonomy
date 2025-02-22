<?php

namespace Cbx\Taxonomy\Migrations;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class CBXTaxonomyTaxonomyTableV1D0D0
 * @package Cbx\Taxonomy\Migrations
 * @since 1.0.0
 */
class CBXTaxonomyTaxonomyTableV1D0D0 {

	public function __construct() {
		$cbxtaxonomy_table = 'cbxtaxonomy';
		try {
			if ( ! Capsule::schema()->hasTable( $cbxtaxonomy_table ) ) {
				Capsule::schema()->create( $cbxtaxonomy_table, function ( $table ) {
					$table->bigIncrements( 'id' );
					$table->string( 'title' );
					$table->string( 'slug' )->nullable();
					$table->string( 'type' )->nullable()->comment( 'taxonomy types' );
					$table->string( 'icon' )->nullable();
					$table->integer( 'parent_id' )->nullable();
					$table->boolean( 'status' )->default( 1 )->comment( '0 = inactive, 1 = active' );
					$table->dateTime( 'add_date' )->nullable()->comment( 'created date' );
					$table->dateTime( 'mod_date' )->nullable()->comment( 'modified date' );
				} );
			}
		} catch ( Exception $e ) {
			if ( function_exists( 'write_log' ) ) {
				write_log( $e->getMessage() );
			}
		}
	}
}//end class CBXTaxonomyTaxonomyTableV1D0D0