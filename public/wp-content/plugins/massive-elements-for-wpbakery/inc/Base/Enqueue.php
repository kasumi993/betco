<?php
/**
 * @package  MEWVC
 */
namespace Inc\Base;

class Enqueue extends BaseController {
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'front_enqueue' ) );
	}

	public function admin_enqueue() {
		wp_enqueue_style( 'mew_fontawesome_load_admin', 'https://use.fontawesome.com/releases/v5.0.10/css/all.css' );
		
		wp_enqueue_style( 'weavc-google-font', 'https://fonts.googleapis.com/css?family=Open+Sans|Oswald|Roboto|Roboto+Condensed' );

		wp_enqueue_style( 'mew_param_css', $this->plugin_url . 'assets/css/params.min.css' );

		wp_enqueue_style( 'mew_admin_css', $this->plugin_url . 'assets/css/adminstyle.css' );

		wp_enqueue_script( 'mew-admin-js', $this->plugin_url . 'assets/js/adminscript.min.js', array( 'jquery' ), '', true );

		wp_enqueue_script( 'mew-params-js', $this->plugin_url . 'assets/js/params.min.js', array( 'jquery' ), '', true );

	}

	//wp/front enqueue scripts
	public function front_enqueue() {

		wp_enqueue_style( 'mew_fontawesome_load', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' );
		wp_enqueue_style( 'mew-extensions-css', $this->plugin_url . 'assets/css/extensions.min.css' );

		wp_enqueue_script( 'mew-testimonial-js', $this->plugin_url . 'assets/js/jquery.bxslider.min.js', array( 'jquery' ), '', false );

		wp_enqueue_script( 'mew-extensions-js', $this->plugin_url . 'assets/js/extensions.min.js', array( 'jquery' ), '', true );
	}
}