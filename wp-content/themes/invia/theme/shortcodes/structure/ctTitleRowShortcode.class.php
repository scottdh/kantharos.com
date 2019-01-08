<?php
/**
 * Title row shortcode
 */
class ctTitleRowShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Title row';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'title_row';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$breadcrumbsHtml = '';
		if($breadcrumbs == 'yes'){
			$breadcrumbsHtml = wp_nav_menu( array(
								    'container' => 'none',
								    'theme_location' => 'breadcrumbs',
								    'walker'=> new ctInviaBreadCrumbWalker,
									'echo' => false,
									'items_wrap' => '%3$s'
								 ) );
			$breadcrumbsHtml = '[row][full_column]
			            <div class="lineBox right">
			                <div class="inner">' . $breadcrumbsHtml . '</div>
			            </div>
			       [/full_column][/row]';
		}



		return do_shortcode('[row][full_column]
								<div'.$this->buildContainerAttributes(array('class'=>array('titleBox')),$atts).'>
									[header type="1" subtext="' . $subheader . '" class="huge"]' . $header . '[/header]
			                    </div>
			                 [/full_column][/row]' . $breadcrumbsHtml);
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'subheader' => array('label' => __('subheader', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header subtext", 'ct_theme')),
			'breadcrumbs' => array('label' => __('breadcrumbs', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show breadcrumbs path?", 'ct_theme')),
		);
	}
}

new ctTitleRowShortcode();