<!-- Loader Image section  -->
<div id="unpageLoad" >  
    
</div>
<!-- END Loader Image section  -->

<!-- javascript error loader  -->
<div class="error" id="un_onload_errors" style="margin-left: 60px;display: none;">  
    <p>We found errors in your javascript which may cause the plugin to not work properly. Please fix the error:</p>
    <p id="un_jerrors"></p>
</div>
<!-- END javascript error loader  -->

<!-- START Admin view for plugin-->
<div class="un_mainContainer">
	
    <!-- Top content area of plugin -->
    <div class="un_main_contant">
        <h1>Welcome to the Newsletters Plugin!</h1>
        <p>
        	<?php $un_feedid = get_option("un_feed_id"); ?>
        	This plugin is 100% FREE and allows your visiters to subscribe to your site, so that they automatically receive your new posts by email (or <a href="http://www.specificfeeds.com/<?php echo $un_feedid; ?>?subParam=followPub" target="_blank">other channels</a>)
        </p>
        <p>
        	Get started by clicking on the first question below:
        </p>
    </div>
    <!-- END Top content area of plugin -->
      
    <div id="un-accordion">

        <!-- step 1 start here -->
        <h3><span>1)</span><b>Place a subscription form on your site</b></h3>
        <?php include(UN_DOCROOT.'/views/un_option_view1.php'); ?>
        <!-- step 1 end here --> 
    
        <!-- step 2 start here -->
        <h3><span>2)</span><b>Show a follow icon before/after posts</b></h3>
        <?php include(UN_DOCROOT.'/views/un_option_view2.php'); ?>
        <!-- step 2 END here -->
        
        <!-- step 3 start here -->
        <h3><span>3)</span><b>Connect your newsletter to an account</b></h3>
        <?php include(UN_DOCROOT.'/views/un_option_view3.php'); ?>
        <!-- step 3 END here -->
    </div>
	
    <div class="un-tab9">
        <!--<div class="save_button">
            <img src="<?php //echo UN_PLUGURL; ?>images/ajax-loader.gif" class="loader-img" />
            <a href="javascript:;" id="save_all_settings" title="Save All Settings">Save All Settings</a>
        </div>-->
     
     	<p class="un-errorMsg" style="display:none"> </p>
     	<p class="un-sucMsg" style="display:none"> </p>
	 
        <p style="margin-top: 30px;">
        	Offering a newsletter via SpecificFeeds also has several other advantages - <a href="http://www.specificfeeds.com/free-automatic-newsletter/inseparabilis " target="_blank"> check them out</a>
        </p>
        
        <p class="bldtxtmsg">
        	If you have any questions, let us know, we'll help you out: <a href="mailto:support@specificfeeds.com">support@specificfeeds.com</a>
        </p>
          
    </div>

</div>
<!-- START Admin view for plugin-->