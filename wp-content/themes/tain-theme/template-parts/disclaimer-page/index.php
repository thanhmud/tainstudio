<?php 
 	$title = get_field('text_title');
	$content = get_field('text_content_disclaimer');
?>
<section class="disclaimer_page">
	<div class="wrap_img-bg">
		<?php echo wp_get_attachment_image(840,'full', true, array('class' => 'background_image')); ?>
	</div>
      <div class="container disclaimer_container">
        <div class="disclaimer_heading">
          <h1 class="title gradient-text uppercase" data-text="<?php echo $title; ?>"><?php echo $title; ?></h1>
		  <!-- <?php echo wp_get_attachment_image(268,'full', true, array('class' => 'icon_foliage')); ?> -->
        </div>
        <div class="disclaimer_content">
		  <?php echo $content; ?>
        </div>
      </div>
    </section>  