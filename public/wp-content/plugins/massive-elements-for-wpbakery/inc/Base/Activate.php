<?php
/**
 * @package  EssentialAddonsVC
 */

namespace Inc\Base;

class Activate {
	public static function activate() {
		flush_rewrite_rules();


		$option_name = 'weavc';

		if ( get_option( $option_name ) ) {
			return;
		}

		$default = array(
			//'icon_animation',
			//'animate_box',
			//'info_box',
			'accordion',
			'prime_tab',
			'testimonial',
			'team_member',
			'separator',
			'3d_flipbox',
			'modal',
			'csstooltips',
			'pricing_table',
			'before_after',
			'content_block',
			'hover_effects',
			'page_transition',
			'advanced_modal',
			'scroll_notification',
			'masonry_gallery',
			'zoom_magnifier',
			'video_gallery',
			'shadow_box',
			'image_hotspot',
			'profile_card',
			'timeline',
			'memberprofile',
			'countdown',
			'progressbar',
			'undoredo',
			'counter',
		);

		$default_settings = array_fill_keys( $default, true );

		if ( get_option( $option_name ) !== false ) {

			// The option already exists, so update it.
			update_option( $option_name, $default_settings );

		} else {

			// The option hasn't been created yet, so add it with $autoload set to 'no'.
			$deprecated = null;
			$autoload   = 'no';
			add_option( $option_name, $default_settings, $deprecated, $autoload );

		}
	}
}