<?php get_template_part('templates/post/content-meta'); ?>

<div class="blogContent">
	<?php if (ct_get_option("posts_index_show_image", 1)): ?>
		<?php
	            $embed = get_post_meta($post->ID, 'videoCode', true);
	            if( !empty( $embed ) ) {
	                echo stripslashes(htmlspecialchars_decode($embed));
	            } else {
		            ct_post_audio($post->ID, 680);
	            }
	        ?>
	<?php endif;?>
    <br>

	<?php get_template_part('templates/post/content-tags'); ?>

			<?php get_template_part('templates/post/content-read-more'); ?>
</div>
