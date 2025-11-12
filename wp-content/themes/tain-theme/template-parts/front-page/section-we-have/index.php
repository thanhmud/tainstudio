<?php
$current_language = pll_current_language();
$we_have_title = get_field('we_have_title') ?? '';
$we_have_sub_title = get_field('we_have_sub_title') ?? '';
$we_have_list = get_field('we_have_list') ?? [];
$contact_button_text = get_field('contact_button_text') ?? '';
$contact_text = get_field('contact_text') ?? '';

?>
 <section class="section-we-have section pd-50-0" id="section2">
    <div class="section-container container">
        <div>
            <h2 class="heading color-main" data-aos="fade-down"> <?php echo $we_have_title ?> </h2>
            <h3 data-aos="fade-down"><?php echo $we_have_sub_title ?> </h3>
            <div class="content mt-30" >
                <?php 
                    if (count($we_have_list) > 0) {
                        foreach ($we_have_list as $key => $value) {
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
            <p class="note mt-30 mb-10" data-aos="fade-right"><a href="contact"><?php echo $contact_button_text ?></a> <?php echo $contact_text ?></p>
        </div>
    </div>
</section>