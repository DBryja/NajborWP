<?php
    get_header();
    $lang = get_site_language();
    $desc = ml_home_desc()[$lang];
    $cta = ml_home_explore()[$lang];
    $decor = ml_home_decor()[$lang];
    $bio = ml_home_bio()[$lang];
    $categories = get_katprace_categories_with_translations(true);
?>
<section class="home__hero">
    <h1 class="home__title">
        Wiktor Najbor
    </h1>
    <h2 class="home__desc">
        <?php echo $desc ?>
    </h2>
    <div class="home__image">
        <picture>
            <source srcset="<?php echo get_template_directory_uri().'/assets/images/hp-lg.jpg'?>" media="(min-width: 1200px)">
            <source srcset="<?php echo get_template_directory_uri().'/assets/images/hp-md.jpg'?>" media="(min-width: 768px)">
            <img src="<?php echo get_template_directory_uri().'/assets/images/hp-sm.jpg'?>" alt="">
        </picture>
        <button class="home__cta">
            <?php echo $cta ?>
        </button>
    </div>
</section>
<section class="home__bio">
    <h3 class="home__bio__decor">
        <?php echo $decor ?>
    </h3>
    <div class="home__bio__image">
        <picture>
            <img src="<?php echo get_template_directory_uri().'/assets/images/portret.jpg'?>" alt="Autoportret pt. Tańczący z Farbami">
        </picture>
    </div>
    <div class="home__bio__content">
        <?php
            foreach ($bio as $b)
                echo "<p>".$b."</p>";
        ?>
    </div>
</section>
<section>
        <?php
            foreach ($categories as $cat)
                echo "<span>".$cat["name_pl"]."</span>";
        ?>
</section>

<?php
    get_footer();
?>

