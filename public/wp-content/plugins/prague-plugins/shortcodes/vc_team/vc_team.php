<?php
/*
 * Team Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0 
 */
if ( function_exists( 'vc_map' ) ) {
	vc_map(
		array(
			'name'                    => esc_html__( 'Team', 'js_composer' ),
			'base'                    => 'vc_team',
			'content_element'         => true,
			'show_settings_on_create' => true,
			'description'             => esc_html__( '', 'js_composer' ),
			'params'                  => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Team style', 'js_composer' ),
					'description' => esc_html__( 'Please select main style', 'js_composer' ),
					'param_name'  => 'team_style',
					'value'       => array(
						array(
							'value' => 'simple',
							'label' => esc_html__( 'Simple', 'js_composer' ),
						),
						array(
							'value' => 'modern',
							'label' => esc_html__( 'Modern', 'js_composer' ),
						),
					)
				),
				array(
					'param_name'  => 'image',
					'type'        => 'attach_image',
					'description' => '',
					'heading'     => 'Image',
					'value'       => '',
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'param_name'  => 'name',
					'type'        => 'textfield',
					'description' => '',
					'heading'     => 'Name',
					'value'       => '',
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'param_name'  => 'link',
					'type'        => 'textfield',
					'description' => '',
					'heading'     => 'Link',
					'value'       => '',
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'param_name'  => 'link_target',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Open link in a new tab',
					'value'       => '',
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'param_name'  => 'position',
					'type'        => 'textfield',
					'description' => '',
					'heading'     => 'Position',
					'value'       => '',
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'param_name'  => 'figure',
					'type'        => 'dropdown',
					'description' => '',
					'heading'     => 'Figure',
					'value'       => array(
						esc_html__( 'None', 'js_composer' )     => '',
						esc_html__( 'Triangle', 'js_composer' ) => 'triangle',
						esc_html__( 'Circle', 'js_composer' )   => 'circle',
						esc_html__( 'Square', 'js_composer' )   => 'square',
						esc_html__( 'Oxagon', 'js_composer' )   => 'oxagon',
					),
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'param_name'  => 'color_figure',
					'type'        => 'colorpicker',
					'description' => '',
					'heading'     => 'Color Figure',
					'value'       => '',
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'type'       => 'textfield',
					'heading'    => 'Stroke width',
					'param_name' => 'stroke_width',
					'value'      => '',
					'dependency' => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'param_name'  => 'height',
					'type'        => 'textfield',
					'description' => '',
					'heading'     => 'Height',
					'value'       => '',
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'param_name'  => 'enable_animated',
					'type'        => 'checkbox',
					'description' => '',
					'heading'     => 'Enable animate',
					'value'       => '',
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'param_name'  => 'style',
					'type'        => 'dropdown',
					'description' => '',
					'heading'     => 'Style',
					'value'       => array(
						esc_html__( 'Simple', 'js_composer' ) => '',
						esc_html__( 'Circle', 'js_composer' ) => 'circle',
					),
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Extra class name',
					'param_name'  => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use 	this field to add a class name and then refer to it in your css file.', 'js_composer' ),
					'value'       => '',
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => 'CSS box',
					'param_name' => 'css',
					'group'      => 'Design options',
					'dependency' => array( 'element' => 'team_style', 'value' => array( 'simple' ) ),
				),
				array(
					'type'        => 'param_group',
					'heading'     => esc_html__( 'Team Member', 'js_composer' ),
					'description' => esc_html__( 'Please add information about team member', 'js_composer' ),
					'param_name'  => 'team_member',
					'value'       => '',
					'dependency'  => array( 'element' => 'team_style', 'value' => array( 'modern' ) ),
					'params'      => array(
						array(
							'type'        => 'attach_image',
							'heading'    => 'Item image',
							'param_name' => 'image',
						),
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Name', 'js_composer' ),
							'description' => esc_html__( 'Please add name for member', 'js_composer' ),
							'param_name'  => 'name',
						),
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Position', 'js_composer' ),
							'description' => esc_html__( 'Please add position for member', 'js_composer' ),
							'param_name'  => 'position',
						),
					),
				),
			)
			//end params
		)
	);
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	/* Frontend Output Shortcode */

	class WPBakeryShortCode_vc_team extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {

			/* get all params */
			extract( shortcode_atts( array(
				'team_style'      => 'simple',
				'image'           => '',
				'name'            => '',
				'link'            => '',
				'link_target'     => false,
				'position'        => '',
				'color_figure'    => '',
				'stroke_width'    => '',
				'enable_animated' => '',
				'figure'          => '',
				'height'          => '',
				'style'           => '',
				'el_class'        => '',
				'css'             => '',
				'team_member'     => array(),

			), $atts ) );

			/* get param class */

			$css_classes = array(
				$this->getExtraClass( $el_class )
			);
			$wrap_class  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );
			/* get custum css as class*/
			$wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );
			$wrap_class .= ! empty( $el_class ) ? ' ' . $el_class : '';

			$poligon_style = '';
			$css           = '';
			if ( ! empty( $stroke_width ) ) {
				$translate = round( $stroke_width / 2 );
				$css       .= '-webkit-transform: translate(' . $translate . 'px,' . $translate . 'px);';
				$css       .= 'transform: translate(' . $translate . 'px,' . $translate . 'px);';
			}
			if ( ! empty( $color_figure ) ) {
				$css .= 'stroke:' . $color_figure . ';';
			}

			if ( ! empty( $stroke_width ) ) {
				$css .= 'stroke-width:' . $stroke_width . ';';
			}

			if ( ! empty( $css ) ) {
				$poligon_style = ' style="' . $css . '"';
			}

			$figures = array(
				'triangle' => '0 200,0 0,200, 0', // triangle
				'square'   => '0,0 200,0 200,200 0,200', // square
				'oxagon'   => '100,0 180,30 200,100 180,180 100,200 30,180 0,100 30,30', // oxagon
			);

			$numbers_array = '';
			if ( ! empty( $numbers ) ) {
				$numbers_array = json_decode( urldecode( $numbers ) );
				$wrap_class    .= count( $numbers_array ) > 1 ? ' multi_item' : ' alone_item';
			}

			if ( ! empty( $style ) ) {
				$wrap_class .= ' ' . $style;
			}


			$css_outer = '';
			if ( ! empty( $height ) ) {
				$height    = is_numeric( $height ) ? $height . 'px' : $height;
				$css_outer .= ' height:' . $height;
			}
			$outer_style = '';
			if ( ! empty( $css_outer ) ) {
				$outer_style = ' style="' . $css_outer . '"';
			}

			if ( empty( $figure ) ) {
				$wrap_class .= ' no-figure';
			}

			$link_target = ( $link_target === true ) ? "_blank" : "_self";

			// start output
			ob_start(); ?>

			<?php if ( $team_style == 'simple' ) : ?>
                <div class="team-wrapper <?php echo esc_attr( $wrap_class . ' ' . $team_style ); ?>">
                    <div class="trans_figures <?php if ( ! empty( $enable_animated ) ) : ?>enable_anima<?php endif; ?>">

						<?php if ( ! empty( $figure ) ): ?>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 preserveAspectRatio="xMidYMid meet">

								<?php if ( $figure == 'circle' ): ?>
                                    <circle fill="transparent" cx="100" cy="100"
                                            r="100" <?php echo $poligon_style; ?> />
								<?php else: ?>
                                    <polygon fill="transparent"
                                             points="<?php echo esc_attr( $figures[ $figure ] ); ?>" <?php echo $poligon_style; ?> />
								<?php endif ?>

                            </svg>
						<?php endif; ?>
                    </div>

                    <div class="team-outer" <?php echo $outer_style; ?>>
						<?php if ( ! empty( $image ) ):
							$image_src = wp_get_attachment_image_src( $image, 'full' );
							$image_src = is_array( $image_src ) ? $image_src[0] : $image_src; ?>
                            <img src="<?php echo esc_url( $image_src ); ?>"
                                 alt="<?php echo get_post_meta( $image, '_wp_attachment_image_alt', true ); ?>"
                                 class="prague-team-img s-img-switch">
						<?php endif; ?>
                    </div>

					<?php if ( ! empty( $position ) ) : ?>
                        <div class="position"><?php echo esc_html( $position ); ?></div>
					<?php endif; ?>
					<?php if ( ! empty( $name ) ) : ?>
                        <div class="name">
							<?php if ( ! empty( $link ) ) {
								echo '<a href="' . esc_url( $link ) . '" target="' . esc_attr( $link_target ) . '">';
							} ?>
                            <h3><?php echo esc_html( $name ); ?></h3>
							<?php if ( ! empty( $link ) ) {
								echo '</a>';
							} ?>
                        </div>
					<?php endif; ?>
                </div>
			<?php endif;

			if ( $team_style == 'modern' ) : ?>
                <div class="team <?php echo esc_attr( $team_style ); ?>">

                    <?php if ( !empty($team_member) ) :
	                    $team_member = (array)vc_param_group_parse_atts($team_member); ?>
                        <div class="team__wrapper">
	                        <?php foreach ( $team_member as $member ) : ?>
                                <div class="team__item">

                                    <?php if ( !empty($member['image']) ) :
	                                    $image_src = wp_get_attachment_image_src( $member['image'], 'full' );
	                                    $image_src = is_array( $image_src ) ? $image_src[0] : $image_src; ?>
                                        <div class="team__item-image">
                                            <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo get_post_meta( $member['image'], '_wp_attachment_image_alt', true ); ?>" class="s-img-switch">
                                        </div>
						            <?php endif; ?>

                                    <?php if ( !empty($member['name']) ) : ?>
                                        <div class="team__item-name"><?php echo esc_html($member['name']); ?></div>
						            <?php endif; ?>

                                    <?php if ( !empty($member['position']) ) : ?>
                                        <div class="team__item-position"><?php echo esc_html($member['position']); ?></div>
						            <?php endif; ?>

                                </div>
					        <?php endforeach; ?>
                        </div>
					<?php endif; ?>

                </div>
			<?php endif;

			// end output
			return ob_get_clean();
		}
	}
}
