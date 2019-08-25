<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;
?>

<?php
$blog_sidebar = smartwp_option('blog-sidebar','right-sidebar');

 if ( $blog_sidebar == 'right-sidebar' and is_active_sidebar('smartwp-blog-sidebar')) : ?>
    <div class="col-md-4 col-sm-4">
        <div class="sidebar-wrapper right-sidebar" role="complementary">
            <?php dynamic_sidebar('smartwp-blog-sidebar'); ?>
        </div>
    </div>
<?php elseif ( $blog_sidebar == 'left-sidebar' and is_active_sidebar('smartwp-blog-sidebar')) : ?>
    <div class="col-md-4 col-md-pull-8 col-sm-4 col-sm-pull-8">
        <div class="sidebar-wrapper left-sidebar" role="complementary">
            <?php dynamic_sidebar('smartwp-blog-sidebar'); ?>
        </div>
    </div>
<?php endif;