<?php 
$prague_post_options = get_post_meta( get_the_ID(), 'prague_post_options', true );

$arrows = !empty($prague_post_options['arrows']) ? 1 : 0;
$images = !empty($prague_post_options['gallery']) ? explode(',', $prague_post_options['gallery']) : array();
$slide_speed = !empty($prague_post_options['slide_speed']) ? $prague_post_options['slide_speed'] : '1000';
$autoplay = !empty($prague_post_options['autoplay']) ? 1 : 0;
$autoplay_speed = !empty($prague_post_options['autoplay_speed']) ? $prague_post_options['autoplay_speed'] : '5000';
?>

<div class="project-detail-fullscreen">
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
	
	<?php if (!empty($images)): ?>
		<div class="project-detail-full-main slick-slider" data-key="1" data-arrows="<?php echo esc_attr( $arrows ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-speed="<?php echo esc_attr( $slide_speed ); ?>" data-autoplay-speed="<?php echo esc_attr( $autoplay_speed ); ?>" data-fade="1" data-for=".project-detail-full-thumb" data-width="0" data-slides="1">
			
			<?php foreach ($images as $key => $image) : ?>
				<div class="project-detail-main-slide slick-slide">
					<?php echo wp_get_attachment_image( $image, 'full', false, array('class'=>'s-img-switch') ); ?> 
				</div>
			<?php endforeach; ?> 

		</div>
	<?php endif; ?>

	<div class="project-detail-full-overlay">

		<div class="pulse1"></div>
		<div class="pulse2"></div>
		<div class="icon"></div>
	</div>
	
	<?php if (!empty($images)): ?>
		<div class="project-detail-full-thumb slick-slider" data-key="1" data-arrows="0" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-speed="<?php echo esc_attr( $slide_speed ); ?>" data-autoplay-speed="<?php echo esc_attr( $autoplay_speed ); ?>" data-for=".project-detail-full-main" data-width="0" data-focus="1" data-slides="5">
			<?php foreach ($images as $key => $image) : ?>
				<div class="project-detail-main-slide slick-slide">
					<?php echo wp_get_attachment_image( $image, 'middle', false, array('class'=>'s-img-switch') ); ?> 
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if (!empty($prague_post_options['active_title'])): ?>
		<div class="project-detail-fullscreen-content">

			<?php if (!empty($prague_post_options['subtitle'])): ?>
				<h6 class="project-detail-fullscreen-content-subtitle"><?php echo esc_html( $prague_post_options['subtitle'] ); ?></h6>
			<?php endif ?>
			
			<?php the_title( '<h2 class="project-detail-fullscreen-content-title">', '</h2>' ); ?>

			<?php if ( get_the_excerpt() ): ?>
				<div class="project-detail-fullscreen-content-descr">
					<?php the_excerpt(); ?>
				</div>
			<?php endif ?>

		</div>
	<?php endif ?>
</div>

<div class="container padd-only-xs">
	<?php the_content(); ?>
</div>