<?php
/*
Template: Projects Services
Version: 1.0.0

@var $button_style

*/
defined( 'ABSPATH' ) or exit;

/**
* @var $data (array) - all params shortcodes
* @var $post
**/

?>

<div class="portfolio-item-wrapp prague_filter_class <?php echo esc_attr( $data['class_wrap_filter'] ); ?>">
	<div class="portfolio-item">

		<div class="prague-services-wrapper">
			<?php if (!empty($data['icon_post'])): ?>
				<span class="services-item-icon <?php echo esc_attr( $data['icon_post'] ); ?>"></span>
			<?php endif ?>
 
			<?php the_title( '<h3 class="services-item-title">', '</h3>' ); ?>

			<div class="services-item-description">
				<?php the_excerpt(); ?>
			</div>

			<a href="<?php echo esc_url( $data['url'] ); ?>" class="<?php echo esc_attr( $data['button_link_class'] ); ?>" target="<?php echo esc_html( $data['url_window'] ); ?>">
				<span class="<?php echo esc_attr( $data['button_span_class'] ); ?>"></span>
			    <?php echo esc_html( $data['url_text'] ); ?>
			</a>

		</div>

	</div>
</div>