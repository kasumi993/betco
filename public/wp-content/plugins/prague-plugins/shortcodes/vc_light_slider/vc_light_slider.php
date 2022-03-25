<?php
if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'     => __( 'Light Slider', 'js_composer' ),
			'base'     => 'vc_light_slider',
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
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Enable autoplay?', 'js_composer' ),
					'param_name' => 'check_autoplay',
					'std'        => '',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Speed (milliseconds)', 'js_composer' ),
					'description' => __( 'Speed Animation. Default 1500 milliseconds', 'js_composer' ),
					'param_name'  => 'speed',
					'value'       => '1500',
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
	class WPBakeryShortCode_vc_light_slider extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'count'               => '',
				'check_autoplay'               => '',
				'image_original_size' => 'full',
				'cats'                => '',
				'orderby'             => '',
				'order'               => 'date',
				'speed'               => '1500',
				'linked'              => 'yes',
				'blank'               => 'none',


			), $atts ) );


			$style               = isset( $style ) && ! empty( $style ) ? $style : 'progress_slider';
			$speed               = isset( $speed ) && ! empty( $speed ) && is_numeric( $speed ) ? $speed : '1500';
			$autoplay            = is_numeric( $autoplay ) ? $autoplay : '5000';
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

			$random        = substr( md5( rand() ), 0, 7 );
			$categoriesAll = array();
			$titlesAll     = array();
			$targetsAll    = array();
			$linksAll      = array();

			$posts = new WP_Query( $args );

			if ( $posts->have_posts() ) { ?>

				<div class="portfolio-slider-wrap urban_slider">
					<div class="gallery-top" id="<?php echo esc_attr( $random ); ?>"
					     data-id="thumb<?php echo esc_attr( $random ); ?>"
					     data-autoplay="<?php echo esc_attr( $check_autoplay ); ?>"
					     data-autoplayspeed="<?php echo esc_attr( $autoplay ); ?>"
					     data-speed="<?php echo esc_attr( $speed ); ?>">

						<?php while ( $posts->have_posts() ) :
							$posts->the_post();

							$categories = get_the_terms( $posts->ID, 'projects-category' );

							$categories = ! empty( $categories ) ? $categories : '';
							$category   = array();
							if ( ! empty( $categories ) ) {
								foreach ( $categories as $item ) {
									$category[] = $item->name;
								}
								$category = implode( ", ", $category );
							}

							$meta_data = get_post_meta( get_the_ID(), 'prague_projects_options', true );
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

							$categoriesAll[] = $category;
							$titlesAll[]     = get_the_title();
							$targetsAll[]    = $target;
							$linksAll[]      = $link;
							$image_id        = get_post_thumbnail_id( $posts->ID );
							$alt       = get_post_meta($image_id, '_wp_attachment_image_alt', true );
							$image           = ( is_numeric( $image_id ) && ! empty( $image_id ) ) ? wp_get_attachment_image_url( $image_id, $image_original_size ) : ''; ?>

							<div class="gallery-top-slide">
								<img src="<?php echo esc_url( $image ); ?>" class="s-img-switch" alt="<?php echo esc_attr( $alt ); ?>">
							</div>

						<?php endwhile;


						wp_reset_postdata(); ?>

					</div>

					<div class="gallery-thumb" id="thumb<?php echo esc_attr( $random ); ?>"
					     data-id="<?php echo esc_attr( $random ); ?>"
					     data-autoplay="<?php echo esc_attr( $check_autoplay ); ?>"
					     data-autoplayspeed="<?php echo esc_attr( $autoplay ); ?>"
					     data-speed="<?php echo esc_attr( $speed ); ?>">
						<?php
						$counter = 0;

						foreach ( $targetsAll as $target ) { ?>
							<div class="gallery-thumb-slide">
                            <span class="pagination-bullet">
                                <a href="<?php echo esc_url( $linksAll[ $counter ] ); ?>"
                                   target="<?php echo esc_attr( $target ); ?>"
                                   class="pagination-title"><?php echo esc_html( $titlesAll[ $counter ] ); ?></a>
                                 <i class="pagination-category"><?php echo esc_html( $categoriesAll[ $counter ] ); ?></i>
                            </span>
							</div>
							<?php
							$counter ++;
						} ?>
					</div>
				</div>

			<?php }

			return ob_get_clean();
		}
	}
}