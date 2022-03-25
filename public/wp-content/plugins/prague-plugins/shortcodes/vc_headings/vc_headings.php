<?php
/*
 * Headings Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0 
 */
if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'                    => esc_html__( 'Headings', 'js_composer' ),
			'base'                    => 'vc_headings',
			'content_element'         => true,
			'show_settings_on_create' => true,
			'description'             => esc_html__( '', 'js_composer' ),
			'params'                  => array(
				array(
					'param_name'  => 'logo',
					'type'        => 'attach_image',
					'description' => '',
					'heading'     => 'Logo',
					'value'       => '',
				),
				array(
					'param_name'  => 'vertical_line',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Add vertical line?',
					'value'       => '',
				),
				array(
					'param_name'  => 'subtitle',
					'type'        => 'textfield',
					'description' => '',
					'heading'     => 'Subtitle',
					'value'       => '',
				),
				array(
					'param_name'  => 'enable_divider',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Enable divider',
					'value'       => '',
				),
				array(
					'param_name'  => 'title',
					'type'        => 'textarea',
					'description' => '',
					'heading'     => 'Title',
					'value'       => '',
				),
				array(
					'param_name'  => 'content_divider',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Content divider',
					'value'       => '',
				),
				array(
					'param_name'  => 'content',
					'type'        => 'textarea_html',
					'description' => '',
					'heading'     => 'Content',
					'value'       => '',
				),
				array(
					'param_name'  => 'align',
					'type'        => 'dropdown',
					'description' => '',
					'heading'     => 'Align',
					'value'       => array(
						esc_html__( 'Left', 'left' ),
						esc_html__( 'Center', 'center' ),
						esc_html__( 'Right', 'right' )
					),
				),
				array(
					'param_name'  => 'color_style',
					'type'        => 'dropdown',
					'description' => '',
					'heading'     => 'Color style',
					'value'       => array(
						'Default (Dark)' => 'dark',
						'Light'          => 'light',
					),
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Extra class name',
					'param_name'  => 'el_class',
					'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.',
					'value'       => '',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => 'CSS box',
					'param_name' => 'css',
					'group'      => 'Design options',
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
			)
			//end params
		)
	);
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	/* Frontend Output Shortcode */

	class WPBakeryShortCode_vc_headings extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'logo'            => '',
				'vertical_line'   => '',
				'subtitle'        => '',
				'enable_divider'  => '',
				'color_style'     => 'dark',
				'title'           => '',
				'content_divider' => '',
				'align'           => 'left',
				'el_class'        => '',
				'css'             => '',
				'button'          => '',
				'style_button'    => 'creative',
				'color_button'    => 'light',

			), $atts ) );

			$css_classes = array(
				$this->getExtraClass( $el_class )
			);
			$wrap_class  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );
			/* get custum css as class*/
			$wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );
			$wrap_class .= ! empty( $el_class ) ? ' ' . $el_class : '';

			$wrap_class .= ! empty( $align ) ? ' ' . $align : '';

			$vertical_line =  isset($vertical_line) && ! empty($vertical_line) ? ' vertical_line' : '';

			if ( ! empty( $color_style ) ) {
				$wrap_class .= ' ' . esc_attr( $color_style );
			}

			// start output
			ob_start();
			?>
            <section class="heading <?php echo esc_attr( $wrap_class . ' ' . $vertical_line ); ?>">
				<?php if ( ! empty( $logo ) ) :
					$logo_src = wp_get_attachment_image_src( $logo, 'full' );
					$logo_src = is_array( $logo_src ) ? $logo_src[0] : $logo_src; ?>
                    <img src="<?php echo esc_url( $logo_src ); ?>"
                         alt="<?php echo get_post_meta( $logo_src, '_wp_attachment_image_alt', true ); ?>">
				<?php endif; ?>

				<?php if ( ! empty( $subtitle ) ) : ?>
                    <div
                    class="subtitle <?php if ( ! empty( $enable_divider ) ) : ?>divider<?php endif; ?>"><?php echo esc_html( $subtitle ); ?></div><?php endif; ?>
				<?php if ( ! empty( $title ) ) : ?><h2
                        class="title"><?php echo wp_kses_post( $title ); ?></h2><?php endif; ?>
				<?php if ( ! empty( $content ) ) : ?>
                <div class="content <?php if ( ! empty( $content_divider ) ) : ?>divider-content<?php endif; ?>">
                    <p><?php echo wp_kses_post( $content ); ?></p></div><?php endif; ?>

				<?php if ( ! empty( $button ) ) {
					$vc_link = vc_build_link( $button );
					$target  = '_self';
					$url     = $vc_link['url'] ? $vc_link['url'] : '#';

					if ( ! empty( $vc_link['title'] ) ) { ?>
                        <a href="<?php echo esc_url( $url ) ?>"
                           class="a-btn <?php echo esc_attr( $color_button . ' ' . $style_button ); ?>"
                           target="<?php echo esc_attr( $target ); ?>">
                            <span class="a-btn-line"></span>
							<?php echo esc_html( $vc_link['title'] ); ?>
                        </a>
					<?php }
				} ?>

            </section>
			<?php
			// end output
			return ob_get_clean();
		}
	}
}
