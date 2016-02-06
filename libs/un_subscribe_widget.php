<?php
// Creating the widget 
class subscriber_form_widget extends WP_Widget {

	function __construct()
	{
		parent::__construct(
			// Base ID of your widget
			'subscriber_form_widget', 
	
			// Widget name will appear in UI
			__('Ultimate Subscribe Form', 'subscriber_form_widget_domain'), 
	
			// Widget description
			array( 'description' => __( 'Ultimate Subscribe Form', 'subscriber_form_widget_domain' ), ) 
		);
	}

	public function widget( $args, $instance )
	{
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

		if ( ! empty( $title ) )
		{
			echo $args['before_title'] . $title . $args['after_title'];
		}

		// Call subscriber form
		echo do_shortcode("[newsletter_subscription_form]");
		
		echo $args['after_widget'];
	}
		
	// Widget Backend 
	public function form( $instance )
	{
		if ( isset( $instance[ 'title' ] ))
		{
			$title = $instance[ 'title' ];
		}
		else
		{
			$title = '';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $newInstance, $oldInstance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $newInstance['title'] ) ) ? strip_tags( $newInstance['title'] ) : '';
		return $instance;
	}
}
// Class wpb_widget ends here

// Register and load the widget
function subscriber_form_load_widget()
{
	register_widget( 'subscriber_form_widget' );
}
add_action( 'widgets_init', 'subscriber_form_load_widget' );
?>
<?php
add_shortcode("newsletter_subscription_form", "un_get_subscriberForm");
function un_get_subscriberForm()
{
	$option1 = unserialize(get_option('un_section1_options',false));
	$un_feediid = sanitize_text_field(get_option('un_feed_id'));
	$url = "http://www.specificfeeds.com/widgets/subscribeWidget/";
	$return = '';
	$url = $url.$un_feediid.'/8/';	
	$return .= '<div class="un_subscribe_Popinner">
					<form method="post" onsubmit="return un_processfurther(this);" target="popupwindow" action="'.$url.'">
						<h5>'.sanitize_text_field(trim($option1['un_form_heading_text'])).'</h5>
						<div class="un_subscription_form_field">
							<input type="email" name="data[Widget][email]" value="" placeholder="'.sanitize_text_field(trim($option1['un_form_field_text'])).'"/>
						</div>
						<div class="un_subscription_form_field">
							<input type="hidden" name="data[Widget][feed_id]" value="'.$un_feediid.'">
							<input type="hidden" name="data[Widget][feedtype]" value="8">
							<input type="submit" name="subscribe" value="'.sanitize_text_field($option1['un_form_button_text']).'" />
						</div>
					</form>
				</div>';
	return $return;				
}
?>