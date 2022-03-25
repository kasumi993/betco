<?php

//Project Gallery shortcode

if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'                    => __( 'Project Gallery', 'js_composer' ),
			'base'                    => 'vc_project_gallery',
			'content_element'         => true,
			'show_settings_on_create' => true,
			'description'             => esc_html__( '', 'js_composer' ),
			'params'                  => array(
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Subtitle', 'js_composer' ),
					'param_name' => 'subtitle',
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Title', 'js_composer' ),
					'param_name' => 'title',
				),
				array(
					'type'       => 'textarea',
					'heading'    => __( 'Description', 'js_composer' ),
					'param_name' => 'desc',
				),
				array(
					'type'        => 'vc_efa_chosen',
					'heading'     => __( 'Select Categories', 'js_composer' ),
					'param_name'  => 'cat',
					'placeholder' => __( 'Select category', 'js_composer' ),
					'value'       => prague_element_values( 'categories', array(
						'sort_order' => 'ASC',
						'taxonomy'   => 'projects-category',
						'hide_empty' => false,
					) ),
					'std'         => '',
				),
			) //end params
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_vc_project_gallery extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {

			extract( shortcode_atts( array(
				'subtitle' => '',
				'title'    => '',
				'desc'     => '',
				'cat'      => '',

			), $atts ) );

			do_shortcode( $content );

			// base args
			$args = array(
				'post_type' => 'projects',
			);

			// category
			if ( ! empty( $cat ) ) {
				$term_slugs        = explode( ',', $cat );
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

			if ( ! empty( $cat ) ) { ?>
                <div class="project-gallery">
                    <div class="project-gallery__wrap">
                        <div class="project-gallery__item main-item">
							<?php if ( ! empty( $subtitle ) ) { ?>
                                <div class="project-gallery__subtitle"><?php echo esc_html( $subtitle ); ?></div>
							<?php } ?>

							<?php if ( ! empty( $title ) ) { ?>
                                <div class="project-gallery__title"><?php echo esc_html( $title ); ?></div>
							<?php } ?>

							<?php if ( ! empty( $desc ) ) { ?>
                                <div class="project-gallery__description"><?php echo esc_html( $desc ); ?></div>
							<?php } ?>
                        </div>

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

							$link   = get_the_permalink();
							$target = '_self';

							$categoriesAll[] = $category;
							$title     = get_the_title();
							$targetsAll[]    = $target;
							$linksAll[]      = $link;
							$image_id        = get_post_thumbnail_id( $posts->ID );
							$alt             = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
							$image           = ( is_numeric( $image_id ) && ! empty( $image_id ) ) ? wp_get_attachment_image_url( $image_id, $image_original_size ) : ''; ?>

                            <div class="project-gallery__item">
                                <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $alt ); ?>" class="s-img-switch">
                                <div class="project-gallery__item-info">
                                    <i class="fa fa-chain-broken project-gallery__item-icon"></i>
                                    <div class="project-gallery__item-title"><?php echo esc_html($title);?></div>
                                    <a href="<?php echo esc_url($link);?>" target="<?php echo esc_attr($target);?>" class="project-gallery__item-btn"><?php echo esc_html__('READ', 'prague');?></a>
                                </div>
                            </div>

						<?php endwhile;

						wp_reset_postdata(); ?>
                    </div>
                </div>
			<?php }

			return ob_get_clean();
		}
	}
}
