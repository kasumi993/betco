<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Extensions;

use Inc\Base\ExtensionsController;

class ProgressBar extends ExtensionsController {

	public function extensions_register() {
		if ( ! $this->activated( 'progressbar' ) ) {
			return;
		}
		add_shortcode( 'pr_progressbar', array( $this, 'prime_progressbar_shortcode_function' ) );

		$this->progressbar();
	}

	public function progressbar() {
		vc_map( array(
			"name"        => __( "Progress Bar", 'mewvc' ),
			"base"        => "pr_progressbar",
			"icon"        => "mew_progressbar",
			"category"    => 'Massive Elements',
			'description' => 'Display Progress Bar with Animated',
			// 'admin_enqueue_css' => array(plugins_url('css/vc_extensions_cq_admin.css', __FILE__)),
			"params"      => array(

				array(
					"type"        => "textfield",
					/*"holder" => "div",*/
					"class"       => "",
					"heading"     => __( "Bar Label", 'mewvc' ),
					"param_name"  => "bar_label",
					"admin_label" => true,
					"value"       => "Label Here",
					/*"description" => __("Provide the title for the iHover.", 'ultimate')*/
				),


				// TItle Font Size Field
				array(
					'type'        => 'prime_slider',
					'heading'     => __( 'Bar percentage', 'mewvc' ),
					'param_name'  => 'bar_percentage',
					'tooltip'     => __( 'Choose Bar Parcentage, Default is 95%.', 'mewvc' ),
					'min'         => 1,
					'max'         => 100,
					'step'        => 1,
					'value'       => 95,
					'unit'        => 'px',
					"description" => __( "Chose Title Font Size as Pixel. Default is 18px", "mewvc" ),
				),

				array(
					"type"        => "dropdown",
					"heading"     => __( "Progress Bar Style" ),
					"param_name"  => "bar_style",
					"admin_label" => true,
					"value"       => array(
						'Style 1'  => 'style1',
						'Style 2'  => 'style2',
						'Style 3'  => 'style3',
						'Style 4'  => 'style4',
						'Style 5'  => 'style5',
						'Style 6'  => 'style6',
						'Style 7'  => 'style7',
						'Style 8'  => 'style8',
						'Style 9'  => 'style9',
						'Style 10' => 'style10',
					),
					'description' => 'Select Progress Bar Style here, Default is Style 1',
					"group"       => "Options",
				),

				array(
					"type"        => "dropdown",
					"heading"     => __( "Progress Bar Effects" ),
					"param_name"  => "bar_effects",
					"admin_label" => true,
					"value"       => array(
						'Normal'  => 'success',
						'Striped' => 'striped',
						'Animate' => 'striped active',
					),
					'description' => 'Select Progress Bar Effects here, Default Is Normal ',
					"group"       => "Options",
				),

				// Background Color
				array(
					"type"        => "colorpicker",
					"class"       => "",
					"heading"     => __( "Bar Background color", "mewvc" ),
					"param_name"  => "bar_bg_color",
					"value"       => '#16a085', //Default Red color
					"description" => __( "Choose text color", "mewvc" ),
					"group"       => "Typography",
				),
				array(
					"type"             => "textfield",
					/*"holder" => "div",*/
					"edit_field_class" => "vc_col-xs-6 vc_column",
					"heading"          => __( "Margin Top", 'mewvc' ),
					"param_name"       => "margin_top",
					"admin_label"      => true,
					"value"            => "20",
					"group"            => "Typography",
					/*"description" => __("Provide the title for the iHover.", 'ultimate')*/
				),
				array(
					"type"             => "textfield",
					/*"holder" => "div",*/
					"edit_field_class" => "vc_col-xs-6 vc_column",
					"heading"          => __( "Margin Bottom", 'mewvc' ),
					"param_name"       => "margin_bottom",
					"admin_label"      => true,
					"value"            => "40",
					"group"            => "Typography",
					/*"description" => __("Provide the title for the iHover.", 'ultimate')*/
				),
			),
		) );
	}


	function prime_progressbar_shortcode_function( $atts, $content = null, $tag ) {
		extract( shortcode_atts( array(
			'bar_label'      => 'HTML',
			'bar_percentage' => '95',
			'bar_style'      => 'style1',
			'bar_bg_color'   => '#337AB7',
			'margin_top'     => '20',
			'margin_bottom'  => '40',
			'bar_effects'    => 'success',
		), $atts ) );

		$content        = wpb_js_remove_wpautop( $content ); // fix unclosed/unwanted paragraph tags in $content
		$bar_percentage = isset( $atts['bar_percentage'] ) != '' ? (int) esc_attr( $atts['bar_percentage'] ) : 95;
		$output = '';
		if ( $bar_style == 'style1' || $bar_style == 'style2' || $bar_style == 'style3' || $bar_style == 'style4' || $bar_style == 'style5' || $bar_style == 'style6' || $bar_style == 'style7' || $bar_style == 'style8' || $bar_style == 'style9' || $bar_style == 'style10' ) {
			$output .= '<div class="pev-progress-' . $bar_style . '" style="margin-bottom: ' . $margin_bottom . 'px; margin-top: ' . $margin_top . 'px;">
	                		  <div class="pev-progress-bar pev-progress-bar-' . $bar_effects . '" role="pev-progress-bar" aria-valuenow="' . $bar_percentage . '"
	                		  aria-valuemin="0" aria-valuemax="100" style="width:' . $bar_percentage . '%; background-color: ' . $bar_bg_color . '">
	                		    <span class="pev-label">' . $bar_label . '</span>
	                		    <span class="pev-percent">' . $bar_percentage . '%</span>
	                		  </div>
	                		</div>';
		}

		return $output;
	}
}