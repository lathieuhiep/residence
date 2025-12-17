<?php
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        $post_id = get_the_ID();

        get_template_part('template-parts/cpt-branch/inc', 'about', ['post_id' => $post_id]);
    endwhile;
endif;

get_footer();