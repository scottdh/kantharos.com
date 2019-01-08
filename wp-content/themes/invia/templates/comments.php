<?php
function theme_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="oneComment">
	        <div class="author pull-left">
		        <?php echo get_avatar($comment, $size = '50', $default = ''); ?>
	        </div>
	        <div class="inner">
		        <span class="metaData"><span class="entypo user"><i></i></span><strong><?php echo get_comment_author_link()?></strong></span>
	            <span class="metaData"><span class="entypo clock"><i></i></span><strong><?php echo get_comment_date()?></strong></span>

		        <?php comment_text() ?>
				<?php if(ct_get_option("posts_single_show_comment_form", 1)):?>
		            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				<?php endif;?>
	        </div>
		</div>
	<?php
}

?>
<?php if (((get_post_type()=='portfolio' && ct_get_option("portfolio_single_show_comments", 0)) || (get_post_type()=='post' && ct_get_option("posts_single_show_comments", 1)) || (get_post_type()=='page' && ct_get_option("pages_single_show_comments", 0))) && have_comments()): ?>
	<?php if(post_password_required()): ?>
		<div class="row-fluid">
	        <div class="span12">
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view and post comments.' , 'ct_theme' ); ?></p>
	        </div>
		</div>
		<?php return;?>
	<?php endif;?>
	<div class='blogComments comments'>
		<h3 id="comments"  class="heady"><?php _e('Comments', 'ct_theme')?>
            <span class="btn metaIcon text pull-right" data-toggle="tooltip" title="<?php echo wp_count_comments(get_the_ID())->approved?> <?php echo __("comments", "ct_theme");?>"><?php echo wp_count_comments(get_the_ID())->approved?><span class="entypo comment"><i></i></span></span>
        </h3>

	    <ul class="commentList">
	        <?php wp_list_comments(array('callback' => 'theme_comments', 'style' => 'ol'));?>
        </ul>
	</div>
	<!-- row-fluid -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) && false ) : ?>
		<nav class="comments_navigation">
			<div class="nav_previous"><?php previous_comments_link(); ?></div>
			<div class="nav_next"><?php next_comments_link(); ?></div>
		</nav>
	<?php endif; ?>
<?php endif; ?>

<?php if (((get_post_type()=='portfolio' && ct_get_option("portfolio_single_show_comment_form", 0)) || (get_post_type()=='post' && ct_get_option("posts_single_show_comment_form", 1)) || get_post_type()=='page' && ct_get_option("pages_single_show_comment_form", 0)) && comments_open()) : // Comment Form ?>
	<div id="respond" class="row-fluid">
	    <div class="span12">
		    <h3 id="comments" class="heady"><?php _e('Leave a Comment', 'ct_theme');?></h3>

			<?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
	            <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment', 'ct_theme'), wp_login_url(get_permalink())); ?></p>
			<?php else : ?>

		    <form class="" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	            <fieldset>
	                <?php if (is_user_logged_in()) : ?>
	                    <p class="logged"><?php printf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'ct_theme'), admin_url('profile.php'), $user_identity, wp_logout_url(get_permalink()))?></p>
	                <?php else : ?>
		                <label class="control-label"><?php _e('Name', 'ct_theme')?></label>
                        <input type="text" class="span4" id="inputName" name="author">
                        <label><?php _e('Email', 'ct_theme')?></label>
                        <input type="text" class="span4" id="inputEmail" name="email">
                        <label><?php _e('Website (optional)', 'ct_theme')?></label>
                        <input type="text" class="span4" id="inputWebsite" name="website">
		            <?php endif; ?>

		            <label><?php _e('Comment', 'ct_theme')?></label>
		            <textarea class="span12" id="msgArea" name="comment"></textarea>

		            <input type="submit" value="<?php _e('Submit Comment', 'ct_theme')?>" class="btn btn-primary">

		            <?php comment_id_fields(); ?>
                    <p><?php do_action('comment_form', get_the_ID()); ?></p>
                    <?php if(false):?><?php comment_form()?><?php endif;?>
	            </fieldset>
	        </form>
		    <?php endif; ?>
	    </div>
	</div>
<?php endif;