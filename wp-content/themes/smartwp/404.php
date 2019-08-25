<?php 
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header(); ?>
<div class="error-page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-5 col-sm-offset-1">
				<div class="not-found-icon text-center">
					<i class="<?php echo esc_html(smartwp_option('icon-404', esc_attr('fa fa-exclamation-triangle'))); ?>"></i>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="error-message">
				    <h2>
				    	<?php echo esc_html(smartwp_option('title-404', esc_html__('404','smartwp'))); ?>
				    </h2>
				    <h3><?php echo esc_html(smartwp_option('sub-title-404', esc_html__('PAGE NOT FOUND!','smartwp')));  ?>
				    </h3>
				    <p><?php echo esc_html(smartwp_option('content-404', esc_html__('Sorry, we couldn\'t find the content you were looking for.','smartwp')));  ?></p>

				    <a href="<?php echo esc_url(home_url('/'));?>"><i class="fa fa-reply-all"></i><?php esc_html_e( 'Go Back Home', 'smartwp' );  ?></a>
				</div> <!-- /notfound-page -->
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div><!-- /.container -->
</div> <!-- /.content-wrapper -->
<?php get_footer(); ?>
