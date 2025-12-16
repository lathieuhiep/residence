<header class="header">
    <div class="header__wrap">
        <div class="container">
            <div class="header__content onePageNav">
                <div class="header__nav style-left">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'main_menu_left',
                        'container' => false,
                        'menu_class' => 'menu-list',
                    ]);
                    ?>
                </div>

                <div class="header__logo">
                    <a href="<?php echo esc_url(home_url()) ?>"><img
                                src="<?php echo esc_url(get_theme_file_uri('/assets/images/logo.png')) ?>" alt=""></a>
                </div>

                <div class="header__nav style-right">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'main_menu_right',
                        'container' => false,
                        'menu_class' => 'menu-list',
                    ]);
                    ?>
                </div>

                <div class="header__right">
                    <div class="header__lang">
                        <div class="select-lang">
                            <p class="select-lang__label">VIE</p>
                            <ul class="select-lang__list">
                                <li><a href="#" class="current">VIE</a></li>
                                <li><a href="#">ENG</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="header__humberger d-xl-none">
                        <span class="t-1"></span>
                        <span class="t-2"></span>
                        <span class="t-3"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header__fixHeight"></div>
</header>