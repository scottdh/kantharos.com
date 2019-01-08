<?php get_template_part('templates/post_single/content-meta'); ?>

<div class="blogContent">
	<?php if (ct_get_option("posts_single_show_image", 1)): ?>
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

	<?php get_template_part('templates/post_single/content-tags'); ?>
</div>
