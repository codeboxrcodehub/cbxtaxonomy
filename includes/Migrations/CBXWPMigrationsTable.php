<?php

namespace Cbx\Taxonomy\Migrations;

use Cbx\Taxonomy\Models\Migrations;
use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Common migration class for migration table and other tables(codeboxr's plugin or 3rd party if anyone use)
 *
 * Class CBXWPMigrationsTable
 * @since 1.0.0
 */
class CBXWPMigrationsTable {
	public $tables;
	public $plugin;

	public function __construct( $tables = [], $plugin = '' ) {

		$this->tables = $tables;
		$this->plugin = $plugin;

		try {
			if ( ! Capsule::schema()->hasTable( 'cbxmigrations' ) ) {
				Capsule::schema()->create( 'cbxmigrations', function ( $table ) {
					$table->increments( 'id' );
					$table->string( 'migration' );
					$table->integer( 'batch' );
					$table->string( 'plugin' );
				} );
			}
		} catch ( \Throwable $th ) {
			if ( function_exists( 'write_log' ) ) {
				write_log( $th->getMessage() );
			}
		}


		$this->up();
	}

	/**
	 * Run the migrations (create tables and others)
	 */
	public function up() {
		$migrations = Migrations::query()->where( 'plugin', $this->plugin )->get()->toArray();

		$migrated_files  = array_column( $migrations, 'migration' );
		$migration_files = array_values( array_diff( array_reverse( $this->tables ), $migrated_files ) );

		foreach ( $migration_files as $value ) {
			if ( file_exists( plugin_dir_path( __FILE__ ) . $value . '.php' ) ) {
				try {

					/*require_once plugin_dir_path( __FILE__ ) . $value . '.php';
					$migration = new $value();*/
					$migrationClass = "Cbx\Taxonomy\Migrations\\$value";
					new $migrationClass();

					//add in migration table
					Migrations::create( [
						'migration' => $value,
						'plugin'    => $this->plugin,
					] );
				} catch ( Exception $e ) {
					if ( function_exists( 'write_log' ) ) {
						write_log( $e->getMessage() );
					}
				}
			}
		}
	}//end method  up

	/**
	 * Run the migration (delete tables or others)
	 */
	public function down() {

	}//end method down
}//end class CBXWPMigrationsTable