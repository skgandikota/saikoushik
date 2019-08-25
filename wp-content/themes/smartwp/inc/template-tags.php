<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Blog posts pagination for default blog layout
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('smartwp_posts_pagination')) :
    function smartwp_posts_pagination() { 

        global $wp_query;
            if ($wp_query->max_num_pages > 1) {
                $big = 999999999; // need an unlikely integer
                $items = paginate_links(array(
                    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format'    => '?paged=%#%',
                    'prev_next' => true,
                    'current'   => max(1, get_query_var('paged')),
                    'total'     => $wp_query->max_num_pages,
                    'type'      => 'array',
                    'prev_text' => esc_html__('Prev.', 'smartwp'),
                    'next_text' => esc_html__('Next', 'smartwp')
                ));

                $pagination = "<ul class=\"pagination\">\n\t<li>";
                $pagination .= join("</li>\n\t<li>", $items);
                $pagination .= "</li>\n</ul>\n";

                echo wp_kses_post($pagination);
            } 

        return;

    }
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Prints HTML with meta information for the current post-date/time, author & others.
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('smartwp_posted_on')) :
    function smartwp_posted_on() { ?>

        <ul class="entry-meta clearfix">
             <li>
                <span class="author vcard">
                    <i class="fa fa-user"></i><?php printf('<a class="url fn n" href="%1$s">%2$s</a>',
                        esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                        esc_html(get_the_author())
                    ) ?>
                </span>
            </li>
            <li>
                <i class="fa fa-calendar"></i><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a>
            </li>
           
            <li>
                <span class="posted-in">
                    <i class="fa fa-tags"></i><?php echo wp_kses_post(get_the_category_list(esc_html_x(', ', 'Used between list items, there is a space after the comma.', 'smartwp')));
                    ?>
                </span>
            </li>
        </ul>
    <?php
    }
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//  Post Password form
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('smartwp_post_password_form')) :

    function smartwp_post_password_form() {
        global $post;
        $smartwp_label_text = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);

        return '
        <div class="row">
            <form class="clearfix" action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
                <div class="col-md-12">
                    <label for="' . $smartwp_label_text . '">' . esc_html__("This post is password protected. To view it please enter your password below:", 'smartwp') . '</label>
                    <div class="input-group">
                        <input class="form-control" name="post_password" placeholder="' . esc_attr__("Password:", 'smartwp') . '" id="' . $smartwp_label_text . '" type="password" /><div class="input-group-btn"><button class="btn btn-primary" type="submit" name="Submit">' . esc_attr__("Submit", 'smartwp') . '</button></div>
                    </div>
                </div>
            </form>
        </div>';
    }

    add_filter('the_password_form', 'smartwp_post_password_form');
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Breadcrumb
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('smartwp_breadcrumbs')) :

    function smartwp_breadcrumbs(){ ?>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo esc_url(site_url()); ?>"><?php esc_html_e('Home', 'smartwp') ?></a>
            </li>
            <li class="active">
                <?php if( is_tag() ) { ?>
                <?php esc_html_e('Posts Tagged ', 'smartwp') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
                <?php } elseif (is_day()) { ?>
                <?php esc_html_e('Posts made in', 'smartwp') ?> <?php echo esc_html(get_the_time('F jS, Y')); ?>
                <?php } elseif (is_month()) { ?>
                <?php esc_html_e('Posts made in', 'smartwp') ?> <?php echo esc_html(get_the_time('F, Y')); ?>
                <?php } elseif (is_year()) { ?>
                <?php esc_html_e('Posts made in', 'smartwp') ?> <?php echo esc_html(get_the_time('Y')); ?>
                <?php } elseif (is_search()) { ?>
                <?php esc_html_e('Search results for', 'smartwp') ?> <?php the_search_query() ?>
                <?php } elseif (is_404()) { ?>
                <?php esc_html_e('404', 'smartwp') ?>
                <?php } elseif (is_single()) { ?>
                <?php $category = get_the_category();
                if ( $category ) { 
                    $catlink = get_category_link( $category[0]->cat_ID );
                    echo ('<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> '.'<span class="raquo"> /</span> ');
                }
                echo get_the_title(); ?>
                <?php } elseif (is_category()) { ?>
                <?php single_cat_title(); ?>
                <?php } elseif (is_tax()) { ?>
                <?php 
                $smartwp_taxonomy_links = array();
                $smartwp_term = get_queried_object();
                $smartwp_term_parent_id = $smartwp_term->parent;
                $smartwp_term_taxonomy = $smartwp_term->taxonomy;

                while ( $smartwp_term_parent_id ) {
                    $smartwp_current_term = get_term( $smartwp_term_parent_id, $smartwp_term_taxonomy );
                    $smartwp_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $smartwp_current_term, $smartwp_term_taxonomy ) ) . '" title="' . esc_attr( $smartwp_current_term->name ) . '">' . esc_html( $smartwp_current_term->name ) . '</a>';
                    $smartwp_term_parent_id = $smartwp_current_term->parent;
                }

                if ( !empty( $smartwp_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', array_reverse( $smartwp_taxonomy_links ) ) . ' <span class="raquo">/</span> ';

                echo esc_html( $smartwp_term->name ); 
                } elseif (is_author()) { 
                    global $wp_query;
                    $curauth = $wp_query->get_queried_object();
                    esc_html_e('Posts by: ', 'smartwp'); echo ' ',$curauth->nickname; 
                } elseif (is_page()) { 
                    echo get_the_title(); 
                } elseif (is_home()) { 
                    esc_html_e('Blog', 'smartwp');
                } elseif (class_exists('WooCommerce') and (is_shop())){
                    esc_html_e('Shop', 'smartwp');
                } ?>
            </li>
        </ul>
    <?php
    }
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Page header section background title
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('smartwp_page_header_section_title')) :
    function smartwp_page_header_section_title() {
        $smartwp_query = get_queried_object();

        if (is_archive()) :
            if (is_day()) :
                $archive_title = get_the_time('d F, Y');
                $page_header_title = sprintf(esc_html__('Archive of : %s', 'smartwp'), $archive_title);
            elseif (is_month()) :
                $archive_title = get_the_time('F Y');
                $page_header_title = sprintf(esc_html__('Archive of : %s', 'smartwp'), $archive_title);
            elseif (is_year()) :
                $archive_title = get_the_time('Y');
                $page_header_title = sprintf(esc_html__('Archive of : %s', 'smartwp'), $archive_title);
            endif;
        endif;

        if (is_404()) :
            $page_header_title = esc_html__('404 Not Found', 'smartwp');
        endif;

        if (is_search()) :
            $page_header_title = sprintf(esc_html__('Search result for: "%s"', 'smartwp'), get_search_query());
        endif;

        if (is_category()) :
            $page_header_title = sprintf(esc_html__('Category: %s', 'smartwp'), $smartwp_query->name);
        endif;

        if (is_tag()) :
            $page_header_title = sprintf(esc_html__('Tag: %s', 'smartwp'), $smartwp_query->name);
        endif;

        if (is_author()) :
            $page_header_title = sprintf(esc_html__('Posts of: %s', 'smartwp'), $smartwp_query->display_name);
        endif;

        if (is_page()) :
            $page_header_title = $smartwp_query->post_title;
        endif;

        if (is_home() ) :
            $page_header_title = smartwp_option('blog-title');
        endif;

        if (is_single()) :
            $page_header_title = get_the_title();
        endif;

        $page_header_title = apply_filters('smartwp_page_header_section_title', $page_header_title, $page_header_title);

        if (empty($page_header_title)) :
            $page_header_title = get_bloginfo('name');
        endif;

        return $page_header_title;
    }
endif;
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Page header section background image
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('smartwp_page_header_background')) :

    function smartwp_page_header_background() {
        
        $image_src='';

        return $image_src;
    }

endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Comment form
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('smartwp_comment_form')) :

    function smartwp_comment_form($args = array(), $post_id = NULL) {
        if (NULL === $post_id) {
            $post_id = get_the_ID();
        } else {
            $id = $post_id;
        }

        $commenter = wp_get_current_commenter();
        $user = wp_get_current_user();
        $user_identity = $user->exists() ? $user->display_name : '';

        if (!isset($args[ 'format' ])) {
            $args[ 'format' ] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
        }

        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $html5 = 'html5' === $args[ 'format' ];
        $fields = array(
            'author' => '
            <div class="form-group">
                <div class="col-sm-6 comment-form-author">
                    <input   class="form-control"  id="author"
                    placeholder="' . esc_attr__('Name*', 'smartwp') . '" name="author" type="text"
                    value="' . esc_attr($commenter[ 'comment_author' ]) . '" ' . $aria_req . ' />
                </div>',
            'email'  => '<div class="col-sm-6 comment-form-email">
                <input id="email" class="form-control" name="email"
                placeholder="' . esc_attr__('Email*', 'smartwp') . '" ' . ($html5 ? 'type="email"' : 'type="text"') . '
                value="' . esc_attr($commenter[ 'comment_author_email' ]) . '" ' . $aria_req . ' />
            </div>
        </div>',
            'url'    => '<div class="form-group">
        <div class=" col-sm-12 comment-form-url">' .
                '<input  class="form-control" placeholder="' . esc_attr__('Website', 'smartwp') . '"  id="url" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter[ 'comment_author_url' ]) . '"  />
        </div></div>',

        );

        $required_text = sprintf(' ' . esc_html__('Required fields are marked %s', 'smartwp'), '<span class="required">*</span>');
        $defaults = array(
            'fields'               => apply_filters('comment_form_default_fields', $fields),
            'comment_field'        => '
            <div class="form-group comment-form-comment">
                <div class="col-sm-12">
                    <textarea class="form-control" id="comment" name="comment" placeholder="' . esc_html__('Comment','smartwp') . '" rows="5" aria-required="true"></textarea>
                </div>
            </div>
            ',
            'must_log_in'          => '
            <div class="alert alert-danger must-log-in">' 
            . sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'smartwp' ), array( 'a' => array( 'href' => array() ) ) ), wp_login_url( apply_filters( 'the_permalink', esc_url( get_permalink( $post_id ) ) ) ) ) . '</div>',
            'logged_in_as'         => '<div class="alert alert-info logged-in-as">' . sprintf( wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'smartwp' ), array( 'a' => array( 'href' => array() ) ) ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', esc_url( get_permalink( $post_id ) ) ) ) ) . '</div>',
            'comment_notes_before' => '<div class="alert alert-info comment-notes">' . esc_html__( 'Your email address will not be published.', 'smartwp' ) . ( $req ? $required_text : '' ) . '</div>',
            'id_form'              => 'commentform',
            'id_submit'            => 'submit',
            'title_reply'          => esc_html__( 'Leave a Reply', 'smartwp' ),
            'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'smartwp' ),
            'cancel_reply_link'    => esc_html__( 'Cancel reply', 'smartwp' ),
            'label_submit'         => esc_html__( 'Submit Comment', 'smartwp' ),
            'format'               => 'xhtml',
        );

        $args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));

        if (comments_open($post_id)) {
            ?>
            <?php do_action('comment_form_before'); ?>
            <div id="respond" class="comment-respond">
                <h3 id="reply-title" class="comment-reply-title">
                    <?php comment_form_title($args[ 'title_reply' ], $args[ 'title_reply_to' ]); ?>
                    <small><?php cancel_comment_reply_link($args[ 'cancel_reply_link' ]); ?></small>
                </h3>

                <?php if (get_option('comment_registration') && !is_user_logged_in()) { ?>
                    <?php echo wp_kses_post($args[ 'must_log_in' ]); ?>
                    <?php do_action('comment_form_must_log_in_after'); ?>
                <?php } else { ?>
                    <form action="<?php echo esc_url(site_url('/wp-comments-post.php')); ?>" method="post"
                          id="<?php echo esc_attr($args[ 'id_form' ]); ?>"
                          class="form-horizontal comment-form"<?php echo wp_kses_post($html5) ? ' novalidate' : ''; ?>
                          role="form">
                        <?php do_action('comment_form_top'); ?>
                        <?php if (is_user_logged_in()) { ?>
                            <?php echo apply_filters('comment_form_logged_in', $args[ 'logged_in_as' ], $commenter, $user_identity); ?>
                            <?php do_action('comment_form_logged_in_after', $commenter, $user_identity); ?>
                        <?php } else { ?>
                            <?php echo wp_kses_post($args[ 'comment_notes_before' ]); ?>
                            <?php
                            do_action('comment_form_before_fields');
                            foreach ((array) $args[ 'fields' ] as $name => $field) {
                                echo apply_filters("comment_form_field_{$name}", $field) . "\n";
                            }
                            do_action('comment_form_after_fields');
                             }
                            echo apply_filters('comment_form_field_comment', $args[ 'comment_field' ]);
                            ?>
                        <div class="form-submit">
                            <input class="btn btn-primary btn-lg" name="submit" type="submit"
                                   id="<?php echo esc_attr($args[ 'id_submit' ]); ?>"
                                   value="<?php echo esc_attr($args[ 'label_submit' ]); ?>"/>
                            <?php comment_id_fields($post_id); ?>
                        </div>
                        <?php do_action('comment_form', $post_id); ?>
                    </form>
                <?php } ?>
            </div><!-- #respond -->
            <?php do_action('comment_form_after'); ?>
        <?php } else { ?>
            <?php do_action('comment_form_comments_closed'); ?>
        <?php } ?>
    <?php
    }
endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Comments list
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists("smartwp_comments_list")) :

    function smartwp_comments_list($comment, $args, $depth) {
        $GLOBALS[ 'comment' ] = $comment;
        switch ($comment->comment_type) {
            // Display trackbacks differently than normal comments.
            case 'pingback' :
            case 'trackback' :
                ?>

                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                  <strong><?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('(Edit)', 'smartwp'), '<span class="edit-link">', '</span>'); ?></strong>
                  <?php  comment_text(); ?>

                <?php
                break;

            default :
                // Proceed with normal comments.
                global $post;
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>" class="comment media">
                    <div class="comment-author clearfix">
                        <div class="comment-meta media-heading">
                            <div class="media-left">
                                <?php
                                    $get_avatar = get_avatar($comment, apply_filters('smartwp_post_comment_avatar_size', 60));
                                    $avatar_img = smartwp_get_avatar_url($get_avatar);
                                    //Comment author avatar
                                ?>
                                <img class="avatar" src="<?php echo esc_attr($avatar_img); ?>" alt="<?php echo esc_html( get_comment_author()); ?>">
                            </div>
                            <div class="media-body">
                                <div class="comment-info">
                                    <div class="comment-author">
                                        <?php echo esc_html( get_comment_author()); ?>
                                    </div>
                                    <time datetime="<?php echo get_comment_date(); ?>">
                                        <?php echo get_comment_date(); ?> <?php echo get_comment_time(); ?>
                                        <?php edit_comment_link(esc_html__('Edit', 'smartwp'), '<span class="edit-link">', '</span>'); //edit link
                                        ?>
                                    </time>
                                    <i class="fa fa-comment-o"></i>
                                    <?php comment_reply_link(array_merge($args, array(
                                        'reply_text' => esc_html__('Reply', 'smartwp'),
                                        'depth'      => $depth,
                                        'max_depth'  => $args[ 'max_depth' ]
                                    ))); ?>
                                    
                                </div>
                                <?php if ('0' == $comment->comment_approved) { ?>
                                    <div class="alert alert-info">
                                        <?php esc_html_e('Your comment is awaiting moderation.', 'smartwp'); ?>
                                    </div>
                                <?php } ?>
                                    <?php comment_text(); //Comment text ?>
                            </div>

                        </div> <!-- .comment-meta -->
                    </div> <!-- .comment-author -->
                </div> <!-- #comment-## -->
                <?php
                break;
        } // end comment_type check

    }

endif;
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Fetching Avatar URL
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('smartwp_get_avatar_url')) :

    function smartwp_get_avatar_url($get_avatar) {
        preg_match("/src='(.*?)'/i", $get_avatar, $matches);

        return $matches[ 1 ];
    }

endif;
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Search form
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if (!function_exists('smartwp_blog_search_form')) :

    function smartwp_blog_search_form($form) {
        $form = '<form role="search" method="get" id="searchform" class="search-form" action="' . esc_url(home_url('/')) . '">
        <input type="text" class="form-control" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search', 'smartwp').'"/>
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>';

        return $form;
    }

    add_filter('get_search_form', 'smartwp_blog_search_form');

endif;

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// Remove Query Strings From Static Resources
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
if( ! function_exists( 'smartwp_remove_query_strings_1' )){
    function smartwp_remove_query_strings_1( $src ){
        $parts = explode( '?ver', $src );
        return $parts[0];
    }
}

if( ! function_exists( 'smartwp_remove_query_strings_2' )){
    function smartwp_remove_query_strings_2( $src ){
        $parts = explode( '&ver', $src );
        return $parts[0];
    }
}