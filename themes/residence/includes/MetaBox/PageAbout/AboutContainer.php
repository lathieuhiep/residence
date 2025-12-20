<?php

namespace ResidenceTheme\MetaBox\PageAbout;

use Carbon_Fields\Container;
use ResidenceTheme\MetaBox\PageAbout\Tabs\HighlightsTab;
use ResidenceTheme\MetaBox\PageAbout\Tabs\IncludedServicesTab;
use ResidenceTheme\MetaBox\PageAbout\Tabs\IntroductionTab;
use ResidenceTheme\MetaBox\PageAbout\Tabs\LivingSpaceTab;
use ResidenceTheme\MetaBox\PageAbout\Tabs\OperatorTab;

defined('ABSPATH') || exit;

final class AboutContainer
{
    /**
     * Boot About Page metabox
     */
    public static function boot(): void
    {
        // include tabs (dependency của About)
        require_once __DIR__ . '/Tabs/IntroductionTab.php';
        require_once __DIR__ . '/Tabs/HighlightsTab.php';
        require_once __DIR__ . '/Tabs/LivingSpaceTab.php';
        require_once __DIR__ . '/Tabs/OperatorTab.php';
        require_once __DIR__ . '/Tabs/IncludedServicesTab.php';

        self::register();
    }

    /**
     * Register Carbon Fields container
     */
    protected static function register(): void
    {
        Container::make(
            'post_meta',
            esc_html__('About Page Options', 'residence')
        )
            ->where('post_type', '=', 'page')
            ->where('post_template', '=', 'templates/page-about.php')
            ->add_tab(
                esc_html__('Giới thiệu', 'residence'),
                IntroductionTab::fields()
            )->add_tab(
                esc_html__('Điểm nổi bật', 'residence'),
                HighlightsTab::fields()
            )
            ->add_tab(
                esc_html__('Không gian sống', 'residence'),
                LivingSpaceTab::fields()
            )
            ->add_tab(
                esc_html__('Đầu tư + vận hành.', 'residence'),
                OperatorTab::fields()
            )
            ->add_tab(
                esc_html__('Dịch vụ bao gồm', 'residence'),
                IncludedServicesTab::fields()
            );
    }
}