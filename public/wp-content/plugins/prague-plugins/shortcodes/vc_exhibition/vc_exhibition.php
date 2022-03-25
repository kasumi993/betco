<?php

//Exhibition Portfolio shortcode

vc_map( array(
	'name'                    => esc_html__( 'Exhibition projects', 'js_composer' ),
	'base'                    => 'vc_exhibition',
	'show_settings_on_create' => false,
	'params'                  => array(
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
	) //end params
) );


class WPBakeryShortCode_vc_exhibition extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'cats'                => '',
			'image_original_size' => 'full',
			'linked'              => 'yes',
			'blank'               => 'none',
			'orderby'             => '',
			'order'               => 'date'
		), $atts ) );

        if ( ! in_array( "prague-exhibition", self::$js_scripts ) ) {
            self::$js_scripts[] = "prague-exhibition";
        }
        if ( ! in_array( "prague-anime", self::$js_scripts ) ) {
            self::$js_scripts[] = "prague-anime";
        }

		$this->enqueueJs();

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

			$term_array = explode(',', $cats);
			$cats = array();

			foreach ($term_array as $term_slug){
				$term_info = get_term_by('slug', $term_slug, 'projects-category');
				$cats[] = $term_info->term_id;
			}

			$cats = implode(',', $cats);
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'projects-category',
					'field'    => 'term_id',
					'terms'    => explode( ',', $cats ),
				)
			);
		}

		$counter = 0;

		$posts = new WP_Query( $args );

		ob_start();

		$slideContent = '';

		if ($posts->have_posts()) { ?>

			<div class="exhibition-wrap">
				<svg class="hidden">
					<symbol id="icon-arrow" viewBox="0 0 24 24">
						<title>arrow</title>
						<polygon points="6.3,12.8 20.9,12.8 20.9,11.2 6.3,11.2 10.2,7.2 9,6 3.1,12 9,18 10.2,16.8 "/>
					</symbol>
					<symbol id="icon-drop" viewBox="0 0 24 24">
						<title>drop</title>
						<path d="M12,21c-3.6,0-6.6-3-6.6-6.6C5.4,11,10.8,4,11.4,3.2C11.6,3.1,11.8,3,12,3s0.4,0.1,0.6,0.3c0.6,0.8,6.1,7.8,6.1,11.2C18.6,18.1,15.6,21,12,21zM12,4.8c-1.8,2.4-5.2,7.4-5.2,9.6c0,2.9,2.3,5.2,5.2,5.2s5.2-2.3,5.2-5.2C17.2,12.2,13.8,7.3,12,4.8z"/><path d="M12,18.2c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7c1.3,0,2.4-1.1,2.4-2.4c0-0.4,0.3-0.7,0.7-0.7c0.4,0,0.7,0.3,0.7,0.7C15.8,16.5,14.1,18.2,12,18.2z"/>
					</symbol>
					<symbol id="icon-menu" viewBox="0 0 24 24">
						<title>menu</title>
						<path d="M24,5.8H0v-2h24V5.8z M19.8,11H4.2v2h15.6V11z M24,18.2H0v2h24V18.2z"/>
					</symbol>
					<symbol id="icon-cross" viewBox="0 0 24 24">
						<title>cross</title>
						<path d="M13.4,12l7.8,7.8l-1.4,1.4l-7.8-7.8l-7.8,7.8l-1.4-1.4l7.8-7.8L2.7,4.2l1.4-1.4l7.8,7.8l7.8-7.8l1.4,1.4L13.4,12z"/>
					</symbol>
					<symbol id="icon-info" viewBox="0 0 20 20">
						<title>info</title>
						<circle style="fill:#fff" cx="10" cy="10" r="9.1"/>
						<path d="M10,0C4.5,0,0,4.5,0,10s4.5,10,10,10s10-4.5,10-10S15.5,0,10,0z M10,18.6c-4.7,0-8.6-3.9-8.6-8.6S5.3,1.4,10,1.4s8.6,3.9,8.6,8.6S14.7,18.6,10,18.6z M10.7,5C10.9,5.2,11,5.5,11,5.7s-0.1,0.5-0.3,0.7c-0.2,0.2-0.4,0.3-0.7,0.3c-0.3,0-0.5-0.1-0.7-0.3C9.1,6.2,9,6,9,5.7S9.1,5.2,9.3,5C9.5,4.8,9.7,4.7,10,4.7C10.3,4.7,10.5,4.8,10.7,5z M9.3,8.3h1.4v7.2H9.3V8.3z"/>
					</symbol>
				</svg>
				<div class="container-wrap">
					<div class="scroller">
						<?php while ( $posts->have_posts() ) :
							$posts->the_post();


							$projects_meta = get_post_meta( get_the_ID(), 'prague_post_options', true  );

							$link = get_the_permalink();

							$target = '_self';

							if ( !empty($linked) && $linked == 'none' && ! empty( $projects_meta['ext_link'] ) ) {
								$link   = $projects_meta['ext_link'];
							}

							if ( $blank == 'none' ) {
								$target = '_self';
							} elseif ( $blank == 'yes' ) {
								$target = '_blank';
							}

							if(isset($projects_meta["gallery"]) && !empty($projects_meta["gallery"])){
								$images         = explode( ',', $projects_meta["gallery"] );
                                if( count($images) >= 8){
                                    $class = $counter == 0 ? 'room--current' : '';

                                    $slideContent .= '<div class="slide">
                                                          <span class="cat">'. get_the_term_list($posts->ID, "projects-category", '', ', ') . '</span>
                                                              <a href="'. esc_url($link) .'" class="slide__name" target="' . esc_attr($target) . '">' . get_the_title() . '</a>
                                                              <h3 class="slide__title"></h3>
                                                          <p class="slide__date"></p>
                                                      </div>'; ?>

                                    <div class="room <?php echo esc_attr($class); ?>">

                                        <?php if(!empty($images) && count($images) >= 8){
                                            $images = array_slice($images, 0, 9);

                                            $url1 = is_numeric($images[0]) ? wp_get_attachment_image_src($images[0], $image_original_size) : '';
                                            $url2 = is_numeric($images[1]) ? wp_get_attachment_image_src($images[1], $image_original_size) : '';
                                            $url3 = is_numeric($images[2]) ? wp_get_attachment_image_src($images[2], $image_original_size) : '';
                                            $url4 = is_numeric($images[3]) ? wp_get_attachment_image_src($images[3], $image_original_size) : '';
                                            $url5 = is_numeric($images[4]) ? wp_get_attachment_image_src($images[4], $image_original_size) : '';
                                            $url6 = is_numeric($images[5]) ? wp_get_attachment_image_src($images[5], $image_original_size) : '';
                                            $url7 = is_numeric($images[6]) ? wp_get_attachment_image_src($images[6], $image_original_size) : '';
                                            $url8 = is_numeric($images[7]) ? wp_get_attachment_image_src($images[7], $image_original_size) : ''; ?>


                                            <div class="room__side room__side--back">
                                                <img class="room__img" src="<?php echo esc_url($url1[0]); ?>" alt=""/>
                                                <img class="room__img" src="<?php echo esc_url($url2[0]); ?>" alt=""/>
                                            </div>
                                            <div class="room__side room__side--left">
                                                <img class="room__img" src="<?php echo esc_url($url3[0]); ?>" alt=""/>
                                                <img class="room__img" src="<?php echo esc_url($url4[0]); ?>" alt=""/>
                                                <img class="room__img" src="<?php echo esc_url($url5[0]); ?>" alt=""/>
                                            </div>
                                            <div class="room__side room__side--right">
                                                <img class="room__img" src="<?php echo esc_url($url6[0]); ?>" alt=""/>
                                                <img class="room__img" src="<?php echo esc_url($url7[0]); ?>" alt=""/>
                                                <img class="room__img" src="<?php echo esc_url($url8[0]); ?>" alt=""/>
                                            </div>
                                        <?php } ?>
                                        <div class="room__side room__side--bottom"></div>
                                    </div><!-- /room -->

                                    <?php $counter ++;
                                }

                            }

						endwhile; ?>
					</div>
				</div><!-- /container -->
				<div class="content">
					<div class="slides">
						<?php echo do_shortcode($slideContent); ?>
					</div>
					<nav class="nav">
						<button class="btn btn--nav btn--nav-left"></button>
						<button class="btn btn--nav btn--nav-right"></button>
					</nav>
				</div><!-- /content -->
				<div class="overlay overlay--loader overlay--active">
					<div class="loader">
						<div></div>
						<div></div>
						<div></div>
					</div>
				</div>
			</div>

		<?php }

		wp_reset_postdata();

		return ob_get_clean();
	}
}
