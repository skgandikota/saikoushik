<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;
?>

<div class="header-wrapper">
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".mobile-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand">
                    <h1>
                        <?php get_template_part('template-parts/site', 'logo');?>
                    </h1>
                </div> <!-- .navbar-brand -->
            </div> <!-- .navbar-header -->

             <?php 
                if ( is_page_template( 'page-template/one-page.php' ) ){
                        get_template_part('template-parts/one-page', 'nav');
                     }else{
                         get_template_part('template-parts/main', 'nav');
                     }
            ?>

        </div><!-- .container-->
    </nav>
</div> <!-- .header-wrapper -->