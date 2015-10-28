<?php
	/* unserialize all saved option for  section 1 options */
    $option1 = unserialize(get_option('un_section1_options',false));
?>
<!-- Section 1 "Do you want to show a subscription form (increases sign ups)?" main div Start -->
<div class="un-tab1">
	<div class="un_tab1_container">
    	<!--Section 1-->
        <div class="un_tab1_subcontainer hidemarginpadding">
    		<h3 class="un_section_title hidemarginpadding">Preview:</h3>
            <div class="like_pop_box">
            	<?php get_unSubscriptionForm(); ?>
            </div>
        </div>
        
        <!--Section 2-->
        <div class="un_tab1_subcontainer un_seprater">
    		<h3 class="un_section_title">Place it on your site</h3>
            <label class="un_label_text">You can place the form by different methods:</label>
            <ul class="un_form_info">
            	<li><b>1. Widget:</b> Go to the <a target="_blank" href="<?php echo site_url()?>/wp-admin/widgets.php">widget settings</a> and drag & drop it to the sidebar.
                </li>
                <li><b>2. Shortcode:</b> Use the shortcode <b>[newsletter_subscription_form]</b> to place it into your codes</li>
                <li><b>3. Copy & paste HTML code:</b></li>
            </ul>
            <div class="un_html" style="display: none;">
            	<?php
				$un_feediid = sanitize_text_field(get_option('un_feed_id'));
				$url = "http://www.specificfeeds.com/widgets/subscribeWidget/";
				$url = $url.$un_feediid.'/8/';
				?>
                <div class="un_subscribe_Popinner" style="padding: 18px 0px;">
                    <form method="post" onsubmit="return un_processfurther(this);" target="popupwindow" action="<?php echo $url?>" style="margin: 0px 20px;">
                        <h5 style="margin: 0 0 10px; padding: 0;">Get new posts by email:</h5>
                        <div style="margin: 5px 0; width: 100%;">
                            <input style="padding: 10px 0px !important; width: 100% !important;" type="email" placeholder="Enter your email" value="" name="data[Widget][email]" />
                        </div>
                        <div style="margin: 5px 0; width: 100%;">
                        	<input style="padding: 10px 0px !important; width: 100% !important;" type="submit" name="subscribe" value="Subscribe" /><input type="hidden" name="data[Widget][feed_id]" value="<?php echo $un_feediid ?>"><input type="hidden" name="data[Widget][feedtype]" value="8">
                        </div>
                    </form>
                </div>
            </div>
            <div class="un_subscription_html">
            	<xmp id="selectable" onclick="selectText('selectable')">
                    <?php get_unSubscriptionForm(); ?>
                </xmp>
            </div>
        </div>
        
        <!--Section 3-->
        <div class="un_tab1_subcontainer un_seprater">
        	<h3 class="un_section_title">Define text & design (optional)</h3>
            <h5 class="un_section_subtitle">Overall size & border</h5>
            
            <!--Left Section-->
            <div class="un_left_container">
            	<?php get_unSubscriptionForm(); ?>
            </div>
            
            <!--Right Section-->
            <div class="un_right_container">
            	<div class="row_tab">
                    <label class="un_heding">Adjust size to space on website?</label>
					<ul class="border_shadow">
                    	<li>
                        	<input type="radio" class="styled" value="yes" name="un_form_adjustment"
                            	<?php echo isChecked(sanitize_text_field($option1['un_form_adjustment']), 'yes'); ?> >
                            <label>Yes</label>
                        </li>
                        <li>
                        	<input type="radio" class="styled" value="no" name="un_form_adjustment"
                            	<?php echo isChecked(sanitize_text_field($option1['un_form_adjustment']), 'no'); ?> >
                            <label>No</label>
                        </li>
                    </ul>
				</div>
                <!--Row Section-->
                <div class="row_tab" style="<?php echo ($option1['un_form_adjustment'] == 'yes')? "display:none": ''; ?>">
                    <div class="un_field">
                    	<label>Height</label>
                        <input name="un_form_height" type="text"
                        	value="<?php echo ($option1['un_form_height']!='') ?  intval($option1['un_form_height']) : '' ;?>"
                            class="small rec-inp" /><span class="pix">pixels</span>
                    </div>
                    <div class="un_field">
                    	<label>Width</label>
                        <input name="un_form_width" type="text"
                        	value="<?php echo ($option1['un_form_width']!='') ?  intval($option1['un_form_width']) : '' ;?>"
                            class="small rec-inp" /><span class="pix">pixels</span>
                    </div>
                </div>
                <!--Row Section-->
                <div class="row_tab">
                    <label class="un_heding">Border?</label>
					<ul class="border_shadow">
                    	<li>
                        	<input type="radio" class="styled" value="yes" name="un_form_border"
                            	<?php echo isChecked(sanitize_text_field($option1['un_form_border']), 'yes'); ?> >
                            <label>Yes</label>
                        </li>
                        <li>
                        	<input type="radio" class="styled" value="no" name="un_form_border"
                            	<?php echo isChecked(sanitize_text_field($option1['un_form_border']), 'no'); ?> >
                            <label>No</label>
                        </li>
                    </ul>
				</div>
                <!--Row Section-->
                <div class="row_tab" style="<?php echo ($option1['un_form_border'] == 'no')? "display:none": ''; ?>">
                	<div class="un_field">
                    	<label>Thickness</label>
                        <input name="un_form_border_thickness" type="text"
                        	value="<?php echo ($option1['un_form_border_thickness']!='')
										? intval($option1['un_form_border_thickness']) : '' ;
									?>"
                            class="small rec-inp" /><span class="pix">pixels</span>
                    </div>
                    <div class="un_field">
                    	<label>Color</label>
                        <input type="text" id="un_form_border_color" name="un_form_border_color" data-default-color="#b5b5b5"
                        	value="<?php echo ($option1['un_form_border_color']!='')
										? sanitize_hex_color($option1['un_form_border_color']) : '' ;
									?>" />
                    </div>
                </div>
                <!--Row Section-->
                <div class="row_tab">
                    <label class="un_heding autowidth">Background color:</label>
					<div class="un_field">
                    	<input id="un_form_background" data-default-color="#FFFFFF" type="text" name="un_form_background"
                        	value="<?php echo ($option1['un_form_background']!='')
										? sanitize_hex_color($option1['un_form_background']) : '' ;
									?>">
                    </div>
				</div>
                <!--Row Section-->
            </div>
            
        </div>
        
        <!--Section 4-->
        <div class="un_tab1_subcontainer un_seprater">
        	<h5 class="un_section_subtitle">Text above entry field</h5>
            
            <!--Left Section-->
            <div class="un_left_container">
            	<?php get_unSubscriptionForm("h5"); ?>
            </div>
            
            <!--Right Section-->
            <div class="un_right_container">
            	<div class="row_tab">
                    <label class="un_heding fixwidth un_same_width">Text:</label>
                    <div class="un_field">
                        <input type="text" class="small new-inp" name="un_form_heading_text"
                            value="<?php echo ($option1['un_form_heading_text']!='')
										? sanitize_text_field($option1['un_form_heading_text']) : '' ;
									?>"/>
                    </div>           
                </div>
                <!--Row Section-->
                <div class="row_tab">
                	<div class="un_field">
                    	<label class="un_same_width">Font:</label>
                        <?php un_get_font("un_form_heading_font", sanitize_text_field($option1['un_form_heading_font'])); ?>
                    </div>
                    <div class="un_field">
                    	<label>Font style:</label>
                        <?php
							un_get_fontstyle(
								"un_form_heading_fontstyle",
								sanitize_text_field($option1['un_form_heading_fontstyle'])
							);
						?>
                    </div>
                </div>
                <!--Row Section-->
                <div class="row_tab">
                	<div class="un_field">
                    	<label class="un_same_width">Font color</label>
                        <input type="text" name="un_form_heading_fontcolor" data-default-color="#000000" id="un_form_heading_fontcolor" value="<?php echo ($option1['un_form_heading_fontcolor']!='')
										? sanitize_hex_color($option1['un_form_heading_fontcolor']) : '' ;
									?>">
                    </div>
                    <div class="un_field">
                    	<label>Font size</label>
                        <input type="text" class="small rec-inp" name="un_form_heading_fontsize"
                        	value="<?php echo ($option1['un_form_heading_fontsize']!='')
										? intval($option1['un_form_heading_fontsize']) : '' ;?>"/>
                        <span class="pix">pixels</span>
                    </div>
                </div>
                <!--Row Section-->
                <div class="row_tab">
                	<div class="un_field">
                    	<label class="un_same_width">Alignment:</label>
                        <?php
							un_get_alignment(
								"un_form_heading_fontalign",
								sanitize_text_field($option1['un_form_heading_fontalign'])
							);
						?>
                    </div>
                </div>
                <!--End Section-->
            </div>
            
        </div>
        
        <!--Section 5-->
        <div class="un_tab1_subcontainer un_seprater">
        	<h5 class="un_section_subtitle">Entry field</h5>
            
            <!--Left Section-->
            <div class="un_left_container">
            	<?php get_unSubscriptionForm("email"); ?>
            </div>
            
            <!--Right Section-->
            <div class="un_right_container">
            	<div class="row_tab">
                    <label class="un_heding fixwidth un_same_width">Text:</label>
                    <div class="un_field">
                        <input type="text" class="small new-inp" name="un_form_field_text"
                            value="<?php echo ($option1['un_form_field_text']!='')
										? sanitize_text_field($option1['un_form_field_text']) : '' ;
									?>"/>
                    </div>           
                </div>
                <!--Row Section-->
                <div class="row_tab">
                	<div class="un_field">
                    	<label class="un_same_width">Font:</label>
                        <?php un_get_font("un_form_field_font", sanitize_text_field($option1['un_form_field_font'])); ?>
                    </div>
                    <div class="un_field">
                    	<label>Font style:</label>
                        <?php
							un_get_fontstyle(
								"un_form_field_fontstyle",
								sanitize_text_field($option1['un_form_field_fontstyle'])
							);
						?>
                    </div>
                </div>
                <!--Row Section-->
                <div class="row_tab">
                	<input type="hidden" name="un_form_field_fontcolor" value="">
                    <!--<div class="un_field">
                    	<label class="un_same_width">Font color</label>
                        <input type="text" name="un_form_field_fontcolor" data-default-color="#000000" id="un_form_field_fontcolor" value="<?php //echo ($option1['un_form_field_fontcolor']!='')
										//? $option1['un_form_field_fontcolor'] : '' ;
									?>">
                    </div>-->
                    <div class="un_field">
                    	<label class="un_same_width">Alignment:</label>
                        <?php
							un_get_alignment(
								"un_form_field_fontalign",
								sanitize_text_field($option1['un_form_field_fontalign'])
							);
						?>
                    </div>
                    
                    <div class="un_field">
                    	<label>Font size</label>
                        <input type="text" class="small rec-inp" name="un_form_field_fontsize"
                        	value="<?php echo ($option1['un_form_field_fontsize']!='')
										? intval($option1['un_form_field_fontsize']) : '' ;?>"/>
                        <span class="pix">pixels</span>
                    </div>
                </div>
                <!--End Section-->
            </div>
            
        </div>
        
        <!--Section 6-->
        <div class="un_tab1_subcontainer">
        	<h5 class="un_section_subtitle">Subscribe button</h5>
            
            <!--Left Section-->
            <div class="un_left_container">
            	<?php get_unSubscriptionForm("submit"); ?>
            </div>
            
            <!--Right Section-->
            <div class="un_right_container">
            	<div class="row_tab">
                    <label class="un_heding fixwidth un_same_width">Text:</label>
                    <div class="un_field">
                        <input type="text" class="small new-inp" name="un_form_button_text"
                            value="<?php echo ($option1['un_form_button_text']!='')
										? sanitize_text_field($option1['un_form_button_text']) : '' ;
									?>"/>
                    </div>           
                </div>
                <!--Row Section-->
                <div class="row_tab">
                	<div class="un_field">
                    	<label class="un_same_width">Font:</label>
                        <?php un_get_font("un_form_button_font", sanitize_text_field($option1['un_form_button_font'])); ?>
                    </div>
                    <div class="un_field">
                    	<label>Font style:</label>
                        <?php
							un_get_fontstyle(
								"un_form_button_fontstyle",
								sanitize_text_field($option1['un_form_button_fontstyle'])
							);
						?>
                    </div>
                </div>
                <!--Row Section-->
                <div class="row_tab">
                	<div class="un_field">
                    	<label class="un_same_width">Font color</label>
                        <input type="text" name="un_form_button_fontcolor" data-default-color="#000000" id="un_form_button_fontcolor" value="<?php echo ($option1['un_form_button_fontcolor']!='')
										? sanitize_hex_color($option1['un_form_button_fontcolor']) : '' ;
									?>">
                    </div>
                    <div class="un_field">
                    	<label>Font size</label>
                        <input type="text" class="small rec-inp" name="un_form_button_fontsize"
                        	value="<?php echo ($option1['un_form_button_fontsize']!='')
										? intval($option1['un_form_button_fontsize']) : '' ;?>"/>
                        <span class="pix">pixels</span>
                    </div>
                </div>
                <!--Row Section-->
                <div class="row_tab">
                	<div class="un_field">
                    	<label class="un_same_width">Alignment:</label>
                        <?php
							un_get_alignment(
								"un_form_button_fontalign",
								sanitize_text_field($option1['un_form_button_fontalign'])
							);
						?>
                    </div>
                </div>
                <!--Row Section-->
                <div class="row_tab">
                	<div class="un_field">
                    	<label class="un_same_width"><b>Button color:</b></label>
                        <input type="text" name="un_form_button_background" data-default-color="#dedede" id="un_form_button_background" value="<?php echo ($option1['un_form_button_background']!='')
										? sanitize_hex_color($option1['un_form_button_background']) : '' ;
									?>">
                    </div>
                </div>    
                <!--End Section-->
            </div>
            
        </div>
    	<!--Section End-->
    </div>

    <!-- SAVE BUTTON SECTION   --> 
	<div class="save_button">
	     <img src="<?php echo UN_PLUGURL ?>images/ajax-loader.gif" class="loader-img" />
         <?php  $nonce = wp_create_nonce("update_step1"); ?>
	     <a href="javascript:;" id="un_save1" title="Save" data-nonce="<?php echo $nonce;?>">Save</a>
	</div>
    <!-- END SAVE BUTTON SECTION   -->
	
    <a class="unColbtn closeSec" href="javascript:;">Collapse area</a>
	<label class="closeSec"></label>
	
    <!-- ERROR AND SUCCESS MESSAGE AREA-->
	<p class="unerrorMsg" style="display:none"> </p>
	<p class="unsucMsg" style="display:none"> </p>
	<div class="clear"></div>

