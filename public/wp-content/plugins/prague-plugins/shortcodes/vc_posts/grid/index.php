<?php
/*
Template: Projects Grid
Version: 1.0.0
*/
defined( 'ABSPATH' ) or exit;

/**
* @var $data (array) - all params shortcodes
* @var $post
**/
?>

<div class="portfolio-item-wrapp portfolio-item-paralax <?php echo esc_attr( $data['class_wrap_filter'] ); ?>">
	<div class="portfolio-item">

		<div class="project-grid-wrapper">

			<?php if ( has_post_thumbnail() ) : ?>
			<a class="project-grid-item-img-link" href="<?php echo esc_url( $data['url'] ); ?>" target="<?php echo esc_html( $data['url_window'] ); ?>">
				<div class="project-grid-item-img"> 
					<?php the_post_thumbnail( (!empty($data['image_original_size']) ? $data['image_original_size'] : 'medium' ), array('class'=>'s-img-switch') ); ?>
				</div>
			</a>
			<?php endif; ?>

			<div class="project-grid-item-content">
				<?php the_title( '<h4 class="project-grid-item-title"><a href="' . esc_url( $data['url'] ) . '" target="'.esc_html( $data['url_window'] ).'">', '</a></h4>' ); ?>
				<?php if ( !empty($data['filter_type'])  && function_exists('get_pixfield') ) : ?>
				<div class="project-grid-item-category"><?php echo esc_html( get_pixfield($data['filter_type'], get_the_ID()) ); ?></div>
				<?php endif; ?>
			</div>

		</div>
		
	</div>
</div>