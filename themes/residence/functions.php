<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Required: Core classes
require get_parent_theme_file_path( '/core/helpers.php' );
require get_parent_theme_file_path( '/core/hook-filter.php' );
require get_parent_theme_file_path( '/core/theme-setup.php' );
require get_parent_theme_file_path( '/core/theme-sidebar.php' );
require get_parent_theme_file_path( '/core/assets.php' );
require get_parent_theme_file_path( '/core/custom-comments.php' );

// Required: Plugin Activation
require get_parent_theme_file_path( '/includes/plugin-activation/class-tgm-plugin-activation.php' );
require get_parent_theme_file_path( '/includes/plugin-activation/plugin-activation.php' );