<?php

// Lập lịch bài viết
add_action('save_post', 'set_scheduled_post_time', 10, 3);
function set_scheduled_post_time($post_id, $post, $update) {
    // Kiểm tra nếu không phải bài viết hoặc đang tự động lưu/revision
    if ($post->post_type !== 'post' || wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
        return;
    }

    // Lấy giá trị từ trường publish_datetime
    $publish_datetime = get_field('publish_datetime', $post_id);
    
    if ($publish_datetime) {
        // Tạo đối tượng DateTime từ chuỗi
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $publish_datetime);
        
        if ($date && $date > new DateTime()) {
            // Ngăn vòng lặp bằng cách loại bỏ action tạm thời
            remove_action('save_post', 'set_scheduled_post_time');
            
            // Cập nhật thời gian đăng bài
            $post_data = array(
                'ID' => $post_id,
                'post_date' => $date->format('Y-m-d H:i:s'),
                'post_date_gmt' => get_gmt_from_date($date->format('Y-m-d H:i:s')),
                'post_status' => 'future'
            );
            wp_update_post($post_data);
            
            // Thêm lại action
            add_action('save_post', 'set_scheduled_post_time', 10, 3);
        }
    }
}

//404
add_action('template_redirect', 'check_comment_page_url');
function check_comment_page_url() {
    if (is_comment_feed()) {
        return;
    }

    $request_uri = $_SERVER['REQUEST_URI'];
    if (preg_match('/comment-page-[0-9]+/', $request_uri)) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit();
    }
}
//disable duplicate cmt
function disable_duplicate_comment_check( $approved, $commentdata ) {
    // Always approve the comment, regardless of duplication
    return 1;
}
add_filter( 'duplicate_comment_id', '__return_empty_string', 10, 2 );
add_filter( 'pre_comment_approved', 'disable_duplicate_comment_check', 99, 2 );


