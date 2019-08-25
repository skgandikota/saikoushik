<?php 
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

get_header();
?>
<div class="blog-wrapper content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div id="main" class="posts-content" role="main">
                    <?php while ( have_posts() ) : the_post(); 

                        get_template_part( 'template-parts/content', get_post_format() ); 

                        smartwp_posts_pagination(); 

                        // Author description will appear below in every single blog post.
                        if (get_the_author_meta( 'description' )) :
                            get_template_part( 'author-bio' ); 
                        endif;

                     
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        
                    endwhile; // End of the loop. ?>
                </div> <!-- .posts-content -->
            </div> <!-- col-## -->

            <!-- Sidebar -->   
            <?php get_sidebar(); ?>

        </div> <!-- .row -->
    </div> <!-- .container -->
</div> <!-- .content-wrapper -->
<?php get_footer(); ?>