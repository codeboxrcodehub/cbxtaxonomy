<?php

namespace Cbx\Taxonomy\Migrations;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class CBXTaxonomyTaxableTableV1D0D0
 * @package Cbx\Taxonomy\Migrations
 * @since 1.0.0
 */
class CBXTaxonomyTaxableTableV1D0D0 {

	public function __construct() {
		$cbxresume_table = 'cbxtaxable';
		try {
			if (!Capsule::schema()->hasTable($cbxresume_table)) {
				Capsule::schema()->create($cbxresume_table, function ($table) {
					$table->bigIncrements('id');
					$table->bigInteger('taxonomy_id');
					$table->bigInteger('taxable_id');
					$table->string('taxable_type')->nullable()->comment('type of taxable taxonomy');
					$table->dateTime('add_date')->nullable()->comment('created date');
					$table->dateTime('mod_date')->nullable()->comment('modified date');
				});
			}
		} catch ( Exception $e ) {
			if ( function_exists( 'write_log' ) ) {
				write_log( $e->getMessage() );
			}
		}
	}
}//end class CBXTaxonomyTaxableTableV1D0D0