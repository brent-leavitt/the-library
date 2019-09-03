  <?php 


/*

 name: NB CBL CPT (new beginnings childbirth library custom post types)
 
 description: Sets up CPT's for use in the library
 
 params: n/a
 
 returns: called by the 'init' action hook. 

*/

function cpt() {
	
	
	/*
		Materials CPT
	 */ 

	$material_labels = array(
		'name' => _x('Materials', 'post type general name', 'the-library'),
		'singular_name' => _x('Material', 'post type singular name', 'the-library'),
		'add_new' => _x('New Material', 'material', 'the-library'),
		'add_new_item' => __('Add New Material', 'the-library'),
		'edit_item' => __('Edit Material', 'the-library'),
		'new_item' => __('New Material', 'the-library'),
		'all_items' => __('All Materials', 'the-library'),
		'view_item' => __('View Material', 'the-library'),
		'search_items' => __('Search Materials', 'the-library'),
		'not_found' =>  __('No materials found', 'the-library'),
		'not_found_in_trash' => __('No materials found in Trash', 'the-library'), 
		'parent_item_colon' => '',
		'menu_name' => __('Catalog', 'the-library')
	);

	$material_args = array(
		'labels' => $material_labels,
		'description' => 'library resources and materials',
		'public' => true ,
		'publicly_queryable' => true,
		'query_var' => true,
		'show_ui' => true,
		'has_archive' => true, 
		'hierarchical' => true,
		'menu_position' => 52,
		'menu_icon' => 'dashicons-book-alt',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt',  'page-attributes', 'revisions', 'comments', 'author' ),  
		'taxonomies' => array( 'mat_cats', 'mat_tags', 'mat_writers' ),
		'capabilities' => array(
			'publish_posts' => 'publish_materials',
			'edit_posts' => 'edit_materials',
			'edit_others_posts' => 'edit_others_materials',
			'delete_posts' => 'delete_materials',
			'delete_others_posts' => 'delete_others_materials',
			'read_private_posts' => 'read_private_materials',
			'edit_post' => 'edit_material',
			'delete_post' => 'delete_material',
			'read_post' => 'read_material',
			'read' => 'read_materials',
			'edit_private_posts' => 'edit_private_materials',
			'edit_published_posts' => 'edit_published_materials',
			'delete_published_posts' => 'delete_published_materials',
			'delete_private_posts' => 'delete_private_materials'
		), 
		'map_meta_cap'=> true, 
		'rewrite' => array( 'slug' => 'materials' )
	); 

	register_post_type('lib_material', $material_args);
	
	
	/*
		Course CPT
	*/ 
	
	
	$course_labels = array(
		'name' => _x('Course', 'post type general name', 'the-library'),
		'singular_name' => _x('Course', 'post type singular name', 'the-library'),
		'add_new' => _x('Add New', 'course', 'the-library'),
		'add_new_item' => __('Add New Section', 'the-library'),
		'edit_item' => __('Edit Section', 'the-library'),
		'new_item' => __('New Section', 'the-library'),
		'all_items' => __('All Sections', 'the-library'),
		'view_item' => __('View Section', 'the-library'),
		'search_items' => __('Search Sections', 'the-library'),
		'not_found' =>  __('No sections found', 'the-library'),
		'not_found_in_trash' => __('No sections found in Trash', 'the-library'), 
		'parent_item_colon' => '',
		'menu_name' => __('Course', 'the-library')
	);

	$course_args = array(
		'labels' => $course_labels,
		'description' => 'comprehensive classes in childbirth support',
		'public' => true ,
		'publicly_queryable' => true,
		'query_var' => true,
		'show_ui' => true,
		'has_archive' => true, 
		'hierarchical' => true,
		'menu_position' => 53,
		'menu_icon' => 'dashicons-welcome-learn-more',
		'supports' => array( 'title', 'editor', 'page-attributes', 'revisions', 'comments' ),  
		'capabilities' => array(
			'publish_posts' => 'publish_courses',
			'edit_posts' => 'edit_courses',
			'edit_others_posts' => 'edit_others_courses',
			'delete_posts' => 'delete_courses',
			'delete_others_posts' => 'delete_others_courses',
			'read_private_posts' => 'read_private_courses',
			'edit_post' => 'edit_course',
			'delete_post' => 'delete_course',
			'read_post' => 'read_course',
			'read' => 'read_courses',
			'edit_private_posts' => 'edit_private_courses',
			'edit_published_posts' => 'edit_published_courses',
			'delete_published_posts' => 'delete_published_courses',
			'delete_private_posts' => 'delete_private_courses'
		), 
		'map_meta_cap'=> true, 
		'rewrite' => array( 'slug' => 'courses' )
	); 

	register_post_type('course', $course_args); 	 
	
	
}


