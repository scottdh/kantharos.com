<?php
/**
 * Testimonial shortcode
 */
class ctTestimonialShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Testimonial';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'testimonial';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		return ' <li'.$this->buildContainerAttributes(array(),$atts).'>
	                <blockquote>
	                    <p>' . $content . '</p>
	                    <span class="author">' . $author . '<br>
	                        <strong>' . $subauthor . '</strong>
	                    </span>
	                </blockquote>
	                </li>';

	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return 'testimonials';
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'author' => array('label' => __('author', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Author", 'ct_theme')),
			'subauthor' => array('label' => __('sub-author', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Author subinformation", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea")
		);
	}
}

new ctTestimonialShortcode();