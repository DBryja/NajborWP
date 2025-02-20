<?php
function get_site_language() {
    $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $segments = explode('/', $path);

    $available_languages = ['en', 'fr'];

    // Sprawdzenie, czy jesteśmy na localhost
    $isLocalhost = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;

    // Jeśli działamy lokalnie i mamy przynajmniej jeden segment, traktujemy go jako nazwę katalogu projektu
    if ($isLocalhost && !empty($segments)) {
        // Sprawdzamy, czy drugi segment to język
        return in_array($segments[1] ?? '', $available_languages) ? $segments[1] : 'pl';
    }

    // Standardowa obsługa produkcji
    return in_array($segments[0], $available_languages) ? $segments[0] : 'pl';
}

function get_prefix($lang='') {
	$lang = $lang ?: get_site_language();
	return $lang !== 'pl' ? "/$lang" : '';
}
function get_home_url_with_prefix($lang='') {
	$lang = $lang ?: get_site_language();
	return get_home_url() . get_prefix($lang);
}
function get_value_with_fallback( $acf, $field, $lang) {
	$languages = ml_languages();

	if (!empty($acf[$field][$lang]) && is_string($acf[$field][$lang])) {
		return $acf[$field][$lang];
	}
	elseif (!empty($acf[$field]) && is_string($acf[$field])) {
		return $acf[$field];
	}
	elseif (!empty($acf[$field]) && is_bool($acf[$field])) {
		return $acf[$field];
	}
	else {
		foreach ( $languages as $fallback_lang ) {
			if (!empty($acf[$field][$fallback_lang] ) && is_string($acf[$field][$fallback_lang] ) )
				return $acf[$field][$fallback_lang];
		}
	}
	return '';
}
function get_katprace_categories_with_translations() {
	$categories = get_terms([
		'taxonomy' => 'katprace',
		'hide_empty' => true,
	]);

	$categories_with_translations = [];
	if (!is_wp_error($categories)) {
		foreach ($categories as $category) {
			$category_id = $category->term_id;
			$name_fr = get_field('fr', 'katprace_' . $category_id);
			$name_en = get_field('en', 'katprace_' . $category_id);
			$thumbnail = get_field('thumbnail', 'katprace_' . $category_id);
			$order = get_field('order', 'katprace_' . $category_id);

			$categories_with_translations[] = [
				'slug' => $category->slug,
				'name_pl' => $category->name,
				'name_fr' => $name_fr,
				'name_en' => $name_en,
				'thumbnail_url' => $thumbnail,
				'order' => $order,
			];
		}
	}
	usort($categories_with_translations, function($a, $b) {
		return $a['order'] <=> $b['order'];
	});

	return $categories_with_translations;
}
function get_katprace_object($lang = 'pl'){
	$queried_object = get_queried_object();
	$terms = get_the_terms( get_the_ID(), 'katprace' );
	$working_object = $queried_object;
	if ( $terms && !is_wp_error( $terms ) ) {
		$working_object = $terms[0];
	}
	$term_id = $working_object->term_id;
	$term_name = $working_object->name;
	$term_slug = $working_object->slug;
	if ($lang != "pl"){
		$term_name = get_field($lang, 'katprace_' . $term_id);
	}
	return array(
		'name' => $term_name,
		'slug' => $term_slug,
		'term_id' => $term_id
	);
}
function get_heading_template() {
	if (is_front_page() || is_home()) {
		get_template_part('template-parts/header', 'home');
	} elseif (is_page('kontakt')) {
		get_template_part('template-parts/header', 'kontakt');
	} elseif (is_page('na-sprzedaz') || is_page("dostepne")) {
		get_template_part("template-parts/header", "dostepne");
	} elseif (is_post_type_archive('prace')) {
		get_template_part('template-parts/header', 'prace');
	} elseif (is_tax('katprace')) {
		get_template_part('template-parts/header', 'katprace');
	} elseif (is_singular("prace")){
		get_template_part('template-parts/header', 'single-prace');
	}
	else {
		get_template_part('template-parts/header', 'default');
	}
}

function get_praca_data($ID){
	$custom_fields = array(
		'ID' => $ID,
		'obraz' => get_field('Obraz', $ID),
		'na_sprzedaz' => get_field('na_sprzedaz', $ID),
		'rok_powstania' => get_field('rok_powstania', $ID),
		'wymiary' => get_field('wymiary', $ID),
		"tytul" => array(
			"pl" => get_field("tytul", $ID),
			"en" => get_field('tytul_en', $ID),
			"fr" => get_field('tytul_fr', $ID),
		),
		"opis" => array(
			"pl" => get_field('opis', $ID),
			"en" => get_field('opis_en', $ID),
			"fr" => get_field('opis_fr', $ID),
		),
		"metoda" => array(
			"pl" => get_field('metoda', $ID),
			"en" => get_field('metoda_en', $ID),
			"fr" => get_field('metoda_fr', $ID),
		),
		"oprawa" => array(
			"pl" => get_field('oprawa', $ID),
			"en" => get_field('oprawa_en', $ID),
			"fr" => get_field('oprawa_fr', $ID),
		)
	);
	return $custom_fields;
}
function get_image_shape($width, $height) {
	$aspect_ratio = $width / $height;

	if ($aspect_ratio <= 0.7 ) {
		return 'thin';
	} elseif ($aspect_ratio > 0.7 && $aspect_ratio <= 1.25) {
		return 'square';
	} elseif ($aspect_ratio > 1.25 && $aspect_ratio <= 1.5) {
		return 'wide';
	} else {
		return 'very-wide';
	}
}

function get_forSale_attrib($ID, $translation, $value='0'){
        if (
            $value == '1'
            || get_post_meta($ID, 'na_sprzedaz', true) == '1'
        ) {
            return sprintf(
                'data-forSale="%s" aria-label="%s"',
                esc_attr($translation),
                esc_attr($translation));
        }
        return '';
}

function get_fullUrl(){
	// Program to display URL of current page.
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
		$link = "https";
	else
		$link = "http";
	$link .= "://";
	$link .= $_SERVER['HTTP_HOST'];
	$link .= $_SERVER['REQUEST_URI'];
	return $link;
}
function send_email(){
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'send_email' ) {
		$name = sanitize_text_field( $_POST['name'] );
		$email = sanitize_email( $_POST['email'] );
		$subject = sanitize_text_field( $_POST['subject'] );
		$message = sanitize_textarea_field( $_POST['message'] );
		$page_title = sanitize_text_field( $_POST['page_title'] );

		$to = get_option( 'admin_email' );
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$body = "
            <strong>Adres do odpowiedzi:</strong> {$email}<br/>
            <strong>Imię i nazwisko:</strong> {$name}<br/>
            <strong>Wysłano ze strony:</strong> {$page_title}<br/>
            <strong>Treść wiadomości:</strong><br>{$message}
        ";

		if ( wp_mail( $to, $subject, $body, $headers ) ) {
			wp_send_json_success( 'Email sent successfully!' );
		} else {
			wp_send_json_error( 'Failed to send email.' );
		}
		exit;
	}
}
add_action('wp_ajax_nopriv_send_email', 'send_email');
add_action('wp_ajax_send_email', 'send_email');
?>