<?php 
$prague_post_options = get_post_meta( get_the_ID(), 'prague_post_options', true );

$arrows = !empty($prague_post_options['arrows']) ? 1 : 0;
$images = !empty($prague_post_options['gallery']) ? explode(',', $prague_post_options['gallery']) : array();
$slide_speed = !empty($prague_post_options['slide_speed']) ? $prague_post_options['slide_speed'] : '1000';
$autoplay = !empty($prague_post_options['autoplay']) ? 1 : 0;
$autoplay_speed = !empty($prague_post_options['autoplay_speed']) ? $prague_post_options['autoplay_speed'] : '5000';
$projects_pix_categories = ''; 
if ( function_exists('get_pixfields') ) {
	$projects_pix_categories = get_pixfields( get_the_ID() );
}
?>
<div class="project-detail-slider">
	<div class="project-detail-slider-banner">
		<?php if (!empty($images)): ?>
			<div  class="project-detail-main-slider slick-slider" data-key="1" data-arrows="<?php echo esc_attr( $arrows ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-speed="<?php echo esc_attr( $slide_speed ); ?>" data-autoplay-speed="<?php echo esc_attr( $autoplay_speed ); ?>" data-fade="1" data-for=".project-detail-thumb-slider" data-width="0" data-slides="1">

				<?php foreach ($images as $key => $image) : ?>
					<div class="project-detail-main-slide slick-slide">
					<?php echo wp_get_attachment_image( $image, 'full', false, array('class'=>'s-img-switch') ); ?>
					</div>
				<?php endforeach; ?> 

			</div>

			<div class="project-detail-thumb-slider slick-slider" data-key="1" data-arrows="0" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-speed="<?php echo esc_attr( $slide_speed ); ?>" data-autoplay-speed="<?php echo esc_attr( $autoplay_speed ); ?>" data-for=".project-detail-main-slider" data-width="0" data-focus="1" data-vertical="1"  data-vertical-swiping="1" data-slides="6">

				<?php foreach ($images as $key => $image) : ?>
				<div class="project-detail-main-slide slick-slide">
					<?php echo wp_get_attachment_image( $image, 'full', false, array('class'=>'s-img-switch') ); ?>
				</div>
				<?php endforeach; ?> 

			</div>
		<?php endif; ?>
	</div>

	<div class="container padd-only-xs project-detail-slider-outer">
		<div class="row">
			<div class="col-xs-12">
				
				<?php if (!empty($prague_post_options['active_title'])): ?>
					<div class="project-detail-slider-content">

						<?php if (!empty($prague_post_options['subtitle'])): ?>
							<h6 class="project-detail-slider-content-subtitle"><?php echo esc_html( $prague_post_options['subtitle'] ); ?></h6>
						<?php endif ?> 

						<?php the_title( '<h1 class="project-detail-slider-content-title">', '</h1>' ); ?> 
					</div>
				<?php endif ?>

				<?php the_content(); ?>

				<?php if (!empty($prague_post_options['iframe_3d'])): ?>
				<div class="row">
					<div class="col-xs-12">
						<div class="project-details-slider-3d">
							<?php echo wp_kses( $prague_post_options['iframe_3d'] , array( 'iframe' => 
								// enable attributes
								array(
										'src'             => array(),
										'height'          => array(),
										'width'           => array(),
										'frameborder'     => array(),
										'allowfullscreen' => array(),
								)) ); ?>
						</div>
					</div>
				</div>
				<?php endif ?>


				<?php if (!empty($projects_pix_categories) && !empty($prague_post_options['show_details'])): ?>
					<div class="row">
						<div class="col-xs-12">
							<div class="project-detail-block-outer">
							<?php foreach ($projects_pix_categories as $key => $pixfield) : 
								$pixfield_value = get_pixfield($key, get_the_id());
								if (!empty($pixfield_value )): ?>
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
								<?php endif ?>
							<?php endforeach; ?>
							</div>
						</div>
					</div>
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

</div>