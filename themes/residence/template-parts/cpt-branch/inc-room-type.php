<?php

use ExtendSite\MetaBox\BranchMetaBox;

$meta_rooms = residence_get_opt(BranchMetaBox::class)?->get_post_meta_rooms(get_the_ID());
$meta_location = residence_get_opt(BranchMetaBox::class)?->get_post_meta_location(get_the_ID());

if (empty($meta_rooms)) {
    return;
}
?>

<div class="item-content">
    <div class="tabbox" data-fix-wow="true">
        <div class="tabbox-fix wow fadeInUp">
            <p><?php esc_html_e('Loại Phòng', 'residence'); ?></p>

            <div class="tabbox__list">
                <ul>
                    <?php foreach ($meta_rooms as $index => $room) :
                        $tab_id = 'tab-id-' . ($index + 1);
                        ?>
                        <li>
                            <a href="#<?php echo esc_attr($tab_id); ?>" class="<?php echo $index === 0 ? 'current' : ''; ?>">
                                <?php echo esc_html($room['title']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="tabbox__content">
            <?php
            foreach ($meta_rooms as $index => $room) :
                $tab_id = 'tab-id-' . ($index + 1);
                $group_index = $index + 1;
                $galleries = $room['gallery'];
                $count_gallery = count( $galleries );
            ?>

                <div class="panel <?php echo $index === 0 ? 'active show' : ''; ?>"
                     id="<?php echo esc_attr($tab_id); ?>">
                    <?php
                    get_template_part('template-parts/cpt-branch/room/inc', 'info', [
                        'room' => $room,
                        'meta_location' => $meta_location,
                    ]);
                    ?>

                    <?php if ( $count_gallery > 0 ) : ?>
                        <div class="item-grid d-none d-xl-block">
                            <div class="row">
                                <div class="col-xl-4">
                                    <?php
                                    get_template_part('template-parts/cpt-branch/room/inc', 'gallery-item', [
                                        'group_index' => $group_index,
                                        'gallery' => $galleries,
                                        'index' => 0,
                                        'class' => 'g-img-1',
                                    ]);
                                    ?>
                                </div>

                                <div class="col-xl-5">
                                    <?php
                                    get_template_part('template-parts/cpt-branch/room/inc', 'gallery-item', [
                                        'group_index' => $group_index,
                                        'gallery' => $galleries,
                                        'index' => 1,
                                        'class' => 'g-img-2',
                                    ]);
                                    ?>
                                </div>

                                <div class="col-xl-3">
                                    <?php
                                    get_template_part('template-parts/cpt-branch/room/inc', 'gallery-item', [
                                        'group_index' => $group_index,
                                        'gallery' => $galleries,
                                        'index' => 2,
                                        'class' => 'g-img-3',
                                    ]);
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-3">
                                    <?php
                                    get_template_part('template-parts/cpt-branch/room/inc', 'gallery-item', [
                                        'group_index' => $group_index,
                                        'gallery' => $galleries,
                                        'index' => 3,
                                        'class' => 'g-img-4',
                                    ]);
                                    ?>
                                </div>

                                <div class="col-xl-6">
                                    <?php
                                    get_template_part('template-parts/cpt-branch/room/inc', 'gallery-item', [
                                        'group_index' => $group_index,
                                        'gallery' => $galleries,
                                        'index' => 4,
                                        'class' => 'g-img-5',
                                    ]);
                                    ?>
                                </div>
                            </div>

                            <?php
                            get_template_part('template-parts/cpt-branch/room/inc', 'gallery-item', [
                                'group_index' => $group_index,
                                'gallery' => $galleries,
                                'index' => 5,
                                'class' => 'g-img-6',
                            ]);

                            get_template_part('template-parts/cpt-branch/room/inc', 'gallery-item', [
                                'group_index' => $group_index,
                                'gallery' => $galleries,
                                'index' => 6,
                                'class' => 'g-img-7',
                            ]);
                            ?>

                            <?php
                            if ( $count_gallery > 7 ) :
                                $gallery_after_8 = array_slice( $galleries, 7, null, true );
                            ?>
                                <div class="g-img g-img-more">
                                    <div class="g-img__inner wow fadeInUp">
                                        <?php
                                        foreach ( $gallery_after_8 as $image_id) :
                                            $caption = wp_get_attachment_caption( $image_id );
                                        ?>
                                            <a href="<?php echo esc_url( wp_get_attachment_url( $image_id ) ); ?>"
                                               class="g-img__inner" data-fancybox="gallery-<?php echo esc_attr( $group_index ) ?>"
                                               data-caption="<?php echo esc_attr( $caption ); ?>"
                                            >
                                                <?php echo wp_get_attachment_image($image_id, 'large'); ?>
                                            </a>
                                        <?php endforeach; ?>

                                        <span><?php esc_html_e( 'Xem thêm', 'residence' ); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="item-mobile d-xl-none">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ( $galleries as $gallery_id):
                                        $caption = wp_get_attachment_caption( $gallery_id );
                                        ?>
                                        <div class="swiper-slide">
                                            <a href="<?php echo esc_url( wp_get_attachment_url( $gallery_id ) ); ?>"
                                               class="f-img"
                                               data-fancybox="gallery-mb-<?php echo esc_attr( $group_index ); ?>"
                                               data-caption="<?php echo esc_attr( $caption ); ?>"
                                            >
                                                <?php echo wp_get_attachment_image($gallery_id, 'large'); ?>
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