<?php
/**
 * Remove jQuery migrate from the front-end.
 *
 * @param WP_Scripts $scripts The WP_Scripts object.
 * @return void
 */
function residence_remove_wp_jquery_core(WP_Scripts $scripts): void
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, ['jquery-migrate']);
        }
    }
}

add_action('wp_default_scripts', 'residence_remove_wp_jquery_core');

/**
 * Remove WordPress block library CSS from the front-end.
 *
 * @return void
 */
function residence_remove_wp_block_css_core(): void
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('storefront-gutenberg-blocks');
}

add_action('wp_enqueue_scripts', 'residence_remove_wp_block_css_core', 100);

/**
 * Enqueue theme scripts and styles.
 *
 * @return void
 */
function residence_enqueue_theme_assets(): void
{
    // Enqueue Bootstrap CSS.
    wp_enqueue_style('bootstrap', get_theme_file_uri('/assets/vendors/bootstrap/bootstrap.min.css'), [], '5.3.7');

    // Enqueue main theme style.
    wp_enqueue_style('residence-main', get_theme_file_uri('/assets/css/main.bundle.min.css'), [], wp_get_theme()->get('Version'));

    // Enqueue 404 page-specific style.
    if (is_404()) {
        wp_enqueue_style('residence-page-404', get_theme_file_uri('/assets/css/page-templates/page-404.min.css'), [], wp_get_theme()->get('Version'));
    }

    // Enqueue main theme script.
    wp_enqueue_script('residence-main', get_theme_file_uri('/assets/js/main.bundle.min.js'), ['jquery'], wp_get_theme()->get('Version'), true);
}

add_action('wp_enqueue_scripts', 'residence_enqueue_theme_assets');