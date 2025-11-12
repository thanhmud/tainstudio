<?php
// If the post requires a password and it hasn't been entered, do not show comments
if (post_password_required()) {
  return;
}

$current_language = pll_current_language();
$current_post_id = get_the_ID();
$original_post_id = pll_get_post($current_post_id, 'en'); // Get the ID of the original post (English)

// Initialize comment arrays
$comments_original = array();
$comments_translated = array();

// Fetch comments if the posts are published
if (get_post_status($original_post_id) === 'publish') {
  $comments_original = get_comments(array('post_id' => $original_post_id));
}

if (get_post_status($current_post_id) === 'publish') {
  $comments_translated = get_comments(array('post_id' => $current_post_id));
}

// Merge comments and remove duplicates
$all_comments = array_merge($comments_original, $comments_translated);
$unique_comments = array();
$comment_ids = array();

foreach ($all_comments as $comment) {
  if (!in_array($comment->comment_ID, $comment_ids)) {
    $comment_ids[] = $comment->comment_ID;
    $unique_comments[] = $comment;
  }
}

// Filter comments based on the current language
$filtered_comments = array_filter($unique_comments, function ($comment) use ($current_post_id, $original_post_id, $current_language) {
  // Check if the comment is from the original or translated post
  $comment_post_id = $comment->comment_post_ID;

  // Assume the translated post is for the current language
  if ($current_language == 'en' && $comment_post_id == $original_post_id) {
    return true;
  }
  if ($current_language != 'en' && $comment_post_id == $current_post_id) {
    return true;
  }
  return false;
});

// Capture the sort parameter from the URL, default to 'newest'
$sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

// Adjust the query for $filtered_comments based on the sort parameter
switch ($sort_order) {
  case 'newest': // Sort by newest
    usort($filtered_comments, function ($a, $b) {
      return strtotime($b->comment_date) - strtotime($a->comment_date);
    });
    break;
  case 'oldest': // Sort by oldest
    usort($filtered_comments, function ($a, $b) {
      return strtotime($a->comment_date) - strtotime($b->comment_date);
    });
    break;
  case 'highest': // Sort by highest rating
    usort($filtered_comments, function ($a, $b) {
      $rating_a = get_comment_meta($a->comment_ID, 'rating', true);
      $rating_b = get_comment_meta($b->comment_ID, 'rating', true);
      $rating_a = is_numeric($rating_a) ? $rating_a : 0;
      $rating_b = is_numeric($rating_b) ? $rating_b : 0;
      return $rating_b - $rating_a;
    });
    break;
  case 'lowest': // Sort by lowest rating
    usort($filtered_comments, function ($a, $b) {
      $rating_a = get_comment_meta($a->comment_ID, 'rating', true);
      $rating_b = get_comment_meta($b->comment_ID, 'rating', true);
      $rating_a = is_numeric($rating_a) ? $rating_a : 0;
      $rating_b = is_numeric($rating_b) ? $rating_b : 0;
      return $rating_a - $rating_b;
    });
    break;
  default:
    // Fallback to newest as default
    usort($filtered_comments, function ($a, $b) {
      return strtotime($b->comment_date) - strtotime($a->comment_date);
    });
    break;
}

// Determine the text for the <span> based on the sort parameter
// $sort_text = '';

$language_arr = [
    'en' => ['oldest' => 'Oldest', 'highest' => 'Highest Rating', 'lowest' => 'Lowest Rating', 'newest' => 'Newest'], 
    'th' => ['oldest' => 'เก่า', 'highest' => 'คะแนนสูงสุด', 'lowest' => 'คะแนนต่ำสุด', 'newest' => 'ล่าสุด'], 
    'zh' => ['oldest' => '最旧', 'highest' => '最高评分', 'lowest' => '最低评分', 'newest' => '最新'], 
    'ms' => ['oldest' => 'Tertua', 'highest' => 'Penilaian Tertinggi', 'lowest' => 'Penilaian Terendah', 'newest' => 'Terbaharu'],
];

$sort_text = $language_arr[$current_language][$sort_order] ?? '';

?>

<div id="comments" class="comments-area">
  <?php $parent_comments = array_filter($filtered_comments, function ($comment) {
    return $comment->comment_parent == 0;
  });

  $comments_number = count($parent_comments);

  $language_arr = [
      'en' => ['Write a review for', 'Be the first to review', 'Rating & Reviews', 'Newest', 'Oldest', 'Highest Rating', 'Lowest Rating', 'There are no reviews yet.', ''], 
      'th' => ['เขียนรีวิวสำหรับ', 'เป็นคนแรกที่รีวิว', 'คะแนนและรีวิว', 'ใหม่ล่าสุด', 'เก่าที่สุด', 'คะแนนสูงสุด', 'คะแนนต่ำสุด', 'ยังไม่มีรีวิว', ''], 
      'zh' => ['为以下对象撰写评论', '率先评论', '评分和评价', '最新', '最旧', '最高评分', '最低评分', '尚无评论。', '', '', '', '', '', '', '', '', '', '', ''], 
      'ms' => ['Tulis ulasan untuk', 'Jadilah yang pertama mengulas', 'Penilaian & Ulasan', 'Terbaharu', 'Tertua', 'Penilaian Tertinggi', 'Penilaian Terendah', 'Belum ada ulasan lagi.', '', '', '', '', '', '', '', '', '', '', '']
  ];
  ?>
  <!-- 'Be the %1$s to review for “%2$s”',
