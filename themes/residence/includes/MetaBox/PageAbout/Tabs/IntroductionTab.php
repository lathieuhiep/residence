<?php

namespace ResidenceTheme\MetaBox\PageAbout\Tabs;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

final class IntroductionTab
{
    private const TAB_INTRODUCTION = 'page_about_tab_introduction_';
    private const KEY_TITLE_LINE_1 = self::TAB_INTRODUCTION . 'title_line_1';
    private const KEY_TITLE_LINE_2 = self::TAB_INTRODUCTION . 'title_line_2';
    private const KEY_GALLERY = self::TAB_INTRODUCTION . 'gallery';
    private const KEY_DESCRIPTION = self::TAB_INTRODUCTION . 'description';

    /**
     * Fields definition
     */
    public static function fields(): array
    {
        return [
            Field::make('text', self::KEY_TITLE_LINE_1, esc_html__('Tiêu đề dòng 1', 'extend-site'))
                ->set_width(50),

            Field::make('text', self::KEY_TITLE_LINE_2, esc_html__('Tiêu đề dòng 2', 'extend-site'))
                ->set_width(50),

            Field::make('media_gallery', self::KEY_GALLERY, esc_html__('Gallery', 'extend-site'))
                ->set_help_text(esc_html__('Upload images for slider', 'extend-site')),

            Field::make('textarea', self::KEY_DESCRIPTION, esc_html__('Mô tả', 'extend-site'))
                ->set_rows(6),
        ];
    }

    /**
     * Get config for view
     */
    public static function get(int $post_id): array
    {
        return [
            'title_line_1' => carbon_get_post_meta($post_id, self::KEY_TITLE_LINE_1),
            'title_line_2' => carbon_get_post_meta($post_id, self::KEY_TITLE_LINE_2),
            'gallery'      => (array) carbon_get_post_meta($post_id, self::KEY_GALLERY),
            'description'  => carbon_get_post_meta($post_id, self::KEY_DESCRIPTION),
        ];
    }
}