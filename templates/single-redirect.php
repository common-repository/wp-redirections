<?php
if ( ! defined( 'ABSPATH' ) ) {
          header( 'Status: 403 Forbidden' );
          header( 'HTTP/1.1 403 Forbidden' );
          exit;
      } // Exit if accessed directly
/*
Template Name: Redirect template
*/
global $post;
$redirect_link=get_post_meta($post->ID, 'redirect_link', true);
$redirect_custom_text=get_post_meta($post->ID, 'redirect_custom_text', true);
$rdp_custom_logo=get_post_meta($post->ID, 'rdp_custom_logo', true);
$rdp_target_logo=get_post_meta($post->ID, 'rdp_target_logo', true);
$redirect_slogan_text=get_post_meta($post->ID, 'redirect_slogan_text', true);
$rdp_custom_css=stripslashes(get_option('rdp_custom_css'));
$rdp_custom_js=stripslashes(get_option('rdp_custom_js'));
$rdp_animated_gif=get_option('rdp_animated_gif');
if(empty($rdp_animated_gif)){
$rdp_animated_gif=RDP_PLUGIN_URL.'assets/images/loading.gif';
}
$rdp_powered_text=get_option('rdp_powered_text');
	  if($rdp_powered_text=='on'){
		$rdp_powered_text='display:none';
	  }
$rdp_delay_time=get_option('rdp_delay_time');
if(empty($rdp_delay_time)){
	$rdp_delay_time='1';
}
	$rdp_click_count = get_post_meta($post->ID, 'rdp_click_count',true );
	update_post_meta($post->ID, 'rdp_click_count', ( $rdp_click_count === '' ? 1 : $rdp_click_count + 1 ) );
  ?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style><?php echo $rdp_custom_css;?>
</style>
<script>
<?php echo $rdp_custom_js;?>
</script>
  <style>
  .clear {
	clear: both;
}
.display-inline {
	display: inline-block;
	vertical-align: middle;
}
  body {
    background:#fff;
    font-family: "Century Gothic",Arial, Helvetica, sans-serif;
	margin: 0;
}
.redirect-page-content {
	margin:3% auto;
	max-width: 1130px;
	text-align: center;
	position: relative; 
}
.redirect-page-header img{
	max-width: 200px;
}
.rp-slogan-text{
	margin-top:5%;
}</style>
   <script>
		var count=<?php echo $rdp_delay_time;?>;
		var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
		function timer()
		{
		  count=count-1;
 		 if (count <= 0)
		  {
 	    clearInterval(counter);
 	    //counter ended, do something here
 	    return;
 		 }
	  document.getElementById("timer").innerHTML=count + " secs"; // watch for spelling
	}
	</script>
<title><?php echo $redirect_custom_text;?></title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="refresh" content="<?php echo $rdp_delay_time;?>;url=<?php echo $redirect_link;?>" />
</head>
<body>
<div class="redirect-wrap">
 <div class="redirect-page-content">
  <div class="redirect-page-header"><img src="<?php echo $rdp_custom_logo;?>">
   <p><?php echo $redirect_slogan_text;?></p>
  </div>
  <div class="rp-slogan-text">
   <div class="display-inline" style="width:55%;text-align:right;">
    <h4><?php echo $redirect_custom_text;?></h4>
   </div>
   <div class="display-inline" style="width:40%;text-align:left;"><span><img src="<?php echo $rdp_target_logo;?>" style="max-width:80px;"></span></div>
  </div>
  <div> <img src="<?php echo $rdp_animated_gif;?>" alt="loading..."  style="max-width: 200px;"> </div>
     <div style="margin: 10px 90px 50px;">Wait for <span id="timer"></span></div>
 </div>
 <div style="position: absolute;bottom: 10px;width: 100%;text-align: center;<?php echo $rdp_powered_text;?>"> Powered by Redirect Plugin </div>
</div>
</body>
</html>
<?php  ?>
