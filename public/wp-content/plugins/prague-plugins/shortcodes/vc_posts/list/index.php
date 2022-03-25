<?php
/*
Template: Projects List
Version: 1.0.0
*/

defined( 'ABSPATH' ) or exit;

/**
* @var $data (array) - all params shortcodes
* @var $post
**/
 
?>
<div class="project-list-item <?php echo esc_attr( $data['class_wrap_filter'] ); ?>"> 
	<div class="project-list-outer">

		<?php if (!empty($data['figure_enable'])): ?>
		<div class="trans_figures enable_anima">
			<svg xmlns="http://www.w3.org/2000/svg"
			   preserveAspectRatio="xMidYMid meet">

			     <?php if ($data['figure_name'] == 'circle'): ?>
			       <circle fill="transparent" cx="100" cy="100" r="100" <?php echo $data['poligon_style']; ?> />
			     <?php else: ?>
			       <polygon fill="transparent" points="<?php echo esc_attr( $data['figure_path'] ); ?>" <?php echo $data['poligon_style']; ?> />
			     <?php endif ?>

			</svg>
		</div>
		<?php endif ?>
		
		<div class="project-list-wrapper">

			<div class="project-list-img"> 
				<?php the_post_thumbnail( (!empty($data['image_original_size']) ? $data['image_original_size'] : 'middle' ), array('class'=>'s-img-switch') ); ?>
			</div>

			<div class="project-list-content">

				<?php if (!empty($data['filter_type'])  && function_exists('get_pixfield') ) : ?>
					<div class="project-list-category"><?php echo esc_html( get_pixfield($data['filter_type'],get_the_ID()) ); ?></div>
				<?php endif; ?> 

				<?php the_title( '<h3 class="project-list-title"><a href="'.esc_url( $data['url'] ).'" target="'.esc_html( $data['url_window'] ).'">', '</a></h3>' ); ?>

				<div class="project-list-excerpt">
					<p><?php the_excerpt(); ?></p>
				</div>

				<a href="<?php echo esc_url( $data['url'] ); ?>" class="project-list-link a-btn-arrow-2" target="<?php echo esc_html( $data['url_window'] ); ?>">
					<span class="arrow-right"></span>
					<?php echo esc_html( $data['url_text'] ); ?>
				</a>

			</div>
		</div>
	</div>
</div>