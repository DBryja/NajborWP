<?php
function custom_post_permalink( $post_link, $post ) {
	if ( 'prace' === $post->post_type ) {
		$terms = wp_get_object_terms( $post->ID, 'katprace' );
		if ( $terms && ! is_wp_error( $terms ) && isset($terms[0]->slug) ) {
			$taxonomy_slug = $terms[0]->slug;
			$post_link = str_replace( '%katprace%', $taxonomy_slug, $post_link );
		} else {
			// Handle the case where there is no term assigned
			$post_link = str_replace( '%katprace%', 'uncategorized', $post_link );
		}
	}
	return $post_link;
}
add_filter( 'post_type_link', 'custom_post_permalink', 10, 2 );

add_filter( 'post_type_link', 'custom_post_permalink', 10, 2 );
function custom_taxonomy_permalink( $termlink, $term, $taxonomy ) {
	if ( 'katprace' === $taxonomy ) {
		$termlink = home_url( user_trailingslashit( 'prace/' . $term->slug ) );
	}
	return $termlink;
}
add_filter( 'term_link', 'custom_taxonomy_permalink', 10, 3 );

add_action('init', 'flush_rewrite_rules');

?>