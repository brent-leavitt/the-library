<?php
/*
the_library\init\Roles

Roles - An Initializing Class for The Library Plugin
Last Updated on 2 Oct 2019
-------------

  Description: Roles and Caps Management




*/

namespace the_library\init;	

use \nn_network\init\Roles as nRoles;

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;
	
	
if( !class_exists( 'Roles' ) ){
	
	class Roles extends nRoles {

		
		// Properties

		public $add = array(
			'visitor'	// Default role. Non-paying. 
		);

		
		//These default roles are to be removed from the CRM.
		public $remove = array(
			'contributor'
		);
		
		public $default_role = 'visitor';
		
		
		
		//Methods

		/*
			No new methods added in this class. All methods are the same as the parent class. 
		*/
	
	}
	
}



?>