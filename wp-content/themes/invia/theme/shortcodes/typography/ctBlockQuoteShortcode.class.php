<?php
/**
 * BlockQuote shortcode
 */
class ctBlockQuoteShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Block quote';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'blockquote';
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

		$icon = ' quote-circled';
		$class = '';
		if($type == 'simple'){
			$icon = ' quote-simple';
			$class= 'simple';
		}

		return do_shortcode('<blockquote'.$this->buildContainerAttributes(array('class'=>array($class)),$atts).'>
				                <span class="fontello ' . $icon . '"><i></i></span>
				                <p>' . $content . '</p>
				                <span class="author">' . $author . '</span>
				            </blockquote>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
			'author' => array('label' => __('author', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Author", 'ct_theme')),
			'type' => array('label' => __('type', 'ct_theme'), 'default' => 'default', 'type' => "select", 'choices' => array('default' => __('default', 'ct_theme'), 'simple' => __('simple', 'ct_theme'))),
		);
	}
}

new ctBlockQuoteShortcode();