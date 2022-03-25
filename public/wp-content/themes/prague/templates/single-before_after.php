<?php 
$prague_post_options = get_post_meta( get_the_ID(), 'prague_post_options', true );
$before_btn_text = !empty($prague_post_options['before_after_text']) && !empty($prague_post_options['before_btn_text']) ? $prague_post_options['before_btn_text'] : esc_html__('BEFORE', 'prague');
$after_btn_text = !empty($prague_post_options['before_after_text']) && !empty($prague_post_options['after_btn_text']) ? $prague_post_options['after_btn_text'] : esc_html__('AFTER', 'prague');

$before_style_class = !empty($prague_post_options['before_style']) && $prague_post_options['before_style'] == 'before_fullheight' ? 'fullheight' : 'original';
$before_style_img_class = !empty($prague_post_options['before_style']) && $prague_post_options['before_style'] == 'before_fullheight' ? 's-img-switch' : '';

$projects_pix_categories = '';
if ( function_exists('get_pixfields') ) {
	$projects_pix_categories = get_pixfields( get_the_ID() );
}
?>
<div class="project-detail-before">
	
	<?php if (!empty($prague_post_options['image_before']) && !empty($prague_post_options['image_after'])): ?>
	<div class="projects-detail-before-banner <?php echo esc_attr( $before_style_class ); ?>">
		<div class="ba-slider">
			<?php if (!empty($prague_post_options['image_before'])): ?>
				<?php echo wp_get_attachment_image( $prague_post_options['image_before'], 'full', '', array('class'=> $before_style_img_class) ); ?>
			<?php endif ?>

			<?php if (!empty($prague_post_options['image_after'])): ?>
			<div class="resize">
				<?php echo wp_get_attachment_image( $prague_post_options['image_after'], 'full', '', array('class'=> $before_style_img_class) ); ?> 
			</div>
			<?php endif ?>
			<span class="handle"></span>
			<a href="#" class="button prev"><?php echo esc_html( $before_btn_text ); ?></a>
			<a href="#" class="button next"><?php echo esc_html( $after_btn_text ); ?></a>
		</div>
	</div>
	<?php endif ?>


	<div class="container padd-only-xs project-detail-before-outer">
		<div class="row">
			<div class="col-xs-12">
				
				<?php if (!empty($prague_post_options['active_title'])): ?>
					<div class="project-detail-before-content">

						<?php if (!empty($prague_post_options['subtitle'])): ?>
							<h6 class="project-detail-before-content-subtitle"><?php echo esc_html( $prague_post_options['subtitle'] ); ?></h6>
						<?php endif ?> 

						<?php the_title( '<h1 class="project-detail-before-content-title">', '</h1>' ); ?> 
					</div>
				<?php endif ?>

				<?php the_content(); ?>

				<?php if (!empty($prague_post_options['iframe_3d'])): ?>
				<div class="row">
					<div class="col-xs-12">
						<div class="project-details-before-3d">
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