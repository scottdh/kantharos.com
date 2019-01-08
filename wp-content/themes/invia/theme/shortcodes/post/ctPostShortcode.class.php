<?php
/**
 * Shows single post
 */
class ctPostShortcode extends ctShortcodeQueryable implements ICtShortcodeSingleQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Post';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'post';
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

		if($date){
			$dateformatted = date('F d, Y', strtotime($date));
		}

		//all user fields are empty - let's try to find something...
		if ($date == '' && $link == '' && $title == '' && $summary == '' && $comments == '' && $imgsrc == '') {

			if ($post = $this->getSingle($attributes)) {
				$dateformatted = get_the_time('F d, Y', $post);
				$link = get_permalink($post);
				$title = $post->post_title;
				$summary = $post->post_excerpt;
				$comments = wp_count_comments($post->ID)->approved;
				$imgsrc = ct_get_feature_image_src($post->ID, 'full');
			}
		}

		$commentsHtml = '';
		if($comments){
			$commentsHtml = '<span class="metaText smaller pull-right">' . $comments . ' ' . ($comments == 1 ? __('comment', 'ct_theme') : __('comments', 'ct_theme')) . '</span>';
		}

		$img = $imgsrc ? '<a href="' . $link . '"><img src="' . $imgsrc . '" alt=" " class="easyFrame"></a>' : '';
		$html = '<div'.$this->buildContainerAttributes(array('class'=>array('blogDigest')),$atts).'>
		            ' . $img . '
		            <div class="inner">
		                <h4 class="subTitle"><a href="' . $link . '">' . $title . '</a></h4>
		                <p>' . $summary . '</p>
		                <span class="entypo calendar metaText smaller"><i></i>' . $dateformatted . '</span>
		                ' . $commentsHtml . '
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
		return $this->getAttributesWithQuery(
			array(
				'id' => array('default' => '', 'type' => 'posts_select', 'label' => __("Post", 'ct_theme')),
				'imgsrc' => array('label' => "image", 'default' => '', 'type' => 'image', 'help' => __("ex. http://www.google.com", 'ct_theme')),
				'comments' => array('label' => __('comments', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Number of comments", 'ct_theme')),
				'date' => array('label' => __('date', 'ct_theme'), 'default' => '', 'type' => 'input'),
				'title' => array('label' => __('title', 'ct_theme'), 'default' => '', 'type' => 'input'),
				'summary' => array('label' => __('summary', 'ct_theme'), 'default' => '', 'type' => 'input'),
				'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input'),
				'dateformatted' => array('type' => false),
			));
	}
}

new ctPostShortcode();