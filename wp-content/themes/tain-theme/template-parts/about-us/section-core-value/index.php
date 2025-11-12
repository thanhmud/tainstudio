<?php
$current_language = pll_current_language();

$core_value_title = get_field('core_value_title') ?? '';
$core_value_list = get_field('core_value_list') ?? [];

?>
<section class="section-core-value section pd-50-0 mb-30">
    <div class="container">
        <div class="text-center">
            <h2 class="heading"><?php echo $core_value_title ?></h2>
        </div>
        <div class="content mt-30" >
            <?php 
            if (count($core_value_list) > 0) {
                foreach ($core_value_list as $key => $value) {
                    echo '<div class="item" data-aos="fade-right">
                        <h3 class="child-title"><p class="mb-10">' . wp_get_attachment_image($value['icon'], 'full', true, array('alt' => get_the_title($value['icon']))) . '</p> ' . $value['title'] . '</h3>
                        <div class="child-content mb-10">'
                            . $value['content'] . 
                        '</div>
                    </div>';                
                }
            }

            ?>
        </div>
    </div>
</section>