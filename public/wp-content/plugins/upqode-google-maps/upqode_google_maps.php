<?php
/*
Plugin Name: UpQode Google Maps
Plugin URI: http://upqode.com
Description: Google Maps shortcodes for Visual Composer
Version: 1.0.5
Author: upqode
Author URI: http://upqode.com
License: A "Slug" license name e.g. GPL2
*/

defined( 'UGM_PLUGIN_ROOT' )    or define( 'UGM_PLUGIN_ROOT',    plugin_dir_path( __FILE__ ) );
defined( 'UGM_PLUGIN_DIR_URL' ) or define( 'UGM_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

class VC_UGM_Addons {
    /**
     * VC_UGM_Addons constructor.
     */
    public function __construct() {

        if( ! function_exists( 'is_plugin_active' ) ) {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }

        if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

            require_once( WP_PLUGIN_DIR . '/js_composer/js_composer.php');

            add_action( 'admin_init', array( $this, 'ugm_settings_field' ) );

            add_action( 'admin_init', array( $this, 'ugm_shortcode_inc' ) );
            add_action( 'wp', array( $this, 'ugm_shortcode_inc' ) );
        }

    }

    public function ugm_shortcode_inc(){
        require_once( UGM_PLUGIN_ROOT . '/shortcodes/vc_ugm_map.php' );
        require_once( UGM_PLUGIN_ROOT . '/shortcodes/vc_ugm_map_marker.php' );
    }

    /**
     * Add Setting Field
     */
    public function ugm_settings_field(){
        register_setting( 'general', 'ugm_google_api_key' );
        add_settings_field(
            'ugm_google_api_key',
            'Google API key',
            array( $this, 'ugm_google_api_key_callback' ),
            'general',
            'default',
            array(
                'id' => 'ugm_google_api_key_id',
                'option_name' => 'ugm_google_api_key'
            )
        );
    }

    /**
     * Settings Field API key Callback
     * @param array $val
     */
    public function ugm_google_api_key_callback( $val ){
        $id = $val[ 'id' ];
        $option_name = $val[ 'option_name' ];
        ?>
        <input
            type="text"
            name="<?php echo $option_name; ?>"
            id="<?php echo $id; ?>"
            value="<?php echo esc_attr( get_option($option_name) ); ?>"
        />
        <?php
    }
}

new VC_UGM_Addons();

/* Return languages array */
if ( ! function_exists( 'ugm_get_language_code' ) ) {
    function ugm_get_language_code() {
        require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );
        $language = array();
        foreach( wp_get_available_translations() as $lan_key => $lang ) {
            $language[ $lang['english_name'] ] = $lan_key;
        }
        return $language;
    }
}