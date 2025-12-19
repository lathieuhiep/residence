<?php
/**
 * Partial: hero
 *
 * @var array $args
 */

use ExtendSite\MetaBox\BranchMetaBox;

$banner = residence_get_opt(BranchMetaBox::class)?->get_post_meta_banner_images(get_the_ID());
$image_url_pc = $image_url_mb = '';

if ( $banner && ! empty( $banner['desktop'] ) ) {
    $image_url_pc = wp_get_attachment_image_url($banner['desktop'], 'full');
}

if ( $banner && ! empty( $banner['mobile'] ) ) {
    $image_url_mb = wp_get_attachment_image_url($banner['mobile'], 'full');
} else {
    $image_url_mb = $image_url_pc;
}

?>
<section class="section sec-detailHero">
    <div class="item-wrap">
        <div class="item-bg" data-bg-pc="<?php echo esc_url( $image_url_pc ); ?>" data-bg-mb="<?php echo esc_url( $image_url_mb ); ?>"></div>

        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-xl-8 offset-xl-2">
                    <h1 class="titlebox__title wow fadeInUp">
                        <?php the_title(); ?>
                    </h1>

                    <div class="item-btn wow fadeInUp" data-wow-delay=".2s">
                      <a tabindex="0" role="button" class="btn-book popover-trigger" data-target="popover-book">
                        <?php esc_html_e('Đặt phòng ngay', 'residence'); ?>
                      </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

