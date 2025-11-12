<?php
$current_language = pll_current_language(); 
?>
<section class="page_404">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="col-sm-10 col-sm-offset-1  text-center">
                    <div class="four_zero_four_bg">
                        <h1 class="text-center ">404</h1>
                    </div>

                    <div class="contant_box_404">
                        <h3 class="h2">
                            <?php if ($current_language === 'th') : ?>
                                ดูเหมือนว่าคุณจะหลงทาง
                            <?php else : ?>
                                Look like you're lost
                            <?php endif; ?>
                        </h3>

                        <p>
                            <?php if ($current_language === 'th') : ?>
                                หน้าที่คุณกำลังมองหาไม่มีอยู่!
                            <?php else : ?>
                                the page you are looking for not available!
                            <?php endif; ?>
                        </p>

                        <a href="<?php echo home_url(); ?>" class="link_404">
                            <?php if ($current_language === 'th') : ?>
                                ไปที่หน้าแรก
                            <?php else : ?>
                                Go to Home
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>