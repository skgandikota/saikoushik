<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments-wrapper">
    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title">
            <?php
               $comments_number = get_comments_number();
				printf( 
				    esc_html(
				        // translators: %1s: comments number
				        _nx( 
				            '%1$1s Comment',
				            '%1$1s Comments',
				            $comments_number,
				            'comments title',
				            'smartwp'
				       )
				    ),
				    esc_html(number_format_i18n( $comments_number ))// phpcs:ignore
					);
	            ?>
        </h3>
        <ul class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'li',
                    'short_ping'  => true,
                    'avatar_size' => 50,
                    'callback'    => 'smartwp_comments_list'
                ));
            ?>
        </ul><!-- .comment-list -->
    <?php endif; // have_comments()

    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h3 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'smartwp' ); ?></h3>
            <ul class="pager comment-navigation">
                <li class="previous"><?php previous_comments_link( '<i class="fa fa-angle-double-left"></i> ' . esc_html__( 'Older Comments', 'smartwp' ) ); ?></li>
                <li class="next"><?php next_comments_link( esc_html__( 'Newer Comments', 'smartwp' ) . '<i class="fa fa-angle-double-right"></i>' ); ?></li>
            </ul>
        </nav><!-- .comment-navigation -->
    <?php endif;  // Check for comment navigation   ?>

    <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <div class="alert alert-warning no-comments"><?php esc_html_e( 'Comments are closed.' , 'smartwp' ); ?></div>
    <?php else :
        smartwp_comment_form();
    endif; ?>
</div><!-- /#comments -->