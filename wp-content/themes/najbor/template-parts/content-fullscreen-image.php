<?php
/**
 * Template Part: Fullscreen Image Viewer
 *
 * This template part displays a fullscreen image viewer.
 *
 * Usage:
 * Before including this template, make sure that there is an element with class "--fullscreen"
 * and set the required variables using set_query_var():
 *
 * ```php
 * set_query_var('fullscreen_img_url', 'https://example.com/image.jpg');
 * set_query_var('fullscreen_img_alt', 'Example Image');
 * get_template_part('template-parts/fullscreen-image');
 * ```
 *
 * Required Variables:
 * - `fullscreen_img_url` (string) - URL of the image to display.
 * - `fullscreen_img_alt` (string) - Alternative text for the image (optional).
 *
 * If `fullscreen_img_url` is empty or invalid, this template will not render anything.
 */

$image_url = get_query_var('fullscreen_img_url', '');
$image_alt = get_query_var('fullscreen_img_alt', '');
// Validate the image URL (ensure it's a valid non-empty string)
if (empty($image_url) || !filter_var($image_url, FILTER_VALIDATE_URL)) {
    return;
}
?>

<div class="fullscreen">
    <div class="fullscreen__close">&times;</div>
    <div class="fullscreen__image-container">
        <img
                loading="lazy"
                class="fullscreen__image"
                data-src="<?php echo esc_url($image_url); ?>"
                alt="<?php echo esc_attr($image_alt); ?>">
    </div>
</div>
<script>
    const fullscreen = document.querySelector('.fullscreen');
    const closeButton = document.querySelector('.fullscreen__close');
    const imageToEnlarge = document.querySelector('.--fullscreen');
    const fullscreenImage = fullscreen.querySelector('.fullscreen__image');
    function closeFullscreen() {
        fullscreen.classList.remove("active");
        fullscreen.style.display = 'none';
        document.documentElement.style.overflowY = 'auto';
    }
    imageToEnlarge.addEventListener('click', function() {
        const imageSrc = fullscreenImage.getAttribute('data-src');
        if (!fullscreenImage.src) {
            fullscreenImage.src = imageSrc;
        }
        fullscreen.style.display = 'flex';
        document.documentElement.style.overflowY = 'hidden';
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
</script>