<?php 
/*
 * Text block Shortcode
 * Author: UPQODE
 * Author URI: http://upqode.com
 * Version: 1.0.0 
 */

vc_map( 
	array(
		'name'                    => __( 'Google Maps', 'js_composer' ),
		'base'                    => 'vc_ugm_map',
        'description' 			  => __( 'Google Maps', 'js_composer'),
        'as_parent' 		      => array( 'only' => 'vc_ugm_map_marker' ),
		'content_element'         => true,
		'show_settings_on_create' => true,
        'icon'                    => 'gm-addon-shortcode-icon',
        'admin_enqueue_css'       => UGM_PLUGIN_DIR_URL . 'admin/css/ugm-addon-admin-style.css',
        'js_view'                 => 'VcColumnView',
		'params' 				  => array(

		    // GENERAL
            //===========================================================================

            // Wrapper height
            array(
                'type' 		  => 'textfield',
                'heading'     => __( 'Map height', 'js_composer' ),
                'description' => __( 'Set Map height, 300px by default', 'js_composer'  ),
                'param_name'  => 'map_height',
            ),

            // Center map
            array(
                'heading'     => __( 'Map auto center', 'js_composer' ),
                'description' => __( 'Set map center automaiticaly to show your locations', 'js_composer'  ),
				'type' 		  => 'dropdown',
				'param_name'  => 'center_map',
				'value' 	  => array(
                    __( 'Disable', 'js_composer' )                  => 'no',
                    __( 'Auto(show all locations)', 'js_composer' ) => 'yes',
					__( 'By Address', 'js_composer' )               => 'address'
				)
			),

            // Center map by address
            array(
                'heading'     => __( 'Map center adderess:', 'js_composer' ),
                'type'        => 'textfield',
                'param_name'  => 'search_input',
                'description' => 'Search address',
                'dependency'  => array( 
                    'element'   => 'center_map', 
                    'value'     => array( 'address' ) 
                )
            ),

            //Type map
            array(
                'heading' 	  => __( 'Map Type: ', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'type_chortcode',
                'value' 	  => array(
                    __( 'Single Markers ', 'js_composer' ) => 'single_markers',
                    __( 'Directions ', 'js_composer' )     => 'directions',
                )
            ),

            //Color Routes Line
            array(
                'heading' 	  => __( 'Route Line Color:', 'js_composer' ),
                'type' 		  => 'colorpicker',
                'param_name'  => 'color_route_line',
                'dependency'  => array( 
                    'element'   => 'type_chortcode', 
                    'value'     => array( 'directions' ) 
                )
            ),

            // Enable GEO location in page
            array(
                'heading' 	  => __( 'Activate GeoLocation', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'activate_geo',
                'value' 	  => array(
                    __( 'Off', 'js_composer' )                          => 'off',
                    __( 'IP Location', 'js_composer' )                  => 'ip_location',
                    __( 'Browser Location(https only)', 'js_composer' ) => 'browser_location'
                )
            ),


            // ZOOM
            //============================================================================

            //zoom map
            array(
                'heading' 	  => __( 'Zoom map', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'zoom_map',
                'description' => 'Set zoom map. You cat set zoom value from 1 to 21. If you select auto center option it will be ignored.',
                'value' 	  => array(
                    __( '1', 'js_composer' ) => '1',
                    __( '2', 'js_composer' ) => '2',
                    __( '3', 'js_composer' ) => '3',
                    __( '4', 'js_composer' ) => '4',
                    __( '5', 'js_composer' ) => '5',
                    __( '6', 'js_composer' ) => '6',
                    __( '7', 'js_composer' ) => '7',
                    __( '8', 'js_composer' ) => '8',
                    __( '9', 'js_composer' ) => '9',
                    __( '10', 'js_composer' ) => '10',
                    __( '11', 'js_composer' ) => '11',
                    __( '12', 'js_composer' ) => '12',
                    __( '13', 'js_composer' ) => '13',
                    __( '14', 'js_composer' ) => '14',
                    __( '15', 'js_composer' ) => '15',
                    __( '16', 'js_composer' ) => '16',
                    __( '17', 'js_composer' ) => '17',
                    __( '18', 'js_composer' ) => '18',
                    __( '19', 'js_composer' ) => '19',
                    __( '20', 'js_composer' ) => '20',
                    __( '21', 'js_composer' ) => '21',
                ),
                'group' => 'Zoom',
            ),

            //zoom controol
            array(
                'type' 		  => 'checkbox',
                'heading'     => __( 'Enable Zoom Control', 'js_composer' ),
                'param_name'  => 'zoom_control',
                'description' => 'Enable Zoom control in Map',
                'group' => 'Zoom',
            ),

            // Zoom Control position
            array(
                'heading' 	  => __( 'Zoom Control Position', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'zoom_control_position',
                'description' => 'Position control zoom in map',
                'value' 	  => array(
                    __( 'TOP CENTER', 'js_composer' ) => 'TOP_CENTER',
                    __( 'TOP LEFT', 'js_composer' ) => 'TOP_LEFT',
                    __( 'TOP RIGHT', 'js_composer' ) => 'TOP_RIGHT',
                    __( 'LEFT TOP', 'js_composer' ) => 'LEFT_TOP',
                    __( 'RIGHT TOP', 'js_composer' ) => 'RIGHT_TOP',
                    __( 'LEFT CENTER', 'js_composer' ) => 'LEFT_CENTER',
                    __( 'RIGHT CENTER', 'js_composer' ) => 'RIGHT_CENTER',
                    __( 'LEFT BOTTOM', 'js_composer' ) => 'LEFT_BOTTOM',
                    __( 'RIGHT BOTTOM', 'js_composer' ) => 'RIGHT_BOTTOM',
                    __( 'BOTTOM CENTER', 'js_composer' ) => 'BOTTOM_CENTER',
                    __( 'BOTTOM LEFT', 'js_composer' ) => 'BOTTOM_LEFT',
                    __( 'BOTTOM RIGHT', 'js_composer' ) => 'BOTTOM_RIGHT',
                ),
                'dependency' => array( 'element' => 'zoom_control', 'value' => array( 'true' ) ),
                'group' => 'Zoom',
            ),

            //Zoom style
            array(
                'heading' 	  => __( 'Zoom Control Style', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'zoom_control_style',
                'description' => 'Zoom control style',
                'value' 	  => array(
                    __( 'Default', 'js_composer' ) => 'default',
                    __( 'Style 1', 'js_composer' ) => 'style_1',
                ),
                'dependency'  => array( 'element' => 'zoom_control', 'value' => array( 'true' ) ),
                'group'       => 'Zoom',
            ),

            //Scroll wheel
            array(
                'type' 		  => 'checkbox',
                'heading'     => __( 'Scroll Wheel', 'js_composer' ),
                'param_name'  => 'is_scroll_wheel',
                'description' => 'If enable, zoom level will be changed by mouse scroll wheel',
                'group'       => 'Zoom',
            ),

            // MAP CONTROLS
            //============================================================================
            // Pan controls
            array(
                'type' 		  => 'checkbox',
                'heading'     => __( 'Pan controls', 'js_composer' ),
                'param_name'  => 'is_pan_controls',
                'description' => 'Display button for panning',
                'group'       => 'Controls',
            ),


            //Dragable map
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Draggable map', 'js_composer' ),
                'param_name'  => 'is_dragable_map',
                'description' => 'Enable Dragable Map. If enable, map will be draggable by mouse.',
                'group'       => 'Controls',
            ),

            // Pan control position
            array(
                'heading' 	  => __( 'Pan Control position', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'pan_control_position',
                'description' => 'Pan Control buttons position',
                'value' 	  => array(
                    __( 'TOP CENTER', 'js_composer' ) => 'TOP_CENTER',
                    __( 'TOP LEFT', 'js_composer' ) => 'TOP_LEFT',
                    __( 'TOP RIGHT', 'js_composer' ) => 'TOP_RIGHT',
                    __( 'LEFT TOP', 'js_composer' ) => 'LEFT_TOP',
                    __( 'RIGHT TOP', 'js_composer' ) => 'RIGHT_TOP',
                    __( 'LEFT CENTER', 'js_composer' ) => 'LEFT_CENTER',
                    __( 'RIGHT CENTER', 'js_composer' ) => 'RIGHT_CENTER',
                    __( 'LEFT BOTTOM', 'js_composer' ) => 'LEFT_BOTTOM',
                    __( 'RIGHT BOTTOM', 'js_composer' ) => 'RIGHT_BOTTOM',
                    __( 'BOTTOM CENTER', 'js_composer' ) => 'BOTTOM_CENTER',
                    __( 'BOTTOM LEFT', 'js_composer' ) => 'BOTTOM_LEFT',
                    __( 'BOTTOM RIGHT', 'js_composer' ) => 'BOTTOM_RIGHT',
                ),
                'dependency' => array( 'element' => 'is_pan_controls', 'value' => array( 'true' ) ),
                'group' => 'Controls',
            ),

            // Scale control
            array(
                'type' 		  => 'checkbox',
                'heading'     => __( 'Scale Control', 'js_composer' ),
                'param_name'  => 'is_scale_control',
                'description' => 'Display map scale element',
                'group' => 'Controls',
            ),

            // Street view control
            array(
                'type' 		  => 'checkbox',
                'heading'     => __( 'Street view control', 'js_composer' ),
                'param_name'  => 'is_street_view',
                'description' => 'Display Pagman icon',
                'group' => 'Controls',
            ),

            // Street view control position
            array(
                'heading' 	  => __( 'Street view control position', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'street_view_control_position',
                'description' => 'Pagman icon position',
                'value' 	  => array(
                    __( 'TOP CENTER', 'js_composer' )    => 'TOP_CENTER',
                    __( 'TOP LEFT', 'js_composer' )      => 'TOP_LEFT',
                    __( 'TOP RIGHT', 'js_composer' )     => 'TOP_RIGHT',
                    __( 'LEFT TOP', 'js_composer' )      => 'LEFT_TOP',
                    __( 'RIGHT TOP', 'js_composer' )     => 'RIGHT_TOP',
                    __( 'LEFT CENTER', 'js_composer' )   => 'LEFT_CENTER',
                    __( 'RIGHT CENTER', 'js_composer' )  => 'RIGHT_CENTER',
                    __( 'LEFT BOTTOM', 'js_composer' )   => 'LEFT_BOTTOM',
                    __( 'RIGHT BOTTOM', 'js_composer' )  => 'RIGHT_BOTTOM',
                    __( 'BOTTOM CENTER', 'js_composer' ) => 'BOTTOM_CENTER',
                    __( 'BOTTOM LEFT', 'js_composer' )   => 'BOTTOM_LEFT',
                    __( 'BOTTOM RIGHT', 'js_composer' )  => 'BOTTOM_RIGHT',
                ),
                'dependency' => array( 'element' => 'is_street_view', 'value' => array( 'true' ) ),
                'group' => 'Controls',
            ),

            // Map type control
            array(
                'type' 		  => 'checkbox',
                'heading'     => __( 'Map type control', 'js_composer' ),
                'param_name'  => 'is_map_type_control',
                'description' => 'Display a map type control',
                'group' => 'Controls',
            ),

            // Map type control position
            array(
                'heading' 	  => __( 'Map type control position', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'map_type_control_position',
                'description' => 'Map type control position',
                'value' 	  => array(
                    __( 'TOP CENTER', 'js_composer' )    => 'TOP_CENTER',
                    __( 'TOP LEFT', 'js_composer' )      => 'TOP_LEFT',
                    __( 'TOP RIGHT', 'js_composer' )     => 'TOP_RIGHT',
                    __( 'LEFT TOP', 'js_composer' )      => 'LEFT_TOP',
                    __( 'RIGHT TOP', 'js_composer' )     => 'RIGHT_TOP',
                    __( 'LEFT CENTER', 'js_composer' )   => 'LEFT_CENTER',
                    __( 'RIGHT CENTER', 'js_composer' )  => 'RIGHT_CENTER',
                    __( 'LEFT BOTTOM', 'js_composer' )   => 'LEFT_BOTTOM',
                    __( 'RIGHT BOTTOM', 'js_composer' )  => 'RIGHT_BOTTOM',
                    __( 'BOTTOM CENTER', 'js_composer' ) => 'BOTTOM_CENTER',
                    __( 'BOTTOM LEFT', 'js_composer' )   => 'BOTTOM_LEFT',
                    __( 'BOTTOM RIGHT', 'js_composer' )  => 'BOTTOM_RIGHT',
                ),
                'dependency' => array( 'element' => 'is_map_type_control', 'value' => array( 'true' ) ),
                'group' => 'Controls',
            ),

            // Map type
            array(
                'heading' 	  => __( 'Map type', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'map_type',
                'description' => 'Map type',
                'value' 	  => array(
                    __( 'HYBRID', 'js_composer' )    => 'HYBRID',
                    __( 'ROADMAP', 'js_composer' )   => 'ROADMAP',
                    __( 'SATELLITE', 'js_composer' ) => 'SATELLITE',
                    __( 'TERRAIN', 'js_composer' )   => 'TERRAIN',
                ),
                'group' => 'Controls',
            ),

            // Enable 3d mode google maps
            array(
                'type' 		  => 'checkbox',
                'heading'     => __( 'Enable 3D mode', 'js_composer' ),
                'param_name'  => 'is_3d_mode',
                'description' => 'This option working for SATELLITE and HYBRID maps.',
                'group'       => 'Controls',
                'dependency'  => array( 'element' => 'map_type', 'value' => array( 'SATELLITE',  'HYBRID') ),
            ),

            // Enable Street view Toggle Button
            array(
                'type' 		  => 'checkbox',
                'heading'     => __( 'Enable Street view Toggle Button', 'js_composer' ),
                'param_name'  => 'is_enable_street_view_btn',
                'description' => 'Enable Street view Toggle Button',
                'group'       => 'Controls',
            ),

            // Map type Control Style
            array(
                'heading' 	  => __( 'Map type Control Style', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'map_type_control_style',
                'description' => 'Choosen map type control style',
                'value' 	  => array(
                    __( 'HORIZONTAL_BAR', 'js_composer' ) => 'HORIZONTAL_BAR',
                    __( 'DROPDOWN_MENU',  'js_composer' ) => 'DROPDOWN_MENU',
                    __( 'DEFAULT',        'js_composer' ) => 'DEFAULT',
                ),
                'group' => 'Controls',
            ),

            array(
                'type' 		  => 'checkbox',
                'heading'     => __( 'Enable Destination information', 'js_composer' ),
                'param_name'  => 'is_enable_destination_info',
                'description' => 'Enable Destination information',
                'group'       => 'Controls',
                'dependency'  => array( 'element' => 'type_chortcode', 'value' => array( 'directions' ) )
            ),

            // MISCENALLEOUS
            //============================================================================

            // Overview Map Control
            array(
                'type' 		  => 'checkbox',
                'heading'     => __( 'Reload on resize', 'js_composer' ),
                'param_name'  => 'is_reload_on_resize',
                'description' => 'If checked, map will be reload on screen resize',
                'group'       => 'Miscellaneous',
            ),

            // Language map
            array(
                'heading' 	  => __( 'Map language', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'language',
                'description' => 'Language your map',
                'value' 	  => ugm_get_language_code(),
                'group'       => 'Miscellaneous',
            ),

            // MISCENALLEOUS
            //============================================================================
            array(
                'type' 		  => 'textarea_raw_html',
                'heading'     => __( 'JSON Style', 'js_composer' ),
                'param_name'  => 'json_style',
                'description' => 'Map Style from site <a href="https://snazzymaps.com/explore" target="_blank">snazzymaps.com</a>',
                'group'       => 'Style',

            ),

            // ---------------------------------------------------------------------------
            // style wrapper
			array(
				'type' 		  => 'textfield',
				'heading' 	  => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
				'value' 	  => ''
			),
			array(
				'type' 		  => 'css_editor',
				'heading' 	  => __( 'CSS box', 'js_composer' ),
				'param_name'  => 'css',
				'group' 	  => __( 'Design options', 'js_composer' )
			)
		) //end params
	)
);



class WPBakeryShortCode_vc_ugm_map extends WPBakeryShortCodesContainer{

	protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'map_height'                    => '300px',
            'center_map'                    => 'no',
            'type_chortcode'                => 'single_markers',
            'color_route_line'              => '#4286f4',
            'activate_geo'                  => 'off',
            'search_input'                  => '-34.397, 150.644',
            'zoom_map'                      => '1',
            'zoom_control'                  => false,
            'zoom_control_position'         => 'RIGHT_BOTTOM',
            'zoom_control_style'            => 'default',
            'is_dragable_map'               => false,
            'is_scroll_wheel'               => false,
            'is_pan_controls'               => false,
            'pan_control_position'          => 'top_left',
            'is_scale_control'              => false,
            'is_street_view'                => false,
            'is_enable_street_view_btn'     => false,
            'street_view_control_position'  => 'RIGHT_BOTTOM',
            'is_map_type_control'           => false,
            'map_type_control_position'     => 'BOTTOM_RIGHT',
            'map_type'                      => 'SATELLITE',
            'is_3d_mode'                    => false,
            'map_type_control_style'        => 'DEFAULT',
            'is_reload_on_resize'           => false,
            'language'                      => 'en',
            'is_enable_destination_info'           => false,
            'json_style'                    => '',
			'el_class'                      => '',
			'css' 	                        => '',
		), $atts ) );

        $api_key = get_option( 'ugm_google_api_key' );

        $is_search  = $center_map == 'address' ? true : false;
        $center_map = $center_map == 'address' ? 'no' : $center_map;

        // Include Google map API
        wp_enqueue_script( 'vc-ugm-maps', '//maps.googleapis.com/maps/api/js?v=3.25&key=' . $api_key . '&language=' . $language, array( 'jquery' ), false, true );

        wp_enqueue_script( 'vc-ugm-map-js', UGM_PLUGIN_DIR_URL . 'public/js/gm_addons_script.js', array( 'jquery' ), false, true );

        $class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );

        // Our Maps
        global $array_map;

        // item markers
        global $vc_gm_map_items;
        $vc_gm_map_items = array();

        do_shortcode( $content );

        // Map locations
        $map_data = array();

        // Map marker
        if( ! empty( $vc_gm_map_items ) && count( $vc_gm_map_items ) > 0 ) {

            $map_data = array();
            $i = 0;

            foreach ( $vc_gm_map_items as $item ) {
                $value = (object) $item['atts'];
                $map_data[] = array(
                    'marker_id'                 => $i,
                    'marker_address'            => $value->marker_address,
                    'direction_link'            => $value->direction_link,
                    'text' 		                => $value->content,
                    'icon_animation'            => $value->icon_animation,
                    'default_open_in_window'    => $value->default_open_info_window,
                    'marker' 	                => ( empty( $value->marker_icon) ) ? '' : wp_get_attachment_url( $value->marker_icon )
                );

                $marker_address[] = $value->marker_address;

                $i++;
            }
        }

        // Geolocation
        if ( $activate_geo == 'ip_location' ){

            if ( ! empty( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
                $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            $json_geo_ip_info = wp_remote_get( 'http://freegeoip.net/json/' . $ip );
            $get_ip_info      = json_decode( $json_geo_ip_info['body'] );
            $ip_coords['lat'] = $get_ip_info->latitude;
            $ip_coords['lng'] = $get_ip_info->longitude;
        } else {
            $ip_coords = null;
        }

        // Map height
        $map_height = is_numeric( $map_height ) ? $map_height . 'px' : $map_height;

        $array_map[] = array(
            'center_map'                    => $center_map,
            'type_chortcode'                => $type_chortcode,
            'color_route_line'              => $color_route_line,
            'activate_geo'                  => $activate_geo,
            'ip_coords'                     => $ip_coords,
            'is_search'                     => $is_search,
            'searsh_line'                   => $search_input,
            'api_key'                       => $api_key,
            'zoom_map'                      => $zoom_map,
            'zoom_control'                  => $zoom_control,
            'zoom_control_position'         => $zoom_control_position,
            'zoom_control_style'            => $zoom_control_style,
            'is_dragable_map'               => $is_dragable_map,
            'is_scroll_wheel'               => $is_scroll_wheel,
            'is_pan_controls'               => $is_pan_controls,
            'pan_control_position'          => $pan_control_position,
            'is_scale_control'              => $is_scale_control,
            'is_street_view'                => $is_street_view,
            'street_view_control_position'  => $street_view_control_position,
            'is_map_type_control'           => $is_map_type_control,
            'map_type_control_position'     => $map_type_control_position,
            'map_type'                      => $map_type,
            'is_3d_mode'                    => $is_3d_mode,
            'is_enable_street_view_btn'     => $is_enable_street_view_btn,
            'map_type_control_style'        => $map_type_control_style,
            'is_reload_on_resize'           => $is_reload_on_resize,
            'language'                      => $language,
            'json_style'                    => rawurldecode( base64_decode( strip_tags( $json_style ) ) ),
            'markers'                       => $map_data
        );

        wp_localize_script( 'vc-ugm-map-js', 'vc_gm_map', $array_map );

        $output  = '<div class="ugm-map-wrapper ' . $class . '">';
        $output .= '<div class="vc_ugm_item" data-id-map="' . count( $array_map ) . '" style="height: ' . $map_height . '"></div>';

        if ( true == boolval( $is_enable_destination_info ) ){

            $time_value = 0;
            $marker_address_str = '';

            if ( count( $marker_address ) > 1 ) {
                foreach ( $marker_address as $key => $item_address ) {
                    if ( 0 == $key ){
                        $origin = $item_address;
                        continue;
                    }
                    if ( count( $marker_address ) == ( $key + 1) ) {
                        $destination = $item_address;
                        continue;
                    }
                    $waipoints[] = $item_address;
                }

                $waipoints = !empty( $waipoints ) ? '&waypoints=' . implode( '|', $waipoints ) : '';

                $query = 'https://maps.googleapis.com/maps/api/directions/json?origin=' . $origin . '&destination=' . $destination . $waipoints . '&key=AIzaSyCEI9VwHcWu3ZBk_3yixYD0PfzhqiHGGn0';

                $gm_response = wp_remote_get( $query );

                if ( ! is_wp_error( $gm_response ) || wp_remote_retrieve_response_code( $gm_response ) === 200 ){
                    $gm_directions = json_decode( $gm_response['body'] );
                    foreach ( $gm_directions->routes as $route ) {
                        foreach ( $route->legs as $legs ){
                            $time_value += $legs->duration->value;
                        }
                    }
                }
                $marker_address_str = implode( ' | ', $marker_address );
            }

            $output .= '<div class="vc_ugm_distance_summary">
                            <p id="vc_ugm_distance_summary-route">Distance along the route: <span>' . $marker_address_str . '</span></p>
                            <p id="vc_ugm_distance_summary-time">Approximate travel time: <span>' . date( 'H\h, i\m, s\s', mktime( 0, 0, $time_value ) ) . '</span></p>
                        </div>';
        }

		$output .= '</div>';

		return $output;
	}
}

