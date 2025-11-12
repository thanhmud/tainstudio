<?php
$current_language = pll_current_language();
$banner_content = get_field('banner_content');

$language_arr = [
    'en' => 'About us', 
    'vi' => 'Về chúng tôi', 
];

$txt_bread = $language_arr[$current_language];
?>

<section class="section-banner section">
    <div class="section-container container">
        <div class="banner-main">
            <?php echo $banner_content ?>
        </div>
    </div>
</section>
<?php echo do_shortcode('[custom_breadcrumbs last_breadcrumbs="' . $txt_bread . '"]'); ?>
