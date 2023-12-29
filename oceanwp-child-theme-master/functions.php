<?php
/**
 * OceanWP Child Theme Functions
 *
 * When running a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions will be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {

	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update the theme).
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );

	// Load the stylesheet.
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	
}

add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

add_filter('wp_nav_menu_items', 'link_admin_menu_oceanwp', 10, 2);

function link_admin_menu_oceanwp($items, $args) {
    if (is_user_logged_in() && current_user_can('manage_options') && $args->theme_location == 'main_menu') {
        $admin_link = '<li><a href="' . esc_url(get_admin_url()) . '">Admin</a></li>';
        
        // l'emplacement où vous souhaitez insérer le lien Admin dans le menu existant
        $insert_position = 1; // Cela insère le lien à la deuxième position (index 1) dans le menu.

        // Convertissez la chaîne $items en un tableau
        $menu_items = preg_split('/<\/li>/', $items);

        //le lien Admin à l'emplacement spécifié
        array_splice($menu_items, $insert_position, 0, $admin_link);

        // Rejoigne à nouveau le tableau en une chaîne
        $items = implode('</li>', $menu_items);
    }

    return $items;
}

?> 
