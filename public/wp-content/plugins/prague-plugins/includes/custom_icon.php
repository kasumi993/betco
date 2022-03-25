<?php 
function prague_add_icons () {
 
	$icons  = array_map(function($a) { $item = array_keys($a); return $item[0]; }, et_line_icons());
	// add your icons
	echo '<h4 class="cs-icon-title">Et Line Icons</h4>';
	foreach ( $icons as $icon ) {
	echo '<a class="cs-icon-tooltip" data-cs-icon="'. $icon .'" data-title="'. $icon .'"><span class="cs-icon cs-selector"><i class="'. $icon .'"></i></span></a>';
	} 

}
add_action( 'cs_add_icons', 'prague_add_icons' );

function prague_custom_icon_css() {
	$plugin = new Prague_Plugins();
	wp_enqueue_style( 'et-line-font', $plugin->assets_css() .'/et-line-font.css', array(), '1.0.0', 'all' );

	wp_add_inline_style( 'et-line-font', '[data-icon]:before {content:none} .ui-dialog{position:fixed;top:100px;}' );
}
add_action( 'admin_print_styles', 'prague_custom_icon_css' );
add_action( 'wp_print_styles', 'prague_custom_icon_css' );