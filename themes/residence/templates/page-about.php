<?php
/**
 * Template Name: About Page
 * Template Post Type: page
 */

get_header();
?>
    <section class="section sec-bigBranch" id="id-gioithieu">
        <div class="container">
            <?php get_template_part('template-parts/pages/about/inc', 'general-info'); ?>

            <div class="item-vitri">
                <?php
                get_template_part('template-parts/pages/about/inc', 'highlights');
                get_template_part('template-parts/pages/about/inc', 'living-space');
                get_template_part('template-parts/pages/about/inc', 'operator');
                ?>
            </div>
        </div>
    </section>

    <?php
    get_template_part('template-parts/components/inc', 'branch-map');
    get_template_part('template-parts/pages/about/inc', 'included-services');
    ?>
<?php
get_footer();