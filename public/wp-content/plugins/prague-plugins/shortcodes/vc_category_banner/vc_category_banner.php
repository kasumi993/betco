<?php

//Category Banner shortcode

if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'                    => __( 'Category Banner', 'js_composer' ),
			'base'                    => 'vc_category_banner',
			'content_element'         => true,
			'show_settings_on_create' => true,
			'description'             => esc_html__( '', 'js_composer' ),
			'params'                  => array(
				array(
					'param_name'  => 'bg_image',
					'type'        => 'attach_image',
					'description' => 'Add image for background',
					'heading'     => 'Background image',
					'value'       => '',
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Title', 'js_composer' ),
					'param_name' => 'title',
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
			) //end params
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_vc_category_banner extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {

			extract( shortcode_atts( array(
				'bg_image'     => '',
				'title'        => '',
				'button'       => '',
				'style_button' => '',
				'color_button' => '',
				'cats'         => '',

			), $atts ) );

			do_shortcode( $content );

			ob_start();

			if ( ! empty( $bg_image ) ) {
				$bg_image_url = ( ! empty( $bg_image ) && is_numeric( $bg_image ) ) ? wp_get_attachment_url( $bg_image ) : ''; ?>
                <div class="category-banner full-height-window">
                    <div class="category-banner__image">
                        <img src="<?php echo esc_url( $bg_image_url ); ?>" class="s-img-switch" alt="">
                    </div>
					<?php if ( ! empty( $title ) ) { ?>
                        <div class="category-banner__info">
                            <h2 class="category-banner__info-title"><?php echo wp_kses_post( $title ); ?></h2>
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
                        </div>
					<?php }

					if ( ! empty( $cats ) ) {
						$cats = explode( ',', $cats ); ?>

                        <div class="category-banner__slider">
                            <div class="swiper-container" data-slides-per-view="3" data-sm-slides="1" data-center="0" data-speed="1000" data-space-between="30" data-mouse="1">
                                <div class="swiper-wrapper">
									<?php foreach ( $cats as $cat ) { ?>
                                        <div class="swiper-slide category-banner__slider-slide">
	                                        <?php
	                                        $cat_info = get_term_by( 'slug', $cat, 'projects-category' );
                                            $cat_name = $cat_info->name;
                                            $cat_id = $cat_info->term_id;
	                                        $term_data = get_term_meta( $cat_id, '_category_options', true );
	                                        $cat_image_id = $term_data['category_image'];
	                                        $cat_link = get_term_link( $cat_id, 'projects-category');
	                                        $image           = ( is_numeric( $cat_image_id ) && ! empty( $cat_image_id ) ) ? wp_get_attachment_image_url( $cat_image_id, 'full' ) : '';
                                            ?>

                                            <img src="<?php echo esc_url($image); ?>" alt="" class="s-img-switch">
                                            <a href="<?php echo esc_url($cat_link); ?>" class="category-banner__slider-title"><?php echo esc_html($cat_name); ?></a>
                                        </div>
									<?php } ?>
                                </div>
                                <div class="category-banner__slider-pagination mobile">
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                            <div class="category-banner__slider-pagination desktop">
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
					<?php } ?>
                </div>
			<?php }

			return ob_get_clean();
		}
	}
}
