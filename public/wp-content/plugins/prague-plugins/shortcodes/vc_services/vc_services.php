<?php

//Services shortcode

if ( function_exists( 'vc_map' ) ) {

	vc_map(
		array(
			'name'        => __( 'Services', 'js_composer' ),
			'base'        => 'vc_services',
			'category'    => __( 'Content', 'js_composer' ),
			'description' => __( 'Block with image and text', 'js_composer' ),
			'params'      => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Services style', 'js_composer' ),
					'description' => esc_html__( 'Please select main style', 'js_composer' ),
					'param_name'  => 'services_style',
					'value'       => array(
						array(
							'value' => 'simple',
							'label' => esc_html__( 'Simple', 'js_composer' ),
						),
						array(
							'value' => 'modern',
							'label' => esc_html__( 'Modern', 'js_composer' ),
						),
					)
				),
				array(
					'type'        => 'iconpicker',
					'heading'     => __( 'Icon', 'js_composer' ),
					'param_name'  => 'icon',
					'value'       => '',
					'settings'    => array(
						'emptyIcon'    => false,
						'type'         => 'info',
						'source'       => prague_add_custom_icons(),
						'iconsPerPage' => 4000,
					),
					'description' => __( 'Select icon from library.', 'js_composer' ),
					'dependency'  => array( 'element' => 'services_style', 'value' => array( 'simple' ) )
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => 'Icon First Gradient Color',
					'param_name' => 'icon_color',
					"value"      => '#0c4fff', //Default color
					'dependency' => array( 'element' => 'services_style', 'value' => array( 'simple' ) )
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => 'Icon Second Gradient Color',
					'param_name' => 'icon_second_color',
					"value"      => '#c24efe', //Default color
					'dependency' => array( 'element' => 'services_style', 'value' => array( 'simple' ) )
				),
				array(
					'param_name'  => 'logo',
					'type'        => 'attach_image',
					'description' => '',
					'heading'     => 'Logo',
					'value'       => '',
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Title', 'js_composer' ),
					'param_name' => 'title',
					'dependency' => array( 'element' => 'services_style', 'value' => array( 'simple', 'modern' ) )
				),
				array(
					'type'       => 'textarea',
					'heading'    => __( 'Text', 'js_composer' ),
					'param_name' => 'text',
					'dependency' => array( 'element' => 'services_style', 'value' => array( 'simple', 'modern' ) )
				),
				array(
					'param_name'  => 'button',
					'type'        => 'vc_link',
					'description' => '',
					'heading'     => 'Button',
					'value'       => '',
					'dependency'  => array( 'element' => 'services_style', 'value' => array( 'modern' ) ),
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
					'dependency'  => array( 'element' => 'services_style', 'value' => array( 'modern' ) ),
				),
				array(
					'param_name'  => 'image',
					'type'        => 'attach_image',
					'description' => '',
					'heading'     => 'Image',
					'value'       => '',
					'dependency'  => array( 'element' => 'services_style', 'value' => array( 'modern' ) ),
				),
				array(
					'param_name'  => 'image_position',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Move image to left?',
					'value'       => '',
					'dependency'  => array( 'element' => 'services_style', 'value' => array( 'modern' ) ),
				),
			)
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	/* Frontend Output Shortcode */

	class WPBakeryShortCode_vc_services extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {

			extract( shortcode_atts( array(
				'services_style'    => 'simple',
				'title'             => '',
				'logo'              => '',
				'icon'              => '',
				'icon_color'        => '',
				'icon_second_color' => '',
				'image'             => '',
				'text'              => '',
				'button'            => '',
				'style_button'      => 'creative',
				'image_position'      => '',
			), $atts ) );

			$icon_color        = ! empty( $icon_color ) ? $icon_color : '#0c4fff';
			$icon_second_color = ! empty( $icon_second_color ) ? $icon_second_color : '#c24efe';
			$image_position = $image_position ? ' left' : '';

			ob_start(); ?>

            <?php if ( $services_style == 'simple' ) : ?>
                <div class="services right">
                    <div class="content">
						<?php
						if ( ! empty( $icon ) ) { ?>
                            <i class="<?php echo esc_attr( $icon ); ?>"
                               style="background-image: linear-gradient(127deg, <?php echo $icon_color; ?>, <?php echo $icon_second_color; ?>);"></i>
						<?php } ?>

						<?php if ( ! empty( $title ) ) { ?>
                            <h4 class="title"><?php echo esc_html( $title ); ?></h4>
						<?php }

						if ( ! empty( $text ) ) { ?>
                            <div class="text"><?php echo wp_kses_post( $text ); ?></div>
						<?php } ?>
                    </div>
                </div>
			<?php endif;

			if ( $services_style == 'modern' ) : ?>
                <div class="services-modern <?php echo esc_attr($image_position); ?>">
                    <div class="services-modern__wrapper">
                        <div class="services-modern__content">
                            <div class="services-modern__content-wrap">
	                            <?php if ( ! empty( $logo ) ) :
		                            $logo_src = wp_get_attachment_image_src( $logo, 'full' );
		                            $logo_src = is_array( $logo_src ) ? $logo_src[0] : $logo_src; ?>
                                    <img class="services-modern__logo" src="<?php echo esc_url( $logo_src ); ?>"
                                         alt="<?php echo get_post_meta( $logo_src, '_wp_attachment_image_alt', true ); ?>">
	                            <?php endif; ?>

	                            <?php if ( ! empty( $title ) ) { ?>
                                    <h4 class="services-modern__title"><?php echo esc_html( $title ); ?></h4>
	                            <?php }

	                            if ( ! empty( $text ) ) { ?>
                                    <div class="services-modern__description"><?php echo wp_kses_post( $text ); ?></div>
	                            <?php }

	                            if ( ! empty( $button ) ) {
		                            $vc_link = vc_build_link( $button );
		                            $target  = '_self';
		                            $url     = $vc_link['url'] ? $vc_link['url'] : '#';

		                            if ( ! empty( $vc_link['title'] ) ) { ?>
                                        <a href="<?php echo esc_url( $url ) ?>"
                                           class="a-btn <?php echo esc_attr( $style_button ); ?>"
                                           target="<?php echo esc_attr( $target ); ?>">
                                            <span class="a-btn-line"></span>
				                            <?php echo esc_html( $vc_link['title'] ); ?>
                                        </a>
		                            <?php }
	                            } ?>
                            </div>
                        </div>
                        <div class="services-modern__image">
	                        <?php if ( ! empty( $image ) ) :
		                        $image_src = wp_get_attachment_image_src( $image, 'full' );
		                        $image_src = is_array( $image_src ) ? $image_src[0] : $image_src; ?>
                                <img class="s-img-switch" src="<?php echo esc_url( $image_src ); ?>"
                                     alt="<?php echo get_post_meta( $image_src, '_wp_attachment_image_alt', true ); ?>">
	                        <?php endif; ?>
                        </div>
                    </div>
                </div>
			<?php endif; ?>

			<?php return ob_get_clean();
		}
	}
}
