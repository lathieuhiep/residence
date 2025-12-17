<div class="menuMobile d-xl-none onePageNav">
    <div class="menuMobile__bg"></div>
    <div class="menuMobile__inner">
        <div class="menuMobile__nav">
            <?php
            if ( has_nav_menu('main_menu_device') ) :
                wp_nav_menu([
                    'theme_location' => 'main_menu_device',
                    'container' => false,
                    'menu_class' => 'menu-list',
                ]);
            else:
                ?>
                <ul class="menu-list">
                    <li class="menu-item active">
                        <a href="<?php echo esc_url(get_admin_url() . '/nav-menus.php'); ?>">
                            <?php esc_html_e('Thêm Menu', 'residence'); ?>
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>