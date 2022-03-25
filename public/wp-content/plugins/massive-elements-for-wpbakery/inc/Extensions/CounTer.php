<?php
/**
 * @package  MEWVC
 */
namespace Inc\Extensions;

use Inc\Base\ExtensionsController;

class CounTer extends ExtensionsController {
	public function extensions_register() {
		if ( ! $this->activated( 'counter' ) ) {
			return;
		}

		add_shortcode('mew_counter', array($this , 'mew_counter_shortcode_function'));

		$this->csstooltip();
	}

	public function csstooltip() {
		vc_map( array(
			"name"        => __( "Counter", 'mewvc' ),
			"base"        => "mew_counter",
			"icon"        => "mew_counter",
			"category"    => 'Massive Elements',
			'description' => 'counts up to a targeted number ',
			// 'admin_enqueue_css' => array(plugins_url('css/vc_extensions_cq_admin.css', __FILE__)),
			"params"      => array(

				// Member Information Group Switch Param Here
				array(
					"type"        => "mew_switch",
					"heading"     => __( "Show Counter Icon", "mewvc" ),
					"param_name"  => "show_counter_icon",
					"value"       => "off",
					"options"     => array(
						"on" => array(
							"label" => __( "", "mewvc" ),
							"on"    => "Yes",
							"off"   => "No",
						),
					),
					//"default_set" => true,
					"description" => "Switch Yes If you want to Add Counter Icon",
					//'group'       => 'More Information',
				),

				array(
					'type'        => 'iconpicker',
					'heading'     => __( 'Icon', 'js_composer' ),
					'param_name'  => 'counter_icon',
					//'value'       => 'fa fa-angellist', // default value to backend editor admin_label
					'settings'    => array(
						'emptyIcon'    => true,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),
					'description' => __( 'Select icon from library.', 'mewvc' ),
					"dependency" => array(
						'element' => 'show_counter_icon',
						'value' =>  'on'
					),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Targeted number", "mewvc" ),
					"param_name" => "target_number",
					"value" => __( "26522", "mewvc" ),
					"description" => __( "The targeted number to count up to (From zero).", "mewvc" )
				),
				array(
					"type" => "textfield",
					"heading" => __( "Label", "mewvc" ),
					"param_name" => "counter_label",
					"value" => __( "Web Design", "mewvc" ),
					"description" => __( "The Label of the counter.", "mewvc" )
				),

				/*
				// SETTINGS COUNTER OPTION
				*/
				array(
					"type" => "textfield",
					"heading" => __( "Counter delay", "mewvc" ),
					"param_name" => "counter_delay",
					"value" => __( "10", "mewvc" ),
					"description" => __( "The delay in milliseconds per number count up.", "mewvc" ),
					"group"       => "Settings",
				),
				array(
					"type" => "textfield",
					"heading" => __( "Counter Time", "mewvc" ),
					"param_name" => "counter_time",
					"value" => __( "1000", "mewvc" ),
					"description" => __( "The total duration of the count up animation.", "mewvc" ),
					"group"       => "Settings",
				),

				/*
				// TYPHOGRAPHY COUNTER
				*/
				array(
					"type" => "mew_param_heading",
					"text" => __("Icon Typhography","mewvc"),
					"param_name" => "icon_typhography_style",
					//"dependency" => Array("element" => "main_heading", "not_empty" => true),
					"class" => "mew_param_heading",
					"group"       => "Typography",
					'edit_field_class' => 'mew-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
					"dependency" => array(
						'element' => 'show_counter_icon',
						'value' =>  'on'
					),
				),
				array(
					"type" => "colorpicker",
					"heading" => __( "Icon Color", "mewvc" ),
					"param_name" => "icon_color",
					"value" => '#FFFFFF',
					"description" => __( "Counter Icon Color", "mewvc" ),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					"group"       => "Typography",
					"dependency" => array(
						'element' => 'show_counter_icon',
						'value' =>  'on'
					),
				),
				array(
					"type"=>"number",
					"heading"=>__("Icon Size","mewvc"),
					"param_name"=>"counter_size",
					"value"=>"40",
					"suffix"=>"px",
					"description"=>__("Counter Icon Size","mewvc"),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					"group" => "Typography",
					"dependency" => array(
						'element' => 'show_counter_icon',
						'value' =>  'on'
					),
				),
				array(
					"type" => "mew_margins",
					"heading" => "Icon Margins",
					"param_name" => "icon_margin",
					"positions" => array(
						__("Top","mewvc") => "top",
						__("Bottom","mewvc") => "bottom",
						__("Left","mewvc") => "left",
						__("Right","mewvc") => "right",
					),
					"description"=>__("Icon Margin Here, Leave it black if you don't need any margin","mewvc"),
					"group" => "Typography",
					"dependency" => array(
						'element' => 'show_counter_icon',
						'value' =>  'on'
					)
				),
				array(
					"type" => "mew_param_heading",
					"text" => __("Number Typhography","mewvc"),
					"param_name" => "number_typhography_style",
					//"dependency" => Array("element" => "main_heading", "not_empty" => true),
					"class" => "mew_param_heading",
					"group"       => "Typography",
					'edit_field_class' => 'mew-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
				),
				array(
					"type" => "colorpicker",
					"heading" => __( "Number Color", "mewvc" ),
					"param_name" => "number_color",
					"value" => '#FFFFFF',
					"description" => __( "Counter Number Color", "mewvc" ),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					"group"       => "Typography",
				),
				array(
					"type"=>"number",
					"heading"=>__("Number Font Size","mewvc"),
					"param_name"=>"number_size",
					"value"=>"30",
					"suffix"=>"px",
					"description"=>__("Counter Number Size","mewvc"),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					"group" => "Typography",
				),
				array(
					"type" => "mew_margins",
					"heading" => "Counter Number Margins",
					"param_name" => "number_margin",
					"positions" => array(
						__("Top","mewvc") => "top",
						__("Bottom","mewvc") => "bottom",
						__("Left","mewvc") => "left",
						__("Right","mewvc") => "right",
					),
					"description"=>__("Counter Number Margin Here, Leave it black if you don't need any margin","mewvc"),
					"group" => "Typography"
				),

				array(
					"type" => "mew_param_heading",
					"text" => __("Label Typhography","mewvc"),
					"param_name" => "labels_typhography_style",
					//"dependency" => Array("element" => "main_heading", "not_empty" => true),
					"class" => "mew_param_heading",
					"group"       => "Typography",
					'edit_field_class' => 'mew-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
				),
				array(
					"type" => "colorpicker",
					"heading" => __( "Label Color", "mewvc" ),
					"param_name" => "label_color",
					"value" => '#FFFFFF',
					"description" => __( "Counter Label Color", "mewvc" ),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					"group"       => "Typography",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Label Font Family", "asvc"),
					"param_name" => "label_fonts",
					"value" => $this->mew_google_font(),
					"std" => 'Roboto Condensed',
					'group' => 'Typography',
					"description"=>__("Counter Label Font Family Hare, 800+ Google Fonts Available","mewvc"),
				),
				array(
					"type"=>"number",
					"heading"=>__("Label Font Size","mewvc"),
					"param_name"=>"label_size",
					"value"=>"30",
					"suffix"=>"px",
					"description"=>__("Counter Label Font Size","mewvc"),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					"group" => "Typography",
				),
				array(
					"type" => "mew_margins",
					"heading" => "Label Margins",
					"param_name" => "label_margin",
					"positions" => array(
						__("Top","mewvc") => "top",
						__("Bottom","mewvc") => "bottom",
						__("Left","mewvc") => "left",
						__("Right","mewvc") => "right",
					),
					"description"=>__("Label Margin Here, Leave it black if you don't need any margin","mewvc"),
					"group" => "Typography"
				),

				/*
				 * DESIGN OPTION
				 * */
				array(
					'type' => 'css_editor',
					'heading' => __( 'Counter Box', 'my-text-domain' ),
					'param_name' => 'css',
					'group' => __( 'Counter Box', 'my-text-domain' ),
				),

			)
		) );
	}



