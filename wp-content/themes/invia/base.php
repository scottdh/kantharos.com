<?php get_template_part('templates/header'); ?>
<?php $faqData = get_post() && ct_get_option('faq_index_page') == get_the_ID() ? 'data-spy="scroll" data-target="#faq1" data-offset="5"' : '';?>
<body <?php body_class((function_exists('icl_object_id') ? (ICL_LANGUAGE_CODE . ' ') : '').(ct_use_boxed_layout() ? 'boxed ' : '') . ct_get_option('style_layout_background', 'default ')); ?> <?php echo $faqData?>>

<div id="boxedWrapper">
<?php get_template_part('templates/head-top-navbar');?>

    <div class="container">
		<?php include roots_template_path(); ?>
    </div>

<?php get_template_part('templates/footer'); ?>

	<a href="#" id="toTop" class="entypo up-open"><i></i> Back to top</a>
</div>
<!--footer-->
<?php wp_footer(); ?>
</div>

</body>
</html>
