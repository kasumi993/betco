<?php


function cr_get_row_offset( $pref, $suf, $max = 50, $step = 5 ) {
	$ar = array();
	for ( $i = 0; $i < $max + $step; $i += $step ) {
		$ar[ $i . 'px' ] = $pref . '-' . $i . $suf;
	}

	return array_merge( array( 'Default' => 'none' ), $ar );
}

$responsive_classes = array(
	array(
		'type'       => 'checkbox',
		'heading'    => __( 'Enable Ovarlay', 'js_composer' ),
		'param_name' => 'enable_ovarlay',
		'value'      => ''
	),
	array(
		'type'       => 'dropdown',
		'param_name' => 'image_background_position',
		'heading'    => esc_html__( 'Image background position', 'js_composer' ),
		'value'      => array(
			'Center' => 'center',
			'Top'    => 'top',
			'Bottom' => 'bottom',
		),
		'group'      => 'Design Options'
	),
	array(
		'type'       => 'checkbox',
		'param_name' => 'overflow_visible',
		'heading'    => esc_html__( 'Make overflow visible for this row?', 'js_composer' ),
		'value'      => '',
		'group'      => 'Design Options'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Desctop margin top', 'js_composer' ),
		'param_name' => 'desctop_mt',
		'value'      => cr_get_row_offset( 'margin-lg', 't', 170 ),
		'group'      => 'Responsive Margins'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Desctop margin bottom', 'js_composer' ),
		'param_name' => 'desctop_mb',
		'value'      => cr_get_row_offset( 'margin-lg', 'b', 170 ),
		'group'      => 'Responsive Margins',
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Tablets margin top', 'js_composer' ),
		'param_name' => 'tablets_mt',
		'value'      => cr_get_row_offset( 'margin-sm', 't', 100 ),
		'group'      => 'Responsive Margins'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Tablets margin bottom', 'js_composer' ),
		'param_name' => 'tablets_mb',
		'value'      => cr_get_row_offset( 'margin-sm', 'b', 100 ),
		'group'      => 'Responsive Margins'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Mobile margin top', 'js_composer' ),
		'param_name' => 'mobile_mt',
		'value'      => cr_get_row_offset( 'margin-xs', 't' ),
		'group'      => 'Responsive Margins'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Mobile margin bottom', 'js_composer' ),
		'param_name' => 'mobile_mb',
		'value'      => cr_get_row_offset( 'margin-xs', 'b' ),
		'group'      => 'Responsive Margins'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Desctop padding top', 'js_composer' ),
		'param_name' => 'desctop_pt',
		'value'      => cr_get_row_offset( 'padding-lg', 't', 170 ),
		'group'      => 'Responsive Paddings'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Desctop padding bottom', 'js_composer' ),
		'param_name' => 'desctop_pb',
		'value'      => cr_get_row_offset( 'padding-lg', 'b', 170 ),
		'group'      => 'Responsive Paddings',
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Tablets padding top', 'js_composer' ),
		'param_name' => 'tablets_pt',
		'value'      => cr_get_row_offset( 'padding-sm', 't', 100 ),
		'group'      => 'Responsive Paddings'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Tablets padding bottom', 'js_composer' ),
		'param_name' => 'tablets_pb',
		'value'      => cr_get_row_offset( 'padding-sm', 'b', 100 ),
		'group'      => 'Responsive Paddings'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Mobile padding top', 'js_composer' ),
		'param_name' => 'mobile_pt',
		'value'      => cr_get_row_offset( 'padding-xs', 't' ),
		'group'      => 'Responsive Paddings'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Mobile padding bottom', 'js_composer' ),
		'param_name' => 'mobile_pb',
		'value'      => cr_get_row_offset( 'padding-xs', 'b' ),
		'group'      => 'Responsive Paddings'
	),
);

if ( function_exists( 'vc_add_params' ) ) {
	vc_add_params( 'vc_row', $responsive_classes );
}
