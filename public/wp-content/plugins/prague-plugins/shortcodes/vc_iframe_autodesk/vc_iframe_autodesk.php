<?php
/*
 * Iframe Autodesk Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */
if (function_exists('vc_map')) {
    vc_map(
        array(
            'name' => esc_html__('Iframe Autodesk', 'js_composer'),
            'base' => 'vc_iframe_autodesk',
            'content_element' => true,
            'show_settings_on_create' => true,
            'description' => esc_html__('', 'js_composer'),
            'params' => array(
                array(
                    'type' => 'textarea_html',
                    'heading' => __('Iframe for 3d', 'js_composer'),
                    'param_name' => 'content',
                    'sanitize' => false,
                    'default' => '',
                    'description' => esc_html__('Insert iframe from https://myhub.autodesk360.com', 'js_composer'),
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

    class WPBakeryShortCode_vc_iframe_autodesk extends WPBakeryShortCode
    {
        protected function content($atts, $content = null)
        {
            /* get all params */
            extract(shortcode_atts(array(
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


            <?php if (!empty($content)): ?>
                <div class="project-detail-slider-outer">
                    <div class="project-details-slider-3d <?php echo esc_attr($wrap_class); ?>">
                        <?php echo wp_kses( $content , array( 'iframe' =>
                        // enable attributes
                            array(
                                'src'             => array(),
                                'height'          => array(),
                                'width'           => array(),
                                'frameborder'     => array(),
                                'allowfullscreen' => array(),
                            )) ); ?>
                    </div>
                </div>
            <?php endif ?>

            <?php
            // end output
            return ob_get_clean();
        }
    }
}
