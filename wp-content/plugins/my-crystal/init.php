<?php
/*
Plugin Name: Crystal Fortunes
Description: Declares a plugin that will create a crystal fortunes.
Version: 1.0
Author: Asif Nomani
License: GPLv2
*/
				
function ss_options_install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "crystal_ball";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `fortunes` text CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'ss_options_install');

//menu items
add_action('admin_menu','my_fortunes_modifymenu');
function my_fortunes_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Fortunes', //page title
	'Fortunes', //menu title
	'manage_options', //capabilities
	'my_fortunes_list', //menu slug
	'my_fortunes_list', //function
	plugins_url( 'icon.png' ),
        6
	);
	
	//this is a submenu
	add_submenu_page('my_fortunes_list', //parent slug
	'Add New Fortune', //page title
	'Add New', //menu title
	'manage_options', //capability
	'my_fortunes_create', //menu slug
	'my_fortunes_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update Fortune', //page title
	'Update', //menu title
	'manage_options', //capability
	'my_fortunes_update', //menu slug
	'my_fortunes_update'); //function
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'crystal-list.php');
require_once(ROOTDIR . 'crystal-create.php');
require_once(ROOTDIR . 'crystal-update.php');
