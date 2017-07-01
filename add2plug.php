<?php
 /**
 * Plugin Name: addParser
 * Plugin URI: http://wordpress.org
 * Description: plugin parses job advertisments and show optional count
 * Text Domain: add2plug
 * Domain Path: /languages
 * Author: nerjok
 * Version: 1.0
 */
		include_once 'include/addFunctions.php';
		include_once 'include/admin.php';


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

	add_action( 'admin_init', 'addParserAdmin' );


	/**
	 * top level menu
	 */
	function addParser_admin_page() {
	 // add top level menu page
	 add_menu_page(
	 'Add Parser admin',
	 'AddParser',
	 'manage_options',
	 'add2plug',
	 'add2plug_admin_page'
	 );
	}
	 
	/**
	 * register menu page
	 */
	add_action( 'admin_menu', 'addParser_admin_page' );


