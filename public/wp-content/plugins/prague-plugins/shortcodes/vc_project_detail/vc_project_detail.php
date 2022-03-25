<?php
/*
 * Project Detail Simple Image Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0 
 */
if (function_exists('vc_map')) {
	vc_map( 
		array(
			'name'						=> esc_html__( 'Project Detail Simple Image', 'js_composer' ),
			'base'						=> 'vc_project_detail',
			'content_element'			=> true,
			'show_settings_on_create'	=> true,
			'description'				=> esc_html__( '', 'js_composer'),
			'params'					=> array ( 
					array (
						'param_name' => 'position',
						'type' => 'dropdown',
						'description' => '',
						'heading' => 'Position Image',
						'value' => array ( 
							esc_html__( 'Top', 'js_composer' ) => '',
							esc_html__( 'Bottom', 'js_composer' ) => 'bottom',
						),
					),
					array (
						'param_name' => 'image',
						'type' => 'attach_image',
						'description' => '',
						'heading' => 'Image',
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
	class WPBakeryShortCode_vc_project_detail extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'position'	=> '',
				'image'	=> '',
				'column_per_row'	=> '',
				'el_class'	=> '',
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
			<div class="project-detail-picture-wrapper <?php echo esc_attr( $wrap_class ); ?>">
					<?php if ( empty($position) || $position != 'bottom' ): ?>
					<?php echo wp_get_attachment_image( $image, 'full' ); ?>
					<?php endif ?>

					<?php if (!empty($content)): ?>
                	<div class="project-detail-picture-descr">
                		<?php echo wpautop( wp_kses_post($content) ); ?>
                	</div>
					<?php endif ?>

					<?php if ( !empty($position) && $position == 'bottom' ): ?>
					<?php echo wp_get_attachment_image( $image, 'full' ); ?>
					<?php endif ?>

			</div>
			<?php
			// end output
			return ob_get_clean();
		}
	}
}
