<?php

namespace ResidenceTheme\MetaBox\PageHome\Tabs;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

final class BranchTab
{
    private const KEY_TITLE = 'home_branch_title';
    private const KEY_ARCHIVE_URL = 'home_branch_archive_url';
    private const KEY_LIMIT = 'home_branch_limit';
    private const KEY_ORDERBY = 'home_branch_orderby';
    private const KEY_ORDER = 'home_branch_order';

    /**
     * Fields for Branch Slider tab
     */
    public static function fields(): array
    {
        return [
            Field::make(
                'text',
                self::KEY_TITLE,
                esc_html__('Tiêu đề', 'residence')
            )
                ->set_default_value(
                    esc_html__('Các Chi Nhánh', 'residence')
                ),

            Field::make(
                'text',
                self::KEY_ARCHIVE_URL,
                esc_html__('Url', 'residence')
            )
                ->set_help_text(
                    esc_html__('Nhập link điều hướng.', 'residence')
                ),

            Field::make(
                'text',
                self::KEY_LIMIT,
                esc_html__('Số chi nhánh hiển thị', 'residence')
            )
                ->set_default_value(10)
                ->set_attribute('type', 'number')
                ->set_attribute('min', 1)
                ->set_attribute('step', 1),

            Field::make(
                'select',
                self::KEY_ORDERBY,
                esc_html__('Sắp xếp theo', 'residence')
            )
                ->set_options([
                    'menu_order' => esc_html__('Menu order', 'residence'),
                    'ID' => esc_html__('Post ID', 'residence'),
                    'date' => esc_html__('Publish date', 'residence'),
                    'title' => esc_html__('Title', 'residence'),
                ])
                ->set_default_value('menu_order'),

            Field::make(
                'select',
                self::KEY_ORDER,
                esc_html__('Thứ tự sắp xếp', 'residence')
            )
                ->set_options([
                    'ASC' => esc_html__('Ascending', 'residence'),
                    'DESC' => esc_html__('Descending', 'residence'),
                ])
                ->set_default_value('ASC'),
        ];
    }

    /**
     * Get config for view
     */
    public static function get(int $post_id): array
    {
        return [
            'title' => carbon_get_post_meta($post_id, self::KEY_TITLE),
            'archive_url' => carbon_get_post_meta($post_id, self::KEY_ARCHIVE_URL),
            'limit' => (int)carbon_get_post_meta($post_id, self::KEY_LIMIT),
            'orderby' => carbon_get_post_meta($post_id, self::KEY_ORDERBY),
            'order' => carbon_get_post_meta($post_id, self::KEY_ORDER),
        ];
    }
}