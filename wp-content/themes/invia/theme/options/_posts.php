<?php

$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_114_list.png',
	'title' => __('Index', 'ct_theme'),
	'desc' => __("Setup main Blog page ie. posts list", 'ct_theme'),
	'group' => __("Posts", 'ct_theme'),
	'fields' => array(
		array(
			'id' => "posts_index_page",
			'type' => 'pages_select',
			'title' => __("Index page", 'ct_theme'),
			'desc' => __('Which page should be as blog index?', 'ct_theme')
		),
		array(
			'id' => 'info',
			'type' => 'info',
			'desc' => __('<h4>Collection options</h4>', 'ct_theme')
		),
		array(
			'id' => 'posts_index_show_page_title',
			'title' => __("Show posts index page title", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_index_show_breadcrumbs',
			'title' => __("Show breadcrumbs", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_index_per_page',
			'title' => __("Posts per page", 'ct_theme'),
			'type' => 'text',
			'std' => 10
		),
		array(
			'id' => 'posts_index_show_date',
			'title' => __("Date", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_index_show_image',
			'title' => __("Image / video / audio / gallery", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_index_show_title',
			'title' => __("Title / quote author", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_index_show_excerpt',
			'title' => __("Excerpt", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_index_show_fulltext',
			'title' => __("Full content", 'ct_theme'),
			'type' => 'select_show',
			'std' => 0
		),
		array(
			'id' => 'posts_index_show_categories',
			'title' => __("Categories", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_index_show_tags',
			'title' => __("Tags", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_index_show_comments_link',
			'title' => __("Comments link", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_index_show_author',
			'title' => __("Author link", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_index_show_more',
			'title' => __("Read more link", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_index_sidebar',
			'title' => __("Sidebar", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
	)
);
$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_151_edit.png',
	'title' => __('Single', 'ct_theme'),
	'group' => __("Posts", 'ct_theme'),
	'desc' => __("Setup single post settings", 'ct_theme'),
	'fields' => array(
		array(
			'id' => 'posts_single_page_title',
			'title' => __("Post page title", 'ct_theme'),
			'type' => 'text',
			'std' => __("Our blog", 'ct_theme')
		),
		array(
			'id' => 'posts_single_show_breadcrumbs',
			'title' => __("Show breadcrumbs", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_single_show_date',
			'title' => __("Date", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_single_show_image',
			'title' => __("Image / video / audio / gallery", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_single_show_title',
			'title' => __("Title / quote author", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_single_show_excerpt',
			'title' => __("Excerpt", 'ct_theme'),
			'type' => 'select_show',
			'std' => 0
		),
		array(
			'id' => 'posts_single_show_content',
			'title' => __("Full content", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_single_show_categories',
			'title' => __("Categories", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_single_show_tags',
			'title' => __("Tags", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_single_show_comments_link',
			'title' => __("Comments link", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_single_show_author',
			'title' => __("Author link", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_single_show_comments',
			'title' => __("Comments", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_single_show_comment_form',
			'title' => __("Comment form", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'posts_single_sidebar',
			'title' => __("Sidebar", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
	)
);
