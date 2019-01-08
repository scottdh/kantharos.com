<?php
/**
 * Image shortcode
 */
class ctImageShortcode extends ctShortcode {

	/**
	 * default image link base
	 */
	const DEFAULT_IMG_SRC = "http://dummyimage.com/";

	/**
	 * default image width
	 */
	const DEFAULT_IMG_WIDTH = 90;

	/**
	 * default image heightd
	 */
	const DEFAULT_IMG_HEIGHT = 90;

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Image';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'img';
	}

	public function enqueueScripts() {
		wp_register_script('ct-contenthover', CT_THEME_ASSETS . '/js/jquery.contenthover.min.js');
		wp_enqueue_script('ct-contenthover');
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$src = $src ? $src : $this->getDefaultImgSrc($width, $height);
		switch ($align) {
			case 'center':
				$style = 'display:block; margin:0 auto;';
				$divContainerStyle = "text-align:center";
				break;
			case 'left':
				$style = 'float: left';
				$divContainerStyle = "text-align:left";
				break;
			case 'right':
				$style = 'float: right';
				$divContainerStyle = "text-align:right";
				break;
			default:
				$style = '';
				$divContainerStyle = "";

		}


		$class = $class ? $class : '';

		if ($width) {
			$width = $width ? $width : '';
		}
		if ($height) {
			$height = $height ? $height : '';
		}


		$overlayHtml = '';
		if ($overlay == 'yes') {
			$class .= ' contentoverlay';
			if($link){
				$overlayHtml = '<div class="contenthover"><a href="' . $link . '"><span class="entypo ' . $overlayicon . '"><i></i></span></a></div>';
			}else{
				$overlayHtml = '<div class="contenthover"><span class="entypo ' . $overlayicon . '"><i></i></span></div>';
			}
		}
        $cParams=array(
            'class'=>array($class),
            'alt'=>$alt,
            'src'=>$src,
            'width'=>$width,
            'height'=>$height,
            'style'=>$style
        );
		$img = '<img'.$this->buildContainerAttributes($cParams,$atts).'>' . $overlayHtml;


		//link
		if ($link && $overlay == 'no') {
			$img = '<a href="' . $link . '">' . $img . '</a>';
		}
		return do_shortcode($img);
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'src' => array('label' => __("image", 'ct_theme'), 'default' => '', 'type' => 'image', 'help' => __("Image source", 'ct_theme')),
			'alt' => array('label' => __('alt', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Alternate text", 'ct_theme')),
			'width' => array('label' => __('width', 'ct_theme'), 'default' => self::DEFAULT_IMG_WIDTH, 'type' => 'input', 'help' => __("Image width", 'ct_theme')),
			'height' => array('label' => __('height', 'ct_theme'), 'default' => self::DEFAULT_IMG_HEIGHT, 'type' => 'input', 'help' => __("Image height", 'ct_theme')),
			'align' => array('label' => __('align', 'ct_theme'), 'default' => 'auto', 'type' => 'select', 'options' => array('default' => __('Default', 'ct_theme'), 'left' => __('Left', 'ct_theme'), 'center' => __('Center', 'ct_theme'), 'right' => __('Right', 'ct_theme')), 'help' => __("Image align", 'ct_theme')),
			'link' => array('label' => __('link', 'ct_theme'), 'help' => __("ex. http://www.google.com", 'ct_theme')),
			'class' => array('label' => __("class", 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Image class", 'ct_theme')),
			'overlay' => array('label' => __('content overlay', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show content overlay?", 'ct_theme')),
			'overlayicon' => array('label' => __("overlay icon", 'ct_theme'), 'default' => 'no-icon', 'type' => 'input','link'=>CT_THEME_ASSETS.'/shortcode/entypo/index.html', 'help' => __("Overlay icon", 'ct_theme')),
		);
	}

	/**
	 * returns default image source
	 * @param $width
	 * @param $height
	 * @return string
	 */
	protected function getDefaultImgSrc($width, $height) {
		if($width && $height){
			return self::DEFAULT_IMG_SRC . $width . "x" . $height;
		}
		return '';
	}
}

new ctImageShortcode();