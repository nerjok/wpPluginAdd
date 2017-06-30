<?php
/**
*
Plugin Name: addParser
Plugin URI: http://wordpress.org
Description: plugin parses job advertisments and show optional count
Author: nerjok
Version: 1.0
*/
		include_once 'include/addFunctions.php';

 	define(RSSFEED, 'rssWidgetId');

/**
 *
 * @return plugin activation/deactivations functions
 */
register_activation_hook(__FILE__, 'testToInstall');

register_deactivation_hook(__FILE__, 'testToRemove');

	function testToInstall()
	{		

		add_option('testfield');
		
		add_option(RSSFEED);
	}

	function testToRemove()
	{	

		delete_option("testfield");

	}	

/**
 * 
 * @return admin panel customization, add menu item
 */
	if (is_admin()):
	
	add_action('admin_menu', 'adminPanel');
	
	function adminPanel()
	{
		add_options_page('Edit add\s links', 'Edit add\'s', 'administrator', 'ads link', 'addEdit');
	}
	endif;
	
	function addEdit()
	{
		
		include_once 'include/admin.php';
	}


   /**
   * 
   * @return functions to register, controll widget itself
   */	
	function addWidget()
	{
		wp_register_sidebar_widget(
		RSSFEED, 
		__('Adds sample widget'), 
		'addsParsing'); 
		
		wp_register_widget_control(RSSFEED, 
        __('Add edit panel'), 'addSetings');
	}
	
	add_action( 'plugins_loaded', 'addWidget');
	