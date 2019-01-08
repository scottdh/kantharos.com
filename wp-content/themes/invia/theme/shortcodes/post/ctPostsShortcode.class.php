<?php
/**
 * Shows filtered posts
 */
class ctPostsShortcode extends ctShortcodeQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Posts';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'posts';
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

		switch ($columns) {
			case 2:
				$columnName = 'half';
				break;
			case 3:
				$columnName = 'third';
				break;
			case 4:
				$columnName = 'quarter';
				break;
			default:
				$columnName = 'half';
		}

		$posts = $this->getCollection($attributes);
		$html = '';
		$counter = 0;
		foreach ($posts as $p) {
			$counter++;
			$date = get_the_time('F d', $p);
			$link = get_permalink($p);
			$title = $p->post_title;
			$summary = $p->post_excerpt;
			$comments = wp_count_comments($p->ID)->approved;
			$imgsrc = ct_get_feature_image_src($p->ID, 'full');

			$html .= "[" . $columnName . "_column]" . $this->embedShortcode('post', array(
				'summary' => $summary,
				'dateformatted' => $date,
				'title' => $title,
				'link' => $link,
				'comments' => $comments,
				'imgsrc' => $imgsrc
			)) . "[/" . $columnName . "_column]";

		}

		return do_shortcode('[row]' . $html . '[/row]');
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
		return $this->getAttributesWithQuery(array(
			'columns' => array('label' => __('columns', 'ct_theme'), 'default' => '2', 'type' => 'select', 'choices' => array('4' => '4', '3' => '3', '2' => '2'), 'help' => __("Number of columns", 'ct_theme')),
		));
	}
}

new ctPostsShortcode();