<?php 


/*

 name: NB CBL ADMIN JS
 
 description: enqueue scripts hook for JavaScript Features on Resources CPTs
 
 params: $hook = the page that is being hooked, for example: post.php. 
 
 returns: Adds jquery action to metaboxes. 

*/
 

//ENQUE SCRIPTS  
function the_lib_admin_js( $hook ) {
	global $post_type;
	if( ( ( $hook == 'post.php' ) || ( $hook == 'post-new.php' ) ) && ( $post_type == NNLIB_PREFIX.'resource' ) ){
		
	
		if ( is_admin() ) {
			wp_enqueue_script( 'jquery' );
			//adding scripts file in the footer
			wp_register_script( 'js-js', plugins_url( '/admin/js.js', __FILE__ ) , array( 'jquery' ), false, true );
			wp_enqueue_script( 'js-js' );
			
			wp_enqueue_style('style-css',  plugins_url( '/admin/style.css', __FILE__ ) );
		} 
		
	}
}

// connect to admin action hook for scripts. 
add_action('admin_enqueue_scripts', 'the_lib_admin_js', 1);

?>