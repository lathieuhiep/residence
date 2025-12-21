<?php
namespace ExtendSite\Core;

use ExtendSite\Helpers\ESHelpers;

defined('ABSPATH') || exit;

class Enqueue
{
    /**
     * Boot the Enqueue class.
     */
    public static function boot(): void
    {
        add_action('login_enqueue_scripts', [self::class, 'enqueue_scripts_login']);
        add_action('admin_enqueue_scripts', [self::class, 'enqueue_scripts_backend']);
        add_action('wp_enqueue_scripts', [self::class, 'enqueue_scripts_frontend']);
    }

    /**
     * Enqueue scripts login
     */
    public static function enqueue_scripts_login(): void
    {
        wp_enqueue_style(
            'es-login',
            EXTEND_SITE_URL . 'assets/css/backend/custom-login.min.css',
            [],
            EXTEND_SITE_VERSION
        );
    }

    /**
     * Enqueue scripts backend
     */
    public static function enqueue_scripts_backend()
    {}

    /**
     * Enqueue scripts frontend
     */
    public static function enqueue_scripts_frontend(): void
    {}
}