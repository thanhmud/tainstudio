<?php
    $current_language = pll_current_language();
    $language_arr = [
        'en' => ['View details', 'Load More'], 
        'vi' => ['Xem chi tiết', 'Tải thêm'], 
    ];
?>
<div class="list-news-mobile container mb-50">
    <div id="news-container">
        <?php
        // Query the first 5 posts
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 5,
            'paged' => 1
        );
        $news_query = new WP_Query($args);

        if ($news_query->have_posts()) :
            while ($news_query->have_posts()) : $news_query->the_post();
        ?>
            <div class="item_newsSlide_body">
                <a href="<?php the_permalink(); ?>">
                    <div class="item_newSlide">
                        <?php the_post_thumbnail('full', array('class' => 'item_newSlide-img')); ?>
                        <div class="item_newSlide-content">
                            <div class="item_newSlide-title">
                                <p class="title_heading"><?php the_title(); ?></p>
                                <p class="sub_title"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="view_productAll">
                                <span><?php echo $language_arr[$current_language][0]; ?></span>
                                 <svg xmlns="http://www.w3.org/2000/svg" class="arrow_viewAll_product" viewBox="0 0 24 24" fill="none" width="20">
                                  <path d="M14.2832 4L21.0003 11L14.2832 18" stroke="#1c841e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <line x1="19.7324" y1="11.0312" x2="3.99936" y2="11.0312" stroke="#1c841e" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No posts found.</p>';
        endif;
        ?>
    </div>
	<div id="skeleton" style="display: none;">
        <!-- Skeleton loader -->
        <div class="skeleton-item"></div>
        <div class="skeleton-item"></div>
        <div class="skeleton-item"></div>
    </div>
    <!-- Load More Button -->
    <button id="load-more"><?php echo $language_arr[$current_language][1]; ?></button>
</div>
