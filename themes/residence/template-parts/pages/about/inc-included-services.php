<?php
use ResidenceTheme\MetaBox\PageAbout\Tabs\IncludedServicesTab;

defined('ABSPATH') || exit;

$data = residence_get_opt(IncludedServicesTab::class)?->get(get_the_ID()) ?? [];

if (empty($data)) {
    return;
}
?>

<section class="section sec-dvPhong">
    <div class="container">
        <h2 class="titlebox__title fz-80 d-xl-none wow fadeInUp">
            <?php echo esc_html($data['title']); ?>
        </h2>

        <div class="row">
            <div class="col-md-5 col-xl-6">
                <div class="item-img wow fadeInUp">
                    <?php echo wp_get_attachment_image(
                        $data['image'],
                        'large',
                        false,
                        ['loading' => 'lazy']
                    ); ?>
                </div>
            </div>

            <div class="col-md-6 col-xl-5 offset-md-1">
                <h2 class="titlebox__title fz-80 d-none d-xl-block wow fadeInUp">
                    <?php echo esc_html($data['title']); ?>
                </h2>

                <?php if (!empty($data['list'])) : ?>
                    <ul class="item-list">
                        <?php foreach ($data['list'] as $item) : ?>
                            <li class="wow fadeInUp">
                                <p><?php echo esc_html($item['text'] ?? ''); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>