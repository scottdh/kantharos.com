<?php $breadcrumbs = ct_show_single_post_breadcrumbs('portfolio') ? 'yes' : 'no';?>
<?php $pageTitle = ct_get_single_post_title('portfolio');?>
<?php $subTitle = ct_get_single_post_subtitle('portfolio');?>
<?php if($pageTitle || $breadcrumbs == "yes"):?>
	<?php echo do_shortcode('[title_row header="' . $pageTitle . '" subheader="' . $subTitle . '" breadcrumbs="' . $breadcrumbs . '"]')?>
<?php endif;?>

<div class="row-fluid">
    <div class="span12">
        <div class="lineBox short">
            <div class="inner">
	            <?php $prev = get_previous_post();?>
	            <?php $next = get_next_post();?>
				<?php if($next): ?>
	                <a href="<?php echo get_permalink($next->ID);?>" class="btn btn-icon left btn-primary">
	                   <span class="entypo left-open-mini"><i></i></span>
	                   <?php _e('previous', 'ct_theme');?>
	               </a>
		        <?php else: ?>
	                <span class="btn btn-icon left">
                       <span class="entypo left-open-mini"><i></i></span>
                       <?php _e('previous', 'ct_theme');?>
                   </span>
	            <?php endif; ?>
				<?php if($prev): ?>
	                <a href="<?php echo get_permalink($prev->ID);?>" class="btn btn-icon right btn-primary">
		                <?php _e('next', 'ct_theme');?>
	                   <span class="entypo right-open-mini"><i></i></span>
	               </a>
	            <?php else: ?>
                    <span class="btn btn-icon right">
	                    <?php _e('next', 'ct_theme');?>
	                    <span class="entypo right-open-mini"><i></i></span>
                    </span>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php get_template_part('templates/content', 'single-portfolio'); ?>
