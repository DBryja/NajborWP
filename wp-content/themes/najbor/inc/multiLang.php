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

function ml_home_explore(){
	return array(
		"pl" => "Zobacz więcej",
		"en" => "See More",
		"fr" => "Voir plus"
	);
}
function ml_home_decor(){
	return array(
		"pl" => "URODZIŁEM SIĘ W PuCO",
		"en" => "I WAS BORN IN PuCO",
		"fr" => "JE SUIS NÉ À PuCO"
	);
}

function ml_home_bio(){
	return array(
		"pl" => [
			"Tylko wtedy jeszcze o tym nie wiedziałem.\n Jak tylko stanąłem na nogi systematycznie i konsekwentnie znaczyłem swoją obecność na ścianach mieszkania i w książkach moich Rodziców.\n Gdy ściany zostały odświeżone przez najętego malarza pokojowego, a cenne książki wyniesione poza mój zasięg, dostałem papier na którym mogłem działać bez żadnych ograniczeń, co czynię do dzisiaj.",
			"Miałem być konstruktorem maszyn, pilotem, architektem, nauczycielem geografii.... Zostałem <b>MALARZEM</b>. Malowałem różne obrazy, aż pewnego dnia zdobyłem tę wiedzę, że jestem z <b>PuCO</b>. Jestem z krainy purnonsenu, a moje obrazy to nic innego jak utrwalanie historii z mojego świata."
		],
		"en" => [
			"I just didn’t know it at the time.\n As soon as I could stand on my own feet, I systematically and consistently marked my presence on the walls of our home and in my parents’ books.\n When the walls were refreshed by a hired painter and the valuable books were moved out of my reach, I was given paper on which I could create without limitations—something I continue to do to this day.",
			"I was supposed to be a machine constructor, a pilot, an architect, a geography teacher... I became a <b>PAINTER</b>. I painted various pictures until one day I gained the knowledge that I am from <b>PuCO</b>. I am from the land of pure nonsense, and my paintings are nothing more than the preservation of stories from my world."
		],
		"fr" => [
			"Je ne le savais tout simplement pas à l’époque.\n Dès que j’ai pu me tenir sur mes jambes, j’ai systématiquement et consciemment marqué ma présence sur les murs de la maison et dans les livres de mes parents.\n Lorsque les murs ont été rafraîchis par un peintre engagé et que les livres précieux ont été placés hors de ma portée, on m’a donné du papier sur lequel je pouvais créer sans aucune limite—et c’est ce que je fais encore aujourd’hui.",
			"Je devais être constructeur de machines, pilote, architecte, professeur de géographie... Je suis devenu <b>PEINTRE</b>. J’ai peint toutes sortes de tableaux, jusqu’au jour où j’ai compris que je viens de <b>PuCO</b>. Je viens du pays du pur non-sens, et mes peintures ne sont rien d’autre que la préservation des histoires de mon monde."
		]
	);
}
function ml_home_desc(){
	return array(
		"pl" => [
			"Malarz i artysta, który tworzy niezwykłe obrazy balansujące na granicy purnonsensu.",
			"Jego prace przenoszą widza do unikalnego uniwersum ze stolicą w PuCO - świata tętniącego życiem, emocjami i relacjami.",
			"Każde płótno to fragment tej rzeczywistości, pełen symboliki i ukrytych znaczeń."
		],
		"en" => [
			"A painter and artist who creates extraordinary paintings balancing on the edge of pure nonsense.",
			"His works transport the viewer to a unique universe with its capital in PuCO—a world brimming with life, emotions, and relationships.",
			"Each canvas is a fragment of this reality, full of symbolism and hidden meanings."
		],
		"fr" => [
			"Un peintre et artiste qui crée des œuvres extraordinaires, oscillant à la frontière du pur non-sens.",
			"Ses créations transportent le spectateur dans un univers unique, dont la capitale est PuCO—un monde vibrant de vie, d’émotions et de relations.",
			"Chaque toile est un fragment de cette réalité, chargé de symboles et de significations cachées."
		]
	);
}

function ml_home_series(){
    return array(
            "pl" => "cykle obrazów",
            "en" => "series of paintings",
            "fr" => "série de peintures"
    );
}


?>

<!---->