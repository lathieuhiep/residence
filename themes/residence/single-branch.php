<?php
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        get_template_part('template-parts/cpt-branch/inc', 'hero');
        ?>
        <section class="section sec-detailInfo" id="id-gioithieu">
            <div class="container">
                <?php
                get_template_part('template-parts/cpt-branch/inc', 'about');

                get_template_part('template-parts/cpt-branch/inc', 'room-type');
                ?>
            </div>
        </section>
    <?php
    endwhile;

    // Popover Book style 2
    get_template_part('template-parts/components/inc', 'popover-book', [
        'class' => 'style-2',
    ]);
endif;

get_footer();