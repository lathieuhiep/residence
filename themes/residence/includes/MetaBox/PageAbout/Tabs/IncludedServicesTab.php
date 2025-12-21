<?php

namespace ResidenceTheme\MetaBox\PageAbout\Tabs;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

final class IncludedServicesTab
{
    private const TAB = 'page_about_tab_included_services_';

    private const KEY_TITLE = self::TAB . 'title';
    private const KEY_IMAGE = self::TAB . 'image';
    private const KEY_LIST  = self::TAB . 'list';

    /**
     * Fields definition
     */
    public static function fields(): array
    {
        return [
            Field::make('text', self::KEY_TITLE, esc_html__('Tiêu đề', 'extend-site'))
                ->set_default_value('Dịch vụ trong giá thuê căn hộ'),

            Field::make('image', self::KEY_IMAGE, esc_html__('Hình ảnh', 'extend-site'))
                ->set_help_text(esc_html__('Ảnh minh họa bên trái', 'extend-site')),

            Field::make('complex', self::KEY_LIST, esc_html__('Danh sách dịch vụ', 'extend-site'))
                ->set_layout('tabbed-vertical')
                ->set_collapsed(true)
                ->add_fields([
                    Field::make('text', 'text', esc_html__('Nội dung', 'extend-site'))
                        ->set_width(100),
                ])
                ->set_header_template( '
                    <% if (text) { %>
                        <%- text %>
                    <% } %>
                ' ),
        ];
    }

    /**
     * Get config for view
     */
    public static function get(int $post_id): array
    {
        return [
            'title' => carbon_get_post_meta($post_id, self::KEY_TITLE),
            'image' => carbon_get_post_meta($post_id, self::KEY_IMAGE),
            'list'  => (array) carbon_get_post_meta($post_id, self::KEY_LIST),
        ];
    }
}