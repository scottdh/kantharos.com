<?php $width = 720; ?>
<?php $height = 260; ?>
<?php if (has_post_thumbnail(get_the_ID())): ?>
<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array($width, $height)); ?>
<?php $imageUrl = $image[0]; ?>
<div class="blogPhoto">
    <a href="<?php echo get_permalink(get_the_ID())?>"><img src="<?php echo $imageUrl?>" alt=" " class="easyFrame"></a>
</div>
<?php endif; ?>