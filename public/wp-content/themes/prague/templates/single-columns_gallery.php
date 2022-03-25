<?php 
$prague_post_options = get_post_meta( get_the_ID(), 'prague_post_options', true );

$projects_pix_categories = ''; 
if ( function_exists('get_pixfields') ) {
	$projects_pix_categories = get_pixfields( get_the_ID() );
}
?>
<div class="project-detail-gallery">
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
	<?php if (!empty($prague_post_options['active_title'])): ?>
	<section class="container-fluid top-banner no-padd simple fullheight light">
		<span class="overlay"></span>
		<?php the_post_thumbnail( 'full', array('class'=>'s-img-switch') ); ?> 
		<div class="content">
			<?php if (!empty($prague_post_options['subtitle'])): ?>
				<div class="subtitle">
					<?php echo esc_html( $prague_post_options['subtitle'] ); ?>
				</div>
			<?php endif ?> 
			<?php the_title( '<h1 class="title">', '</h1>' ); ?>
		</div>
	</section>
	<?php endif ?>


	<?php if (!empty($prague_post_options['gallery'])): ?>
	<div class="container-fluid project-detail-gallery-outer">
		<div class="row">
			<div class="col-xs-12">
				<div class="project-detail-gallery-wrapper js-popup">

					<?php 
					$images = explode(',', $prague_post_options['gallery']); 
					foreach ($images as $key => $image_id) :

						$image_data = wp_get_attachment_image_src( $image_id, 'full' );

						if (!empty($image_data) && is_array($image_data)) :

							// calculate ratio
                            if($image_data[2]){
                                $ratio =  $image_data[1] / $image_data[2];
                            }

							$class_size = "full-width";
							if ($ratio < 1) {
								$class_size = 'full-height';
							}

							$url = is_array($image_data) ? $image_data[0] : $image_data;
							$attachment = get_post( $image_id );
							?>
							<div class="detail-gallery-item-wrapp <?php echo esc_attr( $class_size ); ?>">
								<div class="detail-gallery-item">
                                    <?php if (!empty( $prague_post_options['activate_lightbox'] )): ?>
                                        <a href="<?php echo esc_url( $url ); ?>" class="detail-gallery-item-img">
                                    <?php else: ?>
                                        <span class="detail-gallery-item-img">
                                    <?php endif; ?>
                                        <img src="<?php echo esc_url( $url ); ?>">
										<div class="detail-gallery-item-overlay">
											<div class="vertical-align">
											<?php if (!empty($attachment->post_excerpt)): ?>
												<h4 class="detail-gallery-item-caption">
													<?php echo esc_html( $attachment->post_excerpt ); ?>
												</h4>
											<?php endif ?>
											</div>
										</div>
                                    <?php if (!empty( $prague_post_options['activate_lightbox'] )): ?>
                                        </a>
                                    <?php else: ?>
                                        </span>
                                    <?php endif; ?>
								</div>
							</div>
							<?php

						endif;
						
					endforeach; ?>
					
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

</div>
