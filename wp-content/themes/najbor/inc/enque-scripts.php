<?php
function najbor_theme_support(){
	add_theme_support('title-tag');
	add_theme_support('custom-logo');
	add_theme_support('post-thumbnails');
//    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form'));
}
add_action("after_setup_theme", "najbor_theme_support");
function najbor_register_styles(){
	$version = wp_get_theme()->get('Version');
	wp_enqueue_style('najbor-style', get_template_directory_uri() . '/style.css', array(), $version, 'all');
	wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/style.css', array(), $version, 'all');
}
add_action("wp_enqueue_scripts", "najbor_register_styles");

function najbor_register_scripts(){
    wp_deregister_script('jquery');
	wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', false);
    wp_enqueue_script('gsap-scrollTrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array(), '3.12.5', false);
	if(is_front_page() || is_home()){
	    wp_enqueue_script('gsap-motion-path', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/MotionPathPlugin.min.js', array(), '3.12.5', false);
		wp_enqueue_script("home-animation",
            get_template_directory_uri() . "/assets/js/home-animations.js",
            array("gsap", "gsap-motion-path", "gsap-scrollTrigger"), null, false);
	}

	wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), null, true);
	wp_enqueue_script('cursor-js', get_template_directory_uri() . '/assets/js/cursor.js', array("gsap"), null, true);
}
add_action("wp_enqueue_scripts", "najbor_register_scripts", 1);
?>