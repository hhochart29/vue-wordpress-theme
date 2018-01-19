<?php

function registerScript()
{
//    wp_enqueue_style('css-vue', get_template_directory_uri().'/assets/css/app.css');
    wp_deregister_script('jquery');
    wp_deregister_script('wp-embed');
    wp_enqueue_script('js-manifest', get_template_directory_uri().'/assets/js/manifest.js', array(), '1.0', true);
    wp_enqueue_script('js-vendor', get_template_directory_uri().'/assets/js/vendor.js', array(), '1.0', true);
    wp_enqueue_script('js-app', get_template_directory_uri().'/assets/js/app.js', array(), '1.0', true);
}

add_filter('show_admin_bar', '__return_false');
add_action('wp_enqueue_scripts', 'registerScript');

function disable_wp_emojicons()
{

    // all actions related to emojis
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    // filter to remove TinyMCE emojis
    add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}

add_action('init', 'disable_wp_emojicons');

// disable loading of stylesheets and scripts from Contact Form 7 plugin
add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');

// remove Get Shortlink
add_filter('pre_get_shortlink', '__return_empty_string');
// Disable Canonical meta from Yoast SEO Plugin
add_filter('wpseo_canonical', '__return_false');

/**
 * Remove unnecessary metas from <head>.
 */
function remove_some_metas()
{
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'rel_canonical');
}

add_action('after_setup_theme', 'remove_some_metas');