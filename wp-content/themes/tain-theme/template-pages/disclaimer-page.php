<?php
/**
* Template Name: Disclaimer
* Template Post Type: page
* 
* Displays the Home test 123 Template of the theme.
*/

get_header();
?>
<?php
$current_language = pll_current_language();

$bread_arr = [
    'en' => 'Disclaimer', 
    'th' => 'ข้อสงวนสิทธิ์', 
    'zh' => '免责声明', 
    'ms' => 'Penafian'
];


$txt_bread = $bread_arr[$current_language];
?>
<?php echo do_shortcode('[custom_breadcrumbs last_breadcrumbs="' . $txt_bread . '"]'); ?>
<?php echo get_template_part('template-parts/disclaimer-page/index');?>

<?php get_footer(); ?>
