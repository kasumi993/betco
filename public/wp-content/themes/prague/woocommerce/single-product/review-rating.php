<?php
/**
 * The template to display the reviewers star rating in reviews
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
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $comment, $product;

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

if ( $rating && get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) { ?>

	<!-- Stars product item -->
  <?php if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' ) { ?>
      <?php if ( $rating_count > 0 ) : ?>
          <div class="product-list-rating stars stars-example-css">
              <div class="css-stars">
              <?php 
                  $rating_star = '';
                  for ( $i = 0; $i < 5; $i++ ) { 
                      if( $i < $rating ) {
                          $diff = $rating - $i;
                          if( $diff > 0 && $diff < 1 ) {
                              $star_class = 'half';
                          } else {
                              $star_class = 'full';
                          }
                      } else {
                          $star_class = 'empty';
                      }
                      $rating_star .= '<span class="star ' . esc_attr( $star_class ) . '"></span>';
                  }
                  echo wp_kses_post( $rating_star );
              ?>
              </div>
          </div>
      <?php endif; ?>
  <?php } ?>

<?php }
