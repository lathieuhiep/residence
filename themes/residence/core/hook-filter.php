<?php
// add class menu-has-children to li menu items that have children
add_filter('nav_menu_css_class', function ($classes, $item, $args) {

    if (
        empty($args->theme_location)
        || ! in_array($args->theme_location, ['main_menu_left', 'main_menu_right', 'main_menu_device'], true)
    ) {
        return $classes;
    }

    if (in_array('menu-item-has-children', $classes, true)) {
        $classes[] = 'menu-has-children';
    }

    return $classes;

}, 10, 3);

// add class submenu to ul sub menus
add_filter('nav_menu_submenu_css_class', function ($classes, $args, $depth) {

    if (
        empty($args->theme_location)
        || ! in_array($args->theme_location, ['main_menu_left', 'main_menu_right', 'main_menu_device'], true)
    ) {
        return $classes;
    }

    return ['submenu'];

}, 10, 3);

// Thêm class scroll-link cho các link có href bắt đầu bằng #
function residence_add_scroll_link_class($atts, $item, $args) {
    if (!empty($atts['href']) && str_starts_with($atts['href'], '#')) {
        $atts['class'] = isset($atts['class'])
            ? $atts['class'] . ' scroll-link'
            : 'scroll-link';
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'residence_add_scroll_link_class', 10, 3);
