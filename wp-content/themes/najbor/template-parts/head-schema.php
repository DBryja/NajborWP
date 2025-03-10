<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "CollectionPage",
          "@id": "<?php echo WP_HOME?>/",
      "url": "<?php echo WP_HOME?>/",
      "name": [
    <?php echo format_json_array(ml_meta_title(), "@language", "@value") ?>
    ],
    "isPartOf": {
      "@id": "<?php echo WP_HOME?>/#website"
      },
      "about": {
        "@id": "<?php echo WP_HOME?>/#organization"
      },
      "description": [
    <?php echo format_json_array(ml_meta_description(), "@language", "@value") ?>
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
    <?php echo get_breadcrumb_items(ml_menuItems(), 4); ?>
    ]
  },
  {
    "@type": "WebSite",
    "@id": "<?php echo WP_HOME?>/#website",
      "url": "<?php echo WP_HOME?>/",
      "name": "Najbor",
      "description": [
    <?php echo format_json_array(ml_meta_description(), "@language", "@value"); ?>
    ],
    "publisher": {
      "@id": "<?php echo WP_HOME?>/#organization"
      },
      "potentialAction": [
        {
          "@type": "SearchAction",
          "target": {
            "@type": "EntryPoint",
            "urlTemplate": "<?php echo WP_HOME?>/{search_term_string}"
          },
          "query-input": "required name=search_term_string"
        },
        {
          "@type": "ViewAction",
          "target": [
            {
              "@type": "EntryPoint",
              "urlTemplate": "<?php echo WP_HOME?>/prace/{category}/{post_title}"
            },
            {
              "@type": "EntryPoint",
              "urlTemplate": "<?php echo WP_HOME?>/prace/{category}"
            },
            {
              "@type": "EntryPoint",
              "urlTemplate": "<?php echo WP_HOME?>/en/prace/{category}/{post_title}"
            },
            {
              "@type": "EntryPoint",
              "urlTemplate": "<?php echo WP_HOME?>/fr/prace/{category}/{post_title}"
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
        "https://www.facebook.com/malarstwonajbor"
      ]
    },
    {
      "@type": "ItemList",
      "@id": "<?php echo WP_HOME?>/dostepne/#itemlist",
      "name": "Available Works",
      "itemListElement": <?php echo get_available_works(); ?>
    },
    {
      "@type": "ContactPage",
      "@id": "<?php echo WP_HOME?>/kontakt/#webpage",
      "url": "<?php echo WP_HOME?>/kontakt/",
      "name": [
    <?php echo format_json_array(ml_meta_title('contact'), "@language", "@value") ?>
    ],
    "isPartOf": {
      "@id": "<?php echo WP_HOME?>/#website"
      },
      "description": [
    <?php echo format_json_array(ml_meta_description('contact'), "@language", "@value") ?>
    ],
    "inLanguage": ["pl-PL", "en-US", "fr-FR"]
  }
]
}
</script>