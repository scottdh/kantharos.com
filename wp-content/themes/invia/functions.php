<?php

require_once get_template_directory() . '/framework/createit/ctThemeLoader.php';

$c = new ctThemeLoader();
$c->init('invia');
//var_dump(get_theme_mods());exit;
function roots_setup() {

	// Make theme available for translation
	load_theme_textdomain('ct_theme', get_template_directory() . '/lang');

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support('automatic-feed-links');

	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support('post-thumbnails');

	add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

	//add size for portfolio items
	add_image_size('thumb_4_cols', 220, 176, true);
	add_image_size('thumb_3_cols', 276, 221, true);
	add_image_size('thumb_2_cols', 460, 368, true);

	require_once CT_THEME_SETTINGS_MAIN_DIR . '/options/ctCustomizeManagerHandler.class.php';
	new ctCustomizeManagerHandler();

	// Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style('assets/css/editor-style.css');
}

add_action('after_setup_theme', 'roots_setup');

require_once 'theme/theme_functions.php';