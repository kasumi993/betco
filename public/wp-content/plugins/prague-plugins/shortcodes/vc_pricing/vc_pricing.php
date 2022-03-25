<?php
/*
 * Pricing Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0 
 */
if (function_exists('vc_map')) {
	vc_map( 
		array(
			'name'						=> esc_html__( 'Pricing', 'js_composer' ),
			'base'						=> 'vc_pricing',
			'content_element'			=> true,
			'show_settings_on_create'	=> true,
			'description'				=> esc_html__( '', 'js_composer'),
			'params'					=> array ( 
					array (
						'param_name' => 'style',
						'type' => 'dropdown',
						'description' => '',
						'heading' => 'Style',
						'value' => array ( 
							esc_html__( 'Simple', 'js_composer' ) => 'simple',
							esc_html__( 'Featured Image', 'js_composer' ) => 'featured_image',
						),
					), 
					array (
						'param_name' => 'image',
						'type' => 'attach_image',
						'description' => '',
						'heading' => 'Image',
						'value' => '',
						'dependency' => array( 'element' => 'style', 'value' => 'featured_image' ),
					), 
					array (
						'param_name' => 'subtitle',
						'type' => 'textfield',
						'description' => '',
						'heading' => 'Subtitle',
						'value' => '',
					), 
					array (
						'param_name' => 'price',
						'type' => 'textfield',
						'description' => '',
						'heading' => 'Price',
						'value' => '',
					), 
					array (
						'param_name' => 'title',
						'type' => 'textfield',
						'description' => '',
						'heading' => 'Title',
						'value' => '',
					), 
					array (
						'param_name' => 'content',
						'type' => 'textarea_html',
						'description' => '',
						'heading' => 'Description',
						'value' => '',
					), 
					array (
						'param_name' => 'button',
						'type' => 'vc_link',
						'description' => '',
						'heading' => 'Button',
						'value' => '',
					), 
					array (
						'param_name' => 'button_style',
						'type' => 'params_preset',
						'description' => '',
						'heading' => 'Button Style',
						'options' => array(
							array(
								'label' => __( 'Simple', 'js_composer' ),
								'value' => 'simple',
								'params' => array(
									'button_link_class' => 'prague-pricing-link a-btn-2 simple',
									'button_span_class' => 'a-btn-line',
								),
							),
							array(
								'label' => __( 'Creative', 'js_composer' ),
								'value' => 'creative',
								'params' => array(
									'button_link_class' => 'prague-pricing-link a-btn-2 creative',
									'button_span_class' => 'a-btn-line',
								),
							),
							array(
								'label' => __( 'Arrow', 'js_composer' ),
								'value' => 'arrow',
								'params' => array(
									'button_link_class' => 'prague-pricing-link a-btn-arrow-2',
									'button_span_class' => 'arrow-right',
								),
							),
						),
						'param_holder_class' => 'vc_message-type vc_colored-dropdown',
					), 
					array (
						'type' => 'hidden',
						'param_name' => 'button_link_class',
					),
					array (
						'type' => 'hidden',
						'param_name' => 'button_span_class',
					),
					array (
						'type' => 'textfield',
						'heading' => 'Extra class name',
						'param_name' => 'el_class',
						'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.',
						'value' => '',
					), 
					array (
						'type' => 'css_editor',
						'heading' => 'CSS box',
						'param_name' => 'css',
						'group' => 'Design options',
					),
			)
			//end params
		) 
	);
}
if (class_exists('WPBakeryShortCode')) {
	/* Frontend Output Shortcode */
	class WPBakeryShortCode_vc_pricing extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'style'	=> 'simple',
				'image'	=> '',
				'subtitle'	=> '',
				'price'	=> '',
				'title'	=> '',
				'button'  => '',
				'button_style'	=> '',
				'el_class'	=> '',
				'button_link_class' => 'prague-pricing-link a-btn-2 simple',
				'button_span_class' => 'a-btn-line',
				'css'	=> '',
			
			), $atts ) );

			/* get param class */
			$css_classes = array(
				$this->getExtraClass( $el_class )
			);
			$wrap_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );

			$wrap_class  = !empty( $el_class ) ? $el_class : '';
			/* get custum css as class*/
			$wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );

			if (!empty($style)) {
				$wrap_class .= ' ' . $style;
			}
			
			// start output
			ob_start(); ?>
			<div class="prague-pricing-wrapper <?php echo esc_attr( $wrap_class ); ?>">
					<?php if(!empty($style) && $style == "featured_image" && !empty($image)) : ?>
					<div class="pricing-img-wrapp">
						<?php $image_src = wp_get_attachment_image_src( $image, 'full' );
						$image_src = is_array($image_src) ? $image_src[0] : $image_src; 
						?>
                        <img class="s-img-switch" src="<?php echo esc_url($image_src );?>"  alt="<?php echo get_post_meta( $image, '_wp_attachment_image_alt', true); ?>">
                    </div>
                	<?php endif; ?>
					<div class="prague-pricing-content-wrapper">
							
							<?php if (!empty($subtitle)): ?>
							<div class="prague-pricing-subtitle">
									<?php echo esc_html($subtitle); ?>
							</div>
							<?php endif ?>

							<?php if (!empty($price)): ?>
							<h3 class="prague-pricing-price">
								<?php echo esc_html($price); ?>
							</h3>
							<?php endif ?>

							<?php if (!empty($title)): ?>
							<h3 class="prague-pricing-title">
								<?php echo esc_html($title); ?>
							</h3>
							<?php endif ?>

							<?php if (!empty($content)): ?>
							<div class="prague-pricing-description">
							<?php echo wpautop( wp_kses_post($content) ); ?>
							</div>
							<?php endif ?>

							<?php if(!empty($button)) :

								$vc_link = vc_build_link( $button ); 

								$target = ''; 
								if ( !empty( $vc_link['target'] ) ) {
									$target = ' target="' . esc_attr( $vc_link['target'] ) . '"'; 
								} 

								$rel = '';
								if ( !empty( $vc_link['rel'] ) ) { 	
									$rel = ' rel="' . esc_attr( trim($vc_link['rel']) ) . '"'; 
								} 
								
								if (!empty($vc_link['url'])) :

									if ( empty($vc_link['title'])) {
										$vc_link['title'] = 'label';
									}
									?>
									<a  class="<?php echo esc_attr( $button_link_class ); ?>" 
										href="<?php echo esc_url($vc_link['url']) ?>" 
										<?php echo $target; ?> 
										<?php echo $rel; ?> >
										<span class="<?php echo esc_attr( $button_span_class ); ?>"></span>
										<?php echo esc_html( $vc_link['title'] ); ?>
									</a><?php 
								endif; 

							endif; ?>
					</div>
			</div>
			<?php
			// end output
			return ob_get_clean();
		}
	}
}
