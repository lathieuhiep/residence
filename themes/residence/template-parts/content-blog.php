<div class="content-blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-7 col-md-8">
                <?php if ( have_posts() ) : ?>
                    <div class="blog-list">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <div id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
                                <div class="thumbnail">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>

                                <h2 class="title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                                </h2>

                                <div class="content">
                                    <?php
                                    if (has_excerpt()) :
                                        the_excerpt();
                                    else :
                                        the_content();
                                    endif;
                                    ?>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                <?php
                    residence_pagination_custom();
                else:
                    get_template_part('template-parts/content', 'none');
                endif;
                ?>
            </div>

            <div class="col-12 col-sm-5 col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>