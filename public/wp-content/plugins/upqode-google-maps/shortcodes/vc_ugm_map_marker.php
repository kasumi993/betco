<?php
vc_map(
    array(
        'name'              => 'Marker Item',
        'base'              => 'vc_ugm_map_marker',
        'as_child' 		    => array( 'only' => 'vc_ugm_map' ),
        'icon'              => 'gm-addon-shortcode-icon-item',
        'admin_enqueue_css' => UGM_PLUGIN_DIR_URL . 'admin/css/ugm-addon-admin-style.css',
        'admin_enqueue_js'        => array(
            'https://maps.googleapis.com/maps/api/js?key=' . get_option( 'ugm_google_api_key' ) . '&signed_in=true&libraries=places',
            UGM_PLUGIN_DIR_URL . 'admin/js/gm_addons_admin.js',
        ),
        'content_element'   => true,
        'params'            => array(
            //Address
            array(
                'heading'     => __( 'Address', 'js_composer' ),
                'type'        => 'textfield',
                'description' => __( 'Add location address' ),
                'param_name'  => 'address',
            ),

            //Text for Directions Link
            array(
                'heading'     => __( 'Marker Hover Text', 'js_composer' ),
                'type'        => 'textfield',
                'param_name'  => 'direction_link',
            ),

            //Marker Icon
            array(
                'heading'     => __( 'Marker Icon', 'js_composer' ),
                'type' 		  => 'attach_image',
                'description' => __( 'Upload marker pin icon' ),
                'param_name'  => 'marker_icon'
            ),

            //Icon Animation
            array(
                'heading' 	  => __( 'Icon Animation', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'icon_animation',
                'description' => 'Select marker animation',
                'value' 	  => array(
                    __( 'None',   'js_composer' ) => 'none',
                    __( 'BOUNCE', 'js_composer' ) => 'BOUNCE',
                    __( 'DROP',   'js_composer' ) => 'DROP'
                )
            ),

            //Marker Content
            array(
                'heading'     => __( 'Marker Content', 'js_composer' ),
                'type'        => 'textarea_html',
                'description' => __( 'Marker Content' ),
                'param_name'  => 'content',
            ),

            //Default Open Info Window
            array(
                'heading' 	  => __( 'Show marker content on page load', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'default_open_info_window',
                'description' => 'If yes, marker info window will be opened by default',
                'value' 	  => array(
                    __( 'No', 'js_composer' )  => 'no',
                    __( 'Yes', 'js_composer' ) => 'yes'
                )
            )
        )
    )
);


class WPBakeryShortCode_vc_ugm_map_marker extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'address'           => '',
            'direction_link'    => '',
            'marker_icon' 	    => '',
            'icon_animation'    => 'none',
            'default_open_info_window' => 'no',
        ), $atts ) );

        $item_settings = array(
            'marker_address'            => $address,
            'direction_link'            => $direction_link,
            'marker_icon' 	            => $marker_icon,
            'icon_animation'    	    => $icon_animation,
            'default_open_info_window'  => $default_open_info_window,
            'content'                   => $content,
        );

        global $vc_gm_map_items;
        $vc_gm_map_items[] = array( 'atts' => $item_settings );

        return;
    }
}