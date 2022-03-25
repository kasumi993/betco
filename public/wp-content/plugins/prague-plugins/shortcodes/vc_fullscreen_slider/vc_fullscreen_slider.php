<?php
/*
 * Fullscreen slider Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */
if (function_exists('vc_map')) {
	vc_map(
		array(
			'name'						=> esc_html__( 'Slider', 'js_composer' ),
			'base'						=> 'vc_fullscreen_slider',
			'content_element'			=> true,
			'show_settings_on_create'	=> true,
			'description'				=> esc_html__( '', 'js_composer'),
			'params'					=> array (
				array(
					'param_name' => 'style',
					'type' => 'dropdown',
					'description' => '',
					'heading' => 'Style',
					'value' => array(
						'Fullscreen modern slider' => 'fullscreen',
						'Classic slider' => 'classic',
						'Modern slider' => 'modern_slider',
					),
				),
				array (
					'param_name' => 'images',
					'type' => 'attach_images',
					'heading' => 'Images',
					'value' => '',
				),
				array (
					'param_name' => 'subtitle',
					'type' => 'textfield',
					'heading' => 'Subtitle',
					'value' => '',
					'dependency'  => array( 'element' => 'style', 'value' => 'fullscreen' )
				),
				array (
					'param_name' => 'title',
					'type' => 'textfield',
					'heading' => 'Title',
					'value' => '', 
					'dependency'  => array( 'element' => 'style', 'value' => 'fullscreen' )
				),
				array (
					'param_name' => 'text',
					'type' => 'textarea',
					'heading' => 'Text',
					'value' => '',
					'dependency'  => array( 'element' => 'style', 'value' => 'fullscreen' )
				),
                array(
                    'param_name'  => 'arrows',
                    'type'        => 'dropdown',
                    'heading'     => 'Arrows',
                    'value'       => array(
                        'Off'   => 'off',
                        'On'    => 'on',
                    ),
                ),
                array(
                    'param_name'  => 'slide_speed',
                    'type'        => 'textfield',
                    'heading'     => 'Slide Speed',
                    'value'       => '6000',
	                'description' => __( 'Only number. Default 6000 milliseconds', 'js_composer' ),
                ),
                array(
                    'param_name'  => 'autoplay',
                    'type'        => 'dropdown',
                    'heading'     => 'AutoPlay',
                    'value'       => array(
                        'Off'   => 'off',
                        'On'    => 'on',
					),
					'dependency'  => array( 'element' => 'style', 'value_not_equal_to' => 'modern_slider' )
                ),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Count slides', 'js_composer' ),
					'param_name'  => 'slides',
					'description' => __( 'Only numbers. Minimum 2.', 'js_composer' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'full_showcase_slider' )
					)
				),
                array(
                    'param_name'  => 'autoplay_speed',
                    'type'        => 'textfield',
                    'heading'     => 'AutoPlay Speed',
	                'value'       => '1000',
                    'dependency'  => array('element' => 'autoplay', 'value' => array('on')),
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
	class WPBakeryShortCode_vc_fullscreen_slider extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'style'                => 'fullscreen',
				'images'	           => '',
				'title'	               => '',
				'subtitle'	           => '',
				'text'	               => '',
				'arrows'               => 'off',
				'slide_speed'          => '6000',
				'autoplay'             => 'off',
				'autoplay_speed'       => '1000',
				'el_class'	           => '',
				'css'	               => '',
				'slides'               => '4',

			), $atts ) );

            $arrows = ( ! empty( $arrows ) && $arrows === 'on' ) ? 1 : 0;
            $slide_speed = is_numeric( $slide_speed ) ? $slide_speed : '1000';
            $autoplay = ( ! empty( $autoplay ) && $autoplay === 'on' ) ? 1 : 0;
            $autoplay_speed = is_numeric( $autoplay_speed ) ? $autoplay_speed : '5000';

			$css_classes = array(
				$this->getExtraClass( $el_class )
			);

			$wrap_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );

			/* get param class */
			$wrap_class  = !empty( $el_class ) ? $el_class : '';
			/* get custum css as class*/
			$wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );

			// start output
			ob_start();


			// base args
			$args = array(
				'post_type'      => 'project',
				'posts_per_page' => ( ! empty( $count ) && is_numeric( $count ) ) ? $count : 9,
				'paged'          => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1
			);

			// Order posts
			if ( null !== $orderby ) {
				$args['orderby'] = $orderby;
			}
			$args['order'] = $order;

			// category
			if ( ! empty( $cats ) ) {
				$term_slugs        = explode( ',', $cats );
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'project-category',
						'field'    => 'slug',
						'terms'    => $term_slugs,
					)
				);
			}

			wp_localize_script(
				'tur-main',
				'project_load',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
				)
			);

			ob_start();

			if($style == 'fullscreen'){ ?>

				<div class="project-detail-fullscreen <?php echo esc_attr($wrap_class); ?>">
					<?php if (!empty($images)):
						$images = explode(',', $images);  ?>
						<div class="project-detail-full-main slick-slider" data-key="1" data-arrows="<?php echo esc_attr( $arrows ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-speed="<?php echo esc_attr( $slide_speed ); ?>" data-autoplay-speed="0" data-fade="1" data-for=".project-detail-full-thumb" data-width="0" data-slides="1">

							<?php foreach ($images as $key => $image) : ?>
								<div class="project-detail-main-slide slick-slide">
									<?php echo wp_get_attachment_image( $image, 'full', false, array('class'=>'s-img-switch') ); ?>
								</div>
							<?php endforeach; ?>

						</div>
					<?php endif; ?>

					<div class="project-detail-full-overlay">

						<div class="pulse1"></div>
						<div class="pulse2"></div>
						<div class="icon"></div>
					</div>

					<div class="project-detail-full-thumb slick-slider" data-key="1" data-arrows="0" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-speed="<?php echo esc_attr( $slide_speed ); ?>" data-autoplay-speed="<?php echo esc_attr( $autoplay_speed ); ?>" data-for=".project-detail-full-main" data-width="0" data-focus="1" data-slides="5">
						<?php foreach ($images as $key => $image) : ?>
							<div class="project-detail-main-slide slick-slide">
								<?php echo wp_get_attachment_image( $image, 'middle', false, array('class'=>'s-img-switch') ); ?>
							</div>
						<?php endforeach; ?>
					</div>
					<?php if (!empty($title) || !empty($subtitle) || !empty($text)): ?>
						<div class="project-detail-fullscreen-content">

							<?php if (!empty($subtitle)): ?>
								<h6 class="project-detail-fullscreen-content-subtitle"><?php echo esc_html($subtitle); ?></h6>
							<?php endif ?>

							<?php if (!empty($title)): ?>
								<h2 class="project-detail-fullscreen-content-title"><?php echo esc_html($title); ?></h2>
							<?php endif ?>

							<?php if ( !empty($text)): ?>
								<div class="project-detail-fullscreen-content-descr">
									<?php echo wpautop($text); ?>
								</div>
							<?php endif ?>

						</div>
					<?php endif ?>
				</div>
			<?php }
			elseif ($style == 'classic'){ ?>
				<div class="project-detail-slider all-zero-paddings <?php echo esc_attr($wrap_class); ?>">
					<div class="project-detail-slider-banner">
						<?php if (!empty($images)):
							$images = explode(',', $images);  ?>
							<div  class="project-detail-main-slider slick-slider" data-key="1" data-arrows="<?php echo esc_attr( $arrows ); ?>" data-autoplay="0" data-speed="<?php echo esc_attr( $slide_speed ); ?>" data-autoplay-speed="0" data-fade="1" data-for=".project-detail-thumb-slider" data-width="0" data-slides="1">

								<?php foreach ($images as $key => $image) : ?>
									<div class="project-detail-main-slide slick-slide">
										<?php echo wp_get_attachment_image( $image, 'full', false, array('class'=>'s-img-switch') ); ?>
									</div>
								<?php endforeach; ?>

							</div>

							<div class="project-detail-thumb-slider slick-slider" data-key="1" data-arrows="0" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-speed="<?php echo esc_attr( $slide_speed ); ?>" data-autoplay-speed="<?php echo esc_attr( $autoplay_speed ); ?>" data-for=".project-detail-main-slider" data-width="0" data-focus="1" data-vertical="1"  data-vertical-swiping="1" data-slides="6">

								<?php foreach ($images as $key => $image) : ?>
									<div class="project-detail-main-slide slick-slide">
										<?php echo wp_get_attachment_image( $image, 'full', false, array('class'=>'s-img-switch') ); ?>
									</div>
								<?php endforeach; ?>

							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php }
			else{ ?>
				<div class="modern-slider-wrap <?php echo esc_attr($wrap_class); ?>">
					<div class="modern-slider full-height-window-head-foot"
					     data-time="<?php echo esc_attr( $slide_speed ); ?>">
						<?php
						$count       = 1;
						if ( ! empty( $images ) ) {
							$images = explode(',', $images);
							foreach ( $images as $image ) :
								$url = ( ! empty( $image ) && is_numeric( $image ) ) ? wp_get_attachment_image_src( $image, 'full' ) : '';
								$url = is_array( $url ) ? $url[0] : $url;
								$attachment = get_post( $image );
								$title = $attachment->post_excerpt; ?>

								<div class="item-mod page-calculate-content">
									<div class="img"
									     style="background-image: url(<?php echo esc_attr( $url ); ?>);">
										<?php if(!empty($title)){ ?>
											<div class="title"><?php echo wp_kses_post($title); ?></div>
										<?php } ?>
									</div>
								</div>
								<?php
								$count ++;
							endforeach;
						} ?>
					</div>
				</div>
			<?php }
			// end output
			return ob_get_clean();
		}
	}
}
