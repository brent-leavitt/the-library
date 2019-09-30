<?php 


/*

 name: NB CBL METABOX (class)
 
 description: A class for handling meta values for the differnt library categories of materials.
 
 params: $field = 'name of meta box'; 
 
 returns: a metabox for adding additional features to the Materials CPT. 

*/
 
 
 
class MetaBox {
 
	public $field = '';
 
    /**
     * Constructor.
     */
    public function __construct( $field ) {
		
		
        if ( is_admin() ) {
			$this->field = $field;
		
            add_action( 'load-post.php',      array( $this, 'init' ) );
            add_action( 'load-post-new.php', array( $this, 'init' ) );
			
        }
 
    }
 
    /**
     * Meta box initialization.
     */
    public function init() {
				
        add_action( 'add_meta_boxes', array( $this, 'lib_add_metabox'  ), 20, 2 );
		
		$callable = ( strcmp( $this->field , 'gallery' ) !== 0 )? 'lib_meta_save' : 'lib_gallery_meta_save' ;  //toggle gallery save. 
		add_action( 'save_post_lib_material',  array( $this, $callable ), 10 );
		
    }
 
 
    /**
     * Adds the meta box.
     */
    public function lib_add_metabox( $post_type, $post ) {
		
		$field = $this->field;
		
		if( ( strcmp( $field, 'webinar' ) === 0 ) && ( !has_term( 'webinars', 'mat_cats', $post ) ) )
		 return;
		
		$callable = ( strcmp( $field , 'gallery' ) !== 0 )? 'lib_render_metabox' : 'lib_render_gallery_metabox' ;
		
		$title = ucfirst( $field  );
        add_meta_box(
            "_the_lib_{$field }", //MetaBox ID
            __( $title , 'lib_childbirthlibrary' ), //Title
            array( $this, $callable ), //callable -> toggle this for gallery. 
            'lib_material', //CPT
            'side', //position
            'high' //priority
        );
 
    }
	
	/**
     * Renders the meta box.
     */
    public function lib_render_metabox( $post ) {
		
        // Add nonce for security and authentication.
        wp_nonce_field( 'the_lib_nonce_action', 'the_lib_nonce' );
		
		$form = '';
		$field = $this->field;
		$post_id = $post->ID;
		$post_meta = get_post_meta( $post_id, "_the_lib_{$field}" );
		$post_meta = ( !empty( $post_meta[0] ) )? $post_meta[0] : [] ;
		
		/* GENERATES FIELDS FOR NAME VALUE PAIRS. */
		/* $form .= "<ol>"; */
		
		$placeholder = []; //empty array. 

		switch( $field ){
		
			case( 'webinar' ):
				$placeholder = ['Service','Video ID'];
				break;
				
			case( 'downloads' ):
				$placeholder = ['File Name','Relative URL Only'];
				break;
				
			case( 'attributes' ):
			default:
				$placeholder = ['Title','Value'];
				break;
				
		}
		
		if( strcmp( $field, 'webinar' ) === 0 ){
			 //Special clauses for the webinar metaboxes. 
			 
			$form .= $this->lib_build_metabox_inputs( $field, $placeholder,  $post_meta, NULL, false, [ 'Full Webinar', 'Preview Webinar (optional)' ] );
			
		} else {
			
			$form .= $this->lib_build_metabox_inputs( $field, $placeholder, $post_meta );
			
		}
			
			

		echo $form; 
		
    }
	
 
    /**
     * Renders the meta box.
     */
	 
    public function lib_build_metabox_inputs( $field, $placeholder, $meta_arr = array(), $list_type = 'ol', $repeat = true, $titles = array() ){
		
		$form = ''; 
		$ph_set = false; //is placeholder being used? default is false. 
		$input_arr = array();
		
		//start list_type wrapper. 
		
		if( !empty( $meta_arr ) ){
			
			$input_arr = $meta_arr; 
			
		}else{
			
			$input_arr = $placeholder; 
			$ph_set = true;
			
		}
		
		
		$i = 0; 
		
		$form .= ( !empty( $list_type ) )? "<{$list_type}>":"<div>";
		
		foreach( $input_arr as $key => $val ){
			
			$form .= ( !empty( $list_type ) )? "<li>" : "<p>"; 
			
			$form .= ( !empty( $titles ) )? $titles[ $i ]."<br />" : ""; //If specified, add titles.
			
			$form .= "<input type='text' class='lib_mat_{$field}_name' name='lib_mat_{$field}_name{$i}' id='lib_mat_{$field}_name{$i}' ";
			
			$form .= ( $ph_set == false )? "value='{$key}' " : "placeholder='".$placeholder[0]."' " ;
			
			$form .= " />
			<input type='text' class='lib_mat_{$field}_val' name='lib_mat_{$field}_val{$i}' id='lib_mat_{$field}_val{$i}' ";
			
			$form .= ( $ph_set == false )? "value='{$val}' " : "placeholder='".$placeholder[1]."' " ;
			
			$form .= " />";
			
			$form .=  ( !empty( $list_type ) )? "</li>" : "</p>";
			
			$i++;
		}

		
		//end list type wrapper.
		$form .= ( !empty( $list_type ) )? "</{$list_type}>":"</div>";
		
		//add "ADD | REMOVE" functionality for meta box. 
		$form .= ( $repeat == true )? "<a href='#' class='lib_mat_add_field' >add</a> | <a href='#' class='lib_mat_drop_field' >remove</a>" : '';
		
		return $form;
	}
	
	
 
