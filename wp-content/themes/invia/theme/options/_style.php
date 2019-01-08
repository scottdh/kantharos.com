<?php


$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_086_display.png',
	'title' => __('Layout', 'ct_theme'),
	'group' => __("Style", 'ct_theme'),
	'fields' => array(
		array(
			'id' => 'style_layout_boxed',
			'title' => __("Use boxed layout?", 'ct_theme'),
			'type' => 'select',
			'options' => array('yes' => __('yes', "ct_theme"), 'no' => __('no', "ct_theme"),),
			'std' => 'no'
		),
		array(
			'id' => 'style_layout_background',
			'title' => __("Global background pattern", 'ct_theme'),
			'type' => 'select',
			'options' => array(
				'default' => __('default', "ct_theme"),
				'az_subtle' => __('az subtle', "ct_theme"),
				'black_lozenge' => __('black_lozenge', "ct_theme"),
				'dark_wall' => __('dark_wall', "ct_theme"),
				'escheresque_ste' => __('escheresque_ste', "ct_theme"),
				'grey' => __('grey', "ct_theme"),
				'knitting250px' => __('knitting250px', "ct_theme"),
				'linen' => __('linen', "ct_theme"),
				'mochaGrunge' => __('mochaGrunge', "ct_theme"),
				'nasty_fabric' => __('nasty_fabric', "ct_theme"),
				'natural_paper' => __('natural_paper', "ct_theme"),
				'subtle_white_feathers' => __('subtle_white_feathers', "ct_theme"),
				'wild_oliva' => __('wild_oliva', "ct_theme"),
			),
			'std' => 'default'
		),
	)
);


$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_100_font.png',
	'title' => __('Font', 'ct_theme'),
	'group' => __("Style", 'ct_theme'),
	'fields' => array(
		array(
			'id' => 'style_font_style',
			'title' => __("Font style", 'ct_theme'),
			'type' => 'google_webfonts',
			'options' => array("Arial" => "Arial")
		),

		array(
			'id' => 'style_font_size',
			'type' => 'text',
			'std' => '13',
			'title' => __('Default font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h1',
			'type' => 'text',
			'std'=>28,
			'title' => __('H1 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h2',
			'type' => 'text',
			'std'=>24,
			'title' => __('H2 font size (px)', 'ct_theme'),
		), array(
			'id' => 'style_font_size_h3',
			'type' => 'text',
			'std'=>18,
			'title' => __('H3 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h4',
			'type' => 'text',
			'std'=>16,
			'title' => __('H4 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h5',
			'type' => 'text',
			'std'=>14,
			'title' => __('H5 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h6',
			'type' => 'text',
			'std'=>13,
			'title' => __('H6 font size (px)', 'ct_theme'),
		)
	)
);

$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_091_adjust.png',
	'title' => __('Color', 'ct_theme'),
	'desc' => __(sprintf("To setup colors please use built-in Wordpress Theme Customizer available %s", '<a href="' . admin_url('customize.php') . '">' . __('here', 'ct_theme') . '</a>'), 'ct_theme'),
	'group' => __("Style", 'ct_theme'),
	'fields' => array()
);