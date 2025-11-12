<?php
$current_language = pll_current_language();
$about_title = get_field('about_title') ?? '';
$about_list = get_field('about_list') ?? [];

?>
<section class="section-about-us pd-50-0">
    <div class=" container">
        <div class="row">
            <div class="col-md-12">
                <div class="color-gradient-blue text-center pd-50-0">
                    <h2 class="heading"><?php echo $about_title ?></h2>
                </div>
                <?php 
                    if (count($about_list) > 0) {
                        foreach ($about_list as $key => $value) {
                            if ($key == 0) $class = 'row-first';
                            else $class = '';
                            echo '<div class="row ' . $class .'" data-aos="fade-right">
                                <div class="col-lg-4 col-md-12 div-col">
                                    <p class="bg-blue">
                                        ' . wp_get_attachment_image($value['icon'],'full', true, array('class' => 'info-brand-image', 'alt' => get_the_title($value['icon']))) . '
                                    </p>
                                </div>
                                <div class="col-lg-8 col-md-12 div-col">
                                    <p class="">' . $value['text'] . '</p>
                                </div>
                            </div>';
                        }
                    }
                 ?>
            </div>
        </div>
    </div>
</section>