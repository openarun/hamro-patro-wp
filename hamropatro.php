<?php
/**
 * @package HamroPatro
 */
/*
Plugin Name: Hamro Nepali Patro Calendar
Plugin URI: https://github.com/arunpyasi/hamro-patro-wp
Description: Hamro Nepali Patro Calendar WordPress is an unofficial plugin which consits of Nepali Calendar Widgets.
Version: 1.2
Author: Arun Kumar Pariyar
Author URI: https://profiles.wordpress.org/arunpyasi/
License: GPLv2 or later
Text Domain: hamro-nepali-patro-calendar
*/

include('calendar.php');
include('dateconverter.php');
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

function hamropatro_dateconverter_shortcode()
{
    return '<iframe src="https://www.hamropatro.com/widgets/dateconverter.php" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:350px; height:150px;" allowtransparency="true"></iframe>';
}

// Add Shortcode.
add_shortcode('hamropatro-calendar-large', 'hamropatro_calendar_full_shortcode');
add_shortcode('hamropatro-calendar-small', 'hamropatro_calendar_small_shortcode');
add_shortcode('hamropatro-calendar-medium', 'hamropatro_calendar_medium_shortcode');
add_shortcode('hamropatro-dateconverter', 'hamropatro_dateconverter_shortcode');

// Register the widget
function hamropatro_register_dateconverter_widget() {
	register_widget('HamroPatro_DateConverter_Widget');
}
function hamropatro_register_calendar_widget() {
	register_widget('HamroPatro_Calendar_Widget');
}

// Add Widgets
add_action( 'widgets_init', 'hamropatro_register_dateconverter_widget' );
add_action( 'widgets_init', 'hamropatro_register_calendar_widget' );

