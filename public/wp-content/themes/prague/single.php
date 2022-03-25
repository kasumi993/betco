<?php
/**
 * Single Page
 *
 * @package prague
 * @since 1.0.0
 *
 */

get_header(); 

$content_size_class = 'col-md-12';
$sidebar_option = cs_get_option( 'sidebar' );

$sidebar_enable = '';

 if ( !function_exists( 'cs_framework_init' )  || (is_array($sidebar_option) && in_array( 'post', $sidebar_option ) )
	) {
		$sidebar_enable = 'true';
		$content_size_class = ' col-md-9';
	}

while ( have_posts() ): the_post(); 



$post_options = get_post_meta( get_the_ID(), 'prague_post_options', false );
if (!empty($post_options[0])) {
	$post_options = is_array($post_options) ? $post_options[0] : $post_options;
}
?>
	<div class="container padd-only-xs">
		<div class="row">
			<div class="<?php echo esc_attr( $content_size_class ); ?> margin-lg-140t margin-sm-100t margin-lg-90b margin-sm-50b">
				<!-- Post content -->
				<div <?php post_class( 'post-detailed' ); ?>>

					<?php the_title( '<h2 class="prague-post-title">', '</h2>' ); ?>
					
					<?php if ( !function_exists( 'cs_framework_init' ) || !empty($post_options['created_date'])): ?>
					<div class="prague-post-date">
						<?php 
						if ( cs_get_option('enable_human_diff') ) { 
							echo human_time_diff( 
								get_the_time('U'),
								current_time('timestamp')
							) . ' ' . esc_html__( 'ago', 'prague' );;
						} else {
							the_time( get_option( 'date_format' ) );
						} 
						?>
					</div>
					<?php endif ?>
					
					<?php if (has_post_thumbnail()): ?>
					<div class="prague-post-thumbnail">
						<?php the_post_thumbnail( 'full' ); ?>
					</div>
					<?php endif ?>
					
					<div class="prague-post-content-outer">

						<?php if ( get_the_content() ): ?>
						<div class="prague-post-content">
							<?php the_content(); ?>

							<?php wp_link_pages( 'link_before=<span class="pages">&link_after=</span>&before=<div class="post-nav"> <span>' . esc_html__( "Page:", 'prague' ) . ' </span> &after=</div>' ); ?>
						</div>
						<?php endif ?>
						
						<?php if (!empty($post_options['show_info'])): ?>
						<div class="prague-post-info">

							<?php if (!empty($post_options['show_author'])): ?>
							<div class="prague-authot-info">
								<div class="prague-authot-label">
									<?php esc_html_e('CREATED BY', 'prague'); ?>
								</div>
								<div class="prague-authot-name">
									<?php the_author(); ?>
								</div>
							</div>
							<?php endif ?>
							
							<?php if (!empty($post_options['show_share'])): ?>
							<div class="prague-share-icons">
								<div class="prague-share-label">
									<?php esc_html_e('SHARE TO', 'prague'); ?>
								</div>
								<button class="icon fa fa-facebook" data-share="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>"></button>
								<button class="icon fa fa-twitter" data-share="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php esc_attr_e('Tweet this!', 'prague'); ?>"></button>
								<button class="icon fa fa-pinterest-p" data-share="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url=wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo esc_url( $url ); ?>"></button>
								<button class="icon fa fa-linkedin" data-share="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" title="<?php esc_attr_e('Share on LinkedIn', 'prague'); ?>"></button>
							</div>
							<?php endif ?>

						</div>
						<?php endif ?>
						

						<?php if ( !function_exists( 'cs_framework_init' ) || !empty($post_options['category_show']) ):
							if ( has_category() ): ?>
					        <div class="det-tags pad-top-zerro">
					            <h4><?php esc_html_e('CATEGORIES:', 'prague'); ?></h4>
					            <div class="tags-button">
					                <?php the_category( ' ' );?>
					            </div>
					        </div> 
							<?php endif;
						endif ?>

						<?php if ( !function_exists( 'cs_framework_init' ) || !empty($post_options['category_tags']) ): 
							if (has_tag()): ?>
							<div class="det-tags">
							    <h4><?php esc_html_e('TAGS:', 'prague'); ?></h4>
							    <div class="tags-button">
							        <?php the_tags( '', '' );?>
							    </div>
							</div>
							<?php endif;
						endif ?>


						<?php if (  !function_exists( 'cs_framework_init' ) || cs_get_option('post_navigation') ): ?>
							<div class="post-navigation">
								<?php
								$next_post = get_next_post();
								$prev_post = get_previous_post();
								?>
								<?php if ( ! empty( $prev_post ) ): ?>
									<ul class="pagination pagination_mod-a">
										<li>
											<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"><?php esc_html_e('PREV PAGE', 'prague'); ?></a>
										</li>
									</ul>
								<?php endif;
								if ( ! empty( $next_post ) ): ?>
									<ul class="pagination pagination_mod-a pull-right">
										<li>
											<a href="<?php the_permalink( $next_post->ID ); ?>"><?php esc_html_e('NEXT PAGE', 'prague'); ?></a>
										</li>
									</ul>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
					
				</div>
				<!-- End post content -->

				<?php if ( comments_open() || get_comments_number() ): ?>
					<!-- Post comments -->
					<div class="post-comments">
						<?php comments_template( '', true ); ?>
					</div>
					<!-- End post comments -->
				<?php endif; ?>
				
			</div>
			<?php if (!empty($sidebar_enable) && is_active_sidebar('sidebar')): ?>
			<div class="col-md-3 margin-lg-140t margin-sm-50t margin-lg-140b margin-sm-50b">
				<div class="prague-sidebar">
					<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('sidebar') ); ?>
				</div>
			</div>
			<?php endif ?>
		</div>
	</div>
	<?php

endwhile;

get_footer();
