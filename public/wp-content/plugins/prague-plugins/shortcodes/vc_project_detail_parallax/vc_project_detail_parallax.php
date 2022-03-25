<?php
/*
 * Project Detail Parallax Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */
if (function_exists('vc_map')) {
	vc_map(
		array(
			'name'						=> esc_html__( 'Project Detail Parallax', 'js_composer' ),
			'base'						=> 'vc_project_detail_parallax',
			'as_parent'               => array( 'only' => 'vc_project_detail_parallax_items' ),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'params'					=> array (
				array (
					'type' => 'textfield',
					'heading' => 'Extra class name',
					'param_name' => 'el_class',
					'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.',
					'value' => '',
				),
				array (
					'param_name' => 'mobile_parallax',
					'type' => 'checkbox',
					'description' => '',
					'heading' => 'Enable mobile parallax?',
					'value' => '',
				),
				array (
					'type' => 'css_editor',
					'heading' => 'CSS box',
					'param_name' => 'css',
					'group' => 'Design options',
				),
			)
			//end params
		)
	);
}
if (class_exists('WPBakeryShortCode')) {
	/* Frontend Output Shortcode */
	class WPBakeryShortCode_vc_project_detail_parallax extends WPBakeryShortCodesContainer {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'el_class'	=> '',
				'mobile_parallax'	=> '',
				'css'	=> '',
			), $atts ) );

			$css_classes = array(
				$this->getExtraClass( $el_class )
			);
			$wrap_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );
			/* get custum css as class*/
			$wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );
			$wrap_class .= !empty( $el_class ) ? ' ' . $el_class : '';

			global $vc_project_detail_parallax_items;
			$vc_project_detail_parallax_items = array();

			do_shortcode( $content );

			// start output
			ob_start();
			if( !empty($vc_project_detail_parallax_items) ){ ?>

			<div class="project-detail-parallax" data-parallax-speed="0.5" data-smoothscrolling="">

				<?php foreach ($vc_project_detail_parallax_items as $vc_project_detail_parallax_item) {
					$item = $vc_project_detail_parallax_item['atts'];

                    $item['style'] = isset($item['style']) ? $item['style'] : 'dark';
                    $item['position_dark'] = isset($item['position_dark']) ? $item['position_dark'] : 'center';
                    $item['position_light'] = isset($item['position_light']) ? $item['position_light'] : 'center';
                    
                    $class_item = $item['style'] == 'light' || $item['style'] == 'transparent' ? 'detail-parallax-text-item' : '';
                    $overlay = !empty($item['overlay']) ? 'detail-parallax-text-item-header-on' : '';
					$parallax_mobile = isset($mobile_parallax) ? $mobile_parallax : false;
					$parallaxMobile = ($parallax_mobile) ? 'data-ios-disabled=false data-android-disabled=false' : '';

					if (!empty($item)){
							$image_id = $item['image']; ?>

						<div class="project-detail-parallax-item <?php echo esc_attr($class_item); ?>" <?php echo esc_attr($parallaxMobile); ?>>
							<div class="detail-parallax-item-bg js-detail-parallax-item-bg <?php echo esc_attr($overlay . ' ' . $mobile_parallax); ?>" <?php echo esc_attr($parallaxMobile); ?>>
								<?php echo wp_get_attachment_image( $image_id, 'full' ); ?>
							</div>
							<?php if (!empty($item['title']) || !empty($item['subtitle']) || !empty($vc_project_detail_parallax_item['content'])){

                            if ( $item['style'] == 'dark' && $item['position_dark'] == 'center' ){ ?>

                                <div class="detail-parallax-item-header">
									<?php if(!empty($item['subtitle'])): ?>
										<h6 class="detail-parallax-item-header-subtitle">
											<?php echo esc_html( $item['subtitle'] ); ?>
										</h6>
									<?php endif ?>
									<?php if(!empty($item['title'])): ?>
										<h1 class="detail-parallax-item-header-title">
											<?php echo esc_html( $item['title'] ); ?>
										</h1>

									<?php endif ?>
                                    <?php if(!empty($vc_project_detail_parallax_item['content'])): ?>
                                        <div class="detail-parallax-item-center-description">
                                            <?php echo wp_kses_post( wpautop(do_shortcode( $vc_project_detail_parallax_item['content']))) ; ?>
                                        </div>
                                    <?php endif ?>
								</div>
							    <?php }

                            if ( $item['style'] == 'dark' && $item['position_dark'] == 'bottom' ){ ?>
									<div class="detail-parallax-item-footer">
                                    <?php if(!empty($item['title'])): ?>
										<h1 class="detail-parallax-item-header-title">
											<?php echo esc_html( $item['title'] ); ?>
										</h1>
                                    <?php endif ?>
                                    <?php if(!empty($item['subtitle'])): ?>
										<h6 class="detail-parallax-item-footer-subtitle">
											<?php echo esc_html( $item['subtitle'] ); ?>
										</h6>
                                    <?php endif ?>
                                    <?php if(!empty($vc_project_detail_parallax_item['content'])): ?>
                                        <div class="detail-parallax-item-center-description">
                                            <?php echo wp_kses_post( wpautop(do_shortcode( $vc_project_detail_parallax_item['content']))) ; ?>
                                        </div>
                                    <?php endif ?>

									</div>
								<?php }

                            if ( $item['style'] == 'light'){ ?>

                                <div class="detail-parallax-item-<?php echo esc_attr( $item['position_light'] ); ?> ">

                                    <?php if (!empty($item['subtitle'])): ?>
                                        <h6 class="detail-parallax-item-<?php echo esc_attr( $item['position_light'] ); ?>-subtitle">
                                            <?php echo esc_html( $item['subtitle'] ); ?>
                                        </h6>
                                    <?php endif ?>

                                    <?php if (!empty($item['title'])): ?>
                                        <h2 class="detail-parallax-item-<?php echo esc_attr( $item['position_light'] ); ?>-title">
                                            <?php echo esc_html( $item['title'] ); ?>
                                        </h2>
                                    <?php endif; ?>

                                    <?php if ( !empty($vc_project_detail_parallax_item['content']) ) : ?>
                                        <div class="detail-parallax-item-<?php echo esc_attr( $item['position_light'] ); ?>-description">
                                            <?php echo wp_kses_post( wpautop(do_shortcode( $vc_project_detail_parallax_item['content'] )) ); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            <?php }

                            if ( $item['style'] == 'transparent'){ ?>
                                <div class="detail-parallax-item-header">
                                    <?php if (!empty($item['subtitle'])): ?>
                                        <h6 class="detail-parallax-item-header-subtitle">
                                            <?php echo esc_html( $item['subtitle'] ); ?>
                                        </h6>
                                    <?php endif ?>
                                    <?php if (!empty($item['title'])): ?>
                                        <h1 class="detail-parallax-item-header-title">
                                            <?php echo esc_html( $item['title'] ); ?>
                                        </h1>
                                    <?php endif ?>
                                    <?php if ( !empty($vc_project_detail_parallax_item['content']) ) : ?>
                                        <div class="detail-parallax-item-center-description">
                                            <?php echo wp_kses_post( wpautop(do_shortcode( $vc_project_detail_parallax_item['content'] )) ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php }
                            } ?>

						</div>

				<?php }
                } ?>
				<div class="project-detail-parallax-cover"></div>
			</div>
			<?php } ?>


			<?php
			// end output
			return ob_get_clean();
		}
	}
}

