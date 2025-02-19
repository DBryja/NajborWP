<?php
get_header();
$lang = get_site_language();
$labels = ml_single_labels();
$for_sale = ml_for_sale();
$ask_for_price = ml_ask_for_price();
$back_to_search = ml_back_to_search();
?>

<?php while ( have_posts() ) : the_post();
$ID = get_the_ID() ? get_the_ID() : the_ID();
$acf = get_praca_data( $ID );
$orientation = $acf["obraz"]["width"] > $acf["obraz"]["height"]*1.3 ? "landscape" : "portrait";
$url = $acf["obraz"]["url"];
$na_sprzedaz = get_post_meta($ID, 'na_sprzedaz', true);
$forSaleAttrib=get_forSale_attrib($ID, $for_sale[$lang], $na_sprzedaz);

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

<div class="single <?php echo $orientation?>">
    <article id="post-<?php echo $ID; ?>" <?php post_class(); ?> data-title="<?php echo get_value_with_fallback($acf, "tytul", $lang)?>">
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
<div class="single__short-links">
    <?php
    if ( $na_sprzedaz == 1 ) { ?>
        <a class="buy-button" href="#contact">
            <?php echo $ask_for_price[$lang]?>
        </a>
    <?php } ?>
    <a href="<?php echo esc_url($go_back_url); ?>">
        <?php echo $back_to_search[$lang]?>
    </a>
</div>
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
    const buyButton = document.querySelector(".buy-button");
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
    if (buyButton){
       buyButton.addEventListener("click", ()=>{
           const subjectInput = document.querySelector("input#subject");
           const title = document.querySelector("article").dataset.title;
           if (subjectInput && title) {
               subjectInput.value = title;
           }
       })
    }

</script>
<?php get_footer(); ?>
