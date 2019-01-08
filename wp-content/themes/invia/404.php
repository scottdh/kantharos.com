<?php get_template_part('templates/page', 'head'); ?>

<?php echo do_shortcode('[title_row header="' . __('Error', 'ct_theme') . '"]')?>
<div class="row-fluid">
        <div class="span12">
            <div class="lineBox right">
                <div class="inner">
                    <a href="/" class="btn metaIcon" data-toggle="tooltip" title="Home"><span class="entypo home"><i></i>Home</span></a>
                    <span class="btn btn-icon left btn-primary"><span class="entypo cancel-circled"><i></i></span>404</span>
                </div>
            </div>
        </div>
    </div>
    <!-- / row-fluid -->

    <div class="row-fluid">
        <div class="span1">

        </div>
        <div class="span11">
            <div class="page404">
                <span class="info404">404</span>
	            <p><?php _e("Sorry, that page doesn't exist!", 'ct_theme')?></p>

                <div class="inner">
	                <p><?php _e('Maybe something moved, or you mistyped.', 'ct_theme')?></p>
                    <div class="navigation404">
                        <a href="/" class="btn btn-icon right btn-primary pull-left">
	                        <?php _e('go back', 'ct_theme')?>
                            <span class="entypo right-open-mini"><i></i></span>
                        </a>
                        <span class="pull-left"><?php _e('or', 'ct_theme')?></span>


	                    <?php get_search_form(); ?>
                    </div>
                    <!-- / nav404 -->
                </div>
                <!-- / inner -->
            </div>
            <!-- / 404page -->
        </div>
    </div>