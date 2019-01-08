<?php
/**
 * Draws works
 */
class ctWorksShortcode extends ctShortcodeQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Works';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'works';
	}

	public function enqueueScripts() {
		wp_register_script('ct-contenthover', CT_THEME_ASSETS . '/js/jquery.contenthover.min.js');
		wp_enqueue_script('ct-contenthover');
		wp_register_script('ct-easing', CT_THEME_ASSETS . '/js/jquery.easing.js');
		wp_enqueue_script('ct-easing');
		wp_register_script('ct-quicksand', CT_THEME_ASSETS . '/js/jquery.quicksand.js');
		wp_enqueue_script('ct-quicksand');
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

		$recentposts = $this->getCollection($attributes, array('post_type' => 'portfolio'));

		$id = rand(100, 1000);

		//filters
		$filtersOn = $filters == "on" || $filters == "true";
		$filtersHtml = '';
		if ($filtersOn) {
			$catsListHtml = '';

			$terms = get_terms('portfolio_category', 'hide_empty=1');
			foreach ($terms as $term) {
				$icon = ct_get_object_icon($term->term_id);
				$icon =  $icon ? $icon : 'tag';
				$catsListHtml .= '<li data-filter="filter-' . $term->term_id . '"><a href="#" class="btn metaIcon" data-toggle="tooltip" title="' . strtoupper($term->name) . '"><span class="entypo ' . $icon . '"><i></i>' . strtoupper($term->name) . '</span></a></li>';
			}

			$catsListHtml .= $allfilterheader ? '<li class="active"><a href="#" class="btn">' . $allfilterheader . '</a></li>' : '';

			if ($catsListHtml) {
				$filtersHtml = '<div'.$this->buildContainerAttributes(array('class'=>array('lineBox','short')),$atts).'>
						            <div class="inner">
						                <ul class="filterPortfolio">' . $catsListHtml . '</ul>
						            </div>
						        </div>';
			}
			$this->addInlineJS($this->getInlineJS($id));
		}

		$size = 'full';
		switch ($columns) {
			case 2:
				$size = 'thumb_2_cols';
				break;
			case 3:
				$size = 'thumb_3_cols';
				break;
			default:
				$size = 'thumb_4_cols';
		}

		//elements
		$elements = '';
		$counter = 0;
		foreach ($recentposts as $p) {
			$counter++;
			$title = $titles == "yes" ? $p->post_title : '';
			$summary = $summaries == "yes" ? $p->post_excerpt : '';
			$imgsrc = $images == "yes" ? ct_get_feature_image_src($p->ID, $size) : '';
			$link = get_permalink($p);

			$cats = '';
			$catsids = '';
			$catsFilters = "";
			$terms = get_the_terms($p->ID, 'portfolio_category');
			if ($terms) {
				foreach ($terms as $term) {
					$catsFilters .= ("filter-" . $term->term_id . " ");
					$cats .= ($term->name . ",");
					$catsids .= ($term->term_id . ",");
				}
				$catsFilters = substr($catsFilters, 0, -1);
				$cats = substr($cats, 0, -1);
				$catsids = substr($catsids, 0, -1);
			}
			$cats = $categories == "yes" ? $cats : '';
			$catsids = $categories == "yes" ? $catsids : '';

			$elements .= '<li data-id="' . $counter . '" data-filter="' . $catsFilters . '">
							' . $this->embedShortcode('work', array(
				'title' => $title,
				'summary' => $summary,
				'imgsrc' => $imgsrc,
				'link' => $link,
				'categories' => $cats,
				'categoriesids' => $catsids,
			)) . '</li>';
		}

		$html = $filtersHtml . '<ul class="portfolioList col' . $columns . '" id="portfolio' . $id . '">' . $elements . '</ul>';
		return do_shortcode($html);

	}

	/**
	 * returns JS
	 * @param $id
	 * @return string
	 */
	protected function getInlineJS($id) {
		return '/* content on hover */
				function overlayContent(i) {
				    if (i == "init") {
				        jQuery(".contentoverlay").contenthover({
				            overlay_opacity: 0.6,
				            effect: "fade",                 // [fade, slide, show] The effect to use
				            fade_speed: 400,                // Effect ducation for the "fade" effect only
				            slide_speed: 400,               // Effect ducation for the "slide" effect only
				            slide_direction: "bottom"      // [top, bottom, right, left] From which direction should the overlay apear, for the slide effect only
				        });
				    }
				    if (i == "reload") {
				        /* responsive overlay fix */
				        jQuery(".ch_element").remove();
				        jQuery(".contentoverlay").show();
				        overlayContent("init");
				    }
				}
		
				function portfolioSort(){
		                /*** Quicksand ***/
		                var p = jQuery("#portfolio' . $id . '");
		                var f = jQuery(".filterPortfolio");
		                var data = p.clone();
		                f.find("a").click(function () {
		                    var link = jQuery(this);
		                    var li = link.parents("li");
		                    if (li.hasClass("active")) {
		                        return false;
		                    }

		                    f.find("li").removeClass("active");
		                    li.addClass("active");

		                    //quicksand
		                    var filtered = li.data("filter") ? data.find("li[data-filter~=' . "'" . '" + li.data("filter") + "' . "'" . ']") : data.find("li");

		                    p.quicksand(filtered, {
		                        duration:800,
		                        adjustHeight: false,
		                        easing:"easeInOutQuad"}, function () { // callback function

		                         overlayContent("reload");

		                    });
		                    return false;
		                });
		            }

		            jQuery(document).ready(function () {
	                    portfolioSort();
	                });';
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
		$atts = $this->getAttributesWithQuery(array(
			'limit' => array('label' => __('limit', 'ct_theme'), 'default' => 3, 'type' => 'input', 'help' => __("Number of portfolio elements", 'ct_theme')),
			'filters' => array('label' => __('filters', 'ct_theme'), 'default' => 'false', 'type' => 'checkbox', 'help' => __("Show filters?", 'ct_theme')),
			'allfilterheader' => array('label' => __('"all filter" header', 'ct_theme'), 'default' => __('View all', 'ct_theme'), 'type' => 'input', 'help' => __("Header for the 'show all' filter", 'ct_theme')),
			'columns' => array('label' => __('columns', 'ct_theme'), 'default' => '3', 'type' => 'select', 'choices' => array('4' => '4', '3' => '3', '2' => '2'), 'help' => __("Number of columns", 'ct_theme')),
			'titles' => array('label' => __('titles', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show titles?", 'ct_theme')),
			'summaries' => array('label' => __('summaries', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show excerpts?", 'ct_theme')),
			'categories' => array('label' => __('categories', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show categories?", 'ct_theme')),
			'images' => array('label' => __('images', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show images?", 'ct_theme')),
		));

		if (isset($atts['cat'])) {
			unset($atts['cat']);
		}
		return $atts;
	}
}

new ctWorksShortcode();