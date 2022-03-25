<?php
/**
 * Action Config - Theme setting
 *
 * @package prague
 * @since 1.0.0
 *
 */

// ------------------------------------------
// Global actions for theme
// ------------------------------------------
add_action( 'widgets_init',       'prague_register_sidebar' );
add_action( 'wp_enqueue_scripts', 'prague_enqueue_scripts');
add_action( 'tgmpa_register',     'prague_include_required_plugins' );
add_action( 'template_redirect', 'prague_redirect_coming_soon' ); 
add_action( 'wp_ajax_nopriv_prague_dynamic_css', 'prague_dynamic_css' );
add_action( 'wp_ajax_prague_dynamic_css', 'prague_dynamic_css' );
add_action( 'admin_notices', 'prague_coming_soon_notice' ); 
add_action( 'wp', 'prague_single_flip_book' ); 


// ------------------------------------------
// Global filters for theme
// ------------------------------------------
add_filter( 'body_class', 'prague_body_classes');
add_filter( 'the_password_form', 'prague_password_form' );
add_filter( 'excerpt_more', 'prague_excerpt_more' );
add_filter( 'post_class', 'prague_post_class' ) ;
add_filter( 'embed_oembed_html', 'prague_oembed_filter', 99, 4 ) ;
add_filter( 'excerpt_length', 'prague_custom_excerpt_length', 999 );


// cs framework missing
if ( ! function_exists( 'cs_get_option' ) ) {
	function cs_get_option() {
		return '';
	}

	function cs_get_customize_option() {
		return '';
	}
}

if ( ! function_exists( 'cs_get_multilang_option' ) ) {
	function cs_get_multilang_option()
	{
		return '';
	}
}

// ------------------------------------------
// Function for add actions
// ------------------------------------------
/** Function for register sidebar */
if ( ! function_exists( 'prague_register_sidebar' ) ) {
	function prague_register_sidebar() {
		// register main sidebars
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar' , 'prague' ),
				'before_widget' => '<div class="prague-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="prague-title-w">',
				'after_title'   => '</h3>',
				'description'   => esc_html__( 'Drag the widgets for Deafult sidebars.', 'prague' )
			)
		);
		// register footer sidebars is active
		if ( cs_get_option('footer_sidebar') ) {
			register_sidebar(
				array(
					'id'            => 'footer-sidebar',
					'name'          => esc_html__( 'Footer sidebar' , 'prague' ),
					'before_widget' => '<div class="prague-widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="prague-title-w">',
					'after_title'   => '</h3>',
					'description'   => esc_html__( 'Drag the widgets for Footer sidebars.', 'prague' )
				)
			);
		}
		register_sidebar(
			array(
				'id'            => 'footer_simple_sidebar',
				'name'          => esc_html__( 'Footer Simple Sidebar', 'prague' ),
				'before_widget' => '<div id="%1$s" class="prague-footer__sidebar-item"><div class="prague-footer__sidebar-item--wrap">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h4 class="prague-footer__title">',
				'after_title'   => '</h4>',
				'description'   => esc_html__( 'Drag the widgets for simple footer sidebars.', 'prague' )
			)
		);
        register_sidebar(
            array(
                'id'            => 'shop-sidebar',
                'name'          => esc_html__( 'Shop sidebar' , 'prague' ),
                'before_widget' => '<div class="prague-widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="prague-title-w">',
                'after_title'   => '</h3>',
                'description'   => esc_html__( 'Drag the widgets for Shop sidebars.', 'prague' )
            )
        );
	}
}