//paged
function fits_adjust_queries($query)
{
    if (!is_admin() and is_category() and $query->is_main_query()) {
        $query->set('posts_per_page', 5);
    }
}
add_action('pre_get_posts', 'fits_adjust_queries');
//end paged
function custom_comment_redirect($location, $comment) {
    // Use `#comment-<comment_ID>` to scroll to the latest comment
    return get_permalink($comment->comment_post_ID) . '#comment-info';
}
add_filter('comment_post_redirect', 'custom_comment_redirect', 10, 2);
//
function custom_rewrite_rules() {
    add_rewrite_rule(
        '^products/page/([0-9]+)/?$',
        'index.php?post_type=products&paged=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_rewrite_rules');
//

function mytheme_comment_rating_field() {
    $current_language = pll_current_language();

    $label_arr = [
        'en' => 'Your Rating', 
        'vi' => 'Đánh giá của bạn', 
    ];

    $label_text = $label_arr[$current_language];
   

    echo '<p class="comment-form-rating">
            <label for="rating">' . __( $label_text ) . ' <span style="color: red;">*</span></label>
            <span class="star-rating">
                <input type="radio" name="rating" value="5" id="rating-5"><label for="rating-5">★</label>
                <input type="radio" name="rating" value="4" id="rating-4" ><label for="rating-4">★</label>
                <input type="radio" name="rating" value="3" id="rating-3" ><label for="rating-3">★</label>
                <input type="radio" name="rating" value="2" id="rating-2" ><label for="rating-2">★</label>
                <input type="radio" name="rating" value="1" id="rating-1" ><label for="rating-1">★</label>
            </span>
          </p>';
}
add_action('comment_form_logged_in_after', 'mytheme_comment_rating_field');
add_action('comment_form_after_fields', 'mytheme_comment_rating_field');

// Lưu trữ giá trị đánh giá khi bình luận được gửi
function mytheme_save_comment_rating($comment_id) {
    if (isset($_POST['rating']) && $_POST['rating'] !== '') {
        $rating = intval($_POST['rating']);
        add_comment_meta($comment_id, 'rating', $rating);
    }
}
add_action('comment_post', 'mytheme_save_comment_rating');

// Hiển thị giá trị đánh giá trong bình luận
function mytheme_display_comment_rating($comment_text, $comment) {
    $rating = get_comment_meta($comment->comment_ID, 'rating', true);
    if ($rating) {
        $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
        $rating_html = '<p class="comment-rating">' . sprintf(__('Rating: %s'), $stars) . '</p>';
        $comment_text = $rating_html . $comment_text;
    }
    return $comment_text;
}
add_filter('comment_text', 'mytheme_display_comment_rating', 10, 2);

// Thêm trường đánh giá vào trang chỉnh sửa bình luận trong admin
function mytheme_add_comment_rating_meta_box() {
    add_meta_box('title', __('Comment Rating'), 'mytheme_comment_rating_meta_box', 'comment', 'normal', 'high');
}
add_action('add_meta_boxes_comment', 'mytheme_add_comment_rating_meta_box');

function mytheme_comment_rating_meta_box($comment) {
    $rating = get_comment_meta($comment->comment_ID, 'rating', true);
    ?>
    <label for="rating"><?php _e('Rating'); ?></label>
    <span class="star-rating">
        <input type="radio" name="rating" value="5" id="rating-5" <?php checked($rating, '5'); ?>><label for="rating-5">★</label>
        <input type="radio" name="rating" value="4" id="rating-4" <?php checked($rating, '4'); ?>><label for="rating-4">★</label>
        <input type="radio" name="rating" value="3" id="rating-3" <?php checked($rating, '3'); ?>><label for="rating-3">★</label>
        <input type="radio" name="rating" value="2" id="rating-2" <?php checked($rating, '2'); ?>><label for="rating-2">★</label>
        <input type="radio" name="rating" value="1" id="rating-1" <?php checked($rating, '1'); ?>><label for="rating-1">★</label>
    </span>
    <?php
}

// Lưu giá trị đánh giá khi admin cập nhật bình luận
function mytheme_edit_comment_rating($comment_id) {
    if (isset($_POST['rating']) && $_POST['rating'] !== '') {
        $rating = intval($_POST['rating']);
        update_comment_meta($comment_id, 'rating', $rating);
    } else {
        delete_comment_meta($comment_id, 'rating');
    }
}
add_action('edit_comment', 'mytheme_edit_comment_rating');
// Bỏ website comment
function remove_comment_fields($fields) {
    if (isset($fields['url'])) {
        unset($fields['url']);
    }
    return $fields;
}
add_filter('comment_form_default_fields', 'remove_comment_fields');
//sửa label

function custom_comment_form_defaults($defaults) {
    $current_language = pll_current_language();

    $comment_arr = [
        'en' => 'Your comment', 
        'vi' => 'Bình luận của bạn', 
    ];

    $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x($comment_arr[$current_language], 'noun') . ' <span class="required" style="color: red;">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

    return $defaults;
}
add_filter('comment_form_defaults', 'custom_comment_form_defaults');

function custom_comment_form_defaults_btn($defaults) {
    $current_language = pll_current_language();

    $submit_arr = [
        'en' => 'Send', 
        'vi' => 'Gửi', 
    ];
    $defaults['label_submit'] = __($submit_arr[$current_language]);

    return $defaults;
}
add_filter('comment_form_defaults', 'custom_comment_form_defaults_btn');

function custom_comment_form_fields($fields) {
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    $commenter = wp_get_current_commenter(); // Đảm bảo biến $commenter được định nghĩa
    $current_language = pll_current_language();


    $author_arr = [
        'en' => ['Name', 'Email'], 
        'vi' => ['Tên', 'Email'],  
    ];

    $fields['author'] = '<p class="comment-form-author"><label for="author">' . __($author_arr[$current_language][0]) . ' <span class="required" style="color: red;">*</span></label> ' .
            '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>';

    $fields['email'] = '<p class="comment-form-email"><label for="email">' . __($author_arr[$current_language][1]) . ' </label> ' .
            '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>';

    // if ($current_language == 'th') {
    //     $fields['author'] = '<p class="comment-form-author"><label for="author">' . __('ชื่อ') . ' <span class="required" style="color: red;">*</span></label> ' .
    //         '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>';

    //     $fields['email'] = '<p class="comment-form-email"><label for="email">' . __('อีเมล') . ' </label> ' .
    //         '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>';
    // } else {
    //     $fields['author'] = '<p class="comment-form-author"><label for="author">' . __('Name') . ' <span class="required" style="color: red;">*</span></label> ' .
    //         '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>';

    //     $fields['email'] = '<p class="comment-form-email"><label for="email">' . __('Email') . '</label> ' .
    //         '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>';
    // }

    return $fields;
}
add_filter('comment_form_default_fields', 'custom_comment_form_fields');
//erorr span
function custom_comment_form_fields_err($fields) {
    $fields['cookies'] = $fields['cookies'] . '<span class="cookies-error" style="color: red; display: none;"></span>';
    return $fields;
}
add_filter('comment_form_default_fields', 'custom_comment_form_fields_err');
//custom reply comment
function custom_reply_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <div <?php comment_class('reply-comment'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard">
                <?php echo wp_get_attachment_image(290, 'small', true); ?>
                <?php echo "admin"?>
        </div>
        <!-- 
        <div class="comment-meta commentmetadata">
            <div class="date-time-comment"><?php printf(__('%1$s at %2$s', 'textdomain'), get_comment_date(), get_comment_time()); ?></div>
            <div class="comment-post-title">
                <?php
                $post_id = $comment->comment_post_ID;
                $post_title = get_the_title($post_id);
                echo '<span>' . esc_html($post_title) . '</span>';
                ?>
            </div>
        </div> -->
        <div class="comment-text">
            <?php comment_text(); ?>
        </div>
    </div>
    <?php
}
//custom list comment
function custom_comment_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    if ($depth > 1) {
        custom_reply_callback($comment, $args, $depth);
        return;
    }
    ?>
    <div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard">
            <div class="name-user"><?php echo get_comment_author(); ?></div>
            <?php if ($rating = get_comment_meta($comment->comment_ID, 'rating', true)) : ?>
                <div class="comment-rating">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        echo $i <= $rating ? '★' : '☆';
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="comment-meta commentmetadata">
            <div class="date-time-comment"><?php echo get_comment_date('j F Y'); ?></div>
            <div class="comment-post-title">
                <?php
                $post_id = $comment->comment_post_ID;
                $post_title = get_the_title($post_id);
                echo '<span>' . esc_html($post_title) . '</span>';
                ?>
            </div>
        </div>
        <div class="comment-text">
            <?php comment_text(); ?>
        </div>
    </div>
    <?php
}
