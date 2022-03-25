<?php
/**
 * The template includes necessary functions for theme.
 *
 * @package prague
 * @since 1.0.0
 *
 */

if ( ! isset( $content_width ) ) {
    $content_width = 1200; // pixel
}
 

// ------------------------------------------
// Global define for theme
// ------------------------------------------
defined( 'PRAGUE_URI' )    or define( 'PRAGUE_URI',    get_template_directory_uri() );
defined( 'PRAGUE_T_PATH' ) or define( 'PRAGUE_T_PATH', get_template_directory() );
defined( 'PRAGUE_F_PATH' ) or define( 'PRAGUE_F_PATH', PRAGUE_T_PATH . '/include' );
 
// ------------------------------------------
// Framework integration
// ------------------------------------------

/* Include all styles and scripts. */
require_once PRAGUE_F_PATH .'/custom/action-config.php';

/* Helper functions */
require_once PRAGUE_F_PATH .'/custom/helper-functions.php';

/* Svg stroke animation */
require_once PRAGUE_F_PATH .'/custom/lib/FoxEasySVG.php';

/* Lazu load */
require_once PRAGUE_F_PATH .'/custom/foxlazy.php';

// Plugin activation class.
require_once PRAGUE_F_PATH .'/plugins/class-tgm-plugin-activation.php';

/* For updates */
require_once PRAGUE_F_PATH .'/wp-updates-theme.php';
new WPUpdatesThemeUpdater_2012( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) );

// Woocommerce support
if ( class_exists( 'WooCommerce' ) ) {
    require_once PRAGUE_T_PATH . '/woocommerce-support.php';
}

// ------------------------------------------
// Setting theme after setup
// ------------------------------------------
if ( ! function_exists( 'prague_after_setup' ) ) {
    function prague_after_setup()
    {
        load_theme_textdomain( 'prague', PRAGUE_T_PATH .'/languages' );

        register_nav_menus(
            array(
                'top-menu' => esc_html__( 'Top menu', 'prague' ),
                'footer-menu' => esc_html__( 'Footer menu', 'prague' ),
            )
        );
        
        add_theme_support( 'custom-header' );
        add_theme_support( 'custom-background' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
    }
}
add_action( 'after_setup_theme', 'prague_after_setup' );

/*
 * Check need minimal requirements (PHP and WordPress version)
 */
if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) || version_compare( PHP_VERSION, '5.3', '<' ) ) {
    function prague_requirements_notice()
    {
        $message = sprintf( __( 'prague theme needs minimal WordPress version 4.3 and PHP 5.3<br>You are running version WordPress - %s, PHP - %s.<br>Please upgrade need module and try again.', 'prague' ), $GLOBALS['wp_version'], PHP_VERSION );
        printf( '<div class="notice-warning notice"><p><strong>%s</strong></p></div>', $message );
    }
    add_action( 'admin_notices', 'prague_requirements_notice' );
}

/*
 * Add custom classes to body
 */
if ( ! function_exists( 'prague_wp_body_classes' ) ) {
	function prague_wp_body_classes( $classes ) {
		global $prague_body_class;

		if ( is_page() || is_home() ) {
			$post_id = get_queried_object_id();
		} else {
			$post_id = get_the_ID();
		}

		$meta_data           = get_post_meta( $post_id, 'prague_post_options', true );


		if( isset($meta_data['bottom_menu']) && $meta_data['bottom_menu'] ) {
			$prague_body_class .= ' bottom_menu';
		} else {
			$prague_body_class .= '';
		}

		$prague_body_class = explode(' ', $prague_body_class);

		foreach ($prague_body_class as $class){
			$classes[] = $class;
		}

		return $classes;
	}
}
add_filter( 'body_class','prague_wp_body_classes' );