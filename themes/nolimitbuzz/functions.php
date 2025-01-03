<?php
function nolimitbuzz_theme_setup()
{
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'nolimitbuzz_theme_setup');

function team_member_post_type()
{
    register_post_type('team_member', [
        'labels' => [
            'name' => 'Team Members',
            'singular_name' => 'Team Member',
        ],
        'public' => true,
        'supports' => ['title', 'thumbnail'],
    ]);
}
add_action('init', 'team_member_post_type');

function register_theme_menus()
{
    register_nav_menus(array(
        'main-menu'   => 'Main Menu',
        'footer-menu' => 'Footer Menu',
    ));
}
add_action('after_setup_theme', 'register_theme_menus');

function theme_enqueue_custom_styles()
{
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');

    wp_enqueue_script('custom-script', get_template_directory_uri() . '/script.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_custom_styles');
