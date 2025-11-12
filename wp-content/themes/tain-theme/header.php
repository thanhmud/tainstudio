<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php 
    if (isMobileDevice()) {
        get_template_part('template-parts/header/header-mb');
    } else {
        get_template_part('template-parts/header/header');
    }
    ?>
    <main id="main" class="main">