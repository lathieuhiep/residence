<?php

use ExtendSite\MetaBox\BranchMetaBox;

$meta_about = residence_get_opt(BranchMetaBox::class)?->get_post_meta_about( get_the_ID() );
?>
<div class="item-head">
    <div class="row">
        <div class="col-md-7 col-xl-6 offset-xl-1">
            <div class="f-body wow fadeInUp">
                <h3 class="f-title">
                    <?php echo esc_html( $meta_about['heading'] ); ?>
                </h3>

                <div class="f-entry">
                    <?php echo wpautop( $meta_about['desc'] ); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4 offset-md-1 col-xl-3 offset-xl-1">
            <div class="f-img wow fadeInUp">
                <img src="<?php echo esc_url( wp_get_attachment_image_url( $meta_about['image'], 'large' ) ) ?>" alt="" loading="lazy">
            </div>
        </div>
    </div>
</div>