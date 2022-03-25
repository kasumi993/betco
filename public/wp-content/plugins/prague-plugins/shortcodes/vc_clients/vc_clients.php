<?php
/*
 * Clients Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0 
 */
if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'                    => esc_html__( 'Clients', 'js_composer' ),
			'base'                    => 'vc_clients',
			'content_element'         => true,
			'show_settings_on_create' => true,
			'description'             => esc_html__( '', 'js_composer' ),
			'params'                  => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Clients style', 'js_composer' ),
					'description' => esc_html__( 'Please select main style', 'js_composer' ),
					'param_name'  => 'clients_style',
					'value'       => array(
						array(
							'value' => 'default_style',
							'label' => esc_html__( 'Default', 'js_composer' ),
						),
						array(
							'value' => 'image_style',
							'label' => esc_html__( 'Image style', 'js_composer' ),
						),
						array(
							'value' => 'text_style',
							'label' => esc_html__( 'Text style', 'js_composer' ),
						),
					)
				),
				array(
					'param_name'  => 'image',
					'type'        => 'attach_image',
					'description' => '',
					'heading'     => 'Image',
					'value'       => '',
					'dependency'  => array( 'element' => 'clients_style', 'value' => array( 'default_style' ) ),
				),
				array(
					'param_name'  => 'link',
					'type'        => 'vc_link',
					'description' => '',
					'heading'     => 'Link',
					'value'       => '',
					'dependency'  => array( 'element' => 'clients_style', 'value' => array( 'default_style' ) ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Extra class name',
					'param_name'  => 'el_class',
					'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.',
					'value'       => '',
					'dependency'  => array( 'element' => 'clients_style', 'value' => array( 'default_style' ) ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => 'CSS box',
					'param_name' => 'css',
					'group'      => 'Design options',
					'dependency' => array( 'element' => 'clients_style', 'value' => array( 'default_style' ) ),
				),
				array(
					'param_name'  => 'light',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Enable light style?',
					'value'       => '',
					'dependency'  => array( 'element' => 'clients_style', 'value' => array( 'text_style' ) ),
				),
				array(
					'param_name'  => 'border_bottom',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Enable border bottom?',
					'value'       => '',
					'dependency'  => array( 'element' => 'clients_style', 'value' => array( 'text_style' ) ),
				),
				array(
					'type'        => 'param_group',
					'heading'     => esc_html__( 'Client Item', 'js_composer' ),
					'description' => esc_html__( 'Please add information about client', 'js_composer' ),
					'param_name'  => 'image_client_item',
					'value'       => '',
					'dependency'  => array( 'element' => 'clients_style', 'value' => array( 'image_style' ) ),
					'params'      => array(
						array(
							'type'       => 'attach_image',
							'heading'    => 'Item image',
							'param_name' => 'image',
						),
						array(
							'param_name'  => 'link',
							'type'        => 'textfield',
							'description' => '',
							'heading'     => 'Link',
							'value'       => '',
						),
					),
				),
				array(
					'type'        => 'param_group',
					'heading'     => esc_html__( 'Client Item', 'js_composer' ),
					'description' => esc_html__( 'Please add information about client', 'js_composer' ),
					'param_name'  => 'text_client_item',
					'value'       => '',
					'dependency'  => array( 'element' => 'clients_style', 'value' => array( 'text_style' ) ),
					'params'      => array(
						array(
							'param_name'  => 'client_name',
							'type'        => 'textfield',
							'description' => '',
							'heading'     => 'Client name',
							'value'       => '',
						),
						array(
							'param_name'  => 'link',
							'type'        => 'textfield',
							'description' => '',
							'heading'     => 'Link',
							'value'       => '',
						),
					),
				),
			)
			//end params
		)
	);
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	/* Frontend Output Shortcode */

	class WPBakeryShortCode_vc_clients extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'clients_style'     => 'default_style',
				'image'             => '',
				'link'              => '',
				'light'             => '',
				'border_bottom'     => '',
				'el_class'          => '',
				'css'               => '',
				'image_client_item' => array(),
				'text_client_item'  => array(),

			), $atts ) );

			$css_classes = array(
				$this->getExtraClass( $el_class )
			);
			$wrap_class  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );

			/* get param class */
			$wrap_class = ! empty( $el_class ) ? $el_class : '';
			/* get custum css as class*/
			$wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );
			$light      = isset( $light ) && ! empty( $light ) ? ' light' : '';
			$border_bottom      = isset( $border_bottom ) && ! empty( $border_bottom ) ? ' border_bottom' : '';

			// start output
			ob_start();

			if ( $clients_style == 'default_style' ) : ?>
                <div class="prague-clients-wrapper <?php echo esc_attr( $wrap_class ); ?>">
					<?php if ( ! empty( $image ) ): ?>
						<?php
						$image_src = wp_get_attachment_image_src( $image, 'full' );
						$image_src = is_array( $image_src ) ? $image_src[0] : $image_src; ?>
                        <img class="prague-clients-logo" src="<?php echo esc_url( $image_src ); ?>"
                             alt="<?php echo get_post_meta( $image, '_wp_attachment_image_alt', true ); ?>">
					<?php endif; ?>
                    <div class="prague-clients-overlay"></div>
					<?php if ( ! empty( $link ) ) {

						$vc_link = vc_build_link( $link );

						$target = '';
						if ( ! empty( $vc_link['target'] ) ) {
							$target = ' target="' . esc_attr( trim( $vc_link['target'] ) ) . '"';
						}

						$rel = '';
						if ( ! empty( $vc_link['rel'] ) ) {
							$rel = ' rel="' . esc_attr( trim( $vc_link['rel'] ) ) . '"';
						}

						if ( ! empty( $vc_link['url'] ) ) {

							if ( empty( $vc_link['title'] ) ) {
								$vc_link['title'] = 'label';
							}
							?>
                            <div class="vertical-align prague-clients-link">
                                <a href="<?php echo esc_url( $vc_link['url'] ) ?>"
                                   class="prague-clients-name a-btn-arrow" <?php echo $target; ?> <?php echo $rel; ?>>
									<?php echo esc_html( $vc_link['title'] ); ?>
                                    <span class="arrow-right grey"></span>
                                </a>
                            </div>
						<?php }
					} ?>
                </div>
			<?php endif;

			if ( $clients_style == 'image_style' ) : ?>
                <div class="image-clients">
					<?php if ( ! empty( $image_client_item ) ) :
						$image_client_item = (array) vc_param_group_parse_atts( $image_client_item ); ?>
                        <div class="image-clients__wrapper">
							<?php foreach ( $image_client_item as $client ) : ?>
                                <div class="image-clients__item">
									<?php if ( ! empty( $client['link'] ) ) : ?>
                                        <a href="<?php echo esc_url( $client['link'] ); ?>"
                                           class="image-clients__item-inner">
											<?php if ( ! empty( $client['image'] ) ) :
												$image_src = wp_get_attachment_image_src( $client['image'], 'full' );
												$image_src = is_array( $image_src ) ? $image_src[0] : $image_src; ?>
                                                <img class="image-clients__item-img"
                                                     src="<?php echo esc_url( $image_src ); ?>"
                                                     alt="<?php echo get_post_meta( $client['image'], '_wp_attachment_image_alt', true ); ?>">
											<?php endif; ?>
                                        </a>
									<?php else : ?>
                                        <div class="image-clients__item-inner">
											<?php if ( ! empty( $client['image'] ) ) :
												$image_src = wp_get_attachment_image_src( $client['image'], 'full' );
												$image_src = is_array( $image_src ) ? $image_src[0] : $image_src; ?>
                                                <img class="image-clients__item-img"
                                                     src="<?php echo esc_url( $image_src ); ?>"
                                                     alt="<?php echo get_post_meta( $client['image'], '_wp_attachment_image_alt', true ); ?>">
											<?php endif; ?>
                                        </div>
									<?php endif; ?>
                                </div>
							<?php endforeach; ?>
                        </div>
					<?php endif; ?>
                </div>
			<?php endif;

			if ( $clients_style == 'text_style' ) : ?>
                <div class="text-clients <?php echo esc_attr( $light . ' ' . $border_bottom ); ?>">
					<?php if ( ! empty( $text_client_item ) ) :
						$text_client_item = (array) vc_param_group_parse_atts( $text_client_item ); ?>
                        <ul class="text-clients__wrapper">
							<?php foreach ( $text_client_item as $client ) : ?>
                                <li class="text-clients__item">
									<?php if ( ! empty( $client['link'] ) && ! empty( $client['client_name'] ) ) : ?>
                                        <a href="<?php echo esc_url( $client['link'] ); ?>"
                                           class="text-clients__item-inner"><?php echo esc_html( $client['client_name'] ); ?></a>
									<?php elseif ( ! empty( $client['client_name'] ) ) : ?>
                                        <span class="text-clients__item-inner"><?php echo esc_html( $client['client_name'] ); ?></span>
									<?php endif; ?>
                                </li>
							<?php endforeach; ?>
                        </ul>
					<?php endif; ?>
                </div>
			<?php endif;

			// end output
			return ob_get_clean();
		}
	}
}
