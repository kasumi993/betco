<?php

//Single media shortcode

if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'        => __( 'Single media', 'js_composer' ),
			'base'        => 'vc_single_media',
			'description' => __( 'Single media', 'js_composer' ),
			'category'    => __( 'Content', 'js_composer' ),
			'params'      => array(
				array(
					'type'        => 'dropdown',
					'param_name'  => 'type',
					'heading'     => esc_html__( 'Type', 'js_composer' ),
					'value'       => array(
						'Image' => 'image',
					),
					'admin_label' => true,
					'save_always' => true,
				),
				array(
					'param_name'  => 'image',
					'type'        => 'attach_image',
					'description' => '',
					'heading'     => 'Image',
					'value'       => '',
					'dependency'  => array( 'element' => 'type', 'value' => array( 'image' ) ),
				),
				array(
					'param_name'  => 'shadow',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Add shadow?',
					'value'       => '',
					'dependency'  => array( 'element' => 'type', 'value' => array( 'image' ) ),
				),
				array(
					'param_name'  => 'add_secondary',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Add secondary image?',
					'desc'        => 'It will be placement at right bottom angle',
					'value'       => '',
					'dependency'  => array( 'element' => 'type', 'value' => array( 'image' ) ),
				),
				array(
					'param_name'  => 'secondary_image',
					'type'        => 'attach_image',
					'description' => '',
					'heading'     => 'Secondary image',
					'value'       => '',
					'dependency'  => array( 'element' => 'add_secondary', 'not_empty' => true ),
				),
				array(
					'param_name'  => 'move_left',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Move it to left?',
					'desc'        => 'It will be moved to left bottom angle',
					'value'       => '',
					'dependency'  => array( 'element' => 'add_secondary', 'not_empty' => true ),
				),
			),
			//end params
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	/* Frontend Output Shortcode */

	class WPBakeryShortCode_vc_single_media extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'type'            => 'image',
				'image'           => '',
				'shadow'          => '',
				'add_secondary'   => '',
				'secondary_image' => '',
				'move_left'       => '',
			), $atts ) );


			// start output
			ob_start();

			if ( ! empty( $image ) ) {
				$image_src = wp_get_attachment_image_src( $image, 'full' );
				$image_src = is_array( $image_src ) ? $image_src[0] : $image_src;
				$shadow = ! empty( $shadow ) ? 'shadow' : ''; ?>
                <div class="single-media single-media--image">
                    <div class="single-media__wrap">
                        <img src="<?php echo esc_url( $image_src ); ?>" class="single-media__image <?php echo esc_attr( $shadow ); ?>" alt="">
						<?php if ( ! empty( $secondary_image ) ) {
							$image_src = wp_get_attachment_image_src( $secondary_image, 'full' );
							$image_src = is_array( $image_src ) ? $image_src[0] : $image_src;
							$move_left = ! empty( $move_left ) ? 'move_left' : ''; ?>

                            <img src="<?php echo esc_url( $image_src ); ?>"
                                 class="single-media__secondary <?php echo esc_attr( $move_left ); ?>" alt="">
						<?php } ?>
                    </div>
                </div>

			<?php }

			// end output
			return ob_get_clean();
		}
	}
}

