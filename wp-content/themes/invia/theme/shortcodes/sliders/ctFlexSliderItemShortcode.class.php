<?php
/**
 * Flex Slider Item shortcode
 */
class ctFlexSliderItemShortcode extends ctShortcode {

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
		$this->connectPreFilter('flex_slider', array($this, 'handlePreFilter'));
	}

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Flex Slider Item';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'flex_slider_item';
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
		$this->setData($counter, do_shortcode('<li>
						            <div class="onlyPhotoContainer">
						                <div class="container">
						                    <img src="' . $imgsrc . '" alt=" " class="easyFrame flat">
						                </div>
						            </div>
						        </li>'));

		return '<li'.$this->buildContainerAttributes(array(),$atts).'>' . $title . '</li>';
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
		);
	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return 'flex_slider';
	}
}

new ctFlexSliderItemShortcode();