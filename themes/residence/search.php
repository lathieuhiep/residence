<?php
get_header();

if ( have_posts() ) :
?>
    <header class="page-header">
        <h1 class="page-title">
            <?php
            printf(
                esc_html__( 'Kết quả tìm kiếm cho: %s', 'residence' ),
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h1>
    </header>

    <div class="search-results">
        <?php
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content', 'search' );

        endwhile;
        wp_reset_postdata();

        the_posts_navigation();
        ?>
    </div>
<?php else : ?>
    <section class="no-results not-found">
        <h2><?php esc_html_e( 'Không tìm thấy kết quả nào.', 'residence' ); ?></h2>
        <p><?php esc_html_e( 'Thử lại với từ khóa khác.', 'residence' ); ?></p>

        <?php get_search_form(); ?>
    </section>
<?php
endif;

get_footer();