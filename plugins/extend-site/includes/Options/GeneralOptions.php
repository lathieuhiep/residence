<?php
/**
 * General Options
 *
 * @package ExtendSite
 */

namespace ExtendSite\Options;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

class GeneralOptions extends OptionBase
{

    // key options
    private const LOGO = 'es_opt_logo';
    private const ENABLE_LOADING = 'es_opt_enable_loading';
    private const LOADING_IMAGE = 'es_opt_loading_image';
    private const BACK_TO_TOP = 'es_opt_back_to_top';

    // option fields
    public static function fields(): array
    {
        return [
            // Logo & Branding
            Field::make('image', self::LOGO, esc_html__('Logo', 'extend-site'))
                ->set_value_type('id')
                ->set_help_text('Select your logo'),
        ];
    }

    // get logo
    public function get_logo_id($default = null)
    {
        $id = self::get(self::LOGO);

        return $id ?: $default;
    }
}
