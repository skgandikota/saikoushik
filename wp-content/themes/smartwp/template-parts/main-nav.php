<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;
?>

<div class="main-menu-wrapper hidden-xs clearfix">
  <div class="main-menu">                   
      <?php wp_nav_menu( apply_filters( 'smartwp_nav_menu', array(
          'container'      => false,
          'theme_location' => 'primary',
          'items_wrap'     => '<ul id="%1$s" class="%2$s nav navbar-nav navbar-right">%3$s</ul>',
          'walker'         => new smartwp_Navwalker(),
          'fallback_cb'    => 'smartwp_Navwalker::fallback'
      ))); ?>
  </div>
</div> <!-- /navbar-collapse -->

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="visible-xs">
  <div class="mobile-menu collapse navbar-collapse mobile-toggle">
      <?php wp_nav_menu( apply_filters( 'smartwp_nav_menu', array(
            'container'      => false,
            'theme_location' => 'primary',
            'items_wrap'     => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
            'walker'         => new smartwp_Navwalker (),
            'fallback_cb'    => 'smartwp_Mobile_Navwalker::fallback'
      ))); ?>
  </div> <!-- /.navbar-collapse -->
</div>