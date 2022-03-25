<?php
/**
 * Single Page
 *
 * @package prague
 * @since 1.0.0
 *
 */

get_header(); ?>

<?php while ( have_posts() ): the_post();  

	$services_post_options = get_post_meta( get_the_ID(), 'service_post_options', true );

	$pix_categories = '';
	if ( function_exists('get_pixfields') ) {
		$services_pix_categories = get_pixfields(get_the_ID());
		if (!empty($services_pix_categories)) {
			foreach ($services_pix_categories as $key => $option) {
				if (!empty($option['value'])) {
					$pix_categories .= $option['value'] . ',';
				} 
			}
		}
	}
	?>

 	<?php if (get_the_post_thumbnail()) : ?>
	<section class="container-fluid top-banner no-padd big light">
		<span class="overlay"></span> 
		<?php the_post_thumbnail( 'full', array('class'=>'s-img-switch') ); ?>
		<div class="content">
			<?php if (!empty($pix_categories)): ?>
			<div class="subtitle"><?php echo esc_html( trim($pix_categories,',') ); ?></div>
			<?php endif ?>
			<?php the_title( '<h1 class="title">', '</h1>' ); ?>
		</div>
	</section>
	<?php endif; ?>

	<div class="container padd-only-xs">
		<div class="row">
			<div class="col-xs-12">
				<!-- Post content -->
				<div class="services-detailed">

					<?php if ( get_the_content() ): ?>
					<div class="post-content">
						<?php the_content(); ?>
					</div>
					<?php endif ?>

					<?php 
					if (!empty($services_post_options['custum_button_url'])) : ?>
						<a class="a-btn-2 creative" href="<?php echo esc_url( $services_post_options['custum_button_url'] ); ?>">
							<span class="a-btn-line"></span>
							<?php if (!empty($services_post_options['custom_button_lable'])): ?>
								<?php echo esc_html( $services_post_options['custom_button_lable'] ); ?>
							<?php endif ?>
						</a>
					<?php endif;  ?>
				</div>
				<!-- End post content -->
			</div>
		</div>
	</div>
	<?php
endwhile;
get_footer();