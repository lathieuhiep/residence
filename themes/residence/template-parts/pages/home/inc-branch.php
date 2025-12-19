<?php
/**
 * Home – Branch section
 */

use ExtendSite\MetaBox\BranchMetaBox;
use ResidenceTheme\MetaBox\PageHome\Tabs\BranchTab;

defined('ABSPATH') || exit;

$data = BranchTab::get(get_the_ID());

$limit = !empty($data['limit']) ? (int)$data['limit'] : 10;
$orderby = !empty($data['orderby']) ? $data['orderby'] : 'menu_order';
$order = !empty($data['order']) ? $data['order'] : 'ASC';

$branch_query = new WP_Query([
    'post_type' => 'branch',
    'post_status' => 'publish',
    'posts_per_page' => $limit,
    'orderby' => $orderby, // ID | menu_order | date | title
    'order' => $order,
    'no_found_rows' => true,
    'fields' => 'ids',
]);

$branch_ids = $branch_query->posts;

if ( empty( $branch_ids ) ) {
    return;
}

$title = ! empty( $data['title'] ) ? $data['title'] : esc_html__( 'Các Chi Nhánh', 'residence' );
$url = ! empty( $data['archive_url'] ) ? $data['archive_url'] : '';
?>
<section class="section sec-homeChiNhanh" id="id-chinhanh">
    <div class="item-duan">
        <div class="item-duan__sticky">
            <div class="item-duan__group">
                <div class="item-duan__head wow fadeInUp">
                    <h3>
                        <?php echo esc_html( $title ); ?>
                    </h3>

                    <div>
                        <a href="<?php echo esc_url( $url ) ?>" class="f-btn">
                            <?php esc_html_e('giới thiệu chung', 'residence'); ?>
                        </a>
                    </div>
                </div>

                <div class="item-duan__list">
                    <div class="item-duan__listScroll">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php
                                $delay_step = 0.1;

                                foreach ($branch_ids as $index => $branch_id) :
                                    $title = get_the_title($branch_id);
                                    $link  = get_permalink($branch_id);

                                    // Featured image
                                    $thumb = get_the_post_thumbnail_url($branch_id, 'large');

                                    // Meta: số lượng căn hộ
                                    $branch_info = residence_get_opt(BranchMetaBox::class)?->get_post_meta_more_info($branch_id);
                                    $apartment_count = !empty($branch_info['number_of_apartments']) ? (int)$branch_info['number_of_apartments'] : 0;

                                    // WOW delay
                                    $delay = number_format(($index + 1) * $delay_step, 1);
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="chinhanhBox wow fadeInUp"
                                             data-wow-delay="<?php echo esc_attr($delay . 's'); ?>"
                                        >
                                            <div class="chinhanhBox__img">
                                                <?php if ($thumb) : ?>
                                                    <img
                                                        src="<?php echo esc_url($thumb); ?>"
                                                        alt="<?php echo esc_attr($title); ?>"
                                                        loading="lazy"
                                                    >
                                                <?php endif; ?>
                                            </div>

                                            <a href="<?php echo esc_url($link); ?>" class="chinhanhBox__body">
                                                <?php if ($apartment_count) : ?>
                                                    <p class="chinhanhBox__sub">
                                                        <?php
                                                        echo esc_html__(
                                                                'Số lượng căn hộ: ',
                                                                'residence'
                                                        ) . esc_html($apartment_count);
                                                        ?>
                                                    </p>
                                                <?php endif; ?>

                                                <h3 class="chinhanhBox__title">
                                                    <span><?php esc_html_e('Thái Hoàng', 'residence'); ?></span>
                                                    <span><?php echo esc_html($title); ?></span>
                                                </h3>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="swiper-btn wow fadeInUp d-xl-none">
                                <div class="btn-prev">
                                    <svg width="100%" viewBox="0 0 54 54" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="27" cy="27" r="27" transform="rotate(-180 27 27)" fill="#42525F"/>
                                        <path d="M15.688 28.6108L30.5483 40.1316C32.0731 41.4609 34.57 40.4557 34.57 38.5126L34.57 15.4695C34.57 13.5264 32.0748 12.5212 30.5483 13.8505L15.688 25.3713C14.6821 26.2481 14.6821 27.734 15.688 28.6108Z"
                                              fill="#F5F5F5"/>
                                    </svg>
                                </div>

                                <div class="btn-next">
                                    <svg width="100%" viewBox="0 0 54 54" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="27" cy="27" r="27" fill="#42525F"/>
                                        <path d="M38.315 25.3892L23.4546 13.8684C21.9298 12.5391 19.433 13.5443 19.433 15.4874V38.5305C19.433 40.4736 21.9282 41.4788 23.4546 40.1495L38.315 28.6287C39.3208 27.7519 39.3208 26.266 38.315 25.3892Z"
                                              fill="#F5F5F5"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ( ! empty( $branch_ids ) ) : ?>
            <?php foreach ( $branch_ids as $index => $branch_id ) : ?>
                <div class="f-point<?php echo $index === 0 ? ' active' : ''; ?>" data-index="<?php echo esc_attr( $index ); ?>"></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>