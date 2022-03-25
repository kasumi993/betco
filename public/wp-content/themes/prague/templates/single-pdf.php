<?php 
$prague_post_options = get_post_meta( get_the_ID(), 'prague_post_options', true );
?>
<?php if ( !empty($prague_post_options['pdf_shortcode']) ): ?>
<div class="project-detail-pdf">
	<?php if ( !empty( $prague_post_options['show_share'] ) ) : ?>

		<div class="prague-share-icons">

			<?php if ( !empty( $prague_post_options['show_facebook_share'] ) || $prague_post_options['show_facebook_share'] === null ) : ?>
				<button  data-share="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" class="icon fa fa-facebook"></button>
			<?php endif; ?>

			<?php if ( !empty( $prague_post_options['show_twitter_share'] ) || $prague_post_options['show_twitter_share'] === null ) : ?>
				<button  data-share="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" class="icon fa fa-twitter"></button>
			<?php endif; ?>

			<?php if ( !empty( $prague_post_options['show_linkedin_share'] ) || $prague_post_options['show_linkedin_share'] === null ) : ?>
				<button  data-share="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" class="icon fa fa-linkedin"></button>
			<?php endif; ?>

			<?php if ( !empty( $prague_post_options['show_pinterest_share'] ) || $prague_post_options['show_pinterest_share'] === null ) : ?>
				<button  data-share="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo esc_url($url); ?>" class="icon fa fa-pinterest-p"></button>
			<?php endif; ?>

		</div>

	<?php endif; ?>
	<?php echo do_shortcode( $prague_post_options['pdf_shortcode'] ); ?>
</div>
<?php endif; ?>