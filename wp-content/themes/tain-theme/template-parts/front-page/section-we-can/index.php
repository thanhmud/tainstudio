<?php

$we_can_title = get_field('we_can_title');
$we_can_sub_title = get_field('we_can_sub_title');
$we_can_list = get_field('we_can_list');
$we_can_contact_text = get_field('we_can_contact_text');

?>

<section class="section-we-can section pd-50-0" id="section3">
        <div class="section-container container">
            <div class="main-text">
                <h2 class="heading color-main" data-aos="fade-down"> <?php echo $we_can_title ?> </h2>
                <h3 data-aos="fade-down"><?php echo $we_can_sub_title ?> </h3>
                <div class="content mt-30" >
                    <?php 
                        if (count($we_can_list) > 0) {
                            foreach ($we_can_list as $key => $value) {
                                echo '<div class="item" data-aos="fade-right" data-aos-delay="' . $key . '00">
                                    <h4 class="child-title mb-10 color-main"><p class="mb-10">' . wp_get_attachment_image($value['icon'], "full", true, array('alt' => get_the_title($value['icon']))) . '</p> ' . $value['title'] . '</h4>
                                    <div class="child-content">
                                        <h5 class="bold mb-10">' . $value['sub_title'] . '</h5>
                                        <ul>';
                                            if (count($value['sub_list']) > 0) {
                                                foreach ($value['sub_list'] as $sub_key => $sub_value) {
                                                    echo '<li>' . $sub_value['sub_list_content'] . '</li>';
                                                }    
                                            }
                                            
                                        echo '</ul>
                                    </div>
                                </div>' ;
                            }
                        }
                    ?>
                </div>
                <!-- <p class="note mt-30 mb-10" data-aos="fade-right"> <?php echo $we_can_contact_text ?></p>      -->
            </div>
        </div>
    </section>


