<?php
class NHP_Options_color_gradient extends NHP_Options {

	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since NHP_Options 1.0
	 */
	function __construct($field = array(), $value = '', $parent) {

		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);

		$this->field = $field;
		$this->value = $value;
		//$this->render();

	}

	//function


	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since NHP_Options 1.0
	 */
	function render() {
		if (!is_array($this->value)) {
			$this->value = array('from' => '', 'to' => '');
		}

		$class = (isset($this->field['class'])) ? $this->field['class'] : '';

		echo '<div class="farb-popup-wrapper" id="' . $this->field['id'] . '">';

		echo __('From:', 'nhp-opts') . ' <input type="text" id="' . esc_attr($this->field['id']) . '-from" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][from]" value="' . esc_attr($this->value['from']) . '" class="' . $class . ' popup-colorpicker" style="width:70px;"/>';
		echo '<div class="farb-popup"><div class="farb-popup-inside"><div id="' . $this->field['id'] . '-frompicker" class="color-picker"></div></div></div>';

		echo __(' To:', 'nhp-opts') . ' <input type="text" id="' . esc_attr($this->field['id']) . '-to" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][to]" value="' . esc_attr($this->value['to']) . '" class="' . $class . ' popup-colorpicker" style="width:70px;"/>';
		echo '<div class="farb-popup"><div class="farb-popup-inside"><div id="' . esc_attr($this->field['id']) . '-topicker" class="color-picker"></div></div></div>';
//allow HTML here - added by devs
		echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';

		echo '</div>';

	}

	//function


	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since NHP_Options 1.0
	 */
	function enqueue() {

		wp_enqueue_script(
			'nhp-opts-field-color-js',
				NHP_OPTIONS_URL . 'fields/color/field_color.js',
			array('jquery', 'farbtastic'),
			time(),
			true
		);

	}
	//function

}

//class
?>