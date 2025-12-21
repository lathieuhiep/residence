<?php

namespace ExtendSite\Options;

use Carbon_Fields\Container;

defined('ABSPATH') || exit;

class ThemeOptions
{
    public static function boot(): void
    {
        add_action('carbon_fields_register_fields', [self::class, 'register']);
    }

    public static function register(): void
    {
        Container::make('theme_options', esc_html__('Theme Settings', 'extend-site'))
            ->set_icon('dashicons-admin-generic')
            ->set_page_menu_position(3)
            ->add_tab(
                esc_html__('General', 'extend-site'),
                GeneralOptions::fields()
            )
            ->add_tab(
                esc_html__('Contact', 'extend-site'),
                ContactOptions::fields()
            )
            ->add_tab(
                esc_html__('Recruitment', 'extend-site'),
                RecruitmentOptions::fields()
            )->add_tab(
                esc_html__('Footer', 'extend-site'),
                FooterOptions::fields()
            )->add_tab(
                esc_html__('Copyright', 'extend-site'),
                CopyrightOptions::fields()
            );
    }
}
