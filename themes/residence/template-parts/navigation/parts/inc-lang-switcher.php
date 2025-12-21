<?php
if (function_exists('pll_the_languages')) :

    $languages = pll_the_languages(array(
        'raw' => true,
        'hide_if_empty' => false,
        'show_flags' => 1,
        'show_names' => 1
    ));

    if ( !empty($languages) ) :
        $current_lang = null;

        foreach ($languages as $lang) {
            if ($lang['current_lang']) {
                $current_lang = $lang;
                break;
            }
        }
?>
    <div class="header__lang">
        <div class="select-lang">
            <p class="select-lang__label"><?php echo esc_html( $current_lang['slug'] ); ?></p>

            <ul class="select-lang__list">
                <?php foreach ($languages as $lang) : ?>
                    <li>
                        <a href="<?php echo esc_url($lang['url']); ?>"
                           class="<?php echo $lang['current_lang'] ? 'current' : ''; ?>">
                            <?php echo esc_html(strtoupper($lang['slug'])); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php
    endif;
endif;