/*

 name: NB CBL TAX (new beginnings childbirth library taxonomies)
 
 description: Taxonomies associcated with library materials. 
 
 params: n/a
 
 returns: called by the 'init' action hook. 

*/

// create two taxonomies, genres and writers for the post type "book"
function tax() {
	
	
	// Add new category taxonomy sepecific for library materials,  hierarchical
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'the-library' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'the-library' ),
		'search_items'      => __( 'Search Categories', 'the-library' ),
		'all_items'         => __( 'All Categories', 'the-library' ),
		'parent_item'       => __( 'Parent Category', 'the-library' ),
		'parent_item_colon' => __( 'Parent Category:', 'the-library' ),
		'edit_item'         => __( 'Edit Category', 'the-library' ),
		'update_item'       => __( 'Update Category', 'the-library' ),
		'add_new_item'      => __( 'Add New Category', 'the-library' ),
		'new_item_name'     => __( 'New Category Name', 'the-library' ),
		'menu_name'         => __( 'Category', 'the-library' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'section' ),
	);

	register_taxonomy( 'mat_cats', 'lib_material', $args );
	
	

	// Add new tags taxonomy specific for library material, NOT hierarchical
	$labels = array(
		'name'                       => _x( 'Tags', 'taxonomy general name', 'the-library' ),
		'singular_name'              => _x( 'Tag', 'taxonomy singular name', 'the-library' ),
		'search_items'               => __( 'Search Tags', 'the-library' ),
		'popular_items'              => __( 'Popular Tags', 'the-library' ),
		'all_items'                  => __( 'All Tags', 'the-library' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Tag', 'the-library' ),
		'update_item'                => __( 'Update Tag', 'the-library' ),
		'add_new_item'               => __( 'Add New Tag', 'the-library' ),
		'new_item_name'              => __( 'New Tag Name', 'the-library' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'the-library' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'the-library' ),
		'choose_from_most_used'      => __( 'Choose from the most used tags', 'the-library' ),
		'not_found'                  => __( 'No tags found.', 'the-library' ),
		'menu_name'                  => __( 'Tags', 'the-library' ),
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

	register_taxonomy( 'mat_tags', 'lib_material', $args );

	
	
	// Add new writers taxonomy, NOT hierarchical
	$labels = array(
		'name'                       => _x( 'Writers', 'taxonomy general name', 'the-library' ),
		'singular_name'              => _x( 'Writer', 'taxonomy singular name', 'the-library' ),
		'search_items'               => __( 'Search Writers', 'the-library' ),
		'popular_items'              => __( 'Popular Writers', 'the-library' ),
		'all_items'                  => __( 'All Writers', 'the-library' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Writer', 'the-library' ),
		'update_item'                => __( 'Update Writer', 'the-library' ),
		'add_new_item'               => __( 'Add New Writer', 'the-library' ),
		'new_item_name'              => __( 'New Writer Name', 'the-library' ),
		'separate_items_with_commas' => __( 'Separate writers with commas', 'the-library' ),
		'add_or_remove_items'        => __( 'Add or remove writers', 'the-library' ),
		'choose_from_most_used'      => __( 'Choose from the most used writers', 'the-library' ),
		'not_found'                  => __( 'No writers found.', 'the-library' ),
		'menu_name'                  => __( 'Writers', 'the-library' ),
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

	register_taxonomy( 'mat_writers', 'lib_material', $args );
	
}



add_action( 'init', 'cpt', 10 ); //Add Custom Post Types

add_action( 'init', 'tax', 10 ); //Add Taxonomies for CPT

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