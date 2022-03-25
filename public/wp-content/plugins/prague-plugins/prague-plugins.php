<?php
/*
Plugin Name: Prague Plugins
Version: 2.1.0
Description: Visual Composer Shortcodes
*/


// add in constant name path
defined( 'EF_ROOT')		or  define( 'EF_ROOT', dirname(__FILE__));

defined( 'T_URI' )      or  define( 'T_URI',  get_template_directory_uri() );
defined( 'T_IMG' )		or 	define(	'T_IMG',	T_URI . '/assets/images' );

defined( 'T_PATH' )     or  define( 'T_PATH', get_template_directory() );


defined( 'CS_ACTIVE_FRAMEWORK' )  or  define( 'CS_ACTIVE_FRAMEWORK',  true );
defined( 'CS_ACTIVE_METABOX'   )  or  define( 'CS_ACTIVE_METABOX',    true );
defined( 'CS_ACTIVE_TAXONOMY'   ) or  define( 'CS_ACTIVE_TAXONOMY',   true );
defined( 'CS_ACTIVE_SHORTCODE' )  or  define( 'CS_ACTIVE_SHORTCODE',  false );
defined( 'CS_ACTIVE_CUSTOMIZE' )  or  define( 'CS_ACTIVE_CUSTOMIZE',  false );
 
// Framework Integration
require_once EF_ROOT . '/includes/cs-framework/cs-framework.php';
require_once EF_ROOT . '/includes/lib/aq_resizer.php';
require_once EF_ROOT . '/includes/lazy_load.php';
require_once EF_ROOT . '/includes/lib/font-class.php';
require_once EF_ROOT . '/includes/custom_icon.php';
require_once EF_ROOT . '/includes/helper-functions.php';


/* For Update */
require_once EF_ROOT . '/includes/wp-updates-plugin.php';
new WPUpdatesPluginUpdater_1635( 'http://wp-updates.com/api/2/plugin', plugin_basename(__FILE__));

// Import Integration
require_once( EF_ROOT . '/importer/index.php' );

// add a skin in a plugin/theme
add_filter('tg_add_item_skin', function($skins) {
	$dir            = __DIR__ . '/the-grid/';
	$directory_list = scandir( $dir );
	$directory_list = array_slice( $directory_list, 2 );
	foreach ( $directory_list as $directory ) {
		$directory_templates_list = scandir( $dir . $directory );
		$directory_templates_list = array_slice( $directory_templates_list, 2 );
		foreach ( $directory_templates_list as $list ) {
			$name = str_replace( '-', ' ', $list );
			$name = substr( $name, 3 );
			// register a skin and add it to the main skins array
			$skins[$list] = array(
				'type'   => $directory,
				'slug'   => $list,
				'name'   => $name,
				'php'    => EF_ROOT . '/the-grid/'. $directory .'/'. $list .'/'. $list .'.php',
				'css'    => EF_ROOT . '/the-grid/'. $directory .'/'. $list .'/'. $list .'.css',
				'col'    => 1, // col number in preview skin mode
				'row'    => 1  // row number in preview skin mode
			);
		}
	}
	// return the skins array + the new one you added (in this example 2 new skins was added)
	return $skins;
});


// Custom post type Integration
require_once( EF_ROOT . '/includes/post-type.php'); 

