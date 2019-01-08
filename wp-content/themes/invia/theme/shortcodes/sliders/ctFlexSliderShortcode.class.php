<?php
/**
 * Flex Slider shortcode
 */
class ctFlexSliderShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Flex Slider';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'flex_slider';
	}

	/**
	 * Add styles
	 */

	public function enqueueHeadScripts() {
		wp_register_style('ct-flex-slider-style', CT_THEME_ASSETS . '/css/flexslider.css');
		wp_enqueue_style('ct-flex-slider-style');
	}

	public function enqueueScripts() {
		wp_register_script('ct-flex-slider', CT_THEME_ASSETS . '/js/jquery.flexslider-min.js');
		wp_enqueue_script('ct-flex-slider');
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

		$this->addInlineJS($this->getInlineJS($attributes));
		//parse shortcode before filters
		$short = do_shortcode($content);

		$tabs = '<div class="flexslider mainslider onlyPhoto loading-slider"><ul class="slides">';
		$tabs .= $this->callPreFilter(''); //reference
		$tabs .= '</ul></div>';

		//clean current tab cache
		$this->cleanData('tab');

		return $tabs . ($postmode == 'true' ? '' : '<div'.$this->buildContainerAttributes(array('class'=>array('bgnavmainslider')),$atts).'>
								            <div class="container">
								                <div class="flexslider navmainslider">
								                    <ul class="slides">'
														. $short .
													'</ul>
                                                </div>
                                            </div>
                                        </div>');
	}

	/**
	 * returns JS
	 * @param $id
	 * @param $attributes
	 * @return string
	 */
	protected function getInlineJS($attributes) {
		extract($attributes);
		$animationloop = $postmode == 'true' ? 'true' : 'false';
		$syncnav = $postmode == 'true' ? '' : 'sync: ".flexslider.navmainslider",
							          start: function(){
							              jQuery(".flexslider").removeClass("loading-slider");
							              var $mele = jQuery(".flexslider.mainslider .flex-control-nav li").size();
							              var $marginmele = 400 - $mele*14;

							            jQuery(".flexslider.mainslider .flex-direction-nav .flex-prev").css("margin-left", $marginmele);
							            jQuery(".flexslider.mainslider .flex-control-nav").css("margin-left", $marginmele+33);
							            jQuery(".flexslider.mainslider .flex-control-nav, .flexslider.mainslider .flex-direction-nav .flex-prev, .flexslider.mainslider .flex-direction-nav .flex-next").fadeIn();
							          }';
		return 'function fullFlexsliderInit() {
						jQuery(".flexslider.navmainslider").flexslider({
					        animation: "slide",
					        controlNav: false,
					        directionNav: false,
					        animationLoop: false,
					        slideshow: false,
					        slideshowSpeed: 2000,
					        itemWidth: 320,
					        itemMargin: 0,
					        minItems: 2,
					        maxItems: 2,
					        useCSS:false,
					        asNavFor: ".flexslider.mainslider"
					      });
				
					      jQuery(".flexslider.mainslider").flexslider({
					       animation: "' . $effect . '",
					       	controlNav: true,
					        animationLoop: ' . $animationloop . ',
					        slideshow: ' . $slideshow . ',
					        useCSS:false,
					        slideshowSpeed: ' . $pause . ',           //Integer: Set the speed of the slideshow cycling, in milliseconds
				            animationSpeed: ' . $animspeed . ',
				            pauseOnAction: true,
					        ' . $syncnav . '
					      });
				    }
				    jQuery(window).load(function() {
				        fullFlexsliderInit();
				    });';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'postmode' => array('type' => false),
			'effect' => array('label' => __('effect', 'ct_theme'), 'default' => 'slide', 'type' => 'select', 'choices' => array("slide" => "slide", "fade" => "fade"), 'help' => __("Slider effect", 'ct_theme')),
			'slideshow' => array('label' => __('slide show', 'ct_theme'), 'default' => 'false', 'type' => 'select', 'choices' => array("true" => __("true", "ct_theme"), "false" => __("false", "ct_theme"))),
			'pause' => array('label' => __('pause time', 'ct_theme'), 'default' => 7000, 'type' => 'input', 'help' => __('how long each slide will show in miliseconds (1 sec = 1000 milisec) - used only when slideshow is true', 'ct_theme')),
			'animspeed' => array('label' => __('animation speed', 'ct_theme'), 'default' => 600, 'type' => 'input', 'help' => __('slide transition speed in miliseconds (1 sec = 1000 milisec) - used only when slideshow is true', 'ct_theme')),
		);
	}

	public function getChildShortcodeInfo() {
		return array('name' => 'flex_slider_item', 'min' => 1, 'max' => 20, 'default_qty' => 3);
	}


}

new ctFlexSliderShortcode();