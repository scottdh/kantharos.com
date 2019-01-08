<?php $width = 720; ?>
<?php $height = 260; ?>
<?php $imageUrl = '';
$args = array(
	'post_type' => 'attachment',
	'numberposts' => -1,
	'post_status' => null,
	'post_parent' => get_the_ID()
);

$attachments = get_posts($args);
$code = '[nivo_slider]'
?>

<?php if ($attachments): ?>
	<?php foreach ($attachments as $attach): ?>
		<?php $image = wp_get_attachment_image_src($attach->ID, array($width, $height)); ?>
		<?php $imageUrl = $image[0]; ?>
		<?php $code .= ('[nivo_slider_item imgsrc="' . $imageUrl . '"]') ?>
	<?php endforeach; ?>
<?php endif;

$code .= "[/nivo_slider]";

echo do_shortcode($code)?>