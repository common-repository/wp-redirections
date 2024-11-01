<?php
/*
Plugin Name: Redirect plugin
Plugin URI: http://redirectplugin.com
Description: Redirect plugin is an 301 link Redirection WordPress Plugin. Use this plugin to redirect links with a intermediate page.
Author: Jay Kapoor
Version: 1.0.2
Author URI: https://redirectplugin.com
Copyright: (c) 2017 Jay Kapoor
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
if (! defined('ABSPATH')) {
   header( 'Status: 403 Forbidden' );
   header( 'HTTP/1.1 403 Forbidden' );
exit;
}
// Exit if accessed directly
define( 'RDP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );	
define( 'RDP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'RDP_PLUGIN_VERSION', '1.0.2' );		  
//Include
include(RDP_PLUGIN_PATH.'modules/redirect.php');
//Admin
function redirect_plugin_admin(){
include(RDP_PLUGIN_PATH.'admin/redirect-plugin-admin.php'); 
}
include(RDP_PLUGIN_PATH.'admin/meta.php');
//WP Dashboard title
function redirect_plugin_menu_page() {
    add_menu_page(
        __('Redirect plugin','textdomain'),
        'Redirect plugin',
        'manage_options',
        'redirectplugin',
        'redirect_plugin_admin',
        RDP_PLUGIN_URL.'assets/images/symbol_logo.png',
        99);
}
add_action( 'admin_menu', 'redirect_plugin_menu_page' );
//include plugin stylesheet
function redirect_plugin_scripts() {
wp_enqueue_style( 'redirect_plugin_style', RDP_PLUGIN_URL.'style.css',false,RDP_PLUGIN_VERSION,'all');
wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'redirect_plugin_scripts' );
function redirect_plugin_admin_scripts() {
wp_enqueue_script('jquery');
wp_enqueue_media();
wp_enqueue_style( 'redirect_plugin_fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',false,RDP_PLUGIN_VERSION,'all');
wp_enqueue_style( 'redirect_plugin_admin-css', RDP_PLUGIN_URL.'assets/css/admin-css.css',false,RDP_PLUGIN_VERSION,'all');
}
add_action( 'admin_enqueue_scripts', 'redirect_plugin_admin_scripts',99 );
add_filter( 'template_include', 'redirect_plugin_template_function', 1 );
function redirect_plugin_template_function( $template_path ) {
    if (get_post_type() == 'redirectlink' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-redirect.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = RDP_PLUGIN_PATH.'/templates/single-redirect.php';
            }
        }else{
		 //No Post
	}
    }
    return $template_path;
}
// click counter
add_filter( 'manage_redirectlink_posts_columns', 'my_edit_redirectlink_columns' ) ;
function my_edit_redirectlink_columns( $columns ) {
	$columns = array(
	'cb' => '<input type="checkbox" />',
		'title' => __( 'Links' ),
		'Clicks' => __( 'Click counts' ),
		'Url' => __( 'Short Link' ),
		'date' => __( 'Date' )
	);
	return $columns;
}
add_action( 'manage_redirectlink_posts_custom_column', 'my_manage_redirectlink_columns', 10, 2 );
function my_manage_redirectlink_columns( $column, $post_id ) {
		global $post;
		switch( $column ) {
		/* If displaying the 'duration' column. */
		case 'Clicks' :
			/* Get the post meta. */
			$Clicks =  get_post_meta($post->ID, 'rdp_click_count',true );
			/* If no duration is found, output a default message. */
			if (empty($Clicks))
				echo __( '0 Clicks' );
			/* If there is a duration, append 'minutes' to the text string. */
			else
				printf( __( '%s Clicks' ), $Clicks );
			break;
		case 'Url' :
			/* Get the permalink. */
			$permalink =  get_permalink($post->ID);
			printf( __( '<input type="text" value="%s">' ), $permalink  );
			break;
	}
}	
// Notice
function rdp_admin_notice(){
	if(get_option('rdp_permalink')!=='1'){
    echo '<div class="error">
       <p>Before Start with Redirect Plugin you need to Flush Permalink cache. For this you need to <a href="'.get_site_url().'/wp-admin/options-permalink.php">Visit Permalink Setting</a> & click on <strong>save</strong> button.<span style="float: right;"><a href="'.get_site_url().'/wp-admin/edit.php?post_type=redirectlink&rdp_permalink=1"><span style="margin: 10px;font-size: 11px;color: #f50;">Close it if already flushed</span><i class="fa fa-times"></i></a></span></p>	   
    </div>';
	}	
}
add_action('admin_notices', 'rdp_admin_notice');
if($_GET['rdp_permalink']=='1'){
	update_option('rdp_permalink','1');	
}