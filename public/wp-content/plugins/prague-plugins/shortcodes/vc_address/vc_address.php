<?php
/*
 * Address Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0 
 */
if (function_exists('vc_map')) {
  vc_map( 
    array(
      'name'            => esc_html__( 'Address', 'js_composer' ),
      'base'            => 'vc_address',
      'content_element'     => true,
      'show_settings_on_create' => true,
      'description'       => esc_html__( '', 'js_composer'),
      'params'          => array ( 
        array (
          'param_name' => 'image',
          'type' => 'attach_image',
          'description' => '',
          'heading' => 'Image hover',
          'value' => '', 
        ), 
        array (
          'param_name' => 'title',
          'type' => 'textfield',
          'description' => '',
          'heading' => 'Title',
          'value' => '',
        ), 
        array (
          'param_name' => 'separator',
          'type' => 'checkbox',
          'description' => '',
          'heading' => 'Show separator',
          'value' => '',
        ),
        array (
          'param_name' => 'content',
          'type' => 'textarea_html',
          'description' => '',
          'heading' => 'Description',
          'value' => '',
        ), 
        array (
          'param_name' => 'enable_animated',
          'type' => 'checkbox',
          'description' => '',
          'heading' => 'Enable animate',
          'enable_animated' => '',
          'value' => '',
        ), 
        array (
          'type' => 'textfield',
          'heading' => 'Extra class name',
          'param_name' => 'el_class',
          'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.',
          'value' => '',
        ), 
        array (
          'type' => 'css_editor',
          'heading' => 'CSS box',
          'param_name' => 'css',
          'group' => 'Design options',
        ),
)
      //end params
    ) 
  );
}
if (class_exists('WPBakeryShortCode')) {
  /* Frontend Output Shortcode */
  class WPBakeryShortCode_vc_address extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
      /* get all params */
      extract( shortcode_atts( array(
            'columns' => '',
            'image' => '',
            'title' => '',
            'separator' => '',
            'enable_animated' => '',
            'el_class'  => '',
            'css' => '',
      
      ), $atts ) );

      $css_classes = array(
        $this->getExtraClass( $el_class )
      );
      $wrap_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );

      /* get custum css as class*/
      $wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );
      
      // start output
      ob_start(); ?>
      <div class="adddress-block <?php echo esc_attr( $wrap_class ); ?> <?php if(!empty($enable_animated)) : ?>enable_anima<?php endif; ?>">
          <?php if(!empty($image)) { ?>
            <?php 
            $image_src = wp_get_attachment_image_src( $image, 'full' );
            $image_src = is_array($image_src) ? $image_src[0] : $image_src; ?>
            <img src="<?php echo esc_url($image_src );?>"  alt="<?php echo get_post_meta( $image, '_wp_attachment_image_alt', true); ?>" class="s-img-switch">
          <?php } ?>

          <div class="address-block-outer">
            <?php if (!empty($separator)){ ?>
            <span class="separator"></span>
            <?php } ?>
            
            <?php if (!empty($title)) { ?>
            <h4 class="address-title"><?php echo esc_html($title); ?></h4>
            
            <?php } ?>

            <?php if (!empty($content)) { 
              echo wpautop( wp_kses_post( $content ) );
            } ?>
          </div>
      </div>
      <?php
      // end output
      return ob_get_clean();
    }
  }
}
