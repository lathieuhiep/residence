<?php
use ExtendSite\MetaBox\BranchMetaBox;

$meta_rooms = residence_get_opt( BranchMetaBox::class )?->get_post_meta_rooms( get_the_ID() );

if ( empty( $meta_rooms ) ) {
    return;
}
?>

<div class="item-content">
    <div class="tabbox" data-fix-wow="true">
        <div class="tabbox-fix wow fadeInUp">
            <p>Loại Phòng</p>
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
            <?php foreach ( $meta_rooms as $index => $room ) :
                $tab_id   = 'tab-id-' . ( $index + 1 );
                $gallery  = 'gallery-' . ( $index + 1 );
                $gallery_mb = 'gallery-mb-' . ( $index + 1 );
                ?>
                <div
                    class="panel <?php echo $index === 0 ? 'active show' : ''; ?>"
                    id="<?php echo esc_attr( $tab_id ); ?>"
                >
                    <!-- ===== INFO ===== -->
                    <div class="row">
                        <div class="col-xl-5 offset-xl-6">
                            <div class="item-list">

                                <?php if ( $room['capacity'] ) : ?>
                                    <div class="f-item wow fadeInUp">
                                        <span class="f-sub">Capacity</span>
                                        <div class="f-content">
                                            <p><?php echo esc_html( $room['capacity'] ); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $room['area'] ) : ?>
                                    <div class="f-item wow fadeInUp">
                                        <span class="f-sub">Area</span>
                                        <div class="f-content">
                                            <p><?php echo esc_html( $room['area'] ); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ( ! empty( $room['location'] ) ) : ?>
                                    <div class="f-item wow fadeInUp">
                                        <span class="f-sub">Location</span>
                                        <div class="f-content">
                                            <ul>
                                                <?php foreach ( $room['location'] as $line ) : ?>
                                                    <li><p><?php echo esc_html( $line ); ?></p></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ( ! empty( $room['detail'] ) ) : ?>
                                    <div class="f-item wow fadeInUp">
                                        <span class="f-sub">Detail</span>
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

                    <!-- ===== DESKTOP GALLERY ===== -->
                    <?php if ( ! empty( $room['gallery_desktop'] ) ) : ?>
                        <div class="item-grid d-none d-xl-block">
                            <div class="row">
                                <?php foreach ( array_slice( $room['gallery_desktop'], 0, 3 ) as $i => $img_id ) : ?>
                                    <div class="col-xl-<?php echo $i === 1 ? '5' : '4'; ?>">
                                        <div class="g-img g-img-<?php echo $i + 1; ?>">
                                            <a
                                                href="<?php echo esc_url( wp_get_attachment_image_url( $img_id, 'full' ) ); ?>"
                                                class="g-img__inner wow fadeInUp"
                                                data-fancybox="<?php echo esc_attr( $gallery ); ?>"
                                            >
                                                <img
                                                    src="<?php echo esc_url( wp_get_attachment_image_url( $img_id, 'large' ) ); ?>"
                                                    loading="lazy"
                                                    alt=""
                                                >
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="row">
                                <?php foreach ( array_slice( $room['gallery_desktop'], 3, 2 ) as $i => $img_id ) : ?>
                                    <div class="col-xl-<?php echo $i === 0 ? '3' : '6'; ?>">
                                        <div class="g-img g-img-<?php echo $i + 4; ?>">
                                            <a
                                                href="<?php echo esc_url( wp_get_attachment_image_url( $img_id, 'full' ) ); ?>"
                                                class="g-img__inner wow fadeInUp"
                                                data-fancybox="<?php echo esc_attr( $gallery ); ?>"
                                            >
                                                <img
                                                    src="<?php echo esc_url( wp_get_attachment_image_url( $img_id, 'large' ) ); ?>"
                                                    loading="lazy"
                                                    alt=""
                                                >
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <?php foreach ( array_slice( $room['gallery_desktop'], 5 ) as $i => $img_id ) : ?>
                                <div class="g-img g-img-<?php echo $i + 6; ?>">
                                    <a
                                        href="<?php echo esc_url( wp_get_attachment_image_url( $img_id, 'full' ) ); ?>"
                                        class="g-img__inner wow fadeInUp"
                                        data-fancybox="<?php echo esc_attr( $gallery ); ?>"
                                    >
                                        <img
                                            src="<?php echo esc_url( wp_get_attachment_image_url( $img_id, 'large' ) ); ?>"
                                            loading="lazy"
                                            alt=""
                                        >
                                    </a>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    <?php endif; ?>

                    <!-- ===== MOBILE GALLERY ===== -->
                    <?php if ( ! empty( $room['gallery_mobile'] ) ) : ?>
                        <div class="item-mobile d-xl-none wow fadeInUp">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ( $room['gallery_mobile'] as $img_id ) : ?>
                                        <div class="swiper-slide">
                                            <a
                                                href="<?php echo esc_url( wp_get_attachment_image_url( $img_id, 'full' ) ); ?>"
                                                class="f-img"
                                                data-fancybox="<?php echo esc_attr( $gallery_mb ); ?>"
                                            >
                                                <img
                                                    src="<?php echo esc_url( wp_get_attachment_image_url( $img_id, 'large' ) ); ?>"
                                                    alt=""
                                                >
                                            </a>
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
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>