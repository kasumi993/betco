<?php
/**
 * @package  MEWVC
 */
namespace Inc\Extensions;

use Inc\Base\ExtensionsController;

class PrimeModal extends ExtensionsController {
	public function extensions_register() {
		if ( ! $this->activated( 'advanced_modal' ) ) {
			return;
		}
		add_shortcode( 'mew_advanced_modal', array( $this, 'mewvc_advanced_modal_func' ) );

		$this->primemodal();
	}

	public function primemodal() {
		vc_map( array(
			"name"        => __( "Advanced Modal", 'mewvc' ),
			"base"        => "mew_advanced_modal",
			"class"       => "prime_cq_vc_extension_depthmodal",
			"controls"    => "full",
			"icon"        => "mew_prime_modal",
			"category"    => __( 'Massive Elements', 'js_composer' ),
			'description' => __( 'Popup modal', 'js_composer' ),
			"params"      => array(

				array(
					"type"        => "textfield",
					"class"       => "", //
					"heading"     => __( "label", 'mewvc' ),
					"param_name"  => "buttontext",
					"value"       => __( "View More", 'mewvc' ),
					"description" => __( "The link user click to open the modal, support HTML and other shortcode.", 'mewvc' ),
				),

				array(
					"type"        => "textarea_html",
					"class"       => "",
					"heading"     => __( "Popup content", 'mewvc' ),
					"param_name"  => "content",
					"value"       => __( "<p>I am test text block. Click edit button to change this text.</p>", 'mewvc' ),
					"description" => __( "", 'mewvc' ),
				),

				array(
					'type'        => 'prime_slider',
					'heading'     => __( 'Popup Box width', 'prime' ),
					'param_name'  => 'popupbox_width',
					"value"       => 640,
					"min"         => 200,
					"max"         => 2000,
					"step"        => 1,
					"unit"        => "px",
					"description" => __( "Chose Title Font Size as Pixel. Default is 18px", "prime" ),
					"group"       => "Settings",
				),

				array(
					"type"        => "number",
					"heading"     => __( "Popup Margin Top", "mewvc" ),
					"param_name"  => "popup_margin",
					"value"       => "40",
					"suffix"      => "px",
					"description" => __( "Modal Pop up Margin Top Here, Default is 40px", "mewvc" ),
					"group"       => "Settings",
				),

				array(
					"type"        => "dropdown",
					"class"       => "mewvc",
					"group"       => 'Settings',
					"heading"     => __( "Display the Popup in:", "mewvc" ),
					"param_name"  => "popupposition",
					"value"       => array( "fixed" => "fixed", "absolute (work better for long contnet)" => "absolute" ),
					"description" => __( "CSS position value for the Popup.", "mewvc" ),
				),
				array(
					"type"        => "checkbox",
					"class"       => "mewvc",
					"group"       => 'Settings',
					"heading"     => __( "Do not hide the popup content when page is loaded", 'mewvc' ),
					"param_name"  => "loadedvisible",
					"value"       => array( __( "Yes, set the popup content visible by default", "mewvc" ) => 'on' ),
					"description" => __( "Sometime you have to display the popup content when page is loaded, for example my hotspot plugin need it's container to be visible when loaded.", 'mewvc' ),
				),
				array(
					"type" => "mew_param_heading",
					"text" => __("Label Typhography","mewvc"),
					"param_name" => "amb_label_typhography_style",
					//"dependency" => Array("element" => "main_heading", "not_empty" => true),
					"class" => "mew_param_heading",
					"group"       => "Typography",
					'edit_field_class' => 'mew-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
				),

				// Member Information Group Switch Param Here
				array(
					"type"        => "mew_switch",
					"heading"     => __( "Use Button on Label?", "mewvc" ),
					"param_name"  => "show_amb_button",
					"value"       => "off",
					"options"     => array(
						"on" => array(
							"label" => __( "", "mewvc" ),
							"on"    => "Yes",
							"off"   => "No",
						),
					),
					"group"       => 'Typography',
					"description" => "Switch Yes If you want to Add Counter Icon",
				),
				// Label Font Family
				array(
					"type"        => "dropdown",
					"heading"     => __( "Label Font Family", "mewvc" ),
					"param_name"  => "label_fonts",
					"value"       => $this->mew_google_font(),
					"std"         => 'Roboto Condensed',
					"group"       => "Typography",
					"description" => __( "Modal Label Font Family Hare, 800+ Google Fonts Available", "mewvc" ),
				),
				// Heading Font Size
				array(
					"type"             => "number",
					"heading"          => __( "Label font Size", "mewvc" ),
					"param_name"       => "label_font_size",
					"value"            => "18",
					"suffix"           => "px",
					"group"       => "Typography",
					'edit_field_class' => 'vc_column vc_col-sm-4',
					"description"      => __( "Label Font Size, Default is 18px", "mewvc" ),
				),


				array(
					"type"        => "colorpicker",
					"class"       => "",
					"heading"     => __( "Label color", 'mewvc' ),
					"param_name"  => "labelcolor",
					"value"       => '#333',
					"group"       => 'Typography',
					'edit_field_class' => 'vc_column vc_col-sm-4',
					"description" => __( "", 'mewvc' ),
				),

				array(
					"type"        => "colorpicker",
					"class"       => "",
					"heading"     => __( "Label Background color", 'mewvc' ),
					"param_name"  => "labelbgcolor",
					"group"       => 'Typography',
					"dependency" => Array(
						"element" => "show_amb_button",
						"value" => 'on'
					),
					'edit_field_class' => 'vc_column vc_col-sm-4',
					"description" => __( "", 'mewvc' ),
				),

				// Select Team Member Style
				array(
					"type"        => "dropdown",
					"heading"     => __( "Select Border Type" ),
					"param_name"  => "label_border",
					"admin_label" => true,
					"group"       => "Typography",
					"dependency" => Array(
						"element" => "show_amb_button",
						"value" => 'on'
					),
					"value"       => array(
						'None' => 'none',
						'Solid' => 'solid',
						'Dotted' => 'dotted',
						'Dashed' => 'dashed',
						'Double' => 'double',
						'Groove' => 'groove',
						'Ridge' => 'ridge',
						'Inset' => 'inset',
						'Outset' => 'outset',
					),
					'edit_field_class' => 'vc_column vc_col-sm-4',
					"description" => __( "Select Border Type", "prime_vc" ),
				),

				// Heading Font Size
				array(
					"type"             => "number",
					"heading"          => __( "Border Pixel", "mewvc" ),
					"param_name"       => "border_pixel",
					//"value"            => "1",
					"suffix"           => "px",
					"dependency" => Array(
						"element" => "label_border",
						"value" => array(
							'double',
							'solid',
							'inset',
							'outset',
							'groove',
							'ridge',
							'dashed',
							'ridge',
							'dotted',

						)
					),
					"group"       => "Typography",
					'edit_field_class' => 'vc_column vc_col-sm-4',
					"description"      => __( "Border Pixed Here, Default is 1px", "mewvc" ),
				),
				array(
					"type"        => "colorpicker",
					"class"       => "",
					"heading"     => __( "Border color", 'mewvc' ),
					"param_name"  => "labelbordercolor",
					"group"       => 'Typography',
					"dependency" => Array(
						"element" => "label_border",
						"value" => array(
							'double',
							'solid',
							'inset',
							'outset',
							'groove',
							'ridge',
							'dashed',
							'ridge',
							'dotted',

						)
					),
					'edit_field_class' => 'vc_column vc_col-sm-4',
					"description" => __( "Choose Border Color", 'mewvc' ),
				),


				array(
					'type'        => 'prime_slider',
					'heading'     => __( 'Border Radius', 'mewvc' ),
					'param_name'  => 'label_border_radius',
					//"value"       => 5,
					"min"         => 0,
					"max"         => 50,
					"step"        => 1,
					"unit"        => "px",
					"description" => __( "Chose Border Radius as Pixel. Default is 18px", "mewvc" ),
					"dependency" => Array(
						"element" => "label_border",
						"value" => array(
							'double',
							'solid',
							'inset',
							'outset',
							'groove',
							'ridge',
							'dashed',
							'ridge',
							'dotted',

						)
					),
					"group"       => "Typography",
				),

				array(
					"type" => "mew_param_heading",
					"text" => __("Pop Up Box Typhography","mewvc"),
					"param_name" => "amb_popup_typhography_style",
					"class" => "mew_param_heading",
					"group"       => "Typography",
					'edit_field_class' => 'mew-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
				),
				// POP up Box Font Family
				array(
					"type"        => "dropdown",
					"heading"     => __( "Pop Up box Font Family", "mewvc" ),
					"param_name"  => "pop_up_box_fonts",
					"value"       => $this->mew_google_font(),
					"std"         => 'Roboto Condensed',
					"group"       => "Typography",
					"description" => __( "Pop up Box Font Family Hare, 800+ Google Fonts Available", "mewvc" ),
				),
				// Pop up Box Font Size
				array(
					"type"             => "number",
					"heading"          => __( "Pop Up font Size", "mewvc" ),
					"param_name"       => "popup_font_size",
					"value"            => "18",
					"suffix"           => "px",
					"group"       => "Typography",
					'edit_field_class' => 'vc_column vc_col-sm-4',
					"description"      => __( "Pop Up Font Size, Default is 18px", "mewvc" ),
				),
				array(
					"type"        => "colorpicker",
					"class"       => "",
					"heading"     => __( "Popup text color", 'mewvc' ),
					"param_name"  => "textcolor",
					"value"       => '#333',
					"group"       => 'Typography',
					'edit_field_class' => 'vc_column vc_col-sm-4',
					"description" => __( "Pop up Box Text Color", 'mewvc' ),
				),
				array(
					"type"        => "colorpicker",
					"class"       => "",
					"heading"     => __( "Popup background", 'mewvc' ),
					"param_name"  => "databackground",
					"value"       => '#fff',
					"group"       => 'Typography',
					'edit_field_class' => 'vc_column vc_col-sm-4',
					"description" => __( "Pop up Box Background Color", 'mewvc' ),
				),
			),
		) );
	}


