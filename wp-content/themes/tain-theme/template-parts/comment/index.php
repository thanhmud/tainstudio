<?php
$current_language = pll_current_language();
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
//     if (isMobileDevice()) {
//         $average_rating_percentage = ($average_rating / 5) * 100 ;
//     }else{
//      $average_rating_percentage = ($average_rating / 5) * 100;
// 	}

$average_rating_percentage = ($average_rating / 5) * 100;

$star_percentages = array();
foreach ($star_counts as $stars => $count) {
    $star_percentages[$stars] = $total_comments > 0 ? ($count / $total_comments) * 100 : 0;
}

$language_arr = [
    'en' => ['Customer Reviews', 'Write a review', 'Total', 'comment'], 
    'th' => ['รีวิวจากลูกค้า', 'เขียนรีวิว', 'รวม', 'ความคิดเห็น'], 
    'zh' => ['客户评论', '撰写评论', '总计', '评论'], 
    'ms' => ['Ulasan Pelanggan', 'Tulis ulasan', 'Jumlah', 'ulasan']
];

?>

<div class="line-section container" ></div>
<section class="comment-container container">
	<?php echo wp_get_attachment_image(840,'full', true, array('class' => 'background_img')); ?>
    <div class="title-comment-container" >
        <h2 class="color-gradient-blue">
            <?php echo $language_arr[$current_language][0]; ?>
        </h2>
        <div class="btn-open-form__comment">
            <?php echo wp_get_attachment_image(288, 'full', true); ?>
            <span>
                <?php echo $language_arr[$current_language][1]; ?>
            </span>
        </div>
    </div>
    <div class="comment-info" id="comment-info">
        <div class="average-comment">
            <div class="average-comment-number"><?php echo number_format($average_rating, 1); ?>/5</div>
            <div class="average-comment-star">
                <div class="average-star-rating" style="width: 7.5rem;">
                    <div class="average-star-rating" style="width: <?php echo $average_rating_percentage; ?>%;"></div>
                </div>
            </div>
            <div class="total-text">
                <?php echo  $language_arr[$current_language][2] .' ' . $total_comments . ' ' . $language_arr[$current_language][3] . (($total_comments !== 1 && $current_language == 'en') ? 's' : ''); ?>
            </div>
        </div>
        <div class="count-star-mb">
            <div class="count-star five-star" data-width="<?php echo $star_percentages[5]; ?>%">
            </div>
            <div class="count-star four-star" data-width="<?php echo $star_percentages[4]; ?>%">
            </div>
            <div class="count-star three-star" data-width="<?php echo $star_percentages[3]; ?>%">
            </div>
            <div class="count-star two-star" data-width="<?php echo $star_percentages[2]; ?>%">
            </div>
            <div class="count-star one-star" data-width="<?php echo $star_percentages[1]; ?>%">
            </div>
        </div>
        <div class="count-comment">
            <div class="count-star five-star" data-width="<?php echo $star_percentages[5]; ?>%">
                <div class="process-star"></div>
                <div class="percent-star"><?php echo number_format($star_percentages[5], 1); ?>%</div>
                <div>(<?php echo $star_counts[5]; ?>)</div>
            </div>
            <div class="count-star four-star" data-width="<?php echo $star_percentages[4]; ?>%">
                <div class="process-star"></div>
                <div class="percent-star"><?php echo number_format($star_percentages[4], 1); ?>%</div>
                <div>(<?php echo $star_counts[4]; ?>)</div>
            </div>
            <div class="count-star three-star" data-width="<?php echo $star_percentages[3]; ?>%">
                <div class="process-star"></div>
                <div class="percent-star"><?php echo number_format($star_percentages[3], 1); ?>%</div>
                <div>(<?php echo $star_counts[3]; ?>)</div>
            </div>
            <div class="count-star two-star" data-width="<?php echo $star_percentages[2]; ?>%">
                <div class="process-star"></div>
                <div class="percent-star"><?php echo number_format($star_percentages[2], 1); ?>%</div>
                <div>(<?php echo $star_counts[2]; ?>)</div>
            </div>
            <div class="count-star one-star" data-width="<?php echo $star_percentages[1]; ?>%">
                <div class="process-star"></div>
                <div class="percent-star"><?php echo number_format($star_percentages[1], 1); ?>%</div>
                <div>(<?php echo $star_counts[1]; ?>)</div>
            </div>
        </div>
    </div>
    <div class="btn-open-form__comment btn-open-form__comment__mb">
        <?php echo wp_get_attachment_image(288, 'full', true); ?>
        <span>
            <?php echo $language_arr[$current_language][1]; ?>
        </span>
    </div>
    <?php
    if (comments_open($original_post_id) || get_comments_number($original_post_id)) :
        comments_template();
    endif;
    ?>
</section>