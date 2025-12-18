<?php

namespace ExtendSite\MetaBox;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use ExtendSite\Helpers\ESHelpers;
use ExtendSite\PostType\BranchPostType;

defined('ABSPATH') || exit;

class BranchMetaBox extends OptionPostMetaBase
{
    // Key prefix
    private const PREFIX_MB = 'es_mb_branch_';

    // Mobile image (sidebar)
    private const MOBILE_IMAGE = self::PREFIX_MB . 'mobile_image';

    // Tab about constants
    private const TAB_ABOUT = self::PREFIX_MB . 'tab_about_';
    private const TAB_ABOUT_HEADING = self::TAB_ABOUT . 'heading';
    private const TAB_ABOUT_DESC = self::TAB_ABOUT . 'desc';
    private const TAB_ABOUT_IMAGE = self::TAB_ABOUT . 'image';

    // Tab room constants
    private const TAB_ROOMS = self::PREFIX_MB . 'tab_rooms';

    // Boot method
    public static function boot(): void
    {
        add_action('carbon_fields_register_fields', [self::class, 'register']);
    }

    // Register meta boxes
    public static function register(): void
    {
        /**
         * Sidebar metabox
         */
        Container::make('post_meta', esc_html__('Ảnh Mobile', 'extend-site'))
            ->where('post_type', '=', BranchPostType::SLUG)
            ->set_context('side')
            ->set_priority('low')
            ->add_fields([
                Field::make('image', self::MOBILE_IMAGE, esc_html__('Ảnh hiển thị Mobile', 'extend-site'))
                    ->set_help_text(
                        esc_html__('Dùng cho màn hình mobile. Nếu không chọn sẽ fallback ảnh đại diện.', 'extend-site')
                    ),
            ]);

        /** Main metabox */
        Container::make('post_meta', esc_html__('Thông tin chi nhánh', 'extend-site'))
            ->where('post_type', '=', BranchPostType::SLUG)
            ->add_tab(esc_html__('Giới thiệu', 'extend-site'), array(
                Field::make('text', self::TAB_ABOUT_HEADING, esc_html__('Tiêu đề', 'extend-site')),
                Field::make('textarea', self::TAB_ABOUT_DESC, esc_html__('Mô tả', 'extend-site')),
                Field::make('image', self::TAB_ABOUT_IMAGE, esc_html__('Ảnh', 'extend-site')),
            ))
            ->add_tab(esc_html__('Loại phòng', 'extend-site'), [
                Field::make(
                    'complex',
                    self::TAB_ROOMS,
                    esc_html__('Danh sách loại phòng', 'extend-site')
                )
                    ->set_layout('tabbed-horizontal')
                    ->set_collapsed(true)
                    ->add_fields([

                        /* =====================
                         * BASIC
                         * ===================== */
                        Field::make('text', 'title', esc_html__('Tên loại phòng', 'extend-site'))
                            ->set_required(true)
                            ->set_help_text(
                                esc_html__('VD: Căn hộ studio, Căn hộ 2 phòng ngủ', 'extend-site')
                            ),

                        /* =====================
                         * ROOM INFO
                         * ===================== */
                        Field::make('separator', 'sep_info', esc_html__('Thông tin phòng', 'extend-site')),

                        Field::make('text', 'capacity', esc_html__('Capacity', 'extend-site'))
                            ->set_help_text('VD: 1 - 3 person'),

                        Field::make('text', 'area', esc_html__('Area', 'extend-site'))
                            ->set_help_text('VD: 138m²'),

                        Field::make('complex', 'location', esc_html__('Location', 'extend-site'))
                            ->set_layout('tabbed-vertical')
                            ->set_collapsed(true)
                            ->add_fields([
                                Field::make('text', 'text', esc_html__('Nội dung', 'extend-site')),
                            ]),

                        Field::make('complex', 'detail', esc_html__('Detail', 'extend-site'))
                            ->set_layout('tabbed-vertical')
                            ->set_collapsed(true)
                            ->add_fields([
                                Field::make('text', 'text', esc_html__('Nội dung', 'extend-site')),
                            ]),

                        /* =====================
                         * GALLERY DESKTOP
                         * ===================== */
                        Field::make(
                            'separator',
                            'sep_gallery_desktop',
                            esc_html__('Gallery Desktop', 'extend-site')
                        ),

                        Field::make(
                            'media_gallery',
                            'gallery_desktop',
                            esc_html__('Ảnh desktop', 'extend-site')
                        ),

                        /* =====================
                         * GALLERY MOBILE
                         * ===================== */
                        Field::make(
                            'separator',
                            'sep_gallery_mobile',
                            esc_html__('Gallery Mobile', 'extend-site')
                        ),

                        Field::make(
                            'media_gallery',
                            'gallery_mobile',
                            esc_html__('Ảnh mobile', 'extend-site')
                        ),
                    ]),
            ]);
    }

    /* =======================
     * GETTERS
     * ======================= */

    /*
    * Get Mobile Image
     * */
    public function get_post_meta_mobile_image(int $post_id): int
    {
        return (int) self::get_option_post_meta($post_id, self::MOBILE_IMAGE);
    }

    /*
     * Get About data
     * */
    public function get_post_meta_about(int $post_id): array
    {
        return [
            'heading' => self::get_option_post_meta($post_id, self::TAB_ABOUT_HEADING),
            'desc' => self::get_option_post_meta($post_id, self::TAB_ABOUT_DESC),
            'image' => self::get_option_post_meta($post_id, self::TAB_ABOUT_IMAGE),
        ];
    }

    /**
     * Get rooms data
     */
    public function get_post_meta_rooms(int $post_id): array
    {
        $rooms = (array) self::get_option_post_meta($post_id, self::TAB_ROOMS);

        if (empty($rooms)) {
            return [];
        }

        $data = [];

        foreach ($rooms as $room) {
            $data[] = [
                'title' => $room['title'] ?? '',
                'capacity' => $room['capacity'] ?? '',
                'area' => $room['area'] ?? '',
                'location' => ESHelpers::normalize_text_list($room['location'] ?? []),
                'detail' => ESHelpers::normalize_text_list($room['detail'] ?? []),
                'gallery_desktop' => array_map('intval', $room['gallery_desktop'] ?? []),
                'gallery_mobile'  => array_map('intval', $room['gallery_mobile'] ?? []),
                'has_gallery' => ! empty($room['gallery_desktop']) || ! empty($room['gallery_mobile']),
            ];
        }

        return $data;
    }
}