<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif; ?>
 <footer class="footer-section footer-multi-wrapper">
   
    <?php if (is_active_sidebar('footer-sidebar' )): ?>
        <div class="container">
            <div class="row">
                <div class="sidebar-wrapper footer-sidebar clearfix text-left" role="complementary">
                    <?php dynamic_sidebar('footer-sidebar' );?>
                </div>
            </div>
        </div> <!-- .container -->
    <?php endif; ?>
    
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright text-center">
                        &copy; <?php esc_html_e( 'Copyright by ', 'smartwp' ); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php echo bloginfo( 'name ' ); ?></a> <?php echo esc_html( date_i18n( __( 'Y ', 'smartwp' ) ) ); ?>
                    </div> <!-- .copyright -->
                </div> <!-- .col-# -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .footer-copyright -->
</footer> <!-- .footer-section -->
 <?php wp_footer(); ?>
</body>
</html>