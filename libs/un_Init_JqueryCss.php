<?php 
/*  instalation of javascript and css  */
function un_theme_back_enqueue_script()
{
		if(isset($_GET['page']))
		{
			if($_GET['page'] == 'newsletter-options')
			{
				/* include CSS for backend  */
  				wp_enqueue_style("UNmainCss", UN_PLUGURL . 'css/un-admin-style.css' );
				wp_enqueue_style("UNJqueryCSS", UN_PLUGURL . 'css/jquery-ui-1.10.4/jquery-ui-min.css' );
				wp_enqueue_style("wp-color-picker");
			}
		}
		
		if(isset($_GET['page']))
		{
			if($_GET['page'] == 'newsletter-options')
			{
				wp_enqueue_script("jquery-ui-accordion");
				wp_enqueue_script("wp-color-picker");
				wp_enqueue_script("jquery-effects-core");
				
				wp_register_script('UNCustomFormJs', UN_PLUGURL . 'js/custom-form-min.js', '', '', true);
				wp_enqueue_script("UNCustomFormJs");
				
				wp_register_script('UNCustomJs', UN_PLUGURL . 'js/un-custom-admin.js', '', '', true);
				wp_enqueue_script("UNCustomJs");
				/* end cusotm js */
				
				/* initilaize the ajax url in javascript */
				wp_localize_script( 'UNCustomJs', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
				wp_localize_script( 'UNCustomJs', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'plugin_url'=> UN_PLUGURL) );
			}
		}			
}
add_action( 'admin_enqueue_scripts', 'un_theme_back_enqueue_script' );

function un_theme_front_enqueue_script()
{
		wp_register_script('UNCustomJs', UN_PLUGURL . 'js/un-custom.js', array('jquery'),'',true);
		wp_enqueue_script("UNCustomJs");
		/* end cusotm js */
		
		/* initilaize the ajax url in javascript */
		wp_localize_script( 'UNCustomJs', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		wp_localize_script( 'UNCustomJs', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'plugin_url'=> UN_PLUGURL) );
		
		/* include CSS for front-end and backend  */
		wp_enqueue_style("UNmainCss", UN_PLUGURL . 'css/un-style.css' );
}
add_action( 'wp_enqueue_scripts', 'un_theme_front_enqueue_script' );		
?>