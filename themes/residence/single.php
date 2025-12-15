<?php get_header(); ?>

<div class="single-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-7 col-md-8">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        </header>

                        <div class="entry-thumbnail">
                            <?php the_post_thumbnail('full'); ?>
                        </div>

                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'residence' ),
                                'after'  => '</div>',
                            ) );
                            ?>
                        </div>
                    </article>
                <?php
                    endwhile;

                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                endif;
                ?>
            </div>

            <div class="col-12 col-sm-5 col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();