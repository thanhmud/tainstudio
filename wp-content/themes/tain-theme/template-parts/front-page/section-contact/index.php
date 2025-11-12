<?php
$link_google_map = get_field('link_google_map');
$contact_email = get_field('email', 'option');
$hotline = get_field('phone', 'option');
$current_language = pll_current_language(); 

$contact_heading = get_field('heading');
$contact_desc = get_field('desc');
$acf_contact_email = get_field('contact_email');
$acf_contact_hot_line = get_field('contact_hot_line');
$acf_contact_support = get_field('contact_support');

$language_arr = [
    'en' => ['EMAIL', 'HOTLINE', 'TIME WORK', 'Thank you for contacting us!', 'We will contact you as soon as possible', 'Close'], 
    'th' => ['อีเมล', 'สายด่วน', 'เวลาทำงาน', 'ขอบคุณที่ติดต่อเรา!', 'เราจะติดต่อคุณโดยเร็วที่สุด', 'ปิด'], 
];

?>
<!-- <section class="section-contact section pd-50-0">
    <div class="section-container container">
        <div>
            <h2 class="heading color-main"> Liên hệ với chúng tôi </h2>
            <h3>Bạn đang tìm kiếm một đối tác uy tín để phát triển website, xây dựng thương hiệu online hoặc tối ưu giải pháp số cho doanh nghiệp? </h3>
            <div class="contact_infor-content">
                <div class="contact_infor-left">
                    <div class="title_heading">
                        <div class="mt-20">
                            <p>Hotline:</p>
                            <h5>034.5555.987</h5>
                        </div>
                        <div class="mt-20">
                            <p>Email:</p>
                            <h5>contact@tainstudio.com</h5>
                        </div>
                        <div class="mt-20">
                            <p>Address:</p>
                            <h5>Số 117, Xóm Hòa Bình, Cụm 3, Liên Trung, Đan Phượng, Hà Nội</h5>
                        </div>
                        <div class="mt-20">
                            <p>Website:</p>
                            <h5>TainStudio.com</h5>
                        </div>
                    </div>
                    <iframe
                        class="mt-20"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14888.172291181136!2d105.70693225826126!3d21.110848884436006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134558775d96277%3A0xc42f4f7e3ffc3a96!2zTGnDqm4gVHJ1bmcsIMSQYW4gUGjGsOG7o25nLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1754013764481!5m2!1svi!2s"
                        width="90%"
                        height="300"
                        style="border: 0"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="contact_infor-right">
                    <div class="contact_form">
                        <p class="sub_content">
                            Đừng ngần ngại – chúng tôi luôn sẵn sàng lắng nghe và đồng hành cùng bạn từ bước đầu tiên!
                        </p>
                        <?php echo do_shortcode('[contact-form-7 id="07531ac" title="Contact Information"]'); ?>
                    </div>
                    <div class="over_popup" id="overPopup" onclick="closeModalNotification()"></div>
                    <div class="popup_notification">
                        <?php echo wp_get_attachment_image(701, 'full', true, array('class' => 'notification-icon')); ?>
                        <p class="notification-title"><?php echo $language_arr[$current_language][3];?></p>
                        <p class="notification-subTitle">
                        <?php echo $language_arr[$current_language][4];?>     
                        </p>
                        <button
                            type="button"
                            onclick="closeModalNotification()"
                            class="notification-button">
                            <?php echo $language_arr[$current_language][5];?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
