<?php

/**
 * Class ctSimpleMetaTermExtension
 * Helps to use simple-term-plugin if exists
 */
class ctSimpleMetaTermExtension {

	/**
	 * Option key name
	 */

	CONST ICON_KEY = 'icon-url';

	/**
	 * @var $this
	 */
	protected static $instance;

	/**
	 * @var bool
	 */
	protected $active = false;

	/**
	 * Creates object
	 */

	protected function __construct() {
		$this->active = function_exists('get_term_meta');
	}

	/**
	 * @return ctSimpleMetaTermExtension
	 */

	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new ctSimpleMetaTermExtension();
		}
		return self::$instance;
	}

	/**
	 * Connects meta boxes
	 */

	public function connectMeta($type = '') {
		$type = $type ? $type . '_' : '';

		if ($this->active) {
			add_action($type . 'category_add_form_fields', array($this, 'newTermMeta'), 10, 1);
			add_action($type . 'category_edit_form_fields', array($this, 'editTermMeta'), 10, 1);
			add_action('created_' . $type . 'category', array($this, 'saveTermDetails'), 10, 1);
			add_action('edited_' . $type . 'category', array($this, 'saveTermDetails'), 10, 1);
		}
	}

	/**
	 * Returns icon
	 * @param $id
	 * @param string $default
	 * @return string
	 */

	public function getIcon($id, $default = '') {
		if ($this->active) {
			return get_term_meta($id, self::ICON_KEY, true);
		}
		return $default;

	}


	/**
	 * @param $tag
	 */
	public function newTermMeta($tag) {
		$description = $this->getIconDescription();
		?>
		<div class="form-field">
			<label for="icon-url"><?php _e('Icon name', 'ct_theme') ?></label>
			<input name="icon-url" id="icon-url" type="text" value="" size="40" aria-required="true"/>

			<p class="description"><?php echo $description?></p>
		</div>
	<?php
	}

	/**
	 * Returns description for field
	 * @return string
	 */
	protected function getIconDescription(){
		$link = CT_THEME_ASSETS.'/shortcode/entypo/index.html';
		return sprintf(__("View %s and enter icon name ex. star",'ct_theme'),'<a target="_blank" href="' . $link . '">' . __('available icons', 'ct_theme') . '</a>');
	}

	/**
	 * @param $tag
	 */
	function editTermMeta($tag) {
		$description = $this->getIconDescription();
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="icon-url"><?php _e('Icon name', 'ct_theme'); ?></label>
			</th>
			<td>
				<input name="icon-url" id="icon-url" type="text" value="<?php echo get_term_meta($tag->term_id, 'icon-url', true); ?>" size="40" aria-required="true"/>

				<p class="description"><?php echo $description?></p>
			</td>
		</tr>
	<?php
	}


	/**
	 * @param $term_id
	 */
	public function saveTermDetails($term_id) {
		$fields = array(self::ICON_KEY);
		foreach ($fields as $field) {
			if (isset($_POST[$field])) {
				update_term_meta($term_id, $field, $_POST[$field]);
			}
		}
	}


}


if (!function_exists('ct_get_object_icon')) {
	/**
	 * Returns object icon
	 * @param $id
	 * @return mixed|null
	 */
	function ct_get_object_icon($id) {
		return ctSimpleMetaTermExtension::getInstance()->getIcon($id);
	}
}

if (!function_exists('ct_get_object_icon_formatted')) {
	/**
	 * Returns object icon formatted
	 * @param $name
	 * @param $id
	 * @return mixed|null
	 */
	function ct_get_object_icon_formatted($name, $id) {
		$s = ct_get_object_icon($id);
		if ($s) {
			return '<span class="entypo ' . esc_attr($s) . ' metaText"><i></i>' . $name . '</span>';
		} else {
			return '<span class="entypo tag metaText"><i></i>' . $name . '</span>';
		}
	}
}