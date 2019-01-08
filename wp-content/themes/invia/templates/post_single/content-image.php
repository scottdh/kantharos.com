<?php get_template_part('templates/post_single/content-meta'); ?>

<?php if (ct_get_option("posts_single_show_image", 1)): ?>
	<?php get_template_part('templates/post_single/content-featured-image'); ?>
<?php endif; ?>


<div class="blogContent">
	<?php get_template_part('templates/post_single/content-tags'); ?>
</div>
