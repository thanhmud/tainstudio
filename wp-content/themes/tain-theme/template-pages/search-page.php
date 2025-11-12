<?php
/**
* Template Name: Search Page
* Template Post Type: page
* 
* Displays the Home test 123 Template of the theme.
*/

get_header();
?>
<?php echo do_shortcode('[custom_breadcrumbs last_breadcrumbs="Search"]'); ?>
<?php echo get_template_part('template-parts/search-page/index');?>

<?php get_footer(); ?>
