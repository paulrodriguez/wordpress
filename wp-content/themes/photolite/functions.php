<?php
/**
 * Photolite functions and definitions
 *
 * @package Photolite
 */

if ( ! function_exists( 'photolite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function photolite_setup() {

	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'photolite', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 150,
		'width'       => 150,
		'flex-height' => true,
	) );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'editor-style.css', photolite_font_url() ) );
	add_image_size('photolite-homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'photolite' ),
		'footer'	=> esc_html__('Footer Menu', 'photolite'),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
}
endif; // photolite_setup
add_action( 'after_setup_theme', 'photolite_setup' );


function photolite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'photolite' ),
		'description'   => esc_html__( 'Appears on blog page sidebar', 'photolite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'photolite' ),
		'description'   => esc_html__( 'Appears on page sidebar', 'photolite' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'photolite_widgets_init' );

if ( ! function_exists( 'photolite_font_url' ) ) :

function photolite_font_url(){
		$font_url = '';

		/* Translators: If there are any character that are
		* not supported by Roboto Condensed, translate this to off, do not
		* translate into your own language.
		*/
		$robotocd = _x('on', 'Roboto Condensed font:on or off','photolite');

		/* Translators: If there are any character that are
		* not supported by Tangerine, translate this to off, do not
		* translate into your own language.
		*/
		$tang = _x('on', 'Tangerine font:on or off','photolite');

		if('off' !== $robotocd || 'off' !==  $tang){
			$font_family = array();

			if('off' !== $robotocd){
				$font_family[] = 'Roboto Condensed:300,400,600,700,800,900';
			}

			if('off' !== $tang){
				$font_family[] = 'Tangerine:400,700';
			}

			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);

			$font_url = add_query_arg($query_args,'https://fonts.googleapis.com/css');
		}

	return $font_url;
	}
endif;

function photolite_scripts() {
	wp_enqueue_style( 'photolite-font', photolite_font_url(), array() );
	wp_enqueue_style( 'photolite-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'photolite-responsive-style', get_template_directory_uri().'/css/theme-responsive.css' );
	wp_enqueue_style( 'photolite-nivo-style', get_template_directory_uri().'/css/nivo-slider.css' );
	if (is_front_page() ) {
		wp_enqueue_script( 'photolite-nivo-slider', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	}
	wp_enqueue_script( 'photolite-customscripts', get_template_directory_uri() . '/js/custom.js', array('jquery') );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'photolite_scripts' );

function photolite_custom_head_codes() {
		if(!is_home() || !is_front_page()) {
		echo "<style>";
			echo ".header{position:relative;}";
		echo "</style>";
		}
}
add_action('wp_head', 'photolite_custom_head_codes');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load custom functions file.
 */
//require get_template_directory() . '/inc/custom-functions.php';

define('photolite_pro_theme_url','https://flythemes.net/wordpress-themes/photolite-wordpress-theme/');
define('photolite_theme_doc','http://flythemesdemo.net/documentation/photolite-doc/');
define('photolite_site_url','https://flythemes.net/');

function photolite_credit_link(){
		return esc_html__('Photolite theme by','photolite'). "<a href=".esc_url(photolite_site_url)." target='_blank'> Flythemes</a>";
	}
