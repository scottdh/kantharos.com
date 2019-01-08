<?php
class NHP_Options_select_hide_below extends NHP_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since NHP_Options 1.0.1
	*/
	function __construct($field = array(), $value ='', $parent){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		//$this->render();
		
	}//function
	
	
	
	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since NHP_Options 1.0.1
	*/
	function render(){
		
		$class = (isset($this->field['class']))?$this->field['class']:'';
		
		echo '<select id="'.esc_attr($this->field['id']).'" name="'.esc_attr($this->args['opt_name'].'['.$this->field['id'].']').'" class="'.$class.' nhp-opts-select-hide-below" >';
			
			foreach($this->field['options'] as $k => $v){
				
				echo '<option value="'.$k.'" '.selected($this->value, $k, false).' data-allow="'.esc_attr($v['allow']).'">'.esc_html($v['name']).'</option>';
				
			}//foreach

		echo '</select>';
		//allow HTML here - added by devs
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function
	
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since NHP_Options 1.0.1
	*/
	function enqueue(){
		
		wp_enqueue_script(
			'nhp-opts-select-hide-below-js', 
			NHP_OPTIONS_URL.'fields/select_hide_below/field_select_hide_below.js', 
			array('jquery'),
			time(),
			true
		);
		
	}//function
	
}//class
?>