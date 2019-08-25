<?php 
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif; 


$content_alignment = "";
$margin_bottom = "";
$padding_top = "";
$padding_bottom = "";
$header_background = 'background-image: url('.esc_url(smartwp_page_header_background()).');';
$parallax_background = "";
$content_color = "";
$bpage_option = "";

?>
<!--page title start-->
<section class="page-title <?php echo esc_attr($content_alignment)?>" <?php echo esc_attr($parallax_background);?> style="<?php echo esc_attr($header_background.' '.$margin_bottom.' '.$padding_top.' '.$padding_bottom); ?> "  role="banner">
    
    <div class="container">
        <h1 style="<?php echo esc_attr($content_color); ?>"><?php echo esc_html( smartwp_page_header_section_title() ); ?></h1>

            <div class="smartwp-breadcrumb" style="<?php echo esc_attr($content_color); ?>">
                <?php 
                	$smartwp_breadcrumb = smartwp_option( 'breadcrumb', FALSE );
					if( $smartwp_breadcrumb == 1) {
              			  smartwp_breadcrumbs();
              		 } 
                ?>
            </div>

    </div><!-- .container -->
</section> <!-- page-title -->