<?php if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrapper'); ?>>
    <header class="featured-wrapper">
        <?php if ( has_post_thumbnail() ) : ?>
	        <div class="post-thumbnail">
	        	<?php 
	        		do_action( 'smartwp_before_post_thumbnail');
	        		the_post_thumbnail('smartwp-blog-thumbnail', array('alt' => get_the_title(), 'class' => 'img-responsive'));
                ?>
	            <?php do_action( 'smartwp_after_post_thumbnail'); ?>
	        </div><!-- .post-thumbnail -->
		<?php endif; ?>
    </header><!-- /.featured-wrapper -->
    
    <div class="blog-content">
        <div class="entry-header">
            <?php
				if ( is_single() ) :
				else :
					the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				endif;
			?>
            <?php smartwp_posted_on(); ?>
        </div><!-- /.entry-header -->

        <div class="entry-content">
			<?php 
				if (is_single()):
					the_content( '<span class="readmore">' . esc_html__( 'Read More', 'smartwp' ) . '</span>' );
				else :
					the_excerpt();
				endif;

				wp_link_pages(array(
		            'before'      => '<div class="page-pagination"><span class="page-links-title">' . esc_html__('Pages:', 'smartwp') . '</span>',
		            'after'       => '</div>',
		            'link_before' => '<span>',
		            'link_after'  => '</span>',
		        ));
			?>
	    </div><!-- .entry-content -->
    </div><!-- /.blog-content -->


    <footer class="entry-footer clearfix">
        <ul class="entry-meta">
            <?php if (!is_single()): ?>
                <li class="readmore">
                    <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','smartwp'); ?></a>
                </li>
                <li>
                    <span class="post-comments">
                        <?php
                            comments_popup_link(
                                '0',
                                esc_html__('1', 'smartwp'),
                                esc_html__('%', 'smartwp'), '',
                                esc_html__('Comments are Closed', 'smartwp')
                            ); 
                        ?>
                    </span>
                </li>
              <?php echo edit_post_link(esc_html__('Edit Post', 'smartwp'), '<li class="edit-link">', '</li>') ?>
            <?php endif; ?>
        </ul>

       <?php if (is_single()): ?>
            <div class="post-tags">
                <?php $tags_list = get_the_tag_list('', '');
                    if ($tags_list) : ?>
                        <span class="tags-links">
                             <?php printf('%1$s',  wp_kses_post( $tags_list )); ?>
                        </span>
                    <?php endif; 
                ?>
            </div> <!-- .post-tags -->
        <?php endif; ?>
    </footer>
</article>