<?php
require_once CT_THEME_LIB_DIR . '/types/ctPageTypeBase.class.php';

/**
 * page type
 */

class ctPageType extends ctPageTypeBase {

	/**
	 * Adds meta box
	 */

	public function addMetaBox() {
		parent::addMetaBox();
		add_meta_box("page-template-meta", __("Template settings", 'ct_theme'), array($this, "pageTemplateMeta"), "page", "normal", "high");
	}

	/**
	 * page template settings
	 */

	public function pageTemplateMeta() {
		global $post;
		$custom = get_post_custom($post->ID);
		$title = isset($custom["show_title"][0]) ? $custom["show_title"][0] : "";
		$subtitle = isset($custom["subtitle"][0]) ? $custom["subtitle"][0] : "";
		$bread = isset($custom["show_breadcrumbs"][0]) ? $custom["show_breadcrumbs"][0] : "";
		$boxed = isset($custom["use_boxed"][0]) ? $custom["use_boxed"][0] : "";
		?>
	<p>
        <label for="show_title"><?php _e('Show title', 'ct_theme')?>: </label>
        <select id="show_title" name="show_title">
	        <option value="global" <?php echo selected('global', $title)?>><?php _e("use global settings", 'ct_theme')?></option>
            <option value="yes" <?php echo selected('yes', $title)?>><?php _e("show title", 'ct_theme')?></option>
            <option value="no" <?php echo selected('no', $title)?>><?php _e("hide title", 'ct_theme')?></option>
        </select>
    </p>
    <p class="howto"><?php _e("Show page title?", 'ct_theme')?></p>

	<p>
        <label for="subtitle"><?php _e('Subtitle', 'ct_theme')?>: </label>
        <textarea id="subtitle" class="regular-text" name="subtitle" cols="100" rows="10"><?php echo $subtitle; ?></textarea>
    </p>
    <p class="howto"><?php _e("Subtitle content", 'ct_theme')?></p>

	<p>
        <label for="show_breadcrumbs"><?php _e('Show breadcrumbs', 'ct_theme')?>: </label>
        <select id="show_breadcrumbs" name="show_breadcrumbs">
	        <option value="global" <?php echo selected('global', $bread)?>><?php _e("use global settings", 'ct_theme')?></option>
            <option value="yes" <?php echo selected('yes', $bread)?>><?php _e("show breadcrumbs", 'ct_theme')?></option>
            <option value="no" <?php echo selected('no', $bread)?>><?php _e("hide breadcrumbs", 'ct_theme')?></option>
        </select>
    </p>
    <p class="howto"><?php _e("Show breadcrumbs?", 'ct_theme')?></p>

	<p>
        <label for="use_boxed"><?php _e('Use boxed layout', 'ct_theme')?>: </label>
        <select id="use_boxed" name="use_boxed">
	        <option value="global" <?php echo selected('global', $boxed)?>><?php _e("use global settings", 'ct_theme')?></option>
            <option value="yes" <?php echo selected('yes', $boxed)?>><?php _e("boxed layout", 'ct_theme')?></option>
            <option value="no" <?php echo selected('no', $boxed)?>><?php _e("full layout", 'ct_theme')?></option>
        </select>
    </p>
    <p class="howto"><?php _e("Use boxed or full layout template for this page?", 'ct_theme')?></p>
	<?php
	}


	public function saveDetails() {
		parent::saveDetails();
		global $post;

		$fields = array('show_title', 'subtitle', 'show_breadcrumbs', 'use_boxed');
		foreach ($fields as $field) {
			if (isset($_POST[$field])) {
				update_post_meta($post->ID, $field, $_POST[$field]);
			}
		}
	}
}

new ctPageType();