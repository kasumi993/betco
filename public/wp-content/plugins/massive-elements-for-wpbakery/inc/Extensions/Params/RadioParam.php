<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Extensions\Params;

class RadioParam {
	public function __construct() {
		add_action( 'vc_load_default_params', array(
			$this,
			'vc_load_vc_custom_radio_param',
		) );
	}

	/**
	 * Add custom param to system
	 */
	public function vc_load_vc_custom_radio_param() {
		vc_add_shortcode_param( 'custom_radio', array(
			$this,
			'render',
		) );
	}

	/**
	 * Radio shortcode attribute type.
	 *
	 * @param        $settings
	 * @param string $value
	 *
	 * @return string - html string.
	 */
	public function render( $settings, $value ) {
		$output        = '';
		$current_value = is_string( $value ) ? ( strlen( $value ) > 0 ? explode( ',', $value ) : array() ) : (array) $value;
		$values        = isset( $settings['value'] ) && is_array( $settings['value'] ) ? $settings['value'] : array( __( 'Yes' ) => 'true' );
		if ( ! empty( $values ) ) {
			foreach ( $values as $label => $v ) {
				$checked = count( $current_value ) > 0 && in_array( $v, $current_value ) ? ' checked' : '';
				$output  .= ' <label class="vc_radio-label"><input style="width:auto" id="' . $settings['param_name'] . '-' . $v . '" value="' . $v . '" class="wpb_vc_param_value ' . $settings['param_name'] . ' ' . $settings['type'] . '" type="radio" name="' . $settings['param_name'] . '"' . $checked . '> ' . $label . '</label>';
			}
		}

		return $output;
	}
}