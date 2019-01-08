<?php $class = ct_get_option('general_use_horizontal_menu', 0) ? ' horizontal-menu' : '';?>
<div class="navbar navbar-static-top<?php echo $class; ?>">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
			<?php if ($logo = ct_get_option('general_logo')) { ?>
            <a class="brand" href="<?php echo home_url(); ?>"><img src="<?php echo esc_url($logo)?>" alt="logo"/></a>
			<?php } elseif ($plain = ct_get_option('general_logo_html')) { ?>
			<?php echo $plain ?>
			<?php };?>
            <div class="nav-collapse" id="nav-main">
				<?php if (has_nav_menu('primary_navigation')) {
				wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav pull-left'));
			}?>
            </div>
	        <ul class="menuIcon pull-right">
		        <?php if($twit = ct_get_option('general_twit_user', '')):?><li class="twitter"><a href="http://www.twitter.com/<?php echo $twit;?>">facebook</a></li><?php endif;?>
				<?php if($fb = ct_get_option('general_fb_user', '')):?><li class="facebook"><a href="http://www.facebook.com/<?php echo $fb;?>">twitter</a></li><?php endif;?>
				<?php if(ct_get_option('general_show_search', 0)):?><li class="search"><a href="<?php echo ct_get_blog_url()?>">search</a></li><?php endif;?>
            </ul>
        </div>
    </div>
</div>
