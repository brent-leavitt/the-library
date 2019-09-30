<?php
/*
*	the_library\init\Listener
*
*	Name: Listner
*   Created on 22 Aug 2018

	Description: The purpose of the listener is to 

	IS THIS CLASS EVEN NEEDED HERE. 
	
	*** DOES NOT THE NETWORK PLUGIN COVER EVERYTHING THAT WE ARE DOING HERE? ***



*/
namespace the_library\init;

if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'Listener' ) ){
	
	class Listener{
	
	
	
	
		
		/*
			Name: 
			Description: 
		*/			
		
		public function __construct( ){
			//This allows us to use wordpress to handle the ipn request. 
			add_action( 'template_redirect', array( $this, 'queryVarsListener' ) );
			add_filter( 'query_vars',  array( $this, 'queryVar' ) );
		}

	


		/*
			Name: 
			Description: 
		*/			
		
		public function queryVar($public_query_vars) {
			$public_query_vars[] = 'collect'; // For Email Collections
			
			/* $public_query_vars[] = 'odd'; // For Cron Job Access */
			return $public_query_vars;
		}

		/*
			Name: 
			Description: 
		*/			
		
		public function queryVarsListener() {
			//Check that the query var is set and is the correct value.
			if (isset($_GET['collect']) && $_GET['collect'] == 'payment'){

				require_once( NB_CBL_PATH . ( 'func/collect.php' ) );
				//Stop WordPress entirely
				exit;
			}
			
		/* 	if(isset($_GET['odd']) && $_GET['odd'] == 517){
				//Run NB Cron Tasks Such as invoicing and scheduled registration invites. 
				include "lib_crons.php";
				//Stop the rest of Wordpress. 
				exit;
			} */
		}
		
		
	}
}

?>