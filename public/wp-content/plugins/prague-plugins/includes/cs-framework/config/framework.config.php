<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} 

// FRAMEWORK SETTINGS
// ---------------------------------------------------------------------------------
$settings = array(
	'menu_title'      => 'Theme Options',
	'menu_type'       => 'menu',
	'menu_slug'       => 'cs-framework',
	'ajax_save'       => true,
	'show_reset_all'  => true,
	'framework_title' => 'Prague Options',
);

// FRAMEWORK OPTIONS
// ------------------------------------------------------------------------------- 
$options = array();

if (!function_exists('prague_get_all_slug_pages')) {
	function prague_get_all_slug_pages() {
		return array();
	}
}

$options[] = array(
	'name'   => 'general',
	'title'  => 'General',
	'icon'   => 'fa fa-cog',
	// begin: fields
	'fields' => array(
		array(
			'id'      => 'sidebar',
			'type'    => 'checkbox',
			'title'   => 'Show sidebar on pages:',
			'options' => array(
				'post' => 'Post',
				'blog' => 'Blog',
				'page' => 'Page'
			),
			'default'  => array( 'post', 'blog' )
		),
		array(
			'id'      => 'enable_lazy_load',
			'type'    => 'switcher',
			'title'   => 'Enable lazy load',
			'desc'    => 'This option is available for Images and Maps',
			'default' => true
		),
		array(
		  'id'    => 'enable_human_diff',
		  'type'  => 'switcher',
		  'title' => 'Enable Human Diff',
		),
		array(
			'type'    => 'subheading',
			'content' => 'Coming Soon Settings'
		),
		array(
		  'id'    => 'prague_enable_coming_soon',
		  'type'  => 'switcher',
		  'title' => 'Enable Coming Soon',
		),
		array(
		  'id'             => 'prague_page_coming_soon',
		  'type'           => 'select',
		  'title'          => 'Page Coming Soon',
		  'options'        => 'pages',
		  'query_args'    => array(
		      'sort_order'  => 'ASC',
		      'sort_column' => 'post_title',
		   ),
		),
		array(
			'type'    => 'subheading',
			'content' => 'Protected Settings'
		),
		array(
			'id'         => 'protected_subtitle',
			'type'       => 'text',
			'title'      => 'Protected subtitle',
			'multilang'  => true,
		),
		array(
			'id'         => 'protected_title',
			'type'       => 'text',
			'title'      => 'Protected title',
			'multilang'  => true,
		),
		array(
			'type'    => 'subheading',
			'content' => 'Main Info'
		),
		array(
			'id'         => 'main_title',
			'type'       => 'text',
			'title'      => 'Main Title',
			'multilang'  => true,
		),
		array(
		  'id'       => 'main_content',
		  'type'     => 'wysiwyg',
		  'title'    => 'Main Content',
		  'settings' => array(
		    'textarea_rows' => 5,
		    'tinymce'       => true,
		    'media_buttons' => false,
		  ),
		  'multilang'  => true,
		),
		array(
		  'id'        => 'main_header_image',
		  'type'      => 'image',
		  'title'     => 'Menu Header Image',
		),
		array(
		  'id'    => 'page_preloader',
		  'type'  => 'switcher',
		  'title' => 'Preloader',
		  'default' => false,
		),
		array(
			'id'      => 'page_preloader_type',
			'type'    => 'select',
			'title'   => 'Preloader type:',
			'options' => array(
				'default' => 'Default',
				'text' => 'Custom text',
				'image' => 'Custom image'
			),
			'default' => 'default',
			'dependency' => array( 'page_preloader', '==', true),
		),
		array(
			'id'      => 'preloader_image',
			'type'    => 'image',
			'title'   => 'Preloader Image',
			'default' => '',
			'dependency' => array( 'page_preloader|page_preloader_type', '==|==', 'true|image'),
		),
		array(
			'id'      => 'preloader_text',
			'type'    => 'text',
			'title'   => 'Preloader Text',
			'default' => 'Prague',
			'dependency' => array( 'page_preloader|page_preloader_type', '==|==', 'true|text'),
		),
	), // end: fields
);

