<?php
 
if (function_exists('vc_map')) {

	vc_map( 
		array(
			'name'						=> esc_html__( 'Coming soon', 'js_composer' ),
			'base'						=> 'vc_coming_soon',
			'content_element'			=> true,
			'show_settings_on_create'	=> true,
			'description'				=> esc_html__( '', 'js_composer'),
			'params'					=> array ( 

          array (
            'param_name' => 'img_bg',
            'type' => 'attach_image',
            'description' => '',
            'heading' => 'Image Background',
            'value' => '',
          ), 
          array (
            'param_name' => 'subtitle',
            'type' => 'textfield',
            'description' => '',
            'heading' => 'Subtitle',
            'value' => '',
          ), 
          array (
            'param_name' => 'title',
            'type' => 'textfield',
            'description' => '',
            'heading' => 'Title',
            'value' => '',
          ), 
          array(
              'param_name'  => 'content',
              'type'        => 'textarea_html',
              'description' => '',
              'heading'     => 'Description',
              'value'       => '',
          ),


          array (
            'param_name' => 'date',
            'type' => 'wpc_date',
            'description' => '',
            'heading' => 'Date',
            'value' => '',
          ), 
          

          array (
            'param_name' => 'days',
            'type' => 'textfield',
            'description' => '',
            'heading' => 'Days',
            'value' => '',
            'group' => 'Time label (Desktop)',
          ), 
          array (
            'param_name' => 'hours',
            'type' => 'textfield',
            'description' => '',
            'heading' => 'Hours',
            'value' => '',
            'group' => 'Time label (Desktop)',
          ), 
          array (
            'param_name' => 'minutes',
            'type' => 'textfield',
            'description' => '',
            'heading' => 'Minutes',
            'value' => '',
            'group' => 'Time label (Desktop)',
          ), 
          array (
            'param_name' => 'seconds',
            'type' => 'textfield',
            'description' => '',
            'heading' => 'Seconds',
            'value' => '',
            'group' => 'Time label (Desktop)',
          ), 

          array (
            'param_name' => 'days_mobile',
            'type' => 'textfield',
            'description' => '',
            'heading' => 'Days',
            'value' => '',
            'group' => 'Time label (Mobile)',
          ), 
          array (
            'param_name' => 'hours_mobile',
            'type' => 'textfield',
            'description' => '',
            'heading' => 'Hours',
            'value' => '',
            'group' => 'Time label (Mobile)',
          ), 
          array (
            'param_name' => 'minutes_mobile',
            'type' => 'textfield',
            'description' => '',
            'heading' => 'Minutes',
            'value' => '',
            'group' => 'Time label (Mobile)',
          ), 
          array (
            'param_name' => 'seconds_mobile',
            'type' => 'textfield',
            'description' => '',
            'heading' => 'Seconds',
            'value' => '',
            'group' => 'Time label (Mobile)',
          ),
          array(
              'param_name'  => 'contact_form',
              'type'        => 'textarea',
              'description' => '',
              'heading'     => 'Contact Form',
              'value'       => '',
          ),
          array(
            'type'        => 'param_group',
            'heading'     => __( 'Social Icons', 'js_composer' ),
            'param_name'  => 'socials',
            'value'       => urlencode( json_encode( array(
                array(
                  'title' => __( 'Behance', 'js_composer' ),
                  'icon' => 'fa-behance',
                  'link' => '',
                ),
                array(
                  'title' => __( 'Dribbble', 'js_composer' ),
                  'icon' => 'fa-dribbble',
                  'link' => '',
                ),
                array(
                  'title' => __( 'Facebook', 'js_composer' ),
                  'icon' => 'fa-facebook',
                  'link' => '',
                ),
                array(
                  'title' => __( 'Pinterest', 'js_composer' ),
                  'icon' => 'fa-pinterest-p',
                  'link' => '',
                ),
            ) ) ),
            'params'      => array(
              array(
                'type'        => 'iconpicker',
                'heading'     => __( 'Icon', 'js_composer' ),
                'param_name'  => 'icon',
                'value'       => 'facebook'
              ),
              array(
                'type'        => 'textfield',
                'heading'     => __( 'Link', 'js_composer' ),
                'param_name'  => 'link',
                'value'       => '-'
              ),

            ),
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
      ),
      'admin_enqueue_js' => array(
        esc_url( 'cdn.jsdelivr.net/jquery.ui.timepicker.addon/1.4.5/jquery-ui-timepicker-addon.min.js' ),
      ),
      'admin_enqueue_css' => array(
        esc_url( 'ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' ),
      )
			//end params
		) 
	);
}
if (class_exists('WPBakeryShortCode')) {
	/* Frontend Output Shortcode */
	class WPBakeryShortCode_vc_coming_soon extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
						'title'	=> '',
						'subtitle'	=> '',
						'date'	=> '',
            'days' => '',
            'hours' => '',
            'minutes' => '',
            'seconds' => '',
            'days_mobile' => '',
            'hours_mobile' => '',
            'minutes_mobile' => '',
            'seconds_mobile' => '',
            'img_bg' => '',
						'contact_form'	=> '', 
            'socials'  => '',
						'el_class'	=> '',
						'css'	=> '',
			
			), $atts ) );

      // el class
      $css_classes = array(
        $this->getExtraClass( $el_class )
      );

      $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );

      // custum css
      $css_class .= vc_shortcode_custom_css_class( $css, ' ' );

      // custum class
      $css_class .= ( ! empty( $css_class ) ) ? ' ' . $css_class : '';

			
			// start output
			ob_start(); ?>
      <div class="<?php echo esc_attr( $css_class ); ?> prague-coming-outer page-calculate fullheight">

        <?php
          $img_bg = wp_get_attachment_image_src( $img_bg, 'full' ); 
          $img_bg = is_array($img_bg) ? $img_bg[0] : $img_bg;
        
        if (!empty($img_bg)): ?>
        <img src="<?php echo esc_url( $img_bg ); ?>" class="s-img-switch"> 
        <?php endif ?>
        
        <section class="prague-coming-wrapper page-calculate-content fullheight">
          <div class="prague-coming-content">

                <?php if(!empty($subtitle)) : ?>
                    <div class="coming-subtitle"><?php echo esc_html($subtitle); ?></div>
                <?php endif; ?>

                <?php if(!empty($title)) : ?>
                  <h1 class="coming-title">
                    <?php echo esc_html($title); ?>
                  </h1>
                <?php endif; ?>
                
                <?php if(!empty($content)) : ?>
                  <div class="coming-description">
                    <p><?php echo wp_kses_post( do_shortcode( $content ) ); ?></p>
                  </div>
                <?php endif; ?>

                <ul class="prague-coming-time-wrapper" data-end="<?php echo esc_html($date); ?>">

                    <li class="coming-time-item">
                      <div class="count count-days"></div>
                      <?php if (!empty($days)): ?>
                      <div class="name name-days" data-mobile="<?php echo esc_attr( $days_mobile ); ?>" data-desktop="<?php echo esc_attr($days ); ?>"></div>
                      <?php endif; ?>
                    </li>

                    <li class="coming-time-item">
                      <div class="count count-hours"></div>
                      <?php if (!empty($hours)): ?>
                      <div class="name name-hours" data-mobile="<?php echo esc_attr( $hours_mobile ); ?>" data-desktop="<?php echo esc_attr($hours ); ?>"></div>
                      <?php endif; ?> 
                    </li>

                    <li class="coming-time-item">
                      <div class="count count-mins"></div>
                      <?php if (!empty($minutes)): ?>
                      <div class="name name-mins" data-mobile="<?php echo esc_attr( $minutes_mobile ); ?>" data-desktop="<?php echo esc_attr($minutes ); ?>"></div>
                      <?php endif; ?>  
                    </li>

                    <li class="coming-time-item">
                      <div class="count count-secs"></div>
                      <?php if (!empty($seconds)): ?>
                      <div class="name name-secs" data-mobile="<?php echo esc_attr( $seconds_mobile ); ?>" data-desktop="<?php echo esc_attr($seconds ); ?>"></div>
                      <?php endif ?>    
                    </li>

                </ul>


                <?php if (!empty($contact_form)): ?>
                  <?php echo do_shortcode( $contact_form ); ?>
                <?php endif ?>

                <?php  
                  if (!empty($socials)) :
                  $socials = (array) vc_param_group_parse_atts( $socials ); 
                  if (!empty($socials)) :
                ?>

                <ul class="prague-coming-share">
                  <?php foreach ($socials as $key => $social) : ?>
                    <?php if (!empty($social['link'])): ?>
                      <li>
                        <a href="<?php echo esc_url( $social['link'] ); ?>">
                          <span class="fa <?php echo esc_attr( $social['icon'] ); ?>"></span>
                        </a>
                      </li>
                    <?php endif ?>
                  <?php endforeach;  ?>
                </ul> 

                <?php
                  endif;
                  endif; 
                ?>


          </div>
        </section>

      </div>
			<?php
			// end output
			return ob_get_clean();
		}
	}
}
