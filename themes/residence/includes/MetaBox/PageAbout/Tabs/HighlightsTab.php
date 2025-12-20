<?php

namespace ResidenceTheme\MetaBox\PageAbout\Tabs;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

final class HighlightsTab
{
    private const TAB = 'page_about_tab_highlights_';

    // Block 1 – Location
    private const KEY_LOC_TITLE       = self::TAB . 'location_title';
    private const KEY_LOC_DESCRIPTION = self::TAB . 'location_description';
    private const KEY_LOC_IMAGE       = self::TAB . 'location_image';

    // Block 2 – Service
    private const KEY_SER_TITLE       = self::TAB . 'service_title';
    private const KEY_SER_DESCRIPTION = self::TAB . 'service_description';
    private const KEY_SER_IMAGE_1     = self::TAB . 'service_image_1';
    private const KEY_SER_IMAGE_2     = self::TAB . 'service_image_2';
    private const KEY_SER_IMAGE_3     = self::TAB . 'service_image_3';

    /**
     * Fields definition
     */
    public static function fields(): array
    {
        return [

            // ===== Location =====
            Field::make('separator', self::TAB . 'sep_location', esc_html__('Vị trí', 'extend-site')),

            Field::make('text', self::KEY_LOC_TITLE, esc_html__('Tiêu đề', 'extend-site')),

            Field::make('textarea', self::KEY_LOC_DESCRIPTION, esc_html__('Mô tả', 'extend-site'))
                ->set_rows(5),

            Field::make('image', self::KEY_LOC_IMAGE, esc_html__('Hình ảnh', 'extend-site')),

            // ===== Service =====
            Field::make('separator', self::TAB . 'sep_service', esc_html__('Dịch vụ', 'extend-site')),

            Field::make('text', self::KEY_SER_TITLE, esc_html__('Tiêu đề', 'extend-site')),

            Field::make('textarea', self::KEY_SER_DESCRIPTION, esc_html__('Mô tả', 'extend-site'))
                ->set_rows(5),

            Field::make('image', self::KEY_SER_IMAGE_1, esc_html__('Hình ảnh 1', 'extend-site')),
            Field::make('image', self::KEY_SER_IMAGE_2, esc_html__('Hình ảnh 2', 'extend-site')),
            Field::make('image', self::KEY_SER_IMAGE_3, esc_html__('Hình ảnh 3', 'extend-site')),
        ];
    }

    /**
     * Get config for view
     */
    public static function get(int $post_id): array
    {
        return [
            'location' => [
                'title'       => carbon_get_post_meta($post_id, self::KEY_LOC_TITLE),
                'description' => carbon_get_post_meta($post_id, self::KEY_LOC_DESCRIPTION),
                'image'       => carbon_get_post_meta($post_id, self::KEY_LOC_IMAGE),
            ],

            'service' => [
                'title'       => carbon_get_post_meta($post_id, self::KEY_SER_TITLE),
                'description' => carbon_get_post_meta($post_id, self::KEY_SER_DESCRIPTION),
                'image_1'     => carbon_get_post_meta($post_id, self::KEY_SER_IMAGE_1),
                'image_2'     => carbon_get_post_meta($post_id, self::KEY_SER_IMAGE_2),
                'image_3'     => carbon_get_post_meta($post_id, self::KEY_SER_IMAGE_3),
            ],
        ];
    }
}