<?php

use ResidenceTheme\MetaBox\PageAbout\Tabs\IntroductionTab;

$tab_introduction = residence_get_opt(IntroductionTab::class)?->get( get_the_ID() ) ?? [];

if (empty($tab_introduction)) {
    return;
}
?>

<div class="item-head">
    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <h2 class="titlebox__title wow fadeInUp">
                <?php echo esc_html($tab_introduction['title_line_1']); ?>
                <br>
                <?php echo esc_html($tab_introduction['title_line_2']); ?>
            </h2>
        </div>
    </div>
</div>

<div class="item-info">
    <div class="row">
        <div class="col-md-7 col-xl-8 offset-md-1 order-md-2">
            <div class="swiper wow fadeInUp">
                <div class="swiper-wrapper">
                    <?php foreach ($tab_introduction['gallery'] as $image_id): ?>
                        <div class="swiper-slide">
                            <div class="f-img">
                                <?php echo wp_get_attachment_image($image_id, 'large'); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="swiper-buttonCustom style-2">
                    <div class="swiper-buttonCustom-prev">
                        <i class="se-arrow-left"></i>
                    </div>

                    <div class="swiper-buttonCustom-next">
                        <i class="se-arrow-right"></i>
                    </div>
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3 order-md-1">
            <div class="f-text wow fadeInUp">
                <?php echo wpautop(esc_html($tab_introduction['description'])); ?>
            </div>
        </div>
    </div>
</div>