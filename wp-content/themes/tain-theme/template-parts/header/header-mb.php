<?php
$current_language = pll_current_language();

$linkhome_arr = [
    'en' => '/', 
    'vi' => '/vi/', 
];
$linkHome = $linkhome_arr[$current_language];

$logo_header = get_field('logo_footer', 'option');
$logo_prefix = get_field('logo_header_prefix', 'option');

?>

<header class="header">
    <div class="bottom-header">
        <div class="container container-header-mb">
            <a href="<?php echo $linkHome; ?>">
                <?php
                echo wp_get_attachment_image($logo_header, 'medium', false, array(
                    'class' => 'logo',
                    'alt' => 'Tain Studio',
                    'sizes' => 'large'
                ));
                ?>
            </a>
            <div class="input-box-mb">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M17 17L21 21M3 11C3 13.1217 3.84285 15.1566 5.34315 16.6569C6.84344 18.1571 8.87827 19 11 19C13.1217 19 15.1566 18.1571 16.6569 16.6569C18.1571 15.1566 19 13.1217 19 11C19 8.87827 18.1571 6.84344 16.6569 5.34315C15.1566 3.84285 13.1217 3 11 3C8.87827 3 6.84344 3.84285 5.34315 5.34315C3.84285 6.84344 3 8.87827 3 11Z" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" />
                </svg> -->
                <div class="hamberger">
					<?php echo wp_get_attachment_image(99,'full', true, array('class' => 'hamberger-icon', 'alt' => get_the_title(99))); ?> 
					<?php echo wp_get_attachment_image(97,'full', true, array('class' => 'close-menu-icon', 'alt' => get_the_title(97))); ?>
                </div>
            </div>
        </div>
        <!-- <div class="container-search">
            <div class="search-box">
                <input type="text" placeholder="<?php echo (pll_current_language() === 'vi') ? 'Vui lòng nhập thông tin bạn muốn tìm kiếm' : 'Enter the name of the product you need to search for'; ?>" />
                <svg xmlns=" http://www.w3.org/2000/svg" class="search-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000">
                    <path d="M17 17L21 21M3 11C3 13.1217 3.84285 15.1566 5.34315 16.6569C6.84344 18.1571 8.87827 19 11 19C13.1217 19 15.1566 18.1571 16.6569 16.6569C18.1571 15.1566 19 13.1217 19 11C19 8.87827 18.1571 6.84344 16.6569 5.34315C15.1566 3.84285 13.1217 3 11 3C8.87827 3 6.84344 3.84285 5.34315 5.34315C3.84285 6.84344 3 8.87827 3 11Z" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <svg class="close-search-box" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="close-icon" stroke="#000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path d="M20.7457 3.32851C20.3552 2.93798 19.722 2.93798 19.3315 3.32851L12.0371 10.6229L4.74275 3.32851C4.35223 2.93798 3.71906 2.93798 3.32854 3.32851C2.93801 3.71903 2.93801 4.3522 3.32854 4.74272L10.6229 12.0371L3.32856 19.3314C2.93803 19.722 2.93803 20.3551 3.32856 20.7457C3.71908 21.1362 4.35225 21.1362 4.74277 20.7457L12.0371 13.4513L19.3315 20.7457C19.722 21.1362 20.3552 21.1362 20.7457 20.7457C21.1362 20.3551 21.1362 19.722 20.7457 19.3315L13.4513 12.0371L20.7457 4.74272C21.1362 4.3522 21.1362 3.71903 20.7457 3.32851Z" fill="#fff"></path>
                </g>
            </svg>
        </div> -->
        <div class="container-nav-mb">
            <div class="navbar-mb">
				<!-- <?php echo wp_get_attachment_image(98,'full', true, array('class' => 'leaf-menu-mb')); ?> -->
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'header-menu',
                        'container' => false,
                        'menu_class' => '',
                        'items_wrap' => '<ul>%3$s</ul>',
                        'fallback_cb' => '__return_false'
                    )
                );
                ?>
            </div>
            <div class="lang-search">
                <div class="language-switcher">
                    <?php
                        $current_language = pll_current_language();
                        $languages = pll_the_languages(array('raw' => 1));
                        foreach ($languages as $lang) {
                            $custom_name = $lang['name'];
                            $custom_flag = $lang['flag'];

                            // Add class 'current-lang' if this is the current language
                            $class = ($lang['slug'] == $current_language) ? 'current-lang' : '';

                            echo '<a href="' . $lang['url'] . '" class="' . $class . '">';
                            echo '<img src="' . $custom_flag . '" alt="' . $custom_name . '"> ';
                            echo $custom_name;
                            echo '</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>