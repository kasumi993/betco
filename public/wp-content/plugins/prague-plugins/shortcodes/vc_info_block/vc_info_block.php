<?php
/*
 * Info Block Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */
if (function_exists('vc_map')) {
    vc_map(
        array(
            'name' => esc_html__('Info Block', 'js_composer'),
            'base' => 'vc_info_block',
            'content_element' => true,
            'show_settings_on_create' => true,
            'description' => esc_html__('', 'js_composer'),
            'params' => array(
                array(
                    'param_name' => 'style',
                    'type' => 'dropdown',
                    'description' => '',
                    'heading' => 'Style shortcode',
                    'value' => array(
                        'Vertical' => 'vertical',
                        'Horizontal' => 'horizontal',
                    ),
                ),
                array(
                    'type' => 'param_group',
                    'heading' => __('Info item', 'js_composer'),
                    'param_name' => 'items',
                    'value' => urlencode(json_encode(array())),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => __('Label', 'js_composer'),
                            'param_name' => 'label'
                        ),
                        array(
                            'type' => 'textarea',
                            'heading' => __('Text', 'js_composer'),
                            'param_name' => 'text'
                        ),

                    ),
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

    class WPBakeryShortCode_vc_info_block extends WPBakeryShortCode
    {
        protected function content($atts, $content = null)
        {
            /* get all params */
            extract(shortcode_atts(array(
                'style' => 'vertical',
                'items' => '',
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


            <?php if (!empty($items)):

            if ($style == 'vertical') { ?>
                <div class="project-detail-splitted-info <?php echo esc_attr($wrap_class); ?>">
            <?php } else { ?>
                <div class="project-detail-block-outer <?php echo esc_attr($wrap_class); ?>">
            <?php }

            $items = (array)vc_param_group_parse_atts($items);

            foreach ($items as $item) :
                if ($style == 'vertical') { ?>
                    <div class="project-detail-block-outer">
                <?php } ?>
                <div class="project-detail-block-wrapper">
                    <div class="project-detail-block-item">
                        <?php if (!empty($item['label'])): ?>
                            <div class="project-detail-block-title">
                                <?php echo esc_html($item['label']); ?>
                            </div>
                        <?php endif ?>
                        <?php if (!empty($item['text'])): ?>
                            <div class="project-detail-block-descr">
                                <p><?php echo wpautop($item['text']); ?></p>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <?php if ($style == 'vertical') { ?>
                </div>
            <?php } ?>
            <?php endforeach; ?>
            </div>
        <?php endif ?>

            <?php
            // end output
            return ob_get_clean();
        }
    }
}
