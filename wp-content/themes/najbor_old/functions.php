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

// <<< UTILS
// UTILS >>>

// <<< REJESTROWANIE ACF I CPT
// REJESTROWANIE ACF I CPT >>>

// <<< PRZEKSZTAŁCANIE LINKÓW
// PRZEKSZTAŁCANIE LINKÓW >>>

// <<< ADMIN PANEL
// ADMIN PANEL >>>
?>


