<?php
/**
 * Partial: about
 *
 * @var array $args
 */

use ExtendSite\MetaBox\BranchMetaBox;

$post_id = $args['post_id'];
$image_url_pc = get_the_post_thumbnail_url($post_id, 'full');
$image_mb_id = residence_get_opt(BranchMetaBox::class)?->get_post_meta_mobile_image($post_id);

if ( $image_mb_id ) {
    $image_url_mb = wp_get_attachment_image_url($image_mb_id, 'full');
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

<div id="popover-book" class="popover style-2">
    <div class="popover-arrow"></div>
    <div class="popover-content">
        <ul>
            <li>
                <span>Phone</span>
                <p><a href="tel:091 3833 333">091 3833 333</a></p>
            </li>
            <li>
                <span>Email</span>
                <p><a href="mailto:thaihoangapartmenthd@gmail.com">thaihoangapartmenthd@gmail.com</a></p>
            </li>
        </ul>
    </div>
</div>

