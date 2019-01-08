<?php get_template_part('templates/post_single/content-meta'); ?>

<div class="blogContent">
	<?php if (ct_get_option("posts_single_show_content", 1)): ?>
		<?php $quote = get_post_meta($post->ID, 'quote', true); ?>
		<?php echo do_shortcode('[blockquote]' . $quote . '[/blockquote]')?>
	<?php endif;?>
    <br>

	<?php get_template_part('templates/post_single/content-tags'); ?>
</div>
