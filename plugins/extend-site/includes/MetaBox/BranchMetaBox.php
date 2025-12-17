<?php

namespace ExtendSite\MetaBox;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
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

    // Tab notification constants
    private const TAB_NOTIFICATION = self::PREFIX_MB . 'tab_notification';

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
            ->add_tab(esc_html__('Notification'), array(
                Field::make('text', 'crb_email', esc_html__('Notification Email')),
                Field::make('text', 'crb_phone', esc_html__('Phone Number')),
            ));
    }

    /* =======================
     * GETTERS
     * ======================= */

    /*
    * Get Mobile Image
     * */
    public function get_post_meta_mobile_image(int $post_id): string
    {
        return self::get_option_post_meta($post_id, self::PREFIX_MB . 'mobile_image');
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
}