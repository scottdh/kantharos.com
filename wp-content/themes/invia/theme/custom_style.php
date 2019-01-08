<?php
function ct_get_theme_background($key, $selector) {
	// $background is the saved custom image, or the default image.
	$background = get_theme_mod($key . '_image');
	$background = str_replace('#', '', $background);
	// $color is the saved custom color.
	// A default has to be specified in style.css. It will not be printed here.
	$color = get_theme_mod($key . '_color');
	$color = str_replace('#', '', $color);

	if (!$background && (!$color || $color == '#')) {
		return;
	}

	$style = $color ? "background-color: #$color;" : '';
	if ($background) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod($key . '_background_repeat', 'repeat');
		if (!in_array($repeat, array('no-repeat', 'repeat-x', 'repeat-y', 'repeat'))) {
			$repeat = 'repeat';
		}
		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod($key . '_background_position_x', 'left');
		if (!in_array($position, array('center', 'right', 'left'))) {
			$position = 'left';
		}
		$position = " background-position: top $position;";

		$attachment = get_theme_mod($key . '_background_attachment', 'scroll');
		if (!in_array($attachment, array('fixed', 'scroll'))) {
			$attachment = 'scroll';
		}
		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}

	return $selector . '{' . $style . '}';
}
$motive = get_theme_mod('lead_color');
$buttonStart = get_theme_mod('button_color_start');
if (!$buttonStart) {
	$buttonStart = $motive;
}
$buttonEnd = get_theme_mod('button_color_end');
if (!$buttonEnd) {
	$buttonEnd = $buttonStart;
}
$backgroundColor = get_theme_mod('background_color');
$headerColor = get_theme_mod('header_background_color');
?>
<?php _custom_background_cb()?>

