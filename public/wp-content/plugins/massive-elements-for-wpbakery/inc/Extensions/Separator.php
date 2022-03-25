<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Extensions;


use Inc\Base\ExtensionsController;

class Separator extends ExtensionsController {
	public function extensions_register() {
		if ( ! $this->activated( 'separator' ) ) {
			return;
		}
		add_shortcode( 'pextvc_space', array( $this, 'prime_separator_func' ) );

		$this->separator();
	}

	public function separator() {
		vc_map( array(
			"name"        => __( "Separator", 'prime_vc' ),
			"description" => __( "Add Space/Separator", 'prime_vc' ),
			"base"        => "pextvc_space",
			"class"       => "",
			"icon"        => "mew_separator",
			"category"    => __( 'Massive Elements', 'prime_vc' ),
			"params"      => array(
				array(
					"type"        => "textfield",
					"class"       => "",
					"heading"     => __( "Height Space", 'prime_vc' ),
					"description" => 'Ex: 100px',
					"param_name"  => "pextvc_height",
					'admin_label' => true,
				),
			),
		) );
	}


	function prime_separator_func( $atts, $content = null, $tag ) {

		extract(
			shortcode_atts(
				array(
					"pextvc_height" => '300px',
				),
				$atts)
		);

		$output = '<div class="pextvc-space" style="height:'.$pextvc_height.'"></div>';

		return $output;
	}
}