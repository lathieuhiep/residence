<?php
/**
 * Home – About section
 */

use ResidenceTheme\MetaBox\PageHome\Tabs\AboutTab;

defined('ABSPATH') || exit;

$data = AboutTab::get( get_the_ID() );

// Không có dữ liệu thì không render
if ( empty( $data['title'] ) && empty( $data['content'] ) ) {
    return;
}
?>

<section class="section sec-homeAbout" id="id-gioithieu">
    <div class="container">
        <div class="row">
            <div class="col-xl-10 offset-xl-1">
                <div class="item-body">
                    <?php if ( ! empty( $data['title'] ) ) : ?>
                        <h2 class="item-title wow fadeInUp">
                            <?php
                            // Cho phép xuống dòng → <br>
                            echo wp_kses(
                                nl2br( $data['title'] ),
                                [ 'br' => [] ]
                            );
                            ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ( ! empty( $data['content'] ) ) : ?>
                        <div class="item-text wow fadeInUp">
                            <?php echo wpautop( $data['content'] ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>