/* Include fonts from google font */
if ( ! function_exists( 'prague_fonts_url' ) ) {
    function prague_fonts_url() {
        $font_url = '';
        /*
        Translators: If there are characters in your language that are not supported
        by chosen font(s), translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'prague' ) ) {
            $fonts = array(
                'Roboto:400,100,300,500,700',
            );

            $font_url = add_query_arg( 'family',
                urlencode( implode( '|', $fonts ) . "&subset=latin,latin-ext" ), "//fonts.googleapis.com/css" );
        }
        return $font_url;
    }
}

/* Loads all the js and css script to frontend */
if ( ! function_exists( 'prague_enqueue_scripts' ) ) {
	function prague_enqueue_scripts() {
		// general settings
		if ( ( is_admin() ) ) { return; }

		// prague options
		$prague = wp_get_theme();

		global $post;

		/* Enqueue Scripts */
		wp_enqueue_script( 'swiper', PRAGUE_URI . '/assets/js/swiper.min.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'file-picker', PRAGUE_URI . '/assets/js/file-picker.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'isotope', PRAGUE_URI . '/assets/js/isotope.pkgd.min.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'tweenMax', PRAGUE_URI . '/assets/js/tweenMax.min.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script('prague-vivus', PRAGUE_URI . '/assets/js/vivus.min.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script('slick', PRAGUE_URI . '/assets/js/slick.min.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true ); 

        wp_enqueue_script('magnific-popup', PRAGUE_URI . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'hammer', PRAGUE_URI . '/assets/js/hammer.min.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'prague-foxlazy', PRAGUE_URI . '/assets/js/foxlazy.min.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'prague-theme-js', PRAGUE_URI . '/assets/js/all.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'prague-kenburn-js', PRAGUE_URI . '/assets/js/kenburn.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'prague-multiscroll', PRAGUE_URI . '/assets/js/jquery.multiscroll.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'prague-countT-js', PRAGUE_URI . '/assets/js/countTo.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'prague-skills-js', PRAGUE_URI . '/assets/js/skills.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'prague-parallax', PRAGUE_URI . '/assets/js/parallax.min.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'prague-owlcarousel', PRAGUE_URI . '/assets/js/owlcarousel.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'prague-split-slider', PRAGUE_URI . '/assets/js/split-slider.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'prague-banner-slider', PRAGUE_URI . '/assets/js/banner_slider.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

		wp_enqueue_script( 'prague-youtube', 'https://www.youtube.com/iframe_api', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );

        wp_enqueue_script( 'prague-wow', PRAGUE_URI . '/assets/js/wow.min.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );


        if ( cs_get_option( 'enable_lazy_load' ) ) {
			wp_localize_script( 'prague-theme-js', 'enable_foxlazy',
				array(
					'ajaxurl' => esc_url(admin_url( 'admin-ajax.php' )),
				)
			);
		}

//		if (is_single() && get_post_type($post) == 'projects' ) {
			wp_enqueue_script( 'prague-before-after', PRAGUE_URI . '/assets/js/before-after.min.js', array( 'jquery' ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ), true );
//		}

		/* Add Custom JS */
		if ( cs_get_option( 'custom_js_scripts' ) ) {
			wp_add_inline_script( 'prague-theme-js', cs_get_option( 'custom_js_scripts' ) );
		}

		// add TinyMCE style
		add_editor_style();

		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/* Enqueue Style */
		wp_enqueue_style( 'swiper', PRAGUE_URI . '/assets/css/swiper.min.css', array( ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		wp_enqueue_style( 'slick', PRAGUE_URI . '/assets/css/slick.min.css', array( ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		wp_enqueue_style( 'owl', PRAGUE_URI . '/assets/css/owlcarousel.css', array( ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		wp_enqueue_style( 'magnific-popup', PRAGUE_URI . '/assets/css/magnific-popup.css', array( ), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		wp_enqueue_style( 'prague-fonts', prague_fonts_url(), array(), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		wp_enqueue_style( 'prague-core-css', 	PRAGUE_URI .'/style.css', array(), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		wp_enqueue_style( 'font-awesomes', PRAGUE_URI . '/assets/css/font-awesome.min.css', array(), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		wp_enqueue_style( 'ionicons', PRAGUE_URI . '/assets/css/ionicons.min.css', array(), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		wp_enqueue_style( 'et-line-font',  PRAGUE_URI . '/assets/css/et-line-font.css', array(), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

//		if (is_single() && get_post_type($post) == 'projects' ) {
			wp_enqueue_style( 'prague-before-after', PRAGUE_URI .'/assets/css/before-after.min.css', array(), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );
//		}
		
		wp_enqueue_style( 'bootstrap', PRAGUE_URI .'/assets/css/bootstrap.min.css', array(), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		// register style
		wp_enqueue_style( 'prague-unit-test', 	PRAGUE_URI .'/assets/css/unit-test.css', array(), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		wp_enqueue_style( 'prague-theme-css', 	PRAGUE_URI .'/assets/css/style.min.css', array(), apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		wp_enqueue_style( 'prague-dynamic-css', esc_url(admin_url( 'admin-ajax.php' )) . '?action=prague_dynamic_css', '',apply_filters( 'prague_version_filter', $prague->get( 'Version' ) ) );

		if ( cs_get_option('heading') ) {
			foreach (cs_get_option('heading') as $key => $title) {
				if ( empty( $title['heading_family'] )) continue;
				$font_family = $title['heading_family'];
				if(! empty($font_family['family']) ) {
					wp_enqueue_style( sanitize_title_with_dashes($font_family['family']), '//fonts.googleapis.com/css?family=' . $font_family['family'] . ':' . $title['heading_family']['variant'].'' );
				}
			}
		}

        if ( cs_get_option('typography_menu_enable') || cs_get_option('typography_submenu_enable') || cs_get_option('typography_btn_enable') ) {
            $array_family = array('menu_item_family', 'submenu_item_family', 'all_button_font_family');

            foreach ($array_family as $family) {
                $item_family = cs_get_option($family);
                if (!empty($item_family)) {
                    wp_enqueue_style(sanitize_title_with_dashes($item_family['family']), '//fonts.googleapis.com/css?family=' . $item_family['family'] . ':' . $item_family['variant'] . '');
                }
            }
        }
	}
}

/* For Coming Soon */
if (!function_exists('prague_redirect_coming_soon')) {
	function prague_redirect_coming_soon() {
		if ( cs_get_option('prague_enable_coming_soon') && cs_get_option('prague_page_coming_soon') && !is_admin_bar_showing() ) {

			$redirect_permalink = get_permalink( cs_get_option('prague_page_coming_soon') );
			if ( get_permalink() != $redirect_permalink ){
				wp_redirect( get_permalink( cs_get_option('prague_page_coming_soon') ) );
				exit();
			}
		}
	}
}

/* Notice for Coming Soon */
if ( ! function_exists( 'prague_coming_soon_notice' ) ) {
	function prague_coming_soon_notice() {
		if ( cs_get_option('prague_enable_coming_soon') ) {
			?>
			<div class="notice-warning notice">
				<p><strong>
				<?php echo esc_html__( 'Your "Coming Soon" option is enabled now.', 'prague' );
				?></strong></p></div>
			<?php
		}
	}
}

/* For Protected Page */
if (! function_exists('prague_password_form') ) {
	function prague_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		ob_start();
		?>
		<form class="prague-protected-form" action="<?php echo esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ); ?>" method="post">
			<input name="post_password" id="<?php echo esc_attr( $label ); ?>" type="password" placeholder="<?php esc_attr_e('Enter password here', 'prague'); ?>">
			<button type="submit" class="protected-btn a-btn-2 creative"><span class="a-btn-line"></span><?php esc_html_e('SUBMIT', 'prague'); ?></button>
		</form>
		<?php 
		return ob_get_clean();
	}
}

/** Include required plugins */
if ( ! function_exists( 'prague_include_required_plugins' ) ) {
	function prague_include_required_plugins() {
		$plugins = array(
			array(
				'name'                  => esc_html__( 'WPBakery Page Builder', 'prague' ), // The plugin name
				'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
				'source'                => esc_url('http://download-plugins.viewdemo.co/premium-plugins/js_composer.zip'), // The plugin source
				'required'              => true, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'                  => esc_html__( 'Prague Plugins', 'prague' ), // The plugin name
				'slug'                  => 'prague-plugins', // The plugin slug (typically the folder name)
				'source'                => esc_url('http://download-plugins.viewdemo.co/prague/prague-plugins.zip'), // The plugin source
				'required'              => true, // If false, the plugin is only 'recommended' instead of required
				'version'               => '2.1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'                  => esc_html__( 'Image Map Pro', 'prague' ), // The plugin name
				'slug'                  => 'image-map-pro-wordpress', // The plugin slug (typically the folder name)
				'source'                => esc_url('http://download-plugins.viewdemo.co/premium-plugins/image-map-pro-wordpress.zip'), // The plugin source
				'required'              => true, // If false, the plugin is only 'recommended' instead of required
				'version'               => '3.0.22', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'                  => esc_html__( 'UpQode Google Maps', 'prague' ), // The plugin name
				'slug'                  => 'upqode-google-maps', // The plugin slug (typically the folder name)
				'source'                => '', // The plugin source
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'                  => esc_html__( 'PixFields', 'prague' ), // The plugin name
				'slug'                  => 'pixfields', // The plugin slug (typically the folder name)
				'source'                => '', // The plugin source
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name' => esc_html__( 'WooCommerce', 'prague' ),
				'slug' => 'woocommerce',
				'required' => false,
				'version' => '',
				'force_activation' => false,
				'force_deactivation' => false,
				'external_url' => ''
			),
			array(
				'name'                  => esc_html__( 'MailChimp for WordPress', 'prague' ), // The plugin name
				'slug'                  => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
				'source'                => '', // The plugin source
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> esc_html__( 'Formidable Forms', 'prague' ), // The plugin name
				'slug'     				=> 'formidable', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
                'name'                    => esc_html__( 'Revolution Slider', 'prague' ),
                'slug'                    => 'revslider',
                'source'                => esc_url('http://download-plugins.viewdemo.co/premium-plugins/revslider.zip'), // The plugin source
                'required'                => false,
                'version'                => '',
                'force_activation'        => false,
                'force_deactivation'    => false,
                'external_url'            => ''
            ),
			array(
                'name'                    => esc_html__( 'Real3d Flipbook', 'prague' ),
                'slug'                    => 'real3d-flipbook',
                'source'                => esc_url('http://download-plugins.viewdemo.co/premium-plugins/real3d-flipbook.zip'), // The plugin source
                'required'                => false,
                'version'                => '',
                'force_activation'        => false,
                'force_deactivation'    => false,
                'external_url'            => ''
            ),
			array(
				'name'               => esc_html__( 'The Grid', 'prague' ), // The plugin name
				'slug'               => 'the_grid', // The plugin slug (typically the folder name)
				'source'             => esc_url( 'http://download-plugins.viewdemo.co/premium-plugins/the_grid.zip' ), // The plugin source
				'required'           => true, // If false, the plugin is only 'recommended' instead of required
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '',// If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => esc_html__('Gutenberg Blocks Collection', 'prague'), // The plugin name
				'slug'               => 'qodeblock', // The plugin slug (typically the folder name)
				'required'           => true, // If false, the plugin is only 'recommended' instead of required
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
		);

		// Change this to your theme text domain, used for internationalising strings
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'id'           => 'prague',                // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

/* Custom row styles for onepage site type */
if ( ! function_exists('prague_dynamic_css' ) ) {
  function prague_dynamic_css() {
    require_once PRAGUE_T_PATH . '/assets/css/custom.css.php';
    wp_die();
  }
}

/* renrder flipbook page  */
if ( ! function_exists('prague_single_flip_book')) {
	function prague_single_flip_book() {
		global $post;
		if (  is_single( $post ) && strpos( $post->post_content, 'real3dflipbook' ) ) : ?>
			<?php 
			wp_head(); 
			echo wp_kses_post( do_shortcode( $post->post_content ) ); 
			wp_footer();
			die();
			?> 
		<?php endif;
	}
}

/* add custom class to body */
if ( ! function_exists('prague_body_classes')) {
	function prague_body_classes($classes) {
		if ( !function_exists( 'cs_framework_init' ) ) {
			$classes[] = 'disable-prague-plugin';
		}
		return $classes;
	}
}

/* add wrapper to all oembed data to post detail */
if ( ! function_exists( 'prague_oembed_filter' ) ) {
	function prague_oembed_filter($html, $url, $attr, $post_ID) {
		if (!is_single()) return $html;
	    ob_start(); 
	    ?>
	    <div class="prague-iframe-wrapper">
	        <?php 
	        echo $html; 
	        ?>
	    </div>
	    <?php
	    return ob_get_clean();
	}
}

/**
 * Filter the except length to 20 characters.
 */
if ( ! function_exists( 'prague_custom_excerpt_length' ) ) {
	function prague_custom_excerpt_length()
	{
	    return 20;
	}
}

/* remove read more but read more isset blog */
if ( !function_exists('prague_excerpt_more')) {
	function prague_excerpt_more()
	{
		return "";
	}
}

/* add custom class to post item */
if ( !function_exists('prague_post_class')) {
	function prague_post_class($classes)
	{
		if( is_home() || is_search() ){
			$classes[] = 'blog-post col-sm-6 col-xs-12 js-filter-simple-block';
		}
		return $classes;
	}
}



// Add backend styles for Gutenberg.
add_action( 'enqueue_block_editor_assets', 'prague_add_gutenberg_assets' );

function prague_add_gutenberg_assets() {
	// Load the theme styles within Gutenberg.

	wp_enqueue_style( 'font-awesomes', get_theme_file_uri( '/assets/css/font-awesome.min.css' ), false );
	wp_enqueue_style( 'prague-gutenberg', get_theme_file_uri( '/assets/css/gutenberg-editor-style.min.css' ), false );
}
