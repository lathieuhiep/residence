<?php

namespace ExtendSite\Core;

use ExtendSite\MetaBox\BranchMetaBox;
use ExtendSite\Options\ThemeOptions;
use ExtendSite\PostType\BranchPostType;
use ExtendSite\PostType\TemplateLoader;

defined('ABSPATH') || exit;

class Plugin
{
    public function boot(): void
    {
        self::load_text_domain();
        self::load_enqueue();
        self::load_custom_post_types();

        // Flush rewrite
        self::maybe_flush_rewrite();

        // Load Carbon Fields
        CarbonLoader::boot();

        // Load Carbon Fields theme options
        ThemeOptions::boot();

        // Load MetaBoxes
        self::load_meta_box();
    }

    /**
     * Load the plugin text domain for translations.
     */
    private static function load_text_domain(): void
    {
        load_plugin_textdomain(
            'extend-site',
            false,
            dirname(EXTEND_SITE_BASENAME) . '/languages'
        );
    }

    /**
     * Load core functionalities.
     */
    private static function load_enqueue(): void
    {
        Enqueue::boot();
    }

    /**
     * Load custom post types.
     */
    private static function load_custom_post_types(): void
    {
        new BranchPostType();

        TemplateLoader::boot();
    }

    /**
     * Flush rewrite rules nếu có flag
     */
    private static function maybe_flush_rewrite(): void
    {
        if (get_option('extend_site_flush_rewrite')) {
            flush_rewrite_rules(false); // false = không ghi lại htaccess
            delete_option('extend_site_flush_rewrite');
        }
    }

    /**
     * Load Meta Boxes.
     */
    private static function load_meta_box(): void
    {
        BranchMetaBox::boot();
    }
}