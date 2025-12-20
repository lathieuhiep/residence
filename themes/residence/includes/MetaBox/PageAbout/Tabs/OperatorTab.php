<?php

namespace ResidenceTheme\MetaBox\PageAbout\Tabs;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

final class OperatorTab
{
    private const TAB = 'page_about_tab_operator_';

    private const KEY_TITLE = self::TAB . 'title';
    private const KEY_DESCRIPTION = self::TAB . 'description';
    private const KEY_IMAGE = self::TAB . 'image';

    /**
     * Fields definition
     */
    public static function fields(): array
    {
        return [
            Field::make('text', self::KEY_TITLE, esc_html__('Tiêu đề', 'extend-site')),

            Field::make('textarea', self::KEY_DESCRIPTION, esc_html__('Nội dung', 'extend-site'))
                ->set_rows(5),

            Field::make('image', self::KEY_IMAGE, esc_html__('Hình ảnh', 'extend-site')),
        ];
    }

    /**
     * Get config for view
     */
    public static function get(int $post_id): array
    {
        return [
            'title' => carbon_get_post_meta($post_id, self::KEY_TITLE),
            'description' => carbon_get_post_meta($post_id, self::KEY_DESCRIPTION),
            'image' => carbon_get_post_meta($post_id, self::KEY_IMAGE),
        ];
    }
}