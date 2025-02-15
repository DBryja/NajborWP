<!DOCTYPE html>
<?php
    $language = get_site_language();
    $description = ml_meta_description();
    $title = ml_meta_title();
?>
<html lang="<?php echo $language ?>">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="pl,en,fr">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="https://github.com/dbryja">
    <link rel="shortcut icon" href="<?php echo get_site_icon_url()?>">
    <meta name="description" content="<?php echo $description[$language]?>">
    <meta property="og:locale" content="<?php echo ml_returnLocale($language)?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Najbor.pl">
    <meta name="twitter:card" content="summary_large_image" class="yoast-seo-meta-tag">

    <!--dynamic-->
	<?php get_template_part("template-parts/head", "meta") ?>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [
                {
                    "@type": "CollectionPage",
                    "@id": "<?php echo WP_HOME?>/",
                    "url": "<?php echo WP_HOME?>/",
                    "name": [
                        {
                            "@language": "pl",
                            "@value": "Wiktor Najbor – Twórczość, która przenosi w inny wymiar."
                        },
                        {
                            "@language": "en",
                            "@value": "Wiktor Najbor – Art that transcends dimensions."
                        },
                        {
                            "@language": "fr",
                            "@value": "Wiktor Najbor – L'art qui transcende les dimensions."
                        }
                    ],
                    "isPartOf": {
                        "@id": "<?php echo WP_HOME?>/#website"
                    },
                    "about": {
                        "@id": "<?php echo WP_HOME?>/#organization"
                    },
                    "description": [
                      {
                        "@language": "pl",
                        "@value":"Odkryj fascynujący świat sztuki Wiktora Najbora. Zobacz jego wyjątkowe obrazy i projekty artystyczne, które łączą pasję z unikalnym stylem. Przeglądaj galerię dzieł, poznaj artystę i zanurz się w kreatywnym świecie Wiktora Najbora."
                      },
                        {
                            "@language": "en",
                            "@value":"Discover the fascinating world of Wiktor Najbor's art. Explore his unique paintings and artistic projects that blend passion with a distinctive style. Browse the gallery of works, get to know the artist, and immerse yourself in Wiktor Najbor's creative world."
                        },
                        {
                            "@language": "pl",
                            "@value":"Découvrez le monde fascinant de l'art de Wiktor Najbor. Explorez ses peintures uniques et ses projets artistiques qui allient passion et style distinctif. Parcourez la galerie des œuvres, faites connaissance avec l'artiste et plongez dans le monde créatif de Wiktor Najbor."
                        }
                    ],
                    "breadcrumb": {
                        "@id": "<?php echo WP_HOME?>/#breadcrumb"
                    },
                    "inLanguage": ["pl-PL", "en-US", "fr-FR"]
                },
                {
                    "@type": "BreadcrumbList",
                    "@id": "<?php echo WP_HOME?>/#breadcrumb",
                    "itemListElement": [
                        {
                            "@type": "ListItem",
                            "position": 1,
                            "name": [
                                {
                                    "@language": "pl",
                                    "@value": "Start"
                                },
                                {
                                    "@language": "en",
                                    "@value": "Home"
                                },
                                {
                                    "@language": "fr",
                                    "@value": "Accueil"
                                }
                            ],
                            "item": "<?php echo WP_HOME?>/"
                        },
                        {
                            "@type": "ListItem",
                            "position": 2,
                            "name": [
                                {
                                    "@language": "pl",
                                    "@value": "Prace"
                                },
                                {
                                    "@language": "en",
                                    "@value": "Works"
                                },
                                {
                                    "@language": "fr",
                                    "@value": "Travaux"
                                }
                            ],
                            "item": "<?php echo WP_HOME ?>/prace"
                        },
                        {
                            "@type": "ListItem",
                            "position": 3,
                            "name": [
                                {
                                    "@language": "pl",
                                    "@value": "Kontakt"
                                },
                                {
                                    "@language": "en",
                                    "@value": "Contact"
                                },
                                {
                                    "@language": "fr",
                                    "@value": "Contact"
                                }
                            ],
                            "item": "<?php echo WP_HOME?>/kontakt"
                        },
                        {
                            "@type": "ListItem",
                            "position": 4,
                            "name": [
                                {
                                    "@language": "pl",
                                    "@value": "Na Sprzedaż"
                                },
                                {
                                    "@language": "en",
                                    "@value": "For Sale"
                                },
                                {
                                    "@language": "fr",
                                    "@value": "à Vendre"
                                }
                            ],
                            "item": "<?php echo WP_HOME?>/na-sprzedaz"
                        }
                    ]
                },
                {
                    "@type": "WebSite",
                    "@id": "<?php echo WP_HOME?>/#website",
                    "url": "<?php echo WP_HOME?>/",
                    "name": "Najbor",
                    "description": [
                        {
                            "@language": "pl",
                            "@value": "Wiktor Najbor – Twórczość, która przenosi w inny wymiar."
                        },
                        {
                            "@language": "en",
                            "@value": "Wiktor Najbor – Art that transcends dimensions."
                        },
                        {
                            "@language": "fr",
                            "@value": "Wiktor Najbor – L'art qui transcende les dimensions."
                        }
                    ],
                    "publisher": {
                        "@id": "<?php echo WP_HOME?>/#organization"
                    },
                    "potentialAction": [
                        {
                            "@type": "ViewAction",
                            "target": [
                                {
                                    "@type": "EntryPoint",
                                    "urlTemplate": "<?php echo WP_HOME?>/{category}/{post_title}"
                                },
                                {
                                    "@type": "EntryPoint",
                                    "urlTemplate": "<?php echo WP_HOME?>/{category}"
                                }
                            ]
                        }
                    ],
                    "inLanguage": ["pl-PL", "en-US", "fr-FR"]
                },
                {
                    "@type": "Organization",
                    "@id": "<?php echo WP_HOME?>/#organization",
                    "name": "Wiktor Najbor",
                    "url": "<?php echo WP_HOME?>/",
                    "logo": {
                        "@type": "ImageObject",
                        "inLanguage": ["pl-PL", "en-US", "fr-FR"],
                        "@id": "<?php echo WP_HOME?>/#/schema/logo/image/",
                        "url": "<?php echo WP_HOME?>/wp-content/uploads/2024/07/cropped-logo-150x150-1.png",
                        "contentUrl": "<?php echo WP_HOME?>/wp-content/uploads/2024/07/cropped-logo-150x150-1.png",
                        "width": 152,
                        "height": 152,
                        "caption": "Wiktor Najbor"
                    },
                    "image": {
                        "@id": "<?php echo WP_HOME?>/#/schema/logo/image/"
                    },
                    "sameAs": [
                        "https://www.facebook.com/profile.php?id=100063761825254"
                    ]
                }
            ]
        }
    </script>

    <?php
    wp_head();
    $home = get_home_url();

    $labels = ml_menuItems();
    ?>
