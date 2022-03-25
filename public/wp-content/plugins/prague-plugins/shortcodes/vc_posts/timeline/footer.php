</div> <!-- project-timeline-content-wrapper -->

<div class="project-timeline-img-wrapper">
	<?php while ( $data['posts']->have_posts() ) : $data['posts']->the_post(); 
		$post_options = get_post_meta( get_the_ID(), 'prague_post_options', true );
		
		if ( !empty($post_options['gallery']) ) : ?>
		
			<div class="timeline-img-item" data-unique-key="<?php echo esc_attr(prague_filter_class( 'post_' . get_the_ID() )); ?>">
				<?php 
					$images = explode( ',', $post_options['gallery'] );
					$images = array_slice($images,0,3);
					foreach ( $images as $image ) : 
							 $url        = ( !empty( $image ) && is_numeric( $image )  ) ? wp_get_attachment_image_src( $image, 'large' ) : '';
							 $url = is_array($url) ? $url[0] : $url;
							 $alt      = get_post_meta( $image, '_wp_attachment_image_alt', true );
				 ?>
				<div class="timeline-img">
					<img class="s-img-switch" src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
				</div>
			<?php endforeach; ?>
			</div>
		<?php endif ?>

	<?php endwhile; ?>
</div>
