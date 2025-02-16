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
function custom_sort_posts_by_priority($query) {
    if (is_admin() || !$query->is_main_query() || !$query->is_archive()) {
        return;
    }

    $meta_query = [
        'relation' => 'OR',
        // Grupa 1: Posty z wysokim priorytetem (80-100)
        'high_priority' => [
            'key' => 'priorytet',
            'value' => array(80, 100),
            'type' => 'NUMERIC',
            'compare' => 'BETWEEN'
        ],
        // Grupa 2: Posty na sprzedaż
        'for_sale' => [
            'key' => 'na_sprzedaz',
            'value' => '1',
            'compare' => '='
        ],
        // Grupa 3: Wszystkie pozostałe posty z priorytetem
        'normal_priority' => [
            'key' => 'priorytet',
            'compare' => 'EXISTS',
            'type' => 'NUMERIC'
        ]
    ];

    $query->set('meta_query', $meta_query);

    $orderby = [
        'high_priority' => 'DESC',
        'for_sale' => 'DESC',
        'priorytet' => 'DESC',
        'date' => 'DESC'
    ];

    $query->set('orderby', $orderby);
}
add_action('pre_get_posts', 'custom_sort_posts_by_priority');
// UTILS >>>

// <<< REJESTROWANIE ACF I CPT
// REJESTROWANIE ACF I CPT >>>

// <<< PRZEKSZTAŁCANIE LINKÓW
// PRZEKSZTAŁCANIE LINKÓW >>>

// <<< ADMIN PANEL
// ADMIN PANEL >>>
?>


