<?php
use ResidenceTheme\MetaBox\PageAbout\Tabs\HighlightsTab;

defined('ABSPATH') || exit;

$data = residence_get_opt(HighlightsTab::class)?->get(get_the_ID()) ?? [];

if (empty($data)) {
    return;
}

$loc = $data['location'];
$ser = $data['service'];
?>

<div class="row">
    <div class="col-md-8 offset-md-2 col-xl-6 offset-xl-3">
        <div class="f-img f-img-1 d-md-none wow fadeInUp">
            <div class="f-img__inner">
                <?php echo wp_get_attachment_image($loc['image'], 'large', false, ['loading' => 'lazy']); ?>
            </div>
        </div>

        <div class="f-text f-text-1 wow fadeInUp">
            <h3><?php echo esc_html($loc['title']); ?></h3>

            <?php echo wpautop($loc['description']); ?>
        </div>
    </div>
</div>

<div class="item-group-1">
    <div class="row align-items-md-end">
        <div class="col-md-2 offset-xl-1">
            <div class="f-img f-img-1 d-none d-md-block wow fadeInUp">
                <div class="f-img__inner">
                    <?php echo wp_get_attachment_image($loc['image'], 'large', false, ['loading' => 'lazy']); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-5 offset-md-1">
            <div class="f-img f-img-2 wow fadeInUp">
                <div class="f-img__inner">
                    <?php echo wp_get_attachment_image($ser['image_2'], 'large', false, ['loading' => 'lazy']); ?>
                </div>
            </div>

            <div class="f-text f-text-2 d-md-none wow fadeInUp">
                <h3><?php echo esc_html($ser['title']); ?></h3>

                <?php echo wpautop($ser['description']); ?>
            </div>
        </div>

        <div class="col-md-3 col-xl-3">
            <div class="f-img f-img-3 wow fadeInUp">
                <div class="f-img__inner">
                    <?php echo wp_get_attachment_image($ser['image_3'], 'large', false, ['loading' => 'lazy']); ?>
                </div>
            </div>
        </div>

        <div class="col-md-8 offset-md-3 col-xl-6 offset-xl-4">
            <div class="f-text f-text-2 d-none d-md-block wow fadeInUp">
                <h3><?php echo esc_html($ser['title']); ?></h3>

                <?php echo wpautop($ser['description']); ?>
            </div>
        </div>
    </div>
</div>