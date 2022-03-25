<?php
/*
 * Project slider Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.5.0
 */
if (function_exists('vc_map')) {
	vc_map(
		array(
			'name'						=> esc_html__( 'Project slider', 'js_composer' ),
			'base'						=> 'vc_project_slider',
			'content_element'			=> true,
			'show_settings_on_create'	=> true,
			'description'				=> esc_html__( '', 'js_composer'),
			'params'					=> array (
				array(
					'type'       => 'dropdown',
					'heading'    => 'Image original size',
					'param_name' => 'image_original_size',
					'value'      => array_merge( array( 'full' ), get_intermediate_image_sizes() )
				),
				array(
					'type'        => 'vc_efa_chosen',
					'heading'     => __( 'Select Categories', 'js_composer' ),
					'param_name'  => 'cats',
					'placeholder' => __( 'Select category', 'js_composer' ),
					'value'       => prague_element_values( 'categories', array(
						'sort_order' => 'ASC',
						'taxonomy'   => 'projects-category',
						'hide_empty' => false,
					) ),
					'std'         => '',
					'description' => __( 'For style "Landing Split" use a portfolio where there are at least 2 images', 'js_composer' ),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Order by', 'js_composer' ),
					'param_name'  => 'orderby',
					'value'       => array(
						'',
						__( 'Date', 'js_composer' )          => 'date',
						__( 'ID', 'js_composer' )            => 'ID',
						__( 'Author', 'js_composer' )        => 'author',
						__( 'Title', 'js_composer' )         => 'title',
						__( 'Modified', 'js_composer' )      => 'modified',
						__( 'Random', 'js_composer' )        => 'rand',
						__( 'Comment count', 'js_composer' ) => 'comment_count'
					),
					'description' => sprintf( __( 'Select how to sort retrieved posts. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Sort order', 'js_composer' ),
					'param_name'  => 'order',
					'value'       => array(
						__( 'Descending', 'js_composer' ) => 'DESC',
						__( 'Ascending', 'js_composer' )  => 'ASC',
					),
					'description' => sprintf( __( 'Select ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Autoplay speed (milliseconds)', 'js_composer' ),
					'description' => __( 'Autoplay speed Animation. Default 5000 milliseconds', 'js_composer' ),
					'param_name'  => 'autoplayspeed',
					'value'       => '5000',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array(
							'full_showcase_slider',
						)
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Speed (milliseconds)', 'js_composer' ),
					'description' => __( 'Speed Animation. Default 1500 milliseconds', 'js_composer' ),
					'param_name'  => 'speed',
					'value'       => '1500',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array(
							'full_showcase_slider',
						)
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Count items', 'js_composer' ),
					'param_name' => 'count',
					'description' => __( 'By default set 9 items.', 'js_composer' ),
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
					'type'       => 'dropdown',
					'heading'    => 'Open link in a new tab?',
					'param_name' => 'blank',
					'value'      => array(
						'None' => 'none',
						'Yes'  => 'yes'
					),
				),
			)//end params
		)
	);
}
if (class_exists('WPBakeryShortCode')) {
	/* Frontend Output Shortcode */
	class WPBakeryShortCode_vc_project_slider extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'style'                => 'full_showcase_slider',
				'image_original_size'  => 'full',
				'cats'                 => '',
				'orderby'              => '',
				'order'                => 'date',
				'autoplayspeed'        => '5000',
				'speed'                => '1500',
				'count'                => '',
				'slides'               => '3',
				'blank'                => 'none',
			), $atts ) );

			
			$speed = is_numeric( $speed ) ? $speed : '1000';
			$autoplayspeed = is_numeric( $autoplayspeed ) ? $autoplayspeed : '5000';


			// start output
			ob_start();

			// base args
			$args = array(
				'post_type'      => 'projects',
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
						'taxonomy' => 'projects-category',
						'field'    => 'slug',
						'terms'    => $term_slugs,
					)
				);
			}


			ob_start();

			$posts = new WP_Query( $args );

			if ( $posts->have_posts() ) { ?>
				<div class="portfolio-slider-wrap full_showcase_slider showcase_slider">
					<?php $slideClass = 'full-height-window-hard';?>
						<div class="swiper-container"
						     data-mouse="0" data-space="0" data-pagination-type="bullets"
						     data-mode="horizontal" data-autoplay="<?php echo esc_attr($autoplayspeed); ?>"
						     data-loop="2" data-speed="<?php echo esc_attr($speed); ?>" data-center="0"
						     data-responsive="responsive" data-slides-per-view="<?php echo esc_attr($slides); ?>"
						     data-xs-slides="1,0" data-sm-slides="2,0" data-md-slides="3,0"
						     data-lg-slides="<?php echo esc_attr($slides); ?>,0">
							<div class="swiper-wrapper">

								<?php while ($posts->have_posts()) :
									$posts->the_post();
									$meta_data = get_post_meta(get_the_ID(), 'prague_post_options', true);

									$images = isset($meta_data['gallery']) && !empty($meta_data['gallery']) ? explode(',', $meta_data['gallery']) : array();

									$link = get_the_permalink();
									$target = '_self';

									if ($blank == 'none') {
										$target = '_self';
									} elseif ($blank == 'yes') {
										$target = '_blank';
									} ?>

									<div class="swiper-slide">
										<div class="slide-image <?php echo esc_attr($slideClass); ?> clearfix">
											<?php if (!get_post_thumbnail_id($posts->ID)) { ?>
												<span class="images-slider-wrapper clearfix">
		                                                    <?php $url = (!empty($images[0]) && is_numeric($images[0])) ? wp_get_attachment_image_url($images[0], $image_original_size) : '';
		                                                    $alt = get_post_meta($images[0], '_wp_attachment_image_alt', true); ?>
													<img src="<?php echo esc_url($url); ?>"
													     alt="<?php echo esc_attr($alt); ?>" class="s-img-switch">
		                                                </span>
											<?php } else {
												$image_id = get_post_thumbnail_id($posts->ID);
												$image = (is_numeric($image_id) && !empty($image_id)) ? wp_get_attachment_image_url($image_id, $image_original_size) : '';
												$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true); ?>
												<span class="images-slider-wrapper clearfix">
		                                                    <img src="<?php echo esc_url($image); ?>"
		                                                         alt="<?php echo esc_attr($alt); ?>" class="s-img-switch">
		                                                </span>
											<?php } ?>

										</div>

										<div class="content-showcase-wrapper">
											<div class="slide-title"><a href="<?php echo esc_url($link) ?>"
											                            target="<?php echo esc_attr($target) ?>"><?php echo get_the_title(); ?></a>
											</div>
											<div class="slide-category"><?php the_terms($posts->ID, 'projects-category'); ?></div>
										</div>
									</div>

								<?php endwhile;
								wp_reset_postdata(); ?>

							</div>
							<div class="swiper-button-prev swiper-buttons"></div>
							<div class="swiper-button-next swiper-buttons"></div>
						</div>
				</div>
				 <?php }
			// end output
			return ob_get_clean();
		}
	}
}
