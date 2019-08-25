<?php
/**
 * Beauty Mart functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Code Vibrant
 * @subpackage Beauty Mart
 * @since 1.0.0
 */
/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Set the theme version
 *
 * @global int $beauty_mart_version
 * @since 1.0.0
 */
function beauty_mart_theme_version() {
	$beauty_mart_theme_info = wp_get_theme();
	$GLOBALS['beauty_mart_version'] = $beauty_mart_theme_info->get( 'Version' );
}
add_action( 'after_setup_theme', 'beauty_mart_theme_version', 0 );

/**----------------------------------------------------------------------------------------------------------------------*/

/**
 * manages the hooks for child theme as per requirements
 */

function beauty_mart_required_hooks() {
    remove_action( 'easy_mart_header_sec', 'easy_mart_header_cart', 90 );
    add_action( 'easy_mart_header_sec', 'beauty_mart_header_cart', 90 );

    remove_action( 'easy_mart_footer', 'easy_mart_footer_start', 10 );
    add_action( 'easy_mart_footer', 'beauty_mart_footer_start', 10 );
}

add_action( 'after_setup_theme', 'beauty_mart_required_hooks', 5 );

/*-------------------------------------------------------------------------------------------------------------------------------*/

add_action( 'after_setup_theme', 'beauty_mart_customizer_fields' );
/**
 * Function to add customizer custom fields
 * 
 */
function beauty_mart_customizer_fields(){
    /******** Footer Background Section  **********/
    // Footer background section
    Kirki::add_section( 'footer_bg_section', array(
        'title'          => esc_html__( 'Footer Background Setting', 'beauty-mart' ),
        'panel'          => 'easy_mart_footer_panel',
        'priority'       => 20,
    ) );

    // Image field for footer bg image 
    Kirki::add_field( 'easy_mart_config', array(
        'type'        => 'image',
        'settings'    => 'footer_bg_image',
        'label'       => esc_html__( 'Background Image', 'beauty-mart' ),
        'section'     => 'footer_bg_section',
        'priority'    => 10,
    ) );

    // color field for bg color
    Kirki::add_field( 'easy_mart_config', array(
        'type'        => 'color',
        'settings'    => 'footer_bg_color_setting',
        'label'       => __( 'Background Color', 'beauty-mart' ),
        'section'     => 'footer_bg_section',
        'default'     => '#212121',
        'priority'    => 20,
    ) );

    // color field for font color
    Kirki::add_field( 'easy_mart_config', array(
        'type'        => 'color',
        'settings'    => 'footer_font_color_setting',
        'label'       => __( 'Font Color', 'beauty-mart' ),
        'section'     => 'footer_bg_section',
        'default'     => '#ffffff',
        'priority'    => 30,
    ) );
}
/*-------------------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'beauty_mart_fonts_url' ) ) :
    /**
     * Register Google fonts
     *
     * @return string Google fonts URL for the theme.
     */
    function beauty_mart_fonts_url() {

        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Josefin Sans, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Josefin Sans font: on or off', 'beauty-mart' ) ) {
            $font_families[] = 'Josefin Sans:700';
        }

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/**
 * Enqueue scripts and styles.
 */
