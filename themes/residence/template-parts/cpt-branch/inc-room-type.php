<?php
use ExtendSite\MetaBox\BranchMetaBox;

$meta_rooms = residence_get_opt( BranchMetaBox::class )?->get_post_meta_rooms( get_the_ID() );
$meta_location = residence_get_opt( BranchMetaBox::class )?->get_post_meta_location( get_the_ID() );

if ( empty( $meta_rooms ) ) {
    return;
}
?>

<div class="item-content">
    <div class="tabbox" data-fix-wow="true">
        <div class="tabbox-fix wow fadeInUp">
            <p><?php esc_html_e('Loại Phòng', 'residence'); ?></p>

            <div class="tabbox__list">
                <ul>
                    <?php foreach ( $meta_rooms as $index => $room ) :
                        $tab_id = 'tab-id-' . ( $index + 1 );
                        ?>
                        <li>
                            <a
                                href="#<?php echo esc_attr( $tab_id ); ?>"
                                class="<?php echo $index === 0 ? 'current' : ''; ?>"
                            >
                                <?php echo esc_html( $room['title'] ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="tabbox__content">
            <?php
            foreach ( $meta_rooms as $index => $room ) :
                $tab_id   = 'tab-id-' . ( $index + 1 );
                $gallery  = 'gallery-' . ( $index + 1 );
                $gallery_mb = 'gallery-mb-' . ( $index + 1 );
            ?>

            <div class="panel <?php echo $index === 0 ? 'active show' : ''; ?>" id="<?php echo esc_attr( $tab_id ); ?>">
                <div class="row">
                    <div class="col-xl-5 offset-xl-6">
                        <div class="item-list">
                            <div class="f-item wow fadeInUp">
                                <span class="f-sub"><?php esc_html_e('Capacity', 'residence'); ?></span>

                                <div class="f-content">
                                    <p><?php echo esc_html( $room['capacity'] ); ?></p>
                                </div>
                            </div>

                            <div class="f-item wow fadeInUp">
                                <span class="f-sub"><?php esc_html_e('Area', 'residence'); ?></span>

                                <div class="f-content">
                                    <p><?php echo esc_html( $room['area'] ); ?></p>
                                </div>
                            </div>

                            <?php if ( ! empty( $meta_location ) ) : ?>
                                <div class="f-item wow fadeInUp">
                                    <span class="f-sub"><?php esc_html_e('Location', 'residence'); ?></span>

                                    <div class="f-content">
                                        <ul>
                                            <?php foreach ( $meta_location as $line ) : ?>
                                                <li><p><?php echo esc_html( $line ); ?></p></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $room['detail'] ) ) : ?>
                                <div class="f-item wow fadeInUp">
                                    <span class="f-sub"><?php esc_html_e('Detail', 'residence'); ?></span>

                                    <div class="f-content">
                                        <ul>
                                            <?php foreach ( $room['detail'] as $line ) : ?>
                                                <li><p><?php echo esc_html( $line ); ?></p></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="item-btn wow fadeInUp">
                            <span href="#" class="btn-book popover-trigger" data-target="popover-book-2">
                              <?php esc_html_e('Đặt phòng ngay', 'residence'); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="item-grid d-none d-xl-block">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="g-img g-img-1">
                                <a
                                        href="assets/img/detailInfo-img-2.jpg"
                                        class="g-img__inner wow fadeInUp"
                                        data-fancybox="gallery-1"
                                        data-caption="Đây là phòng ngủ"
                                >
                                    <img src="assets/img/detailInfo-img-2.jpg" loading="lazy" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="g-img g-img-2 wow fadeInUp">
                                <a href="assets/img/detailInfo-img-3.jpg" class="g-img__inner" data-fancybox="gallery-1">
                                    <img src="assets/img/detailInfo-img-3.jpg" loading="lazy" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="g-img g-img-3">
                                <a href="assets/img/detailInfo-img-4.jpg" class="g-img__inner wow fadeInUp" data-fancybox="gallery-1">
                                    <img src="assets/img/detailInfo-img-4.jpg" loading="lazy" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="g-img g-img-4">
                                <a href="assets/img/detailInfo-img-5.jpg" class="g-img__inner wow fadeInUp" data-fancybox="gallery-1">
                                    <img src="assets/img/detailInfo-img-5.jpg" loading="lazy" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="g-img g-img-5">
                                <a href="assets/img/detailInfo-img-7.jpg" class="g-img__inner wow fadeInUp" data-fancybox="gallery-1">
                                    <img src="assets/img/detailInfo-img-7.jpg" loading="lazy" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="g-img g-img-6">
                        <a href="assets/img/detailInfo-img-6.jpg" class="g-img__inner wow fadeInUp" data-fancybox="gallery-1">
                            <img src="assets/img/detailInfo-img-6.jpg" loading="lazy" alt="">
                        </a>
                    </div>
                    <div class="g-img g-img-7">
                        <a href="assets/img/detailInfo-img-8.jpg" class="g-img__inner wow fadeInUp" data-fancybox="gallery-1">
                            <img src="assets/img/detailInfo-img-8.jpg" loading="lazy" alt="">
                        </a>
                    </div>
                </div>

                <div class="item-mobile d-xl-none wow fadeInUp">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="assets/img/detailInfo-img-2.jpg" class="f-img" data-fancybox="gallery-mb-1">
                                    <img src="assets/img/detailInfo-img-2.jpg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="assets/img/detailInfo-img-3.jpg" class="f-img" data-fancybox="gallery-mb-1">
                                    <img src="assets/img/detailInfo-img-3.jpg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="assets/img/detailInfo-img-4.jpg" class="f-img" data-fancybox="gallery-mb-1">
                                    <img src="assets/img/detailInfo-img-4.jpg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="assets/img/detailInfo-img-5.jpg" class="f-img" data-fancybox="gallery-mb-1">
                                    <img src="assets/img/detailInfo-img-5.jpg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="assets/img/detailInfo-img-6.jpg" class="f-img" data-fancybox="gallery-mb-1">
                                    <img src="assets/img/detailInfo-img-6.jpg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="assets/img/detailInfo-img-7.jpg" class="f-img" data-fancybox="gallery-mb-1">
                                    <img src="assets/img/detailInfo-img-7.jpg" alt="">
                                </a>
                            </div>
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
            </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>