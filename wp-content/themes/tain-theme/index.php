<?php
get_header();
?>
<?php
$current_language = pll_current_language();

$language_arr = [
    'en' => 'News', 
    'vi' => 'Tin tức', 
];

$txt_bread = $language_arr[$current_language];
?>
<?php echo do_shortcode('[custom_breadcrumbs last_breadcrumbs="' . $txt_bread . '"]'); ?>
<?php echo get_template_part('template-parts/tin-tuc/news/index');?>
    <?php 
    if (isMobileDevice()) {
        get_template_part('template-parts/tin-tuc/list-news-mb/index');
    } else {
        // get_template_part('template-parts/tin-tuc/brand-news/index');
    }
?>
<?php get_footer(); ?>
