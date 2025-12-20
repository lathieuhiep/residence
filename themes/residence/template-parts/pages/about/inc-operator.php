<?php
use ResidenceTheme\MetaBox\PageAbout\Tabs\OperatorTab;

defined('ABSPATH') || exit;

$data = residence_get_opt(OperatorTab::class)?->get(get_the_ID()) ?? [];

if (empty($data)) {
    return;
}
?>

<div class="item-group-3">
    <div class="f-img f-img-6 wow fadeInUp">
        <div class="f-img__inner">
            <?php echo wp_get_attachment_image(
                $data['image'],
                'large',
                false,
                ['loading' => 'lazy']
            ); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2 col-xl-6 offset-xl-3">
            <div class="f-text f-text-4 wow fadeInUp">
                <h3><?php echo esc_html($data['title']); ?></h3>

                <?php echo wpautop($data['description']); ?>
            </div>
        </div>
    </div>
</div>
