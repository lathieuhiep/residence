<?php

use ExtendSite\Options\ContactOptions;
use ExtendSite\Options\RecruitmentOptions;

$recruitment_options = residence_get_opt(RecruitmentOptions::class)?->get_opt_recruitment_images() ?? [];

$left_image = $main_image = $right_image = null;

if ( !empty( $recruitment_options ) ) {
    $images = array_values( $recruitment_options );

    // Mapping theo layout
    $left_image  = $images[0] ?? null;
    $main_image  = $images[1] ?? $images[0] ?? null;
    $right_image = $images[2] ?? null;
}

// Get contact info
$phone = residence_get_opt(ContactOptions::class)?->get_otp_contact_phone() ?? '091 3833 333';
$email = residence_get_opt(ContactOptions::class)?->get_opt_contact_email() ?? 'thaihoangapartmenthd@gmail.com';
?>
<section class="section sec-homeCongViec" id="id-congviec">
    <div class="container">
        <h2 class="titlebox__title wow fadeInUp">
            <?php esc_html_e('Cơ Hội Nghề Nghiệp', 'residence'); ?>
        </h2>

        <div class="item-content">
            <div class="item-imgGroup">
                <?php if ( $main_image ) : ?>
                    <div class="row align-items-center">
                        <?php if ( $left_image ) : ?>
                            <div class="col-md-2 offset-md-1">
                                <div class="f-img f-img-small d-none d-md-block wow zoomIn">
                                    <div class="f-img__inner">
                                        <?php
                                        echo wp_get_attachment_image(
                                                (int) $left_image,
                                                'large',
                                                false,
                                                [ 'loading' => 'lazy' ]
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-md-6">
                            <div class="f-img f-img-big wow zoomIn">
                                <div class="f-img__inner">
                                    <?php
                                    echo wp_get_attachment_image(
                                            (int) $main_image,
                                            'large',
                                            false,
                                            [ 'loading' => 'lazy' ]
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php if ( $right_image ) : ?>
                            <div class="col-md-2">
                                <div class="f-img f-img-small d-none d-md-block wow zoomIn">
                                    <div class="f-img__inner">
                                        <?php
                                        echo wp_get_attachment_image(
                                                (int) $right_image,
                                                'large',
                                                false,
                                                [ 'loading' => 'lazy' ]
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3 col-xl-4 offset-xl-4">
                    <div class="item-text">
                        <div class="f-entry wow fadeInUp">
                            <p>
                                <?php esc_html_e('Bạn đang tìm kiếm một môi trường làm việc chuyên nghiệp, năng động và đầy cơ hội phát triển? Thai Hoang Holdings chính là nơi dành cho bạn! Chúng tôi đang mở rộng quy mô và tìm kiếm những cá nhân tài năng, nhiệt huyết để cùng đồng hành và tạo nên những bước tiến mới! Để ứng tuyển, vui lòng liên hệ bộ phận HCNS tại:' , 'residence'); ?>
                            </p>
                        </div>
                        <ul class="f-list wow fadeInUp">
                            <li>
                                <span><?php esc_html_e('Email', 'residence'); ?></span>
                                <a href="mailto:<?php echo esc_attr( $email )?>"><?php echo esc_html( $email )?></a>
                            </li>
                            <li>
                                <span><?php esc_html_e('Phone', 'residence'); ?></span>
                                <a href="tel:<?php echo esc_attr( residence_preg_replace_ony_number($phone) ) ?>"><?php echo esc_html( $phone ); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>