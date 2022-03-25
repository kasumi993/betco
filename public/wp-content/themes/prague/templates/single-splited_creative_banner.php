<?php 
$prague_post_options = get_post_meta( get_the_ID(), 'prague_post_options', true );

$projects_pix_categories = ''; 
if ( function_exists('get_pixfields') ) {
	$projects_pix_categories = get_pixfields( get_the_ID() );
}
?>
<div class="project-detail-splitted project-detail-creative-b">
	
	<?php if (!empty($prague_post_options['banner'])): ?>
	<div class="container-fluid no-padd">
		<div class="row">
			<div class="col-xs-12">
				<?php echo wp_kses_post( do_shortcode( $prague_post_options['banner'] ) ); ?>
			</div>
		</div>
	</div>
	<?php endif ?>

	<div class="container padd-only-xs project-detail-splitted-wrapper">
		<div class="row">
			<div class="col-xs-12">
				<div class="project-detail-splitted-columns">
					<div class="project-detail-splitted-column1">
						<div class="project-detail-splitted-inner">
							<div class="project-detail-splitted-info">

								<div class="project-detail-splitted-content">

									<?php if (!empty($prague_post_options['second_subtitle'])): ?>
									<h6 class="project-detail-splitted-content-subtitle">
										<?php echo esc_html( $prague_post_options['second_subtitle'] ); ?>
									</h6>
									<?php endif ?>

									<?php if (!empty($prague_post_options['title'])): ?>
									<h2 class="project-detail-splitted-content-title">
										<?php echo esc_html( $prague_post_options['title'] ); ?>
									</h2>
									<?php endif ?>
									
									<?php if (!empty($prague_post_options['description'])): ?>
										<div class="project-detail-splitted-content-description">
											<p><?php echo wp_kses_post( wpautop( do_shortcode($prague_post_options['description']) ) ); ?></p>
										</div>
									<?php endif ?> 

								</div>

								<?php if (!empty($projects_pix_categories) && !empty($prague_post_options['show_details'])): ?>

									<?php foreach ($projects_pix_categories as $key => $pixfield) : 

										$pixfield_value = get_pixfield($key, get_the_id());
										if (!empty($pixfield_value )): ?>
											<div class="project-detail-block-outer">
												<div class="project-detail-block-wrapper">
													<div class="project-detail-block-item">
														<?php if (!empty($pixfield['label'])): ?>
														<div class="project-detail-block-title">
															<?php echo esc_html( $pixfield['label'] ); ?>
														</div>
														<?php endif ?>

														<div class="project-detail-block-descr">
															<p><?php echo esc_html( $pixfield_value ); ?></p>
														</div>
													</div>
												</div>
											</div>
										<?php endif ?>

									<?php endforeach; ?>
								<?php endif ?>

								<?php if ( !empty( $prague_post_options['show_share'] ) ) : ?>
								
									<div class="prague-share-icons">
										<div class="prague-share-label"><?php esc_html_e('SHARE PROJECT', 'prague'); ?></div>

										<?php if ( !empty( $prague_post_options['show_facebook_share'] ) || $prague_post_options['show_facebook_share'] === null ) : ?>
											<button  data-share="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" class="icon fa fa-facebook"></button>
										<?php endif; ?>

										<?php if ( !empty( $prague_post_options['show_twitter_share'] ) || $prague_post_options['show_twitter_share'] === null ) : ?>
											<button  data-share="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" class="icon fa fa-twitter"></button>
										<?php endif; ?>

										<?php if ( !empty( $prague_post_options['show_linkedin_share'] ) || $prague_post_options['show_linkedin_share'] === null ) : ?>
											<button  data-share="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" class="icon fa fa-linkedin"></button>
										<?php endif; ?>

										<?php if ( !empty( $prague_post_options['show_pinterest_share'] ) || $prague_post_options['show_pinterest_share'] === null ) : ?>
											<button  data-share="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo esc_url($url); ?>" class="icon fa fa-pinterest-p"></button>
										<?php endif; ?>

									</div>

								<?php endif; ?>

							</div>
						</div>
					</div>

					<?php if (!empty($prague_post_options['gallery'])): ?>
					<div class="project-detail-splitted-column2">
						<div class="project-detail-splitted-inner"> 
							<div class="project-detail-splitted-medias js-popup">
								<?php $images = explode(',', $prague_post_options['gallery']); 
								foreach ($images as $key => $image) : ?>
                                    <?php if (!empty( $prague_post_options['activate_lightbox'] )): ?>
                                        <a href="<?php echo wp_get_attachment_image_url( $image, 'full' ); ?>">
                                            <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                                        </a>
                                    <?php else: ?>
									    <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                                    <?php endif; ?>
								<?php endforeach; ?> 
							</div>
						</div>
					</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
		<?php the_content(); ?>
	</div>

</div>