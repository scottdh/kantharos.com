<?php
/**
 * Divider shortcode
 */
class ctDividerShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Divider';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'divider';
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

		$headerHtml = $header ? ($link ? ' <a href="' . $link . '" class="btn btn-' . $style . '">' . $header . '</a>' : '<span class="btn btn-' . $style . '">' . $header . '</span>') : '';

		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('lineBox')),$atts).'>
					            <div class="inner">
					                ' . $headerHtml . '
					            </div>
					        </div>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => "input"),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("ex. http://www.google.com", 'ct_theme')),
			'style' => array('label' => __('style', 'ct_theme'), 'default' => 'default', 'type' => 'select', 'choices' => array('default' => __('default', 'ct_theme'), 'primary' => __('primary', 'ct_theme'), 'inverse' => __('inverse', 'ct_theme')), 'help' => __("text/link style", 'ct_theme')),
		);
	}
}

new ctDividerShortcode();