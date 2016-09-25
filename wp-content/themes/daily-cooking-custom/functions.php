<?php
/**
* Daily Cooking Custom functions and definitions.
*
* @package Daily Cooking Custom
*/

/**
* Set the content width based on the theme's design and stylesheet.
*/
if(!isset($content_width))
$content_width = 610; //pixels

if(!function_exists('daily_cooking_custom_setup')) :
  function daily_cooking_custom_setup() {
      //Make theme available for translation.
      //Translations can be filed in the /languages/ folder.
      load_theme_textdomain('daily-cooking-custom',
      get_template_directory().'/languages');
      //Adds RSS feed links to <head> for posts and comments.
      add_theme_support('automatic-feed-links');
      //Let WordPress manage the document title.
      /* By adding theme support, we declare that this theme does not
      use a hard-coded <title> tag in the document head, and expect
      WordPress to provide it for us. */
      add_theme_support('title-tag');
      //This theme uses wp_nav_menu() in one location.
      register_nav_menus(array(
        'primary' => __('Primary Menu', 'daily-cooking-custom'),
      ));
      //Switch default core markup for search form, comment form, and
      //comments to output valid HTML5.
      add_theme_support('html5', array(
      'search-form', 'comment-form', 'comment-list',
      'gallery', 'caption',
      ));
      //Enable support for Post Formats.
      add_theme_support('post-formats', array(
      'aside', 'image', 'video', 'quote', 'link',
      ));
      //Set up the WordPress core custom background feature.
      add_theme_support('custom-background', apply_filters(
      'daily_cooking_custom_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
      )));
  }
endif; //daily_cooking_custom_setup
add_action('after_setup_theme', 'daily_cooking_custom_setup');

function daily_cooking_custom_scripts() {
    wp_enqueue_style('daily-cooking-custom-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'daily_cooking_custom_scripts');

function daily_cooking_custom_posted_on() {
    $time_string = '<time class="entry-date published updated"
    datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    $time_string = '<time class="entry-date published"
    datetime="%1$s">%2$s</time><time class="updated"
    datetime="%3$s">%4$s</time>';
    }
    $time_string = sprintf( $time_string,
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_attr( get_the_modified_date( 'c' ) ),
    esc_html( get_the_modified_date() )
    );
    $posted_on = sprintf(
    _x( 'Posted on %s', 'post date', 'daily-cooking-custom' ),
    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'
    . $time_string . '</a>'
    );
    $byline = sprintf(
    _x( 'by %s', 'post author', 'daily-cooking-custom' ),
    '<span class="author vcard"><a class="url fn n" href="' .
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )
    ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );
    echo '<span class="posted-on">' . $posted_on . '</span><span
    class="byline"> ' . $byline . '</span>';
}

function daily_cooking_custom_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' == get_post_type() ) {
      $categories_list = get_the_category_list( __( ', ', 'dailycooking-custom' ) );
      if ( $categories_list &&
      daily_cooking_custom_categorized_blog() ) {
      printf( '<span class="cat-links">' . __( 'Posted in %1$s',
      'daily-cooking-custom' ) . '</span>', $categories_list );
      }
      $tags_list = get_the_tag_list( '', __( ', ', 'daily-cookingcustom' ) );
      if ( $tags_list ) {
      printf( '<span class="tags-links">' . __( 'Tagged %1$s',
      'daily-cooking-custom' ) . '</span>', $tags_list );
      }
    }
    if ( ! is_single() && ! post_password_required() && (
    comments_open() || get_comments_number() ) ) {
    echo '<span class="comments-link">';
    comments_popup_link(__('Leave a comment', 'daily-cookingcustom'), __('1 Comment', 'daily-cooking-custom'), __('%
    Comments', 'daily-cooking-custom'));
    echo '</span>';
    }
    edit_post_link( __( 'Edit', 'daily-cooking-custom' ), '<span
    class="edit-link">', '</span>' );
}


function daily_cooking_custom_widgets_init() {
register_sidebar(array(
'name' => __('Sidebar', 'daily-cooking-custom'),
'id' => 'sidebar-1',
'description' => '',
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h1 class="widget-title">',
'after_title' => '</h1>',
));
}
add_action('widgets_init', 'daily_cooking_custom_widgets_init');
