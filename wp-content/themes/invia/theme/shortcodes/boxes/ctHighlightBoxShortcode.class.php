<?php
/**
 * Highlight Box shortcode
 */
class ctHighlightBoxShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Highlight box';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'highlight_box';
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

		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('highlightBox')),$atts).'><p>' . $content . '</p></div>');
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

new ctHighlightBoxShortcode();