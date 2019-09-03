<?php
/*
Plugin Name: The Library
Plugin URI: https://tech.trainingdoulas.com/the-library/
Description: Plugin for Library site specific features and functionality
Version: 1.0
Author: Brent Leavitt
Author URI: https://www.trainingdoulas.com/
License: GPLv2

*/

define( 'THE_LIB_PATH', plugin_dir_path( __FILE__ )  );

$nb_vars = array(
	
	'remote_post' => false,
	'post_slug' => ''
	
);

//Add Custom Post Types. 
include_once('func/the_lib_cpt.php'); 

//Add User Access Scripts 
include_once('func/the_lib_access.php'); 

//Add Custom Meta Boxes.
include_once('func/the_lib_meta_box.php');

//Add URL Parsing functionality. 
//include_once('func/the_lib_parser.php');

//Add styles and script.
include_once('func/the_lib_scripts.php');

//Add query variables listener .
include_once('func/the_lib_listener.php');


/* 

add_filter( 'wp_mail_from', function( $name ) {
	return 'rachel@childbirthlibrary.org';
});

add_filter( 'wp_mail_from_name', function( $name ) {
	return 'Test at New Beginnings';
});
 */


?>