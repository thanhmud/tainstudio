<?php
/**
* Template Name: Privacy Policy
* Template Post Type: page
* 
* Displays the Home test 123 Template of the theme.
*/

get_header();
?>
<?php
$current_language = pll_current_language();

$bread_arr = [
    'en' => 'Privacy Policy', 
    'th' => 'นโยบายความเป็นส่วนตัว', 
    'zh' => '隐私政策', 
    'ms' => 'Dasar Privasi'
];

$txt_bread = $bread_arr[$current_language];
?>
<?php echo do_shortcode('[custom_breadcrumbs last_breadcrumbs="' . $txt_bread . '"]'); ?>
<?php echo get_template_part('template-parts/privacy-page/index');?>

<?php get_footer(); ?>
