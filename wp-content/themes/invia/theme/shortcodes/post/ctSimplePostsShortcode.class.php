<?php
/**
 * Simple posts
 */
class ctSimplePostsShortcode extends ctShortcodeQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Simple posts';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'simple_posts';
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

		$posts = $this->getCollection($attributes);

		$html = $header ? ('<h4 class="medium">' . $header . '</h4>') : '';
		foreach ($posts as $p) {
			$html .= '<div'.$this->buildContainerAttributes(array('class'=>array('recentPostBox')),$atts).'>';
			$date = get_the_time('F d, Y', $p);
			$link = get_permalink($p);
			$title = $p->post_title;
			$excerpt = $p->post_excerpt;
			$author = get_the_author_meta('user_login', $p->post_author);

			$html .= '<h4 class="medium"><a href="' . $link . '">' . $title . '</a></h4>
                    <p>' . $excerpt . '</p>
                    <span class="infoAdd"><i></i>' . $date . ', ' . __('by', 'ct_theme') . ' ' . $author . '</span>';
			$html .= '</div>';

		}

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
		return $this->getAttributesWithQuery(array(
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'limit' => array('label' => __('limit', 'ct_theme'), 'default' => 3, 'type' => 'input'),
		));
	}
}

new ctSimplePostsShortcode();