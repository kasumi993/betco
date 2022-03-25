<?php 
/* All functions for WooCommerce */

/* add support woocommerce to theme */
if ( ! function_exists('prague_woocommerce_support' ) ) {
	function prague_woocommerce_support( ) {
		add_theme_support( 'woocommerce' );
	}
}
add_action( 'after_setup_theme', 'prague_woocommerce_support' );

if ( ! function_exists('prague_woocommerce_scripts')) {
	function prague_woocommerce_scripts() {

		// prague options
		$prague = wp_get_theme();
	}
}
add_action( 'wp_enqueue_scripts', 'prague_woocommerce_scripts');

/* Shop banner */
if ( ! function_exists('prague_woocommerce_banner')) {
    function prague_woocommerce_banner() {

        $show_banner          = cs_get_option('show_banner');
        $bg_banner_shop       = cs_get_option('bg_banner_shop');
        $title_banner_shop    = cs_get_option('title_banner_shop');
        $subtitle_banner_shop = cs_get_option('subtitle_banner_shop');

        if ( isset( $show_banner ) && $show_banner ) :
          $output = '<section class="container-fluid top-banner no-padd big fullheight light"><span class="overlay"></span>';

                if ( ! empty( $bg_banner_shop ) ) :
                    $output .= wp_get_attachment_image( $bg_banner_shop, 'large', '', array('class'=>'s-img-switch') );
                endif;

                $output .= '<div class="content">';

                    if ( ! empty( $subtitle_banner_shop ) ) :
                        $output .= '<div class="subtitle">' . esc_html( $subtitle_banner_shop ) . '</div>';
                    endif;

                    if ( ! empty( $title_banner_shop ) ) :
                        $output .= '<h1 class="title">' . wp_kses_post( $title_banner_shop )  . '</h1>';
                    endif;

                $output .= '</div>';

            $output .= '</section>';

            echo $output;

        endif;
        
    }
}
add_action( 'prague_shop_banner', 'prague_woocommerce_banner');

/*
* Mikos count product on page woocommerce
*/
$count_product_list = cs_get_option('count_product_list');
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $count_product_list . ';' ), 100 );

function prague_pagination_nav( $max_num_pages = '' ) {
    // Get max_num_pages if not provided
    if ( '' == $max_num_pages )
        $max_num_pages = $GLOBALS['wp_query']->max_num_pages;

    // Don't print empty markup if there's only one page.
    if ( $max_num_pages < 2 ) {
        return;
    }
    ?>

    <div class="pagination clearfix">
        <?php if ( get_previous_posts_link( '', $max_num_pages ) ) : ?>
            <div class="previus-post"><i class="fa fa-angle-left"></i> <?php previous_posts_link( esc_html__('Previous Page','prague'), $max_num_pages ); ?></div>
        <?php endif; ?>

        <?php if ( get_next_posts_link( '', $max_num_pages ) ) : ?>
            <div class="next-post"><?php next_posts_link( esc_html__('Next Page','prague'), $max_num_pages ); ?> <i class="fa fa-angle-right"></i></div>
        <?php endif; ?>
    </div>

    <?php
}

/* eccommerce_theme_options filters */
if ( ! function_exists('prague_woocommerce_theme_options')) {
	function prague_woocommerce_theme_options($options) {
		$options[] = array(
			'name'   => 'ecommerce_options',
			'title'  => 'Ecommerce',
			'icon'   => 'fa fa-shopping-cart',
			// begin: fields
			'fields' => array(
                array(
                  'type'    => 'subheading',
                  'content' => 'Shop banner',
                ),
                array(
                  'id'      => 'show_banner',
                  'type'    => 'switcher',
                  'title'   => 'Show banner',
                  'default' => true
                ),
                array(
                  'id'         => 'bg_banner_shop',
                  'type'       => 'image',
                  'title'      => 'Background banner shop',
                  'add_title'  => 'Add Image',
                  'dependency' => array( 'show_banner', '==', 'true' )
                ),
                array(
                  'id'         => 'title_banner_shop',
                  'type'       => 'textarea',
                  'title'      => 'Title banner shop',
                  'dependency' => array( 'show_banner', '==', 'true' )
                ),
                array(
                  'id'         => 'subtitle_banner_shop',
                  'type'       => 'text',
                  'title'      => 'Subitle banner shop',
                  'dependency' => array( 'show_banner', '==', 'true' )
                ),

                array(
                  'type'    => 'subheading',
                  'content' => 'Other settings',
                ),
                array(
                    'id'      => 'products_per_row',
                    'type'    => 'select',
                    'title'   => 'Products per row',
                    'options' => array(
                        'columns-2'  => 'Two columns',
                        'columns-3'  => 'Three columns',
                        'columns-4'  => 'Four columns',
                    ),
                    'default' => 'columns-4',
                ),
                array(
                  'id'    => 'count_product_list',
                  'type'  => 'text',
                  'title' => 'Count product list',
                ),
                array(
                    'id'      => 'show_sorting_shop',
                    'type'    => 'switcher',
                    'title'   => 'Show/Hide sorting list',
                    'default' => false
                ),
                array(
                    'id'      => 'show_related_posts',
                    'type'    => 'switcher',
                    'title'   => 'Show/Hide related posts',
                    'default' => false
                ),
                array(
                    'id'      => 'show_shop_sidebar',
                    'type'    => 'switcher',
                    'title'   => 'Show/Hide sidebar',
                    'default' => false
                ),
			),
		);
		return $options;
	}
}
add_filter( 'eccommerce_theme_options', 'prague_woocommerce_theme_options' );

/*
* Popup single product.
*/
add_action( 'after_setup_theme', 'artabr_theme_setup' );
function artabr_theme_setup() {
   add_theme_support( 'wc-product-gallery-lightbox' );
   add_theme_support( 'wc-product-gallery-slider' );
}