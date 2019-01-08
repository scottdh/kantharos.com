<?php if (ct_get_option("posts_index_show_more", 1)): ?>
    <a href="<?php the_permalink()?>" class="btn btn-icon double">
        <span class="entypo doc-text"><i></i></span>
        <?php _e('read More', 'ct_theme')?>
        <span class="entypo right-open-mini"><i></i></span>
    </a>
<?php endif;?>