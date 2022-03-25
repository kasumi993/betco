<?php
/**
 * Helper functions (theme)
 *
 * @package prague
 * @since 1.0.0
 *
 */

/**
 * Custom menu
 */
if ( ! function_exists( 'prague_custom_menu' ) ) {
	function prague_custom_menu()
	{
		if ( has_nav_menu( 'top-menu' ) ) {
			wp_nav_menu(
				array(
					'container'      => '',
					'items_wrap'     => '<ul class="main-menu">%3$s</ul>',
					'theme_location' => 'top-menu',
					'depth'          => 3
				)
			);
		} else {
			echo '<div class="no-menu">' . esc_html__( 'Please register Top Navigation from', 'prague' ) . ' <a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . esc_html__( 'Appearance &gt; Menus', 'prague' ) . '</a></div>';
		}
	}
}

if ( ! function_exists( 'prague_get_post_shortcode_params' ) ) {
	function prague_get_post_shortcode_params($tag_shortcode, $string = '', $all = false)
	{

		if (empty($tag_shortcode)) return false;

		if (empty($string)) {
			global $post;
			if (empty($post)) {
				return false;
			}
			$string = $post->post_content;
		}
		
		preg_match_all( "/" . get_shortcode_regex(array($tag_shortcode)) . "/si" ,
					$string,
					$matchs );
		if (!empty($matchs[0])) {

			if ($all) {
				$params = array();
				foreach ($matchs[0] as $key => $param) {
					$this_param = str_replace('"]', '" ]', $matchs[$key][0]);
					$atts = shortcode_parse_atts($this_param);
					if (is_array($atts)) {
					$this_param = array_slice($atts, 1, -1);
						$params[] = $this_param;
					}
				}
				return $params;
			}

			$params = str_replace('"]', '" ]', $matchs[0][0]);
			$params = array_slice(shortcode_parse_atts($params), 1, -1);
			if (is_array($params)) {
				return $params;
			}
			return false;
		}
		return false;

	}
}

/**
 * Replaces the excerpt "more" text by a link
 */
if ( ! function_exists( 'prague_excerpt_more' ) ) {
	function prague_excerpt_more()
	{
	    global $post;

		return '<a class="moretag" href="'. esc_url(get_permalink($post->ID)) .'">'. esc_html__( 'Read more', 'prague' ) .'</a>';
	}
	add_filter('excerpt_more', 'prague_excerpt_more');
}


/**
 * Return header logo
 */
if ( ! function_exists( 'prague_logo' ) ) {
	function prague_logo()
	{

		if ( !function_exists( 'cs_framework_init' ) || cs_get_option('site_logo') ) {


			// for text logo
			if ( cs_get_option('site_logo') == 'txtlogo' ) {
				echo esc_html( cs_get_option('text_logo') );
			}
			
			// for image logo
			if ( !function_exists( 'cs_framework_init' ) || cs_get_option('site_logo') == 'imglogo') {
				if ( is_home() ) {
                    $page_id = get_option('page_for_posts');
                } elseif ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_shop() ) {
                    $page_id = wc_get_page_id('shop');
                } elseif ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_cart() ) {
                    $page_id = wc_get_page_id('cart');
                } elseif ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_checkout() ) {
                    $page_id = wc_get_page_id('checkout');
                } else {
                    $page_id = get_the_ID();
                }
				$prague_post_options = get_post_meta( $page_id, 'prague_post_options', true );
				$service_post_options = get_post_meta( $page_id, 'service_post_options', true );

				$image_logo = cs_get_option('image_logo');

				if ( !empty($prague_post_options['image_logo']) ) {
					$image_logo = $prague_post_options['image_logo'];
				}

				if ( !empty($service_post_options['image_logo']) && get_post_type() == 'services' ) {
					$image_logo = $service_post_options['image_logo'];
				}


				if ( !empty($image_logo) ) {

					echo wp_get_attachment_image( $image_logo, 'medium', '', array('class'=>'image_logo') ); 

				} else { // default image

					echo '<img class="logo__img" src="'. PRAGUE_URI .'/assets/img/logo.png' .'" alt="'. esc_attr( get_bloginfo( 'name' ) ) .'" />';

				}
			} elseif(cs_get_option('site_logo') != 'txtlogo') {
				echo '<img class="logo__img" src="'. PRAGUE_URI .'/assets/img/logo.png' .'" alt="'. esc_attr( get_bloginfo( 'name' ) ) .'" />';
			}
		} 
	}
}

