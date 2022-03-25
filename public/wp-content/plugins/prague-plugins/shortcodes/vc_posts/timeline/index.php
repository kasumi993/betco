<?php
/*
Template: Timeline
Version: 1.0.0
*/

defined( 'ABSPATH' ) or exit;

/**
* @var $data (array) - all params shortcodes
* @var $post
**/

?>
<div class="project-timeline-item<?php echo esc_attr( $data['class_wrap_filter'] ); ?>" data-post-key="<?php echo esc_attr(prague_filter_class( 'post_' . get_the_ID() )); ?>" > 
	<?php if ( !empty($data['filter_type']) && function_exists('get_pixfield') ): ?>
		<div class="time-list-header-col cat1">
			<?php echo esc_html( get_pixfield($data['filter_type'], get_the_ID() ) ); ?>
		</div>
	<?php endif ?>
	<div class="time-list-header-col time-item-info">
		<?php the_title( '<div class="time-item-name"><h4 class="time-item-title">', '</h4></div>' ); ?>
		<div class="time-item-link">
			<a class="time-item-btn a-btn-arrow-2" href="<?php echo esc_url( $data['url'] ); ?>" target="<?php echo esc_html( $data['url_window'] ); ?>">
				<?php echo esc_html( $data['url_text'] ); ?>
				<span class="arrow-right grey"></span>
			</a>
		</div>
	</div>
</div>
<?php 
$post_options = get_post_meta( get_the_ID(), 'prague_post_options', true );

if ( !empty($post_options['gallery']) ) : ?>

	<div class="timeline-img-item-sm">
		<?php 
			$images = explode( ',', $post_options['gallery'] );
			$images = array_slice($images,0,3);
			foreach ( $images as $image ) : 
					 $url        = ( !empty( $image ) && is_numeric( $image )  ) ? wp_get_attachment_image_src( $image, (!empty($data['image_original_size']) ? $data['image_original_size'] : 'large' )) : '';
					 $url = is_array($url) ? $url[0] : $url;
					 $alt      = get_post_meta( $image, '_wp_attachment_image_alt', true );
		 ?>
		<div class="timeline-img-sm">
			<img class="s-img-switch" src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
		</div>
	<?php endforeach; ?>
	</div>
<?php endif ?>

