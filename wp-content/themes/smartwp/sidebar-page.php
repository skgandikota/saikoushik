<?php 
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

$smartwp_page_sidebar = smartwp_option( 'page-sidebar', 'right-sidebar' );
if ( $smartwp_page_sidebar == 'right-sidebar' and is_active_sidebar( 'smartwp-page-sidebar' ) ) : ?>
	<div class="col-md-4 col-sm-4">
		<div class="sidebar-wrapper right-sidebar" role="complementary">
			<?php dynamic_sidebar( 'smartwp-page-sidebar' ); ?>
		</div>
	</div>
<?php elseif ( $smartwp_page_sidebar == 'left-sidebar' and is_active_sidebar( 'smartwp-page-sidebar' ) ) : ?>
	<div class="col-md-4 col-md-pull-8 col-sm-4 col-sm-pull-8">
		<div class="sidebar-wrapper left-sidebar" role="complementary">
			<?php dynamic_sidebar( 'smartwp-page-sidebar' ); ?>
		</div>
	</div>
<?php endif;