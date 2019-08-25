<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
    <?php wp_head(); ?>
</head>

<body id="home" <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
            wp_body_open(); 
        } ?>
 <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'smartwp' ); ?></a>
<?php 
	$smartwp_preloader = smartwp_option( 'preloader' );
	if( $smartwp_preloader == 1 ){
		  get_template_part('template-parts/preloader');
	}
 ?>

 <?php get_header('default'); ?>

<?php 
    if ( ! is_page_template( 'page-template/one-page.php' ) ){
            get_template_part( 'template-parts/page-header', 'section' ); 
        }
 ?>