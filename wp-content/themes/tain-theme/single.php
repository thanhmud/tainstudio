<?php
// Gọi header của theme
get_header();
echo get_template_part('template-parts/single-post/index');
$current_language = pll_current_language(); 

$language_arr = [
    'en' => 'Recommended products', 
    'vi' => 'Sản phẩm được đề xuất', 
];

// $title = $language_arr[$current_language]; 
echo do_shortcode('[selling_products_section title="' . esc_attr($title) . '" hide_link="true"]');

echo wp_get_attachment_image(1060, 'full', true, array('class' => 'bg-wave-pd-bottom'));
echo wp_get_attachment_image(1069, 'full', true, array('class' => 'bg-wave-pd-bottom mobile'));
get_footer();
?>