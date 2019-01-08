<?php
/**
 * Pricelist shortcode
 */
class ctPricelistShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Pricelist';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'pricelist';
	}

	/**
	 * Returns shortcode type
	 * @return mixed|string
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

		//style
		$class = '';
		if ($style == 'distinctive') {
			$class .= ' version2';
			$wrapper = '<div class="inner">';
			$postWrapper = '</div>';

		}else{
			$wrapper = ' <hr>';
			$postWrapper = '';
		}

		//highlight
		if ($highlight == 'yes') {
			$class .= ' spec';
		}

		//content
		$content = $content ? ($content . '<hr>') : '';

		//button
		$buttonHtml = $buttonlabel ? ('<span class="emphasis-2">
				                        <a href="' . $buttonlink . '" class="btn btn-icon right btn-inverse">
				                          ' . $buttonlabel . '
				                            <span class="entypo right-open-mini"><i></i></span>
				                        </a>
				                    </span>') : '';


		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('priceBox',$class)),$atts).'>
		           <span class="pricePlan">' . $title . '</span>
		            ' . $wrapper . '
		               <span class="emphasis">
		                   <sup>' . $currency . '</sup>' . $price . '<sub>' . $subprice . '</sub>
		               </span>
		                <hr>' . $content . $buttonHtml . '
		                ' . $postWrapper . '
		       </div>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'title' => array('label' => __('title', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'currency' => array('label' => __('currency', 'ct_theme'), 'default' => __('$', 'ct_theme'), 'type' => 'input'),
			'price' => array('label' => __('price', 'ct_theme'), 'default' => '', 'type' => 'input','example'=>'456,50'),
			'subprice' => array('label' => __('subprice', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'buttonlabel' => array('default' => '', 'type' => 'input', 'label' => __("button label", 'ct_theme')),
			'buttonlink' => array('default' => '#', 'type' => 'input', 'label' => __("button link", 'ct_theme')),
			'highlight' => array('label' => __('highlight', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __('Highlight as special item?', 'ct_theme')),
			'style' => array('label' => __('style', 'ct_theme'), 'default' => 'basic', 'type' => 'select', 'choices' => array('basic' => __('basic', 'ct_theme'), 'distinctive' => __('distinctive', 'ct_theme')), 'help' => __('Section style', 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => 'textarea'),
			);

	}
}

new ctPricelistShortcode();
