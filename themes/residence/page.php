<?php get_header(); ?>

<div class="page-wrap">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php
                while ( have_posts() ) : the_post();
                    the_content();

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'residence' ),
                        'after'  => '</div>',
                    ) );
                endwhile;
                ?>
            </article>
        <?php
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        endif;
        ?>
    </div>
</div>

<?php
get_footer();