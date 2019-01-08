<?php
/**
 * Person Box shortcode
 */
class ctPersonBoxShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Person box';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'person_box';
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

		$preLink = '';
		$postLink = '';
		if ($link) {
			$preLink = '<a href="' . $link . '">';
			$postLink = '</a>';
		}

		'<li><a href="#"><span class="entypo facebook-circled"><i></i></span></a></li>';

		$linksHtml = '';
		if ($fb) {
			$linksHtml .= '<li><a target="_blank" data-toggle="tooltip" title="Facebook" href="http://www.facebook.com/' . $fb . '"><span class="entypo facebook-circled"><i></i></span></a></li>';
		}
		if ($twit) {
			$linksHtml .= '<li><a target="_blank" data-toggle="tooltip" title="Twitter" href="http://www.twitter.com/' . $twit . '"><span class="entypo twitter-circled"><i></i></span></a></li>';
		}
		if ($instagram) {
			$linksHtml .= '<li><a target="_blank" data-toggle="tooltip" title="Instagram" href="http://instagram.com/' . $instagram . '"><span class="entypo instagram"><i></i></span></a></li>';
		}
		if ($google) {
			$linksHtml .= '<li><a target="_blank" data-toggle="tooltip" title="Google Plus" href="http://plus.google.com/' . $google . '"><span class="entypo gplus-circled"><i></i></span></a></li>';
		}
		if ($linkedin) {
			$linksHtml .= '<li><a target="_blank" data-toggle="tooltip" title="LinkedIn" href="http://www.linkedin.com/' . $linkedin . '"><span class="entypo linkedin-circled"><i></i></span></a></li>';
		}
		if ($pinterest) {
			$linksHtml .= '<li><a target="_blank" data-toggle="tooltip" title="Pinterest" href="http://www.pinterest.com/' . $pinterest . '"><span class="entypo pinterest-circled"><i></i></span></a></li>';
		}
		if ($dribbble) {
			$linksHtml .= '<li><a target="_blank" data-toggle="tooltip" title="Dribbble" href="http://dribbble.com/' . $dribbble . '"><span class="entypo dribbble-circled"><i></i></span></a></li>';
		}
		if ($flickr) {
			$linksHtml .= '<li><a target="_blank" data-toggle="tooltip" title="Flickr" href="http://www.flickr.com/photos/' . $flickr . '"><span class="entypo flickr-circled"><i></i></span></a></li>';
		}
		if ($tumblr) {
			$linksHtml .= '<li><a target="_blank" data-toggle="tooltip" title="Tumblr" href="http://' . $tumblr . '.tumblr.com"><span class="entypo tumblr-circled"><i></i></span></a></li>';
		}
		if ($vimeo) {
			$linksHtml .= '<li><a target="_blank" data-toggle="tooltip" title="Vimeo" href="http://vimeo.com/' . $vimeo . '"><span class="entypo vimeo-circled"><i></i></span></a></li>';
		}
		if ($phone) {
			$linksHtml .= '<li><a data-toggle="tooltip" title="Phone" href="callto://+' . $phone . '"><span class="entypo phone><i></i></span></a></li>';
		}
		if ($skype) {
			$linksHtml .= '<li><a data-toggle="tooltip" title="Skype" href="skype:' . $skype . '?call"><span class="entypo skype-circled"><i></i></span></a></li>';
		}
		if ($email) {
			$linksHtml .= '<li><a data-toggle="tooltip" title="E-mail" href="mailto:' . $email . '"><span class="entypo mail"><i></i></span></a></li>';
		}

		return do_shortcode(' <div'.$this->buildContainerAttributes(array('class'=>array('personBox')),$atts).'>
							' . $preLink . '<img src="' . $imgsrc . '" alt=" " class="easyFrame flat">' . $postLink . '
		                    <h4 class="std">' . $header . '</h4>
		                    <p>' . $subheader . '</p>
		                    <p>' . $content . '</p>
		                    <ul class="smallSocials">' . $linksHtml . '</ul>
		                </div>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'imgsrc' => array('label' => __("source", 'ct_theme'), 'default' => '', 'type' => 'image', 'help' => __("Image", 'ct_theme')),
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'subheader' => array('label' => __('subheader', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Subheader text", 'ct_theme')),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Link", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
			'fb' => array('label' => __("Facebook username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'twit' => array('label' => __("Twitter username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'instagram' => array('label' => __("Instagram username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'dribbble' => array('label' => __("Dribbble username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'google' => array('label' => __("Google+ username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'linkedin' => array('label' => __("LinkedIn username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'pinterest' => array('label' => __("Pinterest username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'flickr' => array('label' => __("Flickr username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'tumblr' => array('label' => __("Tumblr username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'vimeo' => array('label' => __("Vimeo movie", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'phone' => array('label' => __("Phone number to call by Skype", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'skype' => array('label' => __("Skype user", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'email' => array('label' => __("Email address", 'ct_theme'), 'default' => '', 'type' => 'input'),
		);
	}
}

new ctPersonBoxShortcode();