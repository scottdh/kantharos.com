<?php
/**
 * 3/4 column shortcode
 */
class ctThreeQuartersColumnShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return '3/4 column';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'three_quarters_column';
	}

	/**
	 * Action
	 * @return string
	 */

	public function getGeneratorAction() {
		return self::GENERATOR_ACTION_INSERT;
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));
		return '<div '.$this->buildContainerAttributes(array('class'=>array('span9',$class)),$atts).'>' . do_shortcode($content) . '</div>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'class' => array('type' => false)
		);
	}
}

new ctThreeQuartersColumnShortcode();