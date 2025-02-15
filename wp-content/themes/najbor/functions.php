<?php
// <<< INCLUDES
require_once get_template_directory() . '/inc/enque-scripts.php';
require_once get_template_directory() . '/inc/links-filtering.php';
require_once get_template_directory() . '/inc/cpt-acf.php';
require_once get_template_directory() . '/inc/admin-panel.php';
require_once get_template_directory() . '/inc/utils.php';
require_once get_template_directory() . '/inc/multiLang.php';
require_once get_template_directory() . '/inc/pagination.php';
// INCLUDES >>>

// <<< UTILS
// multilang support
$supported_languages = ml_languages();
$accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
$preferred_language = substr($accept_language, 0, 2);
if (!isset($_COOKIE['site_language'])) {
	if (in_array($preferred_language, $supported_languages)) {
		setcookie('site_language', $preferred_language,0, "/");
	} else {
		setcookie('site_language', 'pl',0, "/");
	}
}

// sort by priority
function set_default_priority($post_id) {
    if (get_post_type($post_id) !== 'post') return;

    if (get_post_meta($post_id, 'priorytet', true) === '') {
        update_post_meta($post_id, 'priorytet', 0);
    }
}
add_action('save_post', 'set_default_priority');

function custom_sort_posts_by_priority($query) {
    if (is_admin() || !$query->is_main_query() || !$query->is_archive()) {
        return;
    }

    $query->set('meta_key', 'priorytet');
    $query->set('orderby', [
        'meta_value_num' => 'DESC',
        'date' => 'DESC'
    ]);
    $query->set('order', 'DESC');
}
add_action('pre_get_posts', 'custom_sort_posts_by_priority');

function ensure_default_priority($meta_value, $post_id, $meta_key, $single) {
    if ($meta_key === 'priorytet' && empty($meta_value)) {
        return 0;
    }
    return $meta_value;
}
add_filter('get_post_metadata', 'ensure_default_priority', 10, 4);
// UTILS >>>

// <<< REJESTROWANIE ACF I CPT
// REJESTROWANIE ACF I CPT >>>

// <<< PRZEKSZTAŁCANIE LINKÓW
// PRZEKSZTAŁCANIE LINKÓW >>>

// <<< ADMIN PANEL
// ADMIN PANEL >>>
?>


