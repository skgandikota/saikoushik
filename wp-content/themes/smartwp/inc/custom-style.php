<?php
    if ( ! function_exists( 'smartpwp_dynamic_styles' ) ) {
      function smartpwp_dynamic_styles() {
        //Logo color options
        $smartwp_logo_color =  esc_html(smartwp_option('logo-color'));
        if ( $smartwp_logo_color ) :
            $smartwp_logo_color = 'color:' .$smartwp_logo_color. '';
        endif; 
        //menu color options
        $smartwp_menu_color = esc_html(smartwp_option('menu-color'));
        if ( $smartwp_menu_color ) :
            $smartwp_menu_color = 'color:' .$smartwp_menu_color. '';
        endif;  
        //menu color options
        $smartwp_menu_hover_color = esc_html(smartwp_option('menu-hover-color'));
        if ( $smartwp_menu_hover_color ) :
            $smartwp_menu_hover_color = 'color:' .$smartwp_menu_hover_color. '';
        endif; 

        //header background color
        $smartwp_header_bg_color = esc_html(smartwp_option('headear-bg-color'));
        if ( $smartwp_header_bg_color ) :
            $smartwp_header_bg_color = 'background-color:' .$smartwp_header_bg_color. '';
        endif; 

        //footer background color
        $smartwp_footer_bg_color = esc_html(smartwp_option('footer-bg-color'));
        if ( $smartwp_footer_bg_color ) :
            $smartwp_footer_bg_color = 'background-color:' .$smartwp_footer_bg_color. '';
        endif;  
        //footer font color
        $smartwp_footer_font_color = esc_html(smartwp_option('footer-font-color'));
        if ( $smartwp_footer_font_color ) :
            $smartwp_footer_font_color = 'color:' .$smartwp_footer_font_color. '';
        endif; 

        //post title color
        $smartwp_post_title = esc_html(smartwp_option('title-color'));
        if ( $smartwp_post_title ) :
            $smartwp_post_title = 'color:' .$smartwp_post_title. '';
        endif; 

        //post title color
        $smartwp_post_title_hover = esc_html(smartwp_option('title-hover'));
        if ( $smartwp_post_title_hover ) :
            $smartwp_post_title_hover = 'color:' .$smartwp_post_title_hover. '';
        endif; 

    //post title color
        $smartwp_widget_sidebar_title = esc_html(smartwp_option('Widget-sidebar-title-color'));
        if ( $smartwp_widget_sidebar_title ) :
            $smartwp_widget_sidebar_title = 'color:' .$smartwp_widget_sidebar_title. '';
        endif;

         //footer widget title color
        $smartwp_footer_widget_title = esc_html(smartwp_option('Widget-footer-title-color'));
        if ( $smartwp_footer_widget_title ) :
            $smartwp_footer_widget_title = 'color:' .$smartwp_footer_widget_title. '';
        endif; 

          //breadcrumb bg
        $smartwp_breadcrumb_background_color = esc_html(smartwp_option('breadcrumb-bg'));
        if ( $smartwp_breadcrumb_background_color ) :
            $smartwp_breadcrumb_background_color = 'background-color:' .$smartwp_breadcrumb_background_color. '';
        endif; 

      //breadcrumb text
        $smartwp_breadcrumb_text_color = esc_html(smartwp_option('breadcrumb-text-color'));
        if ( $smartwp_breadcrumb_text_color ) :
            $smartwp_breadcrumb_text_color = 'color:' .$smartwp_breadcrumb_text_color. '';
        endif; 

        //pre loader background color
        $smartwp_preloader_background = esc_html(smartwp_option('loader-bg-color'));
        if ( $smartwp_preloader_background ) :
            $smartwp_preloader_background = 'background-color:' .$smartwp_preloader_background. '';
        endif;    

        //pre loader spinner first color
        $smartwp_preloader_first_spinner = esc_html(smartwp_option('first-spinner-color'));
        if ( $smartwp_preloader_first_spinner ) :
            $smartwp_preloader_first_spinner = ' border-top-color:' .$smartwp_preloader_first_spinner. '';
        endif;   

        //pre loader spinner second color
        $smartwp_preloader_second_spinner = esc_html(smartwp_option('second-spinner-color'));
        if ( $smartwp_preloader_second_spinner ) :
            $smartwp_preloader_second_spinner = ' border-top-color:' .$smartwp_preloader_second_spinner. '';
        endif;    

        //pre loader spinner third color
        $smartwp_preloader_third_spinner = esc_html(smartwp_option('third-spinner-color'));
        if ( $smartwp_preloader_third_spinner ) :
            $smartwp_preloader_third_spinner = ' border-top-color:' .$smartwp_preloader_third_spinner. '';
        endif;  

  


        ob_start(); ?>

         a.smartwp-logo {
      <?php echo esc_attr( $smartwp_logo_color ); ?>
    } 
    .navbar-default .navbar-nav>li>a {
      <?php echo esc_attr( $smartwp_menu_color ); ?>
    }
    .dropdown-menu>li>a{
      <?php echo esc_attr( $smartwp_menu_color ); ?>
    }
    .navbar-default .navbar-nav li a:hover{
    <?php echo esc_attr( $smartwp_menu_hover_color ); ?>
    }
    .navbar-default, .navbar-nav>li:hover > .dropdown-wrapper > ul, 
    .navbar-nav>li .dropdown-menu{
        <?php echo esc_attr( $smartwp_header_bg_color ); ?>
    }
    .footer-copyright{
      <?php echo esc_attr( $smartwp_footer_bg_color ); ?>
    }
    .footer-multi-wrapper .copyright{
        <?php echo esc_attr( $smartwp_footer_font_color ); ?>
    }
   .entry-title a{
        <?php echo esc_attr( $smartwp_post_title ); ?>
    }

   .entry-header h2 a:hover{
        <?php echo esc_attr( $smartwp_post_title_hover ); ?>
    }

    .sidebar-wrapper .widget-title {
         <?php echo esc_attr( $smartwp_widget_sidebar_title ); ?>
    }
    .footer-sidebar .widget-title{
        <?php echo esc_attr( $smartwp_footer_widget_title ); ?>
    }
    .footer-sidebar ul li a:hover{
            color: #fff;
    }

    .page-title{
     <?php echo esc_attr( $smartwp_breadcrumb_background_color ); ?>
    }
    .page-title h1, .page-title .breadcrumb>li+li:before, .page-title .breadcrumb li a, .page-title .breadcrumb li a:hover, .page-title .breadcrumb>.active, .page-title .breadcrumb>li+li:before{
       <?php echo esc_attr( $smartwp_breadcrumb_text_color ); ?> 
    }

    #loader-wrapper .loader-section{
     <?php echo esc_attr( $smartwp_preloader_background ); ?>
    }

    #loader{
        <?php echo esc_attr( $smartwp_preloader_first_spinner ); ?>
    }
    #loader:before {
         <?php echo esc_attr( $smartwp_preloader_second_spinner ); ?>
    }
    
    #loader:after {
         <?php echo esc_attr( $smartwp_preloader_third_spinner ); ?>
    }




    <?php 
    $output = ob_get_clean();
    return $output;
     } //end  smartpwp_dynamic_styles
    } //endif 
       


function smartwp_style_method() {

        $custom_css = smartpwp_dynamic_styles();
        wp_add_inline_style( 'smartwp-stylesheet', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'smartwp_style_method' );



   