// header
$options[] = array(
	'name'   => 'header_options',
	'title'  => 'Header',
	'icon'   => 'fa fa-bars',
	// begin: fields
	'fields' => array(
		array(
			'id'      => 'site_logo',
			'type'    => 'radio',
			'title'   => 'Type of site logo',
			'options' => array(
				'txtlogo' => 'Text Logo',
				'imglogo' => 'Image Logo',
			),
			'default' => array( 'imglogo' ),
		),
		array(
			'id'         => 'text_logo',
			'type'       => 'text',
			'title'      => 'Text Logo',
			'default'    => 'Prague',
			'dependency' => array( 'site_logo_txtlogo', '==', 'true' ),
		),
		array(
			'id'         => 'text_logo_style',
			'type'       => 'radio',
			'title'      => 'Text logo style',
			'options'    => array(
				'default' => 'Default',
				'custom'  => 'Custom',
			),
			'default'    => array( 'default' ),
			'dependency' => array( 'site_logo_txtlogo', '==', 'true' )
		),
		array(
			'id'         => 'text_logo_width',
			'type'       => 'text',
			'title'      => 'Max width logo section',
			'default'    => '70px',
			'dependency' => array( 'text_logo_style_custom|site_logo_txtlogo', '==|==', 'true|true' )
		),
		array(
			'id'         => 'text_logo_color',
			'type'       => 'color_picker',
			'title'      => 'Text Logo Color',
			'default'    => '#fff',
			'dependency' => array( 'text_logo_style_custom|site_logo_txtlogo', '==|==', 'true|true' )
		),
		array(
			'id'         => 'text_logo_font_size',
			'type'       => 'text',
			'title'      => 'Text logo font size',
			'desc'       => 'By default the logo have 20px font size',
			'default'    => '20px',
			'dependency' => array( 'text_logo_style_custom|site_logo_txtlogo', '==|==', 'true|true' )
		),
		array(
			'id'         => 'image_logo',
			'type'       => 'image',
			'title'      => 'Site Logo', 
			'dependency' => array( 'site_logo_imglogo', '==', 'true' ),
		),
		array(
			'id'         => 'img_logo_style',
			'type'       => 'radio',
			'title'      => 'Image logo style',
			'options'    => array(
				'default' => 'Default',
				'custom'  => 'Custom',
			),
			'default'    => array( 'default' ),
			'dependency' => array( 'site_logo_imglogo', '==', 'true' )
		),
		array(
			'id'         => 'img_logo_width',
			'type'       => 'text',
			'title'      => 'Site Logo Width Size*',
			'desc'       => 'By default the logo have 60px width size',
			'dependency' => array( 'img_logo_style_custom|site_logo_imglogo', '==|==', 'true|true' ),
		),
		array(
			'id'         => 'img_logo_height',
			'type'       => 'text',
			'title'      => 'Site Logo Height Size*',
			'desc'       => 'By default the logo have 52px height size',
			'dependency' => array( 'img_logo_style_custom|site_logo_imglogo', '==|==', 'true|true' )
		),
		array(
			'id'             => 'prague_header_form',
			'type'           => 'select',
			'title'          => 'Select Form Header',
			'options'        => prague_get_fd_forms(),
		),
		array(
			'id'             => 'prague_header_color',
			'type'           => 'select',
			'title'          => 'Header Color',
			'options'        => array(
			    'light'  => 'Light',
			    'dark'   => 'Dark',
            ),
		),
		array(
			'id'             => 'prague_header_style',
			'type'           => 'select',
			'title'          => 'Header Style',
			'options'        => array(
			    'simple'  	 => 'Simple',
			    'full'       => 'Full',
			    'left'       => 'Left',
            ),
		),
		array(
			'id'    => 'sticky_menu',
			'type'  => 'switcher',
			'title' => 'Sticky Menu',
			'default' => false,
			'dependency' => array( 'prague_header_style', '==', 'simple' )
		),
        array(
            'id'    => 'sticky_mobile_menu',
            'type'  => 'switcher',
            'title' => 'Sticky Mobile Menu',
            'default' => false,
            'dependency' => array( 'prague_header_style|sticky_menu', '==', 'simple|true' )
        ),
		array(
			'id'              => 'prague_header_social',
			'type'            => 'group',
			'title'           => 'Header Social Icon',
			'button_title'    => 'Add New',
			'accordion_title' => 'Add New Icon',
			'fields'          => array(
				array(
					'id'        => 'link',
					'type'      => 'text', 
					'title'     => 'Link',
				),
				array(
					'id'    => 'social_icon',
					'type'  => 'icon',
					'title' => 'Icon',
				),
				array(
					'id'    => 'show_social_icon',
					'type'  => 'switcher',
					'title' => 'Show/Hide',
				),
			),
			'default'  => array(
				array(
					'social_icon'      => 'fa fa-behance',
					'link'             => 'https://www.behance.net/',
					'show_social_icon' => true,
				),
				array(
					'social_icon'      => 'fa fa-dribbble',
					'link'             => 'https://dribbble.com/',
					'show_social_icon' => true,
				),
				array(
					'social_icon'      => 'fa fa-facebook',
					'link'             => 'http://facebook.com/',
					'show_social_icon' => true,
				),
				array(
					'social_icon'      => 'fa fa-pinterest',
					'link'             => 'https://pinterest.com',
					'show_social_icon' => true,
				),
			)
		),
	),
);

