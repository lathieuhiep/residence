<?php

defined('ABSPATH') || exit;

/**
 * Load Carbon Fields
 */
add_action('after_setup_theme', function () {
    if (!class_exists('\Carbon_Fields\Carbon_Fields')) {
        return;
    }

    // Home Page metabox
    require_once get_theme_file_path('includes/MetaBox/PageHome/PageHomeMeta.php');
});
