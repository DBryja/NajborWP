<?php
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

$terms = get_the_terms($ID, 'katprace');
$term_slug = '';
if ($terms && !is_wp_error($terms)) {
    $term = $terms[0];
    $term_slug = $term->slug;
}
$go_back_url = '';
$referrer = $_SERVER['HTTP_REFERER'];
if(isset($referrer)){
    if(strpos($referrer, "#post-$ID") === false){
        $referrer = ($_SERVER['HTTP_REFERER']) . "#post-$ID";
    }
    $go_back_url = $referrer;
} else {
    $go_back_url = get_term_link($term_slug, 'katprace');
}
?>

<!--    <a class="single__back" href="--><?php //echo isset($_SERVER['HTTP_REFERER'])
//        ? esc_url($_SERVER['HTTP_REFERER'])
//        : get_term_link($term_slug, 'katprace') ?><!--">-->
<!--        Wróć do przeglądania-->
<!--    </a>-->
<div class="single <?php echo $orientation?>">
    <article id="post-<?php echo $ID; ?>" <?php post_class(); ?>>
        <div class="single__image cursor--click" <?php echo $forSaleAttrib?> >
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
<a class="single__back" href="<?php echo esc_url($go_back_url); ?>">
    Wróć do przeglądania
</a>
<div class="fullscreen">
    <div class="fullscreen__close">&times;</div>
    <div class="fullscreen__image-container">
        <img class="fullscreen__image" src="<?php echo $url; ?>" alt="<?php echo $acf["obraz"]["alt"]?>">
    </div>
</div>

<script>
    const fullscreen = document.querySelector('.fullscreen');
    const closeButton = document.querySelector('.fullscreen__close');
    const singleImage = document.querySelector('.single__image');
    singleImage.addEventListener('click', function() {
        fullscreen.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        fullscreen.classList.add("active");
    });
    closeButton.addEventListener('click', closeFullscreen);
    fullscreen.addEventListener('click', function(e) {
        if (e.target === this) {
            closeFullscreen();
        }
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeFullscreen();
        }
    });
    function closeFullscreen() {
        fullscreen.classList.remove("active");
        fullscreen.style.display = 'none';
        document.body.style.overflow = '';
    }
</script>
<?php get_footer(); ?>
