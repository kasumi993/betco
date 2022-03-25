<?php
/**
 * Header template.
 *
 * @package prague
 * @since 1.0.0
 *
 */

global $prague_body_class;

$header_color = cs_get_option('prague_header_color');
$header_style_top = cs_get_option('prague_header_style');
$header_sticky = cs_get_option('sticky_menu') && cs_get_option('prague_header_style') == 'simple' ? ' sticky-menu' : '';
$header_sticky_mobile = cs_get_option('sticky_mobile_menu') && cs_get_option('sticky_menu') && cs_get_option('prague_header_style') == 'simple' ? ' sticky-mobile-menu' : '';
// if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) {

// } else {

// }

if ( is_home() ) {
    $page_id = get_option('page_for_posts');
} elseif ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_shop() ) {
    $page_id = wc_get_page_id('shop');
} elseif ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_cart() ) {
    $page_id = wc_get_page_id('cart');
} elseif ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_checkout() ) {
    $page_id = wc_get_page_id('checkout');
} else {
    $page_id = get_the_ID();
}

$prague_post_options = get_post_meta( $page_id, 'prague_post_options', true );
$service_post_options = get_post_meta( $page_id, 'service_post_options', true );

if ( !empty($prague_post_options['header_color']) ) {
	$header_color = $prague_post_options['header_color'];
}

if ( !empty($prague_post_options['header_style']) ) {
	$header_style_top = $prague_post_options['header_style'];
}

if ( !empty($prague_post_options['style_header']) ) {
	$header_style = $prague_post_options['style_header'];
}

if ( !empty($service_post_options['header_color']) && get_post_type() == 'services' ) {
	$header_color = $service_post_options['header_color'];
}

if ( !empty($service_post_options['style_header']) && get_post_type() == 'services' ) {
	$header_style = $prague_post_options['style_header'];
}

$bottom_menu = ($prague_post_options['bottom_menu']) ? ' bottom_menu' : '';
$easy_style = ($prague_post_options['easy_style']) ? ' easy_style' : '';

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telephone=no" />
		<?php wp_head(); ?>

  </head>
<body <?php body_class(); ?> data-scrollbar="">

	<?php if ( cs_get_option('page_preloader') ): ?>
		<div class="prague-loader">
			<div class="prague-loader-wrapper">

				<?php
				if( cs_get_option('page_preloader_type') == 'image' && cs_get_option( 'preloader_image' )) {
                    $image_src = wp_get_attachment_image_url( cs_get_option( 'preloader_image' ), 'full', false ); ?>
                    <div class="prague-loader-img">
					    <img src="<?php echo esc_url($image_src); ?>" alt="" class="s-loader-switch" data-s-hidden="1">
                    </div>
				<?php }elseif(cs_get_option('page_preloader_type') == 'text' && cs_get_option( 'preloader_text' )){ ?>
                    <div class="prague-loader-bar">
					    <?php echo esc_html(cs_get_option( 'preloader_text' )); ?>
                    </div>
				<?php }else{ ?>
                    <div class="prague-loader-bar">
					    <?php esc_html_e('PRAGUE', 'prague'); ?>
                    </div>
				<?php } ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<header class="prague-header <?php echo esc_attr( $header_sticky . $header_sticky_mobile); ?> <?php echo esc_attr($header_color) ?> <?php echo esc_attr($header_style) ?> <?php echo esc_attr($easy_style) ?> <?php echo esc_attr($header_style_top) ?>">


        <?php if ( $header_style_top == 'full' || $header_style_top == 'simple' ) : ?>

            <div class="prague-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php prague_logo(); ?>
                </a>
            </div>

            <div class="prague-header-wrapper">

                <div class="prague-navigation">
                    <div class="pargue-navigation-wrapper">
                        <div class="prague-navigation-inner">

                            <?php if ($header_style_top == 'full'): ?>
                            <div class="prague-header-form">

                                <?php echo wp_get_attachment_image( cs_get_option('main_header_image'), 'large', '', array('class'=>'s-img-switch') ); ; ?>

                                <div class="prague-footer-info-block">

                                    <?php if (cs_get_option('main_title')): ?>
                                    <h6 class="footer-info-block-title"><?php echo esc_html( cs_get_option('main_title') ); ?></h6>
                                    <?php endif ?>

                                    <?php if (cs_get_option('main_content')): ?>
                                    <div class="footer-info-block-content">
                                        <?php echo wp_kses_post( wpautop(do_shortcode( cs_get_option('main_content') )) ); ?>
                                    </div>
                                    <?php endif ?>

                                    <?php
                                    if ( cs_get_option('prague_header_social' ) ) {
                                        prague_social_nav( cs_get_option('prague_header_social') );
                                    } ?>

                                </div>
                                <?php if ( cs_get_option('prague_header_form') ): ?>
                                <div class="prague-formidable  vc_formidable">
                                    <?php echo do_shortcode( '[formidable id=' . cs_get_option('prague_header_form') . ']' ); ?>
                                </div>
                                <?php endif ?>
                            </div>
                            <?php endif ?>

                            <nav>
                                <?php prague_custom_menu(); ?>
                            </nav>

                        </div>
                    </div>
                </div>

                <?php prague_render_filter(); ?>

                <!-- mobile icon -->
                <div class="prague-nav-menu-icon">
                    <a href="#">
                        <i></i>
                    </a>
                </div>


                <?php
                // render social icons
                if ( cs_get_option('prague_header_social' ) && $header_style_top == 'simple') {
                    prague_social_nav( cs_get_option('prague_header_social'),'simple' );
                } ?>

            </div>

        <?php endif;?>


		<?php if ( $header_style_top == 'left' ) : ?>

            <a href="#" class="aside-nav">
                <span class="aside-nav-line line-1"></span>
                <span class="aside-nav-line line-2"></span>
                <span class="aside-nav-line line-3"></span>
            </a>

            <div class="prague-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php prague_logo(); ?>
                </a>
            </div>

            <nav id="topmenu" class="topmenu">
	            <?php prague_custom_menu(); ?>
	            <?php prague_social_nav( cs_get_option('prague_header_social'),'simple' ); ?>
            </nav>
