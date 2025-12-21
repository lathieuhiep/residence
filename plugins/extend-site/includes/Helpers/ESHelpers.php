<?php
namespace ExtendSite\Helpers;

defined('ABSPATH') || exit;

class ESHelpers
{
    /**
     * Normalize list of text items from Carbon Fields complex field
     *
     * @param array $items
     * @return array
     */
    public static function normalize_text_list(array $items): array
    {
        $result = [];

        foreach ($items as $item) {
            if (!empty($item['text'])) {
                $result[] = $item['text'];
            }
        }

        return $result;
    }
}