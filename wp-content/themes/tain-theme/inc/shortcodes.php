<?php
function custom_breadcrumbs_shortcode($atts)
{
    // Thiết lập giá trị mặc định cho các thuộc tính của shortcode
    $atts = shortcode_atts(
        array(
            'mid_breadcrumbs' => '',
            'last_breadcrumbs' => '',
        ),
        $atts,
        'custom_breadcrumbs'
    );

    // Tạo HTML cho breadcrumbs
    $current_language = pll_current_language();

    $language_arr = [
        'en' => ['/en', 'Home'], 
        'vi' => ['/', 'Trang chủ'],  
    ];
    $html = '<div class="bread-crumbs container">';

        $html .= '<a class="icon_home" href="' . $language_arr[$current_language][0] . '">' . wp_get_attachment_image(54, 'full', true) . '<span class="txt_home">' . $language_arr[$current_language][1] . '</span></a>';

        // if ($current_language == 'en') {
        //  $html .= '<a class="icon_home" href="/">' . wp_get_attachment_image(54, 'full', true) . '<span class="txt_home">Home</span></a>';
        // } else {
        //  $html .= '<a class="icon_home" href="/th">' . wp_get_attachment_image(54, 'full', true) . '<span class="txt_home">หน้าแรก</span></a>';
        // }

    // Kiểm tra và xử lý các mid_breadcrumbs
    if (!empty($atts['mid_breadcrumbs'])) {
        $mid_breadcrumbs = explode(';', $atts['mid_breadcrumbs']);

        foreach ($mid_breadcrumbs as $index => $breadcrumb) {
            // Tách đường dẫn và văn bản ra khỏi phần tử
            list($url, $text) = explode('|', $breadcrumb);
            $html .= '<span class="space-bread">/</span>';
            $html .= '<a href="' . esc_url(trim($url)) . '" class="mid-breadcrumbs"><span>' . esc_html(trim($text)) . '</span></a>';
        }

        // Thêm dấu phân cách trước last_breadcrumbs nếu có mid_breadcrumbs
        $html .= '<span class="space-bread">/</span>';
    } else {
        // Nếu không có mid_breadcrumbs, thêm dấu phân cách trước last_breadcrumbs
        $html .= '<span class="space-bread">/</span>';
    }

    // Thêm breadcrumb cuối cùng
    $html .= '<div class="last-breadcrumbs"><span>' . esc_html($atts['last_breadcrumbs']) . '</span></div>';
    $html .= '</div>';

    return $html;
}
add_shortcode('custom_breadcrumbs', 'custom_breadcrumbs_shortcode');

