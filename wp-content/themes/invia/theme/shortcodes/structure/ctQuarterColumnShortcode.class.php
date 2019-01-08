<?php
/**
 * 1/4 column shortcode
 */
class ctQuarterColumnShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return '1/4 column';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'quarter_column';
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
		return '<div'.$this->buildContainerAttributes(array('class'=>array('span3',$class)),$atts).'>' . do_shortcode($content) . '</div>';
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

new ctQuarterColumnShortcode();