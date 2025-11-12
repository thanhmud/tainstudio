<?php
$current_language = pll_current_language();

$banner_content = get_field('banner_content');

?>

<section class="section-banner section">
    <div class="section-container container">
        <div class="banner-main">
            <?php echo $banner_content ?>
        </div>
    </div>
</section>
