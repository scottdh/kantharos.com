<?php
/**
 * Box shortcode
 */
class ctBoxShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Box';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'box';
	}

	/**
	 * Shortcode type
	 * @return string
	 */
	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_ENCLOSING;
	}


	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('easyBox')),$atts).'>' . $content . '</div>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
		);
	}
}

new ctBoxShortcode();