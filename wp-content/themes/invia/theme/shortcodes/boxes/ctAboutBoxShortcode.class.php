<?php
/**
 * About Box shortcode
 */
class ctAboutBoxShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'About Box';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'about_box';
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

		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('row-fluid')),$atts).'>
		        <div class="span4">
		            <a href="' . $link . '" class="btn btn-icon twice">
		                <span class="entypo ' . $buttonicon . '"><i></i></span>
		                ' . $buttonlabel . '
		                <span class="entypo right-open-mini"><i></i></span>
		            </a>
		        </div>
		        <div class="span8">
		            <h3 class="subTitle">' . $header . '</h3>
		            <br>
		            ' . $content . '
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
			'buttonlabel' => array('label' => __('button label', 'ct_theme'), 'default' => '', 'type' => "input"),
			'buttonicon' => array('label' => __('entypo button icon', 'ct_theme'),'type' => "icon", 'default' => '','link'=>CT_THEME_ASSETS.'/shortcode/entypo/index.html'),
			'link' => array('label' => __('link', 'ct_theme'),'help' => __("ex. http://www.google.com",'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),

		);
	}
}

new ctAboutBoxShortcode();