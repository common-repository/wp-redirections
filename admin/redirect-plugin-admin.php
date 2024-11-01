<?php
if ( ! defined( 'ABSPATH' ) ) {
          header( 'Status: 403 Forbidden' );
          header( 'HTTP/1.1 403 Forbidden' );
          exit;
      } // Exit if accessed directly
	  if(isset($_POST['rdp_submit'])){
		$rdp_custom_slug=sanitize_text_field($_POST['rdp_custom_slug']);
		update_option('rdp_custom_slug',$rdp_custom_slug);
		$rdp_delay_time=sanitize_text_field($_POST['rdp_delay_time']);
		update_option('rdp_delay_time',$rdp_delay_time);
		$rdp_animated_gif=sanitize_text_field($_POST['rdp_animated_gif']);
		update_option('rdp_animated_gif',$rdp_animated_gif);
		$rdp_powered_text=sanitize_text_field($_POST['rdp_powered_text']);
		update_option('rdp_powered_text',$rdp_powered_text);
		$rdp_custom_css=$_POST['rdp_custom_css'];
		update_option('rdp_custom_css',$rdp_custom_css);
		$rdp_custom_js=$_POST['rdp_custom_js'];
		update_option('rdp_custom_js',$rdp_custom_js);
	  }
	  $rdp_custom_slug=get_option('rdp_custom_slug');
	  $rdp_delay_time=get_option('rdp_delay_time');
	  $rdp_animated_gif=get_option('rdp_animated_gif');
	  $rdp_custom_css=stripslashes(get_option('rdp_custom_css'));
	  $rdp_custom_js=stripslashes(get_option('rdp_custom_js'));
	  $rdp_powered_text=get_option('rdp_powered_text');
	  if($rdp_powered_text=='on'){
		$rdp_powered_text='checked';
	  }?>

<div class="livertigo-container">
  <div class="livertigo-header">
    <div class="livertigo-header-logo"> <img width="300px" src="<?php echo RDP_PLUGIN_URL; ?>assets/images/logo.png">
      <div class="livertigo-header-button"> <a href="http://redirectplugin.com" class="button" target="_blank" style=" text-decoration: none; ">Help Guide</a> <a href="http://redirectplugin.com/contact-us" class="button" target="_blank" style=" text-decoration: none; ">Contact Us</a></div>
    </div>
  </div>
  <div class="livertigo-body">
    <div class="livertigo-navigation">
      <ul>
        <li data-id="dashboard" class="actv"><i style="margin-right: 5px;" class="fa fa-desktop"></i>Dashboard</li>
        <li data-id="help"><i style="margin-right: 5px;" class="fa fa-book"></i>Help</li>
      </ul>
    </div>
    <div class="livertigo-main-content container">
      <div class="tabc actv" id="dashboard">
        <div class="row">
            <div class="col-md-12">
              <div style="
    width: 150px;
    margin: 30px 10px;
    display: inline-block;
">
              <div class="dashboard-box" style="
    background-color: #1baed3;
    padding: 10px;
    text-align: center;
    color: #fff;
    border-radius: 5px;
    border: 3px solid #d8d8d8;
    box-shadow: inset 0px 0px 10px 1px #24798e;
">
                <h4 style="
    font-size: 40px;
    margin: 5px;
    color: #fff;
"><?php echo wp_count_posts( 'redirectlink' )->publish;?></h4>
                <div>Total Links</div>
              </div>
              </div>
              <div class="clear"></div>
            <hr>
            </div>
            <div class="plugin-dashboard">
            <div class="plugin_wrapper">
        	<div class="box-container">
            <form method="post">
            <div class="col-md-5">
            <label><?php _e('Slug text')?> </label>
            <input type="text" name="rdp_custom_slug" placeholder="Slug of redirect URL" value="<?php echo $rdp_custom_slug;?>">
            <div class="clear"></div>
            <span class="help-text" style="
    font-size: 11px;
    color: #ff0a0a;
"><?php _e('Note: When you change the slug flush the permalink by click on save in setting->permalink','rdp_domain')?></span>
            </div>
             <div class="col-md-5">
             <label><?php _e('Delay time')?> </label>
            <input type="text" name="rdp_delay_time" placeholder="Delay time in second" value="<?php echo $rdp_delay_time;?>">
            </div>
            <div class="clear"></div>
            <div class="display-inline" style="margin: 15px 175px 15px 15px;">
            <img alt="" style="max-width:250px;" src="<?php if(empty($rdp_animated_gif)){echo RDP_PLUGIN_URL.'assets/images/demo-image.jpg';}else{echo esc_url($rdp_animated_gif) ;}?>"/>
            </div>
            <div class="display-inline">
            <input type="text" name="rdp_animated_gif" id="image_url"  value="<?php echo $rdp_animated_gif ;?>" class="regular-text" style="
    width: 300px;
    display: inline-block;
    margin: 0px;
    height: 30px;
">
            <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload image" style="
    display: inline-block;
    width: 100px;
    margin: 0px -5px;
    height: 30px;
    border: 0px;
    box-shadow: none;
    background-color: #1baed3;
    color: #fff;
    border-radius: 0px;
">
            </div>
            <div class="clear"></div>
            <div>
             <div class="col-md-5">
             <label><?php _e('Custom Css')?> </label>
             <textarea name="rdp_custom_css" style="width:350px; height:300px"><?php echo $rdp_custom_css;?></textarea>
             </div>
             <div class="col-md-5">
             <label><?php _e('Custom Javascript')?> </label>
             <textarea name="rdp_custom_js" style="width:350px; height:300px"><?php echo $rdp_custom_js;?></textarea>
             </div>
            </div>
 <div class="col-md-1 t-right">
 <input type="checkbox" name="rdp_powered_text" <?php echo $rdp_powered_text;?>>
 </div>
 <div class="col-md-10">
 <label>Do not show "<strong>Powered by Redirect Plugin</strong>" text</label>
 </div>
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
<div class="clear"></div>
            <input type="submit" value="Save" class="li-btn" name="rdp_submit">
            </form>
            </div>
            </div>
            </div>
        </div>
        </div>
        <div class="tabc" id="help">
        <div class="row">
            <div class="col-md-12">
            <h3>Help</h3>
            
            </div>
        </div>
        </div>
      </div>
      </div>
      </div>
<script>
$('.form-control').click(function() {
    $('#livertigo_save').css({
        'background-color': '#f03325',
		'box-shadow': 'inset 0px 0px 10px 0px #b72b20',
		'border':'1px solid #ccc',		
    });
});
</script> 
<script>
jQuery(".livertigo-navigation ul li").click(function(){
var id=jQuery(this).attr("data-id");
jQuery(".tabc").hide();
jQuery("#"+id).show();
jQuery(".livertigo-navigation ul li").removeClass("actv");
jQuery(this).addClass("actv");
});
</script> 
<script>
$(document).ready(function(){
$("upper p").css("display", "block");
});
</script>