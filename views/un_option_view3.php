<?php
	/* unserialize all saved option for  section 1 options */
    $un_feediid = sanitize_text_field(get_option('un_feed_id'));
?>
<div class="un-tab3">
	<p>Your newsletter is already fully functional, however to get most value connect it to a <a href="<?php if($un_feediid) echo SF_LINK."?".base64_encode("userprofile=wordpress&feed_id=".$un_feediid); ?>" target="_new" title="SpecificFeeds">SpecificFeeds</a> account (it’s FREE): 
</p>
    <ul class="un_green_box">
        <li>You’ll have access to your <b>subscriber’s emails</b> and <b>interesting statistics</b></li>
        <li>You’ll be able to <b>import subscribers</b></li>
        <li>
        	You’ll get listed in the <a href="<?php echo SF_LINK; ?>" target="_blank">SpecificFeeds directory</a> – for more traffic (optional)
        </li>
    </ul>
    <a href="<?php if($un_feediid) echo SF_LINK."?".base64_encode("userprofile=wordpress&feed_id=".$un_feediid); ?>" target="_new" id="mainRssconnect" title="Connect feed to a SpecificFeeds account">Connect feed to a SpecificFeeds account</a>
</div>