</div>
<!-- END Section 1 "Pleade add a subscription form to your site" main div End -->
<?php
function isChecked($givenVal, $value)
{
	if($givenVal == $value)
		return 'checked="true"';
	else
		return '';
}
function isSeletcted($givenVal, $value)
{
	if($givenVal == $value)
		return 'selected="true"';
	else
		return '';
}
function un_get_font($name, $value)
{
	?>
		<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="select-same">
			<option value="Arial, Helvetica, sans-serif"
				<?php echo isSeletcted("Arial, Helvetica, sans-serif", $value) ?> >
				Arial
			</option>
			<option value="Arial Black, Gadget, sans-serif"
				<?php echo isSeletcted("Arial Black, Gadget, sans-serif", $value) ?> >
				Arial Black
			</option>
			<option value="Calibri" <?php echo isSeletcted("Calibri", $value) ?> >Calibri</option>
			<option value="Comic Sans MS" <?php echo isSeletcted("Comic Sans MS", $value) ?> >Comic Sans MS</option>
			<option value="Courier New" <?php echo isSeletcted("Courier New", $value) ?> >Courier New</option>
			<option value="Georgia" <?php echo isSeletcted("Georgia", $value) ?> >Georgia</option>
			<option value="Helvetica,Arial,sans-serif"
				<?php echo isSeletcted("Helvetica,Arial,sans-serif", $value) ?> >
				Helvetica
			</option>
			<option value="Impact" <?php echo isSeletcted("Impact", $value) ?> >Impact</option>
			<option value="Lucida Console" <?php echo isSeletcted("Lucida Console", $value) ?> >Lucida Console</option>
			<option value="Tahoma,Geneva" <?php echo isSeletcted("Tahoma,Geneva", $value) ?> >Tahoma</option>
			<option value="Times New Roman" <?php echo isSeletcted("Times New Roman", $value) ?> >Times New Roman</option>
			<option value="Trebuchet MS" <?php echo isSeletcted("Trebuchet MS", $value) ?> >Trebuchet MS</option>
			<option value="Verdana" <?php echo isSeletcted("Verdana", $value) ?> >Verdana</option>
		</select>
	<?php
}
function un_get_fontstyle($name, $value)
{
	?>
	<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="select-same">
		<option value="normal" <?php echo isSeletcted("normal", $value) ?> >Normal</option>
		<option value="inherit" <?php echo isSeletcted("inherit", $value) ?> >Inherit</option>
		<option value="oblique" <?php echo isSeletcted("oblique", $value) ?> >Oblique</option>
		<option value="italic" <?php echo isSeletcted("italic", $value) ?> >Italic</option>
        <option value="bold" <?php echo isSeletcted("bold", $value) ?> >Bold</option>
	</select>
	<?php                     
}
function un_get_alignment($name, $value)
{
	?>
	<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="select-same">
		<option value="left" <?php echo isSeletcted("left", $value) ?> >Left Align</option>
		<option value="center" <?php echo isSeletcted("center", $value) ?> >Centered</option>
		<option value="right" <?php echo isSeletcted("right", $value) ?> >Right Align</option>
	</select>	
	<?php
}
function get_unSubscriptionForm($hglht=null)
{
	?>
    	<div class="un_subscribe_Popinner">
            <div class="form-overlay"></div>
            <form method="post">
                <h5 <?php if($hglht=="h5"){ echo 'class="un_highlight"';}?> >Get new posts by email:</h5>
                <div class="un_subscription_form_field">
                    <input type="email" name="data[Widget][email]" placeholder="Enter your email" value=""
                    	<?php if($hglht=="email"){ echo 'class="un_highlight"';}?> />
                </div>
                <div class="un_subscription_form_field">
                    <input type="submit" name="subscribe" value="Subscribe"
                     <?php if($hglht=="submit"){ echo 'class="un_highlight"';}?> />
                </div>
            </form>
        </div>
    <?php
}
?>