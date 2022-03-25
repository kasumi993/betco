<?php $prague_post_options = get_post_meta( get_the_ID(), 'prague_post_options', true ); ?>
<div class="project-detail-parallax" data-parallax-speed="0.5" data-smoothscrolling>
		<div class="paralax-text-share-icons">
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
		</div>
		<?php if (!empty($prague_post_options['active_title'])): ?>

		<div class="project-detail-parallax-item detail-parallax-text-item">

			<?php if ( has_post_thumbnail() ): ?>
			<div class="detail-parallax-item-bg js-detail-parallax-item-bg detail-parallax-text-item-header-on">
				<?php the_post_thumbnail( 'full', array('class'=>'') ); ?>
			</div>
			<?php endif ?>

			<div class="detail-parallax-item-header">
				<?php if (!empty($prague_post_options['subtitle'])): ?>
					<h6 class="detail-parallax-item-header-subtitle">
						<?php echo esc_html( $prague_post_options['subtitle'] ); ?>
					</h6>
				<?php endif ?>
				
				<?php the_title( '<h1 class="detail-parallax-item-header-title">', '</h1>' ); ?>
			</div>

		</div>
		<?php endif ?>
		
		<?php if (!empty($prague_post_options['gallery_repeater'])): ?>
			<?php foreach ($prague_post_options['gallery_repeater'] as $key => $gallery_item): ?>
			<div class="project-detail-parallax-item detail-parallax-text-item">

				<div class="detail-parallax-item-bg js-detail-parallax-item-bg">
					<?php echo wp_get_attachment_image( $gallery_item['image'], 'full' ); ?>
				</div>
				
				<?php 
				if( prague_in_array_any( $gallery_item ) ): ?>

				<div class="detail-parallax-item-<?php echo esc_attr( $gallery_item['position'] ); ?> ">
					
					<?php if (!empty($gallery_item['subtitle'])): ?>
					<h6 class="detail-parallax-item-<?php echo esc_attr( $gallery_item['position'] ); ?>-subtitle">
						<?php echo esc_html( $gallery_item['subtitle'] ); ?>
					</h6>
					<?php endif ?>

					<?php if (!empty($gallery_item['title'])): ?>
					<h2 class="detail-parallax-item-<?php echo esc_attr( $gallery_item['position'] ); ?>-title">
						<?php echo esc_html( $gallery_item['title'] ); ?>
					</h2>
					<?php endif; ?>
					
					<?php if ( !empty($gallery_item['description']) ) : ?>
					<div class="detail-parallax-item-<?php echo esc_attr( $gallery_item['position'] ); ?>-description">
						<?php echo wp_kses_post( wpautop(do_shortcode( $gallery_item['description'] )) ); ?>
					</div>
					<?php endif; ?>

				</div>
				<?php endif ?>

			</div>
			<?php endforeach ?>
			<div class="project-detail-parallax-cover"></div>
		<?php endif ?>

	<div class="container padd-only-xs">
		<?php the_content(); ?>
	</div>

</div>

