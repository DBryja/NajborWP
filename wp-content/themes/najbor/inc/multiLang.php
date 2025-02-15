<?php
// ARCHIVE
function ml_single_labels(){
	return array(
		'metoda' => array(
			'pl' => 'Technika',
			'en' => 'Technique',
			'fr' => 'Technique'
		),
		'wymiary' => array(
			'pl' => 'Wymiary',
			'en' => 'Dimensions',
			'fr' => 'Dimensions'
		),
		'oprawa' => array(
			'pl' => 'Oprawa',
			'en' => 'Framing',
			'fr' => 'Encadrement'
		),
		'rok_powstania' => array(
			'pl' => 'Rok powstania',
			'en' => 'Year of creation',
			'fr' => 'Année de création'
		),
		"na_sprzedaz" => array(
			"pl" => "Dostępność",
			"en" => "Availability",
			"fr" => "Disponibilité"
		)
	);
}
function ml_languages(){
	return array('pl', 'en', 'fr');
}

// ARCHIVE / SINGLE
function ml_for_sale(){
	return array(
		'pl' => 'Dostępne',
		'en' => 'Available',
		'fr' => 'Disponible'
	);
}

// CONTACT FORM
function ml_form_fields(){
	return array(
		'name' => array("pl"=>"Imię", "en"=>"Name", "fr"=>"Nom"),
		'email' => array("pl"=>"Email", "en"=>"Email", "fr"=>"Email"),
		'subject' => array("pl"=>"Temat", "en"=>"Subject", "fr"=>"Sujet"),
		'message' => array("pl"=>"Wiadomość", "en"=>"Message", "fr"=>"Message")
	);
}
function ml_contact_heading(){
	return array(
		"pl" => "Zamówienia i Pytania",
		"en" => "Orders & Inquiries",
		"fr" => "Commandes & Consultations"
	);
}

// Copyrights
function ml_realisation(){
	return array("pl" => "Realizacja", "fr" => "Réalisation", "en" => "Realisation");
}

function ml_alerts(){
	return array(
		"success"=> array(
			"pl" => "Dziękuję za wiadomość!",
			"en" => "Thank you for your message!",
			"fr" => "Merci pour votre message!"
		),
		"error"=> array(
			"pl" => "Wystąpił błąd, spróbuj ponownie.",
			"en" => "An error occurred, please try again.",
			"fr" => "Une erreur s'est produite, veuillez réessayer."
		)
	);
}

function ml_meta_description(){
	return array(
		"pl"=>"Odkryj fascynujący świat sztuki Wiktora Najbora. Zobacz jego wyjątkowe obrazy i projekty artystyczne, które łączą pasję z unikalnym stylem. Przeglądaj galerię dzieł, poznaj artystę i zanurz się w kreatywnym świecie Wiktora Najbora.",
		"en"=>"Discover the fascinating world of Wiktor Najbor's art. Explore his unique paintings and artistic projects that blend passion with a distinctive style. Browse the gallery of works, get to know the artist, and immerse yourself in Wiktor Najbor's creative world.",
		"fr"=>"Découvrez le monde fascinant de l'art de Wiktor Najbor. Explorez ses peintures uniques et ses projets artistiques qui allient passion et style distinctif. Parcourez la galerie des œuvres, faites connaissance avec l'artiste et plongez dans le monde créatif de Wiktor Najbor."
	);
}
function ml_meta_title(){
	return array(
		"pl"=>"Wiktor Najbor – Twórczość, która przenosi w inny wymiar.",
		"en"=>"Wiktor Najbor – Art that transcends dimensions.",
		"fr"=>"Wiktor Najbor – L'art qui transcende les dimensions."
	);
}

function ml_returnLocale($lang){
	switch($lang){
		case 'pl':
			return 'pl_PL';
		case 'en':
			return 'en_US';
		case 'fr':
			return 'fr_FR';
	}
}

function ml_menuItems(){
	return array(
		'home' => array(
			'pl' => 'Home',
			'en' => 'Home',
			'fr' => 'Home'
		),
		'prace' => array(
			'pl' => 'Prace',
			'en' => 'Works',
			'fr' => 'Travaux'
		),
		'kontakt' => array(
			'pl' => 'Kontakt',
			'en' => 'Contact',
			'fr' => 'Contact'
		),
		'na_sprzedaz' => array(
			'pl' => 'Dostępne',
			'en' => 'Available',
			'fr' => 'Disponible'
		),
		"wszystkie" =>array(
			"pl" => "Wszystkie",
			"en" => "All",
			"fr" => "Tous"
		),
		"zamknij" => array(
			"pl" => "Zamknij",
			"en" => "Close",
			"fr" => "Fermer"
		),
	);
}

?>

