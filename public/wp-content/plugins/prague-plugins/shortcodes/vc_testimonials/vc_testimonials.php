<?php
/*
 * Testimonials Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0 
 */
if (function_exists('vc_map')) {
	vc_map( 
		array(
			'name'						=> esc_html__( 'Testimonials', 'js_composer' ),
			'base'						=> 'vc_testimonials',
			'as_parent'               => array( 'only' => 'vc_testimonials_items' ),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'params'					=> array ( 
				array (
					'param_name' => 'figure',
					'type' => 'dropdown',
					'description' => '',
					'heading' => 'Figure',
					'value' => array ( 
						esc_html__('None','js_composer') => '', 
						esc_html__('Circle','js_composer') => 'circle', 
						esc_html__('Square','js_composer') => 'square', 
						esc_html__('Oxagon','js_composer') => 'oxagon',
						esc_html__('Triangle','js_composer') => 'triangle', 
					),
				), 
				array (
					'param_name' => 'color_figure',
					'type' => 'colorpicker',
					'description' => '',
					'heading' => 'Color Figure',
					'value' => '',
				), 
				array (
					'param_name' => 'autoplay',
					'type' => 'textfield',
					'description' => '',
					'heading' => 'Autoplay',
					'description' => __( '0 - off autoplay', 'js_composer' ),
					'value' => '',
				),
				array (
					'param_name' => 'speed',
					'type' => 'textfield',
					'description' => '',
					'heading' => 'Speed',
					'description' => __( 'Speed Animation. Default 500 milliseconds', 'js_composer' ),
					'value' => '',
				),
				array (
					'param_name' => 'loop',
					'type' => 'checkbox',
					'description' => '',
					'heading' => 'Loop',
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
	class WPBakeryShortCode_vc_testimonials extends WPBakeryShortCodesContainer {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'figure' => '',
				'color_figure' => '',
				'autoplay' => '3000',
				'speed' => '3000',
				'loop' => '',
				'anable_animate'	=> '',
				'el_class'	=> '',
				'css'	=> '',
			), $atts ) );
			
			$css_classes = array(
			  $this->getExtraClass( $el_class )
			);
			$wrap_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );
			/* get custum css as class*/
			$wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );
			$wrap_class .= !empty( $el_class ) ? ' ' . $el_class : '';

			$color_figure_attr = '';
			if (!empty($color_figure)) {
			  $color_figure_attr = ' style="fill:' . $color_figure . '"';
			} 

			global $vc_testimonials_items;
			$vc_testimonials_items = array();
			
			do_shortcode( $content );

			if ( empty($figure) ) {
			  $wrap_class .= ' no-figure';
			}

			$figures = array(
			    'triangle' => '200,200 200,0 0,200', // triangle
			    'square' => '0,0 200,0 200,200 0,200', // square
			    'oxagon' => '100,0 180,30 200,100 180,180 100,200 30,180 0,100 30,30', // oxagon
			);

			$loop = !empty($loop) ? '1' : '0';

			// start output
			ob_start(); 
			if( !empty($vc_testimonials_items) ): ?>
			<div class="testimonials-wrapper <?php echo esc_attr( $wrap_class ); ?>">
				<div class="testimonials-swiper swiper-container" data-speed='<?php echo esc_attr( $speed ); ?>' data-loop='<?php echo esc_attr( $loop ); ?>' data-autoplay='<?php echo esc_attr( $autoplay ); ?>' data-center='0' data-mode='vertical' data-slides-per-view='1' data-lg-slides='1,0' data-md-slides='1,0' data-sm-slides='1,0' data-xs-slides='1,0'>
				<!-- Additional required wrapper -->
					<div class="swiper-wrapper"> 
					<?php foreach ($vc_testimonials_items as $testimonials_item) { 
						$item = $testimonials_item['atts'];
						if (!empty($item)) : ?>
						<div class="swiper-slide">
							<div class="testimonials-item">

								<?php if (!empty($item['icon'])) { ?>
								<span class="testimonials-icon fa <?php echo esc_attr( $item['icon'] ); ?>"></span>
								<?php } ?>
				
								<?php if (!empty($item['description'])) { ?>
									<blockquote class="testimonials-description"><?php echo wp_kses_post( wpautop( $item['description'] ) ); ?></blockquote>
								<?php } ?>
								<?php if (!empty($item['name'])) { ?>
										<h4 class="testimonials-author"><?php echo esc_html( $item['name'] ); ?></h4>
								<?php } ?>
							</div>
						</div>  
						<?php endif ?> 
					<?php } ?>
					</div>
					<!-- If we need pagination -->
					<div class="testimonials-pagination-wrapper">
						<div class="swiper-pagination"></div>
					</div>
				</div>
				<?php if (!empty($figure)): ?>
				<div class="figures <?php echo esc_attr($figure); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMid meet" >
						<?php if ($figure == 'circle'): ?>
						  <circle cx="100" cy="100" r="100" <?php echo $color_figure_attr; ?> />
						<?php else: ?>
						  <polygon points="<?php echo esc_attr( $figures[$figure] ); ?>" <?php echo $color_figure_attr; ?> />
						<?php endif ?> 
					</svg>
				</div>
				<?php endif; ?> 
			</div>
			<?php endif; 
			// end output
			return ob_get_clean();
		}
	}
}

vc_map( 
	array(
		'name'						=> esc_html__( 'Testimonial Item', 'js_composer' ),
		'base'						=> 'vc_testimonials_items',
		'as_child'               => array( 'only' => 'vc_testimonials' ),
		'content_element' => true,
		'params'					=> array ( 
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Name', 'js_composer' ),
				'param_name' => 'name',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Description', 'js_composer' ),
				'param_name' => 'description',
				'value'      => ''
			),
			array(
				'type'       => 'iconpicker',
				'heading'    => __( 'Icon', 'js_composer' ),
				'param_name' => 'icon',
				'value'      => ''
			),
			
		)
		//end params
	) 
);

class WPBakeryShortCode_vc_testimonials_items extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {
		global $vc_testimonials_items;
		$vc_testimonials_items[] = array( 'atts' => $atts, 'content' => $content );
		return;
	}
}