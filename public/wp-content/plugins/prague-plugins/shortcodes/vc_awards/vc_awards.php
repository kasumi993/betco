<?php
/*
 * Awards Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0 
 */
if (function_exists('vc_map')) {
	vc_map( 
		array(
			'name'						=> esc_html__( 'Awards', 'js_composer' ),
			'base'						=> 'vc_awards',
			'content_element'			=> true,
			'show_settings_on_create'	=> true,
			'description'				=> esc_html__( '', 'js_composer'),
			'params'					=> array ( 
          array (
            'param_name' => 'list_awards',
            'type' => 'param_group',
            'description' => '',
            'heading' => 'List Awards',
            'params' => array ( 
                  array (
                    'param_name' => 'year',
                    'type' => 'textfield',
                    'description' => '',
                    'heading' => 'Year',
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
                    'param_name' => 'link',
                    'type' => 'textfield',
                    'description' => '',
                    'heading' => 'Title Link',
                    'description' => 'Insert url',
                    'value' => '', 
                  ),
                  array (
                    'param_name' => 'subtitle',
                    'type' => 'textfield',
                    'description' => '',
                    'heading' => 'subtitle',
                    'value' => '', 
                  ), 
                  array (
                    'param_name' => 'separator',
                    'type' => 'checkbox',
                    'description' => '',
                    'heading' => 'Separator',
                    'value' => '', 
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
          )
			//end params
		) 
	);
}
if (class_exists('WPBakeryShortCode')) {
	/* Frontend Output Shortcode */
	class WPBakeryShortCode_vc_awards extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			/* get all params */
			extract( shortcode_atts( array(
						'list_awards'	=> '',
						'el_class'	=> '',
						'css'	=> '',
			
			), $atts ) );
			/* get param class */
			$wrap_class  = !empty( $el_class ) ? $el_class : '';
			/* get custum css as class*/
			$wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );
			
			// start output
			ob_start(); ?>
			<div class="awards-list <?php echo esc_attr( $wrap_class ); ?>">
				<?php if(!empty($list_awards)):
              $awards = json_decode( urldecode( $list_awards ) );
              foreach ($awards as $award): ?>
                  <div class="awards-item">
                    <?php if (!empty($award->year)): ?>
                      <div class="awards-date"><?php echo esc_html($award->year); ?></div>
                    <?php endif; ?>

                    <?php if (!empty($award->separator)): ?>
                      <span class="awards-separator"></span>
                    <?php endif; ?>

                    <?php 
                    $class_info = '';
                    if (empty($award->year)){
                      $class_info = 'only_info';
                    } ?>
                    
                    <div class="awards-info <?php echo esc_attr( $class_info ); ?>">
                      <?php if (!empty($award->link)) { ?>
                        <a class="awards-title-link" href="<?php echo esc_url($award->link) ?>">
                      <?php } ?>

                      <?php if (!empty($award->title)): ?>
                        <h4 class="awards-title"><?php echo esc_html($award->title); ?></h4>
                      <?php endif; ?>

                      <?php if (!empty($award->link)): ?>
                          </a>
                      <?php endif; ?>

                      <?php if (!empty($award->subtitle)): ?>
                          <div class="awards-subtitle"><?php echo esc_html($award->subtitle); ?></div>
                      <?php endif; ?>
                    </div>
                    
                  </div>
              <?php endforeach;
        endif; ?>
			</div>
			<?php 
			// end output
			return ob_get_clean();
		}
	}
}
