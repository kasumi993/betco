<?php
/*
 * Banner Title Shortcode
 * Author: FOXTHEMES
 * Author URI: http://foxthemes.com
 * Version: 1.0.0
 */
if (function_exists('vc_map')) {
    vc_map(
        array(
            'name'                    => esc_html__('Banner Title', 'js_composer'),
            'base'                    => 'vc_banner_title',
            'content_element'         => true,
            'show_settings_on_create' => true,
            'description'             => esc_html__('', 'js_composer'),
            'params'                  => array(
                array(
                    'param_name'  => 'style',
                    'type'        => 'dropdown',
                    'description' => '',
                    'heading'     => 'Style shortcode',
                    'value'       => array(
                        'Simple' => 'simple',
                        'Big'    => 'big',
                    ),
                ),
                
                array(
                    'param_name'  => 'color_style',
                    'type'        => 'dropdown',
                    'description' => '',
                    'heading'     => 'Color style',
                    'value'       => array(
                        'Default (Dark)' => 'dark',
                        'Light'          => 'light',
                    ),
                ),
                array(
                    'param_name'  => 'heading_size',
                    'type'        => 'dropdown',
                    'description' => '',
                    'heading'     => 'Heading Size',
                    'value'       => array(
                        'H1' => 'h1',
                        'H2' => 'h2',
                        'H3' => 'h3',
                        'H4' => 'h4',
                        'H5' => 'h5',
                        'H6' => 'h6',
                    ),
                ),
                array(
                    'param_name'  => 'subtitle',
                    'type'        => 'textfield',
                    'description' => '',
                    'heading'     => 'SubTitle',
                    'value'       => '',
                ),
                array(
                    'param_name'  => 'title',
                    'type'        => 'textarea',
                    'description' => '',
                    'heading'     => 'Title',
                    'value'       => '',
                ),
                array(
                    'param_name'  => 'animation_text',
                    'type'        => 'textfield',
                    'description' => '',
                    'heading'     => 'Animation Text',
                    'value'       => '',
                    'dependency'  => array('element' => 'style', 'value' => array('simple')),
                ),
                array(
                    'param_name'  => 'color_animation_text',
                    'type'        => 'colorpicker',
                    'description' => '',
                    'heading'     => 'Color Animation Text',
                    'dependency'  => array('element' => 'style', 'value' => array('simple')),
                ),
                array(
                    'param_name'  => 'style_background',
                    'type'        => 'dropdown',
                    'description' => '',
                    'heading'     => 'Style background',
                    'value'       => array(
                        'Image' => 'image',
                        'Video' => 'video',
                    ),
                ),
                array(
                    'param_name'  => 'img',
                    'type'        => 'attach_image',
                    'description' => '',
                    'heading'     => 'Background Image',
                    'value'       => '',
                ),
                array(
                    'param_name'  => 'video_url',
                    'type'        => 'textfield',
                    'description' => '',
                    'heading'     => 'Video url',
                    'value'       => '',
                    'dependency'  => array('element' => 'style_background', 'value' => array('video')),
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__('Video Mute', 'js_composer'),
                    'param_name' => 'video_mute',
                    'value'      => array(__('Yes', 'js_composer') => 'on'),
                    'std'        => 'on',
                    'dependency' => array(
                        'element' => 'style_background',
                        'value'   => array('video'),
                    ),
                ),
                array(
                    'param_name'  => 'content',
                    'type'        => 'textarea_html',
                    'description' => '',
                    'heading'     => 'Description',
                    'value'       => '',
                ),
                array(
                    'param_name'  => 'button',
                    'type'        => 'vc_link',
                    'description' => '',
                    'heading'     => 'Button',
                    'value'       => '',
                ),
                array(
                    'param_name'  => 'style_button',
                    'type'        => 'dropdown',
                    'description' => '',
                    'heading'     => 'Style button',
                    'value'       => array(
                        'Simple'   => 'simple',
                        'Creative' => 'creative',
                    ),
                ),

                array(
                    'param_name'  => 'columns',
                    'type'        => 'param_group',
                    'description' => '',
                    'heading'     => 'Columns',
                    'params'      => array(
                        array(
                            'param_name'  => 'title_col',
                            'type'        => 'textfield',
                            'description' => '',
                            'heading'     => 'Title',
                            'value'       => '',
                            'parent'      => 'columns',
                        ),
                        array(
                            'param_name'  => 'subtitle_col',
                            'type'        => 'textarea',
                            'description' => '',
                            'heading'     => 'Subtitle',
                            'value'       => '',
                            'parent'      => 'columns',
                        ),
                        array(
                            'param_name'  => 'divider',
                            'type'        => 'checkbox',
                            'description' => '',
                            'heading'     => 'Divider',
                            'value'       => '',
                            'parent'      => 'columns',
                        ),
                    ),
                ),

                array(
                    'param_name'  => 'enable_overlay',
                    'type'        => 'checkbox',
                    'description' => '',
                    'heading'     => 'Enable overlay',
                    'value'       => '',
                ),
                array(
                    'param_name'  => 'enable_fullheight',
                    'type'        => 'checkbox',
                    'description' => '',
                    'heading'     => 'Enable fullheight',
                    'value'       => '',
                ),

                array(
                    'type'        => 'textfield',
                    'heading'     => 'Extra class name',
                    'param_name'  => 'el_class',
                    'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.',
                    'value'       => '',
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => 'CSS box',
                    'param_name' => 'css',
                    'group'      => 'Design options',
                ),
            ),
            //end params
        )
    );
}
if (class_exists('WPBakeryShortCode')) {
    /* Frontend Output Shortcode */
    class WPBakeryShortCode_vc_banner_title extends WPBakeryShortCode
    {
        protected function content($atts, $content = null)
        {
            /* get all params */
            extract(shortcode_atts(array(
                'style'             => 'simple',
                'color_style'       => 'dark',
                'subtitle'          => '',
                'title'             => '',
                'animation_text'     => '',
                'color_animation_text'   => '',
                'heading_size'      => 'h1',
                'button'            => '',
                'type'              => '',
                'columns'           => '',
                'style_button'      => 'simple',
                'img'               => '',
                'enable_overlay'    => '',
                'enable_fullheight' => '',
                'style_background'  => 'image',
                'video_url'         => '',
                'video_mute'        => 'on',
                'el_class'          => '',
                'css'               => '',
            ), $atts));
            

            $css_classes = array(
              $this->getExtraClass( $el_class )
            );
            $wrap_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts );
            /* get custum css as class*/
            $wrap_class .= vc_shortcode_custom_css_class( $css, ' ' );
            $wrap_class .= !empty( $el_class ) ? ' ' . $el_class : '';

            $style_css = '';
            if (!empty($style_background) && $style_background == "video"){
                 $style_css .= ' js-video-wrapper pr-video-wrapper';
            }

            $style_css .= ' ' .$style;

            if (!empty($video_url) && !is_admin() ) {
                wp_enqueue_script('vc_youtube_iframe_api_js');
            }

            $columns = json_decode(urldecode($columns));
            if ( !empty($columns) && !empty($columns[0]->title_col) ) {
                $style_css .= ' enable_column';
            }


            // start output
            ob_start();
            if (!empty($wrap_class)): ?>

      <div class="<?php echo esc_attr($wrap_class); ?>">
      <?php endif;?>
        <section class="container-fluid top-banner no-padd <?php echo esc_html($style_css); ?> <?php if (!empty($enable_fullheight)): ?>fullheight<?php endif;?> <?php if (!empty($color_style)): echo esc_attr($color_style);endif;?>">
          <?php if (!empty($enable_overlay)): ?><span class="overlay"></span><?php endif;?>
          <?php if (!empty($style_background)): ?><?php if (!empty($img)): ?><?php $image_src = wp_get_attachment_image_src($img, 'full');
                    $image_src = is_array($image_src) ? $image_src[0] : $image_src;?> <img src="<?php echo esc_url($image_src); ?>" class="s-img-switch"  alt="<?php echo get_post_meta($img, '_wp_attachment_image_alt', true); ?>"><?php endif;?><?php endif;?>
          <?php if (!empty($style_background) && $style_background == "video"): ?>
            <a href="#" class="js-play-button pr-video-play"></a>
            <span class="js-video-close pr-video-close fa fa-close"></span>
            
            <div class="js-video-container pr-video-container">

                <?php $video_params = array(
                    'autoplay' => '1',
                    'rel' => '0',
                    'controls' => '0',
                    'showinfo' => '0',
                    'loop' => '1',
                );

                $video_url = str_replace("feature=oembed", "feature=oembed&enablejsapi=1&" . http_build_query($video_params), wp_oembed_get($video_url));
                if (!empty($video_mute) && $video_mute == 'on') {
                    $video_url = str_replace('frameborder="0"', 'frameborder="0" data-mute="on"', $video_url);
                }
                echo $video_url;?>
            </div>

          <?php endif;?>
          <div class="content">
                <div class="prague-svg-animation-text">
                    <?php
                    if (!empty($style) && $style == 'simple' && !empty($animation_text)) {

                        $text = $animation_text;

                        $svg = new FoxEasySVG();
                        $svg->setFontSVG(get_template_directory() .  "/assets/fonts/Roboto-Black-webfont.svg");
                        $svg->setFontSize(100);
                        $svg->setLineHeight(32);
                        $svg->setLetterSpacing(0);
                        $svg->addText($animation_text);
                        // set width/height according to text
                        list($textWidth, $textHeight) = $svg->textDimensions($animation_text);
                        $svg->addAttribute("width",   "93%");
                        $svg->addAttribute("height",  "100%");
                        $color_animation_text = !empty($color_animation_text) ? "stroke:" .$color_animation_text : '';
                        $svg->addAttribute("style",   $color_animation_text);
                        $svg->addAttribute("fill",  "transparent");
                        $textHeight = $textHeight + 40;
                        $svg->addAttribute("viewBox",  "0 0 " . $textWidth . " " . $textHeight );
                        $svg->addAttribute("preserveAspectRatio",  "xMidYMid meet");
                        $svg->addAttribute("class",  "prague-svg");
                        echo $svg->asXML();
                    }
                    ?>
                </div>

            <?php if (!empty($subtitle)): ?><div class="subtitle"><?php echo esc_html($subtitle); ?></div><?php endif;?>
            <?php if (!empty($title)): ?><<?php echo esc_attr($heading_size); ?> class="title"><?php echo wp_kses_post($title); ?></<?php echo esc_attr($heading_size); ?>><?php endif;?>
            <?php if (!empty($content)): ?><div class="description"><p><?php echo wp_kses_post($content); ?></p></div><?php endif;?>
            <?php
            if (!empty($button)) {
                $vc_link = vc_build_link($button);
                $target  = '';
                if (!empty($vc_link['target'])) {
                    $target = ' target="' . esc_attr($vc_link['target']) . '"';
                }

                if (!empty($vc_link['url'])) {
                    if (empty($vc_link['title'])) {
                        $vc_link['title'] = 'label';
                    }?>
                    <a href="<?php echo esc_url($vc_link['url']) ?>" class="a-btn <?php if (!empty($style_button)) {echo esc_attr($style_button);}?>" <?php echo $target; ?>>
                      <span class="a-btn-line"></span>
                      <?php echo esc_html($vc_link['title']); ?>
                    </a>
                  <?php } }?>
                  <?php 
                  
                  if (!empty($columns) && !empty($columns[0]->title_col)): ?>
                  <div class="banner-columns">
                  <?php foreach ($columns as $item):
                     $divider = !empty($item->divider) ? 'divider' : ''; ?>
                      <div class="banner-col-item <?php echo esc_attr($divider); ?>">
                      <?php if (!empty($item->title_col)): ?>
                      <span class="title"><?php echo esc_html($item->title_col); ?></span>
                      <?php endif;?>
                    <?php if (!empty($item->subtitle_col)): ?>
                    <span class="subtitle"><?php echo wp_kses_post($item->subtitle_col); ?></span>
                    <?php endif;?>
                    </div>
                  <?php endforeach;?>
                </div>
                <?php endif;?>
        </div>
        <div class="top-banner-cursor"></div>
    </section>
      <?php if (!empty($wrap_class)): ?>
      </div>
      <?php endif;
            // end output
            return ob_get_clean();
        }
    }
}
