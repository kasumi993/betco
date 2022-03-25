<?php
/*
 * Promotion Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */

if ( function_exists('vc_map') ) {
	vc_map(
		array(
			'name'        => esc_html__('Promotion', 'js_composer'),
			'base'        => 'vc_promotion',
			'content_element'			=> true,
			'show_settings_on_create'	=> true,
			'description' => esc_html__('Image with text', 'js_composer'),
			'params'      => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Promotion style', 'js_composer'),
					'description' => esc_html__('Please select main style', 'js_composer'),
					'param_name'  => 'style',
					'value'       => array(
						array(
							'value' => 'modern',
							'label' => esc_html__('Modern', 'js_composer'),
						),
						array(
							'value' => 'simple',
							'label' => esc_html__('Simple', 'js_composer'),
						),
						array(
							'value' => 'info_video',
							'label' => esc_html__('Info with Video', 'js_composer'),
						),
					)
				),
				array(
					'type'       => 'attach_image',
					'heading'    => 'Section image background',
					'param_name' => 'section_image_bg',
					'dependency' => array('element' => 'style', 'value' => array('modern', 'simple')),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__('Parallax for background', 'js_composer'),
					'description' => esc_html__('Do you want to parallax for background?', 'js_composer'),
					'param_name'  => 'parallax',
					'dependency'  => array('element' => 'style', 'value' => array('modern', 'simple')),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__('Parallax for mobile device', 'js_composer'),
					'description' => esc_html__('Do you want to enable parallax for mobile?', 'js_composer'),
					'param_name'  => 'parallax_mob',
					'dependency'  => array(
						'element'   => 'parallax',
						'not_empty' => true,
					),
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__('Section Image', 'js_composer'),
					'param_name' => 'image',
					'dependency' => array('element' => 'style', 'value' => array('modern')),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Image Position', 'js_composer'),
					'param_name' => 'image_position',
					'value'      => array(
						'Top'    => 'top',
						'Middle' => 'middle',
						'Bottom' => 'bottom',
					),
					'std'        => 'middle',
					'dependency' => array('element' => 'style', 'value' => array('modern')),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Image Width', 'js_composer'),
					'param_name' => 'image_width',
					'value'      => array(
						'100%' => '100',
						'110%' => '110',
						'120%' => '120',
						'130%' => '130',
						'140%' => '140',
						'150%' => '150',
						'160%' => '160',
						'170%' => '170',
						'180%' => '180',
					),
					'std'        => '100',
					'dependency' => array('element' => 'style', 'value' => array('modern')),
				),
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__('Mask image', 'js_composer'),
					'param_name'  => 'mask_image',
					'description' => 'Will be display in top left side in section',
					'dependency'  => array('element' => 'style', 'value' => array('modern')),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Subtitle', 'js_composer'),
					'description' => esc_html__('Please add subtitle', 'js_composer'),
					'param_name'  => 'subtitle',
					'value'       => '',
					'dependency'  => array('element' => 'style', 'value' => array('modern', 'simple')),
				),
				array(
					'type'        => 'textarea',
					'heading'     => esc_html__('Title', 'js_composer'),
					'param_name'  => 'title',
					'value'       => '',
					'description' => esc_html__("If you want to add the word which will be marked by main color, please insert it in &#60;i&#62; tag, for example: &#60;i&#62;Hello&#60;/i&#62;. And if you want to add the word which will be marked bold, please insert it in &#60;b&#62; tag, for example: &#60;b&#62;Hello&#60;/b&#62;", 'js_composer'),
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description', 'js_composer'),
					'param_name' => 'description',
					'value'      => '',
					'dependency' => array('element' => 'style', 'value' => array('modern', 'simple')),
				),
				array(
					'type'        => 'vc_link',
					'heading'     => esc_html__('Button', 'js_composer'),
					'description' => esc_html__('Please specify button link', 'js_composer'),
					'param_name'  => 'button',
				),
				array(
					'param_name'  => 'style_button',
					'type'        => 'dropdown',
					'description' => '',
					'heading'     => 'Style button',
					'value'       => array(
						'Simple'   => 'simple',
						'Creative' => 'creative',
					),
				),
				array(
					'param_name'  => 'color_button',
					'type'        => 'dropdown',
					'description' => '',
					'heading'     => 'Color button',
					'value'       => array(
						'Light'   => 'light',
						'Dark' => 'dark',
					),
				),
				// Video button
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__('Add video button?', 'js_composer'),
					'description' => esc_html__('Do you want add video button?', 'js_composer'),
					'param_name'  => 'video_enable',
					'dependency'  => array('element' => 'style', 'value' => array('info_video')),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Video link', 'js_composer'),
					'description' => esc_html__('Please add link for video', 'js_composer'),
					'param_name'  => 'video_link',
					'dependency'  => array('element' => 'video_enable', 'not_empty' => true,),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Video button name', 'js_composer'),
					'description' => esc_html__('Please add name for video button', 'js_composer'),
					'param_name'  => 'video_name',
					'dependency'  => array('element' => 'video_enable', 'not_empty' => true,),
				),
				// items
				array(
					'type'        => 'param_group',
					'heading'     => esc_html__('Items', 'js_composer'),
					'description' => esc_html__('Please add information for the item', 'js_composer'),
					'param_name'  => 'items',
					'value'       => '',
					'dependency'  => array('element' => 'style', 'value' => array('info_video')),
					'params'      => array(
						array(
							'type'       => 'attach_image',
							'heading'    => 'Item image',
							'param_name' => 'image',
						),
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__('Name', 'js_composer'),
							'description' => esc_html__('Please add name for item', 'js_composer'),
							'param_name'  => 'name',
						),
					),
				),
				// background options
				array(
					'type'       => 'attach_image',
					'heading'    => 'Left section image background',
					'param_name' => 'left_image_bg',
					'dependency' => array('element' => 'style', 'value' => array('info_video')),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__('Left section image parallax', 'js_composer'),
					'description' => esc_html__('Do you want to parallax for background?', 'js_composer'),
					'param_name'  => 'left_image_parallax',
					'dependency'  => array('element' => 'style', 'value' => array('info_video')),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__('Parallax for mobile device (left section)', 'js_composer'),
					'description' => esc_html__('Do you want to enable parallax for mobile?', 'js_composer'),
					'param_name'  => 'parallax_mob_l',
					'dependency'  => array(
						'element'   => 'left_image_parallax',
						'not_empty' => true,
					),
				),
				array(
					'type'       => 'attach_image',
					'heading'    => 'Right section image background',
					'param_name' => 'right_image_bg',
					'dependency' => array('element' => 'style', 'value' => array('info_video')),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__('Right section image parallax', 'js_composer'),
					'description' => esc_html__('Do you want to parallax for background?', 'js_composer'),
					'param_name'  => 'right_image_parallax',
					'dependency'  => array('element' => 'style', 'value' => array('info_video')),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__('Parallax for mobile device (right section)', 'js_composer'),
					'description' => esc_html__('Do you want to enable parallax for mobile?', 'js_composer'),
					'param_name'  => 'parallax_mob_r',
					'dependency'  => array(
						'element'   => 'right_image_parallax',
						'not_empty' => true,
					),
				),
				// Other options
				array(
					'type'        => 'textfield',
					'heading'     => 'Extra class name',
					'param_name'  => 'el_class',
					'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.',
					'value'       => '',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => 'CSS box',
					'param_name' => 'css',
					'group'      => 'Design options',
				),
			)
			//end params
		)
	);
}