function beauty_mart_scripts() {
	global $beauty_mart_version;

    wp_enqueue_style( 'beauty-mart-google-font', beauty_mart_fonts_url(), array(), null );

    wp_dequeue_style( 'easy-mart-style' );
    wp_dequeue_style( 'easy-mart-responsive' );
    
    wp_enqueue_style( 'beauty-mart-parent-style', get_template_directory_uri().'/style.css', array(), esc_attr( $beauty_mart_version ) );

    wp_enqueue_style( 'beauty-mart-parent-responsive', get_template_directory_uri() . '/assets/css/em-responsive.css', array(), esc_attr( $beauty_mart_version ) );

    wp_enqueue_style( 'beauty-mart-style', get_stylesheet_uri(), array(), esc_attr( $beauty_mart_version ) );

    wp_dequeue_script( 'easy-mart-custom-js' );
    wp_enqueue_script( 'beauty-mart-custom-js', get_stylesheet_directory_uri() . '/assets/js/cv-custom-script.js', array(), esc_attr( $beauty_mart_version ) , true );

    $beauty_mart_primary_color = esc_attr( get_theme_mod( 'easy_mart_primary_color', '#31ade6' ) );
        $output_css = '';

        $output_css .= ".navigation .nav-links a,.btn,button,input[type='button'],input[type='reset'],input[type='submit'],.navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.reply .comment-reply-link,.widget_search .search-submit,.woocommerce .price-cart:after,.woocommerce ul.products li.product .price-cart .button:hover,.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.added_to_cart.wc-forward,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce ul.products li.product .onsale, .woocommerce span.onsale,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt[disabled]:disabled,.woocommerce #respond input#submit.alt[disabled]:disabled:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt[disabled]:disabled,.woocommerce a.button.alt[disabled]:disabled:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt[disabled]:disabled,.woocommerce button.button.alt[disabled]:disabled:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt[disabled]:disabled,.woocommerce input.button.alt[disabled]:disabled:hover,.em-cat-menu .category-dropdown li a:hover,.site-primary-nav-wrapper .cv-container,#site-navigation ul.sub-menu, #site-navigation ul.children,.em-ticker-section .ticker-title,.slider-btn,.easy_mart_slider .slider-btn:hover,.woocommerce-active .product .onsale,.add_to_cart_button,.front-page-slider-block .lSAction > a:hover,.section-title::before,.cv-block-title:before,.woocommerce-products-header .page-title:before,.widget-title:before,.easy_mart_category_collection .category-title-btn-wrap .category-btn,.easy_mart_category_collection .category-title-btn-wrap .category-btn:hover,.post-date-attr,.em-scroll-up,.header_sticky.shrink,.follow-us-section .follow-us-content a, h1.entry-title::before, .menu-toggle { background-color:".esc_attr( $beauty_mart_primary_color ).";}";

         $output_css .= "a,a:hover,a:focus,a:active,.entry-footer a:hover,.comment-author .fn .url:hover,.commentmetadata .comment-edit-link,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.woocommerce ul.cart_list li a:hover,.woocommerce ul.product_list_widget li a:hover,.woocommerce .woocommerce-message:before,.woocommerce div.product p.price ins,.woocommerce div.product span.price ins,.woocommerce div.product p.price del,.woocommerce .woocommerce-info:before,.woocommerce .product-categories li a:hover,.woocommerce p.stars:hover a::before,#top-header-nav ul li a:hover,.cv-whishlist a:hover,.em-ticker-section .ticker-item span,.slider-title span,.woocommerce-loop-product__title:hover,.product .star-rating span:before,.woocommerce .star-rating span:before,.easy-mart-woo-product-btn-wrapper a:hover,.woocommerce ul.products li.product .easy-mart-woo-product-btn-wrapper a:hover,.promo-icon-title-block .promo-icon,.easy_mart_default_post_category .entry-btn:hover,.easy_mart_default_post_category .entry-title-desc-wrap .entry-title a:hover,.entry-meta > span a:hover,.entry-title a:hover,.error-404.not-found .page-header .page-title,.menu-close:hover,.section-product-content-wrap.list-view .product-content li .easy-mart-woo-product-btn-wrapper a.add_to_cart_button:hover{color:".esc_attr( $beauty_mart_primary_color ).";}"; 

        $output_css .= ".navigation .nav-links a,.btn,button,input[type='button'],input[type='reset'],input[type='submit'],.widget_search .search-submit,.woocommerce form .form-row.woocommerce-validated .select2-container,.woocommerce form .form-row.woocommerce-validated input.input-text,.woocommerce form .form-row.woocommerce-validated select,.easy_mart_category_collection .category-title-btn-wrap .category-btn,.easy_mart_category_collection .category-title-btn-wrap .category-btn:hover,.promo-icon-title-block .promo-icon,.error-404.not-found{ border-color:".esc_attr( $beauty_mart_primary_color )."; }";

        $output_css .= ".comment-list .comment-body,.woocommerce .woocommerce-info,.woocommerce .woocommerce-message{ border-top-color:".esc_attr( $beauty_mart_primary_color )."; }";

        $output_css .= ".entry-title-desc-wrap,#blog-post article.hentry, .search article.hentry, .archive article.hentry, .tag article.hentry, .category article.hentry, .blog article.hentry{ border-bottom-color:".esc_attr( $beauty_mart_primary_color )."; }";

       $output_css .= "#site-navigation ul li.current-menu-item>a,#site-navigation ul li:hover>a,#site-navigation ul li.current_page_ancestor>a,#site-navigation ul li.current-menu-ancestor>a,#site-navigation ul li.current_page_item>a{  background-color:".esc_attr( $beauty_mart_primary_color )."; }";

        $output_css .= "@media (max-width: 1200px) { #site-navigation { background-color:".esc_attr( $beauty_mart_primary_color )."; } }";

       $refine_output_css = easy_mart_css_strip_whitespace( $output_css );
        wp_add_inline_style( 'beauty-mart-style', $refine_output_css );


    $footer_bg_image = get_theme_mod( 'footer_bg_image', '' );
    $footer_bg_color_setting = get_theme_mod( 'footer_bg_color_setting', '#31ade6' );
    $footer_font_color_setting = get_theme_mod( 'footer_font_color_setting', '#ffffff' );

    $output_css = '';


    $output_css .= "#colophon{background-color:".esc_attr( $footer_bg_color_setting ).";}\n";
    
    $output_css .= "#colophon .widget, #colophon .widget a, #colophon,#colophon .section-title, #colophon .cv-block-title, #colophon .widget-title,#colophon .product .price, #colophon .woocommerce ul.products li.product .price, #colophon .widget.woocommerce .woocommerce-Price-amount.amount, #colophon .site-info a{color:".esc_attr( $footer_font_color_setting ).";}\n";

   $refine_output_css = easy_mart_css_strip_whitespace( $output_css );
    wp_add_inline_style( 'beauty-mart-style', $refine_output_css ); 
}
add_action( 'wp_enqueue_scripts', 'beauty_mart_scripts', 20 );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'beauty_mart_header_cart' ) ) :

	/**
	 * Header Cart function
	 */
	function beauty_mart_header_cart() {
		$header_cart_icon_opt = get_theme_mod( 'header_cart_icon_opt', true );
		if(  !class_exists( 'WooCommerce' ) || ( $header_cart_icon_opt ) === false ) {
			return;
		}
		easy_mart_woocommerce_header_cart();
	}

endif;

/*----------------------------------------------------------------------------------------------------------------------------------------*/
if( !function_exists( 'beauty_mart_footer_start' ) ):

	/**
	 * Functions for footer start
	 */
	function beauty_mart_footer_start(){
        global $footer_column;
        $footer_bg_image = get_theme_mod( 'footer_bg_image', '' );
        if( !empty( $footer_bg_image ) ){
            $footer_column = $footer_column.' has-background-image';
?>
            <footer id="colophon" class="site-footer <?php echo 'footer-'.esc_attr( $footer_column ); ?>" style="background-image:url(<?php echo esc_url( $footer_bg_image ); ?>)">
<?php
        }else{
?>
            <footer id="colophon" class="site-footer <?php echo 'footer-'.esc_attr( $footer_column ); ?>">
<?php
        }
	}

endif;
