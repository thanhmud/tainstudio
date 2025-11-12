<?php

// ============================== start wp_enqueue lib =====================//
function wp_enqueue_lib()
{
    $version = '0.0.13';
    //js
    wp_enqueue_script('front-page', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', [], false, true);

    // aos
    wp_enqueue_style('aos', 'https://unpkg.com/aos@next/dist/aos.css');
    wp_enqueue_script("aos", "https://unpkg.com/aos@next/dist/aos.js", [], false, true);

    // swiper 
    wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script("swiper", "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js", [], false, true);

    wp_enqueue_style('fonts', get_theme_file_uri('/assets/fonts/stylesheet.css?v=' . $version));
}
add_action('wp_enqueue_scripts', 'wp_enqueue_lib', 1000);

// ============================== end wp_enqueue lib =====================//

// ============================== wp_enqueue lib =====================//
function wp_enqueue_local()
{
    $version = '0.0.13';
    //global
    wp_enqueue_style('global', get_theme_file_uri('/assets/css/global.css?v=' . $version));
    wp_enqueue_script('global', get_theme_file_uri('/assets/js/global.js?v=' . $version), [], false, true);

    //header
    wp_enqueue_style('header', get_theme_file_uri('/template-parts/header/assets/styles.css?v=' . $version));
    wp_enqueue_script('header', get_theme_file_uri('/template-parts/header/assets/scripts.js?v=' . $version), [], false, true);

    //footer
    wp_enqueue_style('footer', get_theme_file_uri('/template-parts/footer/assets/styles.css?v=' . $version));
    wp_enqueue_script('footer', get_theme_file_uri('/template-parts/footer/assets/scripts.js?v=' . $version), [], false, true);
    if (is_single()) {
        wp_enqueue_style('comment', get_theme_file_uri('/assets/css/comment.css?v=' . $version));
    }

    //ajax
    wp_localize_script('header', 'themeUrl', array(
        'url' => get_theme_file_uri(),
    ));
	
	wp_localize_script('header', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
    
	$current_language = pll_current_language();

    $language_arr = [
        'en' => '/?s=', 
        'vi' => '/vi?s=', 
    ];

	$langS = $language_arr[$current_language];

	wp_add_inline_script('header', 'const endPoint = ' . json_encode(array(
		'langS' => $langS
	)), 'before');
    
    //front-page
    if (is_front_page()) {
        //banner-frontpage
        wp_enqueue_style('banner-frontpage', get_theme_file_uri('/template-parts/front-page/banner-frontpage/assets/styles.css?v=' . $version));
        wp_enqueue_script('banner-frontpage', get_theme_file_uri('/template-parts/front-page/banner-frontpage/assets/script.js?v=' . $version), [], false, true);
        //section-we-have
        wp_enqueue_style('section-we-have', get_theme_file_uri('/template-parts/front-page/section-we-have/assets/styles.css?v=' . $version));
        wp_enqueue_script('section-we-have', get_theme_file_uri('/template-parts/front-page/section-we-have/assets/script.js?v=' . $version), [], false, true);
        //section-we-can
        wp_enqueue_style('section-we-can', get_theme_file_uri('/template-parts/front-page/section-we-can/assets/styles.css?v=' . $version));
        wp_enqueue_script('section-we-can', get_theme_file_uri('/template-parts/front-page/section-we-can/assets/script.js?v=' . $version), [], false, true);
        //section-project
        wp_enqueue_style('section-project', get_theme_file_uri('/template-parts/front-page/section-project/assets/styles.css?v=' . $version));
        wp_enqueue_script('section-project', get_theme_file_uri('/template-parts/front-page/section-project/assets/script.js?v=' . $version), [], false, true);
        //section-news
        wp_enqueue_style('section-news', get_theme_file_uri('/template-parts/front-page/section-news/assets/styles.css?v=' . $version));
        wp_enqueue_script('section-news', get_theme_file_uri('/template-parts/front-page/section-news/assets/script.js?v=' . $version), [], false, true);
        wp_enqueue_style('news-item', get_theme_file_uri('/assets/css/news-item.css?v=' . $version));
        //section-contact
        // wp_enqueue_style('section-contact', get_theme_file_uri('/template-parts/front-page/section-contact/assets/styles.css?v=' . $version));
        // wp_enqueue_script('section-contact', get_theme_file_uri('/template-parts/front-page/section-contact/assets/script.js?v=' . $version), [], false, true);
    }
    //archive-products
    if (is_post_type_archive('products')) {
        wp_enqueue_style('products-list', get_theme_file_uri('template-parts/archive-products/assets/styles.css?v=' . $version));
        wp_enqueue_script('products-list', get_theme_file_uri('template-parts/archive-products/assets/script.js?v=' . $version), [], false, true);

        wp_enqueue_style('products-ecommerce', get_theme_file_uri('template-parts/ecommerce-product/assets/styles.css?v=' . $version));
        wp_enqueue_script('products-ecommerce', get_theme_file_uri('template-parts/ecommerce-product/assets/script.js?v=' . $version), [], false, true);
    }
    //about-us
    if (is_page('about-us') || is_page('about-us-th')) {
        //bannner about-us
        wp_enqueue_style('banner-about-us', get_theme_file_uri('template-parts/about-us/banner-about-us/assets/styles.css?v=' . $version));
        wp_enqueue_script('banner-about-us', get_theme_file_uri('template-parts/about-us/banner-about-us/assets/script.js?v=' . $version), [], false, true);
        //info brand
        wp_enqueue_style('section-info-brand', get_theme_file_uri('template-parts/about-us/section-info-brand/assets/styles.css?v=' . $version));
        wp_enqueue_script('section-info-brand', get_theme_file_uri('template-parts/about-us/section-info-brand/assets/script.js?v=' . $version), [], false, true);
        //core-value
        wp_enqueue_style('section-core-value', get_theme_file_uri('template-parts/about-us/section-core-value/assets/styles.css?v=' . $version));
        wp_enqueue_script('section-core-value', get_theme_file_uri('template-parts/about-us/section-core-value/assets/script.js?v=' . $version), [], false, true);
    }
    //contact
    if (is_page('contact') || is_page('contact-th')) {
        //bannner about-us
        wp_enqueue_style('contact', get_theme_file_uri('template-parts/contact-page/assets/styles.css?v=' . $version));
        wp_enqueue_script('contact', get_theme_file_uri('template-parts/contact-page/assets/script.js?v=' . $version), [], false, true);
    }
    //service
    if (is_page('service')) {
        //service
        wp_enqueue_style('service', get_theme_file_uri('template-parts/service-page/assets/styles.css?v=' . $version));
        wp_enqueue_script('service', get_theme_file_uri('template-parts/service-page/assets/script.js?v=' . $version), [], false, true);
    }
    wp_enqueue_style('section-we-can', get_theme_file_uri('/template-parts/front-page/section-we-can/assets/styles.css?v=' . $version));
    wp_enqueue_script('section-we-can', get_theme_file_uri('/template-parts/front-page/section-we-can/assets/script.js?v=' . $version), [], false, true);
    //hosting
    if (is_page('hosting')) {
        //hosting
        wp_enqueue_style('hosting', get_theme_file_uri('template-parts/hosting-page/assets/styles.css?v=' . $version));
        wp_enqueue_script('hosting', get_theme_file_uri('template-parts/hosting-page/assets/script.js?v=' . $version), [], false, true);
    }
    //domain
    if (is_page('domain')) {
        //service
        wp_enqueue_style('domain', get_theme_file_uri('template-parts/domain-page/assets/styles.css?v=' . $version));
        wp_enqueue_script('domain', get_theme_file_uri('template-parts/domain-page/assets/script.js?v=' . $version), [], false, true);
    }
    //privacy
    if (is_page('privacy-policy') || is_page('privacy-policy-th')) {
        //bannner about-us
        wp_enqueue_style('privacy-page', get_theme_file_uri('template-parts/privacy-page/assets/styles.css?v=' . $version));
        wp_enqueue_script('privacy-page', get_theme_file_uri('template-parts/privacy-page/assets/script.js?v=' . $version), [], false, true);
    }
    //disclaimer
    if (is_page('disclaimer') || is_page('disclaimer-th')) {
        //bannner about-us
        wp_enqueue_style('disclaimer', get_theme_file_uri('template-parts/disclaimer-page/assets/styles.css?v=' . $version));
        wp_enqueue_script('disclaimer', get_theme_file_uri('template-parts/disclaimer-page/assets/script.js?v=' . $version), [], false, true);
    }
	//404
    if (is_404()) {
        wp_enqueue_style('404-page', get_theme_file_uri('template-parts/404-page/assets/styles.css?v=' . $version));
        wp_enqueue_script('404-page', get_theme_file_uri('template-parts/404-page/assets/script.js?v=' . $version), [], false, true);
    }
    //blog
    if (is_home()) {
        //news
        wp_enqueue_style('section-news', get_theme_file_uri('template-parts/tin-tuc/news/assets/styles.css?v=' . $version));
        wp_enqueue_script('section-news', get_theme_file_uri('template-parts/tin-tuc/news/assets/script.js?v=' . $version), [], false, true);
        //brand-news
        wp_enqueue_style('brand-news', get_theme_file_uri('template-parts/tin-tuc/brand-news/assets/styles.css?v=' . $version));
        wp_enqueue_script('brand-news', get_theme_file_uri('template-parts/tin-tuc/brand-news/assets/script.js?v=' . $version), [], false, true);
		//mb
		 wp_enqueue_style('brand-news-mb', get_theme_file_uri('template-parts/tin-tuc/list-news-mb/assets/styles.css?v=' . $version));
		wp_enqueue_script('brand-news-mb', get_theme_file_uri('template-parts/tin-tuc/list-news-mb/assets/script.js?v=' . $version), [], false, true);
	}
    //danh-muc-tin-tuc
    if (is_category()) {
        wp_enqueue_style('taxonomy-category', get_theme_file_uri('template-parts/taxonomy-category/assets/styles.css?v=' . $version));
        wp_enqueue_script('taxonomy-category', get_theme_file_uri('template-parts/taxonomy-category/assets/script.js?v=' . $version), [], false, true);
    }
    //danh-muc-san-pham
    if (is_tax('category-product')) {
        wp_enqueue_style('taxonomy-products', get_theme_file_uri('template-parts/taxonomy-products/assets/styles.css?v=' . $version));
        wp_enqueue_script('taxonomy-products', get_theme_file_uri('template-parts/taxonomy-products/assets/script.js?v=' . $version), [], false, true);
    }
    //single-product
    if (is_singular('products')) {
        wp_enqueue_style('product-commnet', get_theme_file_uri('/template-parts/comment/assets/styles.css?v=' . $version));
        wp_enqueue_script("product-comment", get_theme_file_uri('/template-parts/comment/assets/script.js?v=' . $version), [], false, true);
        wp_enqueue_style('product-details', get_theme_file_uri('/template-parts/single-product/assets/styles.css?v=' . $version));
        wp_enqueue_script("product-details", get_theme_file_uri('/template-parts/single-product/assets/script.js?v=' . $version), [], false, true);
        wp_enqueue_style('product-item', get_theme_file_uri('/assets/css/products.css?v=' . $version));
        wp_enqueue_style('selling-products-component', get_theme_file_uri('/assets/css/selling-products-component.css?v=' . $version));
        wp_enqueue_script('selling-products-component', get_theme_file_uri('/assets/js/selling-products-component.js?v=' . $version), [], false, true);

        //product ecommerce
        wp_enqueue_style('products-ecommerce', get_theme_file_uri('template-parts/ecommerce-product/assets/styles.css?v=' . $version));
        wp_enqueue_script('products-ecommerce', get_theme_file_uri('template-parts/ecommerce-product/assets/script.js?v=' . $version), [], false, true);

        //best deal
        wp_enqueue_style('best-deal', get_theme_file_uri('template-parts/front-page/section-best-deal/assets/styles.css?v=' . $version));
        wp_enqueue_script('best-deal', get_theme_file_uri('template-parts/front-page/section-best-deal/assets/script.js?v=' . $version), [], false, true);
    }
    //search-page
    if (is_search()) {
        wp_enqueue_style('search', get_theme_file_uri('/template-parts/search-page/assets/styles.css?v=' . $version));
        wp_enqueue_script("search", get_theme_file_uri('/template-parts/search-page/assets/script.js?v=' . $version), [], false, true);
        wp_enqueue_style('news-item', get_theme_file_uri('/assets/css/news-item.css?v=' . $version));
    }
    //posts
    if (is_single()) {
        wp_enqueue_style('search', get_theme_file_uri('/template-parts/single-post/assets/styles.css?v=' . $version));
        wp_enqueue_script("search", get_theme_file_uri('/template-parts/single-post/assets/script.js?v=' . $version), [], false, true);
		//product 
        wp_enqueue_style('product-item', get_theme_file_uri('/assets/css/products.css?v=' . $version));
		wp_enqueue_style('selling-products-component', get_theme_file_uri('/assets/css/selling-products-component.css?v=' . $version));
        wp_enqueue_script('selling-products-component', get_theme_file_uri('/assets/js/selling-products-component.js?v=' . $version), [], false, true);
    }
}
add_action('wp_enqueue_scripts', 'wp_enqueue_local', 1001);

// ============================== wp_enqueue lib =====================//