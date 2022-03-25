<?php
/*
Template: Projects Tile Masonry
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
		<div class="project--tile-masonry__wrapper">

			<a class="project--tile-masonry__img-link" href="<?php echo esc_url( $data['url'] ); ?>" target="<?php echo esc_html( $data['url_window'] ); ?>">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( (!empty($data['image_original_size']) ? $data['image_original_size'] : 'large' ), array('data-s-hidden'=>'true', 'data-s-sibling'=>'true', 'class'=>'s-img-switch') ); ?>
					<div class="project--tile-masonry__item-img"></div>
				<?php endif; ?>
			</a>
			<a class="project--tile-masonry__title-link" href="<?php echo esc_url( $data['url'] ); ?>" target="<?php echo esc_html( $data['url_window'] ); ?>">
				<?php $title = the_title();
				echo esc_html($title); ?>
			</a>

		</div>
	</div>
</div>