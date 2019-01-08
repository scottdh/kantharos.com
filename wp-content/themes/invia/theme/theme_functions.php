<?php
/**
 * Helper functions for theme
 */


/**
 * Enqueue styles
 */
if (!function_exists('ct_theme_styles')) {
	function ct_theme_styles() {
		//add icons styles
		wp_enqueue_style('entypo', CT_THEME_ASSETS . '/css/icons/entypo/css/entypo.css');
		wp_enqueue_style('fontello', CT_THEME_ASSETS . '/css/icons/fontello/css/fontello.css');
	}
}

add_action('init', 'ct_theme_styles');


/**
 * Theme activation
 */

function theme_activation() {
	$theme_data = wp_get_theme();
	//add crop option
	if (!get_option("medium_crop")) {
		add_option("medium_crop", "1");
	} else {
		update_option("medium_crop", "1");
	}

	//add current version
	add_option('invia_theme_version', $theme_data->get('Version'));
}

theme_activation();

/**
 * returns video html for video format post
 */
if (!function_exists('ct_post_video')) {
	function ct_post_video($postid, $width = 500, $height = 300) {
		$m4v = get_post_meta($postid, 'videoM4V', true);
		$ogv = get_post_meta($postid, 'videoOGV', true);
		$direct = get_post_meta($postid, 'videoDirect', true);
		echo do_shortcode('[video width="' . $width . '" height="' . $height . '" link="' . $direct . '" m4v="' . $m4v . '" ogv="' . $ogv . '"]');
	}
}

/**
 * returns audio html for audio format post
 */
if (!function_exists('ct_post_audio')) {
	function ct_post_audio($postid, $width = 500, $height = 300) {
		$mp3 = get_post_meta($postid, 'audioMP3', TRUE);
		$ogg = get_post_meta($postid, 'audioOGA', TRUE);
		$poster = get_post_meta($postid, 'audioPoster', TRUE);
		$height = get_post_meta($postid, 'audioPosterHeight', TRUE);

		// Calc $height for small images; large will return same value
		$height = $height * $width / 580;

		echo do_shortcode('[audio width="' . $width . '" mp3="' . $mp3 . '" ogg="' . $ogg . '" poster="' . $poster . '" posterheight="' . $height . '"]');
	}
}

/**
 * show single post title?
 */
if (!function_exists('ct_get_single_post_title')) {
	function ct_get_single_post_title($postType = 'page') {
		$show = get_post_meta(get_post() ? get_the_ID() : null, 'show_title', TRUE);
		if ($show == 'global' || $show == '') {
			if ($postType == 'page' && ct_get_option('pages_single_show_title', 1)) {
				return get_the_title();
			}
			if ($postType == 'post' && ct_get_option('posts_single_page_title', '')) {
				return ct_get_option('posts_single_page_title', '');
			}
			if ($postType == 'portfolio' && ct_get_option('portfolio_single_page_title', '')) {
				return ct_get_option('portfolio_single_page_title', '');
			}
		}
		if ($show == "yes") {
			if ($postType == 'post' && ct_get_option('posts_single_page_title', '')) {
				return ct_get_option('posts_single_page_title', '');
			}
			if ($postType == 'portfolio' && ct_get_option('portfolio_single_page_title', '')) {
				return ct_get_option('portfolio_single_page_title', '');
			}
		}
		return $show == "yes" ? get_the_title() : '';
	}
}

/**
 * single post/page subtitle?
 */
if (!function_exists('ct_get_single_post_subtitle')) {
	function ct_get_single_post_subtitle($postType = 'page') {
		$subtitle = get_post_meta(get_post() ? get_the_ID() : null, 'subtitle', TRUE);
		return $subtitle;
	}
}

/**
 * show single post breadcrumbs?
 */
if (!function_exists('ct_show_single_post_breadcrumbs')) {
	function ct_show_single_post_breadcrumbs($postType = 'page') {
		$show = get_post_meta(get_post() ? get_the_ID() : null, 'show_breadcrumbs', TRUE);
		if ($show == 'global' || $show == '') {
			if ($postType == 'page') {
				return ct_get_option('pages_single_show_breadcrumbs', 1);
			}
			if ($postType == 'post') {
				return ct_get_option('posts_single_show_breadcrumbs', 1);
			}
			if ($postType == 'portfolio') {
				return ct_get_option('portfolio_single_show_breadcrumbs', 1);
			}
		}
		return $show == "yes";
	}
}

/**
 * show index post title?
 */
if (!function_exists('ct_get_index_post_title')) {
	function ct_get_index_post_title($postType = 'page') {
		$show = get_post_meta(get_post() ? get_the_ID() : null, 'show_title', TRUE);
		if(is_search()){
			return __('Search results', 'ct_theme');
		}
		if ($show == 'global' || $show == '') {
			if ($postType == 'post' && ct_get_option('posts_index_show_page_title', 1)) {
				$id = ct_get_option('posts_index_page');
				$page = get_post($id);
				return $page ? $page->post_title : '';
			}
			if ($postType == 'portfolio' && ct_get_option('portfolio_index_show_p_title', 1)) {
				$id = ct_get_option('portfolio_index_page');
				$page = get_post($id);
				return $page ? $page->post_title : '';
			}
			if ($postType == 'faq' && ct_get_option('faq_index_show_title', 1)) {
				$id = ct_get_option('faq_index_page');
				$page = get_post($id);
				return $page ? $page->post_title : '';
			}
		}
		return $show == "yes" ? get_the_title() : '';
	}
}

/**
 * single post/page subtitle?
 */
if (!function_exists('ct_get_index_post_subtitle')) {
	function ct_get_index_post_subtitle($postType = 'page') {
		if(is_search()){
			return '';
		}

		if ($postType == 'post' && ct_get_option('posts_index_show_page_title', 1)) {
			$id = ct_get_option('posts_index_page');
			$subtitle = $id ? get_post_meta($id, 'subtitle', TRUE) : '';
			return $subtitle;
		}

		$subtitle = get_post_meta(get_post() ? get_the_ID() : null, 'subtitle', TRUE);
		return $subtitle;
	}
}


/**
 * show index post breadcrumbs?
 */
if (!function_exists('ct_show_index_post_breadcrumbs')) {
	function ct_show_index_post_breadcrumbs($postType = 'page') {
		$show = get_post_meta(get_post() ? get_the_ID() : null, 'show_breadcrumbs', TRUE);
		if ($show == 'global' || $show == '') {
			if ($postType == 'post') {
				return ct_get_option('posts_index_show_breadcrumbs', 1);
			}
			if ($postType == 'portfolio') {
				return ct_get_option('portfolio_index_show_breadcrumbs', 1);
			}
			if ($postType == 'faq') {
				return ct_get_option('faq_index_show_breadcrumbs', 1);
			}
		}
		return $show == "yes";
	}
}


/**
 * use boxed layout?
 */
if (!function_exists('ct_use_boxed_layout')) {
	function ct_use_boxed_layout() {
		$use = get_post_meta(get_post() ? get_the_ID() : null, 'use_boxed', TRUE);
		if ($use == 'global' || $use == '') {
			return ct_get_option('style_layout_boxed', 'no') == 'yes';
		}
		return $use == 'yes';
	}
}

//custom icons
require_once dirname(__FILE__) . '/plugin/extensions/ctSimpleMetaTermExtension.class.php';