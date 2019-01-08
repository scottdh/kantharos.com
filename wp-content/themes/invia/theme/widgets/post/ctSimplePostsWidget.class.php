<?php
require_once CT_THEME_LIB_WIDGETS.'/ctShortcodeWidget.class.php';

/**
 * Simple posts widget
 * @author hc
 */

class ctSimplePostsWidget extends ctShortcodeWidget {
	/**
	 * Creates wordpress
	 */
	function __construct() {
		$widget_ops = array('classname' => 'widget_simple_posts', 'description' => __('Displays simple posts.', 'ct_theme'));
		parent::__construct('simple_posts', 'CT - ' . __('Simple posts', 'ct_theme'), $widget_ops);
	}

	/**
	 * Returns shortcode class
	 * @return mixed
	 */
	protected function getShortcodeName() {
		return 'simple_posts';
	}
}

register_widget('ctSimplePostsWidget');
