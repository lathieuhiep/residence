<?php

use ExtendSite\Options\FooterOptions;

$logo = residence_get_opt(FooterOptions::class)?->get_opt_footer_logo() ?? null;

$brand_gallery = array_values(
    array_filter(
        residence_get_opt(FooterOptions::class)?->get_opt_footer_brand_gallery() ?? [],
        fn ( $id ) => is_numeric( $id ) && (int) $id > 0
    )
);
?>
<div class="item-head">
    <div class="row align-items-center">
        <?php if ( $logo ) : ?>
            <div class="col-xl-3">
                <a href="<?php echo esc_url( home_url() ); ?>" class="item-logo wow fadeInUp">
                    <?php echo wp_get_attachment_image( $logo, 'medium', false, [ 'alt' => get_bloginfo( 'name' ) ] ); ?>
                </a>
            </div>
        <?php endif; ?>

        <?php if ( !empty( $brand_gallery ) ) : ?>
            <div class="col-xl-9">
                <div class="item-logoList wow fadeInUp">
                    <div class="row">
                        <?php foreach ( $brand_gallery as $index => $image_id ) :
                            $delay = 0.1 * ( $index + 1 );
                            $delay_attr = sprintf(
                                ' data-md-wow-delay="%.1fs" data-xl-wow-delay="%.1fs"',
                                $delay,
                                $delay
                            );
                            ?>
                            <div class="col-md-4">
                                <a href="<?php echo esc_url( home_url() ); ?>" class="item-logoMin wow fadeInUp"<?php echo $delay_attr; ?>>
                                    <?php
                                    echo wp_get_attachment_image(
                                        (int) $image_id,
                                        'medium',
                                        false,
                                        [ 'loading' => 'lazy' ]
                                    );
                                    ?>
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>