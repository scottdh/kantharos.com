<?php get_template_part('templates/post/content-meta'); ?>

<div class="blogContent">
	<?php if (ct_get_option("posts_index_show_excerpt", 1)): ?>
	    <?php the_excerpt();?>
	<?php endif;?>
	<?php if (ct_get_option("posts_index_show_fulltext", 0)): ?>
	        <?php the_content();?>
	<?php endif;?>
    <br>

	<?php get_template_part('templates/post/content-tags'); ?>

			<?php get_template_part('templates/post/content-read-more'); ?>
</div>
