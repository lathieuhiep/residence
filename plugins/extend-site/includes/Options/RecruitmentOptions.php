<?php
/**
 * Recruitment Options
 *
 * @package ExtendSite
 */

namespace ExtendSite\Options;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

class RecruitmentOptions extends OptionBase
{
    // Key prefix
    private const PREFIX_RECRUITMENT = 'es_opt_recruitment_';
    private const OPT_IMAGE_1 = self::PREFIX_RECRUITMENT . 'image_1';
    private const OPT_IMAGE_2 = self::PREFIX_RECRUITMENT . 'image_2';
    private const OPT_IMAGE_3 = self::PREFIX_RECRUITMENT . 'image_3';

    // Option fields
    public static function fields(): array
    {
        return [
            Field::make( 'image', self::OPT_IMAGE_1, esc_html__( 'Ảnh tuyển dụng 1', 'extend-site' ) ),
            Field::make( 'image', self::OPT_IMAGE_2, esc_html__( 'Ảnh tuyển dụng 2', 'extend-site' ) ),
            Field::make( 'image', self::OPT_IMAGE_3, esc_html__( 'Ảnh tuyển dụng 3', 'extend-site' ) ),
        ];
    }

    // Get all recruitment images
    public function get_opt_recruitment_images(): array
    {
        return array_values(
            array_filter(
                [
                    self::get(self::OPT_IMAGE_1),
                    self::get(self::OPT_IMAGE_2),
                    self::get(self::OPT_IMAGE_3),
                ],
                fn( $id ) => is_numeric( $id ) && (int) $id > 0
            )
        );
    }
}