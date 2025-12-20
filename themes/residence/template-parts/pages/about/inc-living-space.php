<?php
use ResidenceTheme\MetaBox\PageAbout\Tabs\LivingSpaceTab;

defined('ABSPATH') || exit;

$data = residence_get_opt(LivingSpaceTab::class)?->get(get_the_ID()) ?? [];

if (empty($data)) {
    return;
}
?>

<div class="item-group-2">
    <div class="row">
        <div class="col-md-8 order-md-2">
            <div class="f-img f-img-4 wow fadeInUp">
                <div class="f-img__inner">
                    <?php echo wp_get_attachment_image(
                        $data['image_sub'],
                        'large',
                        false,
                        ['loading' => 'lazy']
                    ); ?>
                </div>
            </div>

            <div class="f-text f-text-3 d-none d-md-block wow fadeInUp">
                <h3><?php echo esc_html($data['title']); ?></h3>

                <?php echo wpautop($data['description']); ?>
            </div>
        </div>

        <div class="col-md-4 order-md-1">
            <div class="f-img f-img-5 wow fadeInUp">
                <div class="f-img__inner">
                    <?php echo wp_get_attachment_image(
                        $data['image_main'],
                        'large',
                        false,
                        ['loading' => 'lazy']
                    ); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="f-text f-text-3 d-md-none wow fadeInUp">
        <h3><?php echo esc_html($data['title']); ?></h3>

        <?php echo wpautop($data['description']); ?>
    </div>
</div>
