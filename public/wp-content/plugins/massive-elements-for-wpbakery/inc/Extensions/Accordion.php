<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Extensions {

	use Inc\Base\ExtensionsController;

	class Accordion extends ExtensionsController {

		public function extensions_register() {
			if ( ! $this->activated( 'accordion' ) ) {
				return;
			}
			$this->accordion();
			add_shortcode( 'pr_accordion_item', array( $this, 'pr_accordion_item_callback' ) );
			add_shortcode( 'pr_accordion', array( $this, 'pr_accordion_callback' ) );
		}

		public function accordion() {
			if ( function_exists( "vc_map" ) ) {
				// Before SETTING
				vc_map( array(
					"name"                    => __( "Accordion", "weavc" ),
					"base"                    => "pr_accordion",
					"as_parent"               => array( 'only' => 'pr_accordion_item' ),
					"content_element"         => true,
					"show_settings_on_create" => true,
					"category"                => 'Massive Elements',
					"icon"                    => "mew_accordion",
					"class"                   => "pr_accordion",
					"description"             => __( "Display Accordion Content With this", "weavc" ),
					"params"                  => array(

						array(
							"type"             => "mew_param_heading",
							"text"             => __( "Accordion Heading Typhography", "mewvc" ),
							"param_name"       => "accordion_heading_wrapper_typhography",
							//"dependency" => Array("element" => "main_heading", "not_empty" => true),
							"class"            => "mew_param_heading",
							'edit_field_class' => 'mew-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
						),

						// Heading Font Color
						array(
							"type"             => "colorpicker",
							"heading"          => __( "Heading Font Color", "my-text-domain" ),
							"param_name"       => "heading_color",
							"value"            => '#434955',
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),
						// Heading Font Hover Color
						array(
							"type"             => "colorpicker",
							"heading"          => __( "Heading Font Hover Color", "my-text-domain" ),
							"param_name"       => "heading_hover_color",
							"value"            => '',
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),
						// Heading BG Color
						array(
							"type"             => "colorpicker",
							"heading"          => __( "Background Color", "my-text-domain" ),
							"param_name"       => "heading_bg_color",
							"value"            => '',
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),
						// Heading BG Hover & Active Color
						array(
							"type"             => "colorpicker",
							"heading"          => __( "Background Hover & Active Color", "my-text-domain" ),
							"param_name"       => "heading_bg_hover_color",
							"value"            => '',
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),
						// Heading Font Family
						array(
							"type"        => "dropdown",
							"heading"     => __( "Heading Font Family", "asvc" ),
							"param_name"  => "heading_fonts",
							"value"       => $this->mew_google_font(),
							"std"         => 'Roboto Condensed',
							"description" => __( "Accordion Heading Font Family Hare, 800+ Google Fonts Available", "mewvc" ),
						),
						// Heading Font Size
						array(
							"type"             => "number",
							"heading"          => __( "Heading font Size", "mewvc" ),
							"param_name"       => "heading_font_size",
							"value"            => "18",
							"suffix"           => "px",
							"description"      => __( "Icon Size, Default is 18px", "mewvc" ),
							'edit_field_class' => 'vc_column vc_col-sm-4',
						),
						// Heading Icon Size
						array(
							"type"             => "number",
							"heading"          => __( "Icon Size", "mewvc" ),
							"param_name"       => "icon_size",
							"value"            => "18",
							"suffix"           => "px",
							"description"      => __( "Icon Size, Default is 18px", "mewvc" ),
							'edit_field_class' => 'vc_column vc_col-sm-4',
						),

						// Arrow Size
						array(
							"type"             => "number",
							"heading"          => __( "Arrow Size", "mewvc" ),
							"param_name"       => "arrow_size",
							"value"            => "18",
							"suffix"           => "px",
							"description"      => __( "Arrow Size, Default is 18px", "mewvc" ),
							'edit_field_class' => 'vc_column vc_col-sm-4',
						),
						array(
							"type"        => "mew_padding",
							"heading"     => "Heading Padding",
							"param_name"  => "heading_padding",
							"positions"   => array(
								__( "Top", "mewvc" )    => "top",
								__( "Bottom", "mewvc" ) => "bottom",
							),
							"description" => __( "Accordion Heading Padding Here, Leave it black if you don't need any Padding, Default Padding is Top 16px, Bottom 16px.", "mewvc" ),
						),

						array(
							"type"             => "mew_param_heading",
							"text"             => __( "Accordion Content Typhography", "mewvc" ),
							"param_name"       => "accordion_content_wrapper_typhography",
							//"dependency" => Array("element" => "main_heading", "not_empty" => true),
							"class"            => "mew_param_heading",
							'edit_field_class' => 'mew-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
						),
						array(
							"type"        => "dropdown",
							"heading"     => __( "Content Font Family", "asvc" ),
							"param_name"  => "content_fonts",
							"value"       => $this->mew_google_font(),
							"std"         => 'Roboto Condensed',
							"description" => __( "Accordion Heading Font Family Hare, 800+ Google Fonts Available", "mewvc" ),
						),
						array(
							"type"             => "colorpicker",
							"heading"          => __( "Content Color", "my-text-domain" ),
							"param_name"       => "descr_color",
							"value"            => '',
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),
						array(
							"type"             => "colorpicker",
							"heading"          => __( "Content Background Color", "my-text-domain" ),
							"param_name"       => "descr_bg_color",
							"value"            => '',
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),

						array(
							"type"        => "mew_padding",
							"heading"     => "Content Padding",
							"param_name"  => "content_padding",
							"positions"   => array(
								__( "Top", "mewvc" )    => "top",
								__( "Bottom", "mewvc" ) => "bottom",
								__( "Left", "mewvc" )   => "left",
								__( "Right", "mewvc" )  => "right",
							),
							"description" => __( "Content Padding Here, Default is top, bottom, left, right is 12px. Leave it black if you like Default Padding", "mewvc" ),
						),
						array(
							"type"             => "mew_param_heading",
							"text"             => __( "Accordion Options", "mewvc" ),
							"param_name"       => "accordion_options",
							//"dependency" => Array("element" => "main_heading", "not_empty" => true),
							"class"            => "mew_param_heading",
							'edit_field_class' => 'mew-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
						),
						array(
							"type"             => "number",
							"heading"          => __( "Accordion Duration", "mewvc" ),
							"param_name"       => "accor_duration",
							"value"            => "400",
							"suffix"           => "milliseconds",
							"description"      => __( "A number determining the time to show and to hide the content from an accordion's item, Default is 400 milliseconds", "mewvc" ),
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),
						array(
							"type"             => "number",
							"heading"          => __( "Accordion Delay", "mewvc" ),
							"param_name"       => "accor_delay",
							"value"            => "0",
							"suffix"           => "milliseconds",
							"description"      => __( "A number determining the delay before to show a content or hide a content from an accordion item, Default is 0 milliseconds", "mewvc" ),
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),
						array(
							"type"        => "mew_switch",
							"class"       => "",
							"param_name"  => "exclusive_active",
							"value"       => "off",
							"default_set" => true,
							"options"     => array(
								"on" => array(
									"label" => __( "Accordion item open at the same time?", "mewvc" ),
									"on"    => __( "Yes", "mewvc" ),
									"off"   => __( "No", "mewvc" ),
								),
							),
							"description" => __( "Enable Responsive Mod or not", 'mewvc' ),
						),
						array(
							"type"        => "textfield",
							"heading"     => __( "Extra Class for Main Wrapper", 'weavc' ),
							"param_name"  => "ex_class",
							"admin_label" => true,
							"description" => __( "If you want to set Css Class for Main Rapper you can put Class here Then Click Save Changes, Otherwise leave it blank then click Close", 'ultimate' ),
							"value"       => "accordion_wrapper",
						),

					),
					"js_view"                 => 'VcColumnView',
				) );

				// AFTER SETTING
				vc_map( array(
					"name"            => __( "Accordion Item", "weavc" ),
					"base"            => "pr_accordion_item",
					"content_element" => true,
					"icon"            => "mew_accordion_item",
					"as_child"        => array( 'only' => 'pr_accordion' ),
					"is_container"    => false,
					"params"          => array(
						array(
							"type"        => "mew_switch",
							"class"       => "",
							//"heading" => __("Want To show button in responsive mode", "mewvc"),
							"param_name"  => "show_accordion_icon",
							// "admin_label" => true,
							"value"       => "off",
							"default_set" => true,
							"options"     => array(
								"on" => array(
									"label" => __( "Show Accordion Icon?", "mewvc" ),
									"on"    => __( "Yes", "mewvc" ),
									"off"   => __( "No", "mewvc" ),
								),
							),
							"description" => __( "Active this if you like add icon in accordion heading, Default Inactive", 'mewvc' ),
						),

						array(
							'type'        => 'iconpicker',
							'heading'     => __( 'Icon', 'js_composer' ),
							'param_name'  => 'accordion_icon',
							'value'       => 'fa fa-facebook', // default value to backend editor admin_label
							'settings'    => array(
								'emptyIcon'    => false,
								'iconsPerPage' => 4000,
							),
							'description' => __( 'Select icon from library.', 'mewvc' ),
							"dependency"  => array(
								'element' => 'show_accordion_icon',
								'value'   => 'on',
							),
						),

						array(
							"type"        => "textfield",
							"heading"     => __( "Accordion Heading", "my-text-domain" ),
							"param_name"  => "ac_title",
							"admin_label" => true,
							"value"       => "I am text block.",
							"description" => __( "Accordion Heading Here. Change this text as your choice", 'mewvc' ),
						),
						array(
							'type'        => 'textarea_html',
							'heading'     => __( 'Accordion Content', 'js_composer' ),
							'param_name'  => 'content',
							'value'       => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'js_composer' ),
							"description" => __( "Accordion Content Here. Change this text as your choice", 'mewvc' ),
						),

						array(
							"type"        => "mew_switch",
							"class"       => "",
							//"heading" => __("Want To show button in responsive mode", "mewvc"),
							"param_name"  => "accordion_active",
							// "admin_label" => true,
							"value"       => "on",
							"default_set" => true,
							"options"     => array(
								"on" => array(
									"label" => __( "Active Accordion Item?", "mewvc" ),
									"on"    => __( "Yes", "mewvc" ),
									"off"   => __( "No", "mewvc" ),
								),
							),
							"description" => __( "Actite this if you want to open it when page load for first time, Default On.", 'mewvc' ),
						),
					),
				) );
			}
		}

		// Container Shortcode START
		public function pr_accordion_callback( $atts, $content = null ) {
			$output = $ex_class = '';
			extract( shortcode_atts( array(
				'ex_class'               => 'accordion_wrapper',
				'accor_duration'         => '400',
				'accor_delay'            => '0',
				'exclusive_active'       => 'off',
				'heading_color'          => '#434955',
				'heading_hover_color'    => '',
				'heading_bg_color'       => '',
				'heading_bg_hover_color' => '',
				'descr_color'            => '',
				'descr_bg_color'         => '',
				'heading_font_size'      => '',
				'icon_size'              => '',
				'arrow_size'             => '18',
				'heading_fonts'          => '',
				'content_fonts'          => '',
				'heading_padding'        => '',
				'content_padding'        => '',
			), $atts ) );
			// Accordion Unique ID:

			$exclusive_active = ( $exclusive_active == 'off' ) ? 'true' : 'false';

			/*ACCORDION HEADING FONTS*/
			if ( ! empty ( $heading_fonts ) ) {
				$heading_fonts = str_replace( " ", "+", $heading_fonts );
				echo '<style type="text/css">
						@import url("https://fonts.googleapis.com/css?family=' . $heading_fonts . '");
					 </style>';
				$heading_fonts = str_replace( "+", " ", $heading_fonts );
			}

			/*ACCORDION CONTENT FONTS*/
			if ( ! empty ( $content_fonts ) ) {
				$content_fonts = str_replace( " ", "+", $content_fonts );
				echo '<style type="text/css">
						@import url("https://fonts.googleapis.com/css?family=' . $content_fonts . '");
					 </style>';
				$content_fonts = str_replace( "+", " ", $content_fonts );
			}

			$accordionID = uniqid(); // Accordion Unique ID
			$output      .= '<div id="acc' . $accordionID . '" class="accordion ' . $ex_class . '">';
			$output      .= do_shortcode( $content );
			$output      .= '</div>';

			$output .= '<style type="text/css">
#acc' . $accordionID . ' .accordion-header,#acc' . $accordionID . ' .accordion-header i,#acc' . $accordionID . ' .accordion-item-arrow:before{color:' . $heading_color . '}#acc' . $accordionID . ' #accicon{font-size:' . $icon_size . 'px}#acc' . $accordionID . ' .accordion-item-arrow:before{font-size:' . $arrow_size . 'px}#acc' . $accordionID . ' .accordion-header:hover,#acc' . $accordionID . ' .accordion-header:hover #accicon,#acc' . $accordionID . ' .accordion-header:hover .accordion-item-arrow:before{color:' . $heading_hover_color . '}#acc' . $accordionID . ' .accordion-item .accordion-header{background-color:' . $heading_bg_color . ';font-size:' . $heading_font_size . 'px;font-family:' . $heading_fonts . '}#acc' . $accordionID . ' .accordion-header:hover,#acc' . $accordionID . ' .accordion-item.active .accordion-header{background-color:' . $heading_bg_hover_color . '}#acc' . $accordionID . ' .accordion-content{color:' . $descr_color . ';background-color:' . $descr_bg_color . '}
						</style>';

			$output .= '<script type="text/javascript">
						   jQuery(document).ready(function(){  
						      jQuery("#acc' . $accordionID . '").accordion({
						      duration: ' . $accor_duration . ',
						      delay: ' . $accor_delay . ',
						      exclusive: ' . $exclusive_active . ',
						      });
						   });
			</script>';

			return $output;
		}

		// Items Shortcode START
		public function pr_accordion_item_callback( $atts, $content = null ) {
			$ac_title = $acoptions = $accordion_active = $link = $button_choser = $bg_color = $title_size = $title_color = $desc_size = $desc_color = $button_size = $button_color = $showing_item = $act_accordion = $output = '';

			extract( shortcode_atts( array(
				'ac_title'            => 'Title Goes Here',
				'act_accordion'       => '',
				'acc_descr'           => '',
				'accordion_active'    => '',
				'show_accordion_icon' => '',
				'accordion_icon'      => 'fa fa-facebook',
			), $atts ) );

			$content = wpb_js_remove_wpautop( $content );

			// Activate Accordion Item First
			$accordion_active = ( $accordion_active != 'off' ) ? 'active' : ''; // Which Item Activate

			// Remove Extra P Space in Content
			$content = str_replace( "<p>&nbsp;</p>", " ", $content );

			$output .= '<div class="accordion-item ' . $accordion_active . '">
					<div class="accordion-header">';

			if ( $show_accordion_icon == 'on' ) {
				$output .= ' <i id="accicon" class="' . $accordion_icon . '"></i>';
			}
			$output .= ' ' . $ac_title . ' ';
			$output .= '	<span class="accordion-item-arrow"></span>
					</div>
					<div class="accordion-content">
						' . $content . '
					</div>';
			$output .= '</div>';

			return $output;

		}
	}

}
namespace {

	// Finally initialize code For Accordion
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_pr_accordion extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_pr_accordion_item extends WPBakeryShortCode {
		}
	}
}