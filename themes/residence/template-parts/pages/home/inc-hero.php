<?php
/**
 * Home Hero section
 */

use ResidenceTheme\MetaBox\PageHome\Tabs\HeroTab;

defined('ABSPATH') || exit;

$data = HeroTab::get(get_the_ID());

// Nếu không có gì để hiển thị → bỏ qua hero
if (
    empty($data['bg_pc']) &&
    empty($data['bg_mb']) &&
    empty($data['logo']) &&
    empty($data['text'])
) {
    return;
}
?>

<section class="section sec-hero">
    <div class="item-wrap"
        <?php if (!empty($data['bg_pc'])) : ?>
            data-bg-pc="<?php echo esc_url($data['bg_pc']); ?>"
        <?php endif; ?>
        <?php if (!empty($data['bg_mb'])) : ?>
            data-bg-mb="<?php echo esc_url($data['bg_mb']); ?>"
        <?php endif; ?>
    >

        <div class="item-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 col-xl-4 offset-xl-4">
                        <div class="item-body">

                            <?php if (!empty($data['logo'])) : ?>
                                <div class="item-logo wow fadeInUp">
                                    <img
                                        src="<?php echo esc_url($data['logo']); ?>"
                                        alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                                        loading="lazy"
                                    >
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($data['text'])) : ?>
                                <div class="item-text d-none d-md-block wow fadeInUp" data-wow-delay=".2s">
                                    <p><?php echo esc_html($data['text']); ?></p>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($data['text'])) : ?>
            <div class="item-text d-md-none wow fadeInUp" data-wow-delay=".2s">
                <p><?php echo esc_html($data['text']); ?></p>
            </div>
        <?php endif; ?>

    </div>
</section>
