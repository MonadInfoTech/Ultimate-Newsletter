<?php
/* save settings for section 1 */ 
add_action('wp_ajax_unsave1','un_options_unsave1');
function un_options_unsave1()
{
	if ( !wp_verify_nonce( $_POST['nonce'], "update_step1")) {
      echo  json_encode(array("wrong_nonce")); exit;
   	}
	$un_form_adjustment			= isset($_POST["un_form_adjustment"]) ? $_POST["un_form_adjustment"] : 'yes';
	$un_form_height				= isset($_POST["un_form_height"]) ? $_POST["un_form_height"] : '180';
	$un_form_width				= isset($_POST["un_form_width"]) ? $_POST["un_form_width"] : '230';
	$un_form_border				= isset($_POST["un_form_border"]) ? $_POST["un_form_border"] : 'no';
	$un_form_border_thickness	= isset($_POST["un_form_border_thickness"]) ? $_POST["un_form_border_thickness"] : '1';
	$un_form_border_color		= isset($_POST["un_form_border_color"]) ? $_POST["un_form_border_color"] : '#f3faf2';
	$un_form_background			= isset($_POST["un_form_background"]) ? $_POST["un_form_background"] : '#eff7f7';
	
	$un_form_heading_text		= isset($_POST["un_form_heading_text"]) ? $_POST["un_form_heading_text"] : '';
	$un_form_heading_font		= isset($_POST["un_form_heading_font"]) ? $_POST["un_form_heading_font"] : '';
	$un_form_heading_fontstyle  = isset($_POST["un_form_heading_fontstyle"]) ? $_POST["un_form_heading_fontstyle"] : '';
	$un_form_heading_fontcolor  = isset($_POST["un_form_heading_fontcolor"]) ? $_POST["un_form_heading_fontcolor"] : '';
	$un_form_heading_fontsize	= isset($_POST["un_form_heading_fontsize"]) ? $_POST["un_form_heading_fontsize"] : '22';
	$un_form_heading_fontalign	= isset($_POST["un_form_heading_fontalign"]) ? $_POST["un_form_heading_fontalign"] :'center';
	
	$un_form_field_text			= isset($_POST["un_form_field_text"]) ? $_POST["un_form_field_text"] : '';
	$un_form_field_font			= isset($_POST["un_form_field_font"]) ? $_POST["un_form_field_font"] : '';
	$un_form_field_fontstyle	= isset($_POST["un_form_field_fontstyle"]) ? $_POST["un_form_field_fontstyle"] : '';
	$un_form_field_fontcolor	= isset($_POST["un_form_field_fontcolor"]) ? $_POST["un_form_field_fontcolor"] : '';
	$un_form_field_fontsize		= isset($_POST["un_form_field_fontsize"]) ? $_POST["un_form_field_fontsize"] : '22';
	$un_form_field_fontalign	= isset($_POST["un_form_field_fontalign"]) ? $_POST["un_form_field_fontalign"] :'center';
	
	$un_form_button_text		= isset($_POST["un_form_button_text"]) ? $_POST["un_form_button_text"] : 'Subscribe';
	$un_form_button_font		= isset($_POST["un_form_button_font"]) ? $_POST["un_form_button_font"] : '';
	$un_form_button_fontstyle	= isset($_POST["un_form_button_fontstyle"]) ? $_POST["un_form_button_fontstyle"] : '';
	$un_form_button_fontcolor	= isset($_POST["un_form_button_fontcolor"]) ? $_POST["un_form_button_fontcolor"] : '';
	$un_form_button_fontsize	= isset($_POST["un_form_button_fontsize"]) ? $_POST["un_form_button_fontsize"] : '22';
	$un_form_button_fontalign	= isset($_POST["un_form_button_fontalign"]) ? $_POST["un_form_button_fontalign"] :'center';
	$un_form_button_background	= isset($_POST["un_form_button_background"]) ? $_POST["un_form_button_background"]:'#5a6570';
	
	/* icons pop options */
	$up_option1 = array(	
		'un_form_adjustment'		=>	sanitize_text_field($un_form_adjustment),
		'un_form_height'			=>	intval($un_form_height),
		'un_form_width'				=>	intval($un_form_width),
		'un_form_border'			=>	sanitize_text_field($un_form_border),
		'un_form_border_thickness'	=>	intval($un_form_border_thickness),
		'un_form_border_color'		=>	sanitize_hex_color($un_form_border_color),
		'un_form_background'		=>	sanitize_hex_color($un_form_background),
		
		'un_form_heading_text'		=>	sanitize_text_field(stripslashes($un_form_heading_text)),
		'un_form_heading_font'		=>	sanitize_text_field($un_form_heading_font),
		'un_form_heading_fontstyle'	=>	sanitize_text_field($un_form_heading_fontstyle),
		'un_form_heading_fontcolor'	=>	sanitize_hex_color($un_form_heading_fontcolor),
		'un_form_heading_fontsize'	=>	intval($un_form_heading_fontsize),
		'un_form_heading_fontalign'	=>	sanitize_text_field($un_form_heading_fontalign),
		
		'un_form_field_text'		=>	sanitize_text_field(stripslashes($un_form_field_text)),
		'un_form_field_font'		=>	sanitize_text_field($un_form_field_font),
		'un_form_field_fontstyle'	=>	sanitize_text_field($un_form_field_fontstyle),
		/*'un_form_field_fontcolor'	=>	sanitize_hex_color($un_form_field_fontcolor),*/
		'un_form_field_fontsize'	=>	intval($un_form_field_fontsize),
		'un_form_field_fontalign'	=>	sanitize_text_field($un_form_field_fontalign),
		
		'un_form_button_text'		=>	sanitize_text_field(stripslashes($un_form_button_text)),
		'un_form_button_font'		=>	sanitize_text_field($un_form_button_font),
		'un_form_button_fontstyle'	=>	sanitize_text_field($un_form_button_fontstyle),
		'un_form_button_fontcolor'	=>	sanitize_hex_color($un_form_button_fontcolor),
		'un_form_button_fontsize'	=>	intval($un_form_button_fontsize),
		'un_form_button_fontalign'	=>	sanitize_text_field($un_form_button_fontalign),
		'un_form_button_background'	=>	sanitize_hex_color($un_form_button_background),
	);
	
	if(un_arrayFilter($up_option1))
	{
		header('Content-Type: application/json');
    	echo  json_encode(array("")); exit;
	}
	
	update_option('un_section1_options',serialize($up_option1)); 
    header('Content-Type: application/json');
    echo  json_encode(array("success")); exit;
}
/* save settings for section 1 */ 
add_action('wp_ajax_unsave2','un_options_unsave2');
function un_options_unsave2()
{
	if ( !wp_verify_nonce( $_POST['nonce'], "update_step2")) {
      echo  json_encode(array("wrong_nonce")); exit;
   	}
	$un_rectsub			= isset($_POST["un_rectsub"]) ? $_POST["un_rectsub"] : '';
	$un_rectfb			= isset($_POST["un_rectfb"]) ? $_POST["un_rectfb"] : '';
	$un_rectgp			= isset($_POST["un_rectgp"]) ? $_POST["un_rectgp"] : '';
	$un_recttwtr		= isset($_POST["un_recttwtr"]) ? $_POST["un_recttwtr"] : '';
	$un_rectshr			= isset($_POST["un_rectshr"]) ? $_POST["un_rectshr"] : '';
	$un_textBefor_icons	= isset($_POST["un_textBefor_icons"]) ? $_POST["un_textBefor_icons"] : '';
	$un_DisplayCounts	= isset($_POST["un_DisplayCounts"]) ? $_POST["un_DisplayCounts"] : '';
	
	$un_icons_alignment	= isset($_POST["un_icons_alignment"]) ? $_POST["un_icons_alignment"] : '';
	$un_onpostBefore	= isset($_POST["un_onpostBefore"]) ? $_POST["un_onpostBefore"] : '';
	$un_onpostAfter  	= isset($_POST["un_onpostAfter"]) ? $_POST["un_onpostAfter"] : '';
	$un_onhomeBefore  	= isset($_POST["un_onhomeBefore"]) ? $_POST["un_onhomeBefore"] : '';
	$un_onhomeAfter		= isset($_POST["un_onhomeAfter"]) ? $_POST["un_onhomeAfter"] : '';
	
	/* icons pop options */
	$up_option2 = array(	
		'un_rectsub'		=>	sanitize_text_field($un_rectsub),
		'un_rectfb'			=>	sanitize_text_field($un_rectfb),
		'un_rectgp'			=>	sanitize_text_field($un_rectgp),
		'un_recttwtr'		=>	sanitize_text_field($un_recttwtr),
		'un_rectshr'		=>	sanitize_text_field($un_rectshr),
		'un_DisplayCounts'	=>	sanitize_text_field($un_DisplayCounts),
		
		'un_textBefor_icons'=>	sanitize_text_field(stripslashes($un_textBefor_icons)),
		'un_icons_alignment'=>	sanitize_text_field($un_icons_alignment),
		'un_onpostBefore'	=>	sanitize_text_field($un_onpostBefore),
		'un_onpostAfter'	=>	sanitize_text_field($un_onpostAfter),
		'un_onhomeBefore'	=>	sanitize_text_field($un_onhomeBefore),
		'un_onhomeAfter'	=>	sanitize_text_field($un_onhomeAfter),
	);
	
	$check_option2 = array(
		'un_textBefor_icons'=>	sanitize_text_field(stripslashes($un_textBefor_icons)),
		'un_icons_alignment'=>	sanitize_text_field($un_icons_alignment)
	);
	if(un_arrayFilter($check_option2))
	{
		header('Content-Type: application/json');
    	echo  json_encode(array("")); exit;
	}
	
	update_option('un_section2_options',serialize($up_option2)); 
    header('Content-Type: application/json');
    echo  json_encode(array("success")); exit;
}
function un_arrayFilter($array)
{
	foreach($array as $val)
	{
		if(empty($val))
		{
			return true;
		}
	}
	return false;
}
?>