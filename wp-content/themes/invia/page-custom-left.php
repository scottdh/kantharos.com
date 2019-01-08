<?php
/*
Template Name: Left Sidebar Template
*/
?>
<?php get_template_part('templates/page', 'head'); ?>
<?php $breadcrumbs = ct_show_single_post_breadcrumbs('page') ? 'yes' : 'no';?>
<?php $pageTitle = ct_get_single_post_title('page');?>
<?php $subTitle = ct_get_single_post_subtitle('page');?>
<?php if($pageTitle || $breadcrumbs == "yes"):?>
	<?php echo do_shortcode('[title_row header="' . $pageTitle . '" subheader="' . $subTitle . '" breadcrumbs="' . $breadcrumbs . '"]')?>
<?php endif;?>
<?php get_template_part('templates/content', 'page-custom-left'); ?>