</head>

<body>
<?php
    if(is_front_page() || is_home()){
	    get_template_part("template-parts/header", "animation");
    }
?>
<header class="header">
    <div class="logo">
        <a href="<?php echo $home?>"><img src="<?php echo get_template_directory_uri()?>/assets/images/logo.png" alt="logo"></a>
    </div>
    <h3>
        <?php get_heading_template(); ?>
    </h3>
    <?php
    if (is_page('na-sprzedaz')
        || is_page("dostepne")
        || is_post_type_archive('prace')
        || is_tax('katprace')
    ) {
        get_template_part("template-parts/header", "categories");
    }
    ?>

    <div class="header__right">
        <button class="header__menu cursor--click h4 anim" tabindex="0">
                menu
        </button>
        <?php get_template_part("template-parts/header", "language-selector") ?>
    </div>
</header>
<div class="menu inactive">
    <ul class="menu__list main">
        <li class="menu__item cursor--click item animate"><a href="<?php echo $home?>"><?php echo $labels["home"][$language]?></a></li>
        <li class="menu__item cursor--click item animate prace" tabindex="0"><?php echo $labels["prace"][$language]?></li>
        <li class="menu__item cursor--click item animate"><a href="<?php echo $home?>/kontakt"><?php echo $labels["kontakt"][$language]?></a></li>
        <li class="menu__item cursor--click item animate"><a href="<?php echo $home?>/na-sprzedaz"><?php echo $labels["na_sprzedaz"][$language]?></a></li>
	    <br/>
    </ul>
    <ul class="menu__list hidden categories">
		<?php
		$categories = get_katprace_categories_with_translations();
		foreach ($categories as $category) {
			$name = $category['name_' . $language];
			$slug = $category['slug'];
			$thumbnail_url = $category['thumbnail_url'];
			echo "<li class='menu__item animate cursor--img item' data-thumbnail='$thumbnail_url'><a href='$home/prace/$slug'>$name</a></li>";
		}
		?>
        <li class='menu__item animate cursor--img item' data-thumbnail='<?php echo get_template_directory_uri().'/assets/images/main-thumb.jpg' ?>'><a href='<?php echo $home."/prace" ?>'><?php echo $labels["wszystkie"][$language]?></a></li>
    </ul>
    <button class="menu__btn--close cursor--click h6">
        <?php echo $labels["zamknij"][$language]?>
    </button>
    <div class="position--bottom">
        <?php get_template_part("template-parts/header", "language-selector") ?>
    </div>
    <?php
    get_template_part("template-parts/content", "copyrights");
    ?>
