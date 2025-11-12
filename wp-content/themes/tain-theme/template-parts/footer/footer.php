<?php

$current_language = pll_current_language();
if($current_language == 'vi') $post_id = 1383;
else $post_id = 12;

$socials = get_field('social_list', 'option');
$logo_footer = get_field('logo_footer', 'option');

$contact_title = get_field('contact_title', $post_id) ?? '';
$contact_sub_title = get_field('contact_sub_title', $post_id) ?? '';
$contact_list = get_field('contact_list', $post_id) ?? [];
$contact_form_title = get_field('contact_form_title', $post_id) ?? '';
$contact_form_sub_title = get_field('contact_form_sub_title', $post_id) ?? '';

$language_arr = [
    'en' => [get_field('desc', 'option'), 'Thank you for contacting us', 'We will contact you as soon as possible', 'Close'], 
    'vi' => [get_field('desc_vi','option'), 'Cảm ơn bạn bạn đã liên hệ với chúng tôi', 'Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất', 'Đóng'], 
];

?>
<footer class="footer">
    <section class="section-contact section pd-50-0">
        <div class="section-container container">
            <div>
                <h2 class="heading color-main" data-aos="fade-down"><?php echo $contact_title ?></h2>
                <h3 data-aos="fade-down"><?php echo $contact_sub_title ?> </h3>
                <div class="contact_infor-content">
                    <div class="contact_infor-left">
                        <div class="title_heading">
                            <?php 
                                if (count($contact_list) > 0) {
                                    foreach ($contact_list as $key => $value) {
                                        echo '<div class="mt-20" data-aos="fade-right">
                                            <p class="mb-10">' . $value['text'] . '</p>
                                            <h5>' . $value['value'] . '</h5>
                                        </div>';
                                    }
                                }
                             ?>
                        </div>
                        <iframe
                            class="mt-20"   
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14888.170202230925!2d105.71613786382615!3d21.11086970659255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134558775d96277%3A0xc42f4f7e3ffc3a96!2zTGnDqm4gVHJ1bmcsIMSQYW4gUGjGsOG7o25nLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1762219209674!5m2!1svi!2s"
                            width="90%"
                            height="300"
                            style="border: 0"
                            allowfullscreen=""
                            loading="lazy"
                            title="Bản đồ Google Maps vị trí công ty TainStudio"
                            referrerpolicy="no-referrer-when-downgrade" data-aos="fade-right">
                        </iframe>
                    </div>
                    <div class="contact_infor-right" data-aos="fade-right">
                        <div class="contact_form">
                            <h3 class=""><?php echo $contact_form_title; ?></h3>
                            <p class="sub_content">
                                <?php echo $contact_form_sub_title; ?>
                            </p>
                            <?php echo do_shortcode('[contact-form-7 id="07531ac" title="Contact Information"]'); ?>
                        </div>
                        <div class="over_popup" id="overPopup" onclick="closeModalNotification()"></div>
                        <div class="popup_notification">
                            <?php echo wp_get_attachment_image(701, 'full', true, array('class' => 'notification-icon', 'alt' => 'notification icon')); ?>
                            <p class="notification-title"><?php echo $language_arr[$current_language][1] ?></p>
                            <p class="notification-subTitle">
                               <?php echo $language_arr[$current_language][2] ?>
                            </p>
                            <button
                                type="button"
                                onclick="closeModalNotification()"
                                class="notification-button" aria-label="Button close modal"><?php echo $language_arr[$current_language][3] ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container footer-content">
            <div class="footer-description" data-aos="fade-down">
                <a href="/" >
                    <?php echo wp_get_attachment_image($logo_footer,'full', true, array('class' => 'logo-footer', 'alt' => 'Footer Logo')); ?>
                </a>
                <p class="footer-slogan"><?php echo $language_arr[$current_language][0] ?></p>
            </div>
            <div class="footer-menu">
                <div class="social-footer">
                    <div class="social-list" data-aos="fade-down">
                        <?php if ($socials) : ?>
                            <?php foreach ($socials as $social) : ?>
                                <div class="social-item">
                                    <a href="<?php echo $social['link_social']['url']; ?>"><?php echo wp_get_attachment_image($social['icon'], 'full', true, array('alt' => $social['link_social']['title'])); ?></a>
                                    <a href="<?php echo $social['link_social']['url']; ?>"><?php echo $social['link_social']['title'] ?></a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-menu container">
            <div class="footer-menu mt-30">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'container' => false,
                        'menu_class' => 'footer-nav',
                        'fallback_cb' => '__return_false'
                    ));
                ?>
            </div>
        </div>
    </section>
    <div class="copy-right">
        Copyright <?php echo date('Y') ?> TainStudio. All rights reserved.
    </div>
</footer>