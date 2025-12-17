<?php

use ExtendSite\Helpers\ESHelpers;

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        $post_id = get_the_ID();

        error_log('Loading branch post ID: ' . $post_id);
        ESHelpers::get_template_part('branch/parts/about', ['post_id' => $post_id]);
    endwhile;
endif;

get_footer();