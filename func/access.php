<?php 

/*

 filename: func/access.php
 description: Sets of functions that allow users access based upon their Membership subscription

*/
 
 
 
/*
	NAME: lib_user_is
	DESCRIPTION: This allows us to determine who has access to what!
	PARAMS: $acccess = 'non_paying', 'paying', 'preview', 'bots' (required)
	RETURNS: true|false|NULL on not set. 

*/


function lib_user_is( $access ) {
	
	$patron = wp_get_current_user();
	
	$levels = [
		'non-paying' => [ 'visitor' ],
		'paying' => [ 'subscriber', 'author', 'editor', 'administrator' ],
		'preview' => [],
		'bots' => []
	];	
	
	$role = ( $patron->roles[0] )?? 0;

	if( empty( $role ) ) return false;
	
	return ( in_array( $role, $levels[ $access ], true ) )? true : false ; 
	 
}

/*

$user_id = 151;

$user_meta=get_userdata($user_id); 
$user_roles=$user_meta->roles; 

var_dump( $user_roles );

if (in_array("administrator", $user_roles)){}
	
*/

?>