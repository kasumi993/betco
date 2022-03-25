<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Extensions\Params;

class Padding {
	function __construct() {

		$path =  plugin_dir_url(__FILE__);

		if ( defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, 4.8 ) >= 0 ) {
			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param('mew_padding' , array($this, 'mew_padding_param'), $path . 'js/padding-param.js');
			}
		} else {
			if ( function_exists( 'add_shortcode_param' ) ) {
				add_shortcode_param( 'mew_padding', array($this, 'mew_padding_param'), $path . 'js/padding-param.js');
			}
		}
	}

	function mew_padding_param( $settings, $value ) {
		$dependency = '';
		$positions = $settings['positions'];
		$html = '<div class="mew-padding">
						<input type="hidden" name="'.esc_attr( $settings['param_name'] ).'" class="wpb_vc_param_value mew-padding-value '. esc_attr( $settings['param_name'] ).' '. esc_attr( $settings['type'] ).'_field" value="'.esc_attr( $value ).'" '.$dependency.'/>';
		foreach($positions as $key => $position)
			$html .= '<label class="mew-padding-param-label">'.esc_attr( $key ).'</label><input type="text" style="width:50px; padding:3px" data-hmargin="'.esc_attr( $position ).'" class="mew-padding-inputs" id="margin-'.esc_attr( $key ).'" /> &nbsp;&nbsp;';
		$html .= '</div>';
		return $html;
	}
}