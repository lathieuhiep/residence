<?php

namespace ExtendSite\PostType;

defined('ABSPATH') || exit;

class BranchPostType extends BasePostType
{
    // Slug của Custom Post Type
    public const SLUG = 'branch';
    public const SINGULAR = 'chi nhánh';
    public const PLURAL = 'Chi nhánh';

    // name file template
//    public const TEMPLATE_SINGLE = 'branch/single-branch.php';

    // create constructor
    public function __construct(array $args = [])
    {
        $args = [
            'rewrite' => [
                'slug' => 'chi-nhanh',
                'with_front' => false
            ],
            'menu_icon' => 'dashicons-location',
        ];

        parent::__construct($args);
    }
}