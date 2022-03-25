<?php
/*
 * Prague Wrapper Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0 
 */
if (function_exists('vc_map')) {
	vc_map( 
		array(
			'name'						=> esc_html__( 'Prague Wrapper', 'js_composer' ),
			'base'						=> 'vc_wrapper',
			'as_parent'               => array( 'only' => 'vc_row, vc_clients, vc_projects_posts' ),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'params'					=> array ( 
				  array (
				    'param_name' => 'title',
				    'type' => 'textfield',
				    'description' => '',
				    'heading' => 'Title',
				    'value' => '',
				  ),
				  array (
				    'param_name' => 'subtitle',
				    'type' => 'textfield',
				    'description' => '',
				    'heading' => 'Subtitle',
				    'value' => '',
				  ),
				  array(
				      'param_name'  => 'image',
				      'type'        => 'attach_image',
				      'description' => '',
				      'heading'     => 'Background Image',
				      'value'       => '',
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
				  array (
				    'param_name' => 'enable_divider',
				    'type' => 'checkbox',
				    'description' => '',
				    'heading' => 'Enable divider',
				    'value' => '',
				  ), 
				  array (
				    'param_name' => 'align',
				    'type' => 'dropdown',
				    'description' => '',
				    'heading' => 'Align',
				    'value' => 
				      array (
				        esc_html__('Left', 'left'),
				        esc_html__('Center', 'center')
				      ),
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
	class WPBakeryShortCode_vc_wrapper extends WPBakeryShortCodesContainer {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'title'		=> '',
				'subtitle'	=> '',
				'image'		=> '',
				'align'		=> 'left',
				'enable_divider'		=> '',
				'color_style'       => 'dark',
				'el_class'	=> '',
				'css'		=> '',
			
			), $atts ) );
			
			$css_classes = array(
			  $this->getExtraClass( $el_class )
			);
			$wrap_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );
			/* get custum css as class*/
			$wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );
			$wrap_class .= !empty( $el_class ) ? ' ' . $el_class : '';

			$wrapper_title = '';
			if (!empty($color_style)){
			  $wrapper_title .= ' ' . esc_attr($color_style);
			}

			$wrapper_title .= !empty($align) ? ' ' . $align : '';

			// start output
			ob_start(); ?>
			<div class="prague-shortcode-parent <?php echo esc_attr( $wrap_class ); ?>">
				<div class="prague-shortcode-parent-img">
					<span class="overlay"></span>
					<?php 
					$attachment = get_post( $image );
					$post_excerpt = !empty($attachment->post_excerpt) ? $attachment->post_excerpt : '';
					echo prague_lazy_load_image( $image,
						array(
						  'class' => 's-img-switch',
						  'alt'   => $post_excerpt
						)
					);
					?> 
				</div>
				
				<div class="prague-shortcode-content-wrapp">
					<div class="prague-shortcode-heading <?php echo esc_attr( $wrapper_title ); ?>">
						<?php if (!empty($subtitle)): ?>
							<div class="parent-subtitle <?php if(!empty($enable_divider)) : ?>divider<?php endif; ?>"><?php echo esc_html( $subtitle ); ?></div class="subtitle">
						<?php endif ?>

						<?php if (!empty($title)): ?>
							<h2 class="parent-title"><?php echo esc_html( $title ); ?></h2>
						<?php endif ?>
					</div>
				
					<?php if (!empty($content)) : ?>
						<?php echo do_shortcode( $content ); ?>
					<?php endif ?>
				</div>
				
			</div>
			<?php 
			// end output
			return ob_get_clean();
		}
	}
}