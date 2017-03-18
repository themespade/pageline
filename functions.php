<?php
/**
 * PageLine functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

if ( ! function_exists( 'pageline_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pageline_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on PageLine, use a find and replace
	 * to change 'pageline' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'pageline', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	// Register image sizes for use in slider
	add_image_size( 'pageline-slider', 1920, 970, true );
	add_image_size( 'pageline-about', 585, 390, true );
	add_image_size( 'pageline-project', 375, 420, true );
	add_image_size( 'pageline-blog-post', 425, 285, true );
	add_image_size( 'pageline-post', 783, 480, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'pageline' ),
	) );

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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Adds Support for Custom Logo Introduced in WordPress 4.5
	add_theme_support( 'custom-logo',
		array(
    		'flex-width' => true,
    		'flex-height' => true,
    	)
    );


    // Declare WooCommerce Support
    add_theme_support( 'woocommerce' );

    // Adding excerpt option box for pages as well
	add_post_type_support( 'page', 'excerpt' );
}
endif;
add_action( 'after_setup_theme', 'pageline_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pageline_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pageline_content_width', 640 );
}
add_action( 'after_setup_theme', 'pageline_content_width', 0 );

if ( ! function_exists( 'pageline_fonts_url' ) ) :
/**
 * Register Google fonts for pageline.
 *
 * Create your own pageline_fonts_url() function to override in a child theme.
 *
 * @return string Google fonts URL for the theme.
 */
function pageline_fonts_url() {
  $fonts_url = '';
  $fonts = array();
  $subsets = 'latin,latin-ext';
  // applying the translators for the Google Fonts used
  /* Translators: If there are characters in your language that are not
   * supported by Roboto, translate this to 'off'. Do not translate
   * into your own language.
   */
  if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'pageline' ) ) {
     $fonts[] = 'Roboto:400,300,500,700,400italic';
  }

  // ready to enqueue Google Font
  if ( $fonts ) {
     $fonts_url = add_query_arg( array(
        'family' => urlencode( implode( '|', $fonts ) ),
        'subset' => urlencode( $subsets ),
     ), '//fonts.googleapis.com/css' );
  }
  return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function pageline_scripts() {

	// use of enqueued google fonts
	wp_enqueue_style( 'pageline-google-fonts', pageline_fonts_url(), array(), null );
	
	wp_enqueue_style( 'pageline-style', get_stylesheet_uri() );

	//Register font-awesome style
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.css', false, '4.6.3' );

	//Register owl.carousel style
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', false, '1.0.0' );

	//Register owl.theme.default style
	wp_enqueue_style( 'owl-theme-default', get_template_directory_uri() . '/css/owl.theme.default.css', false, '2.1.4' ); 

	//Register pageline responsive style
	wp_enqueue_style( 'pageline-responsive', get_template_directory_uri() . '/css/responsive.css', false, '1.0.0' );

	/// Register jQuery.page-scroll-to-id Script
	wp_enqueue_script( 'jquery-malihu-pagescroll2id', get_template_directory_uri() . '/js/jquery.malihu.PageScroll2id.js', array( 'jquery' ), '1.5.4', true );

	// Register owl.carousel Script
	wp_enqueue_script( 'jquery-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array( 'jquery' ), '2.0.0', true );
	// Waypoints Script
   wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.js', array( 'jquery' ), '2.0.3', true );
   // CounterUp Script
   wp_enqueue_script( 'counterup', get_template_directory_uri() . '/js/jquery.counterup.js', array( 'jquery' ), false, true );
	// Register pageline main Script
	wp_enqueue_script( 'pageline-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0.0', true );

	wp_enqueue_script( 'pageline-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'pageline-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pageline_scripts' );

/**
 * Add admin scripts and styles.
 */

function pageline_admin_scripts( $hook ) {
   global $post_type;
   if( $hook == 'widgets.php' || $hook == 'customize.php' ) {
 
    //For image uploader
    wp_enqueue_media();

    //For color
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );

   	wp_enqueue_style( 'pageline-admin-css', get_template_directory_uri() . '/css/admin/pageline-admin.css', false, '1.0.0' );

   	wp_enqueue_script( 'pageline-image-uploader', get_template_directory_uri() . '/js/image-uploader.js', array( 'jquery' ), '1.0.0', true );

   	wp_enqueue_script( 'pageline-color-picker', get_template_directory_uri() . '/js/color-picker.js', array( 'jquery' ), '1.0.0', true );
    
    wp_enqueue_script( 'pageline-admin-scripts', get_template_directory_uri() . '/js/admin/pageline-admin.js', array( 'jquery' ), '1.0.0', true );      
       
    }
}
add_action('admin_enqueue_scripts', 'pageline_admin_scripts');


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/pageline.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custome Widgts.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Custome metabox.
 */
require get_template_directory() . '/inc/admin/meta-boxes.php';

/**
 * Define URL Location Constants
 */
define( 'ANCHOR_PARENT_URL', get_template_directory_uri() );

define( 'ANCHOR_ADMIN_IMAGES_URL', ANCHOR_PARENT_URL . '/images/admin' );

