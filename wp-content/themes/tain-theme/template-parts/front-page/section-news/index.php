<?php
$news_title = get_field('news_title');
$best_news = get_field('best_news');
?>

<section class="section-news section pd-50-0" id="section4">
    <div class="section-container container">
        <div class="main-text">
            <h2 class="heading color-main"> Tin tức công nghệ </h2>
			<div class="news-body">
				<div class="body_featured_news aos-init" data-aos="fade-right">
					<?php
					if (!$best_news) {
						// Nếu $best_news không có, lấy bài mới nhất
						$best_news = get_posts(array(
							'numberposts' => 1,
							'post_type'   => 'post', // hoặc thay đổi post type nếu cần
							'post_status' => 'publish'
						));

						// Kiểm tra xem bài viết có tồn tại hay không
						if (!empty($best_news)) {
							$best_news = $best_news[0]; // Lấy bài đầu tiên
						}
					}

					if ($best_news) {
						// Extract necessary fields from the post object
						$image_id = get_post_thumbnail_id($best_news->ID);
						$date = get_the_date('d/m/Y', $best_news->ID);
						$title = get_the_title($best_news->ID);
						$subtitle = has_excerpt($best_news->ID) ? get_the_excerpt($best_news->ID) : 'Mô tả mặc định';
						$permalink = get_permalink($best_news->ID);

						// Generate the shortcode with the extracted attributes
						$shortcode = sprintf(
							'[item_new_vertical image_id="%d" date="%s" title="%s" subtitle="%s" permalink="%s"]',
							$image_id,
							esc_attr($date),
							esc_attr($title),
							esc_attr($subtitle),
							esc_url($permalink)
						);

						echo do_shortcode($shortcode);
					}
					?>
				</div>
				<div class="body_latest_news aos-init" data-aos="fade-left">
					<div class="title">Latest news</div>
					<?php
					// Query for the 4 latest posts excluding the best news post
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 4,
						'post__not_in' => array($best_news->ID),
						'orderby' => 'date',
						'order' => 'DESC'
					);
					$latest_news_query = new WP_Query($args);

					if ($latest_news_query->have_posts()) {
						while ($latest_news_query->have_posts()) {
							$latest_news_query->the_post();
							$image_src_pc = get_post_thumbnail_id();
							$date = get_the_date('d/m/Y');
							$title = get_the_title();
							$subtitle = get_the_excerpt() || "";
							$permalink = get_permalink();

							// Generate the shortcode with the extracted attributes
							$shortcode = sprintf(
								'[item_new_horizontal image_src_pc="%d" date="%s" title="%s" subtitle="%s" permalink="%s"]',
								$image_src_pc,
								esc_attr($date),
								esc_attr($title),
								esc_attr($subtitle),
								esc_attr($permalink)
							);

							// Output the shortcode
							echo do_shortcode($shortcode);
						}
						wp_reset_postdata();
					}
					?>
				</div>
			</div>
        </div>
    </div>
</section>
