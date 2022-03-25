<?php
/*
Template: Blog
Version: 1.0.0
*/

defined( 'ABSPATH' ) or exit;

/**
* @var $data (array) - all params shortcodes
* @var $post
**/

?>
	<div class="blog-post col-xs-12 <?php echo esc_attr( $data['class_wrap_filter'] ); ?>">
		<div class="prague-blog-list-wrapper">
			<div class="blog-list-img">
				<?php the_post_thumbnail( (!empty($data['image_original_size']) ? $data['image_original_size'] : 'middle' ), array('class'=>'s-img-switch wp-post-image') ); ?> 
			</div>
			<div class="blog-list-content">
				<div class="blog-list-post-date">
					<?php 
					if ( cs_get_option('enable_human_diff') ) { 
						echo human_time_diff( 
							get_the_time('U'),
							current_time('timestamp')
						) . ' ' . esc_html__( 'ago', 'prague-plugins' );;
					} else {
						the_time( get_option( 'date_format' ) );
					} 
					?>
				</div>
				<?php the_title( '<h3 class="blog-list-post-title"><a href="' . esc_url($data['url']) . '" target="'.esc_html( $data['url_window'] ).'">', '</a></h3>' ); ?>
				<div class="blog-list-post-excerpt">
					<p><?php the_excerpt(); ?></p>
				</div>
				<a href="<?php echo esc_url( $data['url'] ); ?>" class="blog-list-link a-btn-arrow-2" target="<?php echo esc_html( $data['url_window'] ); ?>">
					<span class="arrow-right"></span>
					<?php echo esc_html( $data['url_text'] ); ?>
				</a>
			</div>
		</div>
	</div>