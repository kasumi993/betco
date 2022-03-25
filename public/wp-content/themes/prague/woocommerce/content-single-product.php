<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
// Show/Hide sidebar
$show_sidebar = cs_get_option( 'show_shop_sidebar');
$size_column  = ( isset( $show_sidebar ) && $show_sidebar ) ? 'col-md-9' : 'col-md-12';

get_header( 'shop' ); ?>

<div class="col-sm-12 <?php echo esc_attr( $size_column ); ?> margin-lg-90b margin-sm-60b">

<!-- <?php woocommerce_breadcrumb(); ?> -->

	<?php
		/**
		 * woocommerce_before_single_product hook.
		 *
		 * @hooked wc_print_notices - 10
		 */
		 do_action( 'woocommerce_before_single_product' );

		 if ( post_password_required() ) {
		 	echo get_the_password_form();
		 	return;
		 }
	?>

	<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
			/**
			 * woocommerce_before_single_product_summary hook.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>

		<div class="summary entry-summary">

			<?php
				/**
				 * woocommerce_single_product_summary hook.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
			
				woocommerce_output_product_data_tabs();

			?>

		</div><!-- .summary -->

		<?php
			/**
			 * woocommerce_after_single_product_summary hook.
			 *
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			woocommerce_upsell_display();
			woocommerce_output_related_products();
		?>

	</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
	</div>

	<?php
			/**
			 * woocommerce_sidebar hook.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */

			if( is_active_sidebar('shop-sidebar') && isset( $show_sidebar ) && $show_sidebar ) : ?>
				<div class="col-sm-12 col-md-3 margin-lg-140b margin-sm-50b">
					<div class="prague-sidebar">
						<?php dynamic_sidebar('shop-sidebar'); ?>
					</div>
				</div>	
			<?php endif;
		
		?>