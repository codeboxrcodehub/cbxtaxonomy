<?php
namespace Cbx\Taxonomy\Migrations;
use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class CBXTaxonomyTaxableUpdateTableV1D0D0
 * @package Cbx\Taxonomy\Migrations
 * @since 1.0.0
 */
class CBXTaxonomyTaxableUpdateTableV1D0D0 {

	public function __construct() {
		$cbxresume_table = 'cbxtaxable';
		try {
			if (Capsule::schema()->hasTable($cbxresume_table) && Capsule::schema()->hasColumn($cbxresume_table,'title')) {
				Capsule::schema()->table($cbxresume_table, function ($table) {
					$table->dropColumn('title');
				});
			}
		} catch ( Exception $e ) {
			if ( function_exists( 'write_log' ) ) {
				write_log( $e->getMessage() );
			}
		}
	}
}//end class CBXTaxonomyTaxableUpdateTableV1D0D0