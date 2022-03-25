<?php
/* Footer shortcode */


?>
</div>
<?php if ( !empty($data['filter']) && $data['filter'] == 'enable' && !empty($data['post_type']) && !empty($data['filter_position']) && $data['filter_position'] == 'bottom' ) : 
?>
<div class="filmstrip-footer">
	<div class="filmstrip-filter">

		<?php

		$category = array( 
			'field'    => 'term_id',
		);

		if (!empty($data['cats'])) {
			$category['terms'] = explode( ',', $data['cats'] );
		}

		$defaults = array(
			'post_type' => $data['post_type'],
			'orderby' => !empty($data['orderby']) ? $data['orderby'] : 'date',
			'order' => '',
			'posts_per_page' => '-1',
			'tax_query' => array(
				$category
			)
		);

		$args = array_intersect_key( $data, $defaults );

		$post_query = new WP_Query( $args );

		$categories = array();
		if ( function_exists('get_pixfield') ) {
			foreach ($post_query->posts as $key => $post) {
				$keys = pixfields_get_filterable_metakeys($data['post_type']);
				foreach ($keys as $key2 => $value) {
					$categories[$key2][$key] = get_pixfield($key2, $post->ID);
				}
			}
		}
		?>

		<?php foreach ($categories as $key => $category) { ?>
			<div class="prague-dropdown">
				<a href="#" data-toggle="dropdown"><?php echo esc_html( $key ); ?><i class="icon-arrow"></i></a>
				<ul class="prague-dropdown-menu">
					<?php 
					$category = array_flip($category); 
					ksort($category); 
					foreach ($category as $key2 => $value) { ?>
					<li data-filter="<?php echo esc_html( prague_filter_class($key2) ); ?>">
						<?php echo esc_html( $key2 ); ?>
					</li>
					<?php } ?>
				</ul>
			</div>
			<!-- <select class="selectpicker " title="<?php echo esc_html( $key ); ?>">
				<?php 
				$category = array_flip($category); 
				ksort($category); 
				foreach ($category as $key2 => $value) { ?>
				<option data-filter="<?php echo esc_html( prague_filter_class($key2) ); ?>">
					<?php echo esc_html( $value ); ?>
				</option>
				<?php } ?>
			</select> -->
		<?php }  ?>

		<?php wp_reset_postdata(); ?>

	</div>

	<?php 
	if ( cs_get_option('footer_social_show' ) ) {
		prague_social_nav( cs_get_option('prague_footer_social') );
	} 
	?>
</div>
<?php endif; ?>