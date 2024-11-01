<?php
if ( ! defined( 'ABSPATH' ) ) {
          header( 'Status: 403 Forbidden' );
          header( 'HTTP/1.1 403 Forbidden' );
          exit;
      } // Exit if accessed directly
//Include
include(RDP_PLUGIN_PATH.'modules/redirect.php');
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'rdp_flush_rewrites' );
function rdp_flush_rewrites() {
	// call your CPT registration function here (it should also be hooked into 'init')
	redirect_plugin_meta();
	flush_rewrite_rules();
}