// Typography
$options[] = array(
	'name'   => 'typography',
	'title'  => 'Typography',
	'icon'   => 'fa fa-font',
	'fields'      => array(
		array(
			'type'    => 'heading',
			'content' => 'Typography Headings',
		),
		array(
			'id'              => 'heading',
			'type'            => 'group',
			'title'           => 'Typography Headings',
			'button_title'    => 'Add New',
			'accordion_title' => 'Add New',
			// begin: fields
			'fields'      => array(
				// header size
				array(
					'id'             => 'heading_tag',
					'type'           => 'select',
					'title'          => 'Title Tag',
					'options'        => array(
						'h1'             => esc_html__('H1','prague-plugins'),
						'h2'             => esc_html__('H2','prague-plugins'),
						'h3'             => esc_html__('H3','prague-plugins'),
						'h4'             => esc_html__('H4','prague-plugins'),
						'h5'             => esc_html__('H5','prague-plugins'),
						'h6'             => esc_html__('H6','prague-plugins'),
						'p'              => esc_html__('Paragraph','prague-plugins'),
					),
				),
				// font family
				array(
					'id'        => 'heading_family',
					'type'      => 'typography',
					'title'     => 'Font Family',
					'default'   => '',
				),
				// font size
				array(
					'id'          => 'heading_size',
					'type'        => 'text',
					'title'       => 'Font Size (in px)',
					'default'     => '',
				),
				// font color
				array(
					'id'      => 'heading_color',
					'type'    => 'color_picker',
					'title'   => 'Font Color',
				),
			),
		),
		array(
			'type'    => 'heading',
			'content' => 'Typography Menu',
		),
        // menu
        array(
            'type'    => 'subheading',
            'content' => 'Main Menu'
        ),
        array(
            'id'    => 'typography_menu_enable',
            'type'  => 'switcher',
            'title' => 'Enable/Disable Typography Menu',
            'default' => false,
        ),
        // font family
		array(
			'id'        => 'menu_item_family',
			'type'      => 'typography',
			'title'     => 'Menu Item Font Family',
			'default'   => '',
            'dependency' => array( 'typography_menu_enable', '==', 'true' ),
		),
		// font size
		array(
			'id'          => 'menu_item_size',
			'type'        => 'text',
			'title'       => 'Menu Item Font Size (in px)',
			'default'     => '',
            'dependency' => array( 'typography_menu_enable', '==', 'true' ),
		),
		// line height
		array(
			'id'          => 'menu_line_height',
			'type'        => 'text',
			'title'       => 'Menu Line Height',
			'default'     => '',
            'dependency' => array( 'typography_menu_enable', '==', 'true' ),
		),
		// font color
		array(
			'id'      => 'menu_item_color',
			'type'    => 'color_picker',
			'title'   => 'Menu Item Font Color',
            'dependency' => array( 'typography_menu_enable', '==', 'true' ),

		),
		//submenu
        array(
            'type'    => 'subheading',
            'content' => 'Submenu'
        ),
        array(
            'id'    => 'typography_submenu_enable',
            'type'  => 'switcher',
            'title' => 'Enable/Disable Typography Menu',
            'default' => false,
        ),
        // font family
		array(
			'id'        => 'submenu_item_family',
			'type'      => 'typography',
			'title'     => 'Submenu Item Font Family',
			'default'   => '',
            'dependency' => array( 'typography_submenu_enable', '==', 'true' ),
		),
		// font size
		array(
			'id'          => 'submenu_item_size',
			'type'        => 'text',
			'title'       => 'Submenu Item Font Size (in px)',
			'default'     => '',
            'dependency' => array( 'typography_submenu_enable', '==', 'true' ),
		),
		// line height
		array(
			'id'          => 'submenu_line_height',
			'type'        => 'text',
			'title'       => 'Submenu Line Height',
			'default'     => '',
            'dependency' => array( 'typography_submenu_enable', '==', 'true' ),
		),
		// font color
		array(
			'id'      => 'submenu_item_color',
			'type'    => 'color_picker',
			'title'   => 'Submenu Item Font Color',
            'dependency' => array( 'typography_submenu_enable', '==', 'true' ),
		),
		// button
		array(
			'type'    => 'heading',
			'content' => 'Typography Button',
		),
        array(
            'id'    => 'typography_btn_enable',
            'type'  => 'switcher',
            'title' => 'Enable/Disable Button Menu',
            'default' => false,
        ),
        // font family
		array(
			'id'        => 'all_button_font_family',
			'type'      => 'typography',
			'title'     => 'Button Font Family',
			'default'   => '',
            'dependency' => array( 'typography_btn_enable', '==', 'true' ),
		),
		// font size
		array(
			'id'          => 'all_button_font_size',
			'type'        => 'text',
			'title'       => 'Button Font Size (in px)',
			'default'     => '',
            'dependency' => array( 'typography_btn_enable', '==', 'true' ),
		),
		// line height
		array(
			'id'          => 'all_button_line_height',
			'type'        => 'text',
			'title'       => 'Button Line Height',
			'default'     => '',
            'dependency' => array( 'typography_btn_enable', '==', 'true' ),
		),
        // letter spacing
		array(
			'id'          => 'all_button_letter_spacing',
			'type'        => 'text',
			'title'       => 'Letter Spacing (in px)',
			'default' => '',
            'dependency' => array( 'typography_btn_enable', '==', 'true' ),
		),
        // font color
		array(
			'id'      	=> 'all_button_item_color',
			'type'    	=> 'color_picker',
			'title'   	=> 'Typography Font Color',
            'dependency' => array( 'typography_btn_enable', '==', 'true' ),
		),
	),
);

// Blog
$options[] = array(
	'name'   => 'blog_opt',
	'title'  => 'Blog',
	'icon'   => 'fa fa-cogs',
	// begin: fields
	'fields' => array(
		array(
			'id'         => 'blog_title',
			'title'      => 'Blog Title',
			'type'       => 'text',
			'multilang'  => true,
		),
		array(
			'id'         => 'blog_subtitle',
			'title'      => 'Blog Subtitle',
			'type'       => 'textarea',
			'multilang'  => true,
		),
		array(
			'id'         => 'blog_detail',
			'title'      => 'Blog detail button (read by default)',
			'type'       => 'text',
			'multilang'  => true,
		),
		array(
		  'id'        => 'blogs_image',
		  'type'      => 'image',
		  'title'     => 'Image for Blog Header',
		),
		array(
			'id'    => 'post_info',
			'type'  => 'switcher',
			'title' => 'Show/Hide Post Info',
		),
		array(
			'id'    => 'enable_load_more',
			'type'  => 'switcher',
			'title' => 'Enable Load More for Blog',
		),
		array(
			'id'      => 'post_navigation',
			'type'    => 'switcher',
			'title'   => 'Navigation in post item (for all posts)',
			'default' => false,
		),
	), // end: fields
);

// ----------------------------------------
// Ecommerce
// ----------------------------------------
$eccommerce_theme_options = apply_filters( 'eccommerce_theme_options', array() );
if ( ! empty( $eccommerce_theme_options ) ) {
    foreach ( $eccommerce_theme_options as $option ) {
        $options[] = $option;
    }
}

// Projects
$options[] = array(
	'name'   => 'projects_opt',
	'title'  => 'Projects',
	'icon'   => 'fa fa-photo',
	// begin: fields
	'fields' => array(
		array(
			'id'      => 'projects_slug',
			'type'    => 'text',
			'title'   => 'Projects Url Slug',
			'default' => '',
			'desc'    => 'Please update <a href="'.home_url('wp-admin/options-permalink.php').'">permalinks</a> after this. ' 
		),
		array(
			'id'      => 'projects_category_slug',
			'type'    => 'text',
			'title'   => 'Projects Url Category Slug',
			'default' => '',
			'desc'    => 'Please update <a href="'.home_url('wp-admin/options-permalink.php').'">permalinks</a> after this. ' 
		),
	), // end: fields
);

// Services
$options[] = array(
	'name'   => 'services_opt',
	'title'  => 'Services',
	'icon'   => 'fa fa-wrench',
	// begin: fields
	'fields' => array(
		array(
			'id'      => 'services_url_slug',
			'title'   => 'Services Url Slug',
			'type'    => 'text',
			'default' => '',
			'desc'    => 'Please update <a href="'.home_url('wp-admin/options-permalink.php').'">permalinks</a> after this. '
		),
		array(
			'id'      => 'services_category_slug',
			'type'    => 'text',
			'title'   => 'Services Url Category Slug',
			'default' => '',
			'desc'    => 'Please update <a href="'.home_url('wp-admin/options-permalink.php').'">permalinks</a> after this. '
		),
	), // end: fields
);

