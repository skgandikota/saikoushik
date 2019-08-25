<?php
   if ( ! defined( 'ABSPATH' )){
        exit; // Exit if accessed directly
    }

    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // ReduxFramework  Config File
    // For full documentation, please visit: https://docs.reduxframework.com
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // This is your option name where all the Redux data is stored.
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

    $opt_name = "smartwp_option";


    /**
     * SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'smartwp' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'hidden',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           =>  sprintf( esc_html__( 'Theme Option', 'smartwp' ), $theme->get( 'Name' ) ),
        'page_title'           => sprintf( esc_html__( 'Theme Option', 'smartwp' ), $theme->get( 'Name' ) ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => FALSE,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => TRUE,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => FALSE,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => TRUE,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => '40',
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => TRUE,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => FALSE,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => TRUE,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => TRUE,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => TRUE,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'        => sprintf( '%s Theme Options', 'smartwp' ), $theme->get( 'Name'  ),
        // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => TRUE,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => TRUE,
                'rounded' => FALSE,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );

   
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Generel setting
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el el-cogs',
        'title'  => esc_html__('Generel Settings', 'smartwp'),
        'fields' => array(
           array(
            'id'       => 'breadcrumb',
            'type'     => 'switch',
            'title'    => esc_html__(' Breadcrumb', 'smartwp'),
            'subtitle' => esc_html__('Show or Hide Your Website  Breadcrumb', 'smartwp'),
            'on'       => esc_html__('Show', 'smartwp'),
            'off'      => esc_html__('Hide', 'smartwp'),
            'default'  => FALSE,
            ),
            array(
            'id'       => 'preloader',
            'type'     => 'switch',
            'title'    => esc_html__(' Preloader', 'smartwp'),
            'subtitle' => esc_html__('Show or Hide Your Website  Preloader', 'smartwp'),
            'on'       => esc_html__('Show', 'smartwp'),
            'off'      => esc_html__('Hide', 'smartwp'),
            'default'  => TRUE,
            ),
        )
    ));

     //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Logo settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-slideshare',
        'title'  => esc_html__('Logo Settings', 'smartwp'),
        'fields' => array(
            array(
                'id'       => 'text-logo',
                'type'     => 'text',
                'title'    => esc_html__('Logo Text', 'smartwp'),
                'subtitle' => esc_html__('Change your logo text, You Can Upload your Logo easily from customize->Site Identy', 'smartwp'),
                'default'=>'smartwp'
            ),
         array(
                'id'             => 'logo-margin',
                'type'           => 'spacing',
                'output'         => array('a.smartwp-logo'),
                'mode'           => 'margin',
                'units'          => 'px',
                'units_extended' => 'false',
                'title'          => esc_html__('Logo Margin Option', 'smartwp'),
                'subtitle'       => esc_html__('You can change logo margin if needed.', 'smartwp'),
                'desc'           => esc_html__('Change top, right, bottom and left value in px, e.g: 10', 'smartwp')
            ),
           array(
                'id'       => 'logo-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Logo Text Color', 'smartwp' ),
                'subtitle' => esc_html__( 'Pick Color For Logo Text', 'smartwp' ),
                'default'=>'#000'
            ),
        )
    ));


     //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Header settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el el-website',
        'title'  => esc_html__( 'Header Settings', 'smartwp' ),
        'fields' => array(
            array(
                'id'             => 'navbar-margin',
                'type'           => 'spacing',
                'output'         => array('.navbar-right'),
                'mode'           => 'margin',
                'units'          => 'px',
                'units_extended' => 'false',
                'title'          => esc_html__('Main menu margin option', 'smartwp'),
                'subtitle'       => esc_html__('You can change main menu margin if needed.', 'smartwp'),
                'desc'           => esc_html__('Change top, right, bottom and left value in px, e.g: 10', 'smartwp')
            ),

            // menu color
            array(
                'id'       => 'menu-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Font color', 'smartwp' ),
                'subtitle' => esc_html__( 'Pick color for menu.', 'smartwp' ),
                'default'=>'#4c4c4c'
            ),
              array(
                'id'       => 'menu-hover-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Font Hover  color', 'smartwp' ),
                'subtitle' => esc_html__( 'Pick Color For Menu.', 'smartwp' ),
                'default'=>''
            ),
            array(
                'id'       => 'headear-bg-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Header Background Color', 'smartwp' ),
                'subtitle' => esc_html__( 'Pick Color Header Background ', 'smartwp' ),
                'default'=>'#fff'
            ),

        )
    ));
 
  //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Presets settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-brush',
        'title'  => esc_html__('Preset color', 'smartwp'),
        'fields' => array(
            array(
                'id'       => 'title-color',
                'type'     => 'color',
                'title'    => __( 'Post Title color', 'smartwp' ),
                'subtitle' => __( 'Pick Color For Post Title (default: #303952).', 'smartwp' ),
                'default'  => '#303952',
            ),
            array(
                'id'       => 'title-hover',
                'type'     => 'color',
                'title'    => __( ' Title Hover Color', 'smartwp' ),
                'subtitle' => __( 'Pick Color For Title Hover  title (default: #222).', 'smartwp' ),
                'default'  => '#222',
            ),
            array(
                'id'       => 'Widget-sidebar-title-color',
                'type'     => 'color',
                'title'    => __( 'Sidebar Widget Title Color', 'smartwp' ),
                'subtitle' => __( 'Pick Color For Widget Title (default: #303952).', 'smartwp' ),
                'default'  => '#303952',
            ),
            array(
                'id'       => 'Widget-footer-title-color',
                'type'     => 'color',
                'title'    => __( 'Footer Widget Title Color', 'smartwp' ),
                'subtitle' => __( 'Pick Color For Footer Widget Title (default: #fff).', 'smartwp' ),
                'default'  => '#fff',
            ),
        )
    )); //end 

    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Blog settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

        Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-file-edit',
        'title'  => esc_html__('Blog Settings', 'smartwp'),
        'fields' => array(
            array(
                'id'       => 'blog-title',
                'type'     => 'text',
                'title'    => esc_html__('Blog Page Title', 'smartwp'),
                'subtitle' => esc_html__('Enter Blog page title here, if leave blank then site title will appear', 'smartwp'),
                'default'  => 'Home'
            ),
            array(
                'id'       => 'blog-sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__('Blog sidebar setting', 'smartwp'),
                'subtitle' => esc_html__('Select blog sidebar', 'smartwp'),
                'options'  => array(
                    'left-sidebar'  => array(
                        'alt' => 'Left sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'right-sidebar'
            )
        )
    )); //end blog sidebar

 
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Page settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-file-edit',
        'title'  => esc_html__('Page Settings', 'smartwp'),
        'fields' => array(

            array(
                'id'       => 'page-sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__('Page Sidebar', 'smartwp'),
                'subtitle' => esc_html__('Select page sidebar', 'smartwp'),
                'options'  => array(
                    'no-sidebar'    => array(
                        'alt' => 'No sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'left-sidebar'  => array(
                        'alt' => 'Left sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'right-sidebar'
            )
        )
    ));

     //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Search settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-file-edit',
        'title'  => esc_html__('404 Settings', 'smartwp'),
        'fields' => array(
      array(
            'id'       => 'title-404',
            'type'     => 'text',
            'title'    => esc_html__('404 Title', 'smartwp'),
            'subtitle' => esc_html__('Write 404 Page Title', 'smartwp'),
            'default'=>'404'
        ),
       array(
            'id'       => 'sub-title-404',
            'type'     => 'text',
            'title'    => esc_html__('404 Sub Title', 'smartwp'),
            'subtitle' => esc_html__('Write 404 Page Sub Title', 'smartwp'),
            'default'=> esc_html__('PAGE NOT FOUND!', 'smartwp')
        ),
       array(
            'id'       => 'content-404',
            'type'     => 'text',
            'title'    => esc_html__('404 Content', 'smartwp'),
            'subtitle' => esc_html__('Write 404 Content', 'smartwp'),
            'default'=>esc_html__('Sorry, we couldn\'t find the content you were looking for.', 'smartwp'),
        ),
         array(
            'id'       => 'icon-404',
            'type'     => 'text',
            'title'    => esc_html__('404 Icon', 'smartwp'),
            'subtitle' => esc_html__('Insert 404 Font Awesome Icon', 'smartwp'),
            'default'=>'fa fa-exclamation-triangle'
        ),
        )
    ));

     //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Breadcrumb
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el el-list-alt',
        'title'  => esc_html__('Breadcrumb', 'smartwp'),
        'fields' => array(
            //blog breadcrumb
        array(
                'id'       => 'breadcrumb-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Breadcrumb Background Color', 'smartwp' ),
                'subtitle' => esc_html__( 'Pick Color For Breadcrumb Background', 'smartwp' ),
                'default'=>'#224'
            ),
         array(
                'id'       => 'breadcrumb-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Breadcrumb Text Color', 'smartwp' ),
                'subtitle' => esc_html__( 'Pick Color For Breadcrumb Text', 'smartwp' ),
                'default'=>'#fff'
            ),

        )
    )); //end breadcumb

       //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Preloader settings
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-repeat-alt',
        'title'  => esc_html__('Preloader Settings', 'smartwp'),
        'fields' => array(
            array(
                'id'       => 'loader-bg-color',
                'type'     => 'color',
                'title'    => __( 'Preloader background color', 'smartwp' ),
                'subtitle' => __( 'Pick color for preloader background (default: #222222).', 'smartwp' ),
                'default'  => '#222222',
            ),
            array(
                'id'       => 'first-spinner-color',
                'type'     => 'color',
                'title'    => __( 'First Spinner Color', 'smartwp' ),
                'subtitle' => __( 'Pick color for preloader First Spinner Color (default: #16a085).', 'smartwp' ),
                'default'  => '#16a085',
            ),
             array(
                'id'       => 'second-spinner-color',
                'type'     => 'color',
                'title'    => __( 'Second Spinner Color', 'smartwp' ),
                'subtitle' => __( 'Pick color for preloader Second Spinner Color (default: #e74c3c).', 'smartwp' ),
                'default'  => '#e74c3c',
            ),

             array(
                'id'       => 'third-spinner-color',
                'type'     => 'color',
                'title'    => __( 'Third Spinner Color', 'smartwp' ),
                'subtitle' => __( 'Pick color for preloader Third Spinner Color(default: #e74c3c).', 'smartwp' ),
                'default'  => '#f9c922',
            ),

        )
    ));

     //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    //Footer
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

        Redux::setSection( $opt_name, array(
        'icon'   => 'el-icon-photo',
        'title'  => esc_html__('Footer Settings', 'smartwp'),
        'fields' => array(
            array(
                'id'       => 'copyrighttext',
                'type'     => 'editor',
                'title'    => esc_html__('Copyright Text', 'smartwp'),
                'default'  => esc_html__('"&copy;  Copyright by smartwp theme 2019"', 'smartwp')
            ),

          array(
                'id'       => 'footer-bg-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Background Color', 'smartwp' ),
                'subtitle' => esc_html__( 'Pick Color For Footer Background', 'smartwp' ),
                'default'=>'#131313'
            ),
           array(
                'id'       => 'footer-font-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Font Color', 'smartwp' ),
                'subtitle' => esc_html__( 'Pick Color For Footer Font', 'smartwp' ),
                'default'=>'#fff'
            ),

           array(
                'id'             => 'footerPadding',
                'type'           => 'spacing',
                'output'         => array('.copyright '),
                'mode'           => 'padding',
                'units'          => 'px',
                'units_extended' => 'false',
                'title'          => esc_html__('Footer Padding Option', 'smartwp'),
                'subtitle'       => esc_html__('You can change Footer padding if needed.', 'smartwp'),
                'desc'           => esc_html__('Change top, right, bottom and left value in px, e.g: 10', 'smartwp')
            ),
        )
    )); //end blog sidebar