vc_map(
	array(
		'name'						=> esc_html__( 'Parallax Item', 'js_composer' ),
		'base'						=> 'vc_project_detail_parallax_items',
		'as_child'               => array( 'only' => 'vc_project_detail_parallax' ),
		'content_element' => true,
		'params'					=> array (
			array (
				'param_name' => 'image',
				'type' => 'attach_image',
				'heading' => __( 'Image', 'js_composer' ),
				'value' => '',
			),
            array (
                'param_name' => 'overlay',
                'type' => 'checkbox',
                'description' => '',
                'heading' => 'Add overlay',
                'value' => '',
            ),
			array(
				'param_name' => 'style',
				'type' => 'dropdown',
				'description' => '',
				'heading' => 'Background',
				'value' => array(
					'Dark' => 'dark',
					'Light' => 'light',
					'Transparent' => 'transparent',
				),
			),
			array(
				'param_name' => 'position_light',
				'type' => 'dropdown',
				'description' => '',
				'heading' => 'Position',
				'value' => array(
					'Center' => 'center',
					'Right' => 'right',
					'Left' => 'left',
				),
				'dependency'  => array( 'element' => 'style', 'value' => 'light' )
			),
			array(
				'param_name' => 'position_dark',
				'type' => 'dropdown',
				'description' => '',
				'heading' => 'Position',
				'value' => array(
					'Center' => 'center',
					'Bottom' => 'bottom',
				),
				'dependency'  => array( 'element' => 'style', 'value' => 'dark' )
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Title', 'js_composer' ),
				'param_name' => 'title',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Subtitle', 'js_composer' ),
				'param_name' => 'subtitle',
				'value'      => ''
			),
			array(
				'type'       => 'textarea_html',
				'heading'    => __( 'Text', 'js_composer' ),
				'param_name' => 'content',
				'value'      => ''
			),

		)
		//end params
	)
);

class WPBakeryShortCode_vc_project_detail_parallax_items extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {
		global $vc_project_detail_parallax_items;
		$vc_project_detail_parallax_items[] = array( 'atts' => $atts, 'content' => $content );
		return;
	}
}