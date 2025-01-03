<?php
/*
 Plugin Name: Nolimitbuzz Portfolio
 Description: A plugin to create a Portfolio custom post type.
 Version: 1.0
 Author: Sylva 👨‍💻
*/

// Register custom post type and taxonomy
function custom_portfolio_post_type()
{
    // Register the Portfolio custom post type
    register_post_type('portfolio', [
        'labels' => [
            'name' => 'Portfolios',
            'singular_name' => 'Portfolio',
            'add_new' => 'Add New Portfolio',
            'add_new_item' => 'Add New Portfolio Item',
            'edit_item' => 'Edit Portfolio Item',
            'new_item' => 'New Portfolio Item',
            'view_item' => 'View Portfolio Item',
            'search_items' => 'Search Portfolios',
            'not_found' => 'No Portfolios found',
            'not_found_in_trash' => 'No Portfolios found in Trash',
        ],
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'rewrite' => ['slug' => 'portfolios'],
        // 'has_archive' => true,
        'show_in_rest' => true, // Enable Gutenberg support
    ]);

    // Register the Portfolio Category taxonomy
    register_taxonomy('portfolio_category', 'portfolio', [
        'labels' => [
            'name' => 'Portfolio Categories',
            'singular_name' => 'Portfolio Category',
            'search_items' => 'Search Portfolio Categories',
            'all_items' => 'All Portfolio Categories',
            'edit_item' => 'Edit Portfolio Category',
            'update_item' => 'Update Portfolio Category',
            'add_new_item' => 'Add New Portfolio Category',
            'new_item_name' => 'New Portfolio Category Name',
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
    ]);
}
add_action('init', 'custom_portfolio_post_type');
// Enqueue styles and scripts for the portfolio
function enqueue_portfolio_assets()
{
    wp_enqueue_style(
        'portfolio-style',
        plugin_dir_url(__FILE__) . 'css/portfolio-style.css',
        array(),
        '1.0',
        'all'
    );

    wp_enqueue_script(
        'portfolio-script',
        plugin_dir_url(__FILE__) . 'script/portfolio-script.js',
        array('jquery'),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_portfolio_assets');

function portfolio_shortcode()
{
    $terms = get_terms(['taxonomy' => 'portfolio_category', 'hide_empty' => true]);

    // Start building the output
    $output = '<div class="portfolio-section">';

    // Add custom text block
    $output .= '<div class="portfolio-intro">';
    $output .= '<h2>Our Portfolio</h2>';
    $output .= '</div>'; // Close portfolio-intro

    // Portfolio tabs
    $output .= '<div class="portfolio-tabs">';
    $output .= '<button class="portfolio-tab active" data-category="all">All</button>';

    // Add a button for each category
    foreach ($terms as $term) {
        $output .= '<button class="portfolio-tab" data-category="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</button>';
    }
    $output .= '</div>'; // Close portfolio-tabs

    // Portfolio items container
    $output .= '<div class="portfolio-items">';

    // Custom Query to fetch all portfolio items
    $query = new WP_Query([
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
    ]);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $categories = wp_get_post_terms(get_the_ID(), 'portfolio_category', ['fields' => 'slugs']);
            $output .= '<div class="portfolio-item" data-categories="' . implode(' ', $categories) . '">';
            $output .= get_the_post_thumbnail(null, 'full', ['class' => 'portfolio-thumbnail']);
            $output .= '<h3>' . get_the_title() . '</h3>';
            $output .= '<div class="post-link"><a href="' . get_the_permalink() . '" class="portfolio-link">Read More</a></div>';
            $output .= '</div>';
        endwhile;
    else:
        $output .= '<p>No portfolio items found.</p>';
    endif;

    wp_reset_postdata(); // Clean up after the custom query

    $output .= '</div>'; // Close portfolio-items container
    $output .= '</div>'; // Close portfolio-section

    return $output;
}
add_shortcode('portfolio', 'portfolio_shortcode');
