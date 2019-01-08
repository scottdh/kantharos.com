<?php
//The Query
global $wp_query;
$arrgs = $wp_query->query_vars;
$arrgs['posts_per_page'] = ct_get_option("posts_index_per_page", 3);
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$arrgs['paged'] = $paged;
$wp_query->query($arrgs);
?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('blogItem'); ?>>
	    <?php   $format = get_post_format();
	            $format = $format ? $format : 'standard';
	   		    get_template_part('templates/post/content-' . $format);?>
    </div> <!-- / blogItem -->
	<?php endwhile; ?>

<?php if (isset($wp_query) && $wp_query->max_num_pages > 1) : ?>
	<?php if ($paged != 1): ?>
		<a href="<?php echo get_previous_posts_page_link();?>" class="btn btn-icon left btn-inverse pull-left">
	       <span class="entypo left-open-mini"><i></i></span>
	       <?php _e('previous page', 'ct_theme')?>
	    </a>
	<?php endif;?>
	<?php if ($paged != $wp_query->max_num_pages): ?>
	    <a href="<?php echo get_next_posts_page_link() ?>" class="btn btn-icon right btn-inverse pull-right">
		    <?php _e('next page', 'ct_theme')?>
	        <span class="entypo right-open-mini"><i></i></span>
	    </a>
	<?php endif;?>
	<?php if (false): ?><?php posts_nav_link(); ?><?php endif; ?>
	<?php endif; ?>


<?php else: ?>
<div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">&times;</a>

    <p><?php _e('Sorry, no results were found.', 'ct_theme'); ?></p>
</div>
<?php endif; ?>