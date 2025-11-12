<?php 
 	$title = get_field('text_title');
	$content = get_field('privacy_policy_content');
?>
<section class="privacy_policy-page">
	<div class="wrap_img-bg">
		<?php echo wp_get_attachment_image(840,'full', true, array('class' => 'background_image')); ?>
	</div>
      <div class="container privacy_policy-container">
        <div class="privacy_policy-heading">
          <h1 class="title gradient-text uppercase" data-text="<?php echo $title; ?>"><?php echo $title; ?></h1>
          <!-- <?php echo wp_get_attachment_image(268,'full', true, array('class' => 'icon_foliage')); ?> -->
        </div>
        <div class="privacy_policy-content">
          <?php echo $content; ?>
        </div>
      </div>
    </section>