<?php
/**
 * @package HamroPatro
 */
/*
Plugin Name: Hamro Nepali Patro Calendar
Plugin URI: https://github.com/arunpyasi/hamro-patro-wp
Description: Hamro Nepali Patro Calendar WordPress is an unofficial plugin which consits of Nepali Calendar Widgets.
Version: 1.0
Author: Arun Kumar Pariyar
Author URI: https://profiles.wordpress.org/arunpyasi/
License: GPLv2 or later
Text Domain: hamropatro
*/

// The shortcode functions with embed iframe.
function hamropatro_calendar_full_shortcode() {
	return '<iframe src="https://www.hamropatro.com/widgets/calender-full.php" frameborder="0" scrolling="no" marginwidth="0" marginheight="0"
        style="border:none; overflow:hidden; width:800px; height:840px;" allowtransparency="true"></iframe>';	 
}
function hamropatro_calendar_small_shortcode(){
    return '<iframe src="https://www.hamropatro.com/widgets/calender-small.php" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:200px; height:290px;" allowtransparency="true"></iframe>';
}

function hamropatro_calendar_medium_shortcode(){
    return '<iframe src="https://www.hamropatro.com/widgets/calender-medium.php" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:295px; height:385px;" allowtransparency="true"></iframe>';
}

// Add Shortcode.
add_shortcode('hamropatro-calendar-large', 'hamropatro_calendar_full_shortcode');
add_shortcode('hamropatro-calendar-small', 'hamropatro_calendar_small_shortcode');
add_shortcode('hamropatro-calendar-medium', 'hamropatro_calendar_medium_shortcode');

// The widget class
class HamroPatro_Widget extends WP_Widget {

	// Main constructor
	public function __construct() {
		parent::__construct(
			'hamropatro_widget',
			__( 'Hamro Patro', 'text_domain' ),
			array('customize_selective_refresh' => true,)
		);
	}

	// The widget form (for the backend )
	public function form( $instance ) {

		// Set widget defaults
		$defaults = array(
			'title'    => '',
			'select'   => '',
		);
		
		// Parse current settings with defaults
		extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

		<?php // Widget Title ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php // Dropdown ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'select' ); ?>"><?php _e( 'Size', 'text_domain' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'select' ); ?>" id="<?php echo $this->get_field_id( 'select' ); ?>" class="widefat">
			<?php
			// Your options array
			$options = array(
				'large' => __( 'Large', 'text_domain' ),
				'medium' => __( 'Medium', 'text_domain' ),
				'small' => __( 'Small', 'text_domain' ),
			);

			// Loop through options and add each one to the select dropdown
			foreach ( $options as $key => $name ) {
				echo '<option value="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" '. selected( $select, $key, false ) . '>'. $name . '</option>';

			} ?>
			</select>
		</p>

	<?php }

	// Update widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['select']   = isset( $new_instance['select'] ) ? wp_strip_all_tags( $new_instance['select'] ) : '';
		return $instance;
	}

	// Display the widget
	public function widget( $args, $instance ) {

		extract( $args );

		// Check the widget options
		$title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$select   = isset( $instance['select'] ) ? $instance['select'] : '';

		// WordPress core before_widget hook (always include )
		echo $before_widget;

		// Display the widget
		echo '<div class="widget-text hamro-patro-calendar">';

			// Display widget title if defined
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}

			// Display select field
			if ( $select ) {
				  echo do_shortcode('[hamropatro-calendar-'.$select.']');
			}

		echo '</div>';

		// WordPress core after_widget hook (always include )
		echo $after_widget;

	}

}

// Register the widget
function hamropatro_register_calendar_widget() {
	register_widget( 'HamroPatro_Widget' );
}
add_action( 'widgets_init', 'hamropatro_register_calendar_widget' );