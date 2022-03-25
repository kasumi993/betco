<?php
/**
 * Index Page
 *
 * @package prague
 * @since 1.0.0
 *
 */

get_header();

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active('woocommerce/woocommerce.php') ) {
    $type_page = is_cart() || is_checkout() || is_account_page();
} else {
    $type_page = function_exists('is_cart') || function_exists('is_checkout') || function_exists('is_account_page');
}

$content_size_class = 'col-md-12';
$sidebar_option = cs_get_option( 'sidebar' );

$sidebar_enable = '';
if ( 
	!function_exists( 'cs_framework_init' )  ||
	(is_array($sidebar_option) && in_array( 'page', $sidebar_option ) )
)
{	
	$sidebar_enable = 'true';
	$content_size_class = ' col-md-9';
}

while ( have_posts() ):
	the_post();
	$content = get_the_content();

	if ( ! strpos( $content, 'vc_' ) ): ?>

	<div class="container padd-only-xs">
		<div class="row">
		
			<?php if ( post_password_required() ) : ?>
				<div class="<?php echo esc_attr( $content_size_class ); ?> ">
					<div class="page-calculate fullheight">
						<section class="page-calculate-content prague-protected-wrapper">
							<div class="prague-protected-content">

								<?php if (cs_get_multilang_option('protected_subtitle')): ?>
								<div class="protected-subtitle">
								<?php echo esc_html( cs_get_multilang_option('protected_subtitle') ); ?>
								</div>
								<?php endif ?>

								<?php if (cs_get_multilang_option('protected_title')): ?>
								<h2 class="protected-title">
									<?php echo esc_html( cs_get_multilang_option('protected_title') ); ?>
								</h2>
								<?php endif ?>

							</div>
							<?php the_content(); ?>
						</section>
					</div>
				</div>
			<?php else: ?>
				<div class="<?php echo esc_attr( $content_size_class ); ?> margin-lg-140t margin-sm-100t margin-lg-90b margin-sm-50b">
					<div class="post-detailed">

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
							endif; ?>

							<?php if ( !function_exists( 'cs_framework_init' ) || !empty($post_options['category_tags']) ): 
								if (has_tag()): ?>
								<div class="det-tags">
								    <h4><?php esc_html_e('TAGS:', 'prague'); ?></h4>
								    <div class="tags-button">
								        <?php the_tags( '', '' );?>
								    </div>
								</div>
								<?php endif;
							endif; ?>
							 

							<?php if ( ! $type_page ) : 
							if ( ! function_exists( 'cs_framework_init' ) || cs_get_option('post_navigation') ): ?>
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
							<?php endif;
							endif; ?>
						</div>

					</div>

					<?php if ( comments_open() ): ?>
						<div class="post-comments">
							<?php comments_template( '', true ); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($sidebar_enable) && is_active_sidebar('sidebar')): ?>
			<div class="col-md-3 margin-lg-140t margin-sm-50t margin-lg-140b margin-sm-50b">
				<div class="prague-sidebar">
					<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('sidebar') ); ?>
				</div>
			</div>
			<?php endif; ?>

		</div>
	</div>

	<?php else: ?>
		<div class="container padd-only-xs">
			<?php the_content(); ?>
		</div>
	<?php endif; ?>

<?php endwhile;
get_footer();