<?php
function un_activate_plugin()
{
	update_option("un_pluginVersion", "1.4");
	
	/* subscription form */
    $options1 = array('un_form_adjustment'=>'yes',
        'un_form_height'=>'180',
        'un_form_width' =>'230',
        'un_form_border'=>'yes',
        'un_form_border_thickness'=>'1',
        'un_form_border_color'=>'#b5b5b5',
        'un_form_background'=>'#ffffff',
		
        'un_form_heading_text'=>'Get new posts by email',
        'un_form_heading_font'=>'Helvetica,Arial,sans-serif',
        'un_form_heading_fontstyle'=>'bold',
        'un_form_heading_fontcolor'=>'#000000',
        'un_form_heading_fontsize'=>'16',
        'un_form_heading_fontalign'=>'center',
		
		'un_form_field_text'=>'Enter your email',
        'un_form_field_font'=>'Helvetica,Arial,sans-serif',
        'un_form_field_fontstyle'=>'normal',
        'un_form_field_fontcolor'=>'#000000',
        'un_form_field_fontsize'=>'14',
        'un_form_field_fontalign'=>'center',
		
		'un_form_button_text'=>'Subscribe',
        'un_form_button_font'=>'Helvetica,Arial,sans-serif',
        'un_form_button_fontstyle'=>'bold',
        'un_form_button_fontcolor'=>'#000000',
        'un_form_button_fontsize'=>'16',
        'un_form_button_fontalign'=>'center',
        'un_form_button_background'=>'#dedede',
    );
	add_option('un_section1_options',  serialize($options1));
	
	$options2= array('un_form_adjustment'=>'yes',
        'un_rectsub'	=> 'yes',
        'un_rectfb' 	=> 'yes',
        'un_rectgp'		=> 'yes',
        'un_recttwtr'	=> 'yes',
        'un_rectshr'	=> 'yes',
        'un_DisplayCounts'=>'yes',
		
        'un_onpostBefore'	=> 'yes',
        'un_onpostAfter'	=> 'yes',
        'un_onhomeBefore'	=> 'yes',
        'un_onhomeAfter'	=> 'yes',
		'un_textBefor_icons'=> 'Please follow and like us:',
        'un_icons_alignment'=> 'left',
    );
	add_option('un_section2_options',  serialize($options2));
	
	if(get_option('un_feed_id') && get_option('un_redirect_url'))
	{
		$sffeeds["feed_id"] = sanitize_text_field(get_option('un_feed_id'));
		$sffeeds["redirect_url"] = get_option('un_redirect_url');
		$sffeeds = (object)$sffeeds;
	}
    else
	{
		$sffeeds = UN_getFeedUrl();
	}
	
	update_option('un_feed_id',sanitize_text_field($sffeeds->feed_id));
	update_option('un_redirect_url',$sffeeds->redirect_url);
	
	/*Activation Setup for (specificfeed)*/
	UN_setUpfeeds(sanitize_text_field($sffeeds->feed_id));
    UN_updateFeedPing('N',sanitize_text_field($sffeeds->feed_id));
}
function un_deactivate_plugin()
{
	 global $wpdb;
     UN_updateFeedPing('Y',sanitize_text_field(get_option('un_feed_id')));
}
function un_Unistall_plugin()
{
	delete_option('un_section1_options');
    delete_option('un_section2_options');
	delete_option('un_feed_id');
	delete_option('un_redirect_url');
	delete_option('un_pluginVersion');
	delete_option('un_verificatiom_code');
}
/* add admin menus */
function un_admin_menu()
{
	//add_menu_page('Newsletter', 'Newsletter', 'administrator','newsletter-options','un_options_page',plugins_url( 'images/logo.png' , dirname(__FILE__) ));
	add_menu_page('Newsletter', 'Newsletter', 'administrator','newsletter-options','un_options_page');
}
function un_options_page()
{
	include UN_DOCROOT . '/views/un_options_view.php';
}
/* end function  */
if ( is_admin() ){
    add_action('admin_menu', 'un_admin_menu');
}

/*Curl Call for sf*/
function UN_updateFeedPing($status,$feed_id)
{
	$curl = curl_init();  
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://www.specificfeeds.com/wordpress/pingfeed',
        CURLOPT_USERAGENT => 'sf rss request',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => array(
            'feed_id' => $feed_id,
            'status' => $status
        )
    ));
     // Send the request & save response to $resp
	$resp = curl_exec($curl);
	$resp=json_decode($resp);
	curl_close($curl);
}
/* add sf tags */
function UN_setUpfeeds($feed_id)
{
	$curl = curl_init();  
	curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://www.specificfeeds.com/rssegtcrons/download_rssmorefeed_data_single/'.$feed_id."/Y",
        CURLOPT_USERAGENT => 'sf rss request',
        CURLOPT_POST => 0      
	));
	$resp = curl_exec($curl);
	curl_close($curl);	
}
/* fetch rss url from specificfeeds */ 
function UN_getFeedUrl()
{
    $curl = curl_init();  
     
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://www.specificfeeds.com/wordpress/plugin_setup',
        CURLOPT_USERAGENT => 'sf rss request',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => array(
            'web_url' => get_bloginfo('url'),
            'feed_url' => un_get_bloginfo('rss2_url'),
            'email'=>get_bloginfo('admin_email')
        )
    ));
 	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	$resp = json_decode($resp);
	curl_close($curl);
	
	$feed_url = stripslashes_deep($resp->redirect_url);
	return $resp;exit;
}
/*Update feeds*/
add_action( 'save_post', 'un_pingVendor');
function un_pingVendor( $post_id )
{
	global $wp,$wpdb;
	
	// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) )
		return;
		
	$post_data = get_post($post_id,ARRAY_A);
	if($post_data['post_status']=='publish' && $post_data['post_type']=='post') : 
		$categories = wp_get_post_categories($post_data['ID']);
		$cats='';
		$total=count($categories);
		$count=1;
		foreach($categories as $c)
		{	
			$cat_data = get_category( $c );
			if($count==$total)
			{
				$cats.= sanitize_text_field($cat_data->name);
			}
			else
			{
			 	$cats.= sanitize_text_field($cat_data->name).',';	
			}
			$count++;	
		}
		$postto_array = array('feed_id'	=> sanitize_text_field(get_option('un_feed_id')),
						  'title'		=> sanitize_text_field($post_data['post_title']),
						  'description'	=> sanitize_text_field($post_data['post_content']),
						  'link'		=> esc_url($post_data['guid']),
						  'author'		=> get_the_author_meta('user_login', $post_data['post_author']),
						  'category'	=> trim($cats, ","),
						  'pubDate'		=> $post_data['post_modified'],
                          'rssurl'		=> esc_url(un_get_bloginfo('rss2_url'))
						);
		
		$curl = curl_init();  
    	curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://www.specificfeeds.com/wordpress/addpostdata ',
			CURLOPT_USERAGENT => 'sf rss request',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $postto_array
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		$resp = json_decode($resp);
		curl_close($curl);
		  
		return true;
    endif;
}
?>