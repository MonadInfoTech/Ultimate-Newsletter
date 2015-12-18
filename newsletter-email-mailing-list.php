<?php
/*
 * Plugin Name: Ultimate Subscribe (Newsletter)
 * Plugin URI: http://s-feeds.com
 * Description: Easily allow your readers to get new posts by email (automatically).
 * Author: s-feeds
 * Author URI: http://s-feeds.com
 * Version: 1.2.1
 * License: GPLv2 or later
 */

global $wpdb;

/* define the Root for URL and Document */
define('UN_DOCROOT',    dirname(__FILE__));
define('UN_PLUGURL',    plugin_dir_url(__FILE__));
define('UN_WEBROOT',    str_replace(getcwd(), home_url(), dirname(__FILE__)));
define('SF_LINK',    	"http://www.specificfeeds.com/");

/* load all files  */
include(UN_DOCROOT.'/libs/un_install_uninstall.php');
include(UN_DOCROOT.'/libs/un_Init_JqueryCss.php');
include(UN_DOCROOT.'/libs/un_subscribe_widget.php');
include(UN_DOCROOT.'/libs/un_ajax.php');
include(UN_DOCROOT.'/libs/un_displayIcon.php');
include(UN_DOCROOT.'/libs/un_socialHelper.php');

/* plugin install and uninstall hooks */
register_activation_hook(__FILE__, 'un_activate_plugin' );
register_deactivation_hook(__FILE__, 'un_deactivate_plugin');
register_uninstall_hook(__FILE__, 'un_Unistall_plugin');

