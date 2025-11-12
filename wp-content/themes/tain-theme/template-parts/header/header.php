<?php
$current_language = pll_current_language();

$linkhome_arr = [
    'vi' => '/', 
    'en' => '/en/', 
];

$linkHome = $linkhome_arr[$current_language];

$logo_header = get_field('logo_footer', 'option');

?>

<!-- /th/home-page-th/ -->
<header class="header">
    <div class="bottom-header">
        <div class="container container-header">
			<a href="<?php echo $linkHome; ?>">
            <?php
                echo wp_get_attachment_image($logo_header, 'medium', false, array(
                    'class' => 'logo',
                    'alt' => 'Tain Studio',
                    'sizes' => 'large'
                ));
            ?>
			</a>
            <div class="navbar">
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
                            $custom_name = $lang['locale'];
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