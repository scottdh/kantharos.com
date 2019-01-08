<?php
/*
Template Name: Portfolio Template
*/
?>
<?php get_template_part('templates/page', 'head'); ?>
<?php $breadcrumbs = ct_show_index_post_breadcrumbs('portfolio') ? 'yes' : 'no';?>
<?php $pageTitle = ct_get_index_post_title('portfolio');?>
<?php $subTitle = ct_get_index_post_subtitle('portfolio');?>
<?php if($pageTitle || $breadcrumbs == "yes"):?>
	<?php echo do_shortcode('[title_row header="' . $pageTitle . '" subheader="' . $subTitle . '" breadcrumbs="' . $breadcrumbs . '"]')?>
<?php endif;?>
<?php get_template_part('templates/content', 'portfolio'); ?>