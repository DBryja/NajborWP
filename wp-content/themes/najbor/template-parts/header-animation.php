<?php $template_directory_uri = get_template_directory_uri(); ?>

<div id="anim-wrapper" class="anim-wrapper anim">
    <div id="logo" class="logo anim__item">
        <picture>
            <source srcset="<?php echo $template_directory_uri; ?>/assets/images/logo.webp" type="image/webp">
            <img src="<?php echo $template_directory_uri; ?>/assets/images/logo.png" alt="">
        </picture>
    </div>
    <div id="autobus" class="autobus anim__item">
        <picture>
            <source srcset="<?php echo $template_directory_uri; ?>/assets/images/autobus.webp" type="image/webp">
            <img src="<?php echo $template_directory_uri; ?>/assets/images/autobus2.png" alt="">
        </picture>
    </div>
    <div id="samolot" class="samolot anim__item">
        <picture>
            <source srcset="<?php echo $template_directory_uri; ?>/assets/images/samolot.webp" type="image/webp">
            <img src="<?php echo $template_directory_uri; ?>/assets/images/samolot2.png" alt="">
        </picture>
    </div>
</div>