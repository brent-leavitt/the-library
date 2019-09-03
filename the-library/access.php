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
	
	/* $mem_model = new MS_Model_Member();
	$member = $mem_model->get_current_member();
	
	$access_arr = array(
		'non_paying' => [ 30, 201, 151 ], //Non-paying IDs 
		'paying' => [ 39, 38, 4371 ], //Paying IDs
		'preview' => [ 151, 201 ], //Preview IDs
		'bots' => [ 201 ] //Robots IDs
	); 
	
	
	$cbl_membership_id = $member->get_membership_ids();
	
	if( array_key_exists( $access, $access_arr ) ){
		
		$results = '';
		
		$result = array_intersect( $cbl_membership_id, $access_arr[ $access ] );
		
		
		
		return ( !empty( $result ) )? true : false ; 
	}
 */
	return true;
	//return NULL; //access not set. 
}



?>