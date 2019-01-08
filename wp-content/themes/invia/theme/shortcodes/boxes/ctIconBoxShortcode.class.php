<?php
/**
 * Icon Box shortcode
 */
class ctIconBoxShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Icon box';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'icon_box';
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

		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('iconBox','doCenter')),$atts).'>
		            <span class="entypo ' . $icon . '"><i></i></span>
		            <h3 class="light">' . $header . '</h3>
		            <p>' . $content . '</p>
		        </div>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'icon' => array('label' => __('glyphicons icon', 'ct_theme'),'type' => "icon", 'default' => '','link'=>CT_THEME_ASSETS.'/shortcode/entypo/index.html'),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
		);
	}
}

new ctIconBoxShortcode();