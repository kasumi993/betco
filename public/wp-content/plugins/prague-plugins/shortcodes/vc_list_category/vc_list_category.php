<?php

/*
 * List Category and Posts
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */
if (function_exists('vc_map')) {

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

    vc_map(
        array(
            'name'                    => esc_html__('List Category and Posts', 'js_composer'),
            'base'                    => 'vc_list_category',
            'content_element'         => true,
            'show_settings_on_create' => true,
            'description'             => esc_html__('', 'js_composer'),
            'params'                  => array(

            	array(
            		'type' => 'dropdown',
            		'heading' => __( 'Post types', 'js_composer' ),
            		'param_name' => 'post_type',
            		'value'      => get_vc_post_types($post_types),
            		'description' => __( 'Select source for slider.', 'js_composer' ),
            	),
            	array(
            		'type'        => 'textfield',
            		'heading'     => __( 'Total posts', 'js_composer' ),
            		'param_name'  => 'posts_per_page',
            		'description' => 'Only number'
            	),
            	array(
            		'type'        => 'dropdown',
            		'heading'     => __( ' Select post options', 'js_composer' ),
            		'param_name'  => 'filter_type',
            		'value'       => array_flip(prague_pixfields_get_filterable_metakeys('projects')),
            		'dependency'  => array( 'element' => 'post_type', 'value' => 'projects' )
            	),
            	array(
            		'type'        => 'dropdown',
            		'heading'     => __( ' Select post options', 'js_composer' ),
            		'param_name'  => 'filter_type_2',
            		'value'       => array_flip(prague_pixfields_get_filterable_metakeys('books')),
            		'dependency'  => array( 'element' => 'post_type', 'value' => 'books' )
            	),
            	array(
            		'type'        => 'dropdown',
            		'heading'     => __( ' Select post options', 'js_composer' ),
            		'param_name'  => 'filter_type_3',
            		'value'       => array_flip(prague_pixfields_get_filterable_metakeys('media')),
            		'dependency'  => array( 'element' => 'post_type', 'value' => 'media' )
            	),
            	array(
            		'type'        => 'dropdown',
            		'heading'     => __( ' Select post options', 'js_composer' ),
            		'param_name'  => 'filter_type_4',
            		'value'       => array_flip(prague_pixfields_get_filterable_metakeys('exihibitions')),
            		'dependency'  => array( 'element' => 'post_type', 'value' => 'exihibitions' )
            	),
            	array(
            		'type'        => 'dropdown',
            		'heading'     => __( ' Select post options', 'js_composer' ),
            		'param_name'  => 'filter_type_5',
            		'value'       => array_flip(prague_pixfields_get_filterable_metakeys('exihibitions')),
            		'dependency'  => array( 'element' => 'post_type', 'value' => 'services' )
            	),
                array(
                    'type'        => 'textfield',
                    'heading'     => 'Extra class name',
                    'param_name'  => 'el_class',
                    'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.',
                    'value'       => '',
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => 'CSS box',
                    'param_name' => 'css',
                    'group'      => 'Design options',
                ),
            ),
            //end params
        )
    );
}
if (class_exists('WPBakeryShortCode')) {
    /* Frontend Output Shortcode */
    class WPBakeryShortCode_vc_list_category extends WPBakeryShortCode
    {
        protected function content($atts, $content = null)
        {

        	extract( shortcode_atts( array(
				'posts_per_page'   => '',
				'post_type'   => 'post',
				'filter_type_2' => '',
				'filter_type_3' => '',
				'filter_type_4' => '',
				'filter_type_5' => '',
				'filter_type'   => '',
			), $atts ) );

            

            if (!empty($filter_type_2)) {
                $filter_type = $filter_type_2;
            }
            if (!empty($filter_type_3)) {
                $filter_type = $filter_type_3;
            }
            if (!empty($filter_type_4)) {
                $filter_type = $filter_type_4;
            }
            if (!empty($filter_type_5)) {
                $filter_type = $filter_type_5;
            }

            $projects = array_flip(prague_pixfields_get_filterable_metakeys($post_type));
            /* get first pixfields as empty field */
            if (empty($filter_type)) {
                $filter_type = reset($projects);
            }

        	$taxonomies = get_taxonomies(array('object_type' => array($post_type) ), 'names','and');


            if ($post_type != 'post') {
                $all_terms = get_terms(array_shift($taxonomies));
            } else {
                $all_terms = get_categories();
            }

        	if ( empty($all_terms) ) return '';

        	ob_start(); 
        	foreach ($all_terms as $term) : 
        		$term_data = get_term_meta( $term->term_id, '_category_options', true );
        		?>
        	<div class="prague-categories-outer">
        		<div class="container-fluid no-padd top-banner categories fullheight light">
        			<span class="overlay"></span>
        			<?php if (!empty($term_data['category_image'])): 
                        echo prague_lazy_load_image( $term_data['category_image'],
                            array(
                              'class' => 's-img-switch',
                              'alt'   => ''
                            )
                        );
        				?>
        			<?php endif ?>
        			<div class="content">
	        			<?php if (!empty($term->description)): ?>
	        				<div class="subtitle"><?php echo wp_kses_post( $term->description ); ?></div>
	        			<?php endif ?>
	        			<?php if (!empty($term->name)): ?>
        				<h1 class="title"><?php echo esc_html( $term->name ); ?></h1>
	        			<?php endif ?>
        			</div>
        		</div>

        		<div class="container padd-only-xs">
        			<div class="row">
        				<div class="col-xs-12">
        					<div class="row prague_grid prague_categoties prague_count_col4 prague_gap_col15" data-columns="prague_count_col4" data-gap="prague_gap_col15">
        						<div class="prague_categories_btn">
        							<div class="categories_btn categories_btn_up">
        								<i class="fa fa-chevron-up" aria-hidden="true"></i>
        								<span><?php esc_html_e('PREV', 'prague-plugins'); ?></span>
        							</div>
        							<div class="categories_btn categories_btn_down">
        								<span><?php esc_html_e('NEXT', 'prague-plugins'); ?></span>
        								<i class="fa fa-chevron-down" aria-hidden="true"></i>
        							</div>
        						</div>
								<?php 
								$taxonomies = get_taxonomies(array('object_type' => array($post_type) ), 'names','and');

								// for custom posttype
								$category = '';
								if ($post_type != 'post') {
									$category = array(
										'taxonomy' => array_shift($taxonomies),
										'field'    => 'term_id',
										'terms'    => $term->term_id
									);
								}

								$args = array(
									'tax_query' => array(
										$category
									)
								);

								if ($post_type == 'post') {
									$args['category__in'] = $term->term_id;
								}

								if ( ! empty( $posts_per_page ) && is_numeric( $posts_per_page ) ) {
									$args['posts_per_page'] = $posts_per_page;
								} 

								$posts = new WP_Query( $args );
								// start loop
								while ( $posts->have_posts() ) : $posts->the_post();
								?>
        						<div class="portfolio-item-wrapp  p_f_d7a8462 p_f_ddba60a p_f_aebfe46">
        							<div class="portfolio-item">
        								<div class="project-grid-wrapper">
        									<a class="project-grid-item-img-link" href="<?php the_permalink(); ?>">
        										<div class="project-grid-item-img">
        											<?php the_post_thumbnail( 'medium_large', array(
        												'class' => 's-img-switch wp-post-image'
        											) ); ?> 
        										</div>
        									</a>
        									<div class="project-grid-item-content">
        										<?php the_title( '<h4 class="project-grid-item-title"><a href="' . get_the_permalink() . '">', '</a></h4>' ); ?> 
        										<?php  
                                                if (!empty($filter_type)): ?>
        											<div class="project-grid-item-category">
                                                    <?php if ( function_exists('get_pixfield') ): ?>
                                                        <?php echo esc_html( get_pixfield($filter_type, get_the_ID() ) ); ?>
                                                    <?php endif ?>
                                                    </div>
        										<?php endif ?> 
        									</div>
        								</div>
        							</div>
        						</div>
        						
        						<?php 
        						endwhile;
        						wp_reset_postdata();

        						?>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        	<?php
        	endforeach;
        	return ob_get_clean();
        }
    }
}