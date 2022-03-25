<?php 
/*
** Prague Formidable Shortcode
** Version: 1.0.0 
*/

vc_map( array(
	'name'                    => esc_html__( 'Formidable', 'js_composer' ),
	'base'                    => 'vc_formidable',
	'content_element'         => true,
	'show_settings_on_create' => true, 
	'description'             => esc_html__( 'Forms', 'js_composer'),
	'params'          => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Select Form', 'js_composer' ),
			'param_name' => 'form',
			'value' => vc_get_fd_forms()
		),
		
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			'value' => '',
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design options', 'js_composer' ),
		),
	) //end params
) );

class WPBakeryShortCode_vc_formidable extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'form'  => '',
			'style'  => '',
			'el_class'  => '',
			'css'       => ''
		), $atts ) );


		$width_class = array(
			'1' => ' col-xs-12',
			'1/6' => ' col-sm-6 col-sm-offset-3 col-xs-12',
			'1/8' => ' col-xs-12 col-sm-8 col-sm-offset-2',
			'1/10' => ' col-xs-12 col-sm-10 col-sm-offset-1',
		);

 
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base'], $atts );
		
		// custum css
		$css_class .= vc_shortcode_custom_css_class( $css, ' ' );

		// custum class
		$css_class .= (!empty($el_class)) ? ' '.$el_class : '';
		$output="";
		// output
		if(!empty($form)) {
			$output .= '<div class="prague-formidable  '.esc_attr( $css_class ). '">';
				$output .= do_shortcode(esc_html('[formidable id='.$form.']'));
			$output .= '</div>';
		}
		$output .='<div class="test ' . esc_attr($form) . '"></div>';

		// return output
		return  $output;

	}
}
