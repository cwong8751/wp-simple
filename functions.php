<?php
/**
 * Functions and definitions
 *
 */

/*
 * Let WordPress manage the document title.
 */
add_theme_support( 'title-tag' );

/*
 * Enable support for Post Thumbnails on posts and pages.
 */
add_theme_support( 'post-thumbnails' );

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support( 'html5', array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
) );

/** 
 * Include primary navigation menu
 */
function nav_init() {
	register_nav_menus( array(
		'menu-1' => 'Primary Menu',
	) );
}
add_action( 'init', 'nav_init' );

/**
 * Register widget area.
 *
 */
function widgets_init() {
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => 'Add widgets',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/assets/css/style.css' );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js' );
}
add_action( 'wp_enqueue_scripts', 'scripts' );

function create_post_custom_post() {
	register_post_type('custom_post', 
		array(
		'labels' => array(
			'name' => __('Custom Post', 'untheme'),
		),
		'public'       => true,
		'hierarchical' => true,
		'supports'     => array(
			'title',
			'editor',
			'excerpt',
			'custom-fields',
			'thumbnail',
		), 
		'taxonomies'   => array(
				'post_tag',
				'category',
		) 
	));
}
add_action('init', 'create_post_custom_post'); // Add our work type