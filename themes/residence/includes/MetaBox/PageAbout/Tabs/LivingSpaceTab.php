<?php

namespace ResidenceTheme\MetaBox\PageAbout\Tabs;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

final class LivingSpaceTab
{
    private const TAB = 'page_about_tab_living_space_';

    private const KEY_TITLE       = self::TAB . 'title';
    private const KEY_DESCRIPTION = self::TAB . 'description';
    private const KEY_IMAGE_MAIN  = self::TAB . 'image_main';
    private const KEY_IMAGE_SUB   = self::TAB . 'image_sub';

    /**
     * Fields definition
     */
    public static function fields(): array
    {
        return [
            Field::make('text', self::KEY_TITLE, esc_html__('Tiêu đề', 'extend-site')),

            Field::make('textarea', self::KEY_DESCRIPTION, esc_html__('Mô tả', 'extend-site'))
                ->set_rows(4),

            Field::make('image', self::KEY_IMAGE_MAIN, esc_html__('Hình ảnh cao', 'extend-site'))
                ->set_help_text(esc_html__('Ảnh bên phải (desktop)', 'extend-site')),

            Field::make('image', self::KEY_IMAGE_SUB, esc_html__('Hình ảnh rộng', 'extend-site'))
                ->set_help_text(esc_html__('Ảnh bên trái', 'extend-site')),
        ];
    }

    /**
     * Get config for view
     */
    public static function get(int $post_id): array
    {
        return [
            'title'       => carbon_get_post_meta($post_id, self::KEY_TITLE),
            'description' => carbon_get_post_meta($post_id, self::KEY_DESCRIPTION),
            'image_main'  => carbon_get_post_meta($post_id, self::KEY_IMAGE_MAIN),
            'image_sub'   => carbon_get_post_meta($post_id, self::KEY_IMAGE_SUB),
        ];
    }
}
