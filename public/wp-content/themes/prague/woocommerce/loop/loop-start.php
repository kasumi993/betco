<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
 * @version     3.3.0
 */

$products_per_row = 'columns-4';

if ( function_exists( 'cs_framework_init' ) ) {
  $products_per_row = cs_get_option('products_per_row');
  $products_per_row = ( isset( $products_per_row ) && $products_per_row == 'columns-4' ) ? 'columns-4' : $products_per_row;
} ?>

<ul class="products row <?php echo esc_attr( $products_per_row ); ?>">
