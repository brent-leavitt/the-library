<?php
/*
the_library\init\CPT

name: The Library Custom Post Types (CPTs)
 
description: Sets up CPT's for use in the library
params: n/a
returns: called by the 'init' action hook. 

*/

namespace the_library\init;

use \nn_network\modl\CPT as mCPT;

if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'CPT' ) ){
	class CPT{

			
		public $post_types = array(
			'course',
			'resource',
		);


	/*
		Name: 
		Description: 
	*/			
		
		public function __construct( ){
			//$this->setup();
			
		}

		
	/*
		Name: 
		Description: 
	*/			
		public function setup(){
		
			$this->set_ctps();
			
			$this->set_taxs();
			//add_action( 'init', array( $this, 'set_taxs' ), 10 ); //Add Taxonomies for CPT

			$this->set_caps();
	
		}
		
	/*
		Name: set_cpts
		Description: 
	*/	
		
		public function set_ctps(){
			
			//Define specific CPTs for use across the network. 
			//Most of these CPTs should only be active on the NN_BASESITE
			
			//if network and site_id equals NN_BASESITE then declare these CPTS. 
			
			
			$course =  new mCPT( 
				array( 
					'post_type'=> 'course',
					'description'=>'Library courses: organized, instructional presentations.',
					'menu_pos'=>53,
					'menu_icon'=>'welcome-learn-more', 
					'hierarchical' => false,
					'exclude_from_search' => false,
					'show_in_menu' => true,
					'supports' => array( 
						'title', 
						'editor', 
						'revisions' 
					)
				) 
			);
			
			//$course->set_status( [ '' ] );
			
			
			
			$resource =  new mCPT( 
				array( 
					'post_type'=> 'resource',
					'description'=> 'Library resources: handouts, e-books, webinars, and more.',
					'menu_pos'=>52,
					'menu_icon'=> 'book-alt', 
					'hierarchical' => false,
					'exclude_from_search' => true,
					'show_in_menu' => true,
					'supports' => array( 
						'title', 
						'editor', 
						'comments', 
						'author', 
						'revisions' 
					)
				) 
			);
			
			//$resource->set_status( [ '' ] );
			
			//Add Taxonomies here. 
			
			
		}		

		
	/*
		Name: set_taxs
		Description: 
	*/	
		
		public function set_taxs(){
			
			// Add new category taxonomy sepecific for library materials,  hierarchical
			$labels = array(
				'name'              => _x( 'Categories', 'taxonomy general name', NNLIB_TD ),
				'singular_name'     => _x( 'Category', 'taxonomy singular name', NNLIB_TD ),
				'search_items'      => __( 'Search Categories', NNLIB_TD ),
				'all_items'         => __( 'All Categories', NNLIB_TD ),
				'parent_item'       => __( 'Parent Category', NNLIB_TD ),
				'parent_item_colon' => __( 'Parent Category:', NNLIB_TD ),
				'edit_item'         => __( 'Edit Category', NNLIB_TD ),
				'update_item'       => __( 'Update Category', NNLIB_TD ),
				'add_new_item'      => __( 'Add New Category', NNLIB_TD ),
				'new_item_name'     => __( 'New Category Name', NNLIB_TD ),
				'menu_name'         => __( 'Category', NNLIB_TD ),
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'section' ),
			);

			register_taxonomy( NNLIB_PREFIX.'r_cat', 'nn_resource', $args );
			
			

			// Add new tags taxonomy specific for library material, NOT hierarchical
			$labels = array(
				'name'                       => _x( 'Tags', 'taxonomy general name', NNLIB_TD ),
				'singular_name'              => _x( 'Tag', 'taxonomy singular name', NNLIB_TD ),
				'search_items'               => __( 'Search Tags', NNLIB_TD ),
				'popular_items'              => __( 'Popular Tags', NNLIB_TD ),
				'all_items'                  => __( 'All Tags', NNLIB_TD ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item'                  => __( 'Edit Tag', NNLIB_TD ),
				'update_item'                => __( 'Update Tag', NNLIB_TD ),
				'add_new_item'               => __( 'Add New Tag', NNLIB_TD ),
				'new_item_name'              => __( 'New Tag Name', NNLIB_TD ),
				'separate_items_with_commas' => __( 'Separate tags with commas', NNLIB_TD ),
				'add_or_remove_items'        => __( 'Add or remove tags', NNLIB_TD ),
				'choose_from_most_used'      => __( 'Choose from the most used tags', NNLIB_TD ),
				'not_found'                  => __( 'No tags found.', NNLIB_TD ),
				'menu_name'                  => __( 'Tags', NNLIB_TD ),
			);

			$args = array(
				'hierarchical'          => false,
				'labels'                => $labels,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var'             => true,
				'rewrite'               => array( 'slug' => 'topic' ),
			);

			register_taxonomy( NNLIB_PREFIX.'r_tag', 'nn_resource', $args );

			
			
			// Add new writers taxonomy, NOT hierarchical
			$labels = array(
				'name'                       => _x( 'Writers', 'taxonomy general name', NNLIB_TD ),
				'singular_name'              => _x( 'Writer', 'taxonomy singular name', NNLIB_TD ),
				'search_items'               => __( 'Search Writers', NNLIB_TD ),
				'popular_items'              => __( 'Popular Writers', NNLIB_TD ),
				'all_items'                  => __( 'All Writers', NNLIB_TD ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item'                  => __( 'Edit Writer', NNLIB_TD ),
				'update_item'                => __( 'Update Writer', NNLIB_TD ),
				'add_new_item'               => __( 'Add New Writer', NNLIB_TD ),
				'new_item_name'              => __( 'New Writer Name', NNLIB_TD ),
				'separate_items_with_commas' => __( 'Separate writers with commas', NNLIB_TD ),
				'add_or_remove_items'        => __( 'Add or remove writers', NNLIB_TD ),
				'choose_from_most_used'      => __( 'Choose from the most used writers', NNLIB_TD ),
				'not_found'                  => __( 'No writers found.', NNLIB_TD ),
				'menu_name'                  => __( 'Writers', NNLIB_TD ),
			);

			$args = array(
				'hierarchical'          => false,
				'labels'                => $labels,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var'             => true,
				'rewrite'               => array( 'slug' => 'writer' ),
			);

			register_taxonomy( NNLIB_PREFIX.'r_writers',  'nn_resource', $args );
			
			
		}	

	/* 	(INCOMPLETE) 
		Name: set_caps
		Description: 
	*/			
		public function set_caps(){
			
			foreach( $this->post_types as $pt ){
				
				//I need a list of all the capabilities to add to the admin. 
				$cpt = new mCPT( array( 'post_type' => $pt ) );
				
				//Then I need to add_caps to the admin: 
				$admin = get_role( 'administrator' );
				 
				/* foreach( $caps as $cap ){
					 
					 $admin->add_cap( $cap );
				} */

			}
			
		}

		
	/*
		Name: 
		Description: 
	*/	
	
		public function remove(){
			
			$types = $this->post_types;
			foreach( $types as $type )
				unregister_post_type( $type );
			
		}
		



		
	/*
		Name: 
		Description: 
	*/	
		
		public function __(){
			
			
		}
		
		
	}
}	

/*

 name: NB CBL TAX (new beginnings childbirth library taxonomies)
 
 description: Taxonomies associcated with library materials. 
 
 params: n/a
 
 returns: called by the 'init' action hook. 

*/

// create two taxonomies, genres and writers for the post type "book"
function tax() {
	
	
	
	
}



function my_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    cpt();
    tax();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );

?>