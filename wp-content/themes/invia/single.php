<?php $breadcrumbs = ct_show_single_post_breadcrumbs('post') ? 'yes' : 'no';?>
<?php $pageTitle = ct_get_single_post_title('post');?>
<?php $subTitle = ct_get_single_post_subtitle('post');?>
<?php if($pageTitle || $breadcrumbs == "yes"):?>
	<?php echo do_shortcode('[title_row header="' . $pageTitle . '" subheader="' . $subTitle . '" breadcrumbs="' . $breadcrumbs . '"]')?>
<?php endif;?>

<div class="row-fluid">
	<?php if (is_404()): ?><div class="span9"><?php else: ?><div class="<?php ct_blog_post_class()?>"><?php endif;?>
        <div class="blogContainer">
			<?php get_template_part('templates/content', 'single'); ?>
        </div>
    </div>
	<?php if (ct_use_blog_post_sidebar()): ?>
    <div class="<?php roots_sidebar_class(); ?>">
		<?php get_template_part('templates/sidebar'); ?>
    </div>
	<?php endif;?>
</div>
