<?php

//Contacts shortcode

if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'        => __( 'Contacts', 'js_composer' ),
			'base'        => 'vc_contacts',
			'description' => __( 'Contacts info', 'js_composer' ),
			'category'    => __( 'Content', 'js_composer' ),
			'params'      => array(
				array(
					'type'        => 'dropdown',
					'param_name'  => 'style',
					'heading'     => esc_html__( 'Style', 'js_composer' ),
					'value'       => array(
						'Info with form' => 'info_with_form',
						'Simple'         => 'simple',
						'Subscribe'         => 'subscribe',
					),
					'admin_label' => true,
					'save_always' => true,
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Subtitle', 'js_composer' ),
					'param_name' => 'subtitle',
					'value'      => '',
					'dependency' => array( 'element' => 'style', 'value' => array( 'simple', 'subscribe' ) ),
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Title', 'js_composer' ),
					'param_name' => 'title',
					'value'      => '',
					'dependency' => array( 'element' => 'style', 'value' => array( 'info_with_form', 'simple', 'subscribe' ) ),
				),
				array(
					'type'       => 'textarea_html',
					'heading'    => __( 'Text', 'js_composer' ),
					'param_name' => 'content',
					'dependency' => array( 'element' => 'style', 'value' => array( 'info_with_form' ) ),
				),
				array(
					'type'       => 'param_group',
					'heading'    => __( 'Address', 'js_composer' ),
					'param_name' => 'address_info',
					'value'      => urlencode( json_encode( array() ) ),
					'params'     => array(
						array(
							'type'       => 'textarea',
							'heading'    => __( 'Add your address', 'js_composer' ),
							'param_name' => 'address',
						),
					),
					'dependency' => array( 'element' => 'style', 'value' => array( 'info_with_form' ) ),
				),
				array(
					'type'        => 'iconpicker',
					'heading'     => __( 'Icon Adress', 'js_composer' ),
					'param_name'  => 'icon_address',
					'value'       => '',
					'settings'    => array(
						'emptyIcon'    => false,
						'type'         => 'info',
						'source'       => prague_add_custom_icons(),
						'iconsPerPage' => 4000,
					),
					'description' => __( 'Please Select Icon', 'js_composer' ),
					'dependency'  => array( 'element' => 'style', 'value' => array( 'info_with_form' ) ),
				),
				array(
					'type'       => 'param_group',
					'heading'    => __( 'Email', 'js_composer' ),
					'param_name' => 'email_info',
					'value'      => urlencode( json_encode( array() ) ),
					'params'     => array(
						array(
							'type'       => 'textfield',
							'heading'    => __( 'Add your email', 'js_composer' ),
							'param_name' => 'email',
							'value'      => ''
						),
					),
					'dependency' => array( 'element' => 'style', 'value' => array( 'info_with_form' ) ),
				),
				array(
					'type'        => 'iconpicker',
					'heading'     => __( 'Icon Email', 'js_composer' ),
					'param_name'  => 'icon_email',
					'value'       => '',
					'settings'    => array(
						'emptyIcon'    => false,
						'type'         => 'info',
						'source'       => prague_add_custom_icons(),
						'iconsPerPage' => 4000,
					),
					'description' => __( 'Please Select Icon', 'js_composer' ),
					'dependency'  => array( 'element' => 'style', 'value' => array( 'info_with_form' ) ),
				),
				array(
					'type'       => 'param_group',
					'heading'    => __( 'Phone', 'js_composer' ),
					'param_name' => 'phone_info',
					'value'      => urlencode( json_encode( array() ) ),
					'params'     => array(
						array(
							'type'       => 'textfield',
							'heading'    => __( 'Add your phone', 'js_composer' ),
							'param_name' => 'phone',
							'value'      => 'align-right'
						),
					),
					'dependency' => array( 'element' => 'style', 'value' => array( 'info_with_form' ) ),
				),
				array(
					'type'        => 'iconpicker',
					'heading'     => __( 'Icon Phone', 'js_composer' ),
					'param_name'  => 'icon_phone',
					'value'       => '',
					'settings'    => array(
						'emptyIcon'    => false,
						'type'         => 'info',
						'source'       => prague_add_custom_icons(),
						'iconsPerPage' => 4000,
					),
					'description' => __( 'Please Select Icon', 'js_composer' ),
					'dependency'  => array( 'element' => 'style', 'value' => array( 'info_with_form' ) ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Contact form', 'js_composer' ),
					'param_name'  => 'form',
					'description' => __( 'Add your form id from shortcode Contact Form 7 Plugin.', 'js_composer' ),
					'dependency'  => array( 'element' => 'style', 'value' => array( 'info_with_form', 'simple', 'subscribe' ) ),
				),
				array(
					'param_name'  => 'light_style',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Light form style with dark background',
					'value'       => '',
					'dependency'  => array( 'element' => 'style', 'value' => array( 'simple' ) ),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => 'Icon First Gradient Color',
					'param_name' => 'icon_custom_color',
					"value"      => '#0c4fff', //Default color
					'dependency' => array( 'element' => 'style', 'value' => array( 'info_with_form' ) ),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => 'Icon Second Gradient Color',
					'param_name' => 'icon_second_custom_color',
					"value"      => '#c24efe', //Default color
					'dependency' => array( 'element' => 'style', 'value' => array( 'info_with_form' ) ),
				),
			),
			//end params
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	/* Frontend Output Shortcode */

	class WPBakeryShortCode_vc_contacts extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
				'style'                    => 'info_with_form',
				'address_info'             => '',
				'icon_address'             => '',
				'icon_email'               => '',
				'icon_phone'               => '',
				'icon_color_second'        => '#252531',
				'form'                     => '',
				'title'                    => '',
				'subtitle'                 => '',
				'email_info'               => '',
				'phone_info'               => '',
				'icon_custom_color'        => '',
				'icon_second_custom_color' => '',
				'light_style'              => '',

			), $atts ) );

			if ( ! in_array( "tur_contacts-css", self::$css_scripts ) ) {
				self::$css_scripts[] = "tur_contacts-css";
			}
			$this->enqueueCss();


			$class_overlay = ! empty( $form ) ? ' over' : '';

			$icon_custom_color        = ! empty( $icon_custom_color ) ? $icon_custom_color : '#0c4fff';
			$icon_second_custom_color = ! empty( $icon_second_custom_color ) ? $icon_second_custom_color : '#c24efe';

			$icon_color_style = 'style="background-image: linear-gradient(127deg, ' . $icon_custom_color . ', ' . $icon_second_custom_color . ');"';

			// start output
			ob_start();

			if ( $style == 'info_with_form' ) { ?>

                <div class="contacts-info-wrap <?php echo esc_attr( $style . $class_overlay ); ?>">

					<?php $classInfo = ! empty( $form ) ? 'col-xs-12 col-sm-6' : '';
					$classForm       = ! empty( $form ) ? 'col-xs-12 col-sm-6' : '';
					$address_info    = (array) vc_param_group_parse_atts( $address_info );
					$phone_info      = (array) vc_param_group_parse_atts( $phone_info );
					$email_info      = (array) vc_param_group_parse_atts( $email_info );
					$form_style      = isset( $form_style ) && ( $form_style == 'classic_form' ) ? 'classic-form' : 'modern-form'; ?>

                    <div class="container no-padd">
                        <div class="row">
                            <div class="col-12 <?php echo esc_attr( $classInfo ); ?>">
                                <div class="content-wrap">
                                    <div class="content">
										<?php if ( ! empty( $title ) ) { ?>
                                            <div class="title"><?php echo wp_kses_post( $title ); ?></div>
										<?php }
										if ( ! empty( $content ) ) { ?>
                                            <div class="text"><?php echo wp_kses_post( $content ); ?></div>
										<?php } ?>
                                        <div class="phone-wrapper">
											<?php if ( ! empty( $icon_phone ) ) { ?>
                                                <i class="<?php echo esc_attr( $icon_phone ); ?>" <?php echo $icon_color_style; ?>></i>
											<?php } ?>
                                            <div class="phone-list">
												<?php if ( ! empty( $phone_info ) ) { ?>
													<?php foreach ( $phone_info as $phone ) {
														if ( ! empty( $phone ) ) {
															$tel = str_replace( [
																':',
																'(',
																')',
																'.',
																' ',
																'+'
															], '', $phone['phone'] );
															?>
                                                            <a href="tel:<?php echo esc_attr( $tel ); ?>"
                                                               class="email"><?php echo wp_kses_post( $phone['phone'] ); ?></a>
														<?php }
													}
												} ?>
                                            </div>
                                        </div>
                                        <div class="address-wrapper">
											<?php if ( ! empty( $icon_address ) ) { ?>
                                                <i class="<?php echo esc_attr( $icon_address ); ?>" <?php echo $icon_color_style; ?>></i>
											<?php } ?>
                                            <div class="adress-list">
												<?php if ( ! empty( $address_info ) ) { ?>
													<?php foreach ( $address_info as $address ) {
														if ( ! empty( $address ) ) { ?>
                                                            <div class="address"><?php echo wp_kses_post( $address['address'] ); ?></div>
														<?php }
													}
												} ?>
                                            </div>
                                        </div>
                                        <div class="email-wrapper">
											<?php if ( ! empty( $icon_email ) ) { ?>
                                                <i class="<?php echo esc_attr( $icon_email ); ?>" <?php echo $icon_color_style; ?>></i>
											<?php } ?>
                                            <div class="email-list">
												<?php if ( ! empty( $email_info ) ) { ?>
													<?php foreach ( $email_info as $email ) {
														if ( ! empty( $email ) ) { ?>
                                                            <a href="mailto:<?php echo esc_attr( $email['email'] ); ?>"
                                                               class="email"><?php echo wp_kses_post( $email['email'] ); ?></a>
														<?php }
													}
												} ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 <?php echo esc_attr( $classForm ); ?>">
								<?php if ( ! empty( $form ) ) { ?>
                                    <div class="prague-formidable">
                                        <div class="frm_forms with_frm_style">
                                            <div class="form <?php echo esc_attr( $form_style ); ?>"><?php echo do_shortcode( '[formidable id="' . esc_attr( $form ) . '"]' ); ?></div>
                                        </div>
                                    </div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php }

			if ( $style == 'simple' ) {
			    $light_style = !empty($light_style) && isset($light_style) ? 'light' : ''; ?>
                <div class="contact-form contact-form--simple <?php echo esc_attr($light_style);?>">
                    <div class="contact-form__wrap">
                        <?php if ( !empty($subtitle) ) { ?>
                            <div class="contact-form__subtitle"><?php echo esc_html($subtitle);?></div>
                        <?php } ?>

	                    <?php if ( !empty($title) ) { ?>
                            <div class="contact-form__title"><?php echo esc_html($title);?></div>
	                    <?php } ?>

	                    <?php if ( !empty($form) ) { ?>
                            <div class="contact-form__form"><?php echo do_shortcode( '[contact-form-7 id="' . esc_attr( $form ) . '"]' ); ?></div>
	                    <?php } ?>
                    </div>
                </div>
			<?php }

			if ( $style == 'subscribe' ) { ?>
                <div class="contact-form contact-form--subscribe <?php echo esc_attr($light_style);?>">
                    <div class="contact-form__wrap">
	                    <?php if ( !empty($subtitle) ) { ?>
                            <div class="contact-form__subtitle"><?php echo esc_html($subtitle);?></div>
	                    <?php } ?>

	                    <?php if ( !empty($title) ) { ?>
                            <div class="contact-form__title"><?php echo esc_html($title);?></div>
	                    <?php } ?>

						<?php if ( !empty($form) ) { ?>
                            <div class="contact-form__form"><?php echo do_shortcode( '[contact-form-7 id="' . esc_attr( $form ) . '"]' ); ?></div>
						<?php } ?>
                    </div>
                </div>
			<?php }

			// end output
			return ob_get_clean();
		}
	}
}

