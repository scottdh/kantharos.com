<div id="footer">
    <div class="container">
        <div class="row-fluid">
            <div class="span3">
	            <?php dynamic_sidebar('sidebar-footer1'); ?>
            </div>
            <div class="span3">
	            <?php dynamic_sidebar('sidebar-footer2'); ?>
            </div>
            <div class="span3">
	            <?php dynamic_sidebar('sidebar-footer3'); ?>
            </div>
            <div class="span3">
	            <?php dynamic_sidebar('sidebar-footer4'); ?>
            </div>


        </div>
    </div>

    <div class="footNotes">
        <div class="container">
            <div class="row-fluid">
                <div class="span4">
                    <p class="pull-left">
	                    <?php echo strtr(ct_get_option('general_footer_text', ''), array('%year%' => date('Y'), '%name%' => get_bloginfo('name', 'display')))?>
	                    <?php dynamic_sidebar('sidebar-footer5'); ?>
                    </p>
	            </div>
		        <div class="span8">
		            <?php dynamic_sidebar('sidebar-footer6'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / footer -->