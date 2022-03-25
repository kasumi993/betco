<?php
/**
 * Comment template
 *
 * @package prague
 * @since 1.0.0
 *
 */

if ( post_password_required() ) { return; } ?>
<div class="row">
	<?php if ( have_comments() || get_comments_number() ) : ?>
	
	<div class="col-xs-12">
		<section class="heading  left dark">
			<div class="subtitle divider"><?php esc_html_e('COMMENTS', 'prague'); ?></div>
			<h2 class="title"><?php esc_html_e('Just say Your opinion.', 'prague'); ?></h2>
		</section>
	</div>

	<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
		<div class="prague-comments-list" id="comments">
			<ul><?php wp_list_comments( array( 'callback' => 'prague_comment' ) ); ?></ul>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
					<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'prague' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'prague' ) ); ?></div>
				</nav>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
	<?php 
	$class_wrapper_list_comments = 'col-lg-4 col-md-12 col-sm-12 col-xs-12';
	if ( !have_comments() ) {
		$class_wrapper_list_comments = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
	} 

	if ( !function_exists( 'cs_framework_init' ) ){
		$class_wrapper_list_comments = 'col-xs-12';
	}

	?>
	<div class="<?php echo esc_attr( $class_wrapper_list_comments ); ?>">
		<h6 class="prague-comments-form-title"><?php esc_html_e( 'YOUR COMMENT', 'prague' ); ?></h6>
		<?php comment_form(
			array(
				'id_form'              => 'prague-comment-form',
				'fields'               => array(
					'author'            => '<input name="author"  type="text"  placeholder="'. esc_attr__( 'Name', 'prague') .'" required />',
					'email'             => '<input name="email"   type="email" placeholder="'. esc_attr__( 'Mail', 'prague') .'" required />',
				),
				'comment_field'        => '<textarea cols="30"  name="comment" rows="10" placeholder="'. esc_attr__( 'Comment', 'prague') .'" required></textarea>',
				'must_log_in'          => '',
				'logged_in_as'         => '',
				'comment_notes_before' => '',
				'comment_notes_after'  => '',
				'title_reply'          => '',
				'title_reply_to'       => esc_html__('Leave a Reply to %s', 'prague' ),
				'cancel_reply_link'    => esc_html__('Cancel', 'prague' ),
				'label_submit'         => esc_html__('LEAVE COMMENT', 'prague' ),
				'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s-btn" value="%4$s" />',
				'submit_field'         => '%1$s %2$s',
			)
		); ?>
	</div>
</div>