<?php
/*
Template: Projects Books
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
		
		<div class="prague-books-wrapper">
			<div class="books-item-img"> 

				<?php the_post_thumbnail( (!empty($data['image_original_size']) ? $data['image_original_size'] : 'middle' ), array('class'=>'s-img-switch') ); ?>

				<div class="vertical-align books-item-img-link">
					<a href="<?php echo esc_url(  $data['url'] ); ?>" class="books-item-link-name a-btn-arrow" target="<?php echo esc_html( $data['url_window'] ); ?>">
						<span class="arrow-right grey"></span>
						<?php echo esc_html( $data['url_text'] ); ?>
					</a>
				</div>

			</div>
			
			<?php the_title( '<div class="books-item-content"><h4 class="books-item-title"><a href="'.esc_url( $data['url'] ).'"  target="'.esc_html( $data['url_window'] ).'">', '</a></h4></div>' ); ?>
			
			<?php if (!empty($data['filter_type']) && function_exists('get_pixfield')) : ?>
				<div class="books-item-category"><?php echo esc_html( get_pixfield($data['filter_type'], get_the_ID()) ); ?></div>
			<?php endif; ?>
		</div>
		
	</div>
</div>