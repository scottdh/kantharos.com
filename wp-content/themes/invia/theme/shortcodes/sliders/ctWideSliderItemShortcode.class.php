<?php
/**
 * Wide Slider Item shortcode
 */
class ctWideSliderItemShortcode extends ctShortcode {

	/**
	 * Tabs counter
	 * @var int
	 */

	protected static $counter = 0;

	/**
	 * @inheritdoc
	 */
	public function __construct() {
		parent::__construct();

		//connect for additional code
		//remember - method must be PUBLIC!
		$this->connectPreFilter('wide_slider', array($this, 'handlePreFilter'));
	}

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Wide Slider Item';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'wide_slider_item';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$counter = ++self::$counter;

		//add for pre filter data. Adds any data to this shortcode type
		$this->setData($counter, do_shortcode('<li'.$this->buildContainerAttributes(array(),$atts).'>
						                <div style="background-image: url(' . $imgsrc . ');">
						                    <div class="container ' . $contentplace . '">
						                        [slider_box header="' . $header . '" link="' . $link . '"]' . $content . '[/slider_box]
						                    </div>
						                </div>
						            </li>'));

		return '<li>' . $title . '</li>';
	}

	/**
	 * Adds content before filters
	 * @param string $content
	 * @return string
	 */
	public function handlePreFilter($content) {
		//here - add all available content
		foreach ($this->getAllData() as $data) {
			$content .= $data;
		}
		return $content;
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'title' => array('label' => __('title', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Slide title", 'ct_theme')),
			'imgsrc' => array('label' => __("source", 'ct_theme'), 'default' => '', 'type' => 'image', 'help' => __("Image link", 'ct_theme')),
			'contentplace' => array('label' => __('content place', 'ct_theme'), 'default' => 'default', 'type' => 'select', 'choices' => array("default" => __("default", "ct_theme"), "inCenter" => __("center", "ct_theme"), "rightDown" => __("right down", "ct_theme"), "rightUp" => __("right up", "ct_theme"), "leftDown" => __("left down", "ct_theme"), "leftUp" => __("left up", "ct_theme"))),
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Slide box header", 'ct_theme')),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Slide box link", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
		);
	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return 'wide_slider';
	}
}

new ctWideSliderItemShortcode();