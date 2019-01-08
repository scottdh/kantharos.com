<?php while (have_posts()) : the_post(); ?>
<div class="blogItem">
	<?php   $format = get_post_format();
            $format = $format ? $format : 'standard';
            get_template_part('templates/post_single/content-' . $format);?>
</div>

<?php comments_template('/templates/comments.php'); ?>

<?php endwhile; ?>