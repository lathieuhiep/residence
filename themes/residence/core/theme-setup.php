<?php
/**
 * Residence Theme setup.
 *
 * This file contains all core functions for setting up and optimizing the theme.
 *
 * @package Residence
 */

defined('ABSPATH') || exit;

/**
 * Loads the theme's text domain for translation.
 *
 * @return void
 */
function residence_load_text_domain(): void
{
    load_theme_textdomain('residence', get_template_directory() . '/languages');
}

/**
 * Adds theme support features.
 *
 * @return void
 */
function residence_add_theme_support(): void
{
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ]);

    add_theme_support('customize-selective-refresh-widgets');

    if (class_exists('Woocommerce')) :
        add_theme_support('woocommerce');
    endif;
}

/**
 * Registers navigation menus.
 *
 * @return void
 */
function residence_register_nav_menus(): void
{
    register_nav_menus([
        'main_menu' => esc_html__('Menu chính', 'residence'),
    ]);
}

/**
 * Outputs fallback favicon links if no site icon is set.
 *
 * @return void
 */
function residence_output_fallback_favicon(): void
{
    if (!has_site_icon()) {
        $base_url = get_theme_file_uri('/assets/images/favicons/');
    ?>
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url($base_url . 'apple-touch-icon.png'); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url($base_url . 'favicon-32x32.png'); ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url($base_url . 'favicon-16x16.png'); ?>">
        <link rel="icon" type="image/svg+xml" href="<?php echo esc_url($base_url . 'favicon.svg'); ?>">
        <link rel="manifest" href="<?php echo esc_url($base_url . 'site.webmanifest'); ?>">
    <?php
    }
}

/**
 * Removes unnecessary actions and filters for optimization.
 *
 * @return void
 */
function residence_remove_unnecessary_assets(): void
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('template_redirect', 'rest_output_link_header', 11);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}

/**
 * Disables the emojis TinyMCE plugin.
 *
 * @param array $plugins The list of TinyMCE plugins.
 * @return array The modified list of TinyMCE plugins.
 */
function residence_disable_emojis_tinymce(array $plugins): array {
    return $plugins ? array_diff($plugins, ['wpemoji']) : [];
}

/**
 * Disables the block editor (Gutenberg) for all post types.
 *
 * @return bool Always returns false.
 */
function residence_disable_gutenberg_editor(): bool {
    return false;
}

/**
 * Initializes all theme actions and filters.
 *
 * @return void
 */
function residence_init(): void
{
    // Theme setup
    residence_load_text_domain();
    residence_add_theme_support();
    residence_register_nav_menus();

    // Cleanup and optimization hooks
    add_action('wp_head', 'residence_output_fallback_favicon');
    add_action('init', 'residence_remove_unnecessary_assets');
    add_filter('tiny_mce_plugins', 'residence_disable_emojis_tinymce');
    add_filter('xmlrpc_enabled', '__return_false');
    add_filter('use_block_editor_for_post_type', 'residence_disable_gutenberg_editor');
    add_filter('use_widgets_block_editor', '__return_false');
}
add_action('after_setup_theme', 'residence_init');