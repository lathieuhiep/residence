<?php
/**
 * gallery item template part
 *
 * var array $args
 */

$group_index = $args['group_index'] ?? 1;
$galleries = $args['gallery'] ?? [];
$index   = $args['index'] ?? 0;

if ( empty ( $galleries[$index] ) ) {
    return;
}

$img_id = (int) $galleries[$index];
$caption = wp_get_attachment_caption( $img_id );
$class = 'g-img';

if ( isset( $args['class'] ) ) {
    $class .= ' ' . $args['class'];
}
?>
<div class="<?php echo esc_attr($class); ?>">
    <a href="<?php echo esc_url( wp_get_attachment_url( $img_id ) ); ?>"
        class="g-img__inner wow fadeInUp"
        data-fancybox="gallery-<?php echo esc_attr( $group_index ); ?>"
        data-caption="<?php echo esc_attr( $caption ); ?>"
    >
        <?php echo wp_get_attachment_image($img_id, 'large'); ?>
    </a>
</div>