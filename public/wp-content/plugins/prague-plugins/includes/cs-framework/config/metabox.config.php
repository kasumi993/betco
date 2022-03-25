<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// -----------------------------------------
// Page Side Metabox Options               -
// -----------------------------------------
// Page Options
$options[] = array(
	'id'        => 'prague_post_options',
	'title'     => 'Page Options',
	'post_type' => 'page', // or post or CPT or array( 'page', 'post' )
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'   => 'section_3',
			'fields' => array(
				array(
					'id'      => 'style_header',
					'type'    => 'select',
					'title'   => 'Style header',
					'options' => array(
						'absolute' => 'Absolute',
						'static'   => 'Static',
					),
				),
				array(
					'id'      => 'header_style',
					'type'    => 'select',
					'title'   => 'Header Style',
					'options' => array(
						''       => 'Default from Theme Options',
						'simple' => 'Simple',
						'full'   => 'Full',
						'left'   => 'Left',
					),
				),
				array(
					'id'      => 'easy_style',
					'type'    => 'switcher',
					'title'   => 'Easy style for full menu?',
					'desc'    => 'For correct work must me FULL menu style',
					'default' => false,
				),
				array(
					'id'      => 'bottom_menu',
					'type'    => 'switcher',
					'title'   => 'Move menu down?',
					'desc'    => 'For correct work must me SIMPLE menu style',
					'default' => false,
				),
				array(
					'id'      => 'header_color',
					'type'    => 'select',
					'title'   => 'Header Color',
					'options' => array(
						''      => 'Default from Theme Options',
						'light' => 'Light',
						'dark'  => 'Dark',
					),
				),
				array(
					'id'    => 'image_logo',
					'type'  => 'image',
					'title' => 'Site Logo',
				),
				array(
					'id'      => 'page_footer',
					'type'    => 'switcher',
					'title'   => 'Hide Footer',
					'default' => false,
				),
				array(
					'id'      => 'style_footer',
					'type'    => 'select',
					'title'   => 'Style footer',
					'options' => array(
						'default' => 'Default',
						'modern'  => 'Fixed',
						'copy'    => 'Copyrighted'
					),
				),
			),
		),
	)
);

// Post Options
$options[] = array(
	'id'        => 'prague_post_options',
	'title'     => 'Post Options',
	'post_type' => 'post', // or post or CPT or array( 'page', 'post' )
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'   => 'section_3',
			'fields' => array(
				array(
					'id'      => 'created_date',
					'type'    => 'switcher',
					'title'   => 'Created Date',
					'default' => '',
				),
				array(
					'id'      => 'category_show',
					'type'    => 'switcher',
					'title'   => 'Category Show',
					'default' => '',
				),
				array(
					'id'      => 'category_tags',
					'type'    => 'switcher',
					'title'   => 'Category Tags',
					'default' => '',
				),
				array(
					'id'      => 'show_info',
					'type'    => 'switcher',
					'title'   => 'On/Off Post Info (gray block)',
					'default' => '',
				),
				array(
					'id'      => 'show_author',
					'type'    => 'switcher',
					'title'   => 'On/Off author',
					'default' => '',
				),
				array(
					'id'      => 'show_share',
					'type'    => 'switcher',
					'title'   => 'On/Off share',
					'default' => '',
				),

				array(
					'id'      => 'style_header',
					'type'    => 'select',
					'title'   => 'Style header',
					'options' => array(
						'absolute' => 'Absolute',
						'static'   => 'Static',
					),
				),

				array(
					'id'      => 'header_color',
					'type'    => 'select',
					'title'   => 'Header Color',
					'options' => array(
						''      => 'Default from Theme Options',
						'light' => 'Light',
						'dark'  => 'Dark',
					),
				),
				array(
					'id'    => 'image_logo',
					'type'  => 'image',
					'title' => 'Site Logo',
				),
				array(
					'id'      => 'page_footer',
					'type'    => 'switcher',
					'title'   => 'Hide Footer',
					'default' => false,
				),
				array(
					'id'      => 'style_footer',
					'type'    => 'select',
					'title'   => 'Style footer',
					'options' => array(
						'default' => 'Default',
						'modern'  => 'Fixed',
						'copy'    => 'Copyrighted'
					),
				),
			),
		),
	)
);

// Services Options
$options[] = array(
	'id'        => 'service_post_options',
	'title'     => 'Service Options',
	'post_type' => 'services', // or post or CPT or array( 'page', 'post' )
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'   => 'section_3',
			'fields' => array(
				array(
					'id'    => 'icon_post',
					'type'  => 'icon',
					'title' => 'Font Icon'
				),
				array(
					'id'      => 'website',
					'type'    => 'select',
					'title'   => 'WebSite',
					'options' => array(
						''           => 'Default',
						'custom_url' => 'Custom WebSite url',
					),
					'default' => '',
				),
				array(
					'id'         => 'custom_url',
					'type'       => 'text',
					'title'      => 'Custom url',
					'default'    => '',
					'dependency' => array( 'website', '==', 'custom_url' ),
				),
				array(
					'id'      => 'custum_button_url',
					'type'    => 'text',
					'title'   => 'Custom url for button detail',
					'default' => '',
				),
				array(
					'id'      => 'custom_button_lable',
					'type'    => 'text',
					'title'   => 'Custom lable for button detail',
					'default' => '',
				),
				array(
					'id'      => 'style_header',
					'type'    => 'select',
					'title'   => 'Style header',
					'options' => array(
						'absolute' => 'Absolute',
						'static'   => 'Static',
					),
				),
				array(
					'id'      => 'header_color',
					'type'    => 'select',
					'title'   => 'Header Color',
					'options' => array(
						''      => 'Default from Theme Options',
						'light' => 'Light',
						'dark'  => 'Dark',
					),
				),
				array(
					'id'    => 'image_logo',
					'type'  => 'image',
					'title' => 'Site Logo',
				),
				array(
					'id'      => 'page_footer',
					'type'    => 'switcher',
					'title'   => 'Hide Footer',
					'default' => false,
				),
				array(
					'id'      => 'style_footer',
					'type'    => 'select',
					'title'   => 'Style footer',
					'options' => array(
						'default' => 'Default',
						'modern'  => 'Fixed',
						'copy'    => 'Copyrighted'
					),
				),
			),
		),
	)
);

// Books Options
$options[] = array(
	'id'        => 'prague_post_options',
	'title'     => 'Books Options',
	'post_type' => 'books', // or post or CPT or array( 'page', 'post' )
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'   => 'books_options',
			'fields' => array(
				array(
					'id'      => 'website',
					'type'    => 'select',
					'title'   => 'WebSite',
					'options' => array(
						''           => 'Default',
						'custom_url' => 'Custom WebSite url',
					),
					'default' => '',
				),
				array(
					'id'         => 'custom_url',
					'type'       => 'text',
					'title'      => 'Custom url',
					'default'    => '',
					'dependency' => array( 'website', '==', 'custom_url' ),
				),
				array(
					'id'      => 'style_header',
					'type'    => 'select',
					'title'   => 'Style header',
					'options' => array(
						'absolute' => 'Absolute',
						'static'   => 'Static',
					),
				),
				array(
					'id'      => 'header_color',
					'type'    => 'select',
					'title'   => 'Header Color',
					'options' => array(
						''      => 'Default from Theme Options',
						'light' => 'Light',
						'dark'  => 'Dark',
					),
				),

				array(
					'id'    => 'image_logo',
					'type'  => 'image',
					'title' => 'Site Logo',
				),

				array(
					'id'      => 'page_footer',
					'type'    => 'switcher',
					'title'   => 'Hide Footer',
					'default' => false,
				),
				array(
					'id'      => 'style_footer',
					'type'    => 'select',
					'title'   => 'Style footer',
					'options' => array(
						'default' => 'Default',
						'modern'  => 'Fixed',
						'copy'    => 'Copyrighted'
					),
				),

			)
		)
	)
);

// Media Options
$options[] = array(
	'id'        => 'prague_post_options',
	'title'     => 'Media Options',
	'post_type' => 'media', // or post or CPT or array( 'page', 'post' )
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'   => 'media_options',
			'fields' => array(
				array(
					'id'      => 'website',
					'type'    => 'select',
					'title'   => 'WebSite',
					'options' => array(
						''           => 'Default',
						'custom_url' => 'Custom WebSite url',
					),
					'default' => '',
				),
				array(
					'id'         => 'custom_url',
					'type'       => 'text',
					'title'      => 'Custom url',
					'default'    => '',
					'dependency' => array( 'website', '==', 'custom_url' ),
				),
				array(
					'id'      => 'style_header',
					'type'    => 'select',
					'title'   => 'Style header',
					'options' => array(
						'absolute' => 'Absolute',
						'static'   => 'Static',
					),
				),
				array(
					'id'      => 'header_color',
					'type'    => 'select',
					'title'   => 'Header Color',
					'options' => array(
						''      => 'Default from Theme Options',
						'light' => 'Light',
						'dark'  => 'Dark',
					),
				),

				array(
					'id'    => 'image_logo',
					'type'  => 'image',
					'title' => 'Site Logo',
				),

				array(
					'id'      => 'page_footer',
					'type'    => 'switcher',
					'title'   => 'Hide Footer',
					'default' => false,
				),
				array(
					'id'      => 'style_footer',
					'type'    => 'select',
					'title'   => 'Style footer',
					'options' => array(
						'default' => 'Default',
						'modern'  => 'Fixed',
						'copy'    => 'Copyrighted'
					),
				),

			)
		)
	)
);

// Exhibitions
$options[] = array(
	'id'        => 'prague_post_options',
	'title'     => 'Exhibitions Options',
	'post_type' => 'exihibitions', // or post or CPT or array( 'page', 'post' )
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'   => 'media_options',
			'fields' => array(
				array(
					'id'      => 'website',
					'type'    => 'select',
					'title'   => 'WebSite',
					'options' => array(
						''           => 'Default',
						'custom_url' => 'Custom WebSite url',
					),
					'default' => '',
				),
				array(
					'id'         => 'custom_url',
					'type'       => 'text',
					'title'      => 'Custom url',
					'default'    => '',
					'dependency' => array( 'website', '==', 'custom_url' ),
				),

				array(
					'id'      => 'style_header',
					'type'    => 'select',
					'title'   => 'Style header',
					'options' => array(
						'absolute' => 'Absolute',
						'static'   => 'Static',
					),
				),

				array(
					'id'      => 'header_color',
					'type'    => 'select',
					'title'   => 'Header Color',
					'options' => array(
						''      => 'Default from Theme Options',
						'light' => 'Light',
						'dark'  => 'Dark',
					),
				),

				array(
					'id'    => 'image_logo',
					'type'  => 'image',
					'title' => 'Site Logo',
				),

				array(
					'id'      => 'page_footer',
					'type'    => 'switcher',
					'title'   => 'Hide Footer',
					'default' => false,
				),
				array(
					'id'      => 'style_footer',
					'type'    => 'select',
					'title'   => 'Style footer',
					'options' => array(
						'default' => 'Default',
						'modern'  => 'Fixed',
						'copy'    => 'Copyrighted'

					),
				),

			)
		)
	)
);

// Projects Options
$options[] = array(
	'id'        => 'prague_post_options',
	'title'     => 'Projects Options',
	'post_type' => 'projects', // or post or CPT or array( 'page', 'post' )
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'   => 'section_3',
			'fields' => array(

				array(
					'id'      => 'style',
					'type'    => 'select',
					'title'   => 'Template',
					'options' => array(
						'paralax'                 => 'Paralax',
						'paralax_text'            => 'Paralax Text',
						'simple'                  => 'Simple',
						'splited_screen'          => 'Splited Screen',
						'splited_creative_banner' => 'Splited Creative Banner',
						'columns_gallery'         => 'Columns Gallery',
						'slider'                  => 'Slider',
						'before_after'            => 'Before & After',
						'full_screen'             => 'Full Screen Slide',
						'pdf'                     => 'PDF',
					),
				),

				array(
					'id'         => 'before_style',
					'type'       => 'select',
					'title'      => 'Before & After Style',
					'default'    => '',
					'dependency' => array( 'style', 'any', 'before_after' ),
					'options'    => array(
						'before_fullheight' => 'Fullheight',
						'before_original'   => 'Original',
					),
				),

				array(
					'id'         => 'pdf_shortcode',
					'type'       => 'textarea',
					'sanitize'   => false,
					'title'      => 'PDF shortcode',
					'default'    => '',
					'desc'       => 'Insert shortcode Flip PDF',
					'dependency' => array( 'style', 'any', 'pdf' ),
				),

				array(
					'id'         => 'banner',
					'type'       => 'textarea',
					'title'      => 'Banner Shortcode',
					'dependency' => array( 'style', 'any', 'splited_creative_banner' ),
				),

				array(
					'id'         => 'active_title',
					'type'       => 'switcher',
					'title'      => 'Activate Title ',
					'default'    => true,
					'dependency' => array(
						'style',
						'any',
						'paralax,paralax_text,simple,splited_screen,3_columns_gallery,full_screen,columns_gallery,slider,before_after'
					),
				),

				array(
					'id'         => 'subtitle',
					'type'       => 'text',
					'title'      => 'Main SubTitle',
					'default'    => '',
					'dependency' => array(
						'style',
						'any',
						'paralax,paralax_text,splited_screen,simple,columns_gallery,slider,before_after,full_screen'
					),
				),

				array(
					'id'          => 'gallery',
					'type'        => 'gallery',
					'title'       => 'Gallery',
					'add_title'   => 'Add Images',
					'edit_title'  => 'Edit Images',
					'clear_title' => 'Remove Images',
					'dependency'  => array(
						'style',
						'any',
						'paralax,splited_screen,slider,full_screen,3_columns_gallery,splited_creative_banner,columns_gallery'
					),
				),

				array(
					'id'         => 'activate_lightbox',
					'type'       => 'switcher',
					'title'      => 'Activate Lightbox',
					'default'    => false,
					'dependency' => array( 'style', 'any', 'splited_screen,splited_creative_banner,columns_gallery' ),
				),

				/* For Fullsceen Slider and Slider */
				array(
					'id'         => 'arrows',
					'type'       => 'switcher',
					'title'      => 'Arrows (On/Off)',
					'default'    => false,
					'dependency' => array( 'style', 'any', 'slider,full_screen' ),
				),

				array(
					'id'         => 'slide_speed',
					'type'       => 'text',
					'title'      => 'Slide Speed',
					'desc'       => 'Default 1000 milliseconds',
					'default'    => '1000',
					'dependency' => array( 'style', 'any', 'slider,full_screen' ),
				),

				array(
					'id'         => 'autoplay',
					'type'       => 'switcher',
					'title'      => 'AutoPlay (On/Off)',
					'default'    => false,
					'dependency' => array( 'style', 'any', 'slider,full_screen' ),
				),

				array(
					'id'         => 'autoplay_speed',
					'type'       => 'text',
					'title'      => 'AutoPlay Speed',
					'desc'       => 'Default 5000 milliseconds',
					'default'    => '5000',
					'dependency' => array( 'autoplay', '==', 'true' ),
				),

				array(
					'id'         => 'title',
					'type'       => 'text',
					'title'      => 'Title',
					'default'    => '',
					'dependency' => array( 'style', 'any', 'splited_screen,splited_creative_banner' ),
				),

				array(
					'id'         => 'second_subtitle',
					'type'       => 'text',
					'title'      => 'SubTitle',
					'default'    => '',
					'dependency' => array( 'style', 'any', 'splited_screen,splited_creative_banner,slider' ),
				),

				/* For Paralax template */
				array(
					'id'         => 'description',
					'type'       => 'wysiwyg',
					'title'      => 'Description',
					'settings'   => array(
						'textarea_rows' => 5,
						'media_buttons' => false,
					),
					'dependency' => array( 'style', 'any', 'splited_screen,simple,splited_creative_banner' ),
				),

				array(
					'id'         => 'iframe_3d',
					'type'       => 'textarea',
					'sanitize'   => false,
					'title'      => 'Iframe for 3d',
					'default'    => '',
					'desc'       => 'Insert iframe from https://myhub.autodesk360.com',
					'dependency' => array( 'style', 'any', 'slider,before_after' ),
				),

				array(
					'id'         => 'image_before',
					'type'       => 'image',
					'title'      => 'Image Before',
					'default'    => '',
					'dependency' => array( 'style', 'any', 'before_after' ),
				),

				array(
					'id'         => 'image_after',
					'type'       => 'image',
					'title'      => 'Image After',
					'default'    => '',
					'dependency' => array( 'style', 'any', 'before_after' ),
				),

				array(
					'id'         => 'before_after_text',
					'type'       => 'switcher',
					'title'      => 'Change Before & After Button Text',
					'default'    => false,
					'dependency' => array( 'style', '==', 'before_after' ),
				),

				array(
					'id'         => 'before_btn_text',
					'type'       => 'text',
					'title'      => 'Before Button Text',
					'default'    => '',
					'dependency' => array( 'style|before_after_text', '==|==', 'before_after|true' ),
				),

				array(
					'id'         => 'after_btn_text',
					'type'       => 'text',
					'title'      => 'After Button Text',
					'default'    => '',
					'dependency' => array( 'style|before_after_text', '==|==', 'before_after|true' ),
				),

				array(
					'id'      => 'show_share',
					'type'    => 'switcher',
					'title'   => 'Show Share',
					'default' => true,
//					'dependency'   => array( 'style', 'any','splited_screen,splited_creative_banner' ),
				),

				array(
					'id'         => 'show_facebook_share',
					'type'       => 'switcher',
					'title'      => 'Show Facebook share button',
					'default'    => true,
					'dependency' => array( 'show_share', '==', 'true' ),
				),

				array(
					'id'         => 'show_twitter_share',
					'type'       => 'switcher',
					'title'      => 'Show Twitter share button',
					'default'    => true,
					'dependency' => array( 'show_share', '==', 'true' ),
				),

				array(
					'id'         => 'show_linkedin_share',
					'type'       => 'switcher',
					'title'      => 'Show LinkedIn share button',
					'default'    => true,
					'dependency' => array( 'show_share', '==', 'true' ),
				),

				array(
					'id'         => 'show_pinterest_share',
					'type'       => 'switcher',
					'title'      => 'Show Pinterest share button',
					'default'    => true,
					'dependency' => array( 'show_share', '==', 'true' ),
				),

				array(
					'id'         => 'footer_copiright',
					'type'       => 'text',
					'title'      => 'Footer Copiright',
					'default'    => '',
					'dependency' => array( 'style', 'any', 'paralax' ),
				),

				/* For Paralax Text template */
				array(
					'id'              => 'gallery_repeater',
					'type'            => 'group',
					'title'           => 'Gallery',
					'button_title'    => 'Add New',
					'accordion_title' => 'Add New Slide',
					'dependency'      => array( 'style', '==', 'paralax_text' ),
					'fields'          => array(
						array(
							'id'    => 'image',
							'type'  => 'image',
							'title' => 'Image',
						),
						array(
							'id'    => 'title',
							'type'  => 'text',
							'title' => 'Title',
						),
						array(
							'id'    => 'subtitle',
							'type'  => 'text',
							'title' => 'Subtitle',
						),
						array(
							'id'    => 'description',
							'type'  => 'textarea',
							'title' => 'Description',
						),
						array(
							'id'      => 'position',
							'type'    => 'select',
							'title'   => 'Position',
							'options' => array(
								'center' => 'Center',
								'left'   => 'Left',
								'right'  => 'Right',
							)
						),
					),
				),

				/* For Simple, Splited Screen, Slider */
				array(
					'id'         => 'show_details',
					'type'       => 'switcher',
					'title'      => 'Show Details',
					'default'    => true,
					'dependency' => array(
						'style',
						'any',
						'simple,splited_screen,slider,splited_creative_banner,before_after'
					),
				),

				/* Default For All*/
				array(
					'id'      => 'website',
					'type'    => 'select',
					'title'   => 'WebSite',
					'options' => array(
						''           => 'Default',
						'custom_url' => 'Custom WebSite url',
					),
					'default' => '',
				),

				array(
					'id'         => 'custom_url',
					'type'       => 'text',
					'title'      => 'Custom url',
					'default'    => '',
					'dependency' => array( 'website', '==', 'custom_url' ),
				),

				array(
					'id'      => 'style_header',
					'type'    => 'select',
					'title'   => 'Style header',
					'options' => array(
						'absolute' => 'Absolute',
						'static'   => 'Static',
					),
				),

				array(
					'id'      => 'header_color',
					'type'    => 'select',
					'title'   => 'Header Color',
					'options' => array(
						''      => 'Default from Theme Options',
						'light' => 'Light',
						'dark'  => 'Dark',
					),
				),

				array(
					'id'    => 'image_logo',
					'type'  => 'image',
					'title' => 'Site Logo',
				),

				array(
					'id'      => 'page_footer',
					'type'    => 'switcher',
					'title'   => 'Hide Footer',
					'default' => false,
				),
				array(
					'id'      => 'style_footer',
					'type'    => 'select',
					'title'   => 'Style footer',
					'options' => array(
						'default' => 'Default',
						'modern'  => 'Fixed',
						'copy'    => 'Copyrighted',
					),
				),
			)
		)
	)
);

CSFramework_Metabox::instance( $options );
