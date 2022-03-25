<?php
if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'     => __( 'Diagonal Showcase', 'js_composer' ),
			'base'     => 'vc_diagonal_showcase',
			'category' => __( 'Content', 'js_composer' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Count items', 'js_composer' ),
					'param_name' => 'count',
				),
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
					'type'       => 'dropdown',
					'heading'    => 'Linked to detail page',
					'param_name' => 'linked',
					'value'      => array(
						'Yes'  => 'yes',
						'None' => 'none'
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
			)
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_vc_diagonal_showcase extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'count'               => '',
				'image_original_size' => 'full',
				'cats'                => '',
				'orderby'             => '',
				'order'               => 'date',
				'linked'              => 'yes',
				'blank'               => 'none',


			), $atts ) );

			if ( ! in_array( "prague-diagonal", self::$js_scripts ) ) {
				self::$js_scripts[] = "prague-diagonal";
			}

			$this->enqueueJs();


			$style               = 'diagonal';
			$image_original_size = isset( $image_original_size ) && ! empty( $image_original_size ) ? $image_original_size : 'full';


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

				<div class="portfolio-slider-wrap <?php echo esc_attr( $style ); ?>">
					<?php

					if( $style == 'diagonal' ){ ?>

						<div class="slideshow">
							<div class="slideshow__deco"></div>
							<?php $diagonal_counter = 1;

							while ( $posts->have_posts() ) :
								$posts->the_post();

								$categories = get_the_terms( $posts->ID, 'projects-category' );

								$categories = ! empty( $categories ) ? $categories : '';
								$category   = '';
								if ( ! empty( $categories ) ) {
									$count = 1;

									foreach ( $categories as $item ) {
										if($count === 1){
											$category .= $item->name;
										}
										$count++;
									}
								}else{
									$category = '';
								}

								$link   = get_the_permalink();
								$target = '_self';

								if ( $linked == 'none' && ! empty( $meta_data['ext_link'] ) ) {
									$link   = $meta_data['ext_link'];
								}

								if ( $blank == 'none' ) {
									$target = '_self';
								} elseif ( $blank == 'yes' ) {
									$target = '_blank';
								}

								$image_id        = get_post_thumbnail_id( $posts->ID );
								$alt       = get_post_meta($image_id, '_wp_attachment_image_alt', true );
								$image           = ( is_numeric( $image_id ) && ! empty( $image_id ) ) ? wp_get_attachment_image_url( $image_id, $image_original_size ) : ''; ?>

								<div class="slide">
									<div class="slide__img-wrap">
										<div class="slide__img">
											<?php if(!empty($image)){ ?>
												<img class="s-img-switch" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($alt); ?>">
											<?php } ?>
										</div>
									</div>

									<div class="slide__side"><?php echo $category; ?></div>
									<div class="slide__title-wrap">
										<span class="slide__number"><?php echo esc_html($diagonal_counter); ?></span>
										<a href="<?php echo esc_url($link); ?>" class="slide__title" target="<?php echo esc_attr($target); ?>">
											<?php the_title(); ?>
										</a>
									</div>
								</div>

								<?php $diagonal_counter++;

							endwhile;

							wp_reset_postdata(); ?>

						</div>

					<?php } ?>

				</div>

			<?php }

			return ob_get_clean();
		}
	}
}