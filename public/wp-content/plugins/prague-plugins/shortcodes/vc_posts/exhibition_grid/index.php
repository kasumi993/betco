<?php
/*
Template: Projects Exhibition Grid
Version: 1.0.0
*/

defined( 'ABSPATH' ) or exit;

/**
* @var $data (array) - all params shortcodes
* @var $post
**/

?>

<div class="portfolio-item-wrapp prague_filter_class <?php echo esc_attr( $data['class_wrap_filter'] ); ?>">
	<div class="portfolio-item">

		<div class="prague-exhib-grid-wrapper">
				<a class="exhib-grid-item-link" href="<?php echo esc_url( $data['url'] ); ?>" target="<?php echo esc_html( $data['url_window'] ); ?>">
					
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="exhib-grid-item-img"> 
						<?php the_post_thumbnail( (!empty($data['image_original_size']) ? $data['image_original_size'] : 'middle' ), array('class'=>'s-img-switch') ); ?>
					</div>
					<?php endif; ?>
					
					<div class="exhib-grid-item-content">

						<?php the_title( '<h4 class="exhib-grid-item-title">', '</h4>' ); ?>
						
						<?php if ( !empty($data['filter_type']) && function_exists('get_pixfield') ) : ?>
							<div class="exhib-grid-item-category"><?php echo esc_html( get_pixfield($data['filter_type'], get_the_ID()) ); ?></div>
						<?php endif; ?>
						
					</div>

				</a>

		</div>
		
	</div>
</div>