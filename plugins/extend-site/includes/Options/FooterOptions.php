<?php

namespace ExtendSite\Options;

use Carbon_Fields\Field;
use ExtendSite\Constants\Breakpoints;

defined('ABSPATH') || exit;

class FooterOptions extends OptionBase
{

    // Key prefix
    private const PREFIX = 'es_opt_footer_';
    private const LOGO = self::PREFIX . 'logo';
    private const BRAND_GALLERY = self::PREFIX . 'brand_gallery';
    private const ADDRESS_COLUMNS = self::PREFIX . 'address_columns';

        // fields
    public static function fields(): array
    {
        return [
            // Logo & Branding
            Field::make('image', self::LOGO, esc_html__('Logo', 'extend-site'))
                ->set_value_type('id'),

            // brand media gallery
            Field::make( 'media_gallery', self::BRAND_GALLERY, esc_html__( 'Brand gallery', 'extend-site' ) ),

            // Footer address columns
            Field::make(
                'complex',
                self::ADDRESS_COLUMNS,
                esc_html__( 'Danh sách địa chỉ (Footer)', 'extend-site' )
            )
                ->set_layout( 'tabbed-horizontal' )
                ->set_max( 2 )
                ->add_fields( [
                    Field::make(
                        'complex',
                        'addresses',
                        esc_html__( 'Danh sách địa chỉ', 'extend-site' )
                    )
                        ->set_layout( 'tabbed-vertical' )
                        ->set_collapsed( true )
                        ->add_fields( [
                            Field::make(
                                'text',
                                'text',
                                esc_html__( 'Địa chỉ', 'extend-site' )
                            )
                                ->set_width( 100 ),
                        ] )
                        ->set_header_template( '
                            <% if (text) { %>
                                <%- text %>
                            <% } %>
                        ' ),
                ] )
                ->set_help_text(
                    esc_html__( 'Mỗi block tương ứng một cột. Mỗi dòng là một địa chỉ.', 'extend-site' )
                )
                ->set_header_template(esc_html__('Danh sách địa chỉ cột', 'extend-site') . ' <%- $_index + 1 %>'),
        ];
    }

    /* =======================
    * GETTERS
    * ======================= */

    // get logo
    public function get_opt_footer_logo($default = null)
    {
        $id = self::get(self::LOGO);

        return $id ?: $default;
    }

    // get brand gallery
    public function get_opt_footer_brand_gallery( $default = [] )
    {
        $gallery = self::get(self::BRAND_GALLERY);

        return !empty($gallery) ? $gallery : $default;
    }

    // get address columns
    public function get_opt_footer_address_columns( array $default = [] ): array
    {
        $columns = self::get( self::ADDRESS_COLUMNS );

        if ( empty( $columns ) || ! is_array( $columns ) ) {
            return $default;
        }

        // Sanitize dữ liệu con
        $columns = array_values( array_filter( $columns, function ( $column ) {
            return ! empty( $column['addresses'] ) && is_array( $column['addresses'] );
        } ) );

        foreach ( $columns as &$column ) {
            $column['addresses'] = array_values( array_filter(
                $column['addresses'],
                fn ( $row ) => ! empty( $row['text'] )
            ) );
        }
        unset( $column );

        return ! empty( $columns ) ? $columns : $default;
    }
}
