<section class="section-news">
	<div class="container section-news-container">
		<div class="heading">
			<?php
				$current_language = pll_current_language();
				$language_arr = [
				    'en' => ['news'], 
				    'vi' => ['tin tức'], 
				];
			?>
			<h1 class="heading uppercase mt-30"><?php echo $language_arr[$current_language][0] ?></h1>
		</div>
		<div class="section-news-content">
			<div class="body_news-page">
				<?php
				// Lấy trang hiện tại
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				if (get_query_var('page')) {
				    $paged = get_query_var('page');
				}
				$args = array(
				    'post_type'      => 'post',
				    'posts_per_page' => 10,
				    'meta_key'       => 'view',
				    'orderby'        => 'date',
				    'order'          => 'DESC',
				    'paged'          => $paged
				);
				$latest_posts = new WP_Query($args);
				?>

				<?php if ($latest_posts->have_posts()) : ?>
					<?php while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
						<a href="<?php the_permalink(); ?>" class="news-page-item">
							<div class="main">
								<div class="news-page-img">
									<?php if (has_post_thumbnail()) : ?>
										<?php the_post_thumbnail('full', array('class' => 'image', 'news thumbnail image - tainstudio')); ?>
									<?php else : ?>
										<?php echo wp_get_attachment_image(566, 'full', true, array('class' => 'image', 'news thumbnail image - tainstudio')); ?>
									<?php endif; ?>
								</div>
								<div class="news-page-content">
									<div class="date_post_news">
										<!-- <?php echo wp_get_attachment_image(294, 'full', true, array('class' => 'icon', 'news icon image - tainstudio')); ?> -->
										<!-- <span class="date"><?php echo get_the_date('d/m/Y'); ?></span> -->
									</div>
									<div class="post-title">
										<p><?php the_title(); ?></p>
									</div>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
					
					<!-- PHÂN TRANG -->
					<div class="pagination">
						<div class="pagi-num">
							<?php
							$prev_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
	                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.188322 6.53269C-0.060948 6.25565 -0.0630279 5.80422 0.183674 5.52429L5.05141 0L5.95396 1.00331L1.53277 6.02065L6 10.9863L5.10679 12L0.188322 6.53269Z" fill="#0E1422"/>
	                            </svg>';
	                        $next_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
	                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.81168 5.46731C6.06095 5.74435 6.06303 6.19578 5.81633 6.47571L0.948585 12L0.0460425 10.9967L4.46723 5.97935L0 1.01366L0.89321 0L5.81168 5.46731Z" fill="#0E1422"/>
	                            </svg>';

								echo paginate_links(array(
								    'total'   => $latest_posts->max_num_pages,
								    'current' => $paged,
								    'format'  => '?paged=%#%/',
								    'prev_text' => $prev_svg,
								    'next_text' => $next_svg,
								));
							?>
						</div>
					</div>

					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
