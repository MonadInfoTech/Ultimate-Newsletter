<?php
	/* unserialize all saved option for  section 1 options */
    $option2 = unserialize(get_option('un_section2_options',false));
?>
<div class="un-tab2">
	<div class="un_tab2_container">
    	<p>
        	In addition to the subscription form you can place a follow-icon before or after posts:
        </p>
    	<ul class="un_displayicn">
			<li class="un_displayicn_sectionfirst">
                <ul>
                    <li>
                        <div class="un_radio_section">
                            <input name="un_rectsub" <?php echo isChecked('yes', sanitize_text_field($option2['un_rectsub']));?> id="un_rectsub" type="checkbox" value="yes" class="styled"/>
                        </div>
                        <a href="#" title="Subscribe Follow" class="un_posticon">
                            <img src="<?php echo UN_PLUGURL; ?>images/follow_subscribe.png" alt="Subscribe Follow" />
                            <span style="display: none;">18k</span>
                        </a>
                    </li>
                    <li>
                        <div class="un_radio_section">
                            <input name="un_rectfb" <?php echo isChecked('yes', sanitize_text_field($option2['un_rectfb']));?> id="un_rectfb" type="checkbox" value="yes" class="styled" />
                        </div>
                        <a href="#" title="Facebook Like" class="un_posticon">
                            <img src="<?php echo UN_PLUGURL; ?>images/like.jpg" alt="Facebook Like" />
                            <span style="display: none;">18k</span>
                        </a>
                    </li>
                    <li>
                        <div class="un_radio_section">
                            <input name="un_rectgp" <?php echo isChecked('yes', sanitize_text_field($option2['un_rectgp']));?> id="un_rectgp" type="checkbox" value="yes" class="styled" />
                        </div>
                        <a href="#" title="Google Plus" class="un_posticon">
                            <img src="<?php echo UN_PLUGURL; ?>images/google_plus1.jpg" alt="Google Plus" />
                            <span style="display: none;">18k</span>
                        </a>
                    </li>
                    <li>
                        <div class="un_radio_section">
                            <input name="un_recttwtr" <?php echo isChecked('yes', sanitize_text_field($option2['un_recttwtr']));?> id="un_recttwtr" type="checkbox" value="yes" class="styled" />
                        </div>
                        <a href="#" title="twitter" class="un_posticon">
                            <img src="<?php echo UN_PLUGURL; ?>images/twiiter.png" alt="Twitter like" />
                            <span style="display: none;">18k</span>
                        </a>
                    </li>
                    <li style="width:auto">
                        <div class="un_radio_section">
                            <input name="un_rectshr" <?php echo isChecked('yes', sanitize_text_field($option2['un_rectshr']));?> id="un_rectshr" type="checkbox" value="yes" class="styled"/>
                        </div>
                        <a href="#" title="Share" class="un_posticon">
                            <img src="<?php echo UN_PLUGURL; ?>images/share1.jpg" alt="Share" />
                            <span style="display: none;">18k</span>
                        </a>
                        <p style="width:auto; display:inline-block; vertical-align:top; margin: 0px; padding: 0 0 0 6px;">
                        	(may impact loading speed)
                        </p>
                    </li>
                </ul>	
            </li>
            <li class="">
            	<label>Do you want to display the counts?</label>
                <div class="un_field">
                    <select name="un_DisplayCounts" id="un_DisplayCounts" class="select-same">
                        <option value="yes"
                        <?php echo isSeletcted('yes', sanitize_text_field($option2['un_DisplayCounts']));?>>
                        	YES
                        </option>
                        <option value="no"
                        <?php echo isSeletcted('no', sanitize_text_field($option2['un_DisplayCounts']));?>>
                        	NO
                        </option>
                     </select>
                </div>
            </li>
            <li class="un_aligntop">
            	<label>Display them:</label>
                <div class="un_field">
                    <ul>
                    	<li>
                        	<h3>On Post Pages</h3>
                            <div class="un_onpostselection">
                            	<div class="un_slectionsec">
                                    <div class="un_radio_section">
                                        <input name="un_onpostBefore" <?php echo isChecked('yes', sanitize_text_field($option2['un_onpostBefore']));?> id="un_onpostBefore" type="checkbox" value="yes" class="styled" />
                                    </div>
                                	<label>Before posts</label>
                                </div>
                                <div class="un_slectionsec">
                                    <div class="un_radio_section">
                                        <input name="un_onpostAfter" <?php echo isChecked('yes', sanitize_text_field($option2['un_onpostAfter']));?> id="un_onpostAfter" type="checkbox" value="yes" class="styled" />
                                    </div>
                                    <label>After posts</label>
                                </div>    
                            </div>
                        </li>
                        <li>
                        	<h3>On Homepage</h3>
                            <div class="un_onpostselection">
                                <div class="un_slectionsec">
                                    <div class="un_radio_section">
                                        <input name="un_onhomeBefore" <?php echo isChecked('yes', sanitize_text_field($option2['un_onhomeBefore']));?> id="un_onhomeBefore" type="checkbox" value="yes" class="styled" />
                                    </div>
                                    <label>Before posts</label>
                                </div>    
                                <div class="un_slectionsec">
                                    <div class="un_radio_section">
                                        <input name="un_onhomeAfter" <?php echo isChecked('yes', sanitize_text_field($option2['un_onhomeAfter']));?> id="un_onhomeAfter" type="checkbox" value="yes" class="styled" />
                                    </div>
                                    <label>After posts</label>
                                </div>    
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="">
            	<label>Text to appear before the sharing icons:</label>
                <div class="un_field">
                    <input type="text" value="<?php echo sanitize_text_field($option2['un_textBefor_icons']);?>" name="un_textBefor_icons">
                </div>
            </li>
            <li class="">
            	<label>Alignment of share icons:</label>
                <div class="un_field">
                    <select name="un_icons_alignment" id="un_icons_alignment" class="select-same">
                        <option value="left"
                        <?php echo isSeletcted('left', sanitize_text_field($option2['un_icons_alignment']));?>>
                        	Left
                        </option>
                        <option value="right"
                        <?php echo isSeletcted('right', sanitize_text_field($option2['un_icons_alignment']));?>>
                        	Right
                        </option>
                        <option value="center"
                        <?php echo isSeletcted('center', sanitize_text_field($option2['un_icons_alignment']));?>>
                        	Center
                        </option>
                     </select>
                </div>
            </li>
		</ul>
    </div>
	<!-- SAVE BUTTON SECTION   --> 
	<div class="save_button">
	     <img src="<?php echo UN_PLUGURL ?>images/ajax-loader.gif" class="loader-img" />
         <?php $nonce = wp_create_nonce("update_step2"); ?>
	     <a href="javascript:;" id="un_save2" title="Save" data-nonce="<?php echo $nonce;?>">Save</a>
	</div>
    <!-- END SAVE BUTTON SECTION   -->
	
    <a class="unColbtn closeSec" href="javascript:;">Collapse area</a>
	<label class="closeSec"></label>
	
    <!-- ERROR AND SUCCESS MESSAGE AREA-->
	<p class="unerrorMsg" style="display:none"> </p>
	<p class="unsucMsg" style="display:none"> </p>
    
    <p style="text-align:center">Want more placement options, more icon designs or also other social media icons? Check out this <a target="_blank" href="https://wordpress.org/plugins/ultimate-social-media-plus/">plugin</a></p>
    
	<div class="clear"></div>
</div>