</div>

<div class="cursor">
    <div class="cursor__arrow">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#FE0000" stroke="#FE0000" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
    </div>
    <div class="cursor__image"></div>
</div>


<script>
    const menuContainer = document.querySelector('.menu');
    const button = document.querySelector('.header__menu');
    const prace = document.querySelector('li.prace');
    const mainMenu = document.querySelector('ul.main');
    const subMenu = document.querySelector('ul.categories');
    const cursor = document.querySelector(".cursor");
    const mainMenuItems = mainMenu.querySelectorAll(".menu__item");

    const selector = ".menu__list:not([hidden]) .menu__item.animate"
    const ease = 'circ';
    const duration = 0.1;

    function menuItemsEnter({reverse}={reverse: false}) {
        reverse = reverse ? -1 : 1;
        return new Promise((resolve) => {
            gsap.set(selector, {
                y: "0",
                opacity: 1,
            });
            gsap.from(selector, {
                duration: duration,
                y: "1rem",
                opacity: 0,
                stagger: reverse * duration/2,
                ease: ease,
                onComplete: resolve
            });
        });
    }
    function menuItemsLeave({reverse}={reverse: false}){
        reverse = reverse ? -1 : 1;
        return new Promise((resolve) => {
            gsap.to(selector, {
                duration: duration/2,
                y: "-1rem",
                opacity: 0,
                stagger: reverse*duration/1.5,
                ease: ease,
                onComplete: resolve
            });
        });
    }
    function toggleMenu(){
        menuContainer.classList.toggle('active');
        menuContainer.classList.toggle("inactive");

        if(menuContainer.classList.contains("active"))
            menuContainer.appendChild(cursor);
        else
            document.body.appendChild(cursor);
    }
    function toggleMenuOptions(){
        mainMenu.classList.toggle('hidden');
        subMenu.classList.toggle('hidden');
    }

    // Handling the "prace" li item to enter nested menu
    prace.addEventListener('click',async () => {
        menuItemsLeave({reverse:true}).then(()=>{
            menuItemsEnter({reverse:true});
            toggleMenuOptions();
            }
        );
    });
    prace.addEventListener('keydown', async (event) => {
        if (event.key === 'Enter' || event.keyCode === 13) {
            menuItemsLeave({reverse:true}).then(() => {
                menuItemsEnter({reverse:true});
                toggleMenuOptions();
            });
        }
    });

    // Preventing menu button spam
    let isProcessing = false;
    button.addEventListener('click', async (e) => {
        console.log(isProcessing);
        if (isProcessing) return;
        isProcessing = true;
        e.target.disabled = true;

        try {
            toggleMenu();
            await menuItemsEnter();
        } finally {
            isProcessing = false;
            e.target.disabled = false;
        }
    });

    // Handling menu closing options
    document.querySelector('.menu__btn--close').addEventListener('click', async () => {
        setTimeout(()=>{
            toggleMenu();
        }, 300);
        await menuItemsLeave();
    });
    menuContainer.addEventListener('click', async (e) => {
        if(e.target === menuContainer){
            setTimeout(()=>{
                toggleMenu();
            }, 300);
            await menuItemsLeave().then(()=>{
                if(document.querySelector("ul.main").classList.contains("hidden"))
                 toggleMenuOptions();
            });
        }
    });
</script>

<main class="main-wrapper">

