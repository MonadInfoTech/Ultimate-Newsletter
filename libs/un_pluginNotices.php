<?php
add_action('admin_notices', 'un_admin_notice', 10);
function un_admin_notice()
{
	global $wp_version;
	
	if(isset($_GET['page']) && $_GET['page'] == "newsletter-options")
	{
		$install_date = get_option('un_installDate');
		$display_date = date('Y-m-d h:i:s');
		$datetime1 = new DateTime($install_date);
		$datetime2 = new DateTime($display_date);
		$diff_inrval = round(($datetime2->format('U') - $datetime1->format('U')) / (60*60*24));
		
		if($diff_inrval >= 30 && get_option('un_RatingDiv')=="no")
		{
			$reviewUrl = "https://wordpress.org/support/view/plugin-reviews/newsletter-email-mailing-list";
			$dismissUrl = "?un-dismiss-notice=true";
			
			echo '<div class="updated">
				<p>
					We noticed you\'ve been using the Ultimate Subscribe Plugin for more than 30 days. If you\'re happy with it, could you please do us a BIG favor and give it a 5-star rating on Wordpress?
				</p>
				<ul>
					<li><a href="'.$reviewUrl.'" target="_new" title="Ok, you deserved it">Ok, you deserved it</a></li>
					<li><a href="'.$dismissUrl.'" title="I already did">I already did</a></li>
					<li><a href="'.$dismissUrl.'" title="No, not good enough">No, not good enough</a></li>
				</ul>
			</div>';
		}
	}
}

add_action('admin_init', 'un_dismiss_admin_notice');
function un_dismiss_admin_notice()
{
	if ( isset($_REQUEST['un-dismiss-notice']) && $_REQUEST['un-dismiss-notice'] == 'true' )
	{
		update_option( 'un_RatingDiv', "yes" );
		header("Location: ".site_url()."/wp-admin/admin.php?page=newsletter-options");
	}
}

?>