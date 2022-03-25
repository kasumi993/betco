<?php 

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * CSFramework Taxonomy Config
 *
 * @since 1.0
 * @version 1.0
 *
 */
$options      = array();

$post_types = array_diff( get_post_types(), array(
  'revision',
  'attachment',
  'nav_menu_item',
  'booked_appointments',
  'page',
  'wpcf7_contact_form',
  'vc4_templates',
  'customize_changeset',
  'custom_css',
  'frm_styles',
  'frm_form_actions',
  'vc_grid_item',
));


foreach ($post_types as $post_type) {
  $taxonomies = get_taxonomies(array('object_type' => array($post_type) ), 'names','and');
  $options[]   = array(
    'id'       => '_category_options',
    'taxonomy' => array_shift($taxonomies),
    'fields'   => array(

      array(
        'id'    => 'category_image',
        'type'  => 'image',
        'title' => 'Category Image',
      ),


    ),
  );
}


CSFramework_Taxonomy::instance( $options );