<!---->
<!--            <div class="prague-header-wrapper">-->
<!---->
<!--                <div class="prague-navigation">-->
<!--                    <div class="pargue-navigation-wrapper">-->
<!--                        <div class="prague-navigation-inner">-->
<!---->
<!--							--><?php //if ($header_style_top == 'full'): ?>
<!--                                <div class="prague-header-form">-->
<!---->
<!--									--><?php //echo wp_get_attachment_image( cs_get_option('main_header_image'), 'large', '', array('class'=>'s-img-switch') ); ; ?>
<!---->
<!--                                    <div class="prague-footer-info-block">-->
<!---->
<!--										--><?php //if (cs_get_option('main_title')): ?>
<!--                                            <h6 class="footer-info-block-title">--><?php //echo esc_html( cs_get_option('main_title') ); ?><!--</h6>-->
<!--										--><?php //endif ?>
<!---->
<!--										--><?php //if (cs_get_option('main_content')): ?>
<!--                                            <div class="footer-info-block-content">-->
<!--												--><?php //echo wp_kses_post( wpautop(do_shortcode( cs_get_option('main_content') )) ); ?>
<!--                                            </div>-->
<!--										--><?php //endif ?>
<!---->
<!--										--><?php
//										if ( cs_get_option('prague_header_social' ) ) {
//											prague_social_nav( cs_get_option('prague_header_social') );
//										} ?>
<!---->
<!--                                    </div>-->
<!--									--><?php //if ( cs_get_option('prague_header_form') ): ?>
<!--                                        <div class="prague-formidable  vc_formidable">-->
<!--											--><?php //echo do_shortcode( '[formidable id=' . cs_get_option('prague_header_form') . ']' ); ?>
<!--                                        </div>-->
<!--									--><?php //endif ?>
<!--                                </div>-->
<!--							--><?php //endif ?>
<!---->
<!--                            <nav>-->
<!--								--><?php //prague_custom_menu(); ?>
<!--                            </nav>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--				--><?php //prague_render_filter(); ?>
<!---->
<!--                <div class="prague-nav-menu-icon">-->
<!--                    <a href="#">-->
<!--                        <i></i>-->
<!--                    </a>-->
<!--                </div>-->
<!---->
<!---->
<!--				--><?php
//				// render social icons
//				if ( cs_get_option('prague_header_social' ) && $header_style_top == 'simple') {
//					prague_social_nav( cs_get_option('prague_header_social'),'simple' );
//				} ?>
<!---->
<!--            </div>-->

		<?php endif;?>

	</header>
	<!-- END HEADER -->
