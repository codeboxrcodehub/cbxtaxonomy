<?php

namespace Cbx\Taxonomy\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Migrations
 * @package Migrations\includes\models
 * @since 1.0.0
 */
class Migrations extends Eloquent {
	protected $table = 'cbxmigrations';

	protected $guarded = [];

	public $timestamps = false;
}