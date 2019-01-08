<?php
/**
 * Nivo Slider Item shortcode
 */
class ctNivoSliderItemShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Nivo Slider Item';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'nivo_slider_item';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$html = '[img src="' . $imgsrc . '" alt=" " width="" height=""]';
		if ($link) {
			$html = ('<a href="' . $link . '">' . $html . '</a>');
		}
		return do_shortcode($html);
	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return 'nivo_slider';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'imgsrc' => array('label' => __("source", 'ct_theme'), 'default' => '', 'type' => 'image', 'help' => __("Image", 'ct_theme')),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Link from image", 'ct_theme')),
		);
	}

}

new ctNivoSliderItemShortcode();