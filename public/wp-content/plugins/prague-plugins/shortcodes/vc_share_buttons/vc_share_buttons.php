<?php
/*
 * Share Buttons Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */
if (function_exists('vc_map')) {
    vc_map(
        array(
            'name' => esc_html__('Share buttons', 'js_composer'),
            'base' => 'vc_share_buttons',
            'content_element' => true,
            'show_settings_on_create' => true,
            'description' => esc_html__('', 'js_composer'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Title', 'js_composer'),
                    'param_name' => 'title'
                ),
                array (
                    'param_name' => 'facebook',
                    'type' => 'checkbox',
                    'description' => '',
                    'heading' => 'Add Facebook share button?',
                    'value' => '',
                ),
                array (
                    'param_name' => 'twitter',
                    'type' => 'checkbox',
                    'description' => '',
                    'heading' => 'Add Twitter share button?',
                    'value' => '',
                ),
                array (
                    'param_name' => 'linkedin',
                    'type' => 'checkbox',
                    'description' => '',
                    'heading' => 'Add Linkedin share button?',
                    'value' => '',
                ),
                array (
                    'param_name' => 'pinterest',
                    'type' => 'checkbox',
                    'description' => '',
                    'heading' => 'Add Pinterest share button?',
                    'value' => '',
                ),
                array (
                    'param_name' => 'google_plus',
                    'type' => 'checkbox',
                    'description' => '',
                    'heading' => 'Add Google+ share button?',
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

    class WPBakeryShortCode_vc_share_buttons extends WPBakeryShortCode
    {
        protected function content($atts, $content = null)
        {
            /* get all params */
            extract(shortcode_atts(array(
                'title' => '',
                'facebook' => '',
                'twitter' => '',
                'linkedin' => '',
                'pinterest' => '',
                'google_plus' => '',
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
            ob_start();

            if ( !empty($facebook) || !empty($twitter) || !empty($linkedin) || !empty($pinterest) || !empty($google_plus) ){ ?>
                <div class="project-detail-splitted-info">
                    <div class="prague-share-icons <?php echo esc_attr($wrap_class); ?>">
                        <?php if ( !empty($title) ){ ?>
                            <div class="prague-share-label"><?php echo esc_html($title); ?></div>
                        <?php }
                        if (!empty($facebook)){ ?>
                            <button  data-share="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" class="icon fa fa-facebook"></button>
                        <?php }
                        if (!empty($twitter)){ ?>
                            <button  data-share="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" class="icon fa fa-twitter"></button>
                        <?php }
                        if (!empty($linkedin)){ ?>
                            <button  data-share="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" class="icon fa fa-linkedin"></button>
                        <?php }
                        if (!empty($pinterest)){ ?>
                            <button  data-share="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo esc_url($url); ?>" class="icon fa fa-pinterest-p"></button>
                        <?php }
                        if (!empty($google_plus)){ ?>
                            <button  data-share="http://plus.google.com/share?url=<?php esc_url( the_permalink() ); ?>&amp;title=<?php echo esc_attr( urlencode( the_title( '', '', false ) ) ); ?>" class="icon fa fa-google-plus"></button>
                        <?php } ?>
                        </div>
                </div>
            <?php }

            // end output
            return ob_get_clean();
        }
    }
}
