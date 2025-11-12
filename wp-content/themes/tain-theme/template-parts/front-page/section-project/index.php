<?php

$project_title = get_field('project_title') ?? '';
$project_sub_title = get_field('project_sub_title') ?? '';
$image_list = get_field('image_list') ?? [];
$customer_review_title = get_field('customer_review_title') ?? '';
$customer_review_content = get_field('customer_review_content') ?? '';
$customer_review_name = get_field('customer_review_name') ?? '';
$project_text = get_field('project_text') ?? '';


?>

<section class="section-project section pd-50-0">
    <div class="section-container container">
        <div>
            <h2 class="heading color-main" data-aos="fade-down"><?php echo $project_title ?></h2>
            <h3 data-aos="fade-down"><?php echo $project_sub_title ?></h3>
            <div class="swiper-container mt-30">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <?php 
                        if (count($image_list) > 0) {
                            foreach ($image_list as $key => $value) {
                                echo '<div class="swiper-slide"><a href="' . $value['url'] . '" aria-label="Các dự án đã triển khai của Tain Studio">' . wp_get_attachment_image($value['sub_image'], 'full', true, ['alt' => get_the_title($value['sub_image'])]) . '</a></div>';
                            }
                        }
                     ?>
                </div>
            </div>
            <div class="customer-review mt-30" data-aos="fade">
                <h4 class="mt-30"><?php echo $customer_review_title ?></h4>
                <hr>
                <p class="mt-20"><?php echo $customer_review_content ?></p>
                <p class="bold">— <?php echo $customer_review_name ?> </p>
                <hr>
                <p class="note mt-50 mb-10" data-aos="fade-right"><?php echo $project_text ?></p>
            </div>
        </div>
    </div>
</section>