'Be the %1$s to review for “%2$s”', -->
  <?php if ($comments_number) : ?>
    <h2 class="comments-title">
      <?php
        printf(
          _nx(
            $language_arr[$current_language][0] . ' “%2$s”',
            $language_arr[$current_language][0] . ' “%2$s”',
            $comments_number,
            'comments title',
            'textdomain'
          ),
          number_format_i18n($comments_number + 1),
          get_the_title($current_post_id)
        );
      ?>
    </h2>
  <?php else : ?>
    <h2 class="comments-title">
      <?php
        printf(__($language_arr[$current_language][1] .' “%s”', 'textdomain'), get_the_title($current_post_id));
      ?>

      <!-- <?php printf(__($language_arr[$current_language][1] . ' “%s”', 'textdomain'), get_the_title($current_post_id)); ?> -->
    </h2>
  <?php endif; ?>

  <?php if (!comments_open($current_post_id) && count($filtered_comments)) : ?>
    <p class="no-comments"><?php esc_html_e('Comments are closed.', 'textdomain'); ?></p>
  <?php endif; ?>

  <?php
  // Use the current post ID in the comment form
  comment_form(array('post_id' => $current_post_id));
  ?>
</div>

<div class="list-comment-container container">
  <?php if ($filtered_comments) : ?>
    <div class="title-list-comment">
      <h2>
        <?php echo $language_arr[$current_language][2]; ?>
      </h2>

      <div class="dropdown-btn-list-comment">
        <span>
          <?php echo $sort_text; ?>
        </span>
        <?php echo wp_get_attachment_image(298, 'small', true); ?>
        <div class="dropdown-content">
          <a href="?sort=newest">
            <?php echo $language_arr[$current_language][3]; ?>
          </a>
          <a href="?sort=oldest">
            <?php echo $language_arr[$current_language][4]; ?>
          </a>
          <a href="?sort=highest">
            <?php echo $language_arr[$current_language][5]; ?>
          </a>
          <a href="?sort=lowest">
            <?php echo $language_arr[$current_language][6]; ?>
          </a>
        </div>
      </div>
    </div>
    <input type="hidden" id="comment-post-id" value="<?php echo get_the_ID(); ?>" />
    <ol class="comment-list">
      <?php
      wp_list_comments(array(
        'style'             => 'ol',
        'per_page'          => 4,
        'reverse_top_level' => false,
        'callback'          => 'custom_comment_callback',
      ), $filtered_comments);
      ?>
    </ol>

<?php
// Define custom SVG icons for pagination
$prev_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.188322 6.53269C-0.060948 6.25565 -0.0630279 5.80422 0.183674 5.52429L5.05141 0L5.95396 1.00331L1.53277 6.02065L6 10.9863L5.10679 12L0.188322 6.53269Z" fill="#0E1422"/>
</svg>';
$next_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M5.81168 5.46731C6.06095 5.74435 6.06303 6.19578 5.81633 6.47571L0.948585 12L0.0460425 10.9967L4.46723 5.97935L0 1.01366L0.89321 0L5.81168 5.46731Z" fill="#0E1422"/>
</svg>';

// Get the total number of approved comments for the current post
$total_comments = get_comments(array(
  'post_id' => get_the_ID(),
  'status' => 'approve',
  'count' => true,
  'parent' => 0,
));

// Set the number of comments per page
$comments_per_page = 4;

// Calculate the total number of pages
$total_pages = ceil($total_comments / $comments_per_page);

// Get the current page number from the URL or default to page 1
$page = isset($_GET['cpage']) ? intval($_GET['cpage']) : 1;

// Ensure the current page number is not less than 1
if ($page < 1) {
  $page = 1;
}

// Generate pagination links
$pagination_links = paginate_links(array(
  'base'      => add_query_arg('cpage', '%#%'),
  'format'    => '',
  'prev_text' => $prev_svg,
  'next_text' => $next_svg,
  'show_all'  => false,
  'mid_size'  => 1,
  'end_size'  => 2,
  'echo'      => false,
  'total'     => $total_pages,
  'current'   => $page,
));

// Display the pagination links if the current page is greater than 2 or if there are multiple pages
if ($page > 2 || $total_pages > 1) {
  echo '<div class="pagination-comment">';
  echo $pagination_links;
  echo '</div>';
}
?>
  <?php else : ?>
    <p>
      <?php echo $language_arr[$current_language][7]; ?>
    </p>
  <?php endif; ?>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    function loadComments(page, post_id) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

      xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            document.querySelector('.comment-list').innerHTML = response.data.comments;
            document.querySelector('.pagination-comment').innerHTML = response.data.pagination;
            window.scrollTo({
              top: document.querySelector('.comment-list').offsetTop,
              behavior: 'smooth'
            });
            attachPaginationEventListeners();
          }
        }
      };

      xhr.send('action=load_comments_by_ajax&post_id=' + post_id + '&page=' + page);
    }

    function attachPaginationEventListeners() {
      document.querySelectorAll('.pagination-comment a').forEach(function(link) {
        link.addEventListener('click', function(e) {
          e.preventDefault();

          var href = this.getAttribute('href');
          var pageMatch = href.match(/[?&]cpage=(\d+)/);
          var page = pageMatch ? pageMatch[1] : null;
          var post_id = document.getElementById('comment-post-id').value;

          loadComments(page, post_id);
        });
      });
    }

    attachPaginationEventListeners();
  });
</script>