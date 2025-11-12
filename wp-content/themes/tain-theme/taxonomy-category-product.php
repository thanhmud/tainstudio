<?php
// Gọi header của theme
get_header();

// Redirect to 404 page
wp_redirect(home_url('/404'));
exit;

echo get_template_part('template-parts/taxonomy-products/index');
get_footer();
?>