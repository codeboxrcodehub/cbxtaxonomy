<?php

namespace Cbx\Taxonomy\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Taxonomy for table wp_cbxtaxonomy
 */
class Taxonomy extends Eloquent {
	use HasSlug;

	protected $table = 'cbxtaxonomy';

	protected $guarded = [];

	public $timestamps = false;

	/**
	 * Get the options for generating the slug.
	 */
	public function getSlugOptions(): SlugOptions {
		return SlugOptions::create()
		                  ->generateSlugsFrom( 'title' )
		                  ->saveSlugsTo( 'slug' );
	} // end of method getSlugOptions

	/**
	 * get the relational taxable
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function taxable() {
		return $this->hasMany( Taxable::class, 'taxonomy_id', 'id' );
	} // end of taxable

	/**
	 * get the relational child of this taxonomy
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function childs() {
		return $this->hasMany( Taxonomy::class, 'parent_id', 'id' )->with( 'childs' );
	} // end of childs

	/**
	 * get the relational child of this taxonomy
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function children() {
		return $this->hasMany( Taxonomy::class, 'parent_id', 'id' )
		            ->with( [
			            'children' => function ( $q ) {
				            $q->select( "*", "title as label" );
			            }
		            ] );
	} // end of children

	/***
	 * get the relational parent of this taxonomy
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parent() {
		return $this->belongsTo( Taxonomy::class, 'parent_id', 'id' )->with( 'parent' );
	} // end of parent


	/**
	 * Hooks on save taxonomy
	 *
	 * @param array $options
	 *
	 * @return bool
	 */
	public function save( array $options = [] ) {
		$tax = $this->toArray();

		do_action( 'cbxtaxonomy_taxonomy_save_before', $this->type, $tax );

		$save = Parent::save();
		if ( $save ) {
			do_action( 'cbxtaxonomy_taxonomy_save_after', $this->type, $tax );
		} else {
			do_action( 'cbxtaxonomy_taxonomy_save_failed', $this->type, $tax );
		}

		return $save;
	}

	/**
	 * Delete the model/tax
	 *
	 * @return bool|null
	 */
	public function delete() {
		$tax = $this->toArray();

		do_action( 'cbxtaxonomy_taxonomy_delete_before', $this->id, $this->type, $tax );

		$delete = Parent::delete();
		if ( $delete ) {
			do_action( 'cbxtaxonomy_taxonomy_delete_after', $this->id, $this->type, $tax );
		} else {
			do_action( 'cbxtaxonomy_taxonomy_delete_failed', $this->id, $this->type, $tax );
		}

		return $delete;
	}//end method delete
}//end class Taxonomy