if ( class_exists('WPBakeryShortCode') ) {
	/* Frontend Output Shortcode */

	class WPBakeryShortCode_vc_promotion extends WPBakeryShortCode {
		protected function content($atts, $content = null) {

			extract(shortcode_atts(array(
				'style'                => 'modern',
				// bg params
				'section_image_bg'     => '',
				'parallax'             => '',
				'parallax_mob'         => '',
				'left_image_bg'        => '',
				'left_image_parallax'  => '',
				'parallax_mob_l'       => '',
				'right_image_bg'       => '',
				'right_image_parallax' => '',
				'parallax_mob_r'       => '',
				// img params
				'image'                => '',
				'image_position'       => '',
				'image_width'          => '',
				'mask_image'           => '',
				// headline params
				'subtitle'             => '',
				'title'                => '',
				'description'          => '',
				// buttons params
				'button'               => '',
//				'btn_style'            => 'a-btn a-btn-1',
				'style_button'    => 'creative',
				'color_button'    => 'light',
				// video params
				'video_enable'         => '',
				'video_link'           => '',
				'video_name'           => '',
				// items
				'items'                => array(),
				// other
				'css'                  => '',
			), $atts));

			$bg_img         = (!empty($section_image_bg) && is_numeric($section_image_bg)) ? wp_get_attachment_url($section_image_bg) : '';
			$left_image_bg  = (!empty($left_image_bg) && is_numeric($left_image_bg)) ? wp_get_attachment_url($left_image_bg) : '';
			$right_image_bg = (!empty($right_image_bg) && is_numeric($right_image_bg)) ? wp_get_attachment_url($right_image_bg) : '';

			$image_position = (isset($image_position) && !empty($image_position)) ? 'img-pos-' . $image_position : '';
			$image_width    = (isset($image_width) && !empty($image_width)) ? 'width:' . $image_width . '%' : '';

			// start output
			ob_start(); ?>

			<div class="promotion <?php echo esc_attr($style); ?>">
				<?php if ( $style == 'modern' ) { ?>
					<?php if ( !empty($bg_img) ) {
						if ( $parallax ) {
							$parallax_mob = isset($parallax_mob) ? $parallax_mob : false;
							$parallax_mob = ($parallax_mob) ? 'data-ios-disabled=false data-android-disabled=false' : ''; ?>
							<div class="img-parallax" data-parallax="scroll" data-position-Y="top"
							     data-image-src="<?php echo esc_url($bg_img); ?>" <?php echo esc_attr($parallax_mob); ?>></div>
						<?php } else { ?>
							<img src="<?php echo esc_url($bg_img); ?>" class="s-img-switch" alt="">
						<?php }
					} ?>
					<div class="mask">
						<?php if ( !empty($mask_image) ) {
							$image_alt  = get_post_meta($mask_image, '_wp_attachment_image_alt', true);
							$mask_image = wp_get_attachment_url($mask_image); ?>
							<img src="<?php echo esc_url($mask_image); ?>" class="" alt="<?php echo esc_attr($image_alt); ?>">
						<?php } ?>
					</div>
					<div class="container">
						<div class="row <?php esc_attr_e($image_position); ?>">
							<div class="col-lg-5 col-sm-6 col-xs-12 promotion-content-wrap">
								<div class="promotion-content">
									<?php if ( !empty($subtitle) ) { ?>
										<h5 class="subtitle"><?php echo esc_html($subtitle); ?></h5>
									<?php }
									if ( !empty($title) ) { ?>
										<h3 class="title"><?php echo wp_kses_post($title); ?></h3>
									<?php }
									if ( !empty($description) ) { ?>
										<div class="description"><?php echo wp_kses_post($description); ?></div>
									<?php }
									if ( !empty($button) ) {
										$url    = vc_build_link($button);
										$target = !empty($url['target']) ? $url['target'] : '_self';
									}
									if ( !empty($url['title']) ) { ?>
										<div class="but-wrap">
											<a href="<?php echo esc_url($url['url']) ?>" class="a-btn <?php echo esc_attr($color_button . ' ' . $style_button);?>" target="<?php echo esc_attr($target); ?>">
												<span class="a-btn-line"></span>
												<?php echo esc_html($url['title']); ?>
											</a>
										</div>
									<?php } ?>
								</div>
							</div>
							<div class="col-sm-6 col-lg-offset-1 col-xs-12 promotion-image-wrap">
								<div class="promotion-image" style="<?php esc_attr_e($image_width); ?>">
									<?php if ( !empty($image) ) {
										$image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
										$image     = wp_get_attachment_url($image); ?>
										<img src="<?php echo esc_url($image); ?>" class="" alt="<?php echo esc_attr($image_alt); ?>">
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php } elseif ( $style == 'simple' ) { ?>
					<?php if ( !empty($bg_img) ) {
						if ( $parallax ) {
							$parallax_mob = isset($parallax_mob) ? $parallax_mob : false;
							$parallax_mob = ($parallax_mob) ? 'data-ios-disabled=false data-android-disabled=false' : ''; ?>
							<div class="img-parallax" data-parallax="scroll" data-position-Y="top"
							     data-image-src="<?php echo esc_url($bg_img); ?>" <?php echo esc_attr($parallax_mob); ?>></div>
						<?php } else { ?>
							<img src="<?php echo esc_url($bg_img); ?>" class="s-img-switch" alt="">
						<?php }
					} ?>
					<div class="container">
						<div class="promotion-content">
							<?php if ( !empty($subtitle) ) { ?>
								<h5 class="subtitle"><?php echo esc_html($subtitle); ?></h5>
							<?php }
							if ( !empty($title) ) { ?>
								<h3 class="title"><?php echo wp_kses_post($title); ?></h3>
							<?php }
							if ( !empty($description) ) { ?>
								<div class="description"><?php echo wp_kses_post($description); ?></div>
							<?php }
							if ( !empty($button) ) {
								$url    = vc_build_link($button);
								$target = !empty($url['target']) ? $url['target'] : '_self';
							}
							if ( !empty($url['title']) ) { ?>
								<div class="but-wrap">
									<a href="<?php echo esc_url($url['url']) ?>" class="a-btn <?php echo esc_attr($color_button . ' ' . $style_button);?>" target="<?php echo esc_attr($target); ?>">
										<span class="a-btn-line"></span>
										<?php echo esc_html($url['title']); ?>
									</a>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } elseif ( $style == 'info_video' ) { ?>
					<div class="container">
						<div class="content">
							<div class="section-left">
								<?php if ( !empty($left_image_bg) ) {
									if ( $left_image_parallax ) {
										$parallax_mob_l = isset($parallax_mob_l) ? $parallax_mob_l : false;
										$parallax_mob_l = ($parallax_mob_l) ? 'data-ios-disabled=false data-android-disabled=false' : ''; ?>
										<div class="img-parallax" data-parallax="scroll" data-position-Y="top"
										     data-image-src="<?php echo esc_url($left_image_bg); ?>" <?php echo esc_attr($parallax_mob_l); ?>></div>
									<?php } else { ?>
										<img src="<?php echo esc_url($left_image_bg); ?>" class="s-img-switch" alt="">
									<?php }
								} ?>
							</div>
							<div class="section-right">
								<?php if ( !empty($right_image_bg) ) {
									if ( $right_image_parallax ) {
										$parallax_mob_r = isset($parallax_mob_r) ? $parallax_mob_r : false;
										$parallax_mob_r = ($parallax_mob_r) ? 'data-ios-disabled=false data-android-disabled=false' : ''; ?>
										<div class="img-parallax" data-parallax="scroll" data-position-Y="top"
										     data-image-src="<?php echo esc_url($right_image_bg); ?>" <?php echo esc_attr($parallax_mob_r); ?>></div>
									<?php } else { ?>
										<img src="<?php echo esc_url($right_image_bg); ?>" class="s-img-switch" alt="">
									<?php }
								} ?>
							</div>
							<div class="content-info">
								<?php if ( isset($video_enable) && $video_enable && !empty($video_link) && !empty($video_name) ) { ?>
									<div class="video-btn">
										<?php $target = '_blank';?>
										<a href="<?php echo esc_url($video_link) ?>" class="a-btn <?php echo esc_attr($color_button . ' ' . $style_button);?>" target="<?php echo esc_attr($target); ?>">
											<span class="a-btn-line"></span>
											<?php esc_html_e($video_name); ?>
										</a>
									</div>
								<?php }
								if ( !empty($title) ) { ?>
									<h3 class="title"><?php echo wp_kses_post($title); ?></h3>
								<?php }
								if ( !empty($button) ) {
									$url    = vc_build_link($button);
									$target = !empty($url['target']) ? $url['target'] : '_self'; ?>
								<?php }
								if ( !empty($url['title']) ) { ?>
									<div class="but-wrap">
										<a href="<?php echo esc_attr($url['url']); ?>"
										   class="a-btn <?php echo esc_attr($color_button . ' ' . $style_button); ?>"
										   target="<?php echo esc_attr($target); ?>">
											<span class="a-btn-line"></span>
											<?php echo esc_html($url['title']); ?>
										</a>
									</div>
								<?php } ?>
							</div>
							<?php if ( !empty($items) ) {
								$items = (array)vc_param_group_parse_atts($items);
								if ( count($items) > 4 ) { ?>
									<div class="items-wrap desktop">
										<div class="swiper-container"
										     data-mode="vertical"
										     data-mouse="1"
										     data-speed="1000"
										     data-centerslides="1"
										     data-loop="0"
										     data-space="0">
											<div class="swiper-wrapper">
												<?php foreach ( $items as $item ) {
													$image = (!empty($item['image']) && is_numeric($item['image'])) ? wp_get_attachment_url($item['image']) : '';
													?>
													<div class="swiper-slide">
														<div class="item">
															<?php if ( !empty($image) ) { ?>
																<div class="item-img"><img
																		src="<?php echo esc_url($image); ?>" alt="">
																</div>
															<?php } ?>
															<?php if ( isset($item['name']) && !empty($item['name']) ) { ?>
																<div class="item-name"><?php esc_html_e($item['name']) ?></div>
															<?php } ?>
														</div>
													</div>
												<?php } ?>
											</div>
										</div>
										<!-- If we need navigation buttons -->
										<div class="swiper-button-prev"></div>
										<div class="swiper-button-next"></div>
									</div>
								<?php } else { ?>
									<div class="items-wrap desktop">
										<?php foreach ( $items as $item ) {
											$image = (!empty($item['image']) && is_numeric($item['image'])) ? wp_get_attachment_url($item['image']) : '';
											?>
											<div class="item">
												<?php if ( !empty($image) ) { ?>
													<div class="item-img"><img src="<?php echo esc_url($image); ?>"
													                           alt="">
													</div>
												<?php } ?>
												<?php if ( isset($item['name']) && !empty($item['name']) ) { ?>
													<div class="item-name"><?php esc_html_e($item['name']) ?></div>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
									<div class="items-wrap mobile">
										<div class="swiper-container"
										     data-mode="horizontal"
										     data-mouse="1"
										     data-center="0"
										     data-speed="1000"
                                             data-slides-per-view="2"
										     data-loop="0"
										     data-space="0">
											<div class="swiper-wrapper">
												<?php foreach ( $items as $item ) {
													$image = (!empty($item['image']) && is_numeric($item['image'])) ? wp_get_attachment_url($item['image']) : '';
													?>
													<div class="swiper-slide">
														<div class="item">
															<?php if ( !empty($image) ) { ?>
																<div class="item-img"><img
																		src="<?php echo esc_url($image); ?>" alt="">
																</div>
															<?php } ?>
															<?php if ( isset($item['name']) && !empty($item['name']) ) { ?>
																<div class="item-name"><?php esc_html_e($item['name']) ?></div>
															<?php } ?>
														</div>
													</div>
												<?php } ?>
											</div>
										</div>
										<!-- If we need navigation buttons -->
										<div class="swiper-button-prev"></div>
										<div class="swiper-button-next"></div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php
			// end output
			return ob_get_clean();
		}
	}
}