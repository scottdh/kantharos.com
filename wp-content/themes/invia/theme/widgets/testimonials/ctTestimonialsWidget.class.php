<?php
require_once CT_THEME_LIB_WIDGETS.'/ctShortcodeWidget.class.php';

/**
 * Testimonials widget
 * @author alex
 */

class ctTestimonialsWidget extends ctShortcodeWidget {
	/**
	 * Creates wordpress
	 */
	function __construct() {
		$widget_ops = array('classname' => 'widget_testimonials', 'description' => __('Displays testimonials.', 'ct_theme'));
		parent::__construct('testimonials', 'CT - ' . __('Testimonials', 'ct_theme'), $widget_ops);
	}

	/**
	 * Returns shortcode class
	 * @return mixed
	 */
	protected function getShortcodeName() {
		return 'testimonials';
	}
}

register_widget('ctTestimonialsWidget');
