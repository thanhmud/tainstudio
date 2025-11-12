<?php
$categories = get_terms(
    array(
        'taxonomy'   => 'category',
        'hide_empty' => false,
        'meta_key'   => 'order',
        'orderby'    => 'meta_value_num',
        'order'      => 'ASC'
    )
);

$current_language = pll_current_language();

$language_arr = [
    'en' => ['View more', 'No posts found in the', 'category'], 
    'vi' => ['Tải thêm', 'Không tìm thấy bài viết nào trong', 'Danh mục'], 
];

$txt_btnView = $language_arr[$current_language][0];
?>

<div class="container-sections-news">

    <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
        <?php foreach ($categories as $index => $category) : ?>
            <section class="news_slide-wrapper" id="newsSwiper<?php echo $index + 1; ?>" data-aos="fade-up">
                <div class="container heading">
                    <h2 class="title gradient-text uppercase" data-text="<?php echo esc_html($category->name) ?>"><?php echo esc_html($category->name); ?></h2>
                </div>
                <div class="container news_slide-content">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            // Define the query arguments
                            $args = array(
                                'cat' => $category->term_id, // Category ID
                                'posts_per_page' => 12, // Number of posts to display, -1 for all posts
                            );

                            // Create a new query
                            $query = new WP_Query($args);

                            // Check if there are posts
                            if ($query->have_posts()) :
                                // Loop through the posts
                                while ($query->have_posts()) : $query->the_post(); ?>
                                    <div class="swiper-slide">
                                        <a href="<?php the_permalink(); ?>" class="item_newsSlide_body">
                                            <div class="item_newSlide">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail('full', array('class' => 'item_newSlide-img')); ?>
                                                <?php else : ?>
                                                    <?php echo wp_get_attachment_image(694, 'full', true, array('class' => 'item_newSlide-img')); ?>
                                                <?php endif; ?>
                                                <div class="item_newSlide-content">
                                                    <div class="item_newSlide-title">
                                                        <p class="title_heading">
                                                            <?php the_title(); ?>
                                                        </p>
                                                        <p class="sub_title">
                                                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                                        </p>
                                                    </div>
                                                    <div class="date_post_news pc">
                                                        <?php echo wp_get_attachment_image(573, 'full', true, array('class' => 'icon')); ?>
                                                        <span class="date"><?php echo get_the_date('d/m/Y'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            <?php endwhile;
                                // Reset post data
                                wp_reset_postdata();
								else :
                                    echo '<p>' . $language_arr[$current_language][1] . ' "' . esc_html($category->name) . '" ' . $language_arr[$current_language][2] . '.</p>';
                            endif;
                            ?>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="view_more-pc">
                        <span><?php echo $txt_btnView ?></span>
                        <svg class="icon_viewmore" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M14.2832 4L21.0003 11L14.2832 18" stroke="#0061AA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <line x1="19.7324" y1="11.0312" x2="3.99936" y2="11.0312" stroke="#0061AA" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </a>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </section>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php echo wp_get_attachment_image(43, 'large', true, array('class' => 'bg-news-page')); ?>
</div>