// footer
$options[] = array(
	'name'   => 'footer_options',
	'title'  => 'Footer',
	'icon'   => 'fa fa-bars',
	// begin: fields
	'fields' => array(
		array(
			'id'      => 'footer_logo',
			'type'    => 'radio',
			'title'   => 'Type of site logo',
			'options' => array(
				'txtlogo' => 'Text Logo',
				'imglogo' => 'Image Logo',
			),
			'default' => array( 'imglogo' ),
		),
		array(
			'id'         => 'footer_text_logo',
			'type'       => 'text',
			'title'      => 'Text Logo',
			'default'    => 'Prague',
			'dependency' => array( 'footer_logo_txtlogo', '==', 'true' ),
			'multilang'  => true,
		),
		array(
			'id'         => 'footer_image_logo',
			'type'       => 'image',
			'title'      => 'Footer Logo',
			'dependency' => array( 'footer_logo_imglogo', '==', 'true' ),
		),
		array(
			'id'      => 'footer_image',
			'type'    => 'image',
			'title'   => 'Footer Image', 
		),
		array(
		  'id'       => 'footer_content',
		  'type'     => 'wysiwyg',
		  'title'    => 'Footer Content',
		  'settings' => array(
		    'textarea_rows' => 5,
		    'tinymce'       => true,
		    'media_buttons' => false,
		  ),
		  'multilang'  => true,
		),
		array(
			'id'         => 'footer_copyright',
			'type'       => 'text',
			'title'      => 'Footer Copyright',
			'multilang'  => true,
		),
		array(
			'id'      => 'footer_social_show',
			'type'    => 'switcher',
			'title'   => 'Footer show socials',
			'label'   => '',
			'default' => 1,
		),
		array(
			'id'              => 'prague_footer_social',
			'type'            => 'group',
			'title'           => 'Footer Social Icon',
			'button_title'    => 'Add New',
			'accordion_title' => 'Add New Icon',
			'fields'          => array(
				array(
					'id'        => 'link',
					'type'      => 'text', 
					'title'     => 'Link',
				),
				array(
					'id'    => 'social_icon',
					'type'  => 'icon',
					'title' => 'Icon',
				),
				array(
					'id'    => 'show_social_icon',
					'type'  => 'switcher',
					'title' => 'Show/Hide',
				),
			),
			'default'         => array(
				array(
					'social_icon'      => 'fa fa-facebook',
					'link'             => 'http://facebook.com/',
					'show_social_icon' => true,
				),
				array(
					'social_icon'      => 'fa fa-twitter',
					'link'             => 'http://twitter.com',
					'show_social_icon' => true,
				),
				array(
					'social_icon'      => 'fa fa-instagram',
					'link'             => 'https://www.instagram.com/',
					'show_social_icon' => true,
				),
				array(
					'social_icon'      => 'fa fa-google-plus',
					'link'             => 'https://plus.google.com/',
					'show_social_icon' => true,
				),
			)
		),
	)
);

// 404 page
$options[] = array(
	'name'   => 'page-error-404',
	'title'  => '404 page',
	'icon'   => 'fa fa-exclamation-circle',
	// begin: fields
	'fields' => array(
		array(
		  'id'        => 'image_bg',
		  'type'      => 'image',
		  'title'     => 'Image Background',
		),
		array(
			'id'         => 'error_subtitle',
			'type'       => 'text',
			'title'      => 'Error subtitle',
			'multilang'  => true,
		),
		array(
			'id'         => 'error_title',
			'type'       => 'text',
			'title'      => 'Error title',
			'multilang'  => true,
		),
		array(
			'id'         => 'error_btn_text',
			'type'       => 'text',
			'title'      => 'Error button text',
			'multilang'  => true,
		),
	), // end: fields
);

// Custom css
$options[] = array(
	'name'   => 'custom_css',
	'title'  => 'Custom Css and JavaScript',
	'icon'   => 'fa fa-paint-brush',
	'fields' => array(
		array(
			'id'    => 'custom_css_styles',
			'desc'  => 'Only CSS, without tag &lt;style&gt;.',
			'type'  => 'textarea',
			'title' => 'Custom css code'
		),
		array(
			'id'    => 'custom_js_scripts',
			'desc'  => 'Only JS code, without tag &lt;script&gt;.',
			'type'  => 'textarea',
			'title' => 'Custom JavaScript code'
		)
	)
);

// ------------------------------
// backup                       -
// ------------------------------
$options[] = array(
	'name'   => 'backup_section',
	'title'  => 'Backup',
	'icon'   => 'fa fa-shield',
	'fields' => array(
		array(
			'type'    => 'notice',
			'class'   => 'warning',
			'content' => 'You can save your current options. Download a Backup and Import.',
		),
		array(
			'type' => 'backup',
		),
	)
);

CSFramework::instance( $settings, $options );
