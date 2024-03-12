<?php

namespace Cbx\Taxonomy\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Taxonomy for table wp_cbxtaxonomy
 * @since 1.0.0
 */
class Taxable extends Eloquent {

	protected $table = 'cbxtaxable';

	protected $guarded = [];

	public $timestamps = false;

	/**
	 * get the relational taxonomy
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function taxonomy() {
		return $this->belongsTo( Taxonomy::class, 'taxonomy_id', 'id' );
	} // end of method taxonomy

	/**
	 * Deleting taxonomy assignments (relation between taxonomy and model/objects/posts)
	 *
	 * @return bool|void|null
	 */
	public function delete() {
		$tax = $this->toArray();
		do_action( 'cbxtaxonomy_taxable_delete_before', $this->taxonomy_id, $this->type, $tax );

		$delete = Parent::delete();
		if ( $delete ) {
			do_action( 'cbxtaxonomy_taxable_delete_after', $this->id, $this->type, $tax );
		} else {
			do_action( 'cbxtaxonomy_taxable_delete_failed', $this->taxonomy_id, $this->type, $tax );
		}

		return $delete;
	} // end of method delete
}