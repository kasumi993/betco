<?php
/**
 * 404 Page template.
 *
 * @package prague
 * @since 1.0.0
 *
 */

get_header(); 
$bg_image_id = cs_get_option('image_bg');
$image_src = wp_get_attachment_image_src($bg_image_id, 'full');
$image_src = is_array($image_src) ? $image_src[0] : $image_src;
?>
<div class="container padd-only-xs">
	<div class="row">
		<div class="col-xs-12">
			<div class="page-calculate fullheight">
				<div class="page-calculate-content">
					<section class="prague-error-wrapper">
						<?php if (!empty($bg_image_id )) : ?>
						<div class="prague-error-img">
							<img class="s-img-switch" src="<?php echo esc_url( $image_src ); ?>">
						</div>
						<?php endif; ?> 
						<div class="prague-error-content">
							
							<div class="prague-svg-animation-text">
								<?php 
								$text = esc_html__('404', 'prague');

								$svg = new FoxEasySVG();
								$svg->setFontSVG(get_template_directory() .  "/assets/fonts/Roboto-Black-webfont.svg");
								$svg->setFontSize(100);
								$svg->setLineHeight(32);
								$svg->setLetterSpacing(0);
								$svg->addText($text);
								// set width/height according to text
								list($textWidth, $textHeight) = $svg->textDimensions($text);
								$svg->addAttribute("width",   "100%");
								$svg->addAttribute("height",  "100%");
								$color_animation_text = !empty($color_animation_text) ? "stroke:" . esc_attr( $color_animation_text ) : '';
								$svg->addAttribute("style",   $color_animation_text);
								$svg->addAttribute("fill",  "transparent");
								$textHeight = $textHeight + 10;
								$svg->addAttribute("viewBox",  "0 0 " . esc_attr( $textWidth ) . " " . esc_attr( $textHeight ) );
								$svg->addAttribute("preserveAspectRatio",  "xMidYMid meet");
								$svg->addAttribute("class",  "prague-svg");
								echo $svg->asXML();
								?>
							</div>

							<?php if ( cs_get_multilang_option('error_subtitle') ): ?>
							<div class="error-subtitle">
								<?php echo esc_html( cs_get_multilang_option('error_subtitle') ); ?>
							</div>
							<?php else: ?> 
								<div class="error-subtitle">
									<?php echo esc_html__( 'PAGE ERROR', 'prague' ); ?>
								</div>
							<?php endif; ?> 
						
							<?php if ( cs_get_multilang_option('error_title') ): ?>
								<h2 class="error-title">
									<?php echo esc_html( cs_get_multilang_option('error_title', esc_html__( 'Architecture crashed :&#040;', 'prague' )) ); ?>
								</h2>
							<?php else: ?>
								<h2 class="error-title">
									<?php echo esc_html__( 'Architecture crashed :&#040;', 'prague' ); ?>
								</h2>
							<?php endif; ?>

						</div>
						
						<?php if ( cs_get_multilang_option('error_btn_text') ): ?>
							<a href="<?php echo esc_url( home_url( '/' ) );?>" class="error-btn a-btn-2 creative">
								<span class="a-btn-line"></span>
								<?php echo esc_html( cs_get_multilang_option('error_btn_text') ); ?>
							</a>
						<?php else: ?>
							<a href="<?php echo esc_url( home_url( '/' ) );?>" class="error-btn a-btn-2 creative">
								<span class="a-btn-line"></span>
								<?php echo esc_html__( 'TAKE ME HOME', 'prague' ); ?>
							</a>
						<?php endif; ?> 
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer();