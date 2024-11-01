<?php
if ( ! defined( 'ABSPATH' ) ) {
          header( 'Status: 403 Forbidden' );
          header( 'HTTP/1.1 403 Forbidden' );
          exit;
      } // Exit if accessed directly
/////////////////////////////////////// Redirection setup ///////////////////////////////////////
function add_redirect_plugin_box(){
		global $post;
		$redirect_link=get_post_meta($post->ID, 'redirect_link', true);
		$redirect_custom_text=get_post_meta($post->ID, 'redirect_custom_text', true);
		$redirect_slogan_text=get_post_meta($post->ID, 'redirect_slogan_text', true);
		$rdp_custom_logo=get_post_meta($post->ID, 'rdp_custom_logo', true);
		$rdp_target_logo=get_post_meta($post->ID, 'rdp_target_logo', true);
		?>
        <div class="plugin_wrapper">
        	<div class="box-container">
            <div class="col-md-5">
        <label><?php _e('Target Url','rdp_domain')?></label>
        <input type="url" name="redirect_link" value="<?php echo esc_url($redirect_link);?>" placeholder="E.g - https://google.com">
        </div>
        <div class="col-md-5">
        <label><?php _e('Link Redirect Text')?></label>
        <input type="text" name="redirect_custom_text" value="<?php echo $redirect_custom_text;?>" placeholder="You Can Write Custom redirection Text Here.">
        </div>
        <div class="clear"></div>
        <div class="col-md-12">
        <label><?php _e('Slogan text')?></label>
        <input type="text" name="redirect_slogan_text" value="<?php echo $redirect_slogan_text;?>" placeholder="You Can Write Custom redirection Text Here.">
        </div>
        <div class="display-inline" style="margin: 15px;width: 43%;">
        	
       <img alt="" style="max-width: 250px;" src="<?php if(empty($rdp_custom_logo)){echo RDP_PLUGIN_URL.'assets/images/demo-image.jpg';}else{echo esc_url($rdp_custom_logo) ;}?>"/>
</div>
<div class="display-inline">
<label><?php _e('Redirect Page Custom Logo')?></label>
  <input type="text" name="rdp_custom_logo" id="logo_image_url"  value="<?php echo $rdp_custom_logo ;?>" class="regular-text" style="width: 210px;display: inline-block;margin: 0px;" placeholder="Redirect Page Custom Logo Image">

  <input type="button" name="upload-btn" id="logo-upload-btn" class="button-secondary" value="Upload image" style="display: inline-block;width: 100px;margin: 0px -5px;height: 27px;border: 0px;box-shadow: none;background-color: #1baed3;color: #fff;border-radius: 0px;">
</div>
<div class="clear"></div>
        <div class="display-inline" style="margin: 15px;width: 43%;">
        	
       <img alt="" style="max-width: 250px;" src="<?php if(empty($rdp_target_logo)){echo RDP_PLUGIN_URL.'assets/images/demo-image.jpg';}else{echo esc_url($rdp_target_logo) ;}?>"/>
</div>
<div class="display-inline">
<label><?php _e('Target url site/product image')?></label>
  <input type="text" name="rdp_target_logo" id="image_url"  value="<?php echo $rdp_target_logo ;?>" class="regular-text" style="width: 210px;display: inline-block;margin: 0px;" placeholder="Target url site/product image">

  <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload image" style="display: inline-block;width: 100px;margin: 0px -5px;height: 27px;border: 0px;box-shadow: none;background-color: #1baed3;color: #fff;border-radius: 0px;">
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
       </div>
       
<script type="text/javascript">
jQuery(document).ready(function($){
jQuery('#logo-upload-btn').click(function(e) {
e.preventDefault();
var image = wp.media({ 
title: 'Upload Image',
// mutiple: true if you want to upload multiple files at once
multiple: false
}).open()
.on('select', function(e){
// This will return the selected image from the Media Uploader, the result is an object
var uploaded_image = image.state().get('selection').first();
// We convert uploaded_image to a JSON object to make accessing it easier
// Output to the console uploaded_image
console.log(uploaded_image);
var image_url = uploaded_image.toJSON().url;
// Let's assign the url value to the input field
jQuery('#logo_image_url').val(image_url);
});
});
});
</script>
<script type="text/javascript">
jQuery(document).ready(function($){
jQuery('#upload-btn').click(function(e) {
e.preventDefault();
var image = wp.media({ 
title: 'Upload Image',
// mutiple: true if you want to upload multiple files at once
multiple: false
}).open()
.on('select', function(e){
// This will return the selected image from the Media Uploader, the result is an object
var uploaded_image = image.state().get('selection').first();
// We convert uploaded_image to a JSON object to make accessing it easier
// Output to the console uploaded_image
console.log(uploaded_image);
var image_url = uploaded_image.toJSON().url;
// Let's assign the url value to the input field
jQuery('#image_url').val(image_url);
});
});
});
</script>
<?php  }
// SAVE REVIEW BOX SETTING
	function save_redirect_plugin_box($post_id,$post){
		$key='redirect_link';
		$value=sanitize_text_field($_POST['redirect_link']);
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key);
		
		$key='redirect_custom_text';
		$value=sanitize_text_field($_POST['redirect_custom_text']);
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key);
		
		$key='redirect_slogan_text';
		$value=sanitize_text_field($_POST['redirect_slogan_text']);
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key);
		
		$key='rdp_custom_logo';
		$value=sanitize_text_field($_POST['rdp_custom_logo']);
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key);
		
		$key='rdp_slogan_logo';
		$value=sanitize_text_field($_POST['rdp_slogan_logo']);
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key);
		
		$key='rdp_target_logo';
		$value=sanitize_text_field($_POST['rdp_target_logo']);
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key);
		
		
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return $post_id;
   	 }
}
add_action('save_post', 'save_redirect_plugin_box' ,1,2); // save the custom fields	
?>