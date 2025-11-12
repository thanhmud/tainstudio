<?php
$publish_date = get_the_date('H:i, j/m/Y');
$post_id = get_the_ID();
$author_id = get_post_field('post_author', $post_id);
$display_name = get_the_author_meta('display_name', $author_id);
$views = get_field('view', $post_id);
$name_post = get_the_title();
$categories = get_the_category($post_id);
$first_category = !empty($categories) ? $categories[0] : null;
if (!$views) {
  $views = 0;
}
$current_url = get_permalink();
// Tăng số lượt xem lên 1
$views++;
update_field('view', $views, $post_id);
$current_language = pll_current_language();
$slug_middle = '/news';

$language_arr = [
    'en' => ['News', 'Related News', ''], 
    'vi' => ['Tin tức', 'Tin tức mới nhất', ''], 
];
$txt_bread = $language_arr[$current_language][0];
// current link post
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
// Lấy tên miền
$domain = $_SERVER['HTTP_HOST'];
// Lấy đường dẫn
$path = $_SERVER['REQUEST_URI'];
// Kết hợp tất cả để tạo URL đầy đủ
$currentUrl = $protocol . $domain . $path;
?>
<?php echo do_shortcode('[custom_breadcrumbs mid_breadcrumbs="' . esc_attr($slug_middle) . '|' . esc_attr($txt_bread) . ';/category/' . esc_attr($first_category->slug) . '|' . esc_attr($first_category->name) . '" last_breadcrumbs="' . esc_html($name_post) . '"]');?>
<section class="news_details">
  <div class="container news_details-container">
    <div class="news_details-body">
      <div class="news_details-ListItem--iconSubTitle">
        <div class="ListItem_iconSubTitle-wrapper">
         <!--  <div class="item_iconSubTitle-flex--news">
            <?php echo wp_get_attachment_image(573, 'full', true, array('class' => 'icon')); ?>
            <span class="sub_title">Last Updated <?php echo $publish_date; ?></span>
          </div> -->
          <div class="item_iconSubTitle-flex--news">
            <?php echo wp_get_attachment_image(575, 'full', true, array('class' => 'icon')); ?>
            <span class="sub_title"><?php echo $views; ?> views</span>
          </div>
        </div>
        <div class="item_iconSubTitle-flex--news">
          <?php echo wp_get_attachment_image(574, 'full', true, array('class' => 'icon')); ?>
          <span class="sub_title">Author <?php echo esc_html($display_name); ?></span>
        </div>
      </div>

      <h1><?php echo get_the_title(); ?></h1>

      <div class="content-post">
        <div class="news-page-img">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full', array('class' => 'image', 'news thumbnail image - tainstudio')); ?>
            <?php else : ?>
                <?php echo wp_get_attachment_image(566, 'full', true, array('class' => 'image', 'news thumbnail image - tainstudio')); ?>
            <?php endif; ?>
        </div>
        <?php
          $content = get_the_content();
          $heading_ids = []; // Array to track heading ids

          $content = preg_replace_callback('/<h([1-6])>(.*?)<\/h\1>/', function ($matches) use (&$heading_ids) {
            $heading_level = $matches[1];
            $heading_text = $matches[2];
            // Create a base id from the heading text
            $base_id = rtrim(preg_replace('/[^a-zA-Z0-9]+/', '_', $heading_text), '_');

            // Check if the id already exists and append an index if necessary
            $heading_id = $base_id;
            $counter = 2;
            while (in_array($heading_id, $heading_ids)) {
              $heading_id = $base_id . '-' . $counter;
              $counter++;
            }

            // Add the id to the list of used ids
            $heading_ids[] = $heading_id;

            // Return the heading with the unique id
            return '<h' . $heading_level . ' id="' . $heading_id . '">' . $heading_text . '</h' . $heading_level . '>';
          }, $content);

          $paragraphs = explode('</p>', $content);
          if (count($paragraphs) > 1) {
            // Insert TOC after the first paragraph
            $paragraphs[1] .= '</p>' . do_shortcode('[ez-toc header_label="Nội dung chính"]');
          }
          $modified_content = implode('</p>', $paragraphs);

          // Output the modified content
          echo $modified_content;
        ?>

      </div>
      <div class="iconfb_share-wrapper">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($current_url); ?>" target="_blank" onclick="window.open(this.href, 'facebook-share',`width=${screen.width},height=${screen.height}`); return false;" class="icon">
          <?php echo wp_get_attachment_image(576, 'full', true, array('class' => 'icon facebook')); ?>
        </a>
        <div class="tooltip_share">
          <?php echo wp_get_attachment_image(577, 'full', true, array('class' => 'icon share', 'id' => 'ToggleTooltipLink')); ?>
          <div class="tooltip_link">
            <input type="text" value="<?php echo $currentUrl; ?>" />
            <button onclick="HandleCoppyUrl()">Copy</button>
          </div>
        </div>
      </div>
    </div>
    <div class="news_details-orther">
      <div class="body_latest_news">
        <p class="title"><?php echo $language_arr[$current_language][1] ?></p>
        <?php
        $categories = wp_get_post_categories($post_id);
        // Query for the 4 latest posts in the same categories excluding the current post
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => 5,
          'post__not_in' => array($post_id),
          'category__in' => $categories,
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
  <div class="container"></div>
</section>
<?php echo wp_get_attachment_image(1060, 'full', true, array('class' => 'bg-wave-pd-top')); ?>