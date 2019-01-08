<?php while (have_posts()) : the_post(); ?>
	<?php $custom = get_post_custom(get_the_ID()); ?>

	<div class="row-fluid">
		<div class="span8">
			<?php if (ct_get_option("portfolio_single_show_image", 1)): ?>
				<?php get_template_part('templates/portfolio/content-single-portfolio', ctPortfolioType::getMethodFromMeta($custom)); ?>
			<?php endif; ?>
		</div>
		<div class="span4">
			<div class="portfolioDetails">

				<?php $cats = get_the_terms(get_the_ID(), 'portfolio_category'); ?>
				<?php if (ct_get_option("portfolio_single_show_cats", 1) && $cats): ?>
					<?php if ($cats): ?>
						<?php foreach ($cats as $cat): ?>
							<?php echo ct_get_object_icon_formatted($cat->name, $cat->term_id) ?>
						<?php endforeach; ?>
						<div class="clearfix"></div>
					<?php endif; ?>
				<?php endif; ?>


				<h3 class="light"><?php the_title(); ?></h3>
				<?php if (ct_get_option("portfolio_single_show_content", 1)): ?>
					<?php the_content(); ?>
				<?php endif; ?>
				</p>
				<br>
				<?php if (ct_get_option("portfolio_single_show_client", 1) && isset($custom['client'][0]) && $custom['client'][0]): ?>
					<?php $clientIcon = isset($custom['client_icon'][0]) && $custom['client_icon'][0] ? $custom['client_icon'][0] : 'user' ?>
					<p><span class="entypo metaText <?php echo $clientIcon; ?>"><i></i><?php echo $custom['client'][0]; ?></span></p>
				<?php endif; ?>
				<?php if (ct_get_option("portfolio_single_show_date", 1) && isset($custom['date'][0]) && $custom['date'][0]): ?>
					<?php $dateIcon = isset($custom['date_icon'][0]) && $custom['date_icon'][0] ? $custom['date_icon'][0] : 'calendar' ?>
					<p><span class="entypo metaText <?php echo $dateIcon; ?>"><i></i><?php echo $custom['date'][0]; ?></span></p>
				<?php endif; ?>
				<?php if (ct_get_option("portfolio_single_show_tools", 1) && isset($custom['tools'][0]) && $custom['tools'][0]): ?>
					<?php $toolsIcon = isset($custom['tools_icon'][0]) && $custom['tools_icon'][0] ? $custom['tools_icon'][0] : 'tools' ?>
					<p><span class="entypo metaText <?php echo $toolsIcon; ?>"><i></i><?php echo $custom['tools'][0]; ?></span></p>
				<?php endif; ?>

				<?php if (isset($custom['external_url'][0]) && $custom['external_url'][0]): ?>
					<?php $externalLabel = (isset($custom['external_label'][0]) && $custom['external_label'][0]) ? $custom['external_label'][0] : $custom['external_url'][0] ?>
					<br>
					<p>
						<a href="<?php echo $custom['external_url'][0] ?>"><span class="entypo globe dark metaText"><i></i><?php echo $externalLabel; ?></span></a>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php comments_template('/templates/comments.php'); ?>

	<?php if (ct_get_option("portfolio_single_show_other_projects", 1)): ?>
		<div class="row-fluid topSpace">
			<div class="span12">
				<?php ?>
				<?php echo do_shortcode('[divider header="' . __('Related work', 'ct_theme') . '"][works notids="' . get_the_ID() . '"]'); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php //highlight manu portfolio item ?>
	<?php if ($id = ct_get_option('portfolio_index_page')): ?>
		<?php
		if (function_exists('icl_object_id')) {
			$iclpageid = icl_object_id($id, 'page', true, ICL_LANGUAGE_CODE);
			$id = $iclpageid ? $iclpageid : $id;
		}
		?>
		<?php if ($page = get_post($id)): ?>
			<script type="text/javascript">
				jQuery(document).ready(function () {
					var $menu = jQuery('#nav-main');
					var $element = $menu.find('a[href*="/<?php echo $page->post_name?>/"]').parent();
					if ($element.length == 1) {
						$menu.find('li').removeClass('active');
						$element.addClass("active");
					}
				});
			</script>
		<?php endif; ?>
	<?php endif; ?>

<?php endwhile; ?>
