<?php get_template_part('templates/post/content-meta'); ?>

<?php if (ct_get_option("posts_index_show_image", 1)): ?>
	<?php get_template_part('templates/post/content-featured-image'); ?>
<?php endif; ?>


<div class="blogContent">
	<?php get_template_part('templates/post/content-tags'); ?>

			<?php get_template_part('templates/post/content-read-more'); ?>
</div>
