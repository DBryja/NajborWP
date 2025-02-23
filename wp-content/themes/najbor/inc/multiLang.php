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

function ml_ask_for_price(){
	return array(
		'pl' => "Zapytaj o cenę",
		'en' => "Ask for the price",
		'fr' => "Demandez le prix"
	);
}

function ml_back_to_search(){
	return array(
		'pl' => "Wróć do przeglądania",
		'en' => "Return to browsing",
		'fr' => "Revenir à la navigation"
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
		"pl"=>"Tworzy nasycone kolorem obrazy i rysunki o tematyce balansującej na granicy purnonsensu. Jego malarstwo przenosi widza do magicznego świata ciekawych historii ukazanych z wysublimowanym poczuciem humoru.",
		"en"=>"He creates color-saturated paintings and drawings that balance on the edge of absurdity. His art transports the viewer to a magical world of intriguing stories, presented with a refined sense of humor.",
		"fr"=>"Il crée des peintures et des dessins aux couleurs éclatantes, oscillant à la frontière de l’absurde. Son art transporte le spectateur dans un monde magique d’histoires fascinantes, révélées avec un sens de l’humour raffiné."
	);
}
function ml_meta_title(){
	return array(
		"pl"=>"Wiktor Najbor - współczesny polski artysta malarz.",
		"en"=>"Wiktor Najbor - a contemporary Polish painter.",
		"fr"=>"Wiktor Najbor - un peintre polonais contemporain."
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

