<?php

namespace Cbx\Taxonomy\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CBXTaxonomyTableAlter {
	public function __construct() {
		$cbx_taxonomy_table = 'cbxtaxonomy';
		try {
			if ( Capsule::schema()->hasTable( $cbx_taxonomy_table ) ) {
				Capsule::schema()->table( $cbx_taxonomy_table, function ( $table ) {
					$table->text( "misc" )->after( "status" )->nullable();
				} );
			}
		} catch ( Exception $e ) {
			if ( function_exists( 'write_log' ) ) {
				write_log( $e->getMessage() );
			}
		}
	}
}