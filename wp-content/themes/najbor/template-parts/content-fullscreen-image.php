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
    <div class="magnifier" style="display: none;"></div>
</div>
<style>
    .fullscreen__image-container{
        position: relative;
        /*cursor: none;*/
    }
    .magnifier {
        position: absolute;
        width: 300px;
        height: 300px;
        border: 2px solid #fff;
        pointer-events: none;
        background-repeat: no-repeat;
        display: none;
        z-index: 100;
        transform: translate(-50%, -50%);
    }
</style>

<script>
    const fullscreen = document.querySelector('.fullscreen');
    const closeButton = document.querySelector('.fullscreen__close');
    const imageToEnlarge = document.querySelector('.--fullscreen');
    const fullscreenImage = fullscreen.querySelector('.fullscreen__image');
    const imageContainer = document.querySelector('.fullscreen__image-container');
    const magnifier = document.querySelector('.magnifier');

    // Magnification level
    const zoomLevel = 2;

    function closeFullscreen() {
        fullscreen.classList.remove("active");
        fullscreen.style.display = 'none';
        document.documentElement.style.overflowY = 'auto';
        magnifier.style.display = 'none';
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

    // Magnifier functionality
    fullscreenImage.addEventListener('load', function() {
        // Enable magnifier only after image is loaded
        imageContainer.addEventListener('mousemove', showMagnifier);
        imageContainer.addEventListener('mouseleave', hideMagnifier);
        imageContainer.addEventListener('mouseenter', showMagnifier);
    });

    function showMagnifier(e) {
        magnifier.style.display = 'block';

        // Get the cursor position
        const { left: imgLeft, top: imgTop, width: imgWidth, height: imgHeight } =
            fullscreenImage.getBoundingClientRect();

        // Calculate position relative to the image
        const x = e.clientX;
        const y = e.clientY;

        // Set magnifier position (no offset needed because of transform: translate(-50%, -50%))
        magnifier.style.left = `${x}px`;
        magnifier.style.top = `${y}px`;

        // Calculate the background position for zoomed effect
        const bgX = ((x - imgLeft) * zoomLevel - 150) * -1;
        const bgY = ((y - imgTop) * zoomLevel - 150) * -1;

        // Set background image and position
        magnifier.style.backgroundImage = `url(${fullscreenImage.src})`;
        magnifier.style.backgroundSize = `${imgWidth * zoomLevel}px ${imgHeight * zoomLevel}px`;
        magnifier.style.backgroundPosition = `${bgX}px ${bgY}px`;
    }

    function hideMagnifier() {
        magnifier.style.display = 'none';
    }
</script>