	function mewvc_advanced_modal_func( $atts, $content = null, $tag ) {
		extract( shortcode_atts( array(
			'buttontext'    => 'View More',
			'popupbox_width'         => '640',
			'textcolor'     => '#333',
			'databackground'    => '#fff',
			'popup_margin'  => '40',
			'padding'       => '0',
			'popupposition' => 'fixed',
			'loadedvisible' => 'off',
			'labelcolor' => '#333',
			'show_amb_button' => 'off',
			'label_fonts' => 'off',
			'label_font_size' => '18',
			'labelbgcolor' => '',
			'pop_up_box_fonts' => '',
			'popup_font_size' => '',
			'label_border_radius' => '',
			'border_pixel' => '',
			'label_border' => '',
			'labelbordercolor' => '',

		), $atts ) );

		/* LABEL FONTS*/
		if ( ! empty ( $label_fonts ) ) {
			$label_fonts = str_replace( " ", "+", $label_fonts );
			echo '<style type="text/css">
						@import url("https://fonts.googleapis.com/css?family=' . $label_fonts . '");
					 </style>';
			$label_fonts = str_replace( "+", " ", $label_fonts );
		}

		/* POP UP BOX FONTS*/
		if ( ! empty ( $pop_up_box_fonts ) ) {
			$pop_up_box_fonts = str_replace( " ", "+", $pop_up_box_fonts );
			echo '<style type="text/css">
						@import url("https://fonts.googleapis.com/css?family=' . $pop_up_box_fonts . '");
					 </style>';
			$pop_up_box_fonts = str_replace( "+", " ", $pop_up_box_fonts );
		}

		$showbutton = $show_amb_button == 'on' ? 'ambuttonshow' : '';

		$path = plugin_dir_url( dirname( __FILE__, 2 ) );

		$content = wpb_js_remove_wpautop( $content ); // fix unclosed/unwanted paragraph tags in $content

		$output = '<div class="mewvc-container" data-width="'.$popupbox_width.'" data-textcolor="'.$textcolor.'" data-background="'.$databackground.'" data-loadedvisible="'.$loadedvisible.'" data-margintop="'.$popup_margin.'" data-popupposition="'.$popupposition.'">';

		// PopBox Content Unique ID
		$cnt = uniqid();

		$output .= '<div class="mewvc-popup">
              <div class="mewvc-content popbox'.$cnt.'">'.$content.'</div>
              <a href="#" class="mewvc-close"><img width="24" height="24" src="' . $path .'assets/img/close.png"  alt="close" /></a>';

		// Button Unique ID
		$amb = uniqid();
		$output .= '</div><div class="mewvc-cover"></div><a href="#" id="amb'.$amb.'" class="mewvc-btn '.$showbutton.'">' . do_shortcode( $buttontext ) . '</a></div>';

		$output .= '<style>
			#amb'.$amb.' {
				color: '.$labelcolor.';
				font-family: '.$label_fonts.';
				font-size: '.$label_font_size.'px;
				background-color: '.$labelbgcolor.';
				border: '.$border_pixel.'px '.$label_border.' '.$labelbordercolor.';
				border-radius: '.$label_border_radius.'px;
			}
			
			.popbox'.$cnt.' {
				font-family: '.$pop_up_box_fonts.';
				font-size: '.$popup_font_size.'px;
				background-color: '.$databackground.';
			}
		
		</style>';

		return $output;
	}
}