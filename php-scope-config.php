<?php

use Isolated\Symfony\Component\Finder\Finder;

return [
	// The namespace prefix that will be added to your vendor classes
	'prefix'                  => 'CbxTaxonomyScoped',

	// Only scope the vendor directory
	'finders'                 => [
		Finder::create()
		      ->files()
		      ->in( __DIR__ . '/vendor' )
			//->exclude('composer')
			  ->exclude( 'bin' )
		      //>notName( 'autoload.php' )
	],

	// DO NOT TOUCH global functions or constants
	'expose-global-functions' => true,
	'expose-global-constants' => true,

	// Remove expose-functions unless absolutely needed
	'expose-functions'        => [],
	'expose-constants'        => [],

	// Never prefix these namespaces (typical WP safe list)
	'exclude-namespaces'      => [
		'Cbx\Taxonomy',   // your plugin's own namespace if you use one
		'Composer',
		'WpOrg',            // anything WP-related
		'PHPUnit',
		'Symfony\\Polyfill',
	],

	// Don’t touch global functions that WP expects
	'exclude-functions'       => [
		// Laravel helpers
		// illuminate/collections/helpers.php
		"data_fill",
		"data_get",
		"data_set",
		"head",
		"last",
		"value",
		"tap",
		"throw_if",
		"throw_unless",
		"class_basename",
		"class_uses_recursive",
		"array_add",
		"array_collapse",
		"array_divide",
		"array_dot",
		"array_except",
		"array_first",
		"array_flatten",
		"array_forget",
		"array_get",
		"array_has",
		"array_is_list",
		"array_last",
		"array_only",
		"array_prepend",
		"array_pull",
		"array_push_assoc",
		"array_random",
		"array_set",
		"array_shuffle",
		"array_sort",
		"array_sort_recursive",
		"array_splice_assoc",
		"array_where",
		"blank",
		"filled",
		"tap",
		"env",
		"retry",
		"transform",
		"windows_os",

		// illuminate/support/helpers.php
		"data_get",
		"data_set",
		"head",
		"last",
		"value",
		"tap",
		"throw_if",
		"throw_unless",
		"class_basename",
		"class_uses_recursive",
		"blank",
		"filled",
		"env",
		"object_get",
		"optional",
		"preg_replace_array",
		"retry",
		"tap",
		"throw_if",
		"throw_unless",
		"windows_os",
		"with",

		// WordPress global functions
		'add_action',
		'add_filter',
		'do_action',
		'apply_filters',
		'plugin_dir_path',
		'plugin_dir_url',
		'register_activation_hook',
		'register_deactivation_hook',
	],

	// Don’t modify WordPress constants
	'exclude-constants'       => [
		'ABSPATH',
		'WPINC',
		'WP_DEBUG',
		'DB_NAME',
		'DB_USER',
		'DB_PASSWORD',
		'DB_HOST',
	],

	// Leave these files unmodified
	'exclude-files'           => [
		__DIR__ . '/vendor/illuminate/collections/helpers.php',
		__DIR__ . '/vendor/illuminate/support/helpers.php',
		__DIR__ . '/vendor/composer/*',
	],

	'patchers' => [],
];