/**
 * Return footer logo
 */
if (!function_exists('footer_logo')) {
	function footer_logo()
	{
		if ( cs_get_multilang_option('footer_text_logo') || cs_get_option('footer_image_logo') || cs_get_multilang_option('footer_content') ) : ?>
		<div class="prague-logo">
			<a href="<?php echo esc_url( home_url('/') ); ?>">
				<?php

					// for text logo
					if ( cs_get_multilang_option('footer_logo') == 'txtlogo' ) {
						echo esc_html( cs_get_multilang_option('footer_text_logo') );
					}

					// for image logo
					if ( cs_get_option('footer_logo') == 'imglogo' && cs_get_option('footer_image_logo')) {
						echo wp_get_attachment_image( cs_get_option('footer_image_logo'), 'full' ); ; 
					}

				?>
			</a>
		</div>
		<?php endif;
	}
}


/**
 * Comments template
 **/
if ( ! function_exists( 'prague_comment' ) ) {
	function prague_comment( $comment, $args, $depth )
	{
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ):
			case 'pingback':
			case 'trackback': ?>
				<div class="pingback">
					<?php esc_html_e( 'Pingback:', 'prague' ); ?> <?php comment_author_link(); ?>
					<?php edit_comment_link( esc_html__( '(Edit)', 'prague' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
				<?php
				break;
			default: ?>
				<li <?php comment_class('ct-part'); ?> id="li-comment-<?php comment_ID(); ?>">
					<div class="comm-block" id="comment-<?php comment_ID(); ?>">
						<div class="comm-img">
							<?php echo get_avatar( $comment, 80 ); ?>
						</div>
						<div class="comm-txt">
							<h4><?php comment_author(); ?></h4>
							<div class="date-post">
								<h6>
									<?php 
									if ( cs_get_option('enable_human_diff') ) { 
										echo human_time_diff( 
											get_comment_time('U'),
											current_time('timestamp')
										) . ' ' . esc_html__( 'ago', 'prague' );
									} else {
										comment_date( get_option('date_format') );
									} 
									?>
								</h6> 
							</div>
							<?php comment_text(); ?>
							<?php comment_reply_link(
								array_merge( $args,
									array(
										'reply_text' => esc_html__( 'Reply', 'prague' ),
										'after' 	 => '',
										'depth' 	 => $depth,
										'max_depth'  => $args['max_depth']
									)
								)
							); ?>
						</div>
					</div>
			<?php
			break;
		endswitch;
	}
}


/* create unique class for filter */
if (!function_exists('prague_filter_class')) {
	function prague_filter_class($string = ''){

		if (empty($string)) return '';
		return 'p_f_' . substr(md5($string), 0, 7);
	}
}

/* is elements of in the array */
if (!function_exists('prague_in_array_any')) {
	function prague_in_array_any($needles) {
		unset($needles['image']);
		unset($needles['position']);
		$errors = array_filter($needles);
		if (!empty($errors)) {
			return true;
		}
		return false;
	}
}

/* social icon list */
if (!function_exists('prague_social_nav')) {
	function prague_social_nav($socials = array(), $style='')
	{
		if (!empty($socials)) :
		?>
		<div class="prague-social-nav">

			<?php if ($style == 'simple') { ?>
			<a href="#">
				<i class="fa fa-chain-broken" aria-hidden="true"></i>
			</a>
			<?php } ?>
			
			<ul class="social-content">
			<?php foreach ( $socials as $social ) : ?>
				<?php if (!empty($social['show_social_icon'])): ?>
				<li>
					<a target="_blank" href="<?php echo esc_url( $social['link'] ); ?>">
						<i aria-hidden="true" class="<?php echo esc_attr( $social['social_icon'] ); ?>"></i>
					</a>
				</li>
				<?php endif ?>
			<?php endforeach; ?>
			</ul>

		</div>
		<?php 
		endif;
	}
}

/* get metakeys from post type (for pixfields plugin)*/
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
				if (!empty($fields['filter']) && $fields['filter'] == 'on') {
					$return[$fields['meta_key']] = $fields['label'];
				}
			}
		}

		return $return;
	}
}

