<?php $tags = get_the_tags()?>
<?php if(ct_get_option("posts_index_show_tags", 1) && $tags):?>
	<?php the_tags('<div class="blogTags pull-right">', ', ', '</div>')?>
<?php endif;?>
