<?php
/*

Plugin Name: The Library
Plugin URI: https://tech.trainingdoulas.com/the-library/
Description: Plugin for Library site specific features and functionality
Dependency: nn-network
Version: 1.0
Author: Brent Leavitt
Author URI: https://www.trainingdoulas.com/
License: GPLv2

*/


namespace the_library;

use the_library\init\CPT as CPT;

if ( ! defined( 'ABSPATH' ) )  exit;

if( !defined( 'NNLIB_PATH' ) )
	define( 'NNLIB_PATH', plugin_dir_path( __FILE__ )  );

if( !defined( 'NNLIB_PREFIX' ) )
	define( 'NNLIB_PREFIX', 'nnlib_' ); 	//Prefix to use throughout the plugin. 

if( !defined( 'NNLLIB_TD' ) )
	define( 'NNLIB_TD', 'the_library' );	//Plugin text domain. 

$nnlib_vars = array(
	'remote_post' => false,
	'post_slug' => ''
);


if( !class_exists( 'The_Library' ) ){
	class The_Library{
		

		/*
			Name: 
			Description: 
		*/			

		public function __construct(){			
			
			$this->autoload_classes();
			add_action( 'init', array( $this, 'init' ) );
			add_action( 'admin_init', array( $this, 'admin_init' ));
			add_action( 'admin_menu', array( $this, 'admin_menus' ));

		}

		
		/*
			Name: 
			Description: 
		*/			

		public function init(){
			
				 	
			//$listener	 = new init\Listener();		//Add Query Vars Listeners
			$shortcodes	 = new init\ShortCodes();		//Shortcodes	
			/*	$email_settings = new init\Email();		//Email Settings
				 */
			 
			//setup Custom Post Types
			$this->set_cpts();
			
			
			//setup activation and deactivation hooks
			register_activation_hook( __FILE__, array( $this, 'activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );
			
			//version control?

		}

		
		/*
			Name: admin_init
			Description: Setup up initating actions within the admin panel
		*/			

		public function admin_init(){
			
				 	
			
		}
		
		
		
		/*
			Name: admin_menu
			Description: Setup up menus for the admin panel.
		*/			

		public function admin_menus(){
			
				 	
			
		}
		
		
		/*
			Name: 
			Description: 
		*/			
	
		private function autoload_classes( ){
			
			//This loads all classes, as needed, automatically! Slick!
			
			spl_autoload_register( function( $class ){
				
				$path = substr( str_replace( '\\', '/', $class), 0 );
				$path = __DIR__ .'/'. $path . '.class.php';
				
				if (file_exists($path))
					require $path;
				
			} );
		}	
	
	
		
		/*
			Name: 
			Description: 
		*/			
			
		public function activation(){
		
			//This plugin is dependent upon the-library plugin. 
			if( !class_exists( 'NN_Network' ) ) {
				deactivate_plugins( plugin_basename( __FILE__ ) );
				wp_die( __( 'Please install and Activate The NN_Network plugin.', 'nnlib-addon-slug' ), 'Missing Plugin Requred', array( 'back_link' => true ) );
			}
			
			//Setup Custom Post Types
			$this->set_cpts();
			
			//Clear the permalinks after CPTs have been registered
			flush_rewrite_rules();	
		
		}
		
		/*
			Name: 
			Description: Add Custom Post Types
		*/		
		
		public function set_cpts(){
			
			$cpts = new CPT();
			$cpts->setup();
			
		}

		
		/*
			Name: 
			Description: Remove Custom Post Types
		*/			
		
		public function remove_cpts(){
		
			$cpts = new CPT();
			$cpts->remove();
		
		}
		
		
		/*
			Name: set_caps
			Description: Set 
		*/			
		
		public function set_caps(){
			
			$caps = new CPT();
			$caps->set_caps();
			
		}
		
		
		
		/*
			Name: 
			Description: 
		*/			
		
		public function deactivation(){
			
			//Clean up Post Types being removed. 
			$this->remove_cpts(); 	// unregister the post type, so the rules are no longer in memory
			flush_rewrite_rules();	// clear the permalinks to remove our post type's rules from the database
			
			
			/* //See Activiation: 
			//Remove caps given to all roles for plugin specific CPTs. 
			$this->remove_caps();
			$this->remove_roles(); */
			
		}		
	}
}	

//Add User Access Scripts 
//include_once('func/the_lib_access.php'); 

//Add Custom Meta Boxes.
//include_once('func/the_lib_meta_box.php');



$the_library = new The_Library();


/* 

add_filter( 'wp_mail_from', function( $name ) {
	return 'rachel@childbirthlibrary.org';
});

add_filter( 'wp_mail_from_name', function( $name ) {
	return 'Test at New Beginnings';
});
 */


?>