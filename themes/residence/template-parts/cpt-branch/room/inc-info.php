<?php
/**
 * info room template part
 *
 * var array $args
 */

$room = $args['room'] ?? [];
$meta_location = $args['meta_location'] ?? [];
?>

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