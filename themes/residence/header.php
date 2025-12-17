<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>" />

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="page-wrapper"><!-- open div.page-wrapper -->
    <?php
    if ( !is_404() ) :
        // Loading Screen
        get_template_part('template-parts/loading/loader');

        // Primary Navigation
        get_template_part('template-parts/navigation/menu', 'primary');

        // Mobile Navigation
        get_template_part('template-parts/navigation/menu', 'mobile');
    endif;
    ?>

    <main class="page-content"><!-- open main.page-content -->
