<?php
add_filter('nav_menu_css_class', function ($classes) {
    if (in_array('menu-item-has-children', $classes, true)) {
        $classes[] = 'menu-has-children';
    }
    return $classes;
});


add_filter('nav_menu_submenu_css_class', function ($classes) {
    return ['submenu'];
});