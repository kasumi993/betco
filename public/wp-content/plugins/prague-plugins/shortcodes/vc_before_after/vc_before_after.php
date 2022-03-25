<?php
/*
 * Before/After Project Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */
if (function_exists('vc_map')) {
    vc_map(
        array(
            'name' => esc_html__('Before/After Project', 'js_composer'),
            'base' => 'vc_before_after',
            'content_element' => true,
            'show_settings_on_create' => true,
            'description' => esc_html__('', 'js_composer'),
            'params' => array(
                array (
                    'param_name' => 'before_image',
                    'type' => 'attach_image',
                    'description' => '',
                    'heading' => 'Image Before',
                    'value' => '',
                ),
                array (
                    'param_name' => 'after_image',
                    'type' => 'attach_image',
                    'description' => '',
                    'heading' => 'Image After',
                    'value' => '',
                ),
                array (
                    'param_name' => 'before_style',
                    'type' => 'dropdown',
                    'description' => '',
                    'heading' => 'Style',
                    'value' => array ( 
                        esc_html__( 'Fullheight', 'js_composer' ) => 'fullheight',
                        esc_html__( 'Original', 'js_composer' ) => 'original',
                    ),
                ), 
                array (
                    'param_name' => 'before_after_text',
                    'type' => 'checkbox',
                    'description' => '',
                    'heading' => 'Change Before & After Button Text',
                    'value' => '',
                ),

                array (
                    'param_name' => 'before_btn_text',
                    'type' => 'textfield',
                    'description' => '',
                    'heading' => 'Before Button Text',
                    'value' => '',
                    'dependency'  => array('element' => 'before_after_text', 'value' => 'true'),
                ),

                array (
                    'param_name' => 'after_btn_text',
                    'type' => 'textfield',
                    'description' => '',
                    'heading' => 'After Button Text',
                    'value' => '',
                    'dependency'  => array('element' => 'before_after_text', 'value' => 'true'),
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

    class WPBakeryShortCode_vc_before_after extends WPBakeryShortCode
    {
        protected function content($atts, $content = null)
        {
            /* get all params */
            extract(shortcode_atts(array(
                'before_image' => '',
                'after_image' => '',
                'before_style' => 'fullheight',
                'before_after_text' => '',
                'before_btn_text' => '',
                'after_btn_text' => '',
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

            $arrows = ( ! empty( $arrows ) && $arrows === 'on' ) ? 1 : 0;

            $before_btn_text = ( isset($before_after_text) && $before_after_text == 'true' && !empty($before_btn_text) ) ? $before_btn_text : esc_html__('BEFORE', 'prague');
            $after_btn_text = ( isset($before_after_text) && $before_after_text == 'true' && !empty($after_btn_text) ) ? $after_btn_text : esc_html__('AFTER', 'prague');
            $before_style_class = ( ! empty( $before_style ) && $before_style == 'fullheight' ) ? 'fullheight' : 'original';
            $before_img_class = ( ! empty( $before_style ) && $before_style == 'fullheight' ) ? 's-img-switch' : '';
            // start output
            ob_start(); ?>


            <?php if (!empty($before_image) && !empty($after_image)): ?>
                <div class="project-detail-before <?php echo esc_attr($wrap_class); ?>">
                    <div class="projects-detail-before-banner <?php echo esc_attr($before_style_class); ?>">
                        <div class="ba-slider">
                            <?php if (!empty($before_image)): ?>
                                <?php echo wp_get_attachment_image( $before_image, 'full', '', array('class'=> $before_img_class) ); ?>
                            <?php endif ?>

                            <?php if (!empty($after_image)): ?>
                                <div class="resize">
                                    <?php echo wp_get_attachment_image( $after_image, 'full', '', array('class'=> $before_img_class) ); ?>
                                </div>
                            <?php endif ?>
                            <span class="handle"></span>
                            <a href="#" class="button prev"><?php echo esc_html( $before_btn_text ); ?></a>
                            <a href="#" class="button next"><?php echo esc_html( $after_btn_text ); ?></a>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <?php
            // end output
            return ob_get_clean();
        }
    }
}
