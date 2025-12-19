<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Required: Core classes
require_once get_parent_theme_file_path( '/core/helpers.php' );
require_once get_parent_theme_file_path( '/core/hook-filter.php' );
require_once get_parent_theme_file_path( '/core/theme-setup.php' );
require_once get_parent_theme_file_path( '/core/theme-sidebar.php' );
require_once get_parent_theme_file_path( '/core/assets.php' );
require_once get_parent_theme_file_path( '/core/custom-comments.php' );

// Required: Plugin Activation
require_once get_parent_theme_file_path( '/includes/plugin-activation/class-tgm-plugin-activation.php' );
require_once get_parent_theme_file_path( '/includes/plugin-activation/plugin-activation.php' );

// Required: meta box setup
require_once get_theme_file_path('includes/MetaBox/setup-metabox.php');