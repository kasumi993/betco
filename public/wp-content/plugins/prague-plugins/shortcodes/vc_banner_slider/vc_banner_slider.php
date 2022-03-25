<?php

//Banner Slider shortcode

if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'                    => __( 'Banner Slider', 'js_composer' ),
			'base'                    => 'banner_slider',
			'as_parent'               => array( 'only' => 'banner_slider_items' ),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'params'                  => array(
				array(
					'param_name' => 'type_slider',
					'value'      => 'andra',
					'admin_label' => true,
					'save_always' => true,
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Autoplay (sec)', 'js_composer' ),
					'description' => __( '0 - off autoplay.', 'js_composer' ),
					'param_name'  => 'autoplay',
					'value'       => '0',
					'group'       => __( 'Animation', 'js_composer' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Speed (milliseconds)', 'js_composer' ),
					'description' => __( 'Speed Animation. Default 1000 milliseconds', 'js_composer' ),
					'param_name'  => 'speed',
					'value'       => '500',
					'group'       => __( 'Animation', 'js_composer' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Extra class name', 'js_composer' ),
					'param_name'  => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
					'value'       => ''
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS box', 'js_composer' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'js_composer' )
				)
			) //end params
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_banner_slider extends WPBakeryShortCodesContainer
	{
		protected function content($atts, $content = null)
		{

			extract(shortcode_atts(array(
				'autoplay' => '0',
				'speed' => '500',
				'css' => '',
				'el_class' => '',
			), $atts));

			$autoplay = is_numeric($autoplay) ? $autoplay * 1000 : 0;
			$speed = is_numeric($speed) ? $speed : '500';
			$class = (!empty($el_class)) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class($css, ' ');

			global $banner_slider_items;
			$banner_slider_items = array();

			$vert_height = '';

			$not_swipe = !empty($not_swipe) ? 'not-swipe' : '';

			do_shortcode($content);

			ob_start();

			if (!empty($banner_slider_items)) { ?>

				<div class="banner-slider-wrap andra <?php echo esc_attr($class); ?>">
					<div class="swiper-container swiper <?php echo esc_attr( $not_swipe . ' ' . $vert_height ); ?>"
					     data-mouse="0" data-autoplay="<?php echo esc_attr($autoplay); ?>"
					     data-loop="1" data-speed="<?php echo esc_attr($speed); ?>" data-center="1"
					     data-space-between="30" data-pagination-type="fraction"
					     data-mode="horizontal">
						<div class="swiper-wrapper">
							<?php

							foreach ($banner_slider_items as $item) {
								$value = (object)$item['atts'];

								$img_url = (!empty($value->image) && is_numeric($value->image)) ? wp_get_attachment_url($value->image) : '';
								?>
								<div class="swiper-slide swiper-no-swiping full-height-window-hard">
									<?php if ( ( !empty($img_url) ) ) {  ?>
											<img src="<?php echo esc_url($img_url); ?>" class="s-img-switch" alt="">
										<?php } ?>
								</div>
								<?php
							} ?>
						</div>
						<div class="pag-wrapper">
							<div class="swiper-pagination"></div>
						</div>
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
			'base'            => 'banner_slider_items',
			'as_child'        => array( 'only' => 'banner_slider' ),
			'content_element' => true,
			'params'          => array(
				array(
					'param_name' => 'option_style',
					'value'      =>  'andra',
				),
				array(
					'type'       => 'attach_image',
					'heading'    => __( 'Background Image', 'js_composer' ),
					'param_name' => 'image',
					'dependency' => array(
						'element' => 'option_style',
						'value'   => array( 'classic', 'classic_vertical', 'andra' ),
					),
				),
			),
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_banner_slider_items extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			global $banner_slider_items;
			$banner_slider_items[] = array( 'atts' => $atts, 'content' => $content );

			return;
		}
	}
}