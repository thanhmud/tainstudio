<?php
//sp theme
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails');
//pagination
function custom_pagination_base($link) {
    return str_replace('/page/', '?page=', $link);
}
add_filter('paginate_links', 'custom_pagination_base');
//menu
function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

function add_arrow_to_menu_items($title, $item, $args, $depth) {
    if (in_array('menu-item-has-children', $item->classes)) {
        $title .= ' <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none" class="opensubmenu">
                        <path d="M15.6992 5.60047L14.4992 4.48047L8.49922 10.4005L2.49922 4.48047L1.29922 5.60047L8.49922 12.8005L15.6992 5.60047Z" fill="#444" />
                    </svg>';
    }
    return $title;
}
add_filter('nav_menu_item_title', 'add_arrow_to_menu_items', 10, 4);

function add_active_class_to_menu_items($classes, $item, $args) {
    if (in_array('current-menu-item', $item->classes) || in_array('current-menu-ancestor', $item->classes)) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_active_class_to_menu_items', 10, 3);

function isMobileDevice()
{
  return preg_match(
    "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|up\.browser|up\.link|webos|wos|ipad)/i",
    $_SERVER["HTTP_USER_AGENT"]
  );
}
add_theme_support('post-thumbnails');