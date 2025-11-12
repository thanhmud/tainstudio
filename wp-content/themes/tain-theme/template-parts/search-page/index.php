<?php
$query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$paged_posts = isset($_GET['paged_posts']) ? intval($_GET['paged_posts']) : 1;
$current_language = pll_current_language();
// Tìm kiếm sản phẩm
$args_products = array(
    's' => $query,
    'post_type' => 'products',
    'posts_per_page' => -1,
);
$search_query_products = new WP_Query($args_products);
$total_products = $search_query_products->found_posts;

// Tìm kiếm bài viết
$sort_order = isset($_GET['sort_order']) ? sanitize_text_field($_GET['sort_order']) : 'latest';
$args_posts = array(
    's' => $query,
    'post_type' => 'post',
    'posts_per_page' => 5,
    'paged' => $paged_posts,
    'orderby' => 'date',
    'order' => $sort_order === 'latest' ? 'DESC' : 'ASC',
);
$search_query_posts = new WP_Query($args_posts);
$total_posts = $search_query_posts->found_posts;

// Tổng số kết quả tìm thấy
$total_results = $total_products + $total_posts;

$current_language = pll_current_language();

$language_arr = [
    'en' => ['Found', 'result(s) for keyword', 'Latest', 'Oldest', 'Sorry! No results were found', 'We are sorry that we couldn\'t find what you are looking for. Please choose another keyword'], 
    'th' => ['พบ', 'ผลลัพธ์สำหรับคีย์เวิร์ด', 'ล่าสุด', 'เก่าที่สุด', 'ขออภัย ไม่พบผลลัพธ์', 'ขออภัยที่ไม่พบสิ่งที่คุณกำลังมองหา โปรดเลือกคีย์เวิร์ดอื่น'], 
    'zh' => ['找到', '关键字的结果', '最新', '最旧', '抱歉！未找到任何结果', '很抱歉，我们找不到您要查找的内容。请选择其他关键字'], 
    'ms' => ['Ditemui', 'hasil(s) untuk kata kunci', 'Terbaru', 'Tertua', 'Maaf! Tiada hasil ditemui', 'Kami memohon maaf kerana kami tidak menemui apa yang anda cari. Sila pilih kata kunci lain']
];

?>

<section class="container-search-result">
	<h1>Search Result</h1>
    <div class="search-box-page">
        <input type="text" placeholder="<?php echo $query ? esc_attr($query) : (pll_current_language() === 'th' ? 'กรอกชื่อสินค้าที่คุณต้องการค้นหา' : 'Enter the name of the product you need to search for'); ?>" value="<?php echo esc_attr($query); ?>" />
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="foundicon">
            <path d="M17 17L21 21M3 11C3 13.1217 3.84285 15.1566 5.34315 16.6569C6.84344 18.1571 8.87827 19 11 19C13.1217 19 15.1566 18.1571 16.6569 16.6569C18.1571 15.1566 19 13.1217 19 11C19 8.87827 18.1571 6.84344 16.6569 5.34315C15.1566 3.84285 13.1217 3 11 3C8.87827 3 6.84344 3.84285 5.34315 5.34315C3.84285 6.84344 3 8.87827 3 11Z" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
    <span class="text-result"> <?php echo $language_arr[$current_language][0]; ?> <strong><?php echo $total_results; ?></strong> <?php echo $language_arr[$current_language][1]; ?> <strong><?php echo esc_html($query); ?></strong></span>

    <?php if ($total_results > 0): ?>
        <div class="product-search-result">
            <?php if ($query): ?>
                <!-- List of products found -->
                <?php if ($search_query_products->have_posts()): ?>
                    <?php while ($search_query_products->have_posts()): $search_query_products->the_post(); ?>
                        <?php
                        // Get the permalink, title, excerpt, and image ID of the current post
                        $permalink = get_permalink();
                        $title = get_the_title();
                        $excerpt = get_the_excerpt();
                        $image_id = get_post_thumbnail_id();
                        if (!has_excerpt()) {
                            $excerpt = 'Loading description...'; 
                        }
                        // Output the product using the custom shortcode
                        echo do_shortcode('[product_found permalink="' . esc_url($permalink) . '" name="' . esc_attr($title) . '" desc="' . esc_attr($excerpt) . '" image_id="' . esc_attr($image_id) . '"]');
                        ?>
                    <?php endwhile; ?>

                    <!-- Pagination could go here -->

                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>

        <div class="post-search-result">
			<?php if($total_posts > 0): ?>
            <div class="filter-result-post">
                <span><?php echo $language_arr[$current_language][2]; ?></span>
                <?php echo wp_get_attachment_image(298, 'large', true); ?>
                <div class="dropdown-result-post">
                    <span class="sort-option" data-sort="latest"><?php echo $language_arr[$current_language][2]; ?></span>
                    <span class="sort-option" data-sort="oldest"><?php echo $language_arr[$current_language][3]; ?></span>
                </div>
            </div>
			<?php endif; ?>
            <?php if ($query): ?>
                <!-- Hiển thị bài viết tìm thấy -->
                <?php if ($search_query_posts->have_posts()): ?>
                    <?php while ($search_query_posts->have_posts()): $search_query_posts->the_post(); ?>
                        <?php
                        $image_id = get_post_thumbnail_id();
                        $date = get_the_date('d-m-Y');
                        $title = get_the_title();
                        $permalink = get_permalink();
                        $desc = get_the_excerpt();
                        if (!has_excerpt()) {
                            $desc = 'Loading description...'; 
                        }
                        ?>
                        <?php echo do_shortcode('[item_new_horizontal_search image_src_pc="' . esc_attr($image_id) . '" date="' . esc_attr($date) . '" title="' . esc_attr($title) . '" permalink="' . esc_url($permalink) . '" desc="' . esc_attr($desc) . '"]'); ?>
                    <?php endwhile; ?>

                    <!-- Phân trang cho bài viết -->
                    <?php if ($search_query_posts->max_num_pages > 1): ?>
                        <div class="pagination">
                            <?php
                            echo paginate_links(array(
                                'total' => $search_query_posts->max_num_pages,
                                'current' => $paged_posts,
							    'mid_size'  => 1,
								'end_size'  => 2,
                                'format' => '?s=' . urlencode($query) . '&paged_posts=%#%',
                                'base' => '?s=' . urlencode($query) . '&paged_posts=%#%',
                                'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.188322 6.53269C-0.060948 6.25565 -0.0630279 5.80422 0.183674 5.52429L5.05141 0L5.95396 1.00331L1.53277 6.02065L6 10.9863L5.10679 12L0.188322 6.53269Z" fill="#0E1422"/>',
                                'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.81168 5.46731C6.06095 5.74435 6.06303 6.19578 5.81633 6.47571L0.948585 12L0.0460425 10.9967L4.46723 5.97935L0 1.01366L0.89321 0L5.81168 5.46731Z" fill="#0E1422"/>',
                            ));
                            ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="no-results">
            <?php echo wp_get_attachment_image(655, 'large', true); ?>
            <span class="no-results-span"><?php echo $language_arr[$current_language][4]; ?></span>
            <span class="no-results-span-second"><?php echo $language_arr[$current_language][5];?></span>
        </div>
    <?php endif; ?>
</section>