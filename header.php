<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TwoByteCode
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php do_action('after_body_open_tag'); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'twobytecode'); ?></a>

        <header id="masthead" class="site-header sticky-top">

            <div class="container">

                <h1 class="logo h1 site-title mb-0"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">2B<span>yte</span>C<span>ode</span></a></h1>


                <nav role="navigation" id="main-mobile-menu">
                    <div class="mobileMenuClose">
                        <span onclick="closeMobileMenu();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 50 50" overflow="visible" stroke-width="10" stroke-linecap="round">
                                <line x2="50" y2="50" />
                                <line x1="50" y2="50" />
                            </svg>
                        </span>
                    </div>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'menu-1',
                                'menu_id'        => 'primary-menu',
                            )
                        );
                        ?>
                    <!-- <div class="theme-btn" onclick="toggleTheme();"><i class="bi-moon-fill"></i></div> -->
                </nav>
                
                <div class="headerMenuWrapper">
                <!-- <div class="mobile-theme-btn"><i class="bi bi-brightness-high-fill" onclick="toggleTheme(this);"></i></div> -->
                <div class="mobile-theme-btn"><span onclick="toggleTheme(this);"></span></div>
                <div class="mobileMenu" onclick="mobileMenu();">
                    <span>
                        <svg viewBox="0 0 100 80" width="30" height="30" overflow="visible" stroke="currentColor" stroke-width="2">
                            <rect width="86" height="7" rx="5" ry="5"></rect>
                            <rect y="28" width="86" height="7" rx="5" ry="5"></rect>
                            <rect y="56" width="86" height="7" rx="5" ry="5"></rect>
                        </svg>
                    </span>
                </div>
                </div>

                
            </div>
        </header>
