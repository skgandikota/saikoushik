<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif; ?>

<a href="<?php echo esc_url(home_url('/')); ?>" class="smartwp-logo" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
 <?php if (  has_custom_logo() ) {
    the_custom_logo();
  }elseif( smartwp_option('text-logo') ){
  	 echo esc_html( smartwp_option('text-logo') );
  }else{
     echo esc_html(strtoupper(get_bloginfo('name')));
  } ?>
</a>

