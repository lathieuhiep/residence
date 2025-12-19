<?php

namespace ResidenceTheme\MetaBox\PageHome\Tabs;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

final class AboutTab
{
    public const KEY_TITLE   = 'home_about_title';
    public const KEY_CONTENT = 'home_about_content';

    /**
     * Fields definition
     */
    public static function fields(): array
    {
        return [
            Field::make('text', self::KEY_TITLE, esc_html__('Tiêu để', 'residence-theme')),
            Field::make('rich_text', self::KEY_CONTENT, esc_html__('Nội dung', 'residence-theme')),
        ];
    }

    /**
     * Get data
     */
    public static function get(int $post_id): array
    {
        return [
            'title'   => carbon_get_post_meta($post_id, self::KEY_TITLE),
            'content' => carbon_get_post_meta($post_id, self::KEY_CONTENT),
        ];
    }
}
