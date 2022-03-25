<?php
/*
 * Accordion Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */

if ( function_exists('vc_map') ) {
	vc_map(
		array(
			'name'        => esc_html__( 'Accordion', 'js_composer' ),
			'base'        => 'vc_accordion_services',
			'content_element'			=> true,
			'show_settings_on_create'	=> true,
			'description' => esc_html__('', 'js_composer'),
			'params'      => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Content Position', 'js_composer'),
					'param_name' => 'content_position',
					'value'      => array(
						'Left'  => 'left',
						'Right' => 'right'
					),
				),
				array(
					'type'        => 'textarea',
					'heading'     => esc_html__('Title', 'js_composer'),
					'description' => esc_html__('Please add your title', 'js_composer'),
					'param_name'  => 'title',
				),
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__('Image', 'js_composer'),
					'description' => esc_html__('Please add image', 'js_composer'),
					'param_name'  => 'image',
				),
				array(
					'type'        => 'param_group',
					'heading'     => esc_html__('Items', 'js_composer'),
					'param_name'  => 'items_accordion',
					'description' => esc_html__('Please add more information about item', 'js_composer'),
					'value'       => '',
					'params'      => array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__('Number', 'js_composer'),
							'description' => esc_html__('Please add number', 'js_composer'),
							'param_name'  => 'number',
						),
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__('Title', 'js_composer'),
							'description' => esc_html__('Please add title', 'js_composer'),
							'param_name'  => 'title',
						),
						array(
							'type'        => 'textarea',
							'heading'     => esc_html__('Text', 'js_composer'),
							'description' => esc_html__('Please add simole text', 'js_composer'),
							'param_name'  => 'text',
						),
					),
				),
			)
		)
	);
}

if ( class_exists('WPBakeryShortCode') ) {
	/* Frontend Output Shortcode */

	class WPBakeryShortCode_vc_accordion_services extends WPBakeryShortCode {
		protected function content($atts, $content = null) {

			extract(shortcode_atts(array(
				'content_position' => 'left',
				'items_accordion'  => '',
				'image'            => '',
				'title'            => '',
			), $atts));

			$url = (!empty($image) && is_numeric($image)) ? wp_get_attachment_url($image) : '';
			$img_alt =          get_post_meta($image, '_wp_attachment_image_alt', true);

			ob_start(); ?>

			<div class="accordion">
                <div class="accordion__wrap <?php echo esc_attr($content_position); ?>">
                    <?php if ( !empty($title) ) : ?>
                        <div class="accordion__main-title"><?php echo wp_kses_post($title); ?></div>
				    <?php endif; ?>

                    <?php if ( !empty($items_accordion) ) {
                        $items_accordion = (array)vc_param_group_parse_atts($items_accordion); ?>
                        <ul class="accordion__item-wrap">
                            <?php

                            $counter = 1;
                            foreach ( $items_accordion as $item ) {
                                $active       = $counter === 1 ? 'is-show' : '';
                                $active_title = $counter === 1 ? 'active' : '';
                                $active_icon  = $counter === 1 ? 'minus' : 'plus'; ?>
                                <li class="accordion__item">
                                    <a href="" class="toggle <?php echo esc_attr($active_title); ?>">
                                        <div class="accordion__item-inner">
                                            <?php if ( !empty($item['number']) ) { ?>
                                                <div class="accordion__item-number"><?php echo esc_html($item['number']); ?></div>
                                            <?php }

                                            if ( !empty($item['title']) ) { ?>
                                                <div class="accordion__item-title"><?php echo esc_html($item['title']); ?></div>
                                            <?php } ?>
                                        </div>
                                        <i class="<?php echo esc_attr($active_icon); ?>"></i>
                                    </a>
                                    <ul class="accordion__list-drop <?php echo esc_attr($active); ?>">
                                        <li>
                                            <?php if ( !empty($item['text']) ) { ?>
                                                <div class="accordion__item-text"><?php echo wp_kses_post($item['text']); ?></div>
                                            <?php } ?>
                                        </li>
                                    </ul>

                                </li>
                                <?php
                                $counter++;
                            } ?>
                        </ul>
                    <?php } ?>
                </div>
                <?php if ( !empty($url) ) { ?>
                    <div class="accordion__img-wrap">
                        <img src="<?php echo esc_url($url);?>" class="s-img-switch" alt="<?php echo esc_attr($img_alt);?>">
                    </div>
                <?php } ?>
			</div>

			<?php

			return ob_get_clean();
		}
	}
}