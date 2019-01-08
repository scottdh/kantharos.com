<?php
/**
 * Testimonials shortcode
 */
class ctTestimonialsShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Testimonials';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'testimonials';
	}

	/**
	 * Add styles
	 */

	public function enqueueHeadScripts() {
		wp_register_style('ct-flex-slider-style', CT_THEME_ASSETS . '/css/flexslider.css');
		wp_enqueue_style('ct-flex-slider-style');
	}

	public function enqueueScripts() {
		wp_register_script('ct-flex-slider', CT_THEME_ASSETS . '/js/jquery.flexslider-min.js');
		wp_enqueue_script('ct-flex-slider');
	}


	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$this->addInlineJS('function fadeFlexsliderInit() {
							    jQuery(".flexslider.fadeFlex").flexslider({
							        animation: "fade",
							        animationLoop: false,
							        slideshow: false,
							        controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
							        directionNav: true,
							     smoothHeight: true
							    });
							}
							jQuery(window).load(function () {
							  fadeFlexsliderInit();
									});');
		$headerHtml = $header ? ('<h4 class="medium">' . $header . '</h4>') : '';
		return $headerHtml . do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('flexslider','fadeFlex')),$atts).'><ul class="slides">' . $content . '</ul></div>');
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
		);
	}

	/**
	 * Returns child shortcode info
	 * @return string
	 */
	public function getChildShortcodeInfo() {
		return array('name' => 'testimonial', 'min' => 1, 'max' => 20, 'default_qty' => 3);
	}


}

new ctTestimonialsShortcode();