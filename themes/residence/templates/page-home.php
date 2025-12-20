<?php
/**
 * Template Name: Home Page
 * Template Post Type: page
 */

get_header();

get_template_part('template-parts/pages/home/inc', 'hero');
get_template_part('template-parts/pages/home/inc', 'about');
get_template_part('template-parts/pages/home/inc', 'branch');

get_footer();