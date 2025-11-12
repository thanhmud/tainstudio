<?php
get_header();
?>
<?php

$current_language = pll_current_language();

$language_arr = [
    'en' => 'Search', 
    'th' => 'ค้นหา', 
    'zh' => '搜索', 
    'ms' => 'Cari'
];
$txt_bread = $language_arr[$current_language];

?>
<?php echo do_shortcode('[custom_breadcrumbs last_breadcrumbs="' . $txt_bread . '"]'); ?>
<?php echo get_template_part('template-parts/search-page/index');?>

<?php get_footer(); ?>
