<?php
/*
* 	Listener  
*   Created on 22 Aug 2018
*/

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;
	
	//This allows us to use wordpress to handle the ipn request. 
	add_action( 'template_redirect', 'queryVarsListener' );
	add_filter( 'query_vars',  'queryVar' );

	function queryVar($public_query_vars) {
		$public_query_vars[] = 'collect'; // For Email Collections
		
		/* $public_query_vars[] = 'odd'; // For Cron Job Access */
		return $public_query_vars;
	}

	function queryVarsListener() {
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

?>