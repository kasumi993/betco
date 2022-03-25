<?php
/*
 * Columns Gallery Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */
if (function_exists('vc_map')) {
    vc_map(
        array(
            'name' => esc_html__('Columns Gallery', 'js_composer'),
            'base' => 'vc_columns_gallery',
            'content_element' => true,
            'show_settings_on_create' => true,
            'description' => esc_html__('', 'js_composer'),
            'params' => array(
                array (
                    'param_name' => 'images',
                    'type' => 'attach_images',
                    'heading' => 'Images',
                    'value' => '',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => 'Extra class name',
                    'param_name' => 'el_class',
                    'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.',
                    'value' => '',
                ),
                array(
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

    class WPBakeryShortCode_vc_columns_gallery extends WPBakeryShortCode
    {
        protected function content($atts, $content = null)
        {
            /* get all params */
            extract(shortcode_atts(array(
                'images' => '',
                'el_class' => '',
                'css' => '',

            ), $atts));

            $css_classes = array(
                $this->getExtraClass($el_class)
            );
            $wrap_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode(' ', array_filter($css_classes)), $this->settings['base'], $atts);

            /* get param class */
            $wrap_class = !empty($el_class) ? $el_class : '';
            /* get custum css as class*/
            $wrap_class .= vc_shortcode_custom_css_class($css, ' ');

            // start output
            ob_start(); ?>
            
            <?php if (!empty($images)): ?>
                <div class="project-detail-gallery-outer">
                    <div class="project-detail-gallery-wrapper">
    
                        <?php
                        $images = explode(',', $images);
                        foreach ($images as $image_id) :
    
                            $image_data = wp_get_attachment_image_src( $image_id, 'full' );
    
                            if (!empty($image_data) && is_array($image_data)) :
    
                                // calculate ratio

                                if($image_data[2] ){
                                    $ratio =  $image_data[1] / $image_data[2];
                                }

                                $class_size = "full-width";
                                if ($ratio < 1) {
                                    $class_size = 'full-height';
                                }
    
                                $url = is_array($image_data) ? $image_data[0] : $image_data;
                                $attachment = get_post( $image_id );
                                ?>
                                <div class="detail-gallery-item-wrapp <?php echo esc_attr( $class_size ); ?>">
                                    <div class="detail-gallery-item">
                                <span class="detail-gallery-item-img">
                                    <img src="<?php echo esc_url( $url ); ?>">
                                    <div class="detail-gallery-item-overlay">
                                        <div class="vertical-align">
                                        <?php if (!empty($attachment->post_excerpt)): ?>
                                            <h4 class="detail-gallery-item-caption">
                                                <?php echo esc_html( $attachment->post_excerpt ); ?>
                                            </h4>
                                        <?php endif ?>
                                        </div>
                                    </div>
                                </span>
                                    </div>
                                </div>
                                <?php
    
                            endif;
    
                        endforeach; ?>
    
                    </div>
            </div>
            <?php endif; ?>


            <?php
            // end output
            return ob_get_clean();
        }
    }
}
