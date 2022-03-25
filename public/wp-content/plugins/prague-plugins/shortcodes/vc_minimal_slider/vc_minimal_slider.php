<?php
/*
 * Minimal Slider Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */

if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'                    => __( 'Minimal Slider', 'js_composer' ),
			'base'                    => 'minimal_slider',
			'as_parent'               => array( 'only' => 'minimal_slider_items' ),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Autoplay (sec)', 'js_composer' ),
					'description' => __( '0 - off autoplay.', 'js_composer' ),
					'param_name'  => 'autoplay',
					'value'       => '0',
					'group'       => __( 'Animation', 'js_composer' )
				),
			) //end params
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_minimal_slider extends WPBakeryShortCodesContainer {
		protected function content( $atts, $content = null ) {

			extract( shortcode_atts( array(
				'autoplay' => '0',
				'speed'    => '500'
			), $atts ) );


			$autoplay = is_numeric( $autoplay ) ? $autoplay * 1000 : 0;
			$speed    = is_numeric( $speed ) ? $speed : '500';


			global $minimal_slider_items;
			$minimal_slider_items = array();


			do_shortcode( $content );

			ob_start();

			if ( ! empty( $minimal_slider_items ) ) { ?>
                <div class="banner-slider-wrap simple_slider">
                    <div class="owl-container-gallery owl-carousel full-height-window"
                         data-autoplay="<?php echo esc_attr( $autoplay ); ?>">


						<?php foreach ( $minimal_slider_items as $item ) {
							$value = (object) $item['atts'];

							$url       = ( ! empty( $value->image ) && is_numeric( $value->image ) ) ? wp_get_attachment_image_src( $value->image, 'full' ) : '';
							$url2      = ( ! empty( $value->image ) && is_numeric( $value->image ) ) ? wp_get_attachment_image_src( $value->image, 'large' ) : '';
							$title     = isset( $value->title ) && ! empty( $value->title ) ? $value->title : '';
							$subtitle  = isset( $value->subtitle ) && ! empty( $value->subtitle ) ? $value->subtitle : '';
							$button    = isset( $value->button ) && ! empty( $value->button ) ? $value->button : '';
							$btn_style = isset( $value->btn_style ) && ! empty( $value->btn_style ) ? $value->btn_style : 'a-btn-1';

							$alt = ! empty( $url ) ? get_post_meta( $value->image, '_wp_attachment_image_alt', true ) : ''; ?>

                            <div class="owl-slide">
								<?php if ( ! empty( $url ) ) { ?>
                                    <img src="<?php echo esc_url( $url[0] ); ?>" alt="<?php echo esc_attr( $alt ); ?>"
                                         data-url="<?php echo esc_url( $url2[0] ); ?>" class="s-img-switch">
								<?php }

								if ( ! empty( $title ) || ! empty( $subtitle ) || ! empty( $button ) ) { ?>
                                    <div class="caption">
										<?php if ( ! empty( $subtitle ) ) { ?>
                                            <div class="subtitle">
												<?php echo esc_html( $subtitle ); ?>
                                            </div>
										<?php }

										if ( ! empty( $title ) ) { ?>
                                            <div class="title">
												<?php echo esc_html( $title ); ?>
                                            </div>
										<?php }

										if ( ! empty( $button ) ) { ?>
                                            <div class="button">
												<?php $url_btn = vc_build_link( $button );

												if ( ! empty( $url_btn['url'] ) ) {
													$btn_target = ! empty( $url_btn['target'] ) ? $url_btn['target'] : 'self'; ?>
                                                    <div class="btn-wrapper">
                                                        <a href="<?php echo esc_url( $url_btn['url'] ); ?>"
                                                           class="a-btn creative light"
                                                           target="<?php echo esc_attr( $btn_target ); ?>">
                                                            <span class="a-btn-line"></span>
	                                                        <?php echo esc_html( $url_btn['title'] ); ?>
                                                        </a>
                                                    </div>
												<?php } ?>
                                            </div>
										<?php } ?>
                                    </div>
								<?php } ?>
                            </div>
						<?php } ?>
                    </div>
                </div>
			<?php }

			return ob_get_clean();
		}
	}
}

if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'            => 'Slider item',
			'base'            => 'minimal_slider_items',
			'as_child'        => array( 'only' => 'minimal_slider' ),
			'content_element' => true,
			'params'          => array(
				array(
					'type'       => 'attach_image',
					'heading'    => __( 'Background Image', 'js_composer' ),
					'param_name' => 'image',
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Subtitle', 'js_composer' ),
					'param_name' => 'subtitle',
					'value'      => '',
				),
				array(
					'type'       => 'textarea',
					'heading'    => __( 'Title', 'js_composer' ),
					'param_name' => 'title',
					'value'      => '',
				),
				array(
					'param_name'  => 'button',
					'type'        => 'vc_link',
					'description' => '',
					'heading'     => 'Button',
					'value'       => '',
				),
				array(
					'param_name'  => 'style_button',
					'type'        => 'dropdown',
					'description' => '',
					'heading'     => 'Style button',
					'value'       => array(
						'Simple'   => 'simple',
						'Creative' => 'creative',
					),
				),
				array(
					'param_name'  => 'color_button',
					'type'        => 'dropdown',
					'description' => '',
					'heading'     => 'Color button',
					'value'       => array(
						'Light' => 'light',
						'Dark'  => 'dark',
					),
				),
			) //end params
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_minimal_slider_items extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			global $minimal_slider_items;
			$minimal_slider_items[] = array( 'atts' => $atts, 'content' => $content );

			return;
		}
	}
}