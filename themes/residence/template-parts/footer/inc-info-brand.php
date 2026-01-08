<?php

use ExtendSite\Options\ContactOptions;
use ExtendSite\Options\CopyrightOptions;
use ExtendSite\Options\FooterOptions;

// Get copyright text
$show_copyright = residence_get_opt(CopyrightOptions::class)?->get_show_copyright() ?? true;
$copyright_heading = residence_get_opt(CopyrightOptions::class)?->get_content_heading() ?? '';
$copyright_text = residence_get_opt(CopyrightOptions::class)?->get_content_copyright() ?? '';

// Get address columns
$address_columns = residence_get_opt(FooterOptions::class)?->get_opt_footer_address_columns() ?? [];

// Get contact info
$phone = residence_get_opt(ContactOptions::class)?->get_otp_contact_phone() ?? '091 3833 333';
$email = residence_get_opt(ContactOptions::class)?->get_opt_contact_email() ?? 'thaihoangapartmenthd@gmail.com';
$social_links = residence_get_opt(ContactOptions::class)?->get_opt_contact_social_links() ?? [];
?>
<div class="item-content">
    <div class="row">
        <div class="col-xl-3">
            <?php if ($show_copyright) : ?>
                <div class="item-info wow fadeInUp">
                   <?php echo esc_html( $copyright_heading ) . wpautop($copyright_text); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-xl-9">
            <div class="row">
                <?php if ( ! empty( $address_columns ) ) : ?>
                    <?php foreach ( $address_columns as $col_index => $column ) :
                        // Delay theo cột: 0.2s, 0.4s
                        $delay = 0.2 * ( $col_index + 1 );
                        ?>
                        <div class="col-md-6 col-xl-4">
                            <div
                                class="item-text wow fadeInUp"
                                data-md-wow-delay="<?php echo esc_attr( $delay . 's' ); ?>"
                                data-xl-wow-delay="<?php echo esc_attr( $delay . 's' ); ?>"
                            >
                                <?php if ( ! empty( $column['addresses'] ) ) : ?>
                                    <?php foreach ( $column['addresses'] as $row ) : ?>
                                        <p><?php echo esc_html( $row['text'] ); ?></p>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="col-md-6 col-xl-4">
                    <div class="item-text wow fadeInUp" data-xl-wow-delay=".6s">
                        <p>
                            <?php esc_html_e('Phone', 'residence'); ?>:
                            <a href="tel:<?php echo esc_attr( residence_preg_replace_ony_number($phone) ) ?>"><?php echo esc_html( $phone ); ?></a>
                        </p>

                        <p>
                            <?php esc_html_e('Email', 'residence'); ?>:
                            <a href="mailto:<?php echo esc_attr( $email )?>"><?php echo esc_html( $email ); ?></a>
                        </p>

                        <?php if ( ! empty( $social_links ) ) :
                            foreach ( $social_links as $index => $item ) :
                        ?>
                            <p>
                                <a
                                    href="<?php echo esc_url( $item['url'] ); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <?php echo esc_html( strtoupper( $item['label'] ) ); ?>
                                </a>
                            </p>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>