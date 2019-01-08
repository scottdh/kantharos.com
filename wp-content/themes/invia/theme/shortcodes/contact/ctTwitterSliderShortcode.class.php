<?php
require_once CT_THEME_LIB_DIR . '/shortcodes/socials/ctTwitterShortcodeBase.class.php';
/**
 * Twitter shortcode
 */
class ctTwitterSliderShortcode extends ctTwitterShortcodeBase {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Twitter slider';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'twitter_slider';
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
		$attributes = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);
		extract($attributes);

		$html = '';
		$tweets = $this->getTweets($attributes);
		foreach ($tweets as $tweet) {
			$html .= '<li><p>' . $tweet->content . '</p><span class="time">' . $this->ago($tweet->updated) . '</span></li>';
		}

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
		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('blockTwitter')),$atts).'>
							    <div class="container">
							        <div class="flexslider fadeFlex centerNav">
							            <ul class="slides">' . $html . '</ul>
							        </div>
							    </div>
							</div>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		$attrs = parent::getAttributes();
		if (isset($attrs['newwindow'])) {
			unset($attrs['newwindow']);
		}
		if (isset($attrs['button'])) {
			unset($attrs['button']);
		}
		if (isset($attrs['img'])) {
			unset($attrs['img']);
		}
		if (isset($attrs['imgsize'])) {
			unset($attrs['imgsize']);
		}

		return $attrs;
	}
}

new ctTwitterSliderShortcode();