<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists( 'cbxtaxonomy_most_used_tags' ) ) {

	/**
	 * Get most used tags
	 *
	 * @param $taxonomy
	 * @param int $limit
	 * @param bool $show_empty
	 *
	 * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
	 */
	function cbxtaxonomy_most_used_tags( $taxonomy, $limit = 20, $show_empty = true ) {
		$most_used_tags = \Cbx\Taxonomy\Models\Taxonomy::query()
		                                               ->select( "id", "title" )
		                                               ->where( 'type', $taxonomy )
		                                               ->withCount( "taxable" )
		                                               ->orderByDesc( 'taxable_count' );
		if ( $show_empty ) {
			//todo: is the logic ok?
			$most_used_tags = $most_used_tags->having( 'taxable_count', ">", 0 );
		}
		$most_used_tags = $most_used_tags->take( $limit )->get();

		return apply_filters( 'cbxtaxonomy_most_used_tags', $most_used_tags );
	}//end function cbxtaxonomy_most_used_tags
}

if ( ! function_exists( 'get_taxonomies' ) ) {
	/**
	 * Get all Taxonomies
	 *
	 * @param $taxonomy
	 * @param int $limit
	 *
	 * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
	 */
	function get_taxonomies( $taxonomy, $limit = 0 ) {
		$taxonomies = \Cbx\Taxonomy\Models\Taxonomy::query()
		                                           ->where( "type", $taxonomy );
		if ( $limit == - 1 ) {
			return $taxonomy->get();
		}

		return $taxonomies->limit( $limit )->get();
	}
}

if ( ! function_exists( 'cbxtaxonomy_check_exists' ) ) {
	/**
	 * Check taxonomy exists or not
	 *
	 * @param $slug
	 * @param $type
	 *
	 * @return bool
	 */
	function cbxtaxonomy_check_exists( $slug = '', $type = '' ) {


		if ( $slug == '' ) {
			return false;
		}
		if ( $type == '' ) {
			return false;
		}

		return \Cbx\Taxonomy\Models\Taxonomy::query()->where( 'slug', sanitize_text_field( $slug ) )->where( 'type', $type )->exists();
	}//end function cbxtaxonomy_check_exists
}