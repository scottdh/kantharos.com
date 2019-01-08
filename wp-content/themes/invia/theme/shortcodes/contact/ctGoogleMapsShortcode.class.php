<?php
/**
 * Google maps shortcode
 */
class ctGoogleMapsShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Google maps';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'google_maps';
	}

	/**
	 * Enqueue scripts
	 */

	public function enqueueScripts() {
		wp_register_script('google-map-api', 'http://maps.google.com/maps/api/js?sensor=false');
		wp_register_script('jquery-gmap', CT_THEME_ASSETS . '/js/vendor/jquery.gmap.min.js', array('jquery', 'google-map-api'), '2.1');
		wp_enqueue_script('jquery-gmap');
		wp_enqueue_script('google-map-api', false, array(), false, true);
	}


	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));


		if ($width) {
			if (is_numeric($width)) {
				$width = $width . 'px';
			}
			$width = 'width:' . $width . ';';
		} else {
			$width = '';
			$align = false;
		}
		if ($height) {
			if (is_numeric($height)) {
				$height = $height . 'px';
			}
			$height = 'height:' . $height . ';';
		} else {
			$height = '';
		}
		$html = str_replace('{linebreak}', '<br/>', $html);

		/* fix */
		$search = array('G_NORMAL_MAP', 'G_SATELLITE_MAP', 'G_HYBRID_MAP', 'G_DEFAULT_MAP_TYPES', 'G_PHYSICAL_MAP');
		$replace = array('ROADMAP', 'SATELLITE', 'HYBRID', 'HYBRID', 'TERRAIN');
		$maptype = str_replace($search, $replace, $maptype);
		/* end fix */

		if ($controls == 'true') {
			$controls = "
				{
					panControl: {$pancontrol},
					zoomControl: {$zoomcontrol},
					mapTypeControl: {$maptypecontrol},
					scaleControl: {$scalecontrol},
					streetViewControl: {$streetviewcontrol},
					overviewMapControl: {$overviewmapcontrol}
				}
				";
		}

		$align = $align ? ' align' . $align : '';
		$id = rand(100, 1000);

		if ($type == "blackwhite") {
			$this->addInlineJS('function initialize() {
							             var mapDiv = document.getElementById("map-canvas' . $id . '");
							             var latLng = new google.maps.LatLng(' . $latitude . ', ' . $longitude . ');
							             var map = new google.maps.Map(mapDiv, {
							             center: latLng,
							             zoom: ' . $zoom . ',
							             scrollwheel: ' . $scrollwheel . ',
							             navigationControl: false,
							             mapTypeControl: false,
							             scaleControl: false,
							             draggable: false,
							             disableDefaultUI: true,
							             mapTypeId: google.maps.MapTypeId.' . $maptype . ',
							           });
							         }
					               google.maps.event.addDomListener(window, "load", initialize);
					               google.maps.event.addDomListener(window, "resize", initialize);');

			$infoheader = $infoheader ? ('<strong>' . $infoheader . '</strong>') : '';
			$infostreet = $infostreet ? ('<p>' . $infostreet . '</p>') : '';

			$infocitypost = $infocity;
			$infocitypost .= $infocity && $infopostcode ? ', ' : '';
			$infocitypost .= $infopostcode;
			$infocitypost = $infocitypost ? ('<p>' . $infocitypost . '</p>') : '';

			$infophone = $infophone ? ('<p>' . __('Phone: ', 'ct_theme') . $infophone . '</p>') : '';
			$infofax = $infofax ? ('<p>' . __('Fax: ', 'ct_theme') . $infofax . '</p>') : '';
			$infoemail = $infoemail ? ('<p><a href="mailto:' . $infoemail . '">' . $infoemail . '</a></p>') : '';
			$info = $infoheader . $infostreet . $infocitypost . $infophone . $infofax . $infoemail;

			$infoBox = $info ? '<div class="contactInfoBox">
			               ' . $info . '
			           </div>' : '';

			return '<div class="contactMap" style="' . $width . $height . '">
			            <div class="gmap-marker">
			                <span class="entypo location"><i></i></span>
			            </div>
			            <div class="map-canvas" id="map-canvas' . $id . '" style="' . $width . $height . '"></div>
			            ' . $infoBox . '
			        </div>';
		} else {
			if ($marker != 'false') {
				$this->addInlineJS("jQuery(document).ready(function($) {
						var tabs = jQuery('#google_map_{$id}').parents('.tabs_container,.mini_tabs_container,.accordion');
						jQuery('#google_map_{$id}').bind('initGmap',function(){
							jQuery(this).gMap({
								zoom: {$zoom},
								markers:[{
									address: '{$address}',
									latitude: {$latitude},
									longitude: {$longitude},
									html: '{$html}',
									popup: {$popup}
								}],
								controls: {$controls},
								maptype: '{$maptype}',
								doubleclickzoom:{$doubleclickzoom},
								scrollwheel:{$scrollwheel}
							});
							jQuery(this).data('gMapInited',true);
						}).data('gMapInited',false);
						if(tabs.size()!=0){
							tabs.find('ul.tabs,ul.mini_tabs,.accordion').data('tabs').onClick(function(index) {
								this.getCurrentPane().find('.google_map').each(function(){
									if(jQuery(this).data('gMapInited')==false){
										jQuery(this).trigger('initGmap');
									}
								});
							});
						}
						else{
								jQuery('#google_map_{$id}').trigger('initGmap');
							}
						});");
				return "<div id='google_map_{$id}' class='google_map{$align}' style='{$width}{$height}'></div>";
			} else {
				$this->addInlineJS("jQuery(document).ready(function($) {
								var tabs = jQuery('#google_map_{$id}').parents('.tabs_container,.mini_tabs_container,.accordion');
								jQuery('#google_map_{$id}').bind('initGmap',function(){
									jQuery('#google_map_{$id}').gMap({
										zoom: {$zoom},
										latitude: {$latitude},
										longitude: {$longitude},
										address: '{$address}',
										controls: {$controls},
										maptype: '{$maptype}',
										doubleclickzoom:{$doubleclickzoom},
										scrollwheel:{$scrollwheel}
									});
									jQuery(this).data('gMapInited',true);
								}).data('gMapInited',false);
								if(tabs.size()!=0){
									tabs.find('ul.tabs,ul.mini_tabs,.accordion').data('tabs').onClick(function(index) {
										this.getCurrentPane().find('.google_map').each(function(){
											if(jQuery(this).data('gMapInited')==false){
												jQuery(this).trigger('initGmap');
											}
										});
									});
								}else{
									jQuery('#google_map_{$id}').trigger('initGmap');
								}
							});");
				return "<div class='simpleFrame'><div id='google_map_{$id}' class='thumbnail google_map{$align} linkable' style='{$width}{$height}'></div></div>";
			}
		}
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'type' => array('label' => __("map type", 'ct_theme'), 'default' => 'blackwhite', 'type' => 'select', 'choices' => array('normal' => __('normal', 'ct_theme'), 'blackwhite' => __('black and white', 'ct_theme')), 'help' => "Use normal map or the black and white type?", 'ct_theme'),
			"width" => array('default' => false, 'type' => 'input'),
			"height" => array('label' => __('height', 'ct_theme'), 'default' => '485', 'type' => 'input'),
			"address" => array('label' => __('address', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("option not available for black and white map type", 'ct_theme')),
			'infoheader' => array('label' => __('info box header', 'ct_theme'),'default' => '', 'type' => 'input', 'help' => __("Header text",'ct_theme')),
			'infostreet' => array('label' => __('info box street', 'ct_theme'),'default' => '', 'type' => 'input'),
			'infocity' => array('label' => __('info box city', 'ct_theme'),'default' => '', 'type' => 'input'),
			'infopostcode' => array('label' => __('info box postcode', 'ct_theme'),'default' => '', 'type' => 'input'),
			'infophone' => array('label' => __('info box phone', 'ct_theme'),'default' => '', 'type' => 'input'),
			'infofax' => array('label' => __('info box fax', 'ct_theme'),'default' => '', 'type' => 'input'),
			'infoemail' => array('label' => __('info box email', 'ct_theme'),'default' => '', 'type' => 'input', 'help' => __("Email address",'ct_theme')),
			"latitude" => array('label' => __('latitude', 'ct_theme'), 'default' => 0, 'type' => 'input'),
			"longitude" => array('label' => __('longitude', 'ct_theme'), 'default' => 0, 'type' => 'input'),
			"zoom" => array('label' => __('zoom', 'ct_theme'), 'default' => 14, 'type' => 'input'),
			"html" => array('default' => '', 'type' => 'input', 'label' => __('Localization note', 'ct_theme')),
			"popup" => array('label' => __('popup', 'ct_theme'), 'default' => 'false', 'type' => 'checkbox'),
			"controls" => array('label' => __('controls', 'ct_theme'), 'default' => 'false', 'type' => 'checkbox'),
			'pancontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Pan control', 'ct_theme')),
			'zoomcontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Zoom control', 'ct_theme')),
			'maptypecontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Map type control', 'ct_theme')),
			'scalecontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Scale control', 'ct_theme')),
			'streetviewcontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Streetview control', 'ct_theme')),
			'overviewmapcontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Overview map control', 'ct_theme')),
			"scrollwheel" => array('default' => 'false', 'type' => 'checkbox', 'label' => __('Scroll Wheel', 'ct_theme')),
			'doubleclickzoom' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Doubleclick zoom', 'ct_theme')),
			"maptype" => array('label' => __('map type', 'ct_theme'), 'default' => 'ROADMAP', 'type' => 'select', 'choices' => array('ROADMAP' => __('ROADMAP', 'ct_theme'), 'SATELLITE' => __('SATELLITE', 'ct_theme'), 'HYBRID' => __('HYBRID', 'ct_theme'), 'TERRAIN' => __('TERRAIN', 'ct_theme'))),
			"marker" => array('label' => __('marker', 'ct_theme'), 'default' => 'false', 'type' => 'checkbox'),
			'align' => array('default' => false, 'type' => false),
		);
	}
}

new ctGoogleMapsShortcode();