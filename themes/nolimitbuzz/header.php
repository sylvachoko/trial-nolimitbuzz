<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <?php wp_head(); // Essential for WordPress plugins and functionality 
    ?>
</head>

<body <?php body_class(); ?>>

    <header class="site-header">
        <nav>
            <div class="navbarcontainer">
                <div class="navlogo">
                    <a href="/" class="logo">!@&#$</a>

                </div>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu', // Set in functions.php
                    'menu_class'     => 'NavMenu',
                    'fallback_cb'    => false, // Fallback if no menu is set
                ));
                ?>
            </div>
        </nav>
    </header>