<style type="text/css" media="all">
	<?php $font = ct_get_option('style_font_style'); $fontSize = ct_get_option_pattern('style_font_size', 'font-size: %dpx;',13); ?>
	<?php if($font||$fontSize):?>
	body {
	<?php if ($font): ?> <?php $normalized = explode(':', $font); ?> <?php if (isset($normalized[1])): ?> font-family: '<?php echo $normalized[0]?>', sans-serif;
		font-weight: '<?php echo $normalized[1];?>';
	<?php endif; ?> <?php endif;?> <?php echo $fontSize?> <?php //default styles ?> <?php echo ct_get_option_pattern('style_color_basic_background', 'background-color: %s;')?> <?php echo ct_get_option_pattern('style_color_basic_background_image', 'background: url(%s) repeat;')?> <?php echo ct_get_option_pattern('style_color_basic_text', 'color: %s;')?> <?php if (ct_get_option('style_color_basic_background') && !ct_get_option('style_color_basic_background_image')): ?> background-image: none;
	<?php endif;?>
	}
	<?php endif;?>

	<?php echo ct_get_option_pattern('style_font_size_h1', 'h1{font-size: %dpx!important;}',28)?>
	<?php echo ct_get_option_pattern('style_font_size_h2', 'h2{font-size: %dpx!important;}',24)?>
	<?php echo ct_get_option_pattern('style_font_size_h3', 'h3{font-size: %dpx!important;}',18)?>
	<?php echo ct_get_option_pattern('style_font_size_h4', 'h4{font-size: %dpx!important;}',16)?>
	<?php echo ct_get_option_pattern('style_font_size_h5', 'h5{font-size: %dpx!important;}',14)?>
	<?php echo ct_get_option_pattern('style_font_size_h6', 'h6{font-size: %dpx!important;}',13)?>

	<?php if (isset($normalized[1])): ?>
	h1, h2, h3, h4, h5, h6 { font-family: '<?php echo $normalized[0]?>', sans-serif !important; }
	<?php endif;?>

	<?php if($backgroundColor):?>
	body { background-color: #<?php echo $backgroundColor?> }
	.lineBox .inner { background-color: #<?php echo $backgroundColor?> }
	<?php endif;?>

	<?php echo ct_get_theme_background('header_background','.navbar.navbar-static-top .navbar-inner')?>
	<?php echo ct_get_theme_background('footer_background','#footer')?>
	<?php echo ct_get_theme_background('subfooter_background','#footer .footNotes')?>
	<?php echo ct_get_theme_background('headers_background','div.titleBox')?>

	<?php if($c = get_theme_mod('icons_background_color')):?>
	i:before, li:before { color: <?php echo $c?> !important }
	<?php endif;?>

	<?php if($motive && $motive!='#'):?>

	.flickr_badge > div a:hover { border: 1px solid <?php echo $motive?>; }

	.navbar-static-top .navbar-inner {
		background: <?php echo $motive?>;
	}

	.dropdown-menu li > a:hover,
	.dropdown-menu li > a:focus,
	.dropdown-submenu:hover > a {
		color: <?php echo $motive?>;
	}

	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover {
		color: <?php echo $motive?>;
	}

	.dropdown-submenu:hover > a:after {
		border-left-color: <?php echo $motive?>;
	}

	.highlightBox {
		border-left: 6px solid <?php echo $motive?>;
	}

	.recentPostBox .medium a {
		color: <?php echo $motive?> !important;
	}
	.blockTwitter {
		background: <?php echo $motive?>;
	}

	.blockTwitter:after {
		color: <?php echo $motive?>;
	}

	.contactBox a {
		color: <?php echo $motive?>;
	}

	.contactMap .gmap-marker i:before {
		color: <?php echo $motive?>;
	}
	.contactInfoBox {
		background: <?php echo $motive?>;
	}
	.btn-primary {
		background: <?php echo $motive?>;
	}

	.btn-primary:hover {
		background: <?php echo $motive?>;
	}

	.btn-link:hover {
		color: <?php echo $motive?>;
	}
	.tab-content.version2 {
		background: <?php echo $motive?>;
	}

	.nav-tabs.version2 > li > a:hover {
		background-color: <?php echo $motive?>;
	}

	.nav-tabs.version2 > .active > a,
	.nav-tabs.version2 > .active > a:hover {
		background-color: <?php echo $motive?>;
	}

	.pretty-table table th {
		background: <?php echo $motive?>;
	}

	.priceBox .pricePlan {
		color: <?php echo $motive?>;
	}

	.priceBox .emphasis {
		color: <?php echo $motive?>;
	}

	.priceBox.spec .pricePlan {
		background: <?php echo $motive?>;
	}

	.priceBox.version2 .pricePlan {
		background: <?php echo $motive?>;
	}

	.priceBox.version2.spec {
		background: <?php echo $motive?>;
	}

	.priceBox.version2.spec .emphasis-2 btn {
		color: <?php echo $motive?>;
	}

	.progress .bar {
		background: <?php echo $motive?>;
	}

	ul.filterPortfolio li.active .btn,
	ul.filterPortfolio li .btn:hover {
		background: <?php echo $motive?>;
	}

	blockquote .fontello i:before {
		color: <?php echo $motive?>;
	}

	.sectionFaq .accordion .accordion-inner p:before {
		color: <?php echo $motive?>;
	}

	.faqMenu .active a, .faqMenu .active a:hover, .faqMenu a:hover {
		color: <?php echo $motive?>;
	}

	.metaData a {
		color: <?php echo $motive?>;
	}

	.promoBox {
		background: <?php echo $motive?>;
	}

	#toTop:hover {
		background: <?php echo $motive?>;
	}
	.box-mainslider .box-click {
		background: <?php echo $motive?>;
	}

	.nivo-directionNav a:hover {
		background: <?php echo $motive?>;
	}
	div.jp-play-bar,
	div.jp-volume-bar-value {
		background: <?php echo $motive?>;
	}
	.priceBox.version2.spec .emphasis-2 .btn {
		color: <?php echo $motive?>;
	}
	ul.commentList .oneComment .comment-reply-link {
		background: <?php echo $motive?>;
	}

	<?php endif;?>
	<?php /*custom style - code tab*/ ?>
	<?php echo ct_get_option('code_custom_styles_css')?>
</style>