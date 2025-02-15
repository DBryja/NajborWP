<?php
function add_language_prefix_rewrite_rules($rules) {
	$new_rules = [];
	$languages_with_prefix = ['en', 'fr'];

	foreach ($languages_with_prefix as $lang) {
		// Homepage
		$new_rules["($lang)/?$"] = 'index.php?lang=$matches[1]';

		// archive-prace
		$new_rules["($lang)/prace/?$"] = 'index.php?post_type=prace&lang=$matches[1]';
		$new_rules["($lang)/prace/page/?([0-9]{1,})/?$"] = 'index.php?post_type=prace&paged=$matches[2]&lang=$matches[1]';

		// taxonomy-katprace (.../prace/[kategoria])
		$new_rules["($lang)/prace/([^/]+)/page/?([0-9]{1,})/?$"] = 'index.php?post_type=prace&katprace=$matches[2]&paged=$matches[3]&lang=$matches[1]';
		$new_rules["($lang)/prace/([^/]+)/?$"] = 'index.php?post_type=prace&katprace=$matches[2]&lang=$matches[1]';

		// single-prace
		$new_rules["($lang)/prace/([^/]+)/([^/]+)/?$"] = 'index.php?post_type=prace&katprace=$matches[2]&name=$matches[3]&lang=$matches[1]';

		// inne strony
		$new_rules["($lang)/(.+)?$"] = 'index.php?pagename=$matches[2]&lang=$matches[1]';
		$new_rules["($lang)/(.+?)/page/?([0-9]{1,})/?$"] = 'index.php?pagename=$matches[2]&paged=$matches[3]&lang=$matches[1]';
	}

	return $new_rules + $rules;
}
add_filter('rewrite_rules_array', 'add_language_prefix_rewrite_rules');


function custom_paginate_links($link) {
	$language = get_site_language(); // Get current language

	if ($language !== 'pl') {
		$home_url = home_url();

		// Handle both cases: with and without /wordpress/
		if (strpos($link, '/wordpress') !== false) {
			if (strpos($link, '/wordpress/' . $language) === false) {
				$link = str_replace($home_url . '/wordpress', $home_url . '/wordpress/' . $language, $link);
			}
		} else {
			if (strpos($link, '/' . $language) === false) {
				$link = str_replace($home_url, $home_url . '/' . $language, $link);
			}
		}
	}

	return $link;
}
add_filter('paginate_links', 'custom_paginate_links');



function custom_post_permalink($post_link, $post) {
	if ('prace' === $post->post_type) {
		$terms = wp_get_object_terms($post->ID, 'katprace');
		if ($terms && !is_wp_error($terms) && isset($terms[0]->slug)) {
			$taxonomy_slug = $terms[0]->slug;
		} else {
			$taxonomy_slug = 'uncategorized';
		}

		$post_link = str_replace('%katprace%', $taxonomy_slug, $post_link);

		// Dodajemy prefix językowy do URL-a
		$language = get_site_language();
		if ($language !== 'pl') {
			// Usuwamy bazowy URL i dodajemy język
			$post_link = str_replace(home_url(), '', $post_link);
			$post_link = home_url('/' . $language . $post_link);
		}
	}

	return $post_link;
}
add_filter( 'post_type_link', 'custom_post_permalink', 10, 2 );

function custom_taxonomy_permalink( $termlink, $term, $taxonomy ) {
	if ( 'katprace' === $taxonomy ) {
		$language = get_site_language();  // Pobieramy język

		// Jeśli nie jest to polski, dodajemy prefix językowy
		if ($language !== 'pl') {
			$termlink = home_url( '/' . $language . '/prace/' . $term->slug );
		} else {
			$termlink = home_url( '/prace/' . $term->slug );
		}
	}

	return $termlink;
}
add_filter( 'term_link', 'custom_taxonomy_permalink', 10, 3 );

function add_language_query_var($vars) {
	$vars[] = 'lang';
	return $vars;
}
add_filter('query_vars', 'add_language_query_var');

add_action('init', 'flush_rewrite_rules');

?>