<?php
function load_more_posts()
{
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'paged' => $paged
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
                                <p>View details</p>
                                <?php echo wp_get_attachment_image(273, 'full', true, array('class' => 'arrow_viewAll_product')); ?>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No more posts to load.</p>';
    endif;

    die();
}
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

//post danh mục
function load_more_posts_category()
{
    $paged = $_POST['page'];
    $query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'paged' => $paged
    ));

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="item_category_news">
                <a href="<?php the_permalink(); ?>" class="category_news-wrapper">
                    <?php echo wp_get_attachment_image(695, 'full', true, array('class' => 'category_news-image')); ?>
                    <div class="category_news-content">
                        <div class="icon_dateViews">
                            <div class="date_post_news">
                                <?php echo wp_get_attachment_image(573, 'full', true, array('class' => 'icon')); ?>
                                <p class="date"><?php echo get_the_date('d/m/Y'); ?></p>
                            </div>
                            <div class="date_post_news views">
                                <?php echo wp_get_attachment_image(575, 'full', true, array('class' => 'icon')); ?>
                                <p class="date"><?php echo get_post_meta(get_the_ID(), 'views', true); ?> views</p>
                            </div>
                        </div>
                        <p class="title"><?php the_title(); ?></p>
                        <p class="sub_title"><?php echo wp_trim_words(get_the_excerpt(), 20, ' [...]'); ?></p>
                        <a href="<?php the_permalink(); ?>" class="view_details">
                            <span>View more</span>
                            <?php echo wp_get_attachment_image(273, 'full', true, array('class' => 'icon_view-details')); ?>
                        </a>
                    </div>
                </a>
            </div>
<?php endwhile;
    endif;
    wp_die();
}
add_action('wp_ajax_load_more_posts_category', 'load_more_posts_category');
add_action('wp_ajax_nopriv_load_more_posts_category', 'load_more_posts_category');
//comment

function load_comments_by_ajax_callback()
{
    $post_id = intval($_POST['post_id']);
    $page = intval($_POST['page']);
    $comments_per_page = 4;

    if ($page < 1) {
        $page = 1;
    }

    $offset = ($page - 1) * $comments_per_page;

    // Lấy tổng số bình luận gốc để tính số trang
    $total_comments = get_comments(array(
        'post_id' => $post_id,
        'status' => 'approve',
        'parent' => 0,
        'count' => true,
    ));

    // Tính số trang dựa trên tổng số bình luận gốc và số bình luận mỗi trang
    $total_pages = ceil($total_comments / $comments_per_page);

    // Lấy bình luận gốc cho trang hiện tại
    $parent_comments = get_comments(array(
        'post_id' => $post_id,
        'status' => 'approve',
        'parent' => 0,
        'number' => $comments_per_page,
        'offset' => $offset,
    ));

    // Lấy tất cả các bình luận (bao gồm cả bình luận trả lời)
    $all_comments = get_comments(array(
        'post_id' => $post_id,
        'status' => 'approve',
    ));

    // Tạo một mảng để lưu trữ các bình luận cần hiển thị
    $comments_to_display = array();

    // Thêm các bình luận gốc vào mảng
    foreach ($parent_comments as $parent_comment) {
        $comments_to_display[] = $parent_comment;

        // Thêm các bình luận trả lời vào mảng
        foreach ($all_comments as $comment) {
            if ($comment->comment_parent == $parent_comment->comment_ID) {
                $comments_to_display[] = $comment;
            }
        }
    }

    ob_start();
    wp_list_comments(array(
        'style'             => 'ol',
        'reverse_top_level' => false,
        'callback'          => 'custom_comment_callback',
        'max_depth'         => '', // Adjust this to control the reply depth if needed
    ), $comments_to_display);
    $comments_html = ob_get_clean();

    // Tạo liên kết phân trang
    $prev_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.188322 6.53269C-0.060948 6.25565 -0.0630279 5.80422 0.183674 5.52429L5.05141 0L5.95396 1.00331L1.53277 6.02065L6 10.9863L5.10679 12L0.188322 6.53269Z" fill="#0E1422"/>
</svg>';
    $next_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M5.81168 5.46731C6.06095 5.74435 6.06303 6.19578 5.81633 6.47571L0.948585 12L0.0460425 10.9967L4.46723 5.97935L0 1.01366L0.89321 0L5.81168 5.46731Z" fill="#0E1422"/>
</svg>';

    $pagination_links = paginate_links(array(
        'base'      => add_query_arg('cpage', '%#%'),
        'format'    => '',
        'prev_text' => $prev_svg,
        'next_text' =>  $next_svg,
        'show_all'  => false,
        'mid_size'  => 1,
        'end_size'  => 2,
        'echo'      => false,
        'current'   => $page,
        'total'     => $total_pages,
    ));

    wp_send_json_success(array(
        'comments' => $comments_html,
        'pagination' => $pagination_links,
    ));

    die();
}
add_action('wp_ajax_load_comments_by_ajax', 'load_comments_by_ajax_callback');
add_action('wp_ajax_nopriv_load_comments_by_ajax', 'load_comments_by_ajax_callback');