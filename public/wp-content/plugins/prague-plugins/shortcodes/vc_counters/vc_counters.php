<?php
/*
 * Counters Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0 
 */
if (function_exists('vc_map')) {
	vc_map( 
		array(
			'name'						=> esc_html__( 'Counters', 'js_composer' ),
			'base'						=> 'vc_counters',
			'content_element'			=> true,
			'show_settings_on_create'	=> true,
			'description'				=> esc_html__( '', 'js_composer'),
			'params'					=> array ( 
          array (
            'param_name' => 'image_background',
            'type' => 'attach_image',
            'description' => '',
            'heading' => 'Image Background',
            'value' => '',
          ), 
          array (
            'param_name' => 'border_size',
            'type' => 'textfield',
            'description' => "Enter a value in 'px'",
            'heading' => 'Border Size',
            'value' => '',
          ), 
          array (
            'param_name' => 'numbers',
            'type' => 'param_group',
            'description' => '',
            'heading' => 'Numbers',
            'params' => array(

                array(
                    'param_name'  => 'number',
                    'type'        => 'textfield',
                    'description' => '',
                    'heading'     => 'Number',
                    'value'       => '',
                ),

                array(
                    'param_name'  => 'title',
                    'type'        => 'textfield',
                    'description' => '',
                    'heading'     => 'Title',
                    'value'       => '',
                ),

            ),
          ), 
          array (
            'param_name' => 'figure',
            'type' => 'dropdown',
            'description' => '',
            'heading' => 'Figure',
            'value' => array ( 
                  esc_html__('None','js_composer') => '', 
                  esc_html__('Triangle','js_composer') => 'triangle', 
                  esc_html__('Circle','js_composer') => 'circle', 
                  esc_html__('Square','js_composer') => 'square', 
                  esc_html__('Oxagon','js_composer') => 'oxagon',
            ),
          ), 
          array (
            'param_name' => 'color_figure',
            'type' => 'colorpicker',
            'description' => '',
            'heading' => 'Color Figure',
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
	class WPBakeryShortCode_vc_counters extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
						'image_background'	=> '',
						'border_size'	=> '',
						'numbers'	=> '',
						'figure'	=> '',
						'color_figure'	=> '',
						'el_class'	=> '',
						'css'	=> '',
			
			), $atts ) );
			
      $css_classes = array(
        $this->getExtraClass( $el_class )
      );
      $wrap_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );
      /* get custum css as class*/
      $wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );
      $wrap_class .= !empty( $el_class ) ? ' ' . $el_class : '';

      $border_size_attr = '';
      if (!empty($border_size)) {
        $border_size_attr  = ' style="padding:' . esc_attr( $border_size ) . ';"';
      }


      $color_figure_attr = '';
      if (!empty($color_figure)) {
        $color_figure_attr = ' style="fill:' . $color_figure . '"';
      } 

      $figures = array(
          'triangle' => '0 200, 0 0, 200,0', // triangle
          'square' => '0,0 200,0 200,200 0,200', // square
          'oxagon' => '100,0 180,30 200,100 180,180 100,200 30,180 0,100 30,30', // oxagon
      );

      $numbers_array = ''; 
      if(!empty($numbers)){
        $numbers_array = json_decode(urldecode($numbers)); 
        $wrap_class .= count($numbers_array) > 1 ? ' multi_item' : ' alone_item'; 
      }

      if ( empty($figure) ) {
        $wrap_class .= ' no-figure';
      }
			
			// start output
			ob_start(); ?>
				<div class="prague-counter <?php echo esc_attr( $wrap_class ); ?>">

          <div class="figures <?php echo esc_attr($figure); ?>">
             <!-- triangle -->
             <?php if (!empty($figure)): ?>
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"
                preserveAspectRatio="xMidYMid meet" >
                  <?php if ($figure == 'circle'): ?>
                    <circle cx="100" cy="100" r="100" <?php echo $color_figure_attr; ?> />
                  <?php else: ?>
                    <polygon points="<?php echo esc_attr( $figures[$figure] ); ?>" <?php echo $color_figure_attr; ?> />
                  <?php endif ?>
             </svg>
             <?php endif ?>
          </div>

            <div class="counter-outer" <?php echo $border_size_attr; ?>>

              <?php if(!empty($image_background)): ?>
                <?php
                $image_src = wp_get_attachment_image_src( $image_background, 'full' );
                $image_src = is_array($image_src) ? $image_src[0] : $image_src; ?>
                <img src="<?php echo esc_url($image_src );?>"  alt="<?php echo get_post_meta( $image_background, '_wp_attachment_image_alt', true); ?>" class="prague-counter-img s-img-switch">
              <?php endif; ?>
          
              <?php if(!empty($numbers_array)): ?>
              <?php 
              $position = array();
               ?>
              <div class="numbers">
                  <?php 

                  $quadro_numbers = array_chunk($numbers_array, 4);
                  $it = 0;
                  foreach ($quadro_numbers as $key_parent => $array) {
                      foreach ($array as $key => $number) :
                
                      if ($key%2 == 0) {
                        $position['number']['x'] = "52%";
                        $position['title']['x'] = "54%";
                      } else  {
                        $position['number']['x'] = "46%";
                        $position['title']['x'] = "46%";
                      }

                      // for y
                      if ( ($key != 0 ) && ($key%2 == 0 || $key%3 == 0)){
                        $position['number']['y'] = "35%";
                        $position['title']['y'] = "68%";
                      } else {
                        $position['number']['y'] = "47%";
                        $position['title']['y'] = "80%";
                      } 

                      // for one ele
                      if (count($numbers_array) == 1) {
                        $position = array(
                          'number' => array('x'=>'50%','y'=>'45%'),
                          'title' => array('x'=>'50%','y'=>'70%')
                        );
                      }

                      ?>
                      <svg>
                        <defs>
                          <mask id="coming_mask_<?php echo esc_attr( $it ); ?>" x="0" y="0">
                            <rect class="coming-alpha" x="0" y="0" width="100%" height="100%"></rect>
                            <?php if (!empty($number->number)) : ?>
                            <text class="count number" x="<?php echo esc_attr( $position['number']['x'] ); ?>" y="<?php echo esc_attr( $position['number']['y'] ); ?>" text-anchor="middle" alignment-baseline="middle"><?php echo esc_html($number->number); ?></text>
                            <?php endif; ?>
                            <?php if (!empty($number->title)) : ?>
                            <text class="count title" x="<?php echo esc_attr( $position['title']['x'] ); ?>" y="<?php echo esc_attr( $position['title']['y'] ); ?>" text-anchor="middle" alignment-baseline="middle" ><?php echo esc_html($number->title); ?></text>
                            <?php endif; ?>
                          </mask>
                        </defs>
                        <rect style="-webkit-mask: url(#coming_mask_<?php echo esc_attr( $it ); ?>); mask: url(#coming_mask_<?php echo esc_attr( $it ); ?>);" class="base" x="0" y="0" width="100%" height="100%"></rect>
                      </svg>
                      <?php 
                      $it++;
                      endforeach; ?>

                  <?php } ?>

                  <?php if (count($numbers_array) > 1 && count($numbers_array)%2 == 1) : ?>
                    <svg>
                    <defs>
                    <mask id="coming_mask_888" x="0" y="0">
                    <rect class="coming-alpha" x="0" y="0" width="100%" height="100%"></rect>
                    </mask>
                    </defs>
                    <rect class="base" x="0" y="0"></rect>
                    </svg>
                  <?php endif; ?>
              </div>
              <?php endif; ?>

            </div>
        </div>
			<?php
			// end output
			return ob_get_clean();
		}
	}
}
