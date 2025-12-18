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
    private const ADDRESS = self::PREFIX . 'address';

    // option fields
    public static function fields(): array
    {
        return [
            Field::make('text', self::HOTLINE, esc_html__('Hotline', 'extend-site')),
            Field::make('text', self::EMAIL, esc_html__('Email', 'extend-site')),
            Field::make('textarea', self::ADDRESS, esc_html__('Address', 'extend-site')),
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

    // get contact address
    public function get_opt_contact_address(): ?string
    {
        return self::get(self::ADDRESS);
    }
}