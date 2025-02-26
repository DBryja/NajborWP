<?php
    get_header();
    $lang = get_site_language();
    $home = get_home_url_with_prefix($lang);
    $desc = ml_home_desc()[$lang];
    $cta = ml_home_explore()[$lang];
    $decor = ml_home_decor()[$lang];
    $bio = ml_home_bio()[$lang];
    $categories = get_katprace_categories_with_translations(true);
    $image_url = get_template_directory_uri().'/assets/images/hp-lg.jpg';
?>
<section class="home__hero">
    <h1 class="home__hero__title">
        Wiktor Najbor
    </h1>
    <h2 class="home__hero__desc">
        <span><?php echo $desc[0] ?></span>
        <span><?php echo $desc[1] ?></span>
        <span><?php echo $desc[2] ?></span>
    </h2>
    <div class="home__hero__image">
        <picture>
            <source srcset="<?php echo get_template_directory_uri().'/assets/images/hp-lg.jpg'?>" media="(min-width: 1200px)">
            <source srcset="<?php echo get_template_directory_uri().'/assets/images/hp-md.jpg'?>" media="(min-width: 768px)">
            <img
                    loading="eager"
                    class="--fullscreen"
                    src="<?php echo get_template_directory_uri().'/assets/images/hp-sm.jpg'?>"
                    alt=""
            >
        </picture>
        <button class="home__hero__cta btn">
            <a href="<?php echo WP_HOME."/prace/" ?>"><?php echo $cta ?></a>
        </button>
    </div>
</section>
<section class="home__bio">
    <h3 class="home__bio__decor">
        <?php echo "<span>".$decor."</span><span>".$decor."</span>" ?>
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
<section class="home__categories">
    <div class="home__categories__wrapper">
        <?php
        foreach ($categories as $cat) {
            $desc = esc_attr($cat["desc_" . $lang]);
            $url = esc_url($home . '/prace/' . $cat['slug']);
            $name = esc_html($cat["name_" . $lang]);

            echo '<a href="' . $url . '" class="home__categories__item">
            <h3>' . $name . '</h3>
            <span>' . $desc . '</span>
          </a>';
        }
        ?>
    </div>
</section>
<?php
set_query_var('fullscreen_img_url', $image_url);
set_query_var('fullscreen_img_alt', '');
get_template_part('template-parts/content-fullscreen-image');
?>

<?php
    get_footer();
?>

