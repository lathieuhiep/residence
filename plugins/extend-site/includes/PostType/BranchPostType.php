<?php

namespace ExtendSite\PostType;

defined('ABSPATH') || exit;

class BranchPostType extends BasePostType
{
    // Slug của Custom Post Type
    public const SLUG = 'branch';
    public const SINGULAR = 'chi nhánh';
    public const PLURAL = 'Chi nhánh';

    // create constructor
    public function __construct(array $args = [])
    {
        $args = array_replace_recursive([
            'rewrite' => [
                'slug' => 'chi-nhanh',
                'with_front' => false
            ],
            'supports' => ['title', 'editor', 'author'],
            'menu_icon' => 'dashicons-location',
        ], $args);

        parent::__construct($args);
    }
}