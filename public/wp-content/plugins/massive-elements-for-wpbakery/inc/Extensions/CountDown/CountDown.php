<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Extensions\CountDown;
use Inc\Base\ExtensionsController;


class CountDown extends ExtensionsController {

	public function extensions_register() {
		if ( ! $this->activated( 'countdown' ) ) {
			return;
		}
		add_shortcode( 'pr_countdown', array( $this, 'prime_countdown_short' ) );

		$this->countdown();
	}

	public function countdown() {

		vc_map( array(
			"name"        => __( "Countdown", 'mewvc' ),
			"base"        => "pr_countdown",
			"icon"        => "mew_countdown",
			"category"    => 'Massive Elements',
			'description' => 'Display CountDown Timer',
			// 'admin_enqueue_css' => array(plugins_url('css/vc_extensions_cq_admin.css', __FILE__)),
			"params" => array(
				array(
					"type" => "datetimepicker",
					"class" => "",
					"heading" => __("Target Time For Countdown", "mewvc"),
					"param_name" => "datetime",
					'value' => date("Y/m/d H:i:s", strtotime("+1 month")),
					'group' => __('Element Design  ', 'mewvc'),
					"description" => __("Date and time format (yyyy/mm/dd hh:mm:ss).", "mewvc"),
				),


/*				array(
					"type" => "textfield",
					'heading' => __('Date (Y/m/d H:i:s Ex: 2017/11/28 15:11:12)', 'mewvc'),
					'description' => __('The countdown will count from this moment to the date in this field.', 'mewvc'),
					'param_name' => 'countdown_date',
					'value' => date("Y/m/d H:i:s", strtotime("+1 month")),
					'group' => __('Element Design  ', 'mewvc'),
				),*/
				array(
					'type' => 'dropdown',
					"heading" => __('Style', 'mewvc'),
					'description' => __('Select display style.', 'mewvc'),
					'param_name' => 'display_style',
					'group' => __('Element Design  ', 'mewvc'),
					'value' => array(
						__('Default', 'mewvc') => 'cirlcle',
						__('Circle Text Outside', 'mewvc') => 'circle_text_outside',
						__('Clean', 'mewvc') => 'clean',
						__('Clean With Background', 'mewvc') => 'clean_bg',
						__('Bordered', 'mewvc') => 'border',
						__('Border Top', 'mewvc') => 'border_top',
						__('Custom Background', 'mewvc') => 'clean_custome_background',
					),
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __("Inside color", 'mewvc'),
					"param_name" => "inside_color",
					"value" => '',
					"dependency" => array('element' => 'circle_button', 'value' => 'on'),
					"description" => __("Choose color of inside circle (for 'Circle Text Outside' syle only).", 'mewvc'),
					"dependency" => array('element' => 'display_style', 'value' => 'circle_text_outside'),
					'group' => __('Element Design  ', 'mewvc'),
				),
				array(
					'type' => 'prime_slider',
					'heading' => __('Time Text Font Size', 'mewvc'),
					'param_name' => 'time_text_size',
					'tooltip' => __('Choose Time Text Size Here. For large numbers it\'s better use 18px Font Size.', 'team_vc'),
					'min' => 0,
					'max' => 120,
					'step' => 1,
					'value' => 0,
					'unit' => 'px',
					"description" => __("Chose Time Text Size as Pixel. Default is 0, this mean the font size depend on the default of each style.", "my-text-domain"),
					'group' => __('Element Design  ', 'mewvc'),
				),
				array(
					"type" => "prime_slider",
					'heading' => __('Text Size (below time) (px)', 'mewvc'),
					'description' => __('Size of the text below time (Days, Hours, Minutes, Seconds).', 'mewvc'),
					'param_name' => 'text_size',
					'min' => 0,
					'max' => 120,
					'step' => 1,
					'value' => 0,
					'unit' => 'px',
					'group' => __('Element Design  ', 'mewvc'),
				),
				array(
					"type" => "prime_slider",
					'heading' => __('Block Spacing (px)', 'mewvc'),
					'description' => __('Spacing bettwen countdown blocks, for Clean Style only.', 'mewvc'),
					'param_name' => 'spacing',
					'min' => 0,
					'max' => 200,
					'step' => 1,
					'value' => 0,
					'unit' => 'px',
					"dependency" => array('element' => 'display_style', 'value' => array('clean', 'clean_hexagon')),
					'group' => __('Element Design  ', 'mewvc'),
				),
				//for colors
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __('Day color', 'mewvc'),
					"param_name" => "d_color",
					"value" => '',
					"description" => __("Choose day color", 'mewvc'),
					'group' => __('Color Design  ', 'mewvc'),
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "icon",
					"heading" => __("Day Background Image  (for Custom Background only)", 'mewvc'),
					"param_name" => "d_icon",
					"value" => '',
					"description" => __("Choose Day Background Image", 'mewvc'),
					"dependency" => array('element' => 'display_style', 'value' => 'clean_custome_background'),
					'group' => __('Background', 'mewvc'),
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __("Hour color", 'mewvc'),
					"param_name" => "h_color",
					"value" => '',
					"description" => __("Choose hour color", 'mewvc'),
					'group' => __('Color Design  ', 'mewvc'),
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "icon",
					"heading" => __("Hour Background Image (for Custom Background only)", 'mewvc'),
					"param_name" => "h_icon",
					"value" => '',
					"description" => __("Choose Hour Background Image", 'mewvc'),
					"dependency" => array('element' => 'display_style', 'value' => 'clean_custome_background'),
					'group' => __('Background', 'mewvc'),
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __("Minute color", 'mewvc'),
					"param_name" => "i_color",
					"value" => '',
					"description" => __("Choose minute color", 'mewvc'),
					'group' => __('Color Design  ', 'mewvc'),
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "icon",
					"heading" => __("Minute Background Image (for Custom Background only)", 'mewvc'),
					"param_name" => "i_icon",
					"value" => '',
					"description" => __("Choose Minute Background Image.", 'mewvc'),
					"dependency" => array('element' => 'display_style', 'value' => 'clean_custome_background'),
					'group' => __('Background', 'mewvc'),
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __("Second color", 'mewvc'),
					"param_name" => "s_color",
					"value" => '',
					"description" => __("Choose second color", 'mewvc'),
					'group' => __('Color Design  ', 'mewvc'),
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "icon",
					"heading" => __("Second Background Image (for Custom Background only)", 'mewvc'),
					"param_name" => "s_icon",
					"value" => '',
					"description" => __("Choose Second Background Image", 'mewvc'),
					"dependency" => array('element' => 'display_style', 'value' => 'clean_custome_background'),
					'group' => __('Background', 'mewvc'),
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __("Text color", 'mewvc'),
					"param_name" => "txt_color",
					"value" => '#0473AA',
					"description" => __("Choose color of countdown and lable text. (Use as background color in Border Top style)", 'mewvc'),
					'group' => __('Color Design  ', 'mewvc'),
				),
				array(
					'type' => 'css_editor',
					'heading' => __('CSS box', 'mewvc'),
					'param_name' => 'css',
					'group' => __('Block Design', 'mewvc'),
				)
			),
		) );
	}

public function prime_countdown_short($atts, $content = null){

	$css = '';
	extract(shortcode_atts(array(
		'css' => '',
		'display_style' => 'circle',
		'time_text_size' => '',
		'text_size' => '',
		'd_color' => '',
		'h_color' => '',
		'i_color' => '',
		's_color' => '',
		'spacing' => '',
		'txt_color' => '#0473AA',
		'inside_color' => '',
		'd_icon' => '',
		'h_icon' => '',
		'i_icon' => '',
		's_icon' => '',
		'datetime' => date("Y/m/d H:i:s", strtotime("+1 month")),

	), $atts));

	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), "pr_countdown", $atts );

	$output = "";

		require "style/$display_style.php";

	$output.= ob_get_contents();
	ob_end_clean();
	return $output;
	}


}