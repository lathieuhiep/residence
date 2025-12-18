<?php
/**
 * Popover Book
 *
 * var array $args
 */

use ExtendSite\Options\ContactOptions;

$id = $args['id'] ?? 'popover-book';
$class = 'popover';

if ( isset( $args['class'] ) ) {
    $class .= ' ' . $args['class'];
}

// Get contact info
$phone = residence_get_opt(ContactOptions::class)?->get_otp_contact_phone() ?? '091 3833 333';
$email = residence_get_opt(ContactOptions::class)?->get_opt_contact_email() ?? 'thaihoangapartmenthd@gmail.com';
?>
<div id="<?php echo esc_attr( $id ) ?>" class="<?php echo esc_attr($class) ?>">
    <div class="popover-arrow"></div>

    <div class="popover-content">
        <ul>
            <li>
                <span><?php esc_html_e('Phone', 'residence'); ?></span>
                <p>
                    <a href="tel:<?php echo esc_attr( residence_preg_replace_ony_number($phone) ) ?>">
                        <?php echo esc_html( $phone ); ?>
                    </a>
                </p>
            </li>

            <li>
                <span><?php esc_html_e('Email', 'residence'); ?></span>

                <p>
                    <a href="mailto:<?php echo esc_attr( $email )?>">
                        <?php echo esc_html( $email ); ?>
                    </a>
                </p>
            </li>
        </ul>
    </div>
</div>