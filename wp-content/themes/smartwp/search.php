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
					<?php if ( have_posts() ) : ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php
							/*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
							get_template_part( 'template-parts/content', 'search' );
							?>

						<?php endwhile; ?>

						<?php smartwp_posts_pagination(); ?>

					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>
				</div><!-- .posts-content -->
			</div> <!-- .col-## -->

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</div> <!-- .row -->
	</div> <!-- .container -->
</div> <!-- .blog-wrapper -->

<?php get_footer(); ?>