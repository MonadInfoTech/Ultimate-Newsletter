<?php
/* create on page facebook links option */
function un_FBlike($permalink, $show_count)
{
	$send = 'false';
	$width = 180;
	
	$fb_like_html = '<fb:like href="'.$permalink.'" width="'.$width.'" send="'.$send.'" showfaces="false" ';
	if($show_count == "yes") { 
		$fb_like_html .= 'layout="button_count"';
	} else {
		$fb_like_html .= 'layout="button"';
	}
	$fb_like_html .= ' action="like"></fb:like>';
	return $fb_like_html;
}

/*subscribe like*/
function un_Subscribelike($permalink, $show_count)
{
	$url = get_option('un_redirect_url');
	$feedid = sanitize_text_field(get_option('un_feed_id'));
	if($show_count == 'yes')
	{
		$counts = un_getFeedSubscriberCount($feedid);
		$icon = '<div class="un_sfIcon"><a href="'.$url.'" target="_blank"><img src="'.UN_PLUGURL.'images/follow_subscribe.png" /></a><span class="bot_no">'.$counts.'</span></div>';
	}
	else
	{
		$icon = '<div class="un_sfIcon"><a href="'.$url.'" target="_blank"><img src="'.UN_PLUGURL.'images/follow_subscribe.png" /></a></div>';
	}
	return $icon;
}

/* get no of subscribers from specificfeeds for current blog count*/
function  un_getFeedSubscriberCount($feedid)
{
	$un_sf_count = unserialize(get_option('un_sf_count',false));
		
	/*if date is empty (for decrease request count)*/
	if(empty($un_sf_count["date"]))
	{
		$un_sf_count["date"] = strtotime(date("Y-m-d"));
		$counts = getSfCount($feedid);
		$un_sf_count["un_sf_count"] = $counts;
		update_option('un_sf_count',  serialize($un_sf_count));
	}
	else
	{
		 $diff = date_diff(
			date_create(
				date("Y-m-d", $un_sf_count["date"])
			),
			date_create(
				date("Y-m-d")
		 ));
		 if($diff->format("%a") > 1)
		 {
			$un_sf_count["date"] = strtotime(date("Y-m-d"));
			$counts = getSfCount($feedid);
			$un_sf_count["un_sf_count"] = $counts;
			update_option('un_sf_count',  serialize($un_sf_count));
		 }
		 else
		 {
			 $counts = (empty($un_sf_count["un_sf_count"])) ? 0 : $un_sf_count["un_sf_count"];
		 }
	}
	return $counts;
}

function getSfCount($feedid)
{
	$curl = curl_init();  
	 
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'http://www.specificfeeds.com/wordpress/wpCountSubscriber',
		CURLOPT_USERAGENT => 'sf rss request',
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => array(
			'feed_id' => $feedid,
			'v' => 'newplugincount'
		)
	));
	/* Send the request & save response to $resp */
	$resp = curl_exec($curl);
	
	if(!empty($resp))
	{
		$resp=json_decode($resp);
		curl_close($curl);
		$feeddata = stripslashes_deep($resp->subscriber_count);
	}
	else
	{
		$feeddata = 0;
	}
	return format_num(intval($feeddata));exit;
}

/* convert no. to 2K,3M format   */
function format_num($num, $precision = 0)
{
	if ($num >= 1000 && $num < 1000000)
	{
		$n_format = number_format($num/1000,$precision).'k';
	} else if ($num >= 1000000 && $num < 1000000000) {
		$n_format = number_format($num/1000000,$precision).'m';
	} else if ($num >= 1000000000) {
		$n_format=number_format($num/1000000000,$precision).'b';
	} else {
		$n_format = $num;
	}
	return $n_format;
}
	