//Add Subscriber form css
add_action("wp_head", "un_addStyleFunction");
function un_addStyleFunction()
{
	$option1 = unserialize(get_option('un_section1_options',false));
	$un_feediid = sanitize_text_field(get_option('un_feed_id'));
	$url = "http://www.specificfeeds.com/widgets/subscribeWidget/";
	echo $return = '';
	?>
    	<script>
			function un_processfurther(ref) {
				var feed_id = '<?php echo $un_feediid?>';
				var feedtype = 8;
				var email = jQuery(ref).find('input[name="data[Widget][email]"]').val();
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if ((email != "Enter your email") && (filter.test(email))) {
					if (feedtype == "8") {
						var url = "'.$url.'"+feed_id+"/"+feedtype;
						window.open(url, "popupwindow", "scrollbars=yes,width=1080,height=760");
						return true;
					}
				} else {
					alert("Please enter email address");
					jQuery(ref).find('input[name="data[Widget][email]"]').focus();
					return false;
				}
			}
		</script>
    	<style type="text/css" aria-selected="true">
			.un_subscribe_Popinner
			{
				<?php if(sanitize_text_field($option1['un_form_adjustment']) == 'yes') : ?>
				width: 100% !important;
				height: auto !important;
				<?php else: ?>
				width: <?php echo intval($option1['un_form_width']) ?>px !important;
				height: <?php echo intval($option1['un_form_height']) ?>px !important;
				<?php endif;?>
				<?php if(sanitize_text_field($option1['un_form_border']) == 'yes') : ?>
				border: <?php echo intval($option1['un_form_border_thickness'])."px solid ".sanitize_hex_color($option1['un_form_border_color']);?> !important;
				<?php endif;?>
				padding: 18px 0px !important;
				background-color: <?php echo sanitize_hex_color($option1['un_form_background']) ?> !important;
			}
			.un_subscribe_Popinner form
			{
				margin: 0 20px !important;
			}
			.un_subscribe_Popinner h5
			{
				font-family: <?php echo sanitize_text_field($option1['un_form_heading_font']) ?> !important;
				<?php if(sanitize_text_field($option1['un_form_heading_fontstyle']) != 'bold') {?>
				font-style: <?php echo sanitize_text_field($option1['un_form_heading_fontstyle']) ?> !important;
				<?php } else{ ?>
				font-weight: <?php echo sanitize_text_field($option1['un_form_heading_fontstyle']) ?> !important;
				<?php }?>
				color: <?php echo sanitize_hex_color($option1['un_form_heading_fontcolor']) ?> !important;
				font-size: <?php echo intval($option1['un_form_heading_fontsize'])."px" ?> !important;
				text-align: <?php echo sanitize_text_field($option1['un_form_heading_fontalign']) ?> !important;
				margin: 0 0 10px !important;
    			padding: 0 !important;
			}
			.un_subscription_form_field {
				margin: 5px 0 !important;
				width: 100% !important;
				display: inline-flex;
				display: -webkit-inline-flex;
			}
			.un_subscription_form_field input {
				width: 100% !important;
				padding: 10px 0px !important;
			}
			.un_subscribe_Popinner input[type=email]
			{
				font-family: <?php echo sanitize_text_field($option1['un_form_field_font']); ?> !important;
				<?php if(sanitize_text_field($option1['un_form_field_fontstyle']) != 'bold') {?>
				font-style: <?php echo sanitize_text_field($option1['un_form_field_fontstyle']) ?> !important;
				<?php } else{ ?>
				font-weight: <?php echo sanitize_text_field($option1['un_form_field_fontstyle']) ?> !important;
				<?php }?>
				color: <?php echo sanitize_hex_color($option1['un_form_field_fontcolor']); ?> !important;
				font-size: <?php echo intval($option1['un_form_field_fontsize'])."px" ?> !important;
				text-align: <?php echo sanitize_text_field($option1['un_form_field_fontalign']); ?> !important;
			}
			.un_subscribe_Popinner input[type=email]::-webkit-input-placeholder {
			   	font-family: <?php echo sanitize_text_field($option1['un_form_field_font']); ?> !important;
				<?php if(sanitize_text_field($option1['un_form_field_fontstyle']) != 'bold') {?>
				font-style: <?php echo sanitize_text_field($option1['un_form_field_fontstyle']) ?> !important;
				<?php } else{ ?>
				font-weight: <?php echo sanitize_text_field($option1['un_form_field_fontstyle']) ?> !important;
				<?php }?>
				color: <?php echo sanitize_hex_color($option1['un_form_field_fontcolor']); ?> !important;
				font-size: <?php echo intval($option1['un_form_field_fontsize'])."px" ?> !important;
				text-align: <?php echo sanitize_text_field($option1['un_form_field_fontalign']); ?> !important;
			}
			.un_subscribe_Popinner input[type=email]:-moz-placeholder { /* Firefox 18- */
			    font-family: <?php echo sanitize_text_field($option1['un_form_field_font']); ?> !important;
				<?php if(sanitize_text_field($option1['un_form_field_fontstyle']) != 'bold') {?>
				font-style: <?php echo sanitize_text_field($option1['un_form_field_fontstyle']) ?> !important;
				<?php } else{ ?>
				font-weight: <?php echo sanitize_text_field($option1['un_form_field_fontstyle']) ?> !important;
				<?php }?>
				color: <?php echo sanitize_hex_color($option1['un_form_field_fontcolor']); ?> !important;
				font-size: <?php echo intval($option1['un_form_field_fontsize'])."px" ?> !important;
				text-align: <?php echo sanitize_text_field($option1['un_form_field_fontalign']); ?> !important;
			}
			.un_subscribe_Popinner input[type=email]::-moz-placeholder {  /* Firefox 19+ */
			    font-family: <?php echo sanitize_text_field($option1['un_form_field_font']); ?> !important;
				<?php if(sanitize_text_field($option1['un_form_field_fontstyle']) != 'bold') {?>
				font-style: <?php echo sanitize_text_field($option1['un_form_field_fontstyle']) ?> !important;
				<?php } else{ ?>
				font-weight: <?php echo sanitize_text_field($option1['un_form_field_fontstyle']) ?> !important;
				<?php }?>
				color: <?php echo sanitize_hex_color($option1['un_form_field_fontcolor']); ?> !important;
				font-size: <?php echo intval($option1['un_form_field_fontsize'])."px" ?> !important;
				text-align: <?php echo sanitize_text_field($option1['un_form_field_fontalign']); ?> !important;
			}
			.un_subscribe_Popinner input[type=email]:-ms-input-placeholder {  
			  	font-family: <?php echo sanitize_text_field($option1['un_form_field_font']); ?> !important;
				<?php if(sanitize_text_field($option1['un_form_field_fontstyle']) != 'bold') {?>
				font-style: <?php echo sanitize_text_field($option1['un_form_field_fontstyle']) ?> !important;
				<?php } else{ ?>
				font-weight: <?php echo sanitize_text_field($option1['un_form_field_fontstyle']) ?> !important;
				<?php }?>
				color: <?php echo sanitize_hex_color($option1['un_form_field_fontcolor']); ?> !important;
				font-size: <?php echo intval($option1['un_form_field_fontsize'])."px" ?> !important;
				text-align: <?php echo sanitize_text_field($option1['un_form_field_fontalign']); ?> !important;
			}
			.un_subscribe_Popinner input[type=submit]
			{
				font-family: <?php echo sanitize_text_field($option1['un_form_button_font']); ?> !important;
				<?php if(sanitize_text_field($option1['un_form_button_fontstyle']) != 'bold') {?>
				font-style: <?php echo sanitize_text_field($option1['un_form_button_fontstyle']) ?> !important;
				<?php } else{ ?>
				font-weight: <?php echo sanitize_text_field($option1['un_form_button_fontstyle']) ?> !important;
				<?php }?>
				color: <?php echo sanitize_hex_color($option1['un_form_button_fontcolor']); ?> !important;
				font-size: <?php echo intval($option1['un_form_button_fontsize'])."px" ?> !important;
				text-align: <?php echo sanitize_text_field($option1['un_form_button_fontalign']); ?> !important;
				background-color: <?php echo sanitize_hex_color($option1['un_form_button_background']); ?> !important;
			}
		</style>
	<?php
}
//Sanitize color code
if(!function_exists(sanitize_hex_color))
{
	function sanitize_hex_color( $color )
	{
		if ( '' === $color )
			return '';
	 
		// 3 or 6 hex digits, or the empty string.
		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
			return $color;
	}
}

add_action('wp_head', 'un_ultimatefbmetatags');
function un_ultimatefbmetatags()
{
	$feed_id = get_option('un_feed_id');
	$verification_code = get_option('un_verificatiom_code');
	if(!empty($feed_id) && !empty($verification_code) && $verification_code != "no" )
	{
	    echo '<meta name="specificfeeds-verification-code-'.$feed_id.'" content="'.$verification_code.'"/>';
	}
}
//Get verification code
if(is_admin())
{	
	$code = get_option('un_verificatiom_code');
	$feed_id = get_option('un_feed_id');
	if(empty($code) && !empty($feed_id))
	{
		add_action("init", "un_getverification_code");
	}
}
function un_getverification_code()
{
	$feed_id = get_option('un_feed_id');
	$curl = curl_init();  
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://www.specificfeeds.com/wordpress/getVerifiedCode_plugin',
        CURLOPT_USERAGENT => 'sf get verification',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => array(
            'feed_id' => $feed_id
        )
    ));
     // Send the request & save response to $resp
	$resp = curl_exec($curl);
	$resp = json_decode($resp);
	update_option('un_verificatiom_code', $resp->code);
	curl_close($curl);
}

?>