<?php

$current_language = pll_current_language();
$gallery = get_field('gallery');

$name_product = get_the_title();
$original_price = get_field('Original_Price') ?? 0;
$sale_price = get_field('Sale_Price') ?? 0;
if ($original_price > 0) {
    $discount_percentage = (($original_price - $sale_price) / $original_price) * 100;
    $discount_percentage = round($discount_percentage, 2); // Round to 2 decimal places
} else {
    $discount_percentage = 0; // Handle case where original price is zero or not set
}
$capacity = get_field('capacity') ?? 0;
$short_desc = get_field('short_desc') ?? '';

$gift = get_field('gift');

if ($gift) {
    $gift_id = $gift->ID;
	
    $gift_title = get_the_title($gift_id);
    $gift_name = get_field('name_product_gift', $gift_id);
    $gift_time_start = get_field('start_date', $gift_id);
    $gift_time_end = get_field('end_date', $gift_id);
    $gift_price = get_field('price_product_gift', $gift_id);
    $tag_gift = get_field('tag_gift', $gift_id);
    $gift_img = get_post_thumbnail_id($gift_id, 'full');
} else {
    // Handle the case where $gift is not an object or does not have an ID
    $gift_id = null;
    $gift_title = 'Default Title';
    $gift_name = 'Default Name';
    $gift_time_start = 'Default Start Date';
    $gift_time_end = 'Default End Date';
    $gift_price = 'Default Price';
    $tag_gift = 'Default Tag';
    $gift_img = 776;
}

$link_shop = get_field('link_shoppe');

$target = $link_shop['target'] ?? '';
$url = $link_shop['url'] ?? '';

$offer = get_field('offers_product');

$title_introduction = get_field('title_introduction');
$desc_introduction = get_field('desc_introduction');
$title_Ingredients = get_field('title_Ingredients');
$desc_Ingredients = get_field('desc_Ingredients');
$title_user_guide = get_field('title_user_guide');
$desc_user_guide = get_field('desc_user_guide');

$currency_arr = [
    'en' => ['$', 'Product', '/products', 'Comment', 'Capacity', '0 $', 'Buy now', 'Effective from', 'Free shipping', 'nationwide', 'Guaranteed', 'genuine products', 'Order Support', 'Hotline 24/7', 'Open box', 'check on delivery'], 
    'th' => ['฿', 'ผลิตภัณฑ์', '/th/products/', 'ความคิดเห็น', 'ความจุ', '0 ฿', 'ซื้อเลยตอนนี้', 'มีผลใช้บังคับตั้งแต่', 'จัดส่งฟรี', 'ทั่วประเทศ', 'สินค้ารับประกัน', 'ของแท้', 'การสนับสนุนการสั่งซื้อ', 'สายด่วน 24/7', 'เปิดกล่อง', 'ตรวจสอบการจัดส่ง'],  
    'zh' => ['¥', '产品', '/zh/products/', '评论', '容量', '0 ¥', '立即购买', '生效日期', '免运费', '全国', '保证', '正品'], 
    'ms' => ['RM', 'Produk', '/ms/products/', 'Ulasan', 'Kapasiti', '0 RM', 'Beli sekarang', 'Berkesan dari', 'Penghantaran percuma', 'seluruh negara', 'Dijamin', 'produk tulen']
];

$currency_symbol = $currency_arr[$current_language][0];

if ($sale_price > 0) $sale_price = number_format($sale_price, 0, ',', '.');
else $sale_price = 0;

if ($original_price > 0) $original_price = number_format($original_price, 0, ',', '.');
else $original_price = 0;

$formatted_sale_price = $currency_symbol . $sale_price;
$formatted_original_price = $currency_symbol . $original_price;

// current link post
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
// Lấy tên miền
$domain = $_SERVER['HTTP_HOST'];
// Lấy đường dẫn
$path = $_SERVER['REQUEST_URI'];
// Kết hợp tất cả để tạo URL đầy đủ
$currentUrl = $protocol . $domain . $path;
//bread
$current_language = pll_current_language();
$txt_bread = $currency_arr[$current_language][1];
$txt_bread_link = $currency_arr[$current_language][2];

?>

