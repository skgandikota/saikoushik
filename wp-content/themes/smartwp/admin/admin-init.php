<?php
	
    if ( ! defined( 'ABSPATH' ) ) :
        exit; // Exit if accessed directly
    endif;

    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Getting theme option data
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

    if ( !function_exists('smartwp_option')) :
        
        function smartwp_option($index = FALSE, $default=FALSE) {
            global $smartwp_option;
            $result = $smartwp_option[$index];
            if (empty($result)) {
                return $default;
            }
           $result;
       }

    endif;

    // Load the themes options
    require get_template_directory() . "/admin/theme-options-config.php";