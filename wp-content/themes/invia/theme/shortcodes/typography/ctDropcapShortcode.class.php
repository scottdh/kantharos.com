<?php
/**
 * Dropcap shortcode
 */
class ctDropcapShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Dropcap';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'dropcap';
	}

	/**
	 * Returns shortcode type
	 * @return mixed|string
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

		$class = 'version2';
		if($type == 'simple'){
			$class= '';
		}

		return do_shortcode('<p'.$this->buildContainerAttributes(array('class'=>array('dropcap',$class)),$atts).'>' . $content . '</p>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
			'type' => array('label' => __('type', 'ct_theme'), 'default' => 'default', 'type' => "select", 'choices' => array('default' => __('default', 'ct_theme'), 'simple' => __('simple', 'ct_theme'))),
		);
	}
}

new ctDropcapShortcode();