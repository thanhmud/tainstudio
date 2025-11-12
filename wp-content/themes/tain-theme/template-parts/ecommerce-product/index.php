<?php
// $imgBanner = isMobileDevice() ? get_field('image_banner_mobile') : get_field('image_banner_pc');
// $textBanner = get_field('text_banner');
$current_language = pll_current_language();


$language_arr = [
    'en' => 'About us', 
    'th' => 'เกี่ยวกับเรา', 
    'zh' => '关于我们', 
    'ms' => 'Tentang kami'
];

// $txt_bread = $language_arr[$current_language];
?>
<section class="product-ecommerce pd-50-0">
	 <div class="title wow fadeInDown">
        <h2 class="text-center color-gradient-blue ">E-commerce</h2>
    </div>
    <div class="ecommerce-main text-center">
        <div class="button text-center mt-30 wow fadeIn">
            <span class="button-1">
              <?php echo wp_get_attachment_image(1539, 'full', true, array('class' => 'image active', 'rel' => 'https://shopee.vn')); ?>
            </span>
            <span class="button-2">
              <?php echo wp_get_attachment_image(1500, 'full', true, array('class' => 'image', 'rel' => 'https://lazada.vn')); ?>
            </span>
        </div>
        <p class="ecommerce-banner text-center mt-40 wow shake">
            <?php echo wp_get_attachment_image(1522, 'full', true, array('class' => 'banner')); ?>
        </p>
        <h3 class="title color-gradient-blue mt-50 uppercase wow fadeInUp">Unigrow formula milk</h3>
        <span class="mt-20 wow fadeInUp">UNIGROW promotes optimal height growth with a specialized formula that strengthens bones and enhances physical development.</span><br>
        <button type="" class="btn btn-visit yellow-button text-white mt-30 wow fadeInUp"><a href="https://shopee.vn">Visit store</a></button>
    </div>
</section>
