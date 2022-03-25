<?php

//About shortcode

if ( function_exists( 'vc_map' ) ) {

	vc_map(
		array(
			'name'        => esc_html__( 'About', 'js_composer' ),
			'base'        => 'vc_about',
			'description' => __( 'Section with image, text and button', 'js_composer' ),
			'category'    => __( 'Content', 'js_composer' ),
			'params'      => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'About style', 'js_composer' ),
					'description' => esc_html__( 'Please select main style', 'js_composer' ),
					'param_name'  => 'about_style',
					'value'       => array(
						array(
							'value' => 'classic',
							'label' => esc_html__( 'Classic', 'js_composer' ),
						),
						array(
							'value' => 'modern',
							'label' => esc_html__( 'Modern', 'js_composer' ),
						),
					)
				),
				array(
					'type'       => 'attach_image',
					'heading'    => __( 'Person image', 'js_composer' ),
					'param_name' => 'image',
					'dependency' => array( 'element' => 'about_style', 'value' => array( 'classic' ) )
				),
				array(
					'type'       => 'textarea',
					'heading'    => __( 'Title', 'js_composer' ),
					'param_name' => 'title',
					'dependency' => array( 'element' => 'about_style', 'value' => array( 'classic', 'modern' ) )
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Subtitle', 'js_composer' ),
					'param_name' => 'subtitle',
					'dependency' => array( 'element' => 'about_style', 'value' => array( 'classic', 'modern' ) )
				),
				array(
					'type'       => 'textarea',
					'heading'    => __( 'Description', 'js_composer' ),
					'param_name' => 'desc',
					'dependency' => array( 'element' => 'about_style', 'value' => array( 'modern' ) )
				),
				array(
					'type'       => 'attach_image',
					'heading'    => __( 'Main image', 'js_composer' ),
					'param_name' => 'main_image',
					'dependency' => array( 'element' => 'about_style', 'value' => array( 'modern' ) )
				),
				array(
					'type'       => 'attach_image',
					'heading'    => __( 'Secondary image', 'js_composer' ),
					'param_name' => 'secondary_image',
					'dependency' => array( 'element' => 'about_style', 'value' => array( 'modern' ) )
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Color Word', 'js_composer' ),
					'param_name' => 'grad_word',
					'dependency' => array( 'element' => 'about_style', 'value' => array( 'classic' ) )
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Color Text', 'js_composer' ),
					'param_name' => 'grad_text',
					'dependency' => array( 'element' => 'about_style', 'value' => array( 'classic' ) )
				),
				array(
					'type'       => 'vc_link',
					'heading'    => __( 'Button', 'js_composer' ),
					'param_name' => 'button',
					'dependency' => array( 'element' => 'about_style', 'value' => array( 'classic' ) )
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Button style', 'js_composer' ),
					'param_name'  => 'btn_style',
					'dependency'  => array( 'element' => 'about_style', 'value' => array( 'classic' ) ),
					'value'       => array(
						array(
							'value' => 'a-btn-line',
							'label' => esc_html__( 'Creative Light', 'js_composer' ),
						),
						array(
							'value' => 'a-btn-line dark',
							'label' => esc_html__( 'Creative Dark', 'js_composer' ),
						),
						array(
							'value' => 'arrow-right',
							'label' => esc_html__( 'Arrow Right', 'js_composer' ),
						),
					),
					'admin_label' => true,
					'save_always' => true,
				),
			),
