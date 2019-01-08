<?php
require_once CT_THEME_LIB_DIR . '/shortcodes/socials/ctTwitterShortcodeBase.class.php';
/**
 * Twitter shortcode
 */
class ctTwitterShortcode extends ctTwitterShortcodeBase {

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		$attributes = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);
		extract($attributes);

		$newwindow = $newwindow == 'false' || $newwindow == 'no' ? false : true;
		$html = '';
		$headerHtml = $header ? ('<h4 class="medium">' . $header . '</h4>')  : '';

		$followLink = $this->getFollowLink($user);
		$tweets = $this->getTweets($attributes);
		foreach ($tweets as $tweet) {
			$html .= ' <div'.$this->buildContainerAttributes(array('class'=>array('twitterBox')),$atts).'><p>' . $tweet->content . '<span class="time">' . $this->ago($tweet->updated) . '</span></p></div>';
		}
		$link = '';

		if ($button) {
			$link = '<div class=""><a class="btn btn-small"' . ($newwindow ? ' target="_blank"' : '') . ' href="' . $followLink . '">' . $button . '</a></div>';
		}

		return do_shortcode($headerHtml . $html . $link);
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array_merge(
			array(
				'widgetmode' => array('default' => 'false', 'type' => false),
				'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			), parent::getAttributes());
	}
}

new ctTwitterShortcode();