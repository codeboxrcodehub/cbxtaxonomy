<?php
namespace Cbx\Taxonomy;

use Cbx\Taxonomy\CBXTaxonomyHelper;

class Hooks {
	public function __construct() {
		$helper = new CBXTaxonomyHelper();

		add_filter( 'pre_set_site_transient_update_plugins', [
			$helper,
			'pre_set_site_transient_update_plugins'
		] );
		add_filter( 'plugins_api', [ $helper, 'plugin_info' ], 10, 3 );
	}
}//end class Hooks