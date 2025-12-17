<?php

namespace ExtendSite\MetaBox;

defined('ABSPATH') || exit;

/**
 * Base class for all option modules
 */
abstract class OptionPostMetaBase
{
    /**
     * Wrapper get() to retrieve theme option values
     */
    protected function get_option_post_meta(int $id, string $key)
    {
        if (!function_exists('carbon_get_post_meta')) {
            return null;
        }

        $value = carbon_get_post_meta($id, $key);

        return ($value === null || $value === '') ? null : $value;
    }
}