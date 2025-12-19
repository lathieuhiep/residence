<?php

namespace ResidenceTheme\MetaBox\PageHome;

use Carbon_Fields\Container;
use ResidenceTheme\MetaBox\PageHome\Tabs\AboutTab;
use ResidenceTheme\MetaBox\PageHome\Tabs\BranchTab;
use ResidenceTheme\MetaBox\PageHome\Tabs\HeroTab;

defined('ABSPATH') || exit;

final class HomeContainer
{
    /**
     * Boot Home Page metabox
     */
    public static function boot(): void
    {
        // include tabs (dependency của Home)
        require_once __DIR__ . '/Tabs/HeroTab.php';
        require_once __DIR__ . '/Tabs/AboutTab.php';
        require_once __DIR__ . '/Tabs/BranchTab.php';

        self::register();
    }

    /**
     * Register Carbon Fields container
     */
    protected static function register(): void
    {
        Container::make(
            'post_meta',
            esc_html__('Home Page Options', 'residence')
        )
            ->where('post_type', '=', 'page')
            ->where('post_template', '=', 'templates/page-home.php')
            ->add_tab(
                esc_html__('Hero', 'residence'),
                HeroTab::fields()
            )
            ->add_tab(
                esc_html__('About', 'residence'),
                AboutTab::fields()
            ) ->add_tab(
                esc_html__('Branch', 'residence'),
                BranchTab::fields()
            );
    }
}
