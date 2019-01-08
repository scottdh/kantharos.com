<?php
/**
 * Slider Box shortcode
 */
class ctSliderBoxShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Slider Box';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'slider_box';
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

		$link = $link ? ('<a href="' . $link . '" class="box-click">click here</a>') : '';

		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('box-mainslider')),$atts).'>
	                            <h3>' . $header . '</h3>
	                            <p>' . $content . $link . '</p>
	                        </div>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Link", 'ct_theme')),
		);
	}
}

new ctSliderBoxShortcode();