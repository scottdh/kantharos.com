<?php $data = ct_get_posts_grouped_by_cat(array('post_type' => 'faq', 'showposts' => -1), 'faq_category');?>

<div class="row-fluid topSpace">
    <div class="span4">
		<?php if($data):?>
            <div id="faq1" class="faqMenu" data-spy="affix" data-offset-top="160">
    	        <ul class="nav">
		        <?php $counter = 0;?>
				<?php foreach($data as $catId => $details): ?>
				    <?php if(isset($details['cat'])):?>
				        <?php $counter++;?>
			            <li<?php if($counter==1):?> class="active"<?php endif; ?>><a href="#q<?php echo $catId?>"><?php echo $details['cat']; ?></a></li>
				    <?php endif;?>
				<?php endforeach;?>
	            </ul>
	        </div>
		<?php endif;?>
    </div>

	<div class="span8">
		<?php if($data):?>
			<?php foreach($data as $catId => $details): ?>
				<div class="sectionFaq" id="q<?php echo $catId;?>">
			    <?php if(isset($details['posts']) && isset($details['cat'])):?>
					<?php $html = '[accordion header="' . $details['cat'] . '"]'; ?>
					<?php foreach($details['posts'] as $faq): ?>
						<?php $html .= '[accordion_item title="' . $faq->post_title . '"]' . $faq->post_content . '[/accordion_item]'; ?>
					<?php endforeach; ?>
					<?php $html .= '[/accordion]';?>
					<?php echo do_shortcode($html)?>
			    <?php endif;?>
				</div>
			<?php endforeach;?>
		<?php endif;?>
    </div>
</div>

<script type="text/javascript">
    /* scrool spy faq with smooth scroll */
    function faqSmoothScroll(){
        jQuery('.faqMenu a').bind('click', function(e) {
           e.preventDefault();
           jQuery('html, body').animate({
               scrollTop: jQuery(this.hash).offset().top }, 300);
        });
    }
    jQuery(document).ready(function () {
         faqSmoothScroll();
     });
</script>