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

            // Lista obsługiwanych języków
            const languages = ['pl', 'fr', 'en'];
            const filtered_segments = path_segments.filter(segment => !languages.includes(segment));

            // Sprawdzenie, czy działamy na localhost
            const isLocalhost = window.location.hostname.includes('localhost');

            // Jeśli jesteśmy na localhost, zakładamy, że pierwsza część ścieżki to nazwa folderu (np. NajborWP)
            let projectFolder = isLocalhost ? filtered_segments[0] : null;
            let newSegments = isLocalhost ? filtered_segments.slice(1) : filtered_segments;

            newPath = newSegments.join('/');

            // Budowanie nowego URL-a
            if (isLocalhost && projectFolder) {
                // Jeśli język to 'pl', nie dodajemy przedrostka językowego
                window.location.href = selectedLanguage === 'pl'
                    ? `${basePath}/${projectFolder}/${newPath}`
                    : `${basePath}/${projectFolder}/${selectedLanguage}/${newPath}`;
            } else {
                // Normalne przekierowanie dla produkcji
                window.location.href = selectedLanguage === 'pl'
                    ? `${basePath}/${newPath}`
                    : `${basePath}/${selectedLanguage}/${newPath}`;
            }
        });
    });
</script>
