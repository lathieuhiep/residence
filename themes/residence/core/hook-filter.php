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