//end params
		)
	);
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	/* Frontend Output Shortcode */

	class WPBakeryShortCode_vc_about extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'about_style'     => 'classic',
				'title'           => '',
				'desc'            => '',
				'main_image'      => '',
				'secondary_image' => '',
				'btn_style'       => '',
				'grad_text'       => '',
				'grad_word'       => '',
				'image'           => '',
				'subtitle'        => '',
				'button'          => '',
				'slider_items'    => array(),

			), $atts ) );

			$btn_style = isset( $btn_style ) && ! empty( $btn_style ) ? $btn_style : 'a-btn';
			$url       = ( ! empty( $image ) && is_numeric( $image ) ) ? wp_get_attachment_url( $image ) : '';
			$main_image_url       = ( ! empty( $main_image ) && is_numeric( $main_image ) ) ? wp_get_attachment_url( $main_image ) : '';
			$secondary_image_url       = ( ! empty( $secondary_image ) && is_numeric( $secondary_image ) ) ? wp_get_attachment_url( $secondary_image ) : '';

			// start output
			ob_start();

			$button_parent = esc_attr( $btn_style ) == 'a-btn-line dark' ? 'a-btn-2' : 'a-btn';
			$button_parent = esc_attr( $btn_style ) == 'arrow-right' ? 'a-btn-arrow-2' : $button_parent; ?>

            <?php if ( $about_style == 'classic' ) { ?>
                <div class="container">
                    <div class="row">
                        <div class="about-section-classic">
                            <div class="about-section__img">
								<?php if ( ! empty( $url ) ) { ?>
                                    <img src="<?php echo esc_url( $url ); ?>" class="s-img-switch" alt="">
								<?php } // end if ?>
								<?php if ( ! empty( $grad_word ) ) { ?>
                                    <span class="grad-word"><?php echo wp_kses_post( $grad_word ); ?></span>
								<?php } ?>
                            </div>
                            <div class="content">
								<?php if ( ! empty( $subtitle ) ) { ?>
                                    <div class="subtitle"><?php echo wp_kses_post( $subtitle ); ?></div>
								<?php }
								if ( ! empty( $title ) ) { ?>
                                    <h2 class="title"><?php echo wp_kses_post( $title ); ?></h2>
								<?php }
								if ( ! empty( $grad_text ) ) { ?>
                                    <span class="grad-text"><?php echo wp_kses_post( $grad_text ); ?></span>
								<?php }
								if ( ! empty( $button ) ) {
									$url = vc_build_link( $button );
								} else {
									$url['url']    = '#';
									$url['title']  = 'title';
									$url['target'] = '_self';
								}
								if ( ! empty( $button ) ) { ?>
                                    <div class="but-wrap">
                                        <a href="<?php echo esc_attr( $url['url'] ); ?>"
                                           class="<?php echo esc_attr( $button_parent ); ?>  creative anima"
                                           target="<?php echo esc_attr( $url['target'] ); ?>">
											<?php echo wp_kses_post( $url['title'] ); ?>
                                            <span class="<?php echo esc_attr( $btn_style ) ?>"></span>

                                        </a>
                                    </div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php } ?>

			<?php if ( $about_style == 'modern' ) { ?>
                <div class="about-modern">
                    <?php if ( !empty($main_image) ){ ?>
                        <div class="about-modern__main-image">
                            <img src="<?php echo esc_url($main_image_url);?>" alt="" class="s-img-switch">
                        </div>
                    <?php } ?>

	                <?php if ( !empty($title) || !empty($subtitle) || !empty($desc) ){ ?>
                        <div class="about-modern__info">
	                        <?php if ( !empty($subtitle) ){ ?>
                                <div class="about-modern__info-subtitle"><?php echo esc_html($subtitle);?></div>
	                        <?php }

	                        if ( !empty($title) ){ ?>
                                <h2 class="about-modern__info-title"><?php echo esc_html($title);?></h2>
	                        <?php }

	                        if ( !empty($desc) ){ ?>
                                <div class="about-modern__info-desc"><?php echo wp_kses_post($desc);?></div>
	                        <?php } ?>
                        </div>
	                <?php } ?>

	                <?php if ( !empty($secondary_image) ){ ?>
                        <div class="about-modern__secondary-image">
                            <img src="<?php echo esc_url($secondary_image_url);?>" alt="" class="s-img-switch">
                        </div>
	                <?php } ?>
                </div>
			<?php } ?>

			<?php
			return ob_get_clean();
		}
	}
}