<?php
/**
 * Draws Work
 */
class ctWorkShortcode extends ctShortcodeQueryable implements ICtShortcodeSingleQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Work';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'work';
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

		$catsHtml = '';
		if ($summary == '' && $link == '' && $imgsrc == '' && $title == '' && $categories == '') {
			if ($post = $this->getSingle($attributes, array('post_type' => 'portfolio'))) {
				$title = $post->post_title;
				$summary = $post->post_excerpt;
				$imgsrc = ct_get_feature_image_src($post->ID, 'full');
				$link = get_permalink($post);
				$catsArray = ct_get_categories_names($post->ID, 'portfolio_category');
				foreach ($catsArray as $id => $name) {
					$catsHtml .=  ct_get_object_icon_formatted($name, $id);
				}
			}
		}

		if($categories){
			$catsNamesArray = explode(',', $categories);
			if($categoriesids){
				$catsIdsArray = explode(',', $categoriesids);
				$catsArray = array_combine($catsIdsArray, $catsNamesArray);
				foreach ($catsArray as $id => $name) {
					$catsHtml .= ct_get_object_icon_formatted($name, $id);
				}
			}else{
				foreach ($catsNamesArray as $name) {
					$catsHtml .= ct_get_object_icon_formatted($name, -1);
				}
			}
		}
		$catsHtml = $catsHtml ? ( $catsHtml ) : '';

		$img = $imgsrc ? '[img width="" height="" src="' . $imgsrc . '" link="' . $link . '" overlay="' . $overlay . '" overlayicon="' . $overlayicon . '"]' : '';
		$html = '<div'.$this->buildContainerAttributes(array('class'=>array('easyBox')),$atts).'>
					' . $img . '
                    <div class="inner">
                       ' . $catsHtml . '<div class="clearfix"></div>
                        <h3 class="light"><a href="' . $link . '">' . $title . '</a></h3>
                        <p>' . $summary . '</p>
                    </div>
                </div>';
		return do_shortcode($html);

	}

	/**
	 * Shortcode type
	 * @return string
	 */
	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_SELF_CLOSING;
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		$atts = $this->getAttributesWithQuery(array(
			'id' => array('label' => __('id', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("ex. http://www.google.com", 'ct_theme')),
			'imgsrc' => array('label' => "image", 'default' => '', 'type' => 'image', 'help' => __("ex. http://www.google.com", 'ct_theme')),
			'title' => array('label' => __('title', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'categories' => array('label' => __("categories", 'ct_theme'), 'default' => '', 'type' => 'textarea', 'help' => __("Categories names separated by commas", 'ct_theme')),
			'categoriesids' => array('default' => false),
			'summary' => array('label' => __("summary", 'ct_theme'), 'default' => '', 'type' => 'textarea'),
			'overlay' => array('label' => __('content overlay', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show content overlay?", 'ct_theme')),
			'overlayicon' => array('label' => __("overlay icon", 'ct_theme'), 'default' => 'plus-squared', 'type' => 'input','link'=>CT_THEME_ASSETS.'/shortcode/entypo/index.html', 'help' => __("Overlay icon", 'ct_theme')),
		));

		if (isset($atts['cat'])) {
			unset($atts['cat']);
		}
		return $atts;
	}
}

new ctWorkShortcode();