<?php
/**
 * wp_nav_menu custom walker for breadcrumbs
 */
class ctInviaBreadCrumbWalker extends ctBreadCrumbWalker {

	/**
	 * @see Walker::start_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_element(&$output, $item, $depth, $args) {

		//Check if menu item is an ancestor of the current page
		$classes = empty($item->classes) ? array() : (array)$item->classes;
		$current_identifiers = array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor');
		$ancestor_of_current = array_intersect($current_identifiers, $classes);

		if ($ancestor_of_current) {
			$title = apply_filters('the_title', $item->title, $item->ID);

			//Preceed with delimter for all but the first item.
			if (0 != $depth) {
				$output .= $this->delimiter;
			}

			//Link tag attributes
			$attributes = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
			$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
			$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
			$nolink = empty($item->url) || !$item->url || $item->url == "#";

			//Add to the HTML output
			$isCurrent = false;
			foreach ($classes as $class) {
				if ($class == 'current-menu-item') {
					$isCurrent = true;
					break;
				}
			}


			if($depth == 0){
				$output .= '<a' . $attributes . ' class="btn metaIcon" data-toggle="tooltip" title="' . $title . '"><span class="entypo home"><i></i>' . $title . '</span></a>';
			}elseif($depth == 1){
				if ($isCurrent || $nolink) {
					$output .= '
					<span class="btn btn-icon left btn-primary"><span class="entypo pencil"><i></i></span>' . $title . '</span>';
				} else {
					$output .= '
					<a' . $attributes . ' class="btn btn-icon left btn-primary"><span class="entypo pencil"><i></i></span>' . $title . '</a>';
				}
			}
		}
	}
}