//product item
function product_item_shortcode($atts)
{
    $current_language = pll_current_language();
    $details_text = ($current_language == 'en') ? 'View Details' :"Xem chi tiết";
    $buy_now_text = ($current_language == 'en') ? 'Buy now' :"Mua ngay";
    $atts = shortcode_atts(
        array(
            'image' => '',           // Image URL
            'permalink' => '',       // Link to the product page
            'alt' => '',             // Alt text for the image
            'name' => '',            // Product name
            'description' => '',     // Product description
            'rating' => 0,           // Star rating out of 5
            'price' => '',           // Current price
            'original_price' => '',  // Original price
            'discount' => '',        // Discount percentage
            'details_text' => $details_text, // Text for the details button
            'buy_now_text' => $buy_now_text, // Text for the details button
        ),
        $atts,
        'product_item'
    );

    // Ensure rating is within valid range
    $rating = max(0, min(5, floatval($atts['rating'])));

    // Generate the star rating as HTML
    $stars = floor($rating);
    $half_star = ($rating - $stars >= 0.5);
    $star_html = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $stars) {
            $star_html .= '<span class="full-star">★</span>';
        } elseif ($half_star && $i == $stars + 1) {
            $star_html .= '<span class="half-star">★</span>';
        } else {
            $star_html .= '<span class="empty-star">☆</span>';
        }
    }
    // Format the prices with thousands separators

    $language_arr = [
        'en' => ['$', 'Price'], 
        'vi' => ['đ', 'Giá'],  
    ];

    $currency_symbol = $language_arr[$current_language][0];
    $price_text = $language_arr[$current_language][1];

    $formatted_price = $currency_symbol . number_format(floatval($atts['price']), 0, ',', '.');
    $formatted_original_price = $currency_symbol . number_format(floatval($atts['original_price']), 0, ',', '.');
    // Generate the HTML output
    $output = '<div class="product_item" href="' . esc_url($atts['permalink']) . '" >';
    $output .= '<a class="bold" href="' . esc_url($atts['permalink']) . '"><div class="img_product">';
    $output .= '<img src="' . esc_url($atts['image']) . '" alt="' . esc_attr($atts['alt']) . '" width="100%" height="100%" />';
    $output .= '<div class="over_imgProduct"></div>';
    $output .= '</div>';
    $output .= '<div class="product_infor">';
    $output .= '<div class="name_product">' . esc_html($atts['name']) . '</div>';
    $output .= '<div class="s-desc-product">' . $atts['description'] . '</div>';
    $output .= '<div class="icon_vote">' . $star_html . '</div>';
    $output .= '<div class="price">';
    $output .= '<p class="price_text">' . $price_text . ': </p> ';
    $output .= '<p class="price_item">' . esc_html($formatted_price) . '</p>';
    if (!empty($atts['original_price'])) {
        $output .= '<p class="original_price_item">' . esc_html($formatted_original_price) . '</p>';
    }
    if (!empty($atts['discount'])) {
        $output .= '<p class="discount_item">(-' . esc_html($atts['discount']) . '%)</p>';
    }
    $output .= '</div>';
    $output .= '</div></a>';
    $output .= '<div class="action_button flex justify-content-around" >';
    $output .= '<span class="blue-button view-more"><a class="bold" href="' . esc_url($atts['permalink']) . '">' . esc_html($details_text) . '</a></span>';
    $output .= '<span class="yellow-button buy-now"><a class="bold" href="' . esc_url($atts['permalink']) . '">' . esc_html($buy_now_text) . '</a></span>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode('product_item', 'product_item_shortcode');

