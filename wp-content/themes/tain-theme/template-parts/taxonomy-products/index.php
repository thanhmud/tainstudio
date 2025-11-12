<?php
$term_page = get_queried_object();
$term_name = isset($term_page->name) ? $term_page->name : 'Default Name';
?>
<?php echo do_shortcode('[custom_breadcrumbs last_breadcrumbs="' . esc_attr($term_name) . '"]'); ?>
<section class="container taxonomy_category-product">
	<h1><?php echo $term_name; ?></h1>
    <div class="content">
        <!-- content left -->
        <div class="content_left">
            <div class="filter_product_list">
                <div class="filter_product_list-header">
                    <p>Price</p>
                    <div class="filter_product_list-header-icon">
                        <svg
                            width="100%"
                            height="100%"
                            viewBox="0 0 16 9"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.2002 1.60047L14.0002 0.480469L8.0002 6.40047L2.0002 0.480469L0.800196 1.60047L8.0002 8.80047L15.2002 1.60047Z"
                                fill="#888888" />
                        </svg>
                    </div>
                </div>
                <div class="filter_product_list-body filter_product_list-body-price">
                    <?php
                    // Get terms for the custom taxonomy 'filter-price-product'
                    $terms = get_terms(array(
                        'taxonomy' => 'filter-price-product',
                        'hide_empty' => false,
                        'orderby' => 'id',
                        'order' => 'ASC'
                    ));

                    // Check if there are any terms
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            // Get the term name in the current language
                            $term_name = function_exists('pll__') ? pll__($term->name) : $term->name;
                    ?>
                            <div class="item_filter">
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" value="<?php echo esc_attr($term->slug); ?>" />
                                    <span class="checkmark"></span>
                                    <span class="subheading-2-5 productList_title-filter"><?php echo esc_html($term_name); ?></span>
                                </label>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p>No terms found.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- content right -->
        <div class="content_right">
            <!-- ảnh banner -->
            <div class="banner">
                <?php echo wp_get_attachment_image(725, 'full', true, array('class' => 'banner')); ?>
                <?php echo wp_get_attachment_image(726, 'full', true, array('class' => 'banner-mb')); ?>
            </div>
            <!-- title -->
            <div class="title">
                <h4 class="title_product">All products</h4>
                <div class="dropdown_filter">
                    <p class="bodytext-3">Best sellers</p>
                    <div class="iconDropdown">
                        <svg width="100%" height="100%" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.92971 5.16172L0.932211 1.73547C0.578461 1.33234 0.865961 0.699219 1.40284 0.699219H7.39784C7.51799 0.699116 7.63563 0.733649 7.73666 0.798682C7.83769 0.863715 7.91783 0.956492 7.96749 1.0659C8.01715 1.17531 8.03422 1.29672 8.01666 1.41558C7.9991 1.53444 7.94764 1.64572 7.86846 1.73609L4.87096 5.16109C4.8123 5.22822 4.73995 5.28203 4.65878 5.31889C4.57761 5.35576 4.48949 5.37483 4.40034 5.37483C4.31119 5.37483 4.22307 5.35576 4.14189 5.31889C4.06072 5.28203 3.98837 5.22822 3.92971 5.16109V5.16172Z" fill="#444444" />
                        </svg>
                    </div>
                    <div class="dropdown_list">
                        <div class="dropdown_item bodytext-3" data-sort="best-seller">Best sellers</div>
                        <div class="dropdown_item bodytext-3" data-sort="price-asc">Price: Low to High</div>
                        <div class="dropdown_item bodytext-3" data-sort="price-desc">Price: High to Low</div>
                        <div class="dropdown_item bodytext-3" data-sort="review">Avg. Customer Review</div>
                    </div>
                </div>
                <button
                    type="button"
                    onclick="handleSidebarFilter()"
                    class="sidebar_filter">
                    <span> Filter </span>
                    <svg
                        class="iconfilter"
                        viewBox="0 0 18 11"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 9.75C6 9.55109 6.07902 9.36032 6.21967 9.21967C6.36032 9.07902 6.55109 9 6.75 9H11.25C11.4489 9 11.6397 9.07902 11.7803 9.21967C11.921 9.36032 12 9.55109 12 9.75C12 9.94891 11.921 10.1397 11.7803 10.2803C11.6397 10.421 11.4489 10.5 11.25 10.5H6.75C6.55109 10.5 6.36032 10.421 6.21967 10.2803C6.07902 10.1397 6 9.94891 6 9.75ZM3 5.25C3 5.05109 3.07902 4.86032 3.21967 4.71967C3.36032 4.57902 3.55109 4.5 3.75 4.5H14.25C14.4489 4.5 14.6397 4.57902 14.7803 4.71967C14.921 4.86032 15 5.05109 15 5.25C15 5.44891 14.921 5.63968 14.7803 5.78033C14.6397 5.92098 14.4489 6 14.25 6H3.75C3.55109 6 3.36032 5.92098 3.21967 5.78033C3.07902 5.63968 3 5.44891 3 5.25ZM0 0.75C0 0.551088 0.0790178 0.360322 0.21967 0.21967C0.360322 0.0790178 0.551088 0 0.75 0H17.25C17.4489 0 17.6397 0.0790178 17.7803 0.21967C17.921 0.360322 18 0.551088 18 0.75C18 0.948912 17.921 1.13968 17.7803 1.28033C17.6397 1.42098 17.4489 1.5 17.25 1.5H0.75C0.551088 1.5 0.360322 1.42098 0.21967 1.28033C0.0790178 1.13968 0 0.948912 0 0.75Z"
                            fill="#444444" />
                    </svg>
                </button>
            </div>
            <!-- list product -->
            <?php
            // Define the number of products per page
            $products_per_page = 9;

            // Get the current page number
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            // Get filter parameters from URL
            $price_filter = isset($_GET['price']) && !empty($_GET['price']) ? explode(',', $_GET['price']) : array();
            $flavor_filter = isset($_GET['flavor']) && !empty($_GET['flavor']) ? explode(',', $_GET['flavor']) : array();
            $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

            // Set up the WP_Query arguments
            $args = array(
                'post_type'      => 'products',
                'posts_per_page' => $products_per_page,
                'paged'          => $paged,
                'tax_query'      => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'category-product',
                        'field'    => 'slug',
                        'terms'    => $term_page->slug,
                    ),
                ),
                'meta_query'     => array(),
            );

            if (!empty($price_filter)) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'filter-price-product',
                    'field'    => 'slug',
                    'terms'    => $price_filter,
                );
            }

            if (!empty($flavor_filter)) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'category-product',
                    'field'    => 'slug',
                    'terms'    => $flavor_filter,
                );
            }

            // Add sorting based on the sort parameter
            if ($sort === 'review' || $sort === 'best-seller') {
                $args['meta_key'] = 'average_rating';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
            } elseif ($sort === 'price-asc') {
                $args['meta_key'] = 'Sale_Price';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'ASC';
            } elseif ($sort === 'price-desc') {
                $args['meta_key'] = 'Sale_Price';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
            }

            // Create a new WP_Query instance
            $query = new WP_Query($args);

            if ($query->have_posts()) : ?>
                <div class="list_product">
                    <?php while ($query->have_posts()) : $query->the_post();
                        // Get product details
                        $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        $alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
                        $permalink = get_permalink();
                        $name = get_the_title();
                        $description = has_excerpt() ? get_the_excerpt() : 'Mô tả mặc định';

                        // Calculate average rating from comments
                        $comments = get_comments(array(
                            'post_id' => get_the_ID(),
                            'status'  => 'approve',
                        ));
                        $total_rating = 0;
                        $rating_count = 0;
                        foreach ($comments as $comment) {
                            $comment_rating = get_comment_meta($comment->comment_ID, 'rating', true);
                            if (is_numeric($comment_rating)) {
                                $total_rating += $comment_rating;
                                $rating_count++;
                            }
                        }
                        $average_rating = ($rating_count > 0) ? $total_rating / $rating_count : 0;
                        $rating = $average_rating;

                        // Update the average rating meta field
                        update_post_meta(get_the_ID(), 'average_rating', $average_rating);

                        $price = get_post_meta(get_the_ID(), 'Sale_Price', true);
                        $original_price = get_post_meta(get_the_ID(), 'Original_Price', true);

                        // Calculate discount percentage
                        if ($original_price > 0 && $price > 0) {
                            $discount = round((($original_price - $price) / $original_price) * 100);
                        } else {
                            $discount = 0;
                        }

                        $details_text = 'View details'; // Customize as needed

                        // Render the product using do_shortcode
                        echo do_shortcode('[product_item 
                image="' . esc_url($image) . '" 
                alt="' . esc_attr($alt) . '" 
                name="' . esc_html($name) . '" 
                description="' . esc_html($description) . '" 
                rating="' . esc_html($rating) . '" 
                price="' . esc_html($price) . '" 
                original_price="' . esc_html($original_price) . '" 
                discount="' . esc_html($discount) . '" 
                permalink="' . esc_url($permalink) . '"
                details_text="' . esc_html($details_text) . '"]');
                    endwhile; ?>
                </div>

                <?php if ($query->max_num_pages > 1) : ?>
                    <div class="pagination-comment">
                        <?php
                        // Define custom SVG icons for pagination
                        $prev_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.188322 6.53269C-0.060948 6.25565 -0.0630279 5.80422 0.183674 5.52429L5.05141 0L5.95396 1.00331L1.53277 6.02065L6 10.9863L5.10679 12L0.188322 6.53269Z" fill="#0E1422"/>
                </svg>';
                        $next_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.81168 5.46731C6.06095 5.74435 6.06303 6.19578 5.81633 6.47571L0.948585 12L0.0460425 10.9967L4.46723 5.97935L0 1.01366L0.89321 0L5.81168 5.46731Z" fill="#0E1422"/>
                </svg>';

                        //                         Display pagination links
                        echo paginate_links(array(
                            'total'        => $query->max_num_pages,
                            'current'      => $paged,
                            'prev_text'    => $prev_svg,
                            'next_text'    => $next_svg,
                            'type'         => 'plain',
                        ));

                        ?>
                    </div>
                <?php endif; ?>
            <?php
            endif;

            // Reset post data
            wp_reset_postdata();
            ?>
            <!-- end list product -->
        </div>
    </div>
    <!-- modal filter product for mobile  -->
    <div class="content_filter-mobile">
        <div class="content_fil">
            <div class="content_filter-header">
                <div class="item_left">
                    <span>Filter</span>
                    <div>
                        <svg
                            class="iconfilter"
                            viewBox="0 0 18 11"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 9.75C6 9.55109 6.07902 9.36032 6.21967 9.21967C6.36032 9.07902 6.55109 9 6.75 9H11.25C11.4489 9 11.6397 9.07902 11.7803 9.21967C11.921 9.36032 12 9.55109 12 9.75C12 9.94891 11.921 10.1397 11.7803 10.2803C11.6397 10.421 11.4489 10.5 11.25 10.5H6.75C6.55109 10.5 6.36032 10.421 6.21967 10.2803C6.07902 10.1397 6 9.94891 6 9.75ZM3 5.25C3 5.05109 3.07902 4.86032 3.21967 4.71967C3.36032 4.57902 3.55109 4.5 3.75 4.5H14.25C14.4489 4.5 14.6397 4.57902 14.7803 4.71967C14.921 4.86032 15 5.05109 15 5.25C15 5.44891 14.921 5.63968 14.7803 5.78033C14.6397 5.92098 14.4489 6 14.25 6H3.75C3.55109 6 3.36032 5.92098 3.21967 5.78033C3.07902 5.63968 3 5.44891 3 5.25ZM0 0.75C0 0.551088 0.0790178 0.360322 0.21967 0.21967C0.360322 0.0790178 0.551088 0 0.75 0H17.25C17.4489 0 17.6397 0.0790178 17.7803 0.21967C17.921 0.360322 18 0.551088 18 0.75C18 0.948912 17.921 1.13968 17.7803 1.28033C17.6397 1.42098 17.4489 1.5 17.25 1.5H0.75C0.551088 1.5 0.360322 1.42098 0.21967 1.28033C0.0790178 1.13968 0 0.948912 0 0.75Z"
                                fill="#fff" />
                        </svg>
                    </div>
                </div>
                <div class="item_right">
                    <button
                        type="button"
                        class="btn_close-header"
                        onclick="handleCloseModal()">
                        <svg
                            width="100%"
                            height="100%"
                            viewBox="0 0 14 14"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13 1L1 13M1 1L13 13"
                                stroke="white"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="list_dropdown">
                <div class="dropdown_item">
                    <div class="header_dropdown" onclick="handleDropdown()">
                        <p>Sort</p>
                        <div class="icon_arrow-bottom">
                            <svg
                                width="100%"
                                height="100%"
                                viewBox="0 0 16 9"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.2002 1.60047L14.0002 0.480469L8.0002 6.40047L2.0002 0.480469L0.800196 1.60047L8.0002 8.80047L15.2002 1.60047Z"
                                    fill="#888888" />
                            </svg>
                        </div>
                    </div>
                    <div class="content_dropdown" id="sort-product-mobile">
                        <div class="content_drop-item">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" data-sort="best-seller" />
                                <span class="checkmark"></span>
                                <span class="productList_title-filter">Best seller</span>
                            </label>
                        </div>
                        <div class="content_drop-item">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" data-sort="price-asc" />
                                <span class="checkmark"></span>
                                <span class="productList_title-filter">Price: Low to High</span>
                            </label>
                        </div>
                        <div class="content_drop-item">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" data-sort="price-desc" />
                                <span class="checkmark"></span>
                                <span class="productList_title-filter">Price: High to Low</span>
                            </label>
                        </div>
                        <div class="content_drop-item">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" data-sort="review" />
                                <span class="checkmark"></span>
                                <span class="productList_title-filter">Avg. Customer Review</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="dropdown_item">
                    <div class="header_dropdown" onclick="handleDropdownPrice()">
                        <p>Price filter</p>
                        <div class="icon_arrow-bottom" id="iconDropPrice">
                            <svg
                                width="100%"
                                height="100%"
                                viewBox="0 0 16 9"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.2002 1.60047L14.0002 0.480469L8.0002 6.40047L2.0002 0.480469L0.800196 1.60047L8.0002 8.80047L15.2002 1.60047Z"
                                    fill="#888888" />
                            </svg>
                        </div>
                    </div>
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'filter-price-product',
                        'hide_empty' => false,
                        'orderby' => 'id', // Order by term ID
                        'order' => 'ASC'   // Ascending order
                    ));
                    ?>
                    <div class="content_dropdown" id="contentDropPrice">
                        <?php foreach ($terms as $term) : ?>
                            <div class="content_drop-item">
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" value="<?php echo esc_attr($term->slug); ?>" />
                                    <span class="checkmark"></span>
                                    <span class="productList_title-filter"> <?php echo esc_html($term->name); ?> </span>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_content-filter">
            <button type="button" class="btn_cancel" onclick="handleCloseModal()">Cancel</button>
            <button type="button" class="btn_apply" id="applyfiltermb">Apply</button>
        </div>
    </div>
</section>
<div class="la1Product">
    <?php echo wp_get_attachment_image(51, 'full', true); ?>
</div>
<div class="la2Product">
    <?php echo wp_get_attachment_image(52, 'full', true, array('class' => 'leaf_pc')); ?>
    <?php echo wp_get_attachment_image(53, 'full', true, array('class' => 'leaf_mb')); ?>
</div>
<div class="background_Img">
    <?php echo wp_get_attachment_image(43, 'full', true); ?>
</div>