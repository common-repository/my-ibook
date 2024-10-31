<?php
/*
 * Plugin Name: MyiBook
 * Version: 1.3
 * Plugin URI: http://www.eshiok.com/component/option,com_docman/task,doc_details/gid,49/Itemid,29/
 * Description: Use myiBook Widget to display the latest comments from your friends who has signed to your iBook.
 * Author: eShiok.com
 * Author URI: http://www.eshiok.com
 */
class MyiBookWidget extends WP_Widget
{
	/**
	* Declares the MyiBookWidget class.
	*
	*/
	function MyiBookWidget(){
		$widget_ops = array('classname' => 'widget_myibook', 'description' => __( "You can display the latest comments from your friends or visitors who has signed to your iBook") );
		$control_ops = array('width' => 300, 'height' => 300);
		$this->WP_Widget('myibook', __('MyiBook Widget'), $widget_ops, $control_ops);
	}
	
	/**
	* Displays the Widget
	*
	*/
	function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
		$myibookid = empty($instance['myibookid']) ? 'eshiok' : $instance['myibookid'];
		$totalPost = empty($instance['totalPost']) ? '5' : $instance['totalPost'];
		$ibookwidth = empty($instance['ibookwidth']) ? '176' : $instance['ibookwidth'];
		
		# Before the widget
		echo $before_widget;
		
		# The title
		if ( $title )
			echo $before_title . $title . $after_title;
		
		# Render the Widget
		echo '<script language="javascript" type="text/javascript" src="http://www.eshiok.com/components/com_ibook/myiBook.php?id=' . $myibookid . '&target=_blank&width=' . $ibookwidth . '&totalcomment=' . $totalPost . '&skin=default"></script>';

		# After the widget
		echo $after_widget;
	}
	
	/**
	* Saves the widgets settings.
	*
	*/
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['myibookid'] = strip_tags(stripslashes($new_instance['myibookid']));
		$instance['totalPost'] = strip_tags(stripslashes($new_instance['totalPost']));
		$instance['ibookwidth'] = strip_tags(stripslashes($new_instance['ibookwidth']));
		
		return $instance;
	}
	
	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'myibookid'=>'eshiok', 'totalPost'=>'5', 'ibookwidth'=>'176') );
		
		$title = htmlspecialchars($instance['title']);
		$myibookid = htmlspecialchars($instance['myibookid']);
		$totalPost = htmlspecialchars($instance['totalPost']);
		$ibookwidth = htmlspecialchars($instance['ibookwidth']);
		
		# Output the options
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width: 250px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
		# Fill myiBook ID
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('myibookid') . '">' . __('myIBook ID:') . ' <input style="width: 100px;" id="' . $this->get_field_id('myibookid') . '" name="' . $this->get_field_name('myibookid') . '" type="text" value="' . $myibookid . '" /></label></p>';
		# Fill Total Post to be displayed
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('totalPost') . '">' . __('Total Post to display:') . ' <input style="width: 100px;" id="' . $this->get_field_id('totalPost') . '" name="' . $this->get_field_name('totalPost') . '" type="text" value="' . $totalPost . '" /></label></p>';
		# Fill Width of iBook Widget
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('ibookwidth') . '">' . __('Width:') . ' <input style="width: 100px;" id="' . $this->get_field_id('ibookwidth') . '" name="' . $this->get_field_name('ibookwidth') . '" type="text" value="' . $ibookwidth . '" /></label></p>';
	}

}// END class
	
	/**
	* Register  widget.
	*
	* Calls 'widgets_init' action after the Hello World widget has been registered.
	*/
	function myibookInit() {
	register_widget('MyiBookWidget');
	}	
	add_action('widgets_init', 'myibookInit');
?>