//item tin tức dọc
function item_new_vertical_shortcode($atts)
{
    // Define default attributes and merge with user-defined attributes
    $atts = shortcode_atts(array(
        'image_id' => '',
        'date' => '',
        'title' => '',
        'subtitle' => '',
        'permalink' => '', 
    ), $atts, 'item_new_vertical');

    // Output the HTML structure
    ob_start();
?>
    <a href="<?php echo esc_url($atts['permalink']); ?>" class="featured_news-item">
        <?php echo wp_get_attachment_image($atts['image_id'], 'full', false, array('class' => 'featured_news-img')); ?>
        <div class="featured_news-content">
            <!-- <div class="date_post_news">
                <?php echo wp_get_attachment_image(294, 'full', false, array('class' => 'icon')); ?>
                <span class="date"><?php echo esc_html($atts['date']); ?></span>
            </div> -->
            <div class="featured_news-title">
                <p class="title_heading">
                    <?php echo esc_html($atts['title']); ?>
                </p>
                <p class="sub_title">
                    <?php echo esc_html($atts['subtitle']); ?>
                </p>
            </div>
        </div>
    </a>
<?php
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('item_new_vertical', 'item_new_vertical_shortcode');

//item news ngang
function item_new_horizontal_shortcode($atts)
{
    // Define default attributes and merge with user-defined attributes
    $atts = shortcode_atts(array(
        'image_src_pc' => '',
        'date' => '',
        'title' => '',
        'permalink' => '#', // Default permalink
    ), $atts, 'item_new_horizontal');

    // Output the HTML structure
    ob_start();
?>
    <a href="<?php echo esc_url($atts['permalink']); ?>" class="latest_news-item">
        <?php echo wp_get_attachment_image($atts['image_src_pc'], 'full', true, array('class' => 'image_src_pc')); ?>
        <div class="latest_news-content">
            <!-- <div class="date_post_news">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none">
                  <path d="M7.125 13.5C7.42337 13.5 7.70952 13.3815 7.9205 13.1705C8.13147 12.9595 8.25 12.6734 8.25 12.375C8.25 12.0766 8.13147 11.7905 7.9205 11.5795C7.70952 11.3685 7.42337 11.25 7.125 11.25C6.82663 11.25 6.54048 11.3685 6.3295 11.5795C6.11853 11.7905 6 12.0766 6 12.375C6 12.6734 6.11853 12.9595 6.3295 13.1705C6.54048 13.3815 6.82663 13.5 7.125 13.5ZM13.125 12.375C13.125 12.6734 13.0065 12.9595 12.7955 13.1705C12.5845 13.3815 12.2984 13.5 12 13.5C11.7016 13.5 11.4155 13.3815 11.2045 13.1705C10.9935 12.9595 10.875 12.6734 10.875 12.375C10.875 12.0766 10.9935 11.7905 11.2045 11.5795C11.4155 11.3685 11.7016 11.25 12 11.25C12.2984 11.25 12.5845 11.3685 12.7955 11.5795C13.0065 11.7905 13.125 12.0766 13.125 12.375ZM16.875 13.5C17.1734 13.5 17.4595 13.3815 17.6705 13.1705C17.8815 12.9595 18 12.6734 18 12.375C18 12.0766 17.8815 11.7905 17.6705 11.5795C17.4595 11.3685 17.1734 11.25 16.875 11.25C16.5766 11.25 16.2905 11.3685 16.0795 11.5795C15.8685 11.7905 15.75 12.0766 15.75 12.375C15.75 12.6734 15.8685 12.9595 16.0795 13.1705C16.2905 13.3815 16.5766 13.5 16.875 13.5ZM8.25 16.875C8.25 17.1734 8.13147 17.4595 7.9205 17.6705C7.70952 17.8815 7.42337 18 7.125 18C6.82663 18 6.54048 17.8815 6.3295 17.6705C6.11853 17.4595 6 17.1734 6 16.875C6 16.5766 6.11853 16.2905 6.3295 16.0795C6.54048 15.8685 6.82663 15.75 7.125 15.75C7.42337 15.75 7.70952 15.8685 7.9205 16.0795C8.13147 16.2905 8.25 16.5766 8.25 16.875ZM12 18C12.2984 18 12.5845 17.8815 12.7955 17.6705C13.0065 17.4595 13.125 17.1734 13.125 16.875C13.125 16.5766 13.0065 16.2905 12.7955 16.0795C12.5845 15.8685 12.2984 15.75 12 15.75C11.7016 15.75 11.4155 15.8685 11.2045 16.0795C10.9935 16.2905 10.875 16.5766 10.875 16.875C10.875 17.1734 10.9935 17.4595 11.2045 17.6705C11.4155 17.8815 11.7016 18 12 18ZM21.75 18.375V5.625C21.75 4.72989 21.3944 3.87145 20.7615 3.23851C20.1286 2.60558 19.2701 2.25 18.375 2.25H5.625C4.72989 2.25 3.87145 2.60558 3.23851 3.23851C2.60558 3.87145 2.25 4.72989 2.25 5.625V18.375C2.25 19.2701 2.60558 20.1286 3.23851 20.7615C3.87145 21.3944 4.72989 21.75 5.625 21.75H18.375C19.2701 21.75 20.1286 21.3944 20.7615 20.7615C21.3944 20.1286 21.75 19.2701 21.75 18.375ZM18.375 3C19.0712 3 19.7389 3.27656 20.2312 3.76884C20.7234 4.26113 21 4.92881 21 5.625V7.5H3V5.625C3 4.92881 3.27656 4.26113 3.76884 3.76884C4.26113 3.27656 4.92881 3 5.625 3H18.375ZM3 18.375V8.25H21V18.375C21 19.0712 20.7234 19.7389 20.2312 20.2312C19.7389 20.7234 19.0712 21 18.375 21H5.625C4.92881 21 4.26113 20.7234 3.76884 20.2312C3.27656 19.7389 3 19.0712 3 18.375Z" fill="#666666"/>
                </svg>
                <span class="date"><?php echo esc_html($atts['date']); ?></span>
            </div> -->
            <div class="date_post-title">
                <p><?php echo esc_html($atts['title']); ?></p>
            </div>
        </div>
    </a>
<?php
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('item_new_horizontal', 'item_new_horizontal_shortcode');

//selling product
function selling_products_section_shortcode($atts)
{
    // Extract the attributes passed to the shortcode
    $atts = shortcode_atts(array(
        'title' => 'SELLING PRODUCTS',
        'hide_link' => false, // Default value for hide_link is false
    ), $atts, 'selling_products_section');

    // Determine if the link should be hidden
    $link_class = $atts['hide_link'] ? 'hidden' : '';

    ob_start();
?>
    <section class='section-selling-products-com container'>
        <div class='title-selling-products-com'>
            <h3>
                <?php echo esc_html($atts['title']); ?>
            </h3>
            <a href="/products/" class="<?php echo esc_attr($link_class); ?>">
                <?php
                $current_language = pll_current_language(); // Assuming you are using Polylang for language management

                $language_arr = [
                    'en' => 'View product', 
                    'vi' => 'Xem sản phẩm', 
                ];

                echo $language_arr[$current_language];

                ?>
                <svg xmlns="http://www.w3.org/2000/svg" class="arrow_product" viewBox="0 0 24 24" fill="none">
                      <path d="M14.2832 4L21.0003 11L14.2832 18" stroke="#41633D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <line x1="19.7324" y1="11.0312" x2="3.99936" y2="11.0312" stroke="#41633D" stroke-width="2" stroke-linecap="round"/>
                    </svg>
            </a>
        </div>
        <div class="selling_com_product-slide">
            <div class="swiper-container swiper-selling_com_product">
                <div class="swiper-wrapper">
                    <?php
                    // Fetch all products to calculate ratings
                    $args = array(
                        'post_type'      => 'products',
                        'posts_per_page' => -1, // Fetch all products to calculate the rating
                    );
                    $query = new WP_Query($args);
                    $current_language = pll_current_language();
                    $products_with_ratings = array();

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            $total_rating = 0;
                            $rating_count = 0;

                            // Get all approved comments for this product
                            $comments = get_comments(array(
                                'post_id' => get_the_ID(),
                                'status'  => 'approve',
                            ));

                            // Calculate the total rating and count of ratings
                            foreach ($comments as $comment) {
                                $comment_rating = get_comment_meta($comment->comment_ID, 'rating', true);
                                if (is_numeric($comment_rating)) {
                                    $total_rating += $comment_rating;
                                    $rating_count++;
                                }
                            }
                            $average_rating = ($rating_count > 0) ? $total_rating / $rating_count : 0;
                            $products_with_ratings[get_the_ID()] = $average_rating;

                        endwhile;
                        arsort($products_with_ratings);
                        $top_10_product_ids = array_slice(array_keys($products_with_ratings), 0, 10);
                        $args = array(
                            'post_type'      => 'products',
                            'post__in'       => $top_10_product_ids,
                            'orderby'        => 'post__in',
                            'posts_per_page' => 10,
                        );
                        $query = new WP_Query($args);

                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                                $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
                                $name = get_the_title();
                                $description = has_excerpt() ? get_the_excerpt() : 'Mô tả mặc định';;
                                $price = get_post_meta(get_the_ID(), 'Sale_Price', true);
                                $original_price = get_post_meta(get_the_ID(), 'Original_Price', true);
                                $discount = ($original_price && $price) ? round((($original_price - $price) / $original_price) * 100) : 0;
                                $permalink = get_permalink();
                                $details_text = ($current_language == 'en') ? 'View Details' :"ดูรายละเอียด";
                                $buy_now_text = ($current_language == 'en') ? 'Buy now' :"ซื้อเลยตอนนี้";
                                $rating = $products_with_ratings[get_the_ID()]; // Get the pre-calculated average rating

                                // Format the prices with thousands separators
                                $current_language = pll_current_language();

                                $currency_arr = [
                                    'en' => '$', 
                                    'th' => '฿',  
                                    'zh' => '¥', 
                                    'ms' => 'RM'
                                ];
                                $currency_symbol = $currency_arr[$current_language];


                                // Output the product item as a slide
                                echo '<div class="swiper-slide">';
                                echo do_shortcode('[product_item 
                                    image="' . esc_url($image) . '" 
                                    alt="' . esc_attr($alt) . '" 
                                    name="' . esc_html($name) . '" 
                                    description="' .$description . '" 
                                    rating="' . esc_html($rating) . '" 
                                    price="' . esc_html($price) . '" 
                                    original_price="' . esc_html($original_price) . '" 
                                    discount="' . esc_html($discount) . '" 
                                    permalink="' . esc_url($permalink) . '"
                                    buy_now_text="' . esc_url($buy_now_text) . '"
                                    details_text="' . esc_html($details_text) . '"]');
                                echo '</div>';
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    endif;
                    ?>
                </div>
                 <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <!-- Add navigation buttons -->
            </div>
            <div class="swiper-pagination-com"></div>
        </div>
    </section>
<?php
    return ob_get_clean();
}
add_shortcode('selling_products_section', 'selling_products_section_shortcode');
//item product search
function product_found_shortcode($atts)
{
    // Define default attributes and merge with user-defined attributes
    $atts = shortcode_atts(
        array(
            'permalink' => '#',
            'name' => 'Product Name',
            'desc' => 'Product Description',
            'image_id' => 238, // Default image ID
        ),
        $atts,
        'product_found'
    );

    // Use "Hello World" if desc is an empty string
    $desc = !empty($atts['desc']) ? $atts['desc'] : 'Hello World';

    ob_start(); // Start output buffering
    ?>
    <a class="item-product-found" href="<?php echo esc_url($atts['permalink']); ?>">
        <h3 class="name-product-mb"><?php echo esc_html($atts['name']); ?></h3>
        <div class="product-image">
            <?php echo wp_get_attachment_image($atts['image_id'], 'large', true); ?>
        </div>
        <div class="product-info">
            <h3 class="name-product-pc"><?php echo esc_html($atts['name']); ?></h3>
            <p><?php echo esc_html($desc); ?></p>
        </div>
    </a>
    <?php
    return ob_get_clean(); // Return the buffered content
}
add_shortcode('product_found', 'product_found_shortcode');

//item post search
function item_new_horizontal_search_shortcode($atts)
{
    // Define default attributes and merge with user-defined attributes
    $atts = shortcode_atts(
        array(
            'image_src_pc' => '',
            'date' => '',
            'title' => '',
            'permalink' => '#',
            'desc' => '',
        ),
        $atts,
        'item_new_horizontal'
    );

    // Use "Hello World" if desc is an empty string
    $desc = !empty($atts['desc']) ? $atts['desc'] : 'Hello World';
    // Output the HTML structure
    ob_start();
    ?>
    <a href="<?php echo esc_url($atts['permalink']); ?>" class="latest_news-item">
        <?php echo wp_get_attachment_image($atts['image_src_pc'], 'full', true, array('class' => 'image_src_pc')); ?>
        <div class="latest_news-content">
            <!-- <div class="date_post_news">
                <?php echo wp_get_attachment_image(294, 'full', true, array('class' => 'icon')); ?>
                <span class="date"><?php echo esc_html($atts['date']); ?></span>
            </div> -->
            <div class="date_post-title">
                <p><?php echo esc_html($atts['title']); ?></p>
                <p><?php echo esc_html($desc); ?></p>
            </div>
        </div>
    </a>
    <?php
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('item_new_horizontal_search', 'item_new_horizontal_search_shortcode');

