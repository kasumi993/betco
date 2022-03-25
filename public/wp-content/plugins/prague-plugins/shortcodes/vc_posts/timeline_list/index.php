<?php
/*
Template: Timeline List
Version: 1.0.0
*/

defined( 'ABSPATH' ) or exit;

/**
* @var $data (array) - all params shortcodes
* @var $post
**/

$pix_categories = array();

if ( function_exists('get_pixfield') ) {
	foreach ($data as $key => $option) {
		if (
			$key == 'filter_type' ||
			$key == 'filter_type_2' ||
			$key == 'filter_type_3'
			) {

			if(empty($option)) continue;
			$pix_categories[$key] = get_pixfield( $data[$key], get_the_ID() );
		}
	}
}
?>

<div class="project-time-list-item <?php echo esc_attr( $data['class_wrap_filter'] ); ?>"> 

	<?php if (!empty($pix_categories['filter_type'])): ?>
		<div class="time-list-item-col cat1">
			<?php echo esc_html( $pix_categories['filter_type'] ); ?>
		</div>
	<?php endif ?>

	<?php the_title( '<div class="time-list-item-col name"><h4 class="time-list-item-title"><a href="' . esc_url( $data['url'] ) . '" target="'.esc_html( $data['url_window'] ).'">', '</a></h4></div>' ); ?>
	
	<?php if (!empty($pix_categories['filter_type_2'])): ?>
	<div class="time-list-item-col cat3">
		<?php echo esc_html( $pix_categories['filter_type_2'] ); ?>
	</div>
	<?php endif ?>
	
	<?php if (!empty($pix_categories['filter_type_3'])): ?>
	<div class="time-list-item-col cat4">
		<?php echo esc_html( $pix_categories['filter_type_3'] ); ?>
	</div>
	<?php endif ?>

</div>