/* get metakeys from post type (for pixfields plugin)*/
if (!function_exists('prague_pixfields_get_all_filterable_metakeys')) {
    function prague_pixfields_get_all_filterable_metakeys($post_type){

        if ( !class_exists('PixFieldsPlugin') ) {
            return array();
        }

        global $pixfields_plugin;
        $fields_list = $pixfields_plugin->get_pixfields_list();
        $return = array();
        if ( isset( $fields_list[$post_type]  ) ) {
            foreach ( $fields_list[$post_type] as $key => $fields ) {
                if (!empty($fields['filter'])) {
                    $return[$fields['meta_key']] = $fields['label'];
                }
            }
        }
        return $return;
    }
}

/* render filter (for pixfields plugin)*/
if ( !function_exists('prague_render_filter') ) {
	function prague_render_filter()
	{	

		/* Get and Render Filter */
		$params = prague_get_post_shortcode_params('vc_projects_posts');
 		
 		// default post type
		if (empty($params['post_type'])) {
			$params['post_type'] = 'post';
		}

		if ( !empty($params['filter']) && $params['filter'] == 'enable' && !empty($params['post_type']) && empty($params['filter_position']) ) {

			// for filter
			$defaults = array(
				'post_type' => $params['post_type'],
				'orderby' => '',
				'order' => '', 
			);
		
			$args = array_intersect_key( $params, $defaults );

			$args['posts_per_page'] = '-1';

			$post_query = new WP_Query( $args );
			$categories = array();
			$title_categories = array();

			foreach ($post_query->posts as $key => $post) {
				$keys = prague_pixfields_get_filterable_metakeys($params['post_type']);
				foreach ($keys as $key2 => $value) {
					$categories[$key2][$key] = get_pixfield($key2, $post->ID);
                    $title_categories[$key2][$key] = $value;
				}
			}

			$filtering_type = '';
			if (!empty($params['filtering_type'])) {
				$filtering_type = $params['filtering_type'];
			}
			?>
			<div class="prague_filter_projects">
				<div class="prague_filter_projects_wrapper">
					<?php foreach ($categories as $key => $category) { ?>
						<div class="prague_filter_item">
                            <?php
                            // $title_categories
                            $keys_categories = array_keys($title_categories);
                            $filter_key = array_search( $key, $keys_categories );
                            $filter_title = $title_categories[$keys_categories[$filter_key]][0];
                            ?>
							<h2 class="filter_item_title"><?php echo esc_html( $filter_title ); ?></h2>
							<ul class="filter_item_category">
								<?php 
								$category = array_flip($category); 
								ksort($category);
								foreach ($category as $key2 => $value) { ?>
								<li data-filter="<?php echo esc_attr( prague_filter_class($key2) ); ?>"><?php echo esc_html( $key2 ); ?></li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>
				</div>
				<div class="prague_filter_link_wrapper">
					<a class="filter-btn a-btn-2 simple" href="#" data-filtering-type="<?php echo esc_attr( $filtering_type ); ?>">
						<span class="a-btn-line"></span>
						<?php esc_html_e('FILTER', 'prague'); ?>
					</a>
				</div>
				<div class="prague_filter_link_wrapper">
					<a class="filter-clear-all" href="#"> 
						<?php esc_html_e('CLEAR ALL', 'prague'); ?>
					</a>
				</div>
			</div>
			
			<div class="filter-nav">
				<a href="#">
					<i class="fa fa-filter" aria-hidden="true"></i>
					<?php esc_html_e('FILTER', 'prague'); ?>
				</a>
			</div>
			<?php wp_reset_postdata();
		}
	}
}


/*
 * Add file picker shartcode param.
 *
 * @param array $settings   Array of param seetings.
 * @param int   $value      Param value.
 */
function file_picker_settings_field( $settings, $value ) {
	$output = '';
	$select_file_class = '';
	$remove_file_class = ' hidden';
	$attachment_url = wp_get_attachment_url( $value );
	if ( $attachment_url ) {
		$select_file_class = ' hidden';
		$remove_file_class = '';
	}
	$output .= '<div class="file_picker_block">
                <div class="' . esc_attr( $settings['type'] ) . '_display">' .
		$attachment_url .
		'</div>
                <input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
		esc_attr( $settings['param_name'] ) . ' ' .
		esc_attr( $settings['type'] ) . '_field" value="' . esc_attr( $value ) . '" />
                <button class="button file-picker-button' . $select_file_class . '">Select File</button>
                <button class="button file-remover-button' . $remove_file_class . '">Remove File</button>
              </div>
              ';
	return $output;
}

if( class_exists( 'Vc_Manager' ) ) {
	vc_add_shortcode_param( 'file_picker', 'file_picker_settings_field', get_template_directory_uri() . '/assets/js/file_picker.js' );
}

