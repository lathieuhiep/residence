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
    // font icons style.
    wp_enqueue_style('TH-icon', get_theme_file_uri('/assets/fonts/TH-icon-v1.0/style.css'), [], wp_get_theme()->get('Version'));

    // swiper library
    wp_enqueue_style('swiper', get_theme_file_uri('/assets/vendors/swiper/swiper.min.css'), [], '11.0.6');
    wp_enqueue_script('swiper', get_theme_file_uri('/assets/vendors/swiper/swiper.min.js'), ['jquery'], '11.0.6', true);

    // slimselect library
    wp_enqueue_style('slimselect', get_theme_file_uri('/assets/vendors/slimselect/slimselect.css'), [], wp_get_theme()->get('Version'));
    wp_enqueue_script('slimselect', get_theme_file_uri('/assets/vendors/slimselect/slimselect.min.js'), ['jquery'], wp_get_theme()->get('Version'), true);

    // fancyBox library
    wp_enqueue_style('fancybox', get_theme_file_uri('/assets/vendors/fancyBox/fancybox.css'), [], '4.0.9');
    wp_enqueue_script('fancybox', get_theme_file_uri('/assets/vendors/fancyBox/fancybox.umd.js'), ['jquery'], '4.0.9', true);


    // Enqueue main theme style.
    wp_enqueue_style('residence-main', get_theme_file_uri('/assets/css/main.css'), [], wp_get_theme()->get('Version'));

    // Enqueue 404 page-specific style.
    if (is_404()) {
        wp_enqueue_style('residence-page-404', get_theme_file_uri('/assets/css/page-templates/page-404.min.css'), [], wp_get_theme()->get('Version'));
    }

    // lenis library
    wp_enqueue_script('lenis', get_theme_file_uri('/assets/vendors/lenis/lenis.min.js'), ['jquery'], wp_get_theme()->get('Version'), true);

    // wow library
    wp_enqueue_script('wow', get_theme_file_uri('/assets/vendors/wow/wow.min.js'), ['jquery'], wp_get_theme()->get('Version'), true);

    // greensock library
    wp_enqueue_script('gsap', get_theme_file_uri('/assets/vendors/greensock/GSAP.min.js'), ['jquery'], '3.12.2', true);
    wp_enqueue_script('ScrollTrigger', get_theme_file_uri('/assets/vendors/greensock/ScrollTrigger.min.js'), ['jquery', 'gsap'], '3.12.2', true);
    wp_enqueue_script('TextPlugin', get_theme_file_uri('/assets/vendors/greensock/TextPlugin.min.js'), ['jquery', 'gsap'], '3.12.2', true);
    wp_enqueue_script('SplitText', get_theme_file_uri('/assets/vendors/greensock/SplitText.min.js'), ['jquery', 'gsap'], '3.12.2', true);

    // headroom library
    wp_enqueue_script('headroom', get_theme_file_uri('/assets/vendors/headroom/headroom.js'), ['jquery'], '0.9.4', true);

    // Enqueue main theme script.
    wp_enqueue_script('residence-main', get_theme_file_uri('/assets/js/functions.js'), ['jquery'], wp_get_theme()->get('Version'), true);
}

add_action('wp_enqueue_scripts', 'residence_enqueue_theme_assets');