<section class="detail_product">
    <!-- title link text -->
    <?php echo do_shortcode('[custom_breadcrumbs mid_breadcrumbs="' . esc_attr($txt_bread_link) . '|' . esc_attr($txt_bread) . '" last_breadcrumbs="' . $name_product . '"]'); ?>
    <div class="container sigle_product-container">
        <!-- content -->
        <div class="product_details_content">
            <div class="product_details_content-left">
                <div class="product_details_slide_img swiper-container gallery-top" style="position: relative">
                    <div class="swiper-wrapper">
                        <?php
                        if ($gallery):
                            foreach ($gallery as $image): ?>
                                <div class="swiper-slide">
                                    <?php echo wp_get_attachment_image($image, 'large', true); ?>
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

                <div class="product_details_slide_img swiper-container gallery-thumbs">
                    <div class="swiper-wrapper">
                        <?php
                        if ($gallery):
                            foreach ($gallery as $image): ?>
                                <div class="swiper-slide">
                                    <?php echo wp_get_attachment_image($image, 'thumbnail', true); ?>
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>
            <div class="product_details_content-right">
                <h1 class="subheading-1-1 title_heading1 color-gradient-blue color-blue">
                    <?php echo $name_product ?>
                </h1>
                <!-- vote product detail-->
                <div class="vote_product">
                    <?php
                    $original_post_id = pll_get_post(get_the_ID(), 'en'); // Get the ID of the original post (English)

                    // Fetch comments for both the original and the translated post
                    $comments_original = get_comments(array('post_id' => $original_post_id));
                    $comments_translated = get_comments(array('post_id' => get_the_ID()));

                    // Combine comments from both posts, ensuring no duplicates
                    $comments = array_merge($comments_original, $comments_translated);
                    $comments = array_unique($comments, SORT_REGULAR);

                    // Initialize variables for calculations
                    $total_rating = 0;
                    $total_comments = 0;
                    $star_counts = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0);

                    // Calculate total ratings and star counts
                    foreach ($comments as $comment) {
                        if ($comment->comment_parent == 0) { // Only consider top-level comments
                            $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
                            if ($rating >= 1 && $rating <= 5) {
                                $total_rating += $rating;
                                $star_counts[$rating]++;
                                $total_comments++;
                            }
                        }
                    }

                    // Calculate average rating and star percentages
                    $average_rating = $total_comments > 0 ? $total_rating / $total_comments : 0;
                    $average_rating_percentage = ($average_rating / 5) * 100;

                    $star_percentages = array();
                    foreach ($star_counts as $stars => $count) {
                        $star_percentages[$stars] = $total_comments > 0 ? ($count / $total_comments) * 100 : 0;
                    }
                    ?>
					<a href="#rating-product">
						<p><?php echo number_format($average_rating, 1); ?></p>
						<div class="average-comment-star-details">
							<div class="average-star-rating-details">
								<div class="average-star-rating-details" style="width: <?php echo $average_rating_percentage; ?>%;"></div>
							</div>
						</div>
					</a>
                    
                    <div class="hrVote"></div>
					<a href="#comment-info">
                    <p><?php echo $total_comments; ?></p>
                    <span class="subheading-1-6"><?php echo $currency_arr[$current_language][3]; ?></span>
					</a>
                </div>
                <!-- price product detail -->
                <div class="wrap_price_share">
                    <div class="price_product">
                        <p class="price_main"><?php echo $formatted_sale_price ?></p>
                        <p class="price_sub"><?php echo $formatted_original_price ?></p>
                        <p class="price_discount"> (-<?php echo  $discount_percentage ?>%) </p>
                    </div>
				<div class="tooltip_share_product">
					<div id="toggle_ToolTip_Url_Prd" class="share_icon_details">
                        <svg
                            width="100%"
                            height="100%"
                            viewBox="0 0 18 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.96889 11.359L12.04 14.941M12.0311 5.059L5.96889 8.641M17 3.7C17 5.19117 15.8061 6.4 14.3333 6.4C12.8606 6.4 11.6667 5.19117 11.6667 3.7C11.6667 2.20883 12.8606 1 14.3333 1C15.8061 1 17 2.20883 17 3.7ZM6.33333 10C6.33333 11.4912 5.13943 12.7 3.66667 12.7C2.19391 12.7 1 11.4912 1 10C1 8.50883 2.19391 7.3 3.66667 7.3C5.13943 7.3 6.33333 8.50883 6.33333 10ZM17 16.3C17 17.7912 15.8061 19 14.3333 19C12.8606 19 11.6667 17.7912 11.6667 16.3C11.6667 14.8088 12.8606 13.6 14.3333 13.6C15.8061 13.6 17 14.8088 17 16.3Z"
                                stroke="#222222"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
					<div class="tooltip_link_product">
						<input type="text" value="<?php echo $currentUrl; ?>"/>
						<button onclick="HandleCoppyUrlProduct()">copied</button>
					</div>
				</div>                 
                </div>
                <!-- capacity -->
                <div class="capacity"><?php echo $currency_arr[$current_language][4]; ?> <?php echo $capacity ?></div>
                <!-- list textarea -->
                <div class="list_textarea bodytext-3">
                    <?php echo $short_desc ?>
                </div>
                <!-- present -->
                <!-- <div class="prdDetails_wrapper_present">
                    <div class="prdDetails_wrapper_present-top">
                        <div class="present_flex_item">
                            <?php echo wp_get_attachment_image(193, 'full', true, array('class' => 'present_img')); ?>
                            <h5 class="title_present">
                                <?php echo $gift_title ?>
                            </h5>
                        </div>
                        <div class="subheading-2-7 sub_title_present">
                            <?php echo $currency_arr[$current_language][7]; ?> <?php echo $gift_time_start ?> - <?php echo $gift_time_end ?>
                        </div>
                    </div>
                    <div class="prdDetails_wrapper_present-bottom">
                        <div class="wrap_gift_cup">
                            <?php echo wp_get_attachment_image($gift_img, 'full', true, array('class' => 'gift_cup')); ?>
                            <div class="title_present_cup">
                                <p class="title_gift_cup"><?php echo $gift_name ?></p>
                                <div class="sub_title_gift_cup">
                                    <p class="subheading-2-5"> <?php echo $currency_arr[$current_language][5]; ?> <span>(<?php echo $gift_price ?>)</span></p>
                                    <button type="button" class="bodytext-5">
                                        Free gift
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- button buy now -->

                <a class="productDetail_btn_buyNow" target="<?php echo $target; ?>" href="<?php echo $url; ?>">
                    <?php echo $currency_arr[$current_language][6]; ?>
                </a>
                <!-- free ship and partnership -->
                <div class="productDetail_flex_freeship">
                    <?php if ($offer): ?>
                        <?php foreach ($offer as $item): ?>
                            <div class="sub_flex_item sub_freeShip mb-10">
                                <div class="icon_oto_ship">
                                    <?php echo wp_get_attachment_image($item['icon'], 'large', true); ?>
                                </div>
                                <?php echo $item['name'] ?>
                            </div>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <div class="sub_flex_item sub_freeShip mb-10">
                            <div class="icon_oto_ship">
                                <?php echo wp_get_attachment_image(1537, 'large', true); ?>
                            </div>
                            <h6>
                                <?php 
                                    echo $currency_arr[$current_language][8] . ' ' . '<span>' . $currency_arr[$current_language][9] . '</span>';
                                ?>
                            </h6>
                        </div>
                        <div class="sub_flex_item sub_freeShip mb-10">
                            <div class="icon_oto_ship">
                                <?php echo wp_get_attachment_image(1537, 'large', true); ?>
                            </div>
                            <h6>
                                <?php
                                    echo '<span>' . $currency_arr[$current_language][12] . '</span> ' . $currency_arr[$current_language][13] . '';
                                ?>
                            </h6>
                        </div>
                        <div class="sub_flex_item sub_freeShip mb-10">
                            <div class="icon_oto_ship">
                                <?php echo wp_get_attachment_image(1537, 'large', true); ?>
                            </div>
                            <h6>
                                <?php
                                    echo '<span>' . $currency_arr[$current_language][10] . '</span> ' . $currency_arr[$current_language][11] . '';
                                ?>
                            </h6>
                        </div>
                        <div class="sub_flex_item sub_freeShip mb-10">
                            <div class="icon_oto_ship">
                                <?php echo wp_get_attachment_image(1537, 'large', true); ?>
                            </div>
                            <h6>
                                <?php
                                    echo $currency_arr[$current_language][14] . ' ' . '<span>' . $currency_arr[$current_language][15] . '</span>';
                                ?>
                            </h6>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- content introduce product details -->
		<?php if(!isMobileDevice()): ?>
        <div class="introduce_product_details">
            <div class="wrap_btn_introduce">
                <div class="list_btn">
                    <button
                        type="button"
                        data-target="content_introduction"
                        class="subheading-2-5 active">
                        <?php echo $title_introduction ?>
                    </button>
                    <button
                        type="button"
                        data-target="content_ingredients"
                        class="subheading-2-5">
                        <?php echo $title_Ingredients ?>
                    </button>
                    <button
                        type="button"
                        data-target="content_userguide"
                        class="subheading-2-5">
                        <?php echo $title_user_guide ?>
                    </button>
                </div>
            </div>
            <div class="prdDetails_wrapper_content">
                <div
                    id="content_introduction"
                    class="product_detail_contentBtn active">
                    <?php echo $desc_introduction ?>
                </div>
                <div id="content_ingredients" class="product_detail_contentBtn">
                    <?php echo $desc_Ingredients ?>
                </div>
                <div id="content_userguide" class="product_detail_contentBtn">
                    <?php echo $desc_user_guide ?>
                </div>
            </div>
        </div>
		<?php else: ?>
		<div class="introduce_product_details mobile">
			<div class="accordion">
			  <div class="accordion-item">
				<button class="accordion-header active"><?php echo $title_introduction ?></button>
				<div class="accordion-content">
				  <?php echo $desc_introduction ?>
				</div>
			  </div>

			  <div class="accordion-item">
				<button class="accordion-header"><?php echo $title_Ingredients ?></button>
				<div class="accordion-content">
					<?php echo $desc_Ingredients ?>
				</div>
			  </div>

			  <div class="accordion-item">
				<button class="accordion-header"><?php echo $title_user_guide ?></button>
				<div class="accordion-content">
					<?php echo $desc_user_guide ?>
				</div>
			  </div>
			</div>
		</div>	
		<?php endif; ?>
    </div>
	<div  id="rating-product"></div>
</section>