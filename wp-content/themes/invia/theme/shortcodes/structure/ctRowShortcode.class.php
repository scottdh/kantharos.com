<?php
/**
 * Wide row shortcode
 */
class ctRowShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Row';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'row';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));
		$headerHtml = $header ? ('<h3 class="heady">' . $header . '</h3>') : '';
		$topmargin = $topmargin == 'yes' || $topmargin == 'true' || $topmargin == '1' ? 'topSpace ' : '';

		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array($topmargin,'row-fluid')),$atts).'>' . $headerHtml . $content . '</div>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'topmargin' => array('label' => __('add top margin?', 'ct_theme'), 'type' => "checkbox", 'default' => false),
		);
	}

	/**
	 * Zwraca rodzaj shortcode
	 * @return string
	 */
	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_ENCLOSING;
	}


	/**
	 * is template with sidebar?
	 * @return bool
	 */
	protected function isSidebar() {
		return is_page_template('page-custom.php') || is_page_template('page-custom-left.php');
	}
}

new ctRowShortcode();