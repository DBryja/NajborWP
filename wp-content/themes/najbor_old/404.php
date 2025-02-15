<?php
get_header();
$page_slug = '404-not-found'; // Slug strony 404-not-found
$page = get_page_by_path($page_slug);
$language = get_site_language();
$quote = array(
    "pl" => "Nie ma takiej strony",
    "en" => "Page not found",
    "fr" => "Page non trouvée"
);
$back = array(
        "pl" => "Powrót",
        "en" => "Go Back",
        "fr" => "Retour"
);
if ($page) {
    $quote = array(
            "pl" => get_field("cytat_pl", $page->ID),
            "en" => get_field("cytat_en", $page->ID),
            "fr" => get_field("cytat_fr", $page->ID)
    );
}

?>

<div class="container errorPage">
    <h1 class="--404">404</h1>
    <h6>
	<?php
	if ($quote[$language]) {
		echo nl2br(htmlentities($quote[$language], ENT_QUOTES, 'UTF-8'));
	}
	?>
    </h6>

    <a href="<?php echo get_home_url()?>" class="back"><?php echo $back[$language] ?></a>
</div>
<?php
get_footer();
?>

