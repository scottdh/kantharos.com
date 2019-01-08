<div class="blogTitle">
	<?php if (ct_get_option("posts_index_show_comments_link", 1)): ?>
        <a href="<?php the_permalink()?>#comments" class="btn metaIcon text pull-right" data-toggle="tooltip" title="<?php echo wp_count_comments(get_the_ID())->approved?> <?php echo __("comments", "ct_theme");?>"><?php echo wp_count_comments(get_the_ID())->approved?><span class="entypo comment"><i></i></span></a>
	<?php endif;?>

	<?php if (ct_get_option("posts_index_show_title", 1)): ?>
		<?php $format = get_post_format();?>
		<?php if($format == "link"): ?>
			<?php $link = get_post_meta($post->ID, 'link', true); ?>
			<h3 class="big"><a href="<?php echo $link; ?>" target="_blank"><?php the_title(); ?></a></h3>
		<?php endif;?>
		<?php if($format != 'aside' && $format != 'link'): ?>
			<h3 class="big"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php endif;?>
	<?php endif;?>

	<?php if (ct_get_option("posts_index_show_date", 1) || ct_get_option("posts_index_show_author", 1)): ?>
        <span class="metaData"><span class="entypo clock"><i></i></span><?php _e('Posted ', 'ct_theme')?>
	<?php endif;?>
	<?php if (ct_get_option("posts_index_show_date", 1)): ?>
		<?php _e('on', 'ct_theme')?> <strong><?php echo get_the_date(); ?></strong>
	<?php endif;?>
	<?php if (ct_get_option("posts_index_show_author", 1)): ?>
		<?php _e('by', 'ct_theme')?> <strong><?php the_author_posts_link() ?></strong></span>
	<?php endif;?>

	<?php $cats = get_the_terms(get_the_ID(), 'category'); ?>
	<?php if (ct_get_option("posts_index_show_categories", 1) && $cats): ?>
        <span class="metaData"><span class="entypo tag"><i></i></span><?php the_category(', ', '', get_the_ID()) ?></span>
	<?php endif;?>
</div>