<?php
// Gọi header của theme
get_header();
// Gọi template part cho phần single-product
echo get_template_part('template-parts/single-product/index');
echo get_template_part('template-parts/comment/index');
echo get_template_part('template-parts/front-page/section-best-deal/index');
echo get_template_part('template-parts/ecommerce-product/index');
// $current_language = pll_current_language(); 

// $language_arr = [
//     'en' => 'Selling Products', 
//     'th' => 'ผลิตภัณฑ์ขายดี', 
//     'zh' => '销售产品', 
//     'ms' => 'Menjual Produk'
// ];

// $title = $language_arr[$current_language]; 
// echo do_shortcode('[selling_products_section title="' . esc_attr($title) . '" hide_link="true"]');
// $img_qc = get_field('img_commercial','option');
// echo wp_get_attachment_image($img_qc, 'full', true, array('class' => 'img_commercial'));
// echo wp_get_attachment_image(1060, 'full', true, array('class' => 'bg-wave-pd-top'));
// echo wp_get_attachment_image(1060, 'full', true, array('class' => 'bg-wave-pd'));
// Gọi footer của theme
get_footer();
?>