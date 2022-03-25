<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Extensions;


use Inc\Base\ExtensionsController;

class ZoomMagnifier extends ExtensionsController {
	public function extensions_register() {
		if ( ! $this->activated( 'zoom_magnifier' ) ) {
			return;
		}
		add_shortcode( 'pr_imgzoom', array( $this, 'Prime_Image_Zoom_shortcode_function' ));

		$this->zoommagnifier();
	}

	public function zoommagnifier() {
		vc_map( array(
			"name"        => __( "Zoom Magnifier", 'prime_vc' ),
			"base"        => "pr_imgzoom",
			"icon"        => "mew_zoom_magnifier",
			"category"    => 'Massive Elements',
			'description' => 'Zoom Magnifyier',
			// 'admin_enqueue_css' => array(plugins_url('css/vc_extensions_cq_admin.css', __FILE__)),
			"params"      => array(

				array(
					"type"        => "attach_image",
					"heading"     => __( "Uoload Small Image", "prime_vc" ),
					"param_name"  => "small_image",
					"admin_label" => true,
					"value"       => "",
					"tooltip"     => "select Small Image For Before Zoom",
					"description" => __( "select Small Image For Before Zoom", "prime_vc" ),
					"group"    => 'General'
				),

				array(
					"type"        => "attach_image",
					"heading"     => __( "Upload Large Image", "prime_vc" ),
					"param_name"  => "large_image",
					"admin_label" => true,
					"value"       => "",
					"tooltip"     => "select Large image for Zoom Magnifier",
					"description" => __( "select Large image for Zoom Magnifier", "prime_vc" ),
					"group"    => 'General'
				),
				array(
					"type"       => "dropdown",
					"heading"    => __( "Zoom Type", "prime_vc" ),
					"param_name" => "zoom_type",
					"value"      => array(
						__( 'Window', "prime_vc" ) => "window",
						__( 'Lens', "prime_vc" )   => "lens",
						__( 'Inner', "prime_vc" )  => "inner",

					),
					"group"    => 'Settings'
				),

				/* Zoom Type Window Setting  */
				array(
					'type'             => 'prime_slider',
					'heading'          => __( "Zoom Window Width", "Prime_vc" ),
					'param_name'       => 'zoom_win_wid',
					'min'              => 50,
					'max'              => 800,
					'step'             => 10,
					'value'            => 300,
					'unit'             => 'px',
					'edit_field_class' => 'vc_column vc_col-sm-6',
					"dependency"       => array( 'element' => 'zoom_type', 'value' => array( 'window' ) ),
					"description"      => __( "select Image Width Size For Zoom Magnifier Window", "prime_vc" ),
					"group"    => 'Settings'
				),
				array(
					'type'             => 'prime_slider',
					'heading'          => __( "Zoom Window Height", "Prime_vc" ),
					'param_name'       => 'zoom_win_height',
					'min'              => 50,
					'max'              => 800,
					'step'             => 10,
					'value'            => 300,
					'unit'             => 'px',
					'edit_field_class' => 'vc_column vc_col-sm-6',
					"dependency"       => array( 'element' => 'zoom_type', 'value' => array( 'window' ) ),
					"description"      => __( "select Image Width Size For Zoom Magnifier Window", "prime_vc" ),
					"group"    => 'Settings'
				),

				array(
					'type'        => 'prime_slider',
					"heading"     => __( "Zoom Window Position", "prime_vc" ),
					"param_name"  => "win_position",
					'min'         => 1,
					'max'         => 16,
					'step'        => 1,
					'value'       => 1,
					'unit'        => 'num',
					//'edit_field_class' => 'vc_column vc_col-sm-6',
					"dependency"  => array( 'element' => 'zoom_type', 'value' => array( 'window' ) ),
					"tooltip"     => "Chose Position Of Zoom Widdow view, Default is 1, See right Image to Check Position",
					"description" => __( "Chose Position Of Zoom Widdow view, See zoom Position Here<a target ='_blank' href='http://codecans.com/images/window-positions.png'> Check Here</a>", "prime_vc" ),
					"group"    => 'Settings'
				),


				array(
					'type'             => 'prime_slider',
					'heading'          => __( "Lens Size", "Prime_vc" ),
					'param_name'       => 'lens_size',
					'min'              => 50,
					'max'              => 500,
					'step'             => 5,
					'value'            => 200,
					'unit'             => 'px',
					//	'edit_field_class' => 'vc_column vc_col-sm-6',
					"dependency"       => array( 'element' => 'zoom_type', 'value' => array( 'lens' ) ),
					"description"      => __( "select Lens Width Size For Zoom Magnifier", "prime_vc" ),
					"group"    => 'Settings'
				),


				array(
					'type'        => 'custom_radio',
					'heading'     => __( 'Lens Shape', 'prime_vc' ),
					'param_name'  => 'lens_shape',
					'std'         => '',
					// default unchecked
					'value'       => array(
						__( 'Square', 'prime_vc' ) => 'square',
						__( 'Round', 'prime_vc' )  => 'round',
					),
					'description' => 'Chose Lange Share Style. It will show when Hover Mouse In image',
					"group"    => 'Settings'
				),

				array(
					'type'        => 'custom_radio',
					'heading'     => __( 'Transparent Color?', 'prime_vc' ),
					'param_name'  => 'tint_status',
					'std'         => 'false',
					// default unchecked
					'value'       => array(
						__( 'No', 'prime_vc' )  => 'false',
						__( 'Yes', 'prime_vc' ) => 'true',

					),
					"dependency"  => array( 'element' => "zoom_type", 'value' => 'window' ),
					'description' => 'Chose Lange Share Style. It will show when Hover Mouse In image',
					"group"    => 'Settings'
				),
				array(
					"type"        => "mew_switch",
					"class"       => "",
					"heading"     => __( "Scroll Zoom", "prime_vc" ),
					"param_name"  => "scr_zoom",
					"value"       => "off",
					"options"     => array(
						"on" => array(
							"label" => __( "", "prime_vc" ),
							"on"    => "Yes",
							"off"   => "No",
						),
					),
					"default_set" => true,
					"description" => "Switch Yes If you want to zoom in scroll",
					"group"    => 'Settings'
				),
				array(
					"type"        => "colorpicker",
					"heading"     => __( "Tint Color", "maria" ),
					"param_name"  => "tint_color",
					//"value"             => '#ffffff',
					"description" => __( "use Alpha/rgba color for transperant bg", "maria" ),
					"dependency"  => array( 'element' => "tint_status", 'value' => 'true' ),
					"group"    => 'Typhography'
				),
			),
		) );
	}


