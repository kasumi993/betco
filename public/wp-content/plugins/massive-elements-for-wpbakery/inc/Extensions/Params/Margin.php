<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Extensions\Params;

class Margin {
	function __construct() {

		$path =  plugin_dir_url(__FILE__);

		if ( defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, 4.8 ) >= 0 ) {
			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param('mew_margins' , array($this, 'mew_margins_param'), $path . 'js/margin-param.js');
			}
		} else {
			if ( function_exists( 'add_shortcode_param' ) ) {
				add_shortcode_param( 'mew_margins', array($this, 'mew_margins_param'), $path . 'js/margin-param.js');
			}
		}
	}

	function mew_margins_param( $settings, $value ) {
		$dependency = '';
		$positions = $settings['positions'];
		$html = '<div class="mew-margins">
	<input type="hidden" name="'.esc_attr( $settings['param_name'] ).'" class="wpb_vc_param_value mew-margin-value '. esc_attr( $settings['param_name'] ).' '. esc_attr( $settings['type'] ).'_field" value="'.esc_attr( $value ).'" '.$dependency.'/>';
		foreach($positions as $key => $position)
			$html .= '<label class="mew-margin-param-label">'.esc_attr( $key ).'</label><input type="text" style="width:50px; padding:3px" data-hmargin="'.esc_attr( $position ).'" class="mew-margin-inputs" id="margin-'.esc_attr( $key ).'" /> &nbsp;&nbsp;';
		$html .= '</div>';
		return $html;
	}
}