<?php
/*
 * Portfolio post type.
 */

function register_custom_post_type() {

	$services_url_slug = cs_get_option('services_url_slug') ? cs_get_option('services_url_slug') : 'services-item';
	$services_category_slug = cs_get_option('services_category_slug') ? cs_get_option('services_category_slug') : 'services-category';

	// New Post Type
	register_post_type( 'services',
	  array(
	    'labels' => array(
	        'name' => esc_html__( 'Services','prague-plugins'),
	        'singular_name' => esc_html__( 'Service','prague-plugins')
	    ), 
	    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
	    'menu_icon' => plugins_url( 'assets/repairing.png' , __FILE__ ),
	    'public' => true,
	    'has_archive' => true,
	    'rewrite' => array('slug' => $services_url_slug),
	  )
	);
	// New Taxonomy
	register_taxonomy(
	  'service-category',
	  'services',
	  array(
	    'label' => esc_html__( 'Categories','prague-plugins'),
	    'rewrite' => array( 'slug' => $services_category_slug ),
	    'hierarchical' => true,
	  )
	);

	// New Post Type
	$projects_url_slug = cs_get_option('projects_slug') ? cs_get_option('projects_slug') : 'projects-item';
	$projects_category_url_slug = cs_get_option('projects_category_slug') ? cs_get_option('projects_category_slug') : 'projects-category';

	register_post_type( 'projects',
	  array(
	    'labels' => array(
	        'name' => esc_html__( 'Projects','prague-plugins'),
	        'singular_name' => esc_html__( 'Project','prague-plugins')
	    ), 
	    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
	    'menu_icon' => plugins_url( 'assets/projects.png' , __FILE__ ),
	    'public' => true,
	    'has_archive' => true,
	    'rewrite' => array('slug' => $projects_url_slug),
	  )
	);
	// New Taxonomy
	register_taxonomy(
	  'projects-category',
	  'projects',
	  array(
	    'label' => esc_html__( 'Categories','prague-plugins'),
	    'rewrite' => array( 'slug' => $projects_category_url_slug ),
	    'hierarchical' => true,
	  )
	);

	// New Post Type
	register_post_type( 'books',
	  array(
	    'labels' => array(
	        'name' => esc_html__( 'Books','prague-plugins'),
	        'singular_name' => esc_html__( 'Book','prague-plugins')
	    ), 
	    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
	    'menu_icon' => plugins_url( 'assets/agenda.png' , __FILE__ ),
	    'public' => true,
	    'has_archive' => true,
	    'rewrite' => array('slug' => 'books-item'),
	  )
	);
	// New Taxonomy
	register_taxonomy(
	  'books-category',
	  'books',
	  array(
	    'label' => esc_html__( 'Categories','prague-plugins'),
	    'rewrite' => array( 'slug' => 'books-category' ),
	    'hierarchical' => true,
	  )
	);

	// New Post Type
	register_post_type( 'media',
	  array(
	    'labels' => array(
	        'name' => esc_html__( 'Media','prague-plugins'),
	        'singular_name' => esc_html__( 'Media item','prague-plugins')
	    ), 
	    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
	    'menu_icon' => plugins_url( 'assets/magazine.png' , __FILE__ ),
	    'public' => true,
	    'has_archive' => true,
	    'rewrite' => array('slug' => 'media-item'),
	  )
	);
	
	// New Taxonomy
	register_taxonomy(
	  'media-category',
	  'media',
	  array(
	    'label' => esc_html__( 'Categories','prague-plugins'),
	    'rewrite' => array( 'slug' => 'media-category' ),
	    'hierarchical' => true,
	  )
	);

	// New Post Type
	register_post_type( 'exihibitions',
	  array(
	    'labels' => array(
	        'name' => esc_html__( 'Exihibitions','prague-plugins'),
	        'singular_name' => esc_html__( 'Exihibition','prague-plugins')
	    ), 
	    'menu_icon' => plugins_url( 'assets/museum.png' , __FILE__ ),
	    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
	    'public' => true,
	    'has_archive' => true,
	    'rewrite' => array('slug' => 'exihibitions-item'),
	  )
	);

	
	// New Taxonomy
	register_taxonomy(
	  'exihibitions-category',
	  'exihibitions',
	  array(
	    'label' => esc_html__( 'Categories','prague-plugins'),
	    'rewrite' => array( 'slug' => 'exihibitions-category' ),
	    'hierarchical' => true,
	  )
	);

}

add_action(	'init', 'register_custom_post_type', 0);