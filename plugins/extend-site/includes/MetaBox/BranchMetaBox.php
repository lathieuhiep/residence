<?php
namespace ExtendSite\MetaBox;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use ExtendSite\PostType\BranchPostType;

defined('ABSPATH') || exit;

class BranchMetaBox
{
    // Key prefix
    private const PREFIX_MB = 'es_mb_branch_';

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
        Container::make( 'post_meta', esc_html__( 'Thông tin chi nhánh', 'extend-site' ) )
            ->where( 'post_type', '=', BranchPostType::SLUG )
            ->add_tab( esc_html__( 'Giới thiệu', 'extend-site' ), array(
                Field::make( 'text', self::TAB_ABOUT_HEADING, esc_html__( 'Tiêu đề', 'extend-site' ) ),
                Field::make( 'textarea', self::TAB_ABOUT_DESC, esc_html__( 'Mô tả', 'extend-site' ) ),
                Field::make( 'image', self::TAB_ABOUT_IMAGE, esc_html__( 'Ảnh', 'extend-site' ) ),
            ) )
            ->add_tab( esc_html__( 'Notification' ), array(
                Field::make( 'text', 'crb_email', esc_html__( 'Notification Email' ) ),
                Field::make( 'text', 'crb_phone', esc_html__( 'Phone Number' ) ),
            ) );
    }
}