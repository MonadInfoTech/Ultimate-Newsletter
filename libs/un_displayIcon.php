<?php
//functionality for before and after single posts
add_filter( 'the_content', 'un_beforAfterePosts' );
function un_beforAfterePosts( $content )
{
	global $post;
	
	if(!empty($post))
	{
		$option2 = unserialize(get_option('un_section2_options',false));
		$permaLink = get_permalink($post->ID);
		$title = get_the_title($post->ID);
		$postContent = get_the_content($post->ID);
		
		if ( is_single() ) 
		{
			if($option2['un_onpostBefore'] == 'yes')
			{
				$iconBefore = un_getShareIcon($option2, $permaLink, $title);
			}
			
			if($option2['un_onpostAfter'] == 'yes')
			{
				$iconAfter = un_getShareIcon($option2, $permaLink, $title);
			}
			$content = $iconBefore.$content.$iconAfter;
		}
		elseif ( is_home() ) 
		{
			if($option2['un_onhomeBefore'] == 'yes')
			{
				$iconBefore = un_getShareIcon($option2, $permaLink, $title);
			}
			
			if($option2['un_onhomeAfter'] == 'yes')
			{
				$iconAfter = un_getShareIcon($option2, $permaLink, $title);
			}
			$content = $iconBefore.$content.$iconAfter;
		}
	}
	return $content;
}

function un_getShareIcon($option2, $permaLink, $title)
{
	if(!empty($option2['un_icons_alignment']))
	{
		$style = 'style="text-align:'.$option2['un_icons_alignment'].'"';
	}
	else
	{
		$style = '';
	}
	
	$icon = '';
	$icon .= '<div class="un_socialShareicn" '.$style.'>';
		$icon .= '<p>'.$option2['un_textBefor_icons'].'</p>';
		$icon .= '<div>';
		$icon .= '<ul>';
			if($option2['un_rectsub'] == 'yes')
			{
				$icon .= '<li>'.un_Subscribelike($permaLink, $option2['un_DisplayCounts']).'</li>';
			}
			if($option2['un_rectfb'] == 'yes')
			{
				$icon .= '<li>'.un_FBlike($permaLink, $option2['un_DisplayCounts']).'</li>';
			}
			if($option2['un_recttwtr'] == 'yes')
			{
				$icon .= '<li>'.un_twitterShare($permaLink, $title, $option2['un_DisplayCounts']).'</li>';
			}
			if($option2['un_rectgp'] == 'yes')
			{
				$icon .= '<li id="un_gplusShareicon">'.un_googlePlus($permaLink, $option2['un_DisplayCounts']).'</li>';
			}
			if($option2['un_rectshr'] == 'yes')
			{
				$icon .= '<li>'.un_Addthis($option2['un_DisplayCounts'], $permaLink, $title).'</li>';
			}
		$icon .= '</ul>';
		$icon .= '</div>';
	$icon .= '</div>';
	
	return $icon;
}
?>