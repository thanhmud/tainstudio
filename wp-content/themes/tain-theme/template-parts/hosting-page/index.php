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
    'zh' => ['电子邮件', '热线', '工作时间', '感谢您联系我们！', '我们将尽快与您联系', '关闭'], 
    'ms' => ['E-mel', 'HOTLINE', 'KERJA MASA', 'Terima kasih kerana menghubungi kami!', 'Kami akan menghubungi anda secepat mungkin', 'tutup']
];

?>
<section class="contact_infor-page">
    <div class="contact_infor_bg-img">
        <?php echo wp_get_attachment_image(43, 'full', true, array('class' => 'img_background')); ?>
    </div>
    <div class="container contact_infor-content">
        <div class="contact_infor-left">
            <div class="title_heading">
                <h1 class="title mb-30 gradient-text uppercase" data-text="<?php echo $contact_heading; ?>"><?php echo $contact_heading; ?></h1>
                <p class="flex align-items-center"><?php echo wp_get_attachment_image(1561, 'small', true, array('class' => 'address_icon')); ?><span class="text ml-10"><?php echo $acf_contact_email;?></span></p>
                <p class="flex align-items-center"><?php echo wp_get_attachment_image(1560, 'small', true, array('class' => 'address_icon')); ?><span class="text ml-10"><?php echo $acf_contact_hot_line;?></span></p>
                <p class="flex align-items-center"><?php echo wp_get_attachment_image(1559, 'small', true, array('class' => 'address_icon')); ?><span class="text ml-10"><?php echo $acf_contact_support; ?></span></p>
            </div>
            <iframe
                class=""
                src="<?php echo $link_google_map; ?>"
                width="100%"
                height="500"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <div class="contact_infor-right">
            <div class="contact_form">
                <p class="sub_content">
                    <?php echo $contact_desc; ?>
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
</section>
