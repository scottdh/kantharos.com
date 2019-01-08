<?php get_template_part('templates/post_single/content-meta'); ?>

<div class="blogContent">
	<?php if (ct_get_option("posts_single_show_excerpt", 0)): ?>
	    <?php the_excerpt();?>
	<?php endif;?>
	<?php if (ct_get_option("posts_single_show_content", 1)): ?>
	        <?php the_content();?>
	<?php endif;?>
    <br>

	<?php get_template_part('templates/post_single/content-tags'); ?>
</div>
