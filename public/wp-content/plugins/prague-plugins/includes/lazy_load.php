<?php 
if ( ! function_exists( 'prague_lazy_load_image' ) ) {
	function prague_lazy_load_image( $url, $attr = array() ) {

		$uri_img = 'data:image/gif;base64,R0lGODdhAQABAIAAAAAAAMzMzCwAAAAAAQABAAACAkQBADs=';

		if ( is_numeric( $url ) ) {
			$url = wp_get_attachment_url( $url );
		}

		$default_attr = array(
			'data-lazy-src' => esc_url( $url ),
			'src'           => $uri_img,
			'class'         => 's-img-switch',
		);

		if ( empty( $url ) ) {
			return "";
		}

		$attr = wp_parse_args( $attr, $default_attr );

		if ( ! cs_get_option( 'enable_lazy_load' ) ) {
			unset( $attr['data-lazy-src'] );
			$attr['src'] = esc_url( $url );
		}

		$attr = apply_filters( 'the_lazy_load_image', $attr );

		$attr = array_map( 'esc_attr', $attr );
		$html = '<img';
		foreach ( $attr as $name => $value ) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';

		return $html;
	}
}

