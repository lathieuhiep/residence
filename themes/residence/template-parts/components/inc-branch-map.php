<?php
/**
 * Branch map section
 *
 * Hiển thị map + danh sách chi nhánh
 */

use ExtendSite\MetaBox\BranchMetaBox;

defined('ABSPATH') || exit;

// Enqueue Leaflet assets
wp_enqueue_style(
    'leaflet',
    'https://unpkg.com/leaflet/dist/leaflet.css',
    [],
    '1.9.4'
);

wp_enqueue_script(
    'leaflet',
    'https://unpkg.com/leaflet/dist/leaflet.js',
    [],
    '1.9.4',
    true
);

// Enqueue branch map script
wp_enqueue_script('branch-map', get_theme_file_uri('/assets/js/branch-map.js'), ['leaflet'], wp_get_theme()->get('Version'), true);

// Get branch data
$branches = [];

$args = [
    'post_type' => 'branch',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'no_found_rows' => true,
];

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();

        $post_id = get_the_ID();
        $map = residence_get_opt(BranchMetaBox::class)?->get_post_meta_map($post_id);

        $lat  = (float) $map['lat'];
        $lng  = (float) $map['lng'];

        if (! $lat || ! $lng) {
            continue;
        }

        $branches[] = [
            'id'   => $post_id,
            'name' => get_the_title(),
            'addr' => (string) $map['address'],
            'lat'  => $lat,
            'lng'  => $lng,
            'zoom' => (int) $map['zoom'],
        ];
    }

    wp_reset_postdata();
}

if (empty($branches)) {
    return;
}

$branches_json = wp_json_encode($branches, JSON_UNESCAPED_UNICODE);
?>
<section class="section sec-mapChiNhanh" id="id-chinhanh">
    <div class="container">
        <h2 class="titlebox__title fz-80 d-xl-none wow fadeInUp">
            <?php esc_html_e('List các chi nhánh', 'residence'); ?>
        </h2>

        <div class="row">
            <div class="col-xl-7 order-xl-2">
                <div id="map"
                     class="item-map wow fadeInUp"
                     data-branches='<?php echo esc_attr($branches_json); ?>'></div>
            </div>

            <div class="col-xl-5 order-xl-1">
                <h2 class="titlebox__title d-none d-xl-block fz-80 wow fadeInUp">List các chi nhánh</h2>

                <div class="item-left">
                    <div id="branchList" class="item-list wow fadeInUp"></div>
                </div>
            </div>
        </div>
    </div>
</section>
