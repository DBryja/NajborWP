<?php
	$lang = get_site_language();
    $pageLabels = ml_menuItems();
    $title = $OGtitle = ml_meta_title()[$lang];
    $desc = ml_meta_description()[$lang];
    $img = get_template_directory_uri() . '/assets/images/main-thumb.jpg';
    $img_width = 1285;
    $img_height = 916;
    $term_id = $ID = 0;

    if (is_front_page() || is_home()) {
	    $title =  $pageLabels["home"][$lang]." | Najbor";
    }
    else if (is_page('kontakt')){
        $title =  $pageLabels["kontakt"][$lang]." | Najbor";
    }
    else if(is_page('na-sprzedaz')){
        $title = $pageLabels["na_sprzedaz"][$lang]." | Najbor";
    }
    elseif (is_post_type_archive('prace')) {
		$title = $pageLabels["prace"][$lang]." | Najbor";
	}
    else if(is_404()){
        $title = "404 | Najbor";
    }
    else if (is_tax('katprace')) {
        $category = get_katprace_object($lang);
		$term_id = $category["term_id"];
        $img = get_field('thumbnail', 'katprace_' . $term_id);
		$img_width = 600;
		$img_height= 800;
        $title = $category["name"]." | Najbor";
	} elseif (is_singular("prace")){
		$current_post = get_queried_object();
        $ID = $current_post->ID;
        $acf = get_praca_data($ID);
        $img = $acf["obraz"]["url"];
        $img_width = $acf["obraz"]["width"];
        $img_height = $acf["obraz"]["height"];
        $title = get_value_with_fallback($acf, "tytul", $lang)." | Najbor";
        $desc = strip_tags(get_value_with_fallback($acf, "opis", $lang));
    }
?>

<title><?php echo $title?></title>
<meta property="og:title" content="<?php echo $OGtitle?>">
<meta property="og:description" content="<?php echo $desc?>">
<meta property="og:url" content="<?php echo get_fullUrl()?>">
<meta property="og:image" content="<?php echo $img?>">
<meta property="og:image:width" content="<?php echo $img_width?>">
<meta property="og:image:height" content="<?php echo $img_height?>">
