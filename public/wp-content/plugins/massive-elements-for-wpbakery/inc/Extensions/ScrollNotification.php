<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Extensions;

use Inc\Base\ExtensionsController;

class ScrollNotification extends ExtensionsController {
	public function extensions_register() {
		if ( ! $this->activated( 'scroll_notification' ) ) {
			return;
		}
		add_shortcode( 'prime_cq_vc_notify', array( $this, 'prime_cq_vc_notify_func' ));

		$this->scrollnotification();
	}

	public function scrollnotification() {
		vc_map( array(
			"name" => __("Scrolling Notification", 'mewvc'),
			"base" => "prime_cq_vc_notify",
			"class" => "prime_cq_vc_extension_scrollnotification   ",
			"controls" => "full",
			"icon" => "mew_scroll_notification",
			"category" => __('Massive Elements', 'js_composer'),
			'description' => __( 'Popup notification', 'js_composer' ),
			"params" => array(
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __("Notification content", 'mewvc'),
					"param_name" => "content",
					"value" => __("<p>I am test text block. Click edit button to change this text.</p>", 'mewvc'),
					"description" => __("", 'mewvc')
				),
				array(
					"type" => "textfield",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("opacity", 'mewvc'),
					"param_name" => "opacity",
					"value" => __("0.8", 'mewvc'),
					"description" => __("", 'mewvc')
				),
				array(
					"type" => "dropdown",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("easein", "mewvc"),
					"param_name" => "easein",
					"value" => array(__("random", "mewvc") => 'random', __("fadeIn", "mewvc") => "fadeIn", __("wobble", "mewvc") => "wobble", __("tada", "mewvc") => "tada", __("shake", "mewvc") => "shake", __("swing", "mewvc") => "swing", __("pulse", "mewvc") => "pulse", __("fadeInLeft", "mewvc") => "fadeInLeft", __("fadeInRight", "mewvc") => "fadeInRight", __("fadeInUp", "mewvc") => "fadeInUp", __("fadeInDown", "mewvc") => "fadeInDown", __("fadeInLeftBig", "mewvc") => "fadeInLeftBig", __("fadeInRightBig", "mewvc") => "fadeInRightBig", __("fadeInUpBig", "mewvc") => "fadeInUpBig", __("fadeInDownBig", "mewvc") => "fadeInDownBig", __("bounceInLeft", "mewvc") => "bounceInLeft", __("bounceInRight", "mewvc") => "bounceInRight", __("bounce", "mewvc") => "bounce", __("bounceInUp", "mewvc") => "bounceInUp", __("bounceInDown", "mewvc") => "bounceInDown", __("rollIn", "mewvc") => "rollIn", __("rotateIn", "mewvc") => "rotateIn", __("rotateInDownLeft", "mewvc") => "rotateInDownLeft", __("rotateInDownRight", "mewvc") => "rotateInDownRight", __("rotateInUpLeft", "mewvc") => "rotateInUpLeft", __("rotateInUpRight", "mewvc") => "rotateInUpRight", __("flipInX", "mewvc") => "flipInX", __("flipInY", "mewvc") => "flipInY", __("lightSpeedIn", "mewvc") => "lightSpeedIn"),
					"description" => __("Select easin in animation type. Note: Works only in modern browsers.", "mewvc")
				),
				array(
					"type" => "dropdown",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("easeout", "mewvc"),
					"param_name" => "easeout",
					"value" => array(__("random", "mewvc") => 'random', __("fadeOut", "mewvc") => "fadeOut", __("fadeOutLeft", "mewvc") => "fadeOutLeft", __("fadeOutRight", "mewvc") => "fadeOutRight", __("fadeOutUp", "mewvc") => "fadeOutUp", __("fadeOutDown", "mewvc") => "fadeOutDown", __("fadeOutLeftBig", "mewvc") => "fadeOutLeftBig", __("fadeOutRightBig", "mewvc") => "fadeOutRightBig", __("fadeOutUpBig", "mewvc") => "fadeOutUpBig", __("fadeOutDownBig", "mewvc") => "fadeOutDownBig", __("bounceOutLeft", "mewvc") => "bounceOutLeft", __("bounceOutRight", "mewvc") => "bounceOutRight", __("bounceOutUp", "mewvc") => "bounceOutUp", __("bounceOutDown", "mewvc") => "bounceOutDown", __("rollOut", "mewvc") => "rollOut", __("rotateOut", "mewvc") => "rotateOut", __("rotateOutDownLeft", "mewvc") => "rotateOutDownLeft", __("rotateOutDownRight", "mewvc") => "rotateOutDownRight", __("rotateOutUpLeft", "mewvc") => "rotateOutUpLeft", __("rotateOutUpRight", "mewvc") => "rotateOutUpRight", __("flipOutX", "mewvc") => "flipOutX", __("flipOutY", "mewvc") => "flipOutY", __("lightSpeedOut", "mewvc") => "lightSpeedOut"),
					"description" => __("Select easout in animation type. Note: Works only in modern browsers.", "mewvc")
				),
				array(
					"type" => "dropdown",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("Display the notification", "mewvc"),
					"param_name" => "displaywhen",
					"value" => array( __("hidden by default, visible only when user scrolling", "mewvc") => "scrolling", __("always visible", "mewvc") => "loaded", __("visible by default, hidden when user scrolling", "mewvc") => "scrollhidden"),
					"description" => __("Choose when to display the notification.", "mewvc")
				),
				array(
					"type" => "dropdown",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("Put the close button on the", "mewvc"),
					"param_name" => "closeposition",
					"value" => array(__("left", "mewvc") => "left", __("right", "mewvc") => "right"),
					"description" => __("", "mewvc")
				),
				array(
					"type" => "textfield",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("width", 'mewvc'),
					"param_name" => "width",
					"value" => __("240", 'mewvc'),
					"description" => __("A fixed value like 640, or a percent value like 60%, or leave it to be blank equal to auto.", 'mewvc')
				),
				array(
					"type" => "textfield",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("height", 'mewvc'),
					"param_name" => "height",
					"value" => __("auto", 'mewvc'),
					"description" => __("A fixed value like 640, or a percent value like 60%, or leave it to be blank equal to auto.", 'mewvc')
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __("Notification text color", 'vc_extend'),
					"param_name" => "textcolor",
					"value" => '#333',
					"description" => __("", 'vc_extend')
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __("Notification background", 'vc_extend'),
					"param_name" => "background",
					"value" => '#fff',
					"description" => __("", 'vc_extend')
				),
				array(
					"type" => "textfield",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("top", 'mewvc'),
					"param_name" => "top",
					"value" => __("", 'mewvc'),
					"description" => __("", 'mewvc')
				),
				array(
					"type" => "textfield",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("right", 'mewvc'),
					"param_name" => "right",
					"value" => __("10", 'mewvc'),
					"description" => __("", 'mewvc')
				),
				array(
					"type" => "textfield",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("bottom", 'mewvc'),
					"param_name" => "bottom",
					"value" => __("10", 'mewvc'),
					"description" => __("", 'mewvc')
				),
				array(
					"type" => "textfield",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("left", 'mewvc'),
					"param_name" => "left",
					"value" => __("", 'mewvc'),
					"description" => __("", 'mewvc')
				),
				array(
					"type" => "textfield",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("Auto hide delay", 'mewvc'),
					"param_name" => "autohidedelay",
					"value" => __("", 'mewvc'),
					"description" => __("For example, 5000 stand for 5 seconds, leave it to blank if you do not want it", 'mewvc')
				),
				array(
					"type" => "checkbox",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("After close, store it in cookie", 'mewvc'),
					"param_name" => "cookie",
					"value" => array(__("yes", "mewvc") => 'on'),
					"description" => __("", 'mewvc')
				),
				// array(
				//   "type" => "checkbox",
				//   "holder" => "",
				//   "class" => "mewvc",
				//   "heading" => __("Display be default, hiden when user scrolling.", 'mewvc'),
				//   "param_name" => "displaybydefault",
				//   "value" => array(__("yes", "mewvc") => 'on'),
				//   "description" => __("", 'mewvc')
				// ),
				array(
					"type" => "textfield",
					"holder" => "",
					"class" => "mewvc",
					"heading" => __("After close, do not show the notification again for days", 'mewvc'),
					"param_name" => "days",
					"value" => __("10", 'mewvc'),
					"description" => __("You have to enable the store in cookie", 'mewvc'),
				),
/*				array(
					"type" => "prime_param_heading",
					"text" => "<span class='phyoutubeparam'>
							<iframe allowFullScreen='allowFullScreen' width='700px' height='340px'
							src='https://www.youtube.com/embed/bUSK-wFFX00' frameborder='0' allowfullscreen>
							</iframe>
						</span>",
					"param_name" => "notification",
					'edit_field_class' => 'prime-param-important-wrapper prime-dashicon prime-align-right prime-bold-font prime-blue-font vc_column vc_col-sm-12',
					"group" => "Video Tutorial"
				),*/
				// array(
				//   "type" => "checkbox",
				//   "holder" => "",
				//   "class" => "mewvc",
				//   "heading" => __("display globally", 'mewvc'),
				//   "param_name" => "displayglobally",
				//   "value" => array(__("yes", "mewvc") => 'true'),
				//   "description" => __("Check this if you want to display a unique notification only whole site", 'mewvc')
				// )

			)
		) );
	}


	function prime_cq_vc_notify_func( $atts, $content=null, $tag) {
		extract( shortcode_atts( array(
			'width' => '240',
			'height' => '140',
			'textcolor' => '#333',
			'background' => '#fff',
			'easein' => 'fadeInLeft',
			'easeout' => 'fadeOutRight',
			'cookie' => 'false',
			'autohidedelay' => '',
			'days' => '10',
			'top' => '',
			'right' => '10',
			'bottom' => '10',
			'left' => '',
			'opacity' => '0.8',
			'displaywhen' => 'scrolling',
			// 'displaybydefault' => '',
			'closeposition' => 'left'
			// 'displayglobally' => 'no'
		), $atts ) );

		$path = plugin_dir_url( dirname(__FILE__ , 2 ));

		wp_register_script('modernizr_css3', $path . 'assets/js/modernizr.custom.js', array("jquery"));
		wp_enqueue_script('modernizr_css3');

		wp_enqueue_script('jquery-cookie', $path .'assets/js/jquery.cookie.js', array('jquery'));

		wp_enqueue_script( 'mewvc_js', $path .'assets/js/jquery.scroll-notify.min.js', array('jquery') );

		$content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
		$output = '';
		if(is_single()||is_page()){
			if($displaywhen=="scrollhidden"){
				return "<div id='cq-scroll-notification' data-width='${width}' data-height='${height}' data-textcolor='${textcolor}' data-background='${background}' data-easein='${easein}' data-easeout='${easeout}' data-positiontop='${top}' data-positionright='${right}' data-positionbottom='${bottom}' data-positionleft='${left}' data-cookie='${cookie}' data-days='${days}' data-autohidedelay='${autohidedelay}' data-displaywhen='loaded' data-opacity='${opacity}' data-from='0' data-to='all' data-closebutton='true' data-displaybydefault='on' data-closeposition='${closeposition}' class='cq-scroll-notification'> {$content} </div>";
			}else{
				return "<div id='cq-scroll-notification' data-width='${width}' data-height='${height}' data-textcolor='${textcolor}' data-background='${background}' data-easein='${easein}' data-easeout='${easeout}' data-positiontop='${top}' data-positionright='${right}' data-positionbottom='${bottom}' data-positionleft='${left}' data-cookie='${cookie}' data-days='${days}' data-autohidedelay='${autohidedelay}' data-displaywhen='${displaywhen}' data-opacity='${opacity}' data-from='0' data-to='all' data-closebutton='true' data-closeposition='${closeposition}' class='cq-scroll-notification' style='display:none'> {$content} </div>";

			}
		}
	}
}