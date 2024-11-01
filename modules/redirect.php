<?php 
if ( ! defined( 'ABSPATH' ) ) {
          header( 'Status: 403 Forbidden' );
          header( 'HTTP/1.1 403 Forbidden' );
          exit;
      } // Exit if accessed directly
//Add Coupon
function redirect_plugin_meta() {   
 $rdp_custom_slug=get_option('rdp_custom_slug');
 if(empty($rdp_custom_slug)){
	 $rdp_custom_slug='go';
 }
	    $labels = array(
	        'name' => 'Redirect Links',
	        'singular_name' => 'redirectlinks',
	        'add_new' => 'Add New ',
	        'add_new_item' => 'Add New Link',
	        'edit_item' => 'Edit Link',
	        'new_item' => 'New Link',
	        'all_items' => 'All Link',
	        'view_item' => 'View Link',
	        'search_items' => 'Search Link',
	        'not_found' =>  'No Link Found',
	        'not_found_in_trash' => 'No Link found in Trash',
	        'parent_item_colon' => '',
	        'menu_name' => 'Redirect Links',
	    );
	    register_post_type(
	        'redirectlink',
							array(
								'labels' => $labels,
								'has_archive' =>false,
								'public' => true,
								'show_ui' => true,
								'menu_position' => 8,
								'menu_icon'     => RDP_PLUGIN_URL.'assets/images/symbol_logo.png',
								'can_export'    => true,
								'rewrite' => array( 'slug' => $rdp_custom_slug),
								'supports' => array('title'),
								'exclude_from_search' => false,
								'capability_type' => 'post',
	            'register_meta_box_cb' => 'add_redirect_plugin_meta',
	            'publicly_queryable'  => true,	          
	        )
	    );
	}
add_action( 'init', 'redirect_plugin_meta' );
function redirect_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    redirect_plugin_meta();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'redirect_rewrite_flush' );
?>