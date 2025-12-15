<?php
if (has_nav_menu('main_menu')) :
    wp_nav_menu(array(
        'theme_location' => 'main_menu',
        'container_class' => 'header__nav',
        'menu_class' => 'menu-list',
    ));
else:
    ?>
    <div class="header__nav">
        <ul class="menu-list">
            <li class="menu-item active">
                <a href="<?php echo esc_url(get_admin_url() . '/nav-menus.php'); ?>">
                    <?php esc_html_e('Thêm Menu', 'residence'); ?>
                </a>
            </li>
        </ul>
    </div>
<?php
endif;