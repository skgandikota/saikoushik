<?php 

if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

if (!function_exists('smartwp_theme_setup')) :

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Sets up theme defaults and registers support for various WordPress features.
// Note that this function is hooked into the after_setup_theme hook, which
// runs before the init hook. The init hook is too late for some features, such
// as indicating support for post thumbnails.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

    function smartwp_theme_setup(){
       
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Make theme available for translation.
        // Translations can be filed in the /languages/ directory.
        // If you're building a theme based on smartwp, use a find and replace
        // to change 'smartwp' to the name of your theme in all the template files
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        load_theme_textdomain('smartwp', get_template_directory() . '/languages');
        

        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Add default posts and comments RSS feed links to head.
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        add_theme_support('automatic-feed-links');


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Supporting title tag
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        add_theme_support('title-tag');

        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // theme support
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
         add_theme_support( 'custom-background');
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Enable support for Post Thumbnails on posts and pages.
        // See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-          
        add_theme_support('post-thumbnails');


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // default post thumbnail size
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        set_post_thumbnail_size(1140);
        
        add_image_size('smartwp-blog-thumbnail', 750, 350, TRUE);


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // This theme uses wp_nav_menu() in one locations.
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        register_nav_menus(array(
           'primary' => esc_html__('Primary Menu', 'smartwp'),
           'one-page' => esc_html__('One Page Menu', 'smartwp')
        ) );


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Switch default core markup for search form, comment form, and comments
        // to output valid HTML5.
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ));


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Enable support for Post Formats.
        // See: https://codex.wordpress.org/Post_Formats
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-          
        add_theme_support('post-formats', array('aside', 'status', 'image', 'audio', 'video', 'gallery', 'quote', 'link', 'chat' ));


        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Support editor style
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

        add_editor_style();

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 32,
            'width'       => 154,
        ) );

    }

    add_action('after_setup_theme', 'smartwp_theme_setup');

endif; // smartwp_theme_setup

    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    //  Theme option, bootstrap-navwalker
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

    require get_template_directory() . "/admin/admin-init.php";
    require get_template_directory() . "/inc/navwalker.php";
    require get_template_directory() . "/inc/mobile-navwalker.php";


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Set the content width in pixels, based on the theme's design and stylesheet.
// Priority 0 to make it available to lower priority callbacks.
// @global int $content_width
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (!function_exists('smartwp_content_width')) :
    function smartwp_content_width() {
        $GLOBALS['content_width'] = apply_filters( 'smartwp_content_width', 1140 );
    }
    add_action( 'after_setup_theme', 'smartwp_content_width', 0 );
endif;
    

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Register widget area.
// @link https://codex.wordpress.org/Function_Reference/register_sidebar
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (!function_exists('smartwp_widgets_init')) :

    function smartwp_widgets_init() {

    	do_action('smartwpo_before_register_sidebar');

        register_sidebar( apply_filters( 'smartwp_blog_sidebar', array(
            'name'          => esc_html__('Blog Sidebar', 'smartwp'),
            'id'            => 'smartwp-blog-sidebar',
            'description'   => esc_html__('Appears in the blog sidebar.', 'smartwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )));

         register_sidebar( apply_filters( 'smartwp_page_sidebar', array(
            'name'          => esc_html__('Page Sidebar Area', 'smartwp'),
            'id'            => 'smartwp-page-sidebar',
            'description'   => esc_html__('Appears in the Page sidebar.', 'smartwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )));

        register_sidebar( apply_filters( 'footer_sidebar', array(
            'name'          => esc_html__('Footer Sidebar Area', 'smartwp'),
            'id'            => 'footer-sidebar',
            'description'   => esc_html__('Appears in the footer', 'smartwp'),
            'before_widget' => '<div id="%1$s" class="col-md-3 col-sm-6 widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )));


        do_action('smartwp_after_register_sidebar');
    }

    add_action('widgets_init', 'smartwp_widgets_init');
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Load Google Font If Redux framework is not activated.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( ! function_exists( 'smartwp_fonts_url' ) ):
    function smartwp_fonts_url() {
        $font_url = '';
        if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'smartwp' ) ) :
            $font_url = add_query_arg(
                array(
                    'family' => urlencode( 'Open Sans:300,400,600,700,800,900|Roboto Slab:400,700' ),
                    'subset' => 'latin',
                ), "//fonts.googleapis.com/css" );
        endif;
        return apply_filters( 'smartwp_google_font_url', esc_url( $font_url ) );
    }
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Enqueue scripts and styles.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if (!function_exists('smartwp_scripts')) :
    
    function smartwp_scripts() {

        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // Styles
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        wp_enqueue_style('smartwp-google-font', smartwp_fonts_url(), array(), NULL);
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.7.0');
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.7');
        wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array(), NULL);
        wp_enqueue_style('smartwp-stylesheet', get_stylesheet_uri());
        wp_enqueue_style('smartwp-responsive-css', get_template_directory_uri() . '/css/responsive.css', array(), NULL);
        

        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        // scripts
        //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '3.3.7', TRUE);
        wp_enqueue_script('smartwp-plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('smartwp-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), NULL, TRUE);
        wp_localize_script( 'smartwp-scripts', 'smartwpObject', apply_filters( 'smartwp_js_object', array(
            'sticky_menu'    =>  true
		) ) );

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

    }

    add_action('wp_enqueue_scripts', 'smartwp_scripts');
endif;


//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Custom template tags for this theme.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
require get_template_directory() . "/inc/template-tags.php";
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// tgm for required plugin
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
require get_template_directory() . "/inc/class-tgm-plugin-activation.php";
require get_template_directory() . "/inc/required-plugin.php";

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// style
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
require get_template_directory() . "/inc/custom-style.php";

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function smartwp_skip_link_focus_fix() {
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
    ?>
    <script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
    </script>
    <?php
}
add_action( 'wp_print_footer_scripts', 'smartwp_skip_link_focus_fix' );

  //  demo import
  //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
 require get_template_directory() . '/inc/demo-import.php';