if( ! class_exists( 'Prague_Plugins' ) ) {

	class Prague_Plugins {

		private $assets_js;
		private $assets_css;

		public function __construct() { 
			$this->assets_js = plugins_url('/includes/assets/js', __FILE__);
			$this->assets_css = plugins_url('/includes/assets/css', __FILE__);

			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

				require_once( WP_PLUGIN_DIR . '/js_composer/js_composer.php');

				add_action( 'admin_init', array($this, 'upqode_init') );
				add_action( 'wp', array($this, 'upqode_init') );

				//enqueue scripts
				add_action( 'admin_print_scripts-post.php', array($this, 'vc_enqueue_scripts'), 99);
				add_action( 'admin_print_scripts-post-new.php', array($this, 'vc_enqueue_scripts'), 99);

				add_action( 'wp_ajax_nopriv_prague_get_pixfields', array($this, 'prague_ajax_get_pixfields') );
				add_action( 'wp_ajax_prague_get_pixfields', array($this, 'prague_ajax_get_pixfields') );

			}
		}

		public function assets_js()
		{
			return $this->assets_js;
		}

		public function assets_css()
		{
			return $this->assets_css;
		}

		//include custom map 
		public function upqode_init(){

			if (file_exists(EF_ROOT .'/composer/init.php')) {

				require_once( EF_ROOT .'/composer/init.php');

				$directories = glob(EF_ROOT . '/shortcodes/*' , GLOB_ONLYDIR);
				foreach( $directories as $shortcode ) {
					require_once(EF_ROOT .'/shortcodes/'. basename( $shortcode ) . '/' .basename( $shortcode ) . '.php' );
				}

			}

		}

		public static function prague_plugin_dir()
		{
			return plugin_dir_path( __FILE__ );
		}

		public function prague_ajax_get_pixfields()
		{
			$options = array();
			if (!empty($_POST['pix_category'])) {

				global $pixfields_plugin;
				$fields_list = $pixfields_plugin->get_pixfields_list();

				if ( !empty( $fields_list[$_POST['pix_category']]  ) ) {
					$options = $fields_list[$_POST['pix_category']];
				}
				 
			} 

			echo json_encode($options);

			die();
		}

		//include scripts
		public function vc_enqueue_scripts() {
			wp_enqueue_script( 'vc-script', $this->assets_js .'/vc-script.js' ,  array('jquery'), '1.0.0', true );   
		}



	} // end of class

	new Prague_Plugins;

	if ( ! function_exists( 'vcs_load_template' ) ) {
		function vcs_load_template( $_template_file, $require_once = true, $data = '' ) {
			global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

			if ( is_array( $wp_query->query_vars ) ) {
				extract( $wp_query->query_vars, EXTR_SKIP );
			}

			if ( isset( $s ) ) {
				$s = esc_attr( $s );
			}

			if ( $require_once ) {
				require_once( $_template_file );
			} else {
				require( $_template_file );
			}
		}
	}

	if ( ! function_exists( 'vcs_locate_template' ) ) {
		function vcs_locate_template( $template_names, $data = '', $load = true, $require_once = false ) {
			// No file found yet
			$located = false;

			// get dir current plugin
			$plugin_dir = '';
			if (class_exists('Prague_Plugins')) {
				$plugin_dir = Prague_Plugins::prague_plugin_dir();
			}
		 
			// Try to find a template file
			foreach ( (array) $template_names as $template_name ) {
		 
				// Continue if template is empty
				if ( empty( $template_name ) )
					continue;
		 
				// Trim off any slashes from the template name
				$template_name = apply_filters('vcs_locate_template_name', ltrim( $template_name, '/' ));
		 
				// Check child theme first
				if ( file_exists( trailingslashit( get_stylesheet_directory() ) . 'fox_templates/' . $template_name ) ) {
					$located = trailingslashit( get_stylesheet_directory() ) . 'fox_templates/' . $template_name;
					break;
		 
				// Check parent theme next
				} elseif ( file_exists( trailingslashit( get_template_directory() ) . 'fox_templates/' . $template_name ) ) {
					$located = trailingslashit( get_template_directory() ) . 'fox_templates/' . $template_name;
					break;
		 
				// Check theme compatibility last
				} elseif ( file_exists( trailingslashit( $plugin_dir ) . 'shortcodes/' . $template_name ) ) {
					$located = trailingslashit( $plugin_dir ) . 'shortcodes/' . $template_name;
					break;
				}
			}

			$located = apply_filters('fox_templates_locate', $located );
		 	
			if ( ( true == $load ) && ! empty( $located ) )
				vcs_load_template( $located, $require_once, $data );
		 
			return $located;
		}

	}

	/* Get all template shortcodes */
	if ( ! function_exists( 'vc_get_shortcode_template' ) ) {

		function vc_get_shortcode_template($shortcode_name)
		{	
			$default_headers = array(
				'Template' => 'Template',
				'Version' => 'Version',
			);

			$templates = array();
			if (!empty($shortcode_name)) {
				$template_dir = vcs_locate_template( array( $shortcode_name ),'',false);
				$directories = glob( $template_dir .'/*' , GLOB_ONLYDIR);

				$data = array();
				foreach ($directories as $key => $directory) {

					if (basename( $directory ) == 'assets') continue;

					if (file_exists($directory . '/index.php')) {
						$data = get_file_data($directory . '/index.php', $default_headers);
					}
					if (basename( $directory ) ) 
					if (empty($data['Template'])) {
						$data['Template'] = 'Style ' . ($key+1);
					}
					$templates[$data['Template']] = basename( $directory );
				}
			}
			return $templates;
		}
	}

	if ( function_exists('vc_add_shortcode_param') ) {

		if (!function_exists('prague_wpc_date')) {
			function prague_wpc_date($settings, $value) {
			    return '<div class="date-group">'
			           . '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-date ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="text" value="' . $value . '"/>'
			           . '</div>';
			}
		}
		vc_add_shortcode_param('wpc_date', 'prague_wpc_date', get_template_directory_uri() . '/assets/js/date.min.js');
	}
	

	function prague_wpc_date_style() {
	    wp_enqueue_script('jquery-ui-datepicker' );
	}
	add_action( 'admin_enqueue_scripts', 'prague_wpc_date_style' );


	if ( ! function_exists( 'cs_get_multilang_option' ) ) {
		function cs_get_multilang_option()
		{
			return '';
		}
	}

} // end of class_exists
/**
 * Get link pages.
 */
function prague_get_link( $label = NULL, $dir = 'next', WP_Query $query = NULL ) {
    if ( is_null( $query ) ) $query = $GLOBALS['wp_query'];
    $max_page = ( int ) $query->max_num_pages;

    // Only one page for the query, do nothing
    if ( $max_page <= 1 ) return;
    $paged = ( int ) $query->get( 'paged' );
    if ( empty( $paged ) ) $paged = 1;
    $target_page = $dir === 'next' ?  $paged + 1 : $paged - 1;
    // If we are in 1st page and required previous or in last page and required next,
    // do nothing
    if ( $target_page < 1 || $target_page > $max_page ) return;
    return get_pagenum_link( $target_page );
}




// register scripts and styles for shortcodes
add_action( 'wp_enqueue_scripts', 'prague_register_scripts' );
function prague_register_scripts() {
	wp_register_script( 'prague-exhibition', PRAGUE_URI . '/assets/js/exhibition.js', array('imagesloaded'), false, true );
	wp_register_script( 'prague-anime', PRAGUE_URI . '/assets/js/anime.min.js', array( 'jquery', 'prague-exhibition' ), false, true );
	wp_register_script( 'prague-diagonal', PRAGUE_URI . '/assets/js/diagonal.js', array( 'jquery', 'imagesloaded'), false, true );
}

