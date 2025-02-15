<?php
	$lang = get_site_language();
?>

<form id="language-form" class="lang">
    <label class="cursor--click anim lang__item <?php echo ($lang == 'pl') ? 'active' : ''; ?>" tabindex="0">
        <input type="radio" name="language" value="pl" <?php checked($lang, 'pl'); ?>>
        <span>
            <?php _e('PL', 'textdomain'); ?>
        </span>
    </label>
    <label class="cursor--click anim lang__item <?php echo ($lang == 'fr') ? 'active' : ''; ?>" tabindex="0">
        <input type="radio" name="language" value="fr" <?php checked($lang, 'fr'); ?>>
        <span>
            <?php _e('FR', 'textdomain'); ?>
        </span>
    </label>
    <label class="cursor--click anim lang__item <?php echo ($lang == 'en') ? 'active' : ''; ?>" tabindex="0">
        <input type="radio" name="language" value="en" <?php checked($lang, 'en'); ?>>
        <span>
            <?php _e('EN', 'textdomain'); ?>
        </span>
    </label>
</form>

<script>
    document.querySelectorAll('input[name="language"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            const selectedLanguage = this.value;
            const origin = window.location.origin;
            const path_segments = window.location.pathname.split("/").filter(segment => segment);

            let basePath = origin;
            let newPath = '';

            // Remove existing language segment if present
            const languages = ['pl', 'fr', 'en'];
            const filtered_segments = path_segments.filter(segment => !languages.includes(segment));

            // Check if we are on localhost/wordpress
            const isWordPress = filtered_segments.includes('wordpress');

            // Construct the new path based on language change
            if (isWordPress) {
                const wordpressIndex = filtered_segments.indexOf('wordpress');
                newPath = filtered_segments.slice(wordpressIndex + 1).join('/'); // Skip 'wordpress'

                // Handle language prefix
                if (selectedLanguage === 'pl') {
                    window.location.href = `${basePath}/wordpress/${newPath}`;
                } else {
                    window.location.href = `${basePath}/wordpress/${selectedLanguage}/${newPath}`;
                }
            } else {
                newPath = filtered_segments.join('/');
                if (selectedLanguage === 'pl') {
                    window.location.href = `${basePath}/${newPath}`;
                } else {
                    window.location.href = `${basePath}/${selectedLanguage}/${newPath}`;
                }
            }
        });
    });

</script>
