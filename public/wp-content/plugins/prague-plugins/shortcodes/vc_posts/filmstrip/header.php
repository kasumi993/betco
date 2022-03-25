<?php 
$keyboard = !empty($data['keyboard']) ? 1 : 0;
$arrows = !empty($data['arrows']) ? 1 : 0;
$autoplay = !empty($data['autoplay']) ? 1 : 0;
$speed = !empty($data['speed']) ? $data['speed'] : '2000';
$autoplay_speed = !empty($data['autoplay_speed']) ? $data['autoplay_speed'] : '2000';
?>

<div class="filmstrip-slider slick-slider" 
	data-key="<?php echo esc_attr( $keyboard ); ?>" 
	data-arrows="<?php echo esc_attr( $arrows ); ?>" 
	data-autoplay="<?php echo esc_attr( $autoplay ); ?>" 
	data-speed="<?php echo esc_attr( $speed ); ?>" 
	data-autoplay-speed="<?php echo esc_attr( $autoplay_speed ); ?>">
	