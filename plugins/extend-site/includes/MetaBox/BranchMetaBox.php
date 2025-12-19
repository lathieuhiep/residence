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

    // Tab banner constants
    private const TAB_BANNER = self::PREFIX_MB . 'tab_banner_';
    private const TAB_BANNER_IMAGE_DESKTOP = self::TAB_BANNER . 'image_desktop';
    private const TAB_BANNER_IMAGE_MOBILE = self::TAB_BANNER . 'image_mobile';

    // Tab about constants
    private const TAB_ABOUT = self::PREFIX_MB . 'tab_about_';
    private const TAB_ABOUT_HEADING = self::TAB_ABOUT . 'heading';
    private const TAB_ABOUT_DESC = self::TAB_ABOUT . 'desc';
    private const TAB_ABOUT_IMAGE = self::TAB_ABOUT . 'image';

    // Tab room constants
    private const TAB_ROOMS = self::PREFIX_MB . 'tab_rooms';
    private const TAB_LOCATION = self::PREFIX_MB . 'tab_location';

    // Tab map constants
    private const TAB_MAP = self::PREFIX_MB . 'tab_map_';
    private const TAB_MAP_ADDRESS = self::TAB_MAP . 'address';
    private const TAB_MAP_LAT = self::TAB_MAP . 'lat';
    private const TAB_MAP_LNG = self::TAB_MAP . 'lng';
    private const TAB_MAP_ZOOM = self::TAB_MAP . 'zoom';

    // Tab more info constants
    private const TAB_MORE_INFO = self::PREFIX_MB . 'tab_more_info_';
    private const TAB_MORE_INFO_NUMBER_OF_APARTMENTS = self::TAB_MORE_INFO . 'number_of_apartments';

    // Boot method
    public static function boot(): void
    {
        add_action('carbon_fields_register_fields', [self::class, 'register']);
    }

    // Register meta boxes
    public static function register(): void
    {
        /** Main metabox */
        Container::make('post_meta', esc_html__('Thông tin chi nhánh', 'extend-site'))
            ->where('post_type', '=', BranchPostType::SLUG)
            ->add_tab(esc_html__('Banner', 'extend-site'), [
                Field::make('image', self::TAB_BANNER_IMAGE_DESKTOP, esc_html__('Ảnh Desktop', 'extend-site'))
                    ->set_help_text(
                        esc_html__('Kích thước đề xuất: 1920x600px', 'extend-site')
                    ),
                Field::make('image', self::TAB_BANNER_IMAGE_MOBILE, esc_html__('Ảnh Mobile', 'extend-site'))
                    ->set_help_text(
                        esc_html__('Kích thước đề xuất: 768x600px', 'extend-site')
                    ),
            ])
            ->add_tab(esc_html__('Giới thiệu', 'extend-site'), [
                Field::make('text', self::TAB_ABOUT_HEADING, esc_html__('Tiêu đề', 'extend-site')),
                Field::make('textarea', self::TAB_ABOUT_DESC, esc_html__('Mô tả', 'extend-site')),
                Field::make('image', self::TAB_ABOUT_IMAGE, esc_html__('Ảnh', 'extend-site')),
            ])
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

                        Field::make('complex', 'detail', esc_html__('Detail', 'extend-site'))
                            ->set_layout('tabbed-vertical')
                            ->set_collapsed(true)
                            ->add_fields([
                                Field::make('text', 'text', esc_html__('Nội dung', 'extend-site')),
                            ])->set_header_template(esc_html__('Mô tả', 'extend-site') . ' <%- $_index + 1 %>'),

                        /* =====================
                         * GALLERY DESKTOP
                         * ===================== */
                        Field::make(
                            'separator',
                            'sep_gallery',
                            esc_html__('Gallery', 'extend-site')
                        ),

                        Field::make(
                            'media_gallery',
                            'gallery',
                            esc_html__('Ảnh', 'extend-site')
                        )->set_type( 'image' ),
                    ])
                    ->set_header_template( '
                        <% if (title) { %>
                            <%- title %>
                        <% } %>
                    ' ),
            ])
            ->add_tab(esc_html__('Vị trí', 'extend-site'), [
                Field::make( 'complex', self::TAB_LOCATION, esc_html__('Danh sách vị trí (dùng chung cho loại phòng)', 'extend-site') )
                    ->set_layout('tabbed-vertical')
                    ->set_collapsed(true)
                    ->add_fields( array(
                        Field::make('text', 'text', esc_html__('Nội dung', 'extend-site')),
                    ) )->set_header_template(esc_html__('Mô tả', 'extend-site') . ' <%- $_index + 1 %>'),
            ])
            ->add_tab(esc_html__('Vị trí chi nhánh', 'extend-site'), [
                // Address
                Field::make('text', self::TAB_MAP_ADDRESS, esc_html__('Địa chỉ chi nhánh', 'extend-site'))
                    ->set_attribute('placeholder', '25 Phố Huế'),

                // Latitude
                Field::make('text', self::TAB_MAP_LAT, esc_html__('Latitude (Vĩ độ)', 'extend-site'))
                    ->set_attribute('placeholder', '21.01781')
                    ->set_help_text(
                        esc_html__(
                            'Cách lấy tọa độ: Mở Google Maps → tìm địa chỉ → chuột phải vào vị trí → sẽ hiện tọa độ" → copy số đứng trước (ví dụ: 21.01781).',
                            'extend-site'
                        )
                    )
                    ->set_width(33),

                // Longitude
                Field::make('text', self::TAB_MAP_LNG, __('Longitude (Kinh độ)', 'extend-site'))
                    ->set_attribute('placeholder', '105.85293')
                    ->set_help_text(
                        esc_html__(
                            'Dán số đứng sau trong tọa độ Google Maps (ví dụ: 105.85293).',
                            'extend-site'
                        )
                    )
                    ->set_width(33),

                // Zoom
                Field::make('text', self::TAB_MAP_ZOOM, esc_html__('Zoom', 'extend-site'))
                    ->set_attribute('type', 'number')
                    ->set_attribute('min', 1)
                    ->set_attribute('max', 19)
                    ->set_attribute('step', 1)
                    ->set_default_value(10)
                    ->set_help_text(esc_html__('Mức zoom bản đồ (1–19). Thường dùng: 15–17.', 'extend-site'))
                    ->set_width(33),
            ])
            ->add_tab(esc_html__('Thông tin thêm', 'extend-site'), [
                Field::make(
                    'text',
                    self::TAB_MORE_INFO_NUMBER_OF_APARTMENTS,
                    esc_html__('Số lượng căn hộ', 'extend-site')
                )
                    ->set_attribute('placeholder', '10')
                    ->set_default_value(1)
                    ->set_attribute('type', 'number')
                    ->set_attribute('min', 1)
                    ->set_attribute('step', 1)
                    ->set_width(50),
            ]);
    }

    /* =======================
     * GETTERS
     * ======================= */

    /*
     * Get Banner Images
     * */
    public function get_post_meta_banner_images(int $post_id): array
    {
        return [
            'desktop' => (int) self::get_option_post_meta($post_id, self::TAB_BANNER_IMAGE_DESKTOP),
            'mobile' => (int) self::get_option_post_meta($post_id, self::TAB_BANNER_IMAGE_MOBILE),
        ];
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
                'detail' => ESHelpers::normalize_text_list($room['detail'] ?? []),
                'gallery' => array_map('intval', $room['gallery'] ?? []),
            ];
        }

        return $data;
    }

    /**
     * Get location data
     */
    public function get_post_meta_location(int $post_id): array
    {
        $locations = (array) self::get_option_post_meta($post_id, self::TAB_LOCATION);

        if (empty($locations)) {
            return [];
        }

        return ESHelpers::normalize_text_list($locations);
    }

    /**
     * Get map data
     */
    public function get_post_meta_map(int $post_id): array
    {
        return [
            'address' => self::get_option_post_meta($post_id, self::TAB_MAP_ADDRESS) ?? '',
            'lat' => self::get_option_post_meta($post_id, self::TAB_MAP_LAT) ?? '',
            'lng' => self::get_option_post_meta($post_id, self::TAB_MAP_LNG) ?? '',
            'zoom' => self::get_option_post_meta($post_id, self::TAB_MAP_ZOOM) ?? 10,
        ];
    }

    /**
     * Get more info data
     */
    public function get_post_meta_more_info(int $post_id): array
    {
        return [
            'number_of_apartments' => (int) self::get_option_post_meta($post_id, self::TAB_MORE_INFO_NUMBER_OF_APARTMENTS) ?? 1,
        ];
    }
}