	function mew_counter_shortcode_function( $atts, $content = null, $tag ) {

		extract( shortcode_atts( array(
			'counter_icon'          => '',
			//'show_counter_icon'        => $show_counter_icon == 'on' ? 'on' : 'off',
			'show_counter_icon'        => '',
			'target_number'        => '26522',
			'counter_label'        => 'Web Design',
			'counter_delay'        => '10',
			'counter_time'        => '1000',
			'icon_color'        => '#FFFFFF',
			'counter_size'        => '40',
			'number_color'        => '#FFFFFF',
			'number_size'        => '30',
			'label_color'        => '#FFFFFF',
			'label_size'        => '30',
			'css'        => '',
			'label_fonts'        => '',
			'label_margin'        => '',
			'number_margin'        => '',
			'icon_margin'        => '',
		), $atts ) );

		//$content = wpb_js_remove_wpautop( $content ); // fix unclosed/unwanted paragraph tags in $content

		if ( !empty ($label_fonts) ) {
			$label_fonts = str_replace( " ", "+", $label_fonts );
			echo '<style type="text/css">
@import url("https://fonts.googleapis.com/css?family=' . $label_fonts . '");
</style>';
			$label_fonts = str_replace( "+", " ", $label_fonts );
		}

		/* COUNTER STYLE*/
		$numberstyle = 'color:'.$number_color.'; font-size:'.$number_size.'px; '.$number_margin.'';
		$iconstyle = 'color: '.$icon_color.'; font-size: '.$counter_size.'px; '.$icon_margin.'';
		$labelstyle = 'color: '.$label_color.'; font-family:'.$label_fonts.'; font-size: '.$label_size.'px; '.$label_margin.'';

		// MASTER CSS
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), "mew_counter", $atts );


		$i = uniqid();
		$output = '<div class="eak-counter">
                <div class="eak-counter-content '.esc_attr( $css_class ).'" id="counter">';

			if ($counter_icon !== '') {
			$output .= '<div class="eak-counter-icon">
                        <i style="'.esc_attr($iconstyle).'" class="' . $counter_icon . '"></i>
                    	</div>';
			}

		$output .= '<span style="'.esc_attr($numberstyle).'" id="epa-counter" class="counter'.$i.'">'.$target_number.'</span>
                <h3 style="'.esc_attr($labelstyle).'">'.$counter_label.'</h3>
                </div>
            </div>';

		$output .= ' <script type="text/javascript">
					jQuery(document).ready(function($) {
					            $(".counter'.$i.'").counterUp({
					                delay: '.$counter_delay.',
					                time: '.$counter_time.'
					            });
					        });
				</script>';

		return $output;
	}
}