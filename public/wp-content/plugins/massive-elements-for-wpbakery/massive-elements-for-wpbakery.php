<?php
/**
 * @package  MEWVC
 */
/*
Plugin Name: Massive Elements For WPBakery
Description: Add new elements to WPBakery Page Builder (Visual Composer), includes: Undo Redo, Draggable Timeline, Metro Carousel and Tile, Zooma or Magnify, Carousel & Gallery, Tabs, Accordion, Image Hotspot with Tooltip, Parallax, Medium Gallery, Stack Gallery, Testimonial Carousel, iHover, Scrolling Notification and Masonry Gallery etc.
Author: wpcodestar
Version: 1.1.5
Requires at least: 4.4
Tested up to:      5.2
Author URI: https://codenat.com
License: GPL2
Text Domain: mewvc
*/

/***
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
***/

// prevent direct access
defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you silly human!' );

define( 'MEWVC_DIR_PATH', plugin_dir_path( __FILE__ ) );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

	// Vendor Composer Autoload
	if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
		require_once dirname( __FILE__ ) . '/vendor/autoload.php';
	}

	//The code that runs during plugin activation
	function activate_weavc_plugin() {
		Inc\Base\Activate::activate();
	}

	register_activation_hook( __FILE__, 'activate_weavc_plugin' );


	//The code that runs during plugin deactivation
	function deactivate_weavc_plugin() {
		Inc\Base\Deactivate::deactivate();
	}

	register_deactivation_hook( __FILE__, 'deactivate_weavc_plugin' );


	//The code that runs during plugin Uninstall
	function uninstall_weavc_plugin() {
		Inc\Base\Uninstall::uninstall();
	}

	register_uninstall_hook( __FILE__, 'uninstall_weavc_plugin' );


	// Redirect Settings Page After Plugin Activation
	function weavc_activation_redirect( $plugin ) {
		if ( $plugin == plugin_basename( __FILE__ ) ) {
			exit( wp_redirect( admin_url( 'admin.php?page=weavc' ) ) );
		}
	}

	add_action( 'activated_plugin', 'weavc_activation_redirect' );

	// Register ALL Services
	if ( class_exists( 'Inc\\Init' ) ) {
		Inc\Init::register_services();
	}
	// Register Extensions Services
	if ( class_exists( 'Inc\\Extensions' ) ) {
		Inc\Extensions::register_services();
	}

} else {
	function weavc_required_plugin() {
		if ( is_admin() && current_user_can( 'activate_plugins' ) && ! is_plugin_active( 'js_composer/js_composer.php' ) ) {
			add_action( 'admin_notices', 'weavc_required_plugin_notice' );

			deactivate_plugins( plugin_basename( __FILE__ ) );

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		}
	}

	add_action( 'admin_init', 'weavc_required_plugin' );

	function weavc_required_plugin_notice() {
		?>
        <div class="error"><p>Error! you need to install or activate the <a href="https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=codenat">Visual
                    Composer</a> plugin to run "<span style="font-weight: bold;">Massive Elements for WPBakery</span>" plugin.</p></div><?php
	}
}