    /**
     * Renders the meta box.
     */
    public function lib_render_gallery_metabox( $post ) {
		
	wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
	
	$field = $this->field;
	$post_meta = get_post_meta( $post->ID, "_the_lib_gallery", true );
	
    //$ids = get_post_meta($post->ID, '_the_lib_gallery', true); //old code
    ?>
    <div id="nb-cbl-gallery-wrap	">
		<p><a class="gallery-add button" href="#" data-uploader-title="Add image(s) to gallery" data-uploader-button-text="Add image(s)">Add image(s)</a></p>

        <ul id="gallery-metabox-list">
        <?php if ( $post_meta ) : foreach ( $post_meta as $key => $value) : $image = wp_get_attachment_image_src($value); ?>

          <li>
            <input type="hidden" name="_the_lib_gallery[<?php echo $key; ?>]" value="<?php echo $value; ?>">
            <img class="image-preview" src="<?php echo $image[0]; ?>">
            <a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><br>
            <small><a class="remove-image" href="#">Remove image</a></small>
          </li>

        <?php endforeach; endif; ?>
        </ul>
	</div>
      
	<?php
		
	}
	
	 
 
    /**
     * Handles saving the gallery meta box.
     *
     * @param int     $post_id Post ID.
     * @return null
     */
	 
    public function lib_gallery_meta_save( $post_id ) {
	 
		if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__))) return;
		
		 // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_materials', $post_id ) ) {
            return;
        }
 
        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }
 
        // Check if not a revision.
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }
		
		
		if(isset($_POST['_the_lib_gallery'])) {
			
			update_post_meta($post_id, '_the_lib_gallery', $_POST['_the_lib_gallery']);
			
		} else {
			
			delete_post_meta($post_id, '_the_lib_gallery');
			
		}
	 }
 
    /**
     * Handles saving the meta box.
     *
     * @param int     $post_id Post ID.
     * @return null
     */
    public function lib_meta_save( $post_id ) {
				
		// Add nonce for security and authentication.
        $nonce_name   = isset( $_POST['the_lib_nonce'] ) ? $_POST['the_lib_nonce'] : '';
        $nonce_action = 'the_lib_nonce_action';
		
		$field = $this->field;
 
		
        // Check if nonce is set.
        if ( ! isset( $nonce_name ) ) {
            return;
        }
 
        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }
 
        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_materials', $post_id ) ) {
            return;
        }
 
        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }
 
        // Check if not a revision.
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }
		
		//assemble array to insert
		$meta_arr = [];
		
		foreach( $_POST as $pkey => $pval ){
			
			//Filter through $_POST to find meta data and if it is not empty, proceed. 
			if( ( strpos( $pkey, "lib_mat_{$field}" ) === 0 ) && ( !empty( $pval )) ){ 
				$int = substr( $pkey, -1 );//This will return only the last character which should be a number. 
				
				if( strpos( $pkey, "name" ) != false ){
					$meta_arr[ $int ]['name'] = $pval; 
				} elseif( strpos( $pkey, "val" ) != false ){
					$meta_arr[ $int ]['val'] = $pval;
				}
				
				
			}
		}
		
		//Now we need to group name and value pairs for insertion into the database. 
		if( !empty( $meta_arr ) ){
			foreach( $meta_arr as $mkey => $marr ){
				if( !empty( $marr[ 'val' ] ) ){
					$meta_arr[ $marr[ 'name' ] ] = $marr[ 'val' ]; //reset grouped pair. 
				}
				
				unset( $meta_arr[ $mkey ] );//unset source key. 
			}
			
			$meta_arr = ( !empty( $meta_arr ) )? $meta_arr : FALSE ;
			
			update_post_meta( $post_id, "_the_lib_{$field}", $meta_arr );
		
		}
    }
}




//Add MetaBox for attributes
new MetaBox( 'attributes' );

//Add MetaBox for downloads
new MetaBox( 'downloads' );

//Add MetaBox for gallery
new MetaBox( 'gallery' );

//Add Metabox for webinars
new MetaBox( 'webinar' );



//Course CPT, Course Type Meta Data field added to publish box on admin screen
add_action( 'post_submitbox_misc_actions', 'lib_course_type_select' );
add_action( 'save_post', 'save_lib_course_type_select' );

function lib_course_type_select() {
	global $post;
	if (get_post_type($post) == 'course') {
		echo '<div class="misc-pub-section misc-pub-section-last" style="border-top: 1px solid #eee;">';
		wp_nonce_field( 'lib_course_type_select', 'lib_course_type_nonce' );
		$c_type = get_post_meta( $post->ID, 'course_type', true );
		$c_type_arr = array(
			0=>'content',
			1=>'assignment',
			2=>'section',
			3=>'other',
			4=>'manual',
		);
		
		echo 'Course Type: <select id="lib_asmt_course_type" name="lib_asmt_course_type" >';
		foreach($c_type_arr as $cta_key => $cta_val){
			echo '<option value="'.$cta_key.'"';
			if( $cta_key == $c_type ) echo ' selected ';
			echo '>'.ucfirst($cta_val).'</option>';
			
		}	
		echo '</select>';
		echo '</div>';
	}
}
function save_lib_course_type_select($post_id) {

	if (!isset($_POST['post_type']) )
		return $post_id;

	if ( !wp_verify_nonce( $_POST['lib_course_type_nonce'], 'lib_course_type_select' ) )
		return $post_id;

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;

	if ( 'course' == $_POST['post_type'] && !current_user_can( 'edit_course', $post_id ) )
		return $post_id;
	
	if ( !isset( $_POST['lib_asmt_course_type'] ) || !isset( $_POST['lib_course_access'] ) )
		return $post_id;
	else {
		if( isset( $_POST['lib_asmt_course_type'] ) ){
			$ct_data = $_POST['lib_asmt_course_type'];
			update_post_meta( $post_id, 'course_type', $ct_data, get_post_meta( $post_id, 'course_type', true ) );
		}		
	}
}





?>