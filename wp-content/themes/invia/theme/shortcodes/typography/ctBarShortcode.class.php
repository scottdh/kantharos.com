<?php
/**
 * Bar shortcode
 */
class ctBarShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Bar';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'bar';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$percent = floatval($percent);
		$color = $color ? ' progress-' . $color : '';

		return '<span'.$this->buildContainerAttributes(array('class'=>array('bar-infot')),$atts).'>
					<span class="entypo ' . $icon . '"><i></i></span>
		                ' . $title . ' &mdash; ' . $percent . '%</span>
		            <div class="progress ' . $color . '">
		                <div class="bar" style="width: ' . $percent . '%"></div>
		            </div>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'title' => array('label' => __('title', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'percent' => array('label' => __('percent', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'color' => array('label' => __('color', 'ct_theme'), 'default' => 'default', 'type' => "select", 'choices' => array('default' => __('Default', 'ct_theme'), 'info' => __('info', 'ct_theme'), 'success' => __('success', 'ct_theme'), 'warning' => __('warning', 'ct_theme'), 'danger' => __('danger', 'ct_theme'))),
			'icon' => array('label' => __('entypo icon', 'ct_theme'),'type' => "icon", 'default' => '','link'=>CT_THEME_ASSETS.'/shortcode/entypo/index.html'),
		);
	}
}

new ctBarShortcode();