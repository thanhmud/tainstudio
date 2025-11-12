<?php 
$current_language = pll_current_language();
$language_arr = [
    'en' => ['english'], 
    'th' => ['thailand'], 
];
// $boxInfoLastChild = $language_arr[$current_language];
$quote = get_field('quote') ?? '';
$social = get_field('social') ?? [];
$slogan = get_field('slogan') ?? '';
?>
<section class="section-banner-header section" id="section1">
    <div class="section-container container">
        <div class="banner-main">
            <?php echo $quote; ?>
            <div class="contact mt-60">
                <div class="social-icon">
                    <?php 
                        if (count($social) > 0) {
                            foreach ($social as $key => $value) {
                                echo '<a href="' . $value['url'] . '" data-aos="fade-right"><span class="mr-20">' . wp_get_attachment_image($value['image'], "full", true, array('alt' => get_the_title($value['image']))) . '</span></a>';
                            }
                        }
                    ?>
                </div>
                <p class="slogan" data-aos="fade-right"><?php echo $slogan ?></p>
            </div>
        </div>
    </div>
</section>
