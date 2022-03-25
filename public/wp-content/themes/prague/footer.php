<?php
/**
 * Footer template.
 *
 * @package prague
 * @since 1.0.0
 *
 */

$footer            = true;
$page_id           = is_home() ? get_option('page_for_posts') : get_the_ID();
$meta_data         = get_post_meta($page_id, 'prague_post_options', true);
$meta_data_service = get_post_meta($page_id, 'service_post_options', true);
// Style footer
$footer_style = (isset($meta_data['style_footer']) && $meta_data['style_footer'] == 'modern') ? 'modern' : 'default';
$footer_style = (isset($meta_data['style_footer']) && $meta_data['style_footer'] == 'copy') ? 'copy' : $footer_style;
$footer_style = (isset($meta_data['style_footer']) && $meta_data['style_footer'] == 'simple') ? 'simple' : $footer_style;

if ( isset($meta_data['page_footer']) && $meta_data['page_footer'] || isset($meta_data_service['page_footer']) && $meta_data_service['page_footer'] ) {
	$footer = false;
} ?>


<?php if ( $footer ) : ?>
	<!-- START FOOTER -->
	<footer class="prague-footer <?php echo esc_attr($footer_style); ?>">

		<?php if ( isset($footer_style) && $footer_style != 'simple' ) { ?>
			<?php if ( isset($footer_style) && $footer_style == 'default' ) :
				echo wp_get_attachment_image(cs_get_option('footer_image'), 'full', '', array('class' => 's-img-switch'));
			endif; ?>

			<div class="footer-content-outer">

				<?php if ( isset($footer_style) && $footer_style == 'default' ) : ?>
					<div class="footer-top-content">
						<div class="prague-footer-main-block">

							<?php footer_logo(); ?>

							<?php if ( cs_get_multilang_option('footer_content') ): ?>
								<div class="footer-main-content">
									<?php
									echo wp_kses_post(wpautop(do_shortcode(cs_get_multilang_option('footer_content'))));
									?>
								</div>
							<?php endif ?>

						</div>
						<div class="prague-footer-info-block">

							<?php if ( cs_get_multilang_option('main_title') ): ?>
								<h6 class="footer-info-block-title"><?php echo esc_html(cs_get_multilang_option('main_title')); ?></h6>
							<?php endif ?>

							<?php if ( cs_get_multilang_option('main_content') ): ?>
								<div class="footer-info-block-content">
									<?php echo wp_kses_post(wpautop(do_shortcode(cs_get_multilang_option('main_content')))); ?>
								</div>
							<?php endif ?>

						</div>
					</div>
				<?php endif; ?>
				<div class="footer-bottom-content">

					<!-- Footer copyright -->
					<?php if ( cs_get_multilang_option('footer_copyright') ): ?>
						<div class="footer-copyright">
							<?php echo wp_kses_post(wpautop(cs_get_multilang_option('footer_copyright'))); ?>
						</div>
					<?php else: ?>
						<div class="footer-copyright">
							<?php esc_html_e('PRAGUE (C) 2018 ALL RIGHTS RESERVED', 'prague'); ?>
						</div>
					<?php endif; ?>
					<!-- End footer copyright -->

					<?php
					// render social icons
					if ( $footer_style == 'default' || $footer_style == 'modern' ) {
						if ( cs_get_option('footer_social_show') ) {
							prague_social_nav(cs_get_option('prague_footer_social'));
						}
					}
					?>

				</div>
			</div>
		<?php } ?>



		<?php if ( isset($footer_style) && $footer_style == 'simple' ) { ?>
			<div class="container">
				<div class="prague-footer__top">
					<div class="prague-footer__section">
						<?php footer_logo(); ?>

						<?php if ( cs_get_multilang_option('footer_simple_content') ): ?>
							<div class="prague-footer__info">
								<?php echo wp_kses_post(wpautop(do_shortcode(cs_get_multilang_option('footer_simple_content')))); ?>
							</div>
						<?php endif ?>

						<!-- Start footer socials -->
						<?php if ( cs_get_option('footer_social_show') ) {
							prague_social_nav(cs_get_option('prague_footer_social'));
						} ?>
						<!-- End footer socials -->
					</div>
					<?php if ( !empty(cs_get_option('footer_simple_contacts_title')) ||
						!empty(cs_get_option('footer_simple_contacts_info')) ||
						!empty(cs_get_option('footer_simple_feedback_title')) ||
						!empty(cs_get_option('footer_simple_feedback_email')) ||
						!empty(cs_get_option('footer_simple_feedback_phone')) ) { ?>
						<div class="prague-footer__section">
							<?php if ( !empty(cs_get_option('footer_simple_contacts_title')) || !empty(cs_get_option('footer_simple_contacts_info')) ) { ?>
								<div class="prague-footer__section-contacts">
									<?php if ( !empty(cs_get_option('footer_simple_contacts_title')) ) { ?>
										<div class="prague-footer__section-contacts-title"><?php echo esc_html(cs_get_option('footer_simple_contacts_title'));?></div>
									<?php } ?>

									<?php if ( !empty(cs_get_option('footer_simple_contacts_info')) ) { ?>
										<div class="prague-footer__section-contacts-info">
											<?php echo wp_kses_post(wpautop(do_shortcode(cs_get_multilang_option('footer_simple_contacts_info')))); ?>
										</div>
									<?php } ?>
								</div>
							<?php } ?>

							<?php if ( !empty(cs_get_option('footer_simple_feedback_title')) || !empty(cs_get_option('footer_simple_feedback_email')) || !empty(cs_get_option('footer_simple_feedback_phone')) ) { ?>
								<div class="prague-footer__section-feedback">
									<?php if ( !empty(cs_get_option('footer_simple_feedback_title')) ) { ?>
										<div class="prague-footer__section-feedback-title"><?php echo esc_html(cs_get_option('footer_simple_feedback_title'));?></div>
									<?php } ?>

									<?php if ( !empty(cs_get_option('footer_simple_feedback_email')) ) {
										$mail = cs_get_option('footer_simple_feedback_email'); ?>
										<a href="mailto:<?php echo esc_url($mail);?>" class="prague-footer__section-feedback-email"><?php echo esc_html($mail);?></a>
									<?php } ?>

									<?php if ( !empty(cs_get_option('footer_simple_feedback_phone')) ) {
										$phone = cs_get_option('footer_simple_feedback_phone');
										$phone_number = preg_replace("/[^\d]/", "", $phone); ?>
										<a href="tel:<?php echo esc_url($phone_number);?>" class="prague-footer__section-feedback-phone"><?php echo esc_html($phone);?></a>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_simple_sidebar') ) {
						;
					} ?>
				</div>
				<div class="prague-footer__bottom">
					<!-- Footer copyright -->
					<?php if ( cs_get_multilang_option('footer_copyright') ): ?>
						<div class="prague-footer__copyright">
							<?php echo wp_kses_post(wpautop(cs_get_multilang_option('footer_copyright'))); ?>
						</div>
					<?php else: ?>
						<div class="prague-footer__copyright">
							<?php esc_html_e('(C) Prague studio 2019. All right reserved', 'prague'); ?>
						</div>
					<?php endif; ?>
					<!-- End footer copyright -->
				</div>
			</div>
		<?php } ?>

	</footer>

	<?php if ( cs_get_option('page_scroll_up') ): ?>
		<!-- SCROLL TOP BUTTON -->
		<div class="prague-scroll-top"></div>
		<!-- END SCROLL TOP BUTTON -->
	<?php endif; ?>

<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>

