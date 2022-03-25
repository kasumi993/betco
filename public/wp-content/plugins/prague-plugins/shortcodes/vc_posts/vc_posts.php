<?php
 
// remove default post types
$post_types = array_diff( get_post_types(), array(
	'revision',
	'attachment',
	'nav_menu_item',
	'booked_appointments',
	'frm_styles',
	'vc4_templates',
	'vc_grid_item',
	'custom_css',
	'frm_form_actions',
	'customize_changeset',
	'wpcf7_contact_form'
));


// get all post types
if ( ! function_exists( 'get_vc_post_types' ) ) {
	function get_vc_post_types($post_types){
		$list = array();
		foreach ( $post_types as $post_type ) {
			$list[ucwords($post_type)] = $post_type;
		}
		return $list;
	}
}

/**
 *
 * element values post, page, categories
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'vc_projects_element_values' ) ) {
	function vc_projects_element_values( $type = '', $query_args = array() ) {

		$options = array();

		switch ( $type ) {

			case 'pages':
			case 'page':
				$pages = get_pages( $query_args );

				if ( ! empty( $pages ) ) {
					foreach ( $pages as $page ) {
						$options[ $page->post_title ] = $page->ID;
					}
				}
				break;

			case 'posts':
			case 'post':
				$posts = get_posts( $query_args );

				if ( ! empty( $posts ) ) {
					foreach ( $posts as $post ) {
						$options[ $post->post_title ] = lcfirst( $post->post_title );
					}
				}
				break;

			case 'tags':
			case 'tag':

				$tags = get_terms( $query_args['taxonomies'] );
				if ( ! empty( $tags ) ) {
					foreach ( $tags as $tag ) {
						$options[ $tag->name ] = $tag->term_id;
					}
				}
				break;

			case 'categories':
			case 'category':

				$categories = get_categories( $query_args );

				if ( ! empty( $categories ) ) {

					if ( is_array( $categories ) ) {
						foreach ( $categories as $category ) {
							$options[ $category->name ] = $category->term_id;
						}
					}

				}
				break;

			case 'custom':
			case 'callback':

				if ( is_callable( $query_args['function'] ) ) {
					$options = call_user_func( $query_args['function'], $query_args['args'] );
				}

				break;

		}

		return $options;

	}
}


if (!function_exists('prague_pixfields_get_filterable_metakeys')) {
	function prague_pixfields_get_filterable_metakeys($post_type){

		if ( !class_exists('PixFieldsPlugin') ) {
			return array();
		}

		global $pixfields_plugin;
		$fields_list = $pixfields_plugin->get_pixfields_list();
		$return = array();
		if ( isset( $fields_list[$post_type]  ) ) {
			foreach ( $fields_list[$post_type] as $key => $fields ) {
				$return[$fields['meta_key']] = $fields['label'];
			}
		}

		return $return;
	}
}


$params = array(
    /* main part */
    array (
        'type' => 'dropdown',
        'heading' => __( 'Templates', 'js_composer' ),
        'param_name' => 'templates',
        'value' => vc_get_shortcode_template('vc_posts'),
        'description' => '',
        'dependency' => array(
            'callback' => 'init_ajax_field',
        ),
    ),
    array (
        'type' => 'dropdown',
        'heading' => __( 'Post types', 'js_composer' ),
        'param_name' => 'post_type',
        'value'      => get_vc_post_types($post_types),
        'description' => __( 'Select source for slider.', 'js_composer' ),
    ),
    array (
        'param_name' => 'button_style',
        'type' => 'params_preset',
        'description' => '',
        'heading' => 'Button Style',
        'options' => array(
            array(
                'label' => __( 'Simple', 'js_composer' ),
                'value' => 'simple',
                'params' => array(
                    'button_link_class' => 'prague-services-link a-btn-2 simple',
                    'button_span_class' => 'a-btn-line',
                ),
            ),
            array(
                'label' => __( 'Creative', 'js_composer' ),
                'value' => 'creative',
                'params' => array(
                    'button_link_class' => 'prague-services-link a-btn-2 creative',
                    'button_span_class' => 'a-btn-line',
                ),
            ),
            array(
                'label' => __( 'Arrow', 'js_composer' ),
                'value' => 'arrow',
                'params' => array(
                    'button_link_class' => 'prague-services-link a-btn-arrow-2',
                    'button_span_class' => 'arrow-right',
                ),
            ),
        ),
        'param_holder_class' => 'vc_message-type vc_colored-dropdown',
        'dependency'  => array( 'element' => 'templates', 'value' => array('services' ) )
    ),
    array (
        'type' => 'hidden',
        'param_name' => 'button_link_class',
    ),
    array (
        'type' => 'hidden',
        'param_name' => 'button_span_class',
    ),

    /* columns & gaps */
    array (
        'type'        => 'dropdown',
        'heading'     => __( 'Total columns', 'js_composer' ),
        'param_name'  => 'total_columns',
        'value' => array(
            __( 'Columns 1', 'js_composer') => 'prague_count_col1',
            __( 'Columns 2', 'js_composer') => 'prague_count_col2',
            __( 'Columns 3', 'js_composer') => 'prague_count_col3',
            __( 'Columns 4', 'js_composer') => 'prague_count_col4',
            __( 'Columns 5', 'js_composer') => 'prague_count_col5',
            __( 'Columns 6', 'js_composer') => 'prague_count_col6',
        ),
        'dependency'  => array( 'element' => 'templates', 'value' => array('grid','masonry','services','media','exhibition_grid','books' ) )
    ),
    array (
        'type'        => 'dropdown',
        'heading'     => __( 'Gap', 'js_composer' ),
        'param_name'  => 'gap_columns',
        'value' => array(
            __( 'Gap 10', 'js_composer') => 'prague_gap_col10',
            __( 'Gap 15', 'js_composer') => 'prague_gap_col15',
            __( 'Gap 20', 'js_composer') => 'prague_gap_col20',
            __( 'Gap 25', 'js_composer') => 'prague_gap_col25',
            __( 'Gap 30', 'js_composer') => 'prague_gap_col30',
            __( 'Gap 35', 'js_composer') => 'prague_gap_col35',
            __( 'Gap 40', 'js_composer') => 'prague_gap_col40',
        ),
        'dependency'  => array( 'element' => 'templates', 'value' => array('grid','masonry','services','media','exhibition_grid','books' ) )
    ),

    /* other options */
    array (
        'type'        => 'dropdown',
        'heading'     => 'Image original size',
        'param_name'  => 'image_original_size',
        'value'       => array_merge(get_intermediate_image_sizes(), array('full')),
    ),
    array (
        'type'        => 'textfield',
        'heading'     => __( 'Total posts', 'js_composer' ),
        'param_name'  => 'posts_per_page',
        'description' => 'Only number',
    ),
    array (
        'type'        => 'checkbox',
        'heading'     => __( 'Show Load More Button', 'js_composer' ),
        'param_name'  => 'enable_load_more',
        'value' => '',
        'dependency'  => array( 'element' => 'templates', 'value' => array('grid','masonry','services','media','exhibition_grid','books','blog' ) )
    ),
    array (
        'type'        => 'checkbox',
        'heading'     => __( 'Open Link In New Window', 'js_composer' ),
        'param_name'  => 'enable_new_window',
        'value' => '',
    ),
    array (
        'type'        => 'vc_efa_chosen',
        'heading'     => 'PixField filter',
        'param_name'  => 'pix_filter',
        'value'       => array(),
    ),

    /* select post option */
    array(
        'type'        => 'dropdown',
        'heading'     => __( ' Select post options', 'js_composer' ),
        'param_name'  => 'filter_type',
        'value'       => '',
        'dependency'  => array( 'element' => 'templates', 'value' => array('grid','masonry','media','exhibition_grid','books', 'exhibition_timeline','timeline_list','tile_masonry') )
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => __( ' Select post options 2', 'js_composer' ),
        'param_name'  => 'filter_type_2',
        'value'       => '',
        'dependency'  => array( 'element' => 'templates', 'value' => array('exhibition_timeline','timeline_list' ) )
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => __( ' Select post options 3', 'js_composer' ),
        'param_name'  => 'filter_type_3',
        'value'       => '',
        'dependency'  => array( 'element' => 'templates', 'value' => 'timeline_list' )
    ),

    /* filter */
    array(
        'type'        => 'dropdown',
        'heading'     => __( 'Filter', 'js_composer' ),
        'param_name'  => 'filter',
        'value'       => array(
            'Disable' => 'disable',
            'Enable'  => 'enable',
        ),
        'dependency'  => array( 'element' => 'templates', 'value' => array('grid','masonry','services','media','exhibition_grid','books','filmstrip','exhibition_grid' ) )
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => __( 'Filtering Type', 'js_composer' ),
        'param_name'  => 'filtering_type',
        'value'       => array(
            'At least one criteria matches' => 'one_criteria',
            'All the criteria matches'  => 'all_criteria',
        ),
        'dependency'  => array( 'element' => 'filter', 'value' => 'enable' )
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => __( 'Filter position', 'js_composer' ),
        'param_name'  => 'filter_position',
        'value'       => array(
            'Top'        => 'top',
            'Bottom'     => 'bottom',
        ),
        //'dependency'  => array( 'element' => 'filter', 'value' => 'enable' )
    ),

    /* for only filmstrip */
    array(
        'type'        => 'checkbox',
        'heading'     => __( 'KeyBoard ', 'js_composer' ),
        'param_name'  => 'keyboard',
        'value' => '',
        'dependency'  => array( 'element' => 'templates', 'value' => array('filmstrip' ) )
    ),
    array(
        'type'        => 'checkbox',
        'heading'     => __( 'Arrows', 'js_composer' ),
        'param_name'  => 'arrows',
        'value' => '',
        'dependency'  => array( 'element' => 'templates', 'value' => array('filmstrip' ) )
    ),
    array(
        'type'        => 'checkbox',
        'heading'     => __( 'AutoPlay', 'js_composer' ),
        'param_name'  => 'autoplay',
        'value' => '',
        'dependency'  => array( 'element' => 'templates', 'value' => array('filmstrip' ) )
    ),
    array(
        'type'        => 'textfield',
        'heading'     => __( 'Speed', 'js_composer' ),
        'param_name'  => 'speed',
        'description' => 'Only number',
        'dependency'  => array( 'element' => 'templates', 'value' => array('filmstrip' ) )
    ),
    array(
        'type'        => 'textfield',
        'heading'     => __( 'AutoPlay Speed', 'js_composer' ),
        'param_name'  => 'autoplay_speed',
        'value' => '',
        'dependency'  => array( 'element' => 'templates', 'value' => array('filmstrip' ) )
    ),

    /* for only list */
    array(
        'type'        => 'checkbox',
        'heading'     => __( 'Figure On/Off', 'js_composer' ),
        'param_name'  => 'figure_enable',
        'value' => '',
        'dependency'  => array( 'element' => 'templates', 'value' => 'list' )
    ),
    array (
        'param_name' => 'color_figure',
        'type' => 'colorpicker',
        'description' => '',
        'heading' => 'Color Figure',
        'value' => '',
        'dependency'  => array( 'element' => 'templates', 'value' => array('list' ) )
    ),
    array (
        'type' => 'textfield',
        'heading' => 'Stroke width',
        'param_name' => 'stroke_width',
        'value' => '',
        'dependency'  => array( 'element' => 'templates', 'value' => array('list' ) )
    ),

    /* default options */
    array(
        'type' => 'dropdown',
        'heading' => __( 'Order by', 'js_composer' ),
        'param_name' => 'orderby',
        'value' => array(
            '',
            __( 'Date', 'js_composer' ) => 'date',
            __( 'ID', 'js_composer' ) => 'ID',
            __( 'Author', 'js_composer' ) => 'author',
            __( 'Title', 'js_composer' ) => 'title',
            __( 'Modified', 'js_composer' ) => 'modified',
            __( 'Random', 'js_composer' ) => 'rand',
            __( 'Comment count', 'js_composer' ) => 'comment_count',
            __( 'Menu order', 'js_composer' ) => 'menu_order',
        ),
        'description' => sprintf( __( 'Select how to sort retrieved posts. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
    ),
    array(
        'type' => 'dropdown',
        'heading' => __( 'Sort order', 'js_composer' ),
        'param_name' => 'order',
        'value' => array(
            __( 'Descending', 'js_composer' ) => 'DESC',
            __( 'Ascending', 'js_composer' ) => 'ASC',
        ),
        'description' => sprintf( __( 'Select ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
    ),
);
 

$params_tax = array();
foreach ($post_types as $key => $type) {
	
	$heading = __( 'Select Categories', 'js_composer' );
	if ($type != 'post') {
		$heading = __( 'Select Terms', 'js_composer' );
	}

	$taxonomies = get_taxonomies(array('object_type' => array($type) ), 'names','and');

	if (!empty($taxonomies)) {

		if ($type == 'post') {
			$params_value = array(
					'sort_order' => 'ASC',
					'taxonomy'   => array_shift($taxonomies),
					'hide_empty' => false,
			);
		} else {
			$params_value = array(
					'sort_order' => 'ASC',
					'taxonomies'   => array_shift($taxonomies),
					'hide_empty' => false,
			);
		}

		$type_functions = ($type == 'post') ? 'categories' : 'tags';


		$params_tax[] = array(
			'type'        => 'vc_efa_chosen',
			'heading'     => $heading,
			'param_name'  => 'cats_' . $type,
			'placeholder' => $heading,
			'value'       => vc_projects_element_values( $type_functions, $params_value ),
			'std'         => '',
			'description' => __( 'you can choose spesific categories for portfolio, default is all categories', 'js_composer' ),
			'dependency' => array( 'element' => 'post_type', 'value' => array($type) ),
		);
	}
}

// default category disable
$params_tax = array();

vc_map( array(
		'name'        => __( 'Custom Post Types', 'js_composer' ),
		'base'        => 'vc_projects_posts',
		'description' => __( 'This outputs list shows any of the post-type items', 'js_composer' ),
		'admin_enqueue_js' => array(
			plugins_url('/assets/ajax-fields.js?'.time(), __FILE__)
		),
		'params'      => array_merge(
							array_values($params),
							$params_tax
						)
	)
);

class WPBakeryShortCode_vc_projects_posts extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) { 


		// get default template
		$all_params = vc_get_shortcode('vc_projects_posts');
		$default_template = '';
		foreach ($all_params['params'] as $key => $param) {
			if ($param['param_name'] == 'templates') {
				$default_template = reset( $param['value'] );
			}
		}

		extract( shortcode_atts( array(
            'templates'           => $default_template,
            'post_type'           => 'post',
            'button_link_class'   => 'prague-pricing-link a-btn-2 simple',
            'button_span_class'   => 'a-btn-line',
            'total_columns'       => 'prague_count_col1',
            'gap_columns'         => 'prague_gap_col10',
            'posts_per_page'      => '',
            'enable_load_more'    => '',
            'enable_new_window'   => '',
            'pix_filter'          => '',
            'filter' 	          => 'disable',
            'filtering_type' 	  => 'one_criteria',
            'filter_position'     => 'top',
            'keyboard'            => '',
            'autoplay' 	          => '',
            'figure_enable'       => '',
            'color_figure'        => '',
            'stroke_width'        => '',
            'orderby' 	          => '',
            'order' 	          => '',

            'active'              => '',
            'title'               => '',
            'subtitle'            => '',
            'text'                => '',
            'mouse' 	          => '',
            'buttons' 	          => '',
            'mouse_speed' 	      => '',
            'btn_txt'             => '',
            'btn_url'             => '',
		), $atts ) );

		$category = '';

		// select categories post types
		if ( ! empty( $atts['cats_' . $post_type] ) ) {

			$cats = $atts['cats_' . $post_type]; 

			$taxonomies = get_taxonomies(array('object_type' => array($post_type) ), 'names','and');

			// for custom posttype
			if ($post_type != 'post') {
				$category = array(
					'taxonomy' => array_shift($taxonomies),
					'field'    => 'term_id',
					'terms'    => explode( ',', $cats )
				);
			}
			

			$args = array(
				'tax_query' => array(
					$category
				),
			);
	 		
	 		// for default posttype
			if ($post_type == 'post') {
				$args['category__in'] = explode( ',', $cats );
			}

		}

		// Order posts
		if ( null !== $orderby ) {
			$args['orderby'] = $orderby;
		}
		$args['order'] = $order;

		$projects = array_flip(prague_pixfields_get_filterable_metakeys($post_type));

		/* get first pixfields as empty field */
		if (empty($atts['filter_type'])) {
			$atts['filter_type'] = reset($projects);
		}

        $paged_type = is_front_page() ? 'page' : 'paged';
        $paged = ( get_query_var($paged_type) > 1 ) ? get_query_var($paged_type) : 1;

		$args['paged'] = $paged;

		if ($templates == 'exhibition_timeline') {
			$args['orderby'] = 'meta_value';
			$args['order'] = 'ASC';
			$args['meta_key'] = 'pixfield_' . $atts['filter_type'];
		}

		// select posttype
		$args['post_type'] = $post_type;


		if ( ! empty( $posts_per_page ) && is_numeric( $posts_per_page ) ) {
			$args['posts_per_page'] = $posts_per_page;
		}

		if ( ! empty( $pix_filter ) ) {
			$filters = explode( ',', $pix_filter );
			if ( count( $filters ) > 0 ) {
					$args['meta_query'] = array();
					foreach ( $filters as $filter_item ) {
						$args['meta_query'][] = array(
								'key' => 'pixfield_' . $filter_item,
								'value' => '',
								'compare' => '!=',
						);
					}
 				}
 			}

		$posts = new WP_Query( $args );

        $total = isset( $posts->max_num_pages ) ? $posts->max_num_pages : 1;

        $load_more_block = !empty($enable_load_more) ? 'js-load-more-block' : '';

		$class_wrap = 'prague_' . $templates . ' ' . $total_columns . ' ' . $gap_columns . ' ' . $load_more_block;

		if ( empty($filter) || $filter !== 'enable' || $filter_position !== 'bottom') {
			$class_wrap .= ' no-footer-content';
		}

		if ( empty($figure_enable) && $templates == 'list' ) {
			$class_wrap .= ' no-figure';
		}

        $block_loading_class = ! empty($enable_load_more) ? 'js-filter-simple-block' : '';

		$output = '<div data-unique-key="' . esc_attr( md5($post_type . $templates) ) . '" class="js-load-more" data-start-page="' . esc_attr($paged) . '" data-max-page="' . esc_attr($total) . '" data-next-link="' . esc_url(prague_get_link( '', 'next', $posts )) .  '">';
		$output .= '<div class="row ' . esc_attr( $class_wrap ) .  ' prague-load-wrapper" data-columns="' . esc_attr( $total_columns ) . '" data-gap="' . esc_attr($gap_columns) . '">';

		if ( $active == 'yes' ) {
			$output .= '<div class="col-lg-4 col-sm-6 col-xs-12">';
			$output .= '<div class="all-posts-descr">';
			$output .= '<div class="wrap">';
			if ( ! empty( $subtitle ) ) {
				$output .= '<h6>' . $subtitle . '</h6>';
			}
			if ( ! empty( $title ) ) {
				$output .= '<h5>' . $title . '</h5>';
			}
			if ( ! empty( $text ) ) {
				$output .= '<p>' . $text . '</p>';
			}
			if ( ! empty( $btn_txt ) ) {
				$output .= '<a href="' . $btn_url . '" class="a-btn-2">' . $btn_txt . '</a>';
			}
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
		}

		/* get first pixfields as empty field */
		for ($i=1; $i < 10; $i++) { 
			if (empty($atts['filter_type_'.$i])) {
				$atts['filter_type_'.$i] = reset($projects);
			}
		}

		$poligon_css = '';
		$atts['poligon_style'] = '';
		$atts['figures'] = array(
		    array('triangle' => '0 200,0 0,200, 0'), // triangle
		    array('circle' => ''), // circle
		    array('square' => '0,0 200,0 200,200 0,200'), // square
		    array('oxagon' => '100,0 180,30 200,100 180,180 100,200 30,180 0,100 30,30'), // oxagon
		);

		if (!empty($stroke_width)) {
			$translate = round($stroke_width/2);
			$poligon_css .= '-webkit-transform: translate(' . $translate . 'px,' . $translate . 'px);';
			$poligon_css .= 'transform: translate(' . $translate . 'px,' . $translate . 'px);';
		} 
		if (!empty($color_figure)) {
			$poligon_css .= 'stroke:' . $color_figure . ';';
		} 

		if (!empty($stroke_width)) {
			$poligon_css .= 'stroke-width:' . $stroke_width . ';';
		}

		if (!empty($poligon_css)) {
			$atts['poligon_style'] = ' style="' . $poligon_css . '"';
		}

		$atts['posts'] = $posts;

		$atts['filtering_type'] = $filtering_type;

		ob_start();

		if ( $posts->have_posts() ) {

			// interator
			$int = 0;

			vcs_locate_template( array( 'vc_posts/' . $templates . '/header.php'), $atts );
 
			while ( $posts->have_posts() ) : $posts->the_post();

				$figure = $atts['figures'][$int];

				$atts['figure_name'] = key($figure);
				$atts['figure_path'] = $figure[$atts['figure_name']];

				$atts['class_wrap_filter'] = '';
                $atts['class_wrap_filter'] .= '' . $block_loading_class;

				if ( function_exists('get_pixfields') ) {
					foreach (get_pixfields( get_the_ID() ) as $key => $field) {
						if (!empty($field['filter']) && $field['filter'] == 'on') {
							$atts['class_wrap_filter'] .= ' ' . prague_filter_class($field['value']);
						}
					}
				}

				$post_type = get_post_type( get_the_ID() );
				$post_options = get_post_meta( get_the_ID(), 'prague_post_options', true );
				$service_options = get_post_meta( get_the_ID(), 'service_post_options', true );
				$button_type = isset( $post_type ) && $post_type == 'services' ? $service_options : $post_options;

				if (!empty($button_type['website']) && $button_type['website'] == 'custom_url' && !empty($button_type['custom_url']) ) {
					$atts['url'] = $button_type['custom_url'];
                    if( cs_get_multilang_option('blog_detail') ) {
                        $atts['url_text'] = esc_html( cs_get_multilang_option('blog_detail') );
                    } else {
                        $atts['url_text'] = esc_html__('VIEW MORE', 'prague-plugins');
                    }
				} else {
					$atts['url'] = get_the_permalink();
                    if( cs_get_multilang_option('blog_detail') ) {
                        $atts['url_text'] = esc_html( cs_get_multilang_option('blog_detail') );
                    } else {
                        $atts['url_text'] = esc_html__('READ', 'prague-plugins');
                    }
				}

                if (!empty($enable_new_window)) {
                    $atts['url_window'] = '_blank';
                } else {
                    $atts['url_window'] = '_self';
                }

                $atts['icon_post'] = '';

				if (!empty($button_type['icon_post'])) {
					$atts['icon_post'] = $button_type['icon_post'];
				} 

				if (!empty($service_options['icon_post']) && get_post_type( get_the_ID() ) == 'services') {
					$atts['icon_post'] = $service_options['icon_post'];
				}

				if ($int == 1) {
					$atts['class_wrap_filter'] .= ' column_paralax';
				}

				// include template item
				vcs_locate_template( array( 'vc_posts/' . $templates . '/index.php'), $atts );


				if ($int == 3) {
					$int = 0;
				}

				$int++;

			endwhile;

			vcs_locate_template( array( 'vc_posts/' . $templates . '/footer.php'), $atts );

		}

		wp_reset_postdata();

		?>

		</div>

        <?php if ( !empty($enable_load_more) && in_array($templates, array( 'grid','masonry','services','media','exhibition_grid','books','blog' ) ) ) {
            if ( $total >= 2 ) { ?>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button class="load-btn a-btn-2 creative js-load-more-btn">
                            <span class="a-btn-line"></span>
                            <?php esc_html_e( 'LOAD MORE', 'prague-plugins' ); ?>
                        </button>
                    </div>
                </div>
            <?php } ?>
        <?php }  ?>

		</div>
		<?php
		$output .= ob_get_clean();

		return $output;
	}
}
