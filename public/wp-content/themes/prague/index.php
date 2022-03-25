<?php
/**
 * The main template file.
 *
 * @package prague
 * @since 1.0.0
 *
 */

$content_size_class = 'col-md-12';
$sidebar_option = cs_get_option( 'sidebar' );

$sidebar_enable = '';
if ( 
	!function_exists( 'cs_framework_init' )  ||
	(is_array($sidebar_option) && in_array( 'blog', $sidebar_option ) )
	)
{	
 	$sidebar_enable = 'true';
	$content_size_class = ' col-md-9';
}

//get paginations links
$paginate_links = paginate_links(array(
	'prev_text' => esc_html__('PREV PAGE','prague'),
	'next_text' => esc_html__('NEXT PAGE','prague'),
	));

get_header(); ?>

<?php if ( function_exists( 'cs_framework_init' ) ): ?>
<section class="container-fluid top-banner no-padd big light">
	<span class="overlay"></span> 

	<?php if (cs_get_option('blogs_image')):
		echo wp_get_attachment_image( cs_get_option('blogs_image'), 'full',false, array('class'=>'s-img-switch') );
	endif; ?>

	<div class="content">
		<?php if (cs_get_multilang_option('blog_subtitle')) : ?>
		<div class="subtitle"><?php echo esc_html( cs_get_multilang_option('blog_subtitle') ); ?></div>
		<?php endif; ?>
		<?php if (cs_get_multilang_option('blog_title')) : ?>
		<h1 class="title"><?php echo esc_html( cs_get_multilang_option('blog_title') ); ?></h1>
		<?php endif; ?>
	</div>
</section>
<?php endif ?>

<div class="container padd-only-xs">
	<div class="row">
        <?php
            global $wp_query;
            $total = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
            $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
        ?>
		<div class="<?php echo esc_attr( $content_size_class ); ?> js-load-more margin-lg-140t margin-sm-100t margin-lg-90b margin-sm-50b" data-unique-key="blog-posts" data-start-page="<?php echo esc_attr($paged) ?>" data-max-page="<?php echo esc_attr($total) ?>" data-next-link="<?php echo esc_url(next_posts( 0, false )) ?>">
			<?php if ( have_posts() ): ?>
				<div class="row prague-blog-grif-outer js-load-more-block">
					<?php while ( have_posts() ): the_post(); ?>
						<div <?php post_class(); ?>>
							
							<div class="prague-blog-grid-wrapper">
								
								<?php if (!function_exists( 'cs_framework_init' ) ): ?>
									<?php the_post_thumbnail( 'large' ); ?>
								<?php else: ?>

									<?php if (has_post_thumbnail()): ?>
									<div class="blog-grid-img">
										<?php the_post_thumbnail( 'large', array('class'=>'s-img-switch') ); ?>
									</div>
									<?php endif; ?>
								<?php endif; ?>

								<div class="blog-grid-content">
									<div class="blog-grid-post-date">
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

									<?php the_title('<h3 class="blog-grid-post-title"><a href="' . esc_url( get_the_permalink() ) . '">','</a></h3>'); ?>
									
									<?php if ( get_the_excerpt() ) : ?>
									<div class="blog-grid-post-excerpt">
										<?php the_excerpt(); ?>
									</div>
									<?php endif; ?>
									
									<?php if ( !function_exists( 'cs_framework_init' )  || cs_get_option('post_info') ) : ?>
									<div class="blog-grid-post-info">
										<div class="blog-grid-post-category"><?php the_category(', '); ?></div>
										<div class="blog-grid-post-tags"><?php the_tags(' '); ?></div>
									</div>
									<?php endif;  ?>


									<a href="<?php the_permalink(); ?>" class="blog-grid-link a-btn-arrow-2">
										<span class="arrow-right"></span>
										<?php esc_html_e('READ MORE', 'prague'); ?>
									</a>

								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
				<?php if ( cs_get_option('enable_load_more') && $total >= 2 ) { ?>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <button class="coming-btn a-btn-2 creative js-load-more-btn">
                                <span class="a-btn-line"></span>
                                <?php esc_html_e( 'load more', 'prague' ); ?>
                            </button>
                        </div>
                    </div>
                <?php } else { ?>
					<div class="prague-pager">
						<?php echo wp_kses_post( $paginate_links ); ?>
					</div>
				<?php } ?>

			<?php else: ?>
				<div id="prague-empty-result">
					<p><?php esc_html_e('Sorry, no posts matched your criteria.', 'prague' ); ?></p>
					<?php get_search_form( true ); ?>
				</div>
			<?php endif; ?>

		</div>
		<?php if ($sidebar_enable && is_active_sidebar('sidebar')): ?>
		<div class="col-md-3 margin-lg-140t margin-sm-50t margin-lg-140b margin-sm-50b">
			<div class="prague-sidebar">
				<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('sidebar') ); ?>
			</div>
		</div>
		<?php endif ?>
	</div>
</div>
<?php get_footer();
