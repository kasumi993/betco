<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php post_class(); ?>>

  <div class="product-list-image">
  
    <?php
      if ( $product->is_on_sale() ) :
          echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale', 'trill' ) . '</span>', $post, $product );
      endif;

      // Image product
      if ( has_post_thumbnail() ) { ?>
        <img class="s-img-switch" src="<?php echo get_the_post_thumbnail_url( $post->ID ); ?>" alt="">
        <?php } elseif ( wc_placeholder_img_src() ) {
          echo wc_placeholder_img( $size );
        } ?>
        
      <div class="product-link-wrapp">
        <?php woocommerce_template_loop_add_to_cart(); ?>
      </div>
  </div>
	
   <h4 class="product-list-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

	<!-- Stars product item -->
  <?php if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' ) { ?>
      <?php if ( $rating_count > 0 ) : ?>
          <div class="product-list-rating stars stars-example-css">
              <div class="css-stars">
              <?php 
                  $rating = '';
                  for ( $i = 0; $i < 5; $i++ ) { 
                      if( $i < $average ) {
                          $diff = $average - $i;
                          if( $diff > 0 && $diff < 1 ) {
                              $star_class = 'half';
                          } else {
                              $star_class = 'full';
                          }
                      } else {
                          $star_class = 'empty';
                      }
                      $rating .= '<span class="star ' . esc_attr( $star_class ) . '"></span>';
                  }
                  echo wp_kses_post( $rating );
              ?>
              </div>
          </div>
      <?php endif; ?>
  <?php } ?>

	<?php
	 woocommerce_template_loop_price();

	?>
</li>
