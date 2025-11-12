<?php
$term = get_queried_object();
$desc = get_field('desc', $term);
$paged = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$current_language = pll_current_language();
?>
<?php
$term = get_queried_object();
$desc = get_field('desc', $term);
$current_language = pll_current_language();
$news_path = '/news';

$language_arr = [
    'en' => ['No posts found', 'View details', 'Load More', 'views'], 
    'vi' => ['Không tìm thấy bài viết', 'Xem chi tiết', 'Xem thêm', 'lượt xem'], 
];

echo do_shortcode('[custom_breadcrumbs mid_breadcrumbs="' . $news_path . '|News" last_breadcrumbs="' . esc_html($term->name) . '"]');
?>
<section class="news_category-page">
	<?php echo wp_get_attachment_image(1060,'full', true, array('class' => 'bg_wave_news')); ?>
    <div class="container">
        <div class="news_category-container mt-50">
            <div class="heading">
                <div class="title_heading">
                    <h1 class="title gradient-text uppercase" data-text="<?php echo esc_html($term->name); ?>"><?php echo esc_html($term->name); ?></h1>
                    <!-- <?php echo wp_get_attachment_image(268, 'full', true, array('class' => 'icon_foliage')); ?> -->
                </div>
            </div>
            <p class="content">
                <?php echo esc_html($desc); ?>
            </p>
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="item_category_news">
                        <a href="<?php the_permalink(); ?>" class="category_news-wrapper">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('full', array('class' => 'category_news-image')); ?>
                            <?php else : ?>
                                <?php echo wp_get_attachment_image(694, 'full', true, array('class' => 'category_news-image')); ?>
                            <?php endif; ?>
                            <!-- <?php echo wp_get_attachment_image(695, 'full', true, array('class' => 'category_news-image')); ?> -->
                            <div class="category_news-content">
                                <div class="icon_dateViews">
                                    <div class="date_post_news">
                                        <?php echo wp_get_attachment_image(573, 'full', true, array('class' => 'icon')); ?>
                                        <span class="date"><?php echo get_the_date('d/m/Y'); ?></span>
                                    </div>
                                    <div class="date_post_news views">
                                        <?php echo wp_get_attachment_image(575, 'full', true, array('class' => 'icon')); ?>
                                        <span class="date"><?php echo esc_html(get_field('view') ?: '0'); ?> <?php echo $language_arr[$current_language][3]; ?></span>
                                    </div>
                                </div>
                                <p class="title"><?php the_title(); ?></p>
                                <p class="sub_title">
                                    <?php
                                    if (has_excerpt()) {
                                        echo get_the_excerpt();
                                    } else {
                                        echo 'Miêu tả đang được cập nhật...'; // Giá trị mặc định nếu không có excerpt
                                    }
                                    ?>
                                </p>
                                <a href="<?php the_permalink(); ?>" class="view_details">
                                    <span><?php echo $language_arr[$current_language][1]; ?></span>
									<svg class="icon_view-details" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M14.2832 4L21.0003 11L14.2832 18" stroke="#01431D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										<line x1="19.7324" y1="11.0312" x2="3.99936" y2="11.0312" stroke="#01431D" stroke-width="2" stroke-linecap="round" />
									</svg>
                                </a>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
                <div id="skeleton" style="display: none;">
                    <!-- Skeleton loader -->
                    <div class="skeleton-item"></div>
                    <div class="skeleton-item"></div>
                    <div class="skeleton-item"></div>
                </div>

                <!-- Pagination -->
                <?php if ($wp_query->max_num_pages > 1) : ?>
                    <div class="pagination">
                        <?php
                        $prev_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.188322 6.53269C-0.060948 6.25565 -0.0630279 5.80422 0.183674 5.52429L5.05141 0L5.95396 1.00331L1.53277 6.02065L6 10.9863L5.10679 12L0.188322 6.53269Z" fill="#0E1422"/>
                            </svg>';
                        $next_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.81168 5.46731C6.06095 5.74435 6.06303 6.19578 5.81633 6.47571L0.948585 12L0.0460425 10.9967L4.46723 5.97935L0 1.01366L0.89321 0L5.81168 5.46731Z" fill="#0E1422"/>
                            </svg>';
                            $args = array(
                                'base'      => esc_url( add_query_arg( 'page', '%#%' ) ),
                                'format'    => '?page=%#%',
                                'current'   => max(1, isset($_GET['page']) ? intval($_GET['page']) : 1),
                                'total'     => $wp_query->max_num_pages,
                                'prev_text' => $prev_svg,
                                'next_text' => $next_svg,
                            );
            
                            echo paginate_links($args);
                        ?>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <p><?php echo $language_arr[$current_language][0]; ?></p>
            <?php endif; ?>
        </div>
        <button id="load-more"><?php echo $language_arr[$current_language][2]; ?></button>
    </div>
</section>