

<?php
/**
 * Template Name: Custom Template
 *
 * A custom template for displaying specific content.
 */
get_header();
$lang = get_site_language();
$labels = ml_single_labels();
$languages = ml_languages();
$for_sale= ml_for_sale();
?>

<?php while ( have_posts() ) : the_post();
$ID = get_the_ID() ? get_the_ID() : the_ID();
$acf = get_praca_data( $ID );
$orientation = $acf["obraz"]["width"] > $acf["obraz"]["height"]*1.3 ? "landscape" : "portrait";
$url = $acf["obraz"]["url"];
$forSaleAttrib=get_forSale_attrib($ID, $for_sale[$lang]);
?>
<div class="single <?php echo $orientation?>">
    <article id="post-<?php echo $ID; ?>" <?php post_class(); ?>>
        <div class="single__image" <?php echo $forSaleAttrib?> >
            <picture>
                <source srcset="<?php echo $url;?>.webp" type="image/webp">
                <source srcset="<?php echo $url; ?>" type="image/jpeg">
                <img class="img-fluid" src="<?php echo $url; ?>" alt="<?php echo $acf["obraz"]["alt"]?>">
            </picture>
        </div>
        <div class="single__details">
            <h2><?php echo get_value_with_fallback($acf, "tytul", $lang);?></h2>
            <p><?php echo strip_tags(get_value_with_fallback($acf, "opis", $lang));?></p>
            <table>
				<?php
				foreach ( array_keys($labels) as $field ) {
					$value = get_value_with_fallback( $acf, $field, $lang);
                    if ($field == "na_sprzedaz" && $value == 1) {
                        $value = $for_sale[$lang];
                    }
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
