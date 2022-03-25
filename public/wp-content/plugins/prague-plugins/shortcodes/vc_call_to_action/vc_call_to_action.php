<?php

//Call to action shortcode

if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'       => __( 'Call to action', 'js_composer' ),
			'description'=> __( 'Section with call to action blocks', 'js_composer' ),
			'base'       => 'tur_call_to_action',
			'category'   => __( 'Content', 'js_composer' ),
			'params'     => array(
				array(
					'type'       => 'textarea',
					'heading'    => __( 'Title', 'js_composer' ),
					'description'=> __( 'Please add your title', 'js_composer' ),
					'param_name' => 'title',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => __( 'Change color for title', 'js_composer' ),
					'description'=> __( 'Please select color for your title', 'js_composer' ),
					'param_name' => 'color_title',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => 'First Gradient Color',
					'param_name' => 'bg_color',
					"value"       => '#0c4fff', //Default color
					'dependency' => array( 'element' => 'style', 'value' => array( 'classic' ) )
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => 'Second Gradient Color',
					'param_name' => 'bg_second_color',
					"value"       => '#c24efe', //Default color
					'dependency' => array( 'element' => 'style', 'value' => array( 'classic' ) )
				),
				array(
					'type'       => 'attach_image',
					'heading'    => __( 'Background Image', 'js_composer' ),
					'description'=> __( 'Please add image', 'js_composer' ),
					'param_name' => 'call_bg',
					'dependency' => array( 'element' => 'style', 'value' => array( 'classic' ) )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Button style', 'js_composer' ),
					'description'=> __( 'Please select button style', 'js_composer' ),
					'param_name' => 'btn_style',
					'value'      => array(
						'Creative Light'    => 'a-btn-line',
						'Creative Dark'    => 'a-btn-line dark',
						'Arrow Right'    => 'arrow-right',
					),
					'admin_label' => true,
					'save_always' => true,
					'dependency' => array( 'element' => 'style', 'value' => array( 'classic' ) )
				),
				array(
					'type'       => 'vc_link',
					'heading'    => __( 'Button', 'js_composer' ),
					'description'=> __( 'Please specify link for your button', 'js_composer' ),
					'param_name' => 'button',
					'dependency' => array( 'element' => 'style', 'value' => array( 'classic' ) )
				),
			)
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	/* Frontend Output Shortcode */

	class WPBakeryShortCode_tur_call_to_action extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {

			extract( shortcode_atts( array(
				'title'          => '',
				'bg_color'       => '#0c4fff',
				'bg_second_color'=> '#c24efe',
				'call_bg'        => '',
				'color_title'    => '',
				'btn_style'      => 'a-btn',
				'button'         => '',
			), $atts ) );


			$bg_color = ! empty ( $bg_color ) && ! empty( $bg_second_color ) ? 'style="background-image: linear-gradient(127deg, ' . $bg_color . ', ' . $bg_second_color . ');"' : '';
			$call_bg = ( ! empty( $call_bg ) && is_numeric( $call_bg ) ) ? wp_get_attachment_url( $call_bg ) : '';
			$color_title = isset( $color_title ) && ! empty( $color_title ) ? 'style=color:' . $color_title . ';' : '';

			$button_parent = esc_attr($btn_style) == 'a-btn-line dark' ? 'a-btn-2' : 'a-btn';
			$button_parent = esc_attr($btn_style) == 'arrow-right' ? 'a-btn-arrow-2' : $button_parent;
			ob_start(); ?>

			<div class="call-to-action classic">
				<div class="call-to-action-wrap classic" <?php echo $bg_color; ?>>
					<?php if ( ! empty( $call_bg ) ) {
						echo prague_lazy_load_image( $call_bg, array( 'class' => 's-img-switch', 'alt' => '' ) );
					} ?>
					<div class="container">
						<div class="row">
							<div class="info-wrap">
								<?php if ( ! empty( $title ) ) { ?>
									<div class="call-title" <?php echo $color_title; ?>><?php echo wp_kses_post( $title ); ?></div>
								<?php }
								if ( isset( $button ) && ! empty( $button ) ) {

									if ( ! empty( $button ) ) {
										$url_button = vc_build_link( $button );
									} else {
										$url_button['url']    = '#';
										$url_button['title']  = 'title';
										$url_button['target'] = '_self';
									}

									if ( ! empty( $button ) ) { ?>
										<div class="btn-wrap">
											<a href="<?php echo esc_attr( $url_button['url'] ); ?>"
											   target="<?php echo esc_attr( $url_button['target'] ); ?>"
											   class="<?php echo esc_attr($button_parent); ?>  creative anima">
												<?php echo esc_html( $url_button['title'] ); ?>
												<span class="<?php echo  esc_attr($btn_style) ?>"></span>
											</a>
										</div>
									<?php }
								} ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php return ob_get_clean();
		}
	}
} ?>
