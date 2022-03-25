<?php
/*
Template: Projects FilmStrip
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

		<div class="project-filmstrip-wrapper">
			<div class="project-filmstrip-item-img"> 
				<?php the_post_thumbnail( (!empty($data['image_original_size']) ? $data['image_original_size'] : 'middle' ), array('class'=>'') ); ?>
			</div>	
			<div class="project-filmstrip-item-content">
				<?php the_title( '<h3 class="project-filmstrip-item-title">', '</h3>' ); ?>
				<a href="<?php echo esc_attr( $data['url'] ); ?>" class="project-filmstrip-item-link a-btn-arrow" target="<?php echo esc_html( $data['url_window'] ); ?>"<span class="arrow-right grey"></span><?php echo esc_html( $data['url_text'] ); ?></a>
			</div>
		</div>

	</div>
</div>