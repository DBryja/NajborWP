

<?php
/**
 * Template Name: Custom Template
 *
 * A custom template for displaying specific content.
 */
get_header();
$lang = get_site_language();
$labels = array(
	'metoda' => array(
		'pl' => 'Metoda',
		'en' => 'Method',
		'fr' => 'Méthode'
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
	)
);
$languages = [ 'pl', 'en', 'fr' ];
function get_value_with_fallback( $acf, $field, $lang) {
	global $languages;
	if (!empty($acf[$field][$lang]) && is_string($acf[$field][$lang])) {
		return $acf[$field][$lang];
	}
    elseif (!empty($acf[$field]) && is_string($acf[$field])) {
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
?>

<?php while ( have_posts() ) : the_post();
    $ID = get_the_ID() ? get_the_ID() : the_ID();
    $acf = get_praca_data( $ID );
    $orientation = $acf["obraz"]["width"] > $acf["obraz"]["height"]*1.3 ? "landscape" : "portrait";
?>
<div class="single <?php echo $orientation?>">
	<article id="post-<?php echo $ID; ?>" <?php post_class(); ?>>
        <div class="single__image">
            <picture>
                <source srcset="<?php echo $acf["obraz"]["url"];?>.webp" type="image/webp">
                <source srcset="<?php echo $acf["obraz"]["url"]; ?>">
                <img class="img-fluid" src="<?php echo $acf["obraz"]["url"]; ?>" alt="<?php echo $acf["obraz"]["alt"]?>">
            </picture>
        </div>
		<div class="single__details">
            <h2><?php echo get_value_with_fallback($acf, "tytul", $lang);?></h2>
            <p><?php echo strip_tags(get_value_with_fallback($acf, "opis", $lang));?></p>
            <table>
                <?php
                foreach ( array_keys($labels) as $field ) {
	                $value = get_value_with_fallback( $acf, $field, $lang);
	                if (!empty($value)) {
		                echo "<tr>
                                <td>{$labels[$field][$lang]}:</td>
                                <td class='--heading'>{$value}</td>
                              </tr>";
	                }
                }
                ?>
            </table>
		</div>
		<?php endwhile; ?>
</div>

<?php get_footer(); ?>