	function Prime_Image_Zoom_shortcode_function( $atts, $content = null, $tag ) {
		extract( shortcode_atts( array(
			'zoom_type'       => 'window',
			'small_image'     => '',
			'large_image'     => '',
			'zoom_win_wid'    => 300,
			'zoom_win_height' => 300,
			'win_position'    => 1,
			'lens_shape'      => 'square',
			'tint_status'     => '',
			'tint_color'      => '',
			'scr_zoom'        => '',
			'lens_size'        => '200',

		), $atts ) );
		$link = '';
		$icon_bg_color = '';
		$link    = vc_build_link( $link );
		$content = wpb_js_remove_wpautop( $content ); // fix unclosed/unwanted paragraph tags in $content
		//add_image_size( $small_image, 220, 180, true );
		$small_image = wp_get_attachment_image_src( $small_image, 'full' );
		$large_image = wp_get_attachment_image_src( $large_image, 'full' );
		// Scrool zoom
		if ( $scr_zoom == 'on' ) {
			$scr_zoom = 'true';
		} else {
			$scr_zoom = 'false';
		}

		// Tint status
		if ( $tint_status== 'true' ) {
			$tint_status = 'true';
		} else {
			$tint_status = 'false';
		}
		//Generate Unique ID
		$i= uniqid();
		// $output = 'This is Info box '.esc_attr($icon_fontawesome).'';
		$output = '
				<img id="zoom_magnify'.$i.'" src="' . $small_image[0] . '" data-zoom-image="' . $large_image[0] . '"/>';
		$output .= '<style type="text/css">         
					.infobox .infobox-holder .dt-zoom-animation i:after {
						box-shadow:0 0 0 4px ' . $icon_bg_color . ';
					}
			</style>';
		$output .= '<script>
						jQuery(document).ready(function($){
							$("#zoom_magnify'.$i.'").elevateZoom({
							lensSize: '.$lens_size.',
							scrollZoom : '.$scr_zoom.',
							zoomWindowWidth: ' . $zoom_win_wid . ',
							zoomWindowHeight 	: ' . $zoom_win_height . ',
							zoomWindowPosition: ' . $win_position . ',
							lensShape: "' . $lens_shape . '",
							zoomType: "' . $zoom_type . '",
							cursor: "crosshair", 
					         tint:' . $tint_status . ', 
					         tintColour:"' . $tint_color . '"
						    
						});

						   }); 
					</script>';
		return $output;
	}
}