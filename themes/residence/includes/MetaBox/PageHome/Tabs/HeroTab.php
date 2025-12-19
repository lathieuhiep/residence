<?php

namespace ResidenceTheme\MetaBox\PageHome\Tabs;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

final class HeroTab
{
    private const KEY_BG_PC = 'home_hero_bg_pc';
    private const KEY_BG_MB = 'home_hero_bg_mb';
    private const KEY_LOGO  = 'home_hero_logo';
    private const KEY_TEXT  = 'home_hero_text';

    /**
     * Fields definition
     */
    public static function fields(): array
    {
        return [
            Field::make('image', self::KEY_BG_PC, esc_html__('Ảnh Desktop', 'residence'))
                ->set_value_type('url'),

            Field::make('image', self::KEY_BG_MB, esc_html__('Ảnh Mobile', 'residence'))
                ->set_value_type('url'),

            Field::make('image', self::KEY_LOGO, esc_html__('Logo', 'residence'))
                ->set_help_text(
                    esc_html__('SVG or image logo in hero section', 'residence')
                )
                ->set_value_type('url'),

            Field::make('textarea', self::KEY_TEXT, esc_html__('Mô tả', 'residence'))
                ->set_rows(3)
                ->set_default_value(
                    esc_html__('Chuỗi căn hộ dịch vụ cao cấp cho khách hàng Nhật Bản', 'residence')
                ),
        ];
    }

    /**
     * Get data
     */
    public static function get(int $post_id): array
    {
        return [
            'bg_pc' => carbon_get_post_meta($post_id, self::KEY_BG_PC),
            'bg_mb' => carbon_get_post_meta($post_id, self::KEY_BG_MB),
            'logo'  => carbon_get_post_meta($post_id, self::KEY_LOGO),
            'text'  => carbon_get_post_meta($post_id, self::KEY_TEXT),
        ];
    }
}