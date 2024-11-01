<?php
//Main Meta
function add_redirect_plugin_meta() {
$post_types = array ( 'post', 'page', 'event' );
add_meta_box('redirect-plugin-box', 'Redirect Link', 'add_redirect_plugin_box', 'redirectlink', 'normal', 'high');
}
add_action( 'add_meta_boxes', 'add_redirect_plugin_meta' );
include(RDP_PLUGIN_PATH.'admin/redirect-meta.php');