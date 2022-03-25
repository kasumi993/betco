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

	$prague_post_options = get_post_meta( get_the_ID(), 'prague_post_options', true );

	if (!empty($prague_post_options['style'])) {
		get_template_part( 'templates/single', $prague_post_options['style'] );
	}

endwhile;

get_footer();