function un_googlePlus($permalink,$show_count)
{
    $google_html = '<div class="g-plusone" data-href="' . $permalink . '" ';
    if($show_count == 'yes')
	{
        $google_html .= 'data-size="large" ';
    }
	else
	{
		$google_html .= 'data-size="large" data-annotation="none" ';
    }
    $google_html .= '></div>';
    return $google_html;
}

/* create on page twitter share icon */
function un_twitterShare($permalink, $tweettext, $show_count)
{
	$tweettext = strip_tags(str_replace("'", "", $tweettext));
	
	if($show_count == "yes")
	{
		$twitter_html = '<a href="http://twitter.com/share" class="sr-twitter-button twitter-share-button" lang="en" data-counturl="'.$permalink.'" data-url="'.$permalink.'" data-text="'.$tweettext.'" ></a>';
	}
	else
	{
		$twitter_html = '<a href="http://twitter.com/share" data-count="none" class="sr-twitter-button twitter-share-button" lang="en" data-url="'.$permalink.'" data-text="'.$tweettext.'" ></a>';
	}
	return $twitter_html;
}

/* create add this  button */
function un_Addthis($show_count, $permalink, $post_title)
{
	$post_title = strip_tags(str_replace("'", "", $post_title));
	$atiocn = '<script type="text/javascript">
		var addthis_config = {
     		url: "'.$permalink.'",
   	 		title: "'.$post_title.'"
		}
	</script>';

	if($show_count == 'yse')
   {
        $atiocn.=' <div class="addthis_toolbox" addthis:url="'.$permalink.'" addthis:title="'.$post_title.'">
			<a class="addthis_counter addthis_pill_style share_showhide"></a>
		</div>';
		return $atiocn;
   }
   else
   {
	  $atiocn.='<div class="addthis_toolbox addthis_default_style addthis_20x20_style" addthis:url="'.$permalink.'" addthis:title=""><a class="addthis_button_compact " href="#"><img src="'.UN_PLUGURL.'images/sharebtn.png"  border="0" alt="Share" /></a></div>';
	  return $atiocn; 
   }
}

/* add all external javascript to wp_footer */        
function un_footer_script()
{
	$un_section2 = unserialize(get_option('un_section2_options',false));
	
	if(!isset($un_section2['un_rectsub']))
	{
		$un_section2['un_rectsub'] = 'yes';
	}
	if(!isset($un_section2['un_rectfb']))
	{
		$un_section2['un_rectfb'] = 'yes';
	}
	if(!isset($un_section2['un_rectgp']))
	{
		$un_section2['un_rectgp'] = 'yes';
	}
	if(!isset($un_section2['un_rectshr']))
	{
		$un_section2['un_rectshr'] = 'yes';
	}
	if(!isset($un_section2['un_recttwtr']))
	{
		$un_section2['un_recttwtr'] = 'no';
	}

	if($un_section2['un_rectfb'] == "yes"){ ?>
		<!--facebook like and share js -->                   
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1425108201100352&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	<?php } ?>

	<?php if($un_section2['un_rectgp'] == "yes") { ?>
		<!--google share and  like and e js -->
		<script type="text/javascript">
			window.___gcfg = {
			  lang: 'en-US'
			};
			(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			})();
		</script>
		
		<script type='text/javascript' src='https://apis.google.com/js/plusone.js'></script>
		<script type='text/javascript' src='https://apis.google.com/js/platform.js'></script>
		<!-- google share -->
		<script type="text/javascript">
		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/platform.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
	<?php } ?>

	<?php if($un_section2['un_rectshr'] == "yes" ) { ?>		
		<!-- Addthis js -->
        <script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-558ac14e7f79bff7"></script>
        <script type="text/javascript">
			var addthis_config = {  ui_click: true  };
		</script>
	<?php } ?>

	<?php if($un_section2['un_recttwtr'] == "yes") {?>
		<!-- twitter JS End -->
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>	
	<?php }
}

if(!is_admin())
{
	global $post;
	add_action( 'wp_footer', 'un_footer_script' );	
}
?>