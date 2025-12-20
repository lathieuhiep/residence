<?php
namespace ExtendSite\Options;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

class ContactOptions extends OptionBase
{
    // prefix
    private const PREFIX = 'es_opt_contact_';
    private const HOTLINE = self::PREFIX . 'hotline';
    private const EMAIL = self::PREFIX . 'email';
    private const SOCIAL_LINKS = self::PREFIX . 'social_links';

    // option fields
    public static function fields(): array
    {
        return [
            Field::make('text', self::HOTLINE, esc_html__('Hotline', 'extend-site')),
            Field::make('text', self::EMAIL, esc_html__('Email', 'extend-site')),

            // social links
            Field::make(
                'complex',
                self::SOCIAL_LINKS,
                esc_html__( 'Mạng xã hội', 'extend-site' )
            )
                ->set_layout( 'tabbed-horizontal' )
                ->set_collapsed( true )
                ->add_fields( [
                    Field::make(
                        'text',
                        'label',
                        esc_html__( 'Tên mạng xã hội', 'extend-site' )
                    )->set_help_text( esc_html__( 'Ví dụ: FACEBOOK, INSTAGRAM', 'extend-site' ) ),

                    Field::make(
                        'text',
                        'url',
                        esc_html__( 'Link', 'extend-site' )
                    )
                        ->set_attribute( 'type', 'url' )
                        ->set_help_text( esc_html__( 'https://...', 'extend-site' ) ),
                ] )
                ->set_header_template( '
                    <% if (label) { %>
                        <%- label %>
                    <% } %>
                ' ),
        ];
    }

    // get contact phone
    public function get_otp_contact_phone(): ?string
    {
        return self::get(self::HOTLINE);
    }

    // get contact email
    public function get_opt_contact_email(): ?string
    {
        return self::get(self::EMAIL);
    }

    // get social links
    public function get_opt_contact_social_links( array $default = [] ): array
    {
        $items = self::get( self::SOCIAL_LINKS );

        if ( empty( $items ) || ! is_array( $items ) ) {
            return $default;
        }

        return array_values(
            array_filter(
                $items,
                fn ( $item ) =>
                    ! empty( $item['label'] ) &&
                    ! empty( $item['url'] )
            )
        );
    }
}