<?php
/*
 *add demo data
 */
function smartwp_import_file() { 
  return array(
    array(
      'import_file_name'             => __('Demo','smartwp'),
      'page_title'                   => __('Insert Demo','smartwp'),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/demo.xml',
      'import_notice'                => __( 'This import maybe finish on 5-10 minutes', 'smartwp' )
  ),
   
);
}
add_filter( 'pt-ocdi/import_files', 'smartwp_import_file' );

add_action( 'pt-ocdi/after_import', 'smartwp_after_import' );
if(!function_exists('smartwp_after_import')):
function smartwp_after_import($selected_import){
if ( 'Demo' === $selected_import['import_file_name'] ) {

  $main_menu = get_term_by('slug', 'one-page', 'nav_menu');

      set_theme_mod( 'nav_menu_locations', array(
        'one-page' => $main_menu->term_id,
      ));


    //Set Front page
       $page = get_page_by_title( 'HOME');
       if ( isset( $page->ID ) ) {
        update_option( 'page_on_front', $page->ID );
        update_option( 'show_on_front', 'page' );
       }

       $blog = get_page_by_title( 'BLOG');
       if ( isset( $page->ID ) ) {
        update_option( 'page_for_posts', $blog->ID );
        update_option( 'show_on_front', 'page' );
       }

}}
endif;
