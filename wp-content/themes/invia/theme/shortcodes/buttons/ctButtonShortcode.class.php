<?php
/**
 * Button shortcode
 */
class ctButtonShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Button';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'button';
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

		$id = $id ?    $id  : '';
		$color = $color ? 'btn-' . $color : '';
		$class = $class ?  $class : '';
		$link = $link ? $link : '';
		$size = $size=='medium' ? '' : ('btn-' . $size);

		$entypoicon = $entypoicon ? 'entypo ' . $entypoicon : '';
		$iconHtml = $entypoicon ? '<i></i>' : '';

		if ($width) {
			if (is_numeric($width)) {
				$width = $width . 'px';
			}
			$width = 'width:' . $width ;
		} else {
			$width = '';
		}

		$tag = 'a';
		if ($button == 'yes') {
			$button = '';
		} else {
			$button = 'btn-link';
		}
		if ($button!='yes' && $nofollow == 'true') {
			$follow_tag = 'nofollow';
		} else {
			$follow_tag = '';
		}
        $cParams=array(
            'id'=>$id,
            'href'=>$link,
            'style'=>$width,
            'class'=>array(apply_filters('theme_css_class', 'btn'),$size,$color,$button,$entypoicon,$class),
            'rel'=>$follow_tag
        );
		$content = '<'.$tag.$this->buildContainerAttributes($cParams,$atts).'>' . $iconHtml . trim($content) . '</' . $tag . '>';
		return $content;
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {

		return array(
			'id' => array('default' => false, 'type' => false),
			'class' => array('default' => false, 'type' => false),
			'size' => array('label' => __('size', 'ct_theme'), 'default' => 'medium', 'type' => 'select', 'choices' => array('mini' => __('mini', 'ct_theme'), 'small' => __('small', 'ct_theme'), 'medium' => __('medium', 'ct_theme'), 'large' => __('large', 'ct_theme'), 'block' => __('block', 'ct_theme')), 'help' => __("Button size",'ct_theme')),
			'link' => array('label' => __('link', 'ct_theme'),'help' => __("ex. http://www.google.com",'ct_theme')),
			'width' => array('label' => __('width', 'ct_theme'),'type' => "input"),
			'color' => array('label' => __('color', 'ct_theme'),'default' => 'default', 'type' => "select", 'choices' => array('default' => __('Default','ct_theme'), 'primary' => __('primary', 'ct_theme'), 'info' => __('info', 'ct_theme'), 'success' => __('success', 'ct_theme'), 'warning' => __('warning', 'ct_theme'), 'danger' => __('danger', 'ct_theme'), 'inverse' => __('inverse', 'ct_theme'))),
			'entypoicon' => array('label' => __('entypo icon', 'ct_theme'),'type' => "icon", 'default' => '','link'=>CT_THEME_ASSETS.'/shortcode/entypo/index.html'),
			'button' => array('label' => __('is button', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Draw button or link",'ct_theme')),
			'content' => array('label' => __('label', 'ct_theme'), 'default' => '', 'type' => 'textarea'),
			'nofollow' => array('label' => __('nofollow', 'ct_theme'),'type' => "checkbox", 'default' => 'true'),
		);
	}
}

new ctButtonShortcode();