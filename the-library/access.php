<?php 

/*

 filename: NB_CBL_ACCESS.PHP
 description: Sets of functions that allow users access based upon their Membership subscription

*/
 
 
 
/*
	NAME: CBL_USER_IS
	
	DESCRIPTION: This allows us to determine who has access to what!
	
	PARAMS: $acccess = 'non_paying', 'paying', 'preview', 'bots' (required)
	
	RETURNS: true|false|NULL on not set. 

*/


function lib_user_is( $access ) {
	
	$patron = wp_get_current_user();
	
	$roles = [];	
	
	if( $patron->exists() ){
		
		$roles = ( array ) $patron->roles;
		
	}
	
	return ( in_array( $access, $roles, true ) )? true : false ; 
	 
}



?>