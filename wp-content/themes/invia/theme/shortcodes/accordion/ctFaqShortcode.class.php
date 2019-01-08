<?php
/**
 * Faq shortcode
 */
class ctFaqShortcode extends ctShortcodeQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Faq';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'faq';
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

		$catNamesArray = $cat_name ? explode(',', $cat_name) : array();
		$catNamesArray = array_combine($catNamesArray, $catNamesArray);

		$data = array();
		$faqs = $this->getCollection($attributes, array('post_type' => 'faq'));
		foreach ($faqs as $faq) {
			if ($cats = get_the_terms($faq->ID, 'faq_category')) {
				foreach ($cats as $cat) {
					if(isset($catNamesArray[$cat->slug])){
						$data[$cat->term_id]['cat'] = $cat->name;
						$data[$cat->term_id]['cat_slug'] = $cat->slug;
						$data[$cat->term_id]['posts'][] = $faq;
					}
				}
			}
		}

		$html = '';
		if($data){
			foreach($data as $catId => $details){
                $cParams=array(
                    'id'=>'q'.$catId,
                    'class'=>array('sectionFaq')
                );
				$html .= '<div'.$this->buildContainerAttributes($cParams,$atts).'>';
			    if(isset($details['posts']) && isset($details['cat'])){
					$html .= '[accordion header="' . $details['cat'] . '"]';
					foreach($details['posts'] as $faq){
						$html .= '[accordion_item title="' . $faq->post_title . '"]' . $faq->post_content . '[/accordion_item]';
					}
					$html .= '[/accordion]';
			    }
				$html .= '</div>';
			}
		}

		return do_shortcode($html);
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		$atts = $this->getAttributesWithQuery(array(
			'limit' => array('label' => __('limit', 'ct_theme'), 'default' => -1, 'type' => 'input', 'help' => __("Number of faq elements", 'ct_theme')),
		));

		if (isset($atts['cat'])) {
			unset($atts['cat']);
		}
		return $atts;
	}
}

new ctFaqShortcode();