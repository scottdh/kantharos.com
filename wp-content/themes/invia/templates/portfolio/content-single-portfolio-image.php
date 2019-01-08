<?php $imageUrl = '';
$width = 620;
$height = 1000; ?>

<?php if (has_post_thumbnail(get_the_ID())): ?>
	<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full'); ?>
	<?php $imageUrl = $image[0]; ?>
<?php endif; ?>
<img src="<?php echo $imageUrl;?>" alt="" class="easyFrame">