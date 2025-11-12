<?php
$current_language = pll_current_language(); 
$banner_text = get_field('banner_text');

?>
<section class="section-service background section">
    <div class="section-container container">
        <div class="banner-main">
            <?php echo $banner_text ?>
        </div>
    </div>
</section>
