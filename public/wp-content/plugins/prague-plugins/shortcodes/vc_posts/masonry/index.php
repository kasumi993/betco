<?php
/*
Template: Projects Masonry
Version: 1.0.0
*/

defined( 'ABSPATH' ) or exit;

/**
* @var $data (array) - all params shortcodes
* @var $post
**/
 
?>

<div class="portfolio-item-wrapp <?php echo esc_attr( $data['class_wrap_filter'] ); ?>">
	<div class="portfolio-item">
		<div class="project-masonry-wrapper">
			<a class="project-masonry-item-img-link" href="<?php echo esc_url( $data['url'] ); ?>" target="<?php echo esc_html( $data['url_window'] ); ?>">
				
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( (!empty($data['image_original_size']) ? $data['image_original_size'] : 'large' ), array('data-s-hidden'=>'true', 'data-s-sibling'=>'true', 'class'=>'s-img-switch') ); ?>
					<div class="project-masonry-item-img"></div>
				<?php endif; ?>

 				<div class="project-masonry-item-content">

					<?php the_title( '<h4 class="project-masonry-item-title">', '</h4>' ); ?>

					<?php if (!empty($data['filter_type']) && function_exists('get_pixfield') ) : ?>
					<div class="project-masonry-item-category"><?php echo esc_html( get_pixfield($data['filter_type'],get_the_ID()) ); ?></div>
					<?php endif; ?>

				</div>
			</a>
		</div>
	</div>
</div>