<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

?>
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
              <?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>)</a><?php endif ?>
          </div>
      <?php endif; ?>
  <?php } ?>

