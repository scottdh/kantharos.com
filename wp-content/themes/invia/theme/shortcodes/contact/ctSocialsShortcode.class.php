<?php
/**
 * Socials shortcode
 */
class ctSocialsShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Socials';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'socials';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$headerHtml = $header ? ('<h4 class="medium">' . $header . '</h4>') : '';

		$linksHtml = '';
		if ($fb) {
			$linksHtml .= '<li><a target="_blank" href="http://www.facebook.com/' . $fb . '" class="entypo facebook-squared"><i></i>facebook</a></li>';
		}
		if ($twit) {
			$linksHtml .= '<li><a target="_blank" href="http://www.twitter.com/' . $twit . '" class="entypo twitter"><i></i>twitter</a></li>';
		}
		if ($google) {
			$linksHtml .= '<li><a target="_blank" href="http://plus.google.com/' . $google . '" class="entypo gplus"><i></i>google+</a></li>';
		}
		if ($linkedin) {
			$linksHtml .= '<li><a target="_blank" href="http://www.linkedin.com/' . $linkedin . '" class="entypo linkedin"><i></i>linkedin</a></li>';
		}
		if ($pinterest) {
			$linksHtml .= '<li><a target="_blank" href="http://www.pinterest.com/' . $pinterest . '" class="entypo pinterest"><i></i>pinterest</a></li>';
		}
		if ($dribbble) {
			$linksHtml .= '<li><a target="_blank" href="http://dribbble.com/' . $dribbble . '" class="entypo dribbble"><i></i>dribbble</a></li>';
		}
		if ($flickr) {
			$linksHtml .= '<li><a target="_blank" href="http://www.flickr.com/photos/' . $flickr . '" class="entypo flickr"><i></i>flickr</a></li>';
		}
		if ($tumblr) {
			$linksHtml .= '<li><a target="_blank" href="http://' . $tumblr . '.tumblr.com" class="entypo tumblr"><i></i>tumblr</a></li>';
		}
		if ($behance) {
			$linksHtml .= '<li><a target="_blank" href="http://www.behance.net/' . $behance . '" class="entypo behance"><i></i>behance</a></li>';
		}
		if ($youtube) {
			$linksHtml .= '<li><a target="_blank" href="http://www.youtube.com/' . $youtube . '" class="entypo play"><i></i>youtube</a></li>';
		}
		if ($vimeo) {
			$linksHtml .= '<li><a target="_blank" href="http://vimeo.com/' . $vimeo . '" class="entypo vimeo"><i></i>vimeo</a></li>';
		}
		if ($phone) {
			$linksHtml .= '<li><a href="callto://+' . $phone . '" class="entypo skype"><i></i>' . $phonelabel . '</a></li>';
		}
		if ($skype) {
			$linksHtml .= '<li><a href="skype:' . $skype . '?call" class="entypo skype"><i></i>skype</a></li>';
		}

		if ($instagram) {
			$linksHtml .= '<li><a href="http://instagram.com/' . $instagram . '" class="entypo instagram"><i></i>instagram</a></li>';
		}


		if ($email) {
			$linksHtml .= '<li><a href="mailto:' . $email . '" class="entypo mail"><i></i>' . $emaillabel . '</a></li>';
		}
		if ($rss == 'yes') {
			$linksHtml .= '<li><a target="_blank" href="' . current_page_url() . '?feed=rss2" class="entypo rss"><i></i>rss</a></li>';
		}

		return $headerHtml . '<ul'.$this->buildContainerAttributes(array('class'=>array('socialIcons')),$atts).'>' . $linksHtml . '</ul>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'widgetmode' => array('default' => 'false', 'type' => false),
			'header' => array('label' => __("header text", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'fb' => array('label' => __("Facebook username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'twit' => array('label' => __("Twitter username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'dribbble' => array('label' => __("Dribbble username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'google' => array('label' => __("Google+ username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'linkedin' => array('label' => __("LinkedIn username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'pinterest' => array('label' => __("Pinterest username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'flickr' => array('label' => __("Flickr username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'tumblr' => array('label' => __("Tumblr username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'behance' => array('label' => __("Behance username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'youtube' => array('label' => __("Youtube movie", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'vimeo' => array('label' => __("Vimeo movie", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'phone' => array('label' => __("Phone number to call by Skype", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'phonelabel' => array('label' => __("Phone tooltip label", 'ct_theme'), 'default' => __("Phone",'ct_theme'), 'type' => 'input'),
			'skype' => array('label' => __("Skype user", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'instagram' => array('label' => __("Instagram user", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'email' => array('label' => __("Email address", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'emaillabel' => array('label' => __("Email tooltip label", 'ct_theme'), 'default' => __("Email",'ct_theme'), 'type' => 'input'),
			'rss' => array('label' => __('Rss', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'options' => array('no' => __('no', 'ct_theme'), 'yes' => __('yes', 'ct_theme')), 'help' => __("Show rss feed link?", 'ct_theme')),
		);
	}
}

new ctSocialsShortcode();