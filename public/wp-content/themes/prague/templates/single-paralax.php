<?php $prague_post_options = get_post_meta( get_the_ID(), 'prague_post_options', true ); ?>
<div class="project-detail-parallax" data-parallax-speed="0.5" data-smoothscrolling="">
	<?php if ( !empty( $prague_post_options['show_share'] ) ) : ?>

		<div class="prague-share-icons">

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

	<div class="project-detail-parallax-item">
		<?php if ( has_post_thumbnail() ): ?>
		<div class="detail-parallax-item-bg js-detail-parallax-item-bg">
			<?php the_post_thumbnail( 'full', array('class'=>'') ); ?>
		</div>
		<?php endif; ?>

		<?php if (!empty($prague_post_options['active_title'])): ?>
		<div class="detail-parallax-item-header">
			<?php if(!empty($prague_post_options['subtitle'])): ?>
				<h6 class="detail-parallax-item-header-subtitle">
					<?php echo esc_html( $prague_post_options['subtitle'] ); ?>
				</h6>
			<?php endif ?>

			<?php the_title( '<h1 class="detail-parallax-item-header-title">', '</h1>' ); ?>
		</div>
		<?php endif ?>

	</div>
	
	<?php if (!empty($prague_post_options['gallery'])): 
		$gallery = explode(',', $prague_post_options['gallery']);
		foreach ($gallery as $key => $image_id) : ?>
			<div class="project-detail-parallax-item">

				<div class="detail-parallax-item-bg js-detail-parallax-item-bg">
					<?php echo wp_get_attachment_image( $image_id, 'full' ); ?>
				</div>

				<?php if ( $key == count($gallery) - 1 && !empty($prague_post_options['footer_copiright']) ): ?>
				<div class="detail-parallax-item-footer">
					<h6 class="detail-parallax-item-footer-subtitle">
						<?php echo esc_html( $prague_post_options['footer_copiright'] ); ?>
					</h6>
				</div>
				<?php endif; ?>

			</div>
		<?php endforeach; ?>
	<?php endif ?>

	<div class="project-detail-parallax-cover"></div>
	
	<div class="container padd-only-xs">
		<?php the_content(); ?>
	</div>

</div>
