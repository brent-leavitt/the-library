<?php 

/* 


Short Codes - Class for The Library Plugin
Last Updated on 30 Sep 2019
-------------

  Description: 
	
---

	
	
	
---

Brainstorming: 
		

Shortcode functions are only for short codes. All other functionality needs to be handled elsewhere. 

		
Shortcodes and Templates: 
---------------------------


*/

namespace the_library\init;


// Exit if accessed directly
if ( !defined('ABSPATH')) exit;
	
if( !class_exists( 'ShortCodes' ) ){
	class ShortCodes{
		
		//properties
		
		public $shortcodes =[ '' ];
		

		
		
		
		//Methods
	/*
		Name: __construct
		Description: [CURRRENTLY INACTIVE]
	*/	
	
		public function __construct(){			
				
			//$this->init();
			
		}
		
	/*
		Name: init
		Description: Setting up available shortcode handlers 
	*/	
	
		public function init(){		
		
			//loop through shortcode array and create callback foreach: 
			foreach( $this->shortcodes as $sc )
				add_shortcode( 'lib_'.$sc , array( $this, 'load_'.$sc.'_cb' ) ); 
		
		}
		

	/*
		Name: load_payment_cb
		Description: 
	*/			
		public function load_payment_cb( $atts ){
			
			$atts_arr = shortcode_atts( array(
					'service_id' => '',	//Three Uppercase letter code that represents a company service (ie. BDC = 'birth doula certification')`
					'enrollment' => '', //see enrollment token types for full list of available types
				), $atts );
			
			
			
			return $this->get_payment_form( $atts_arr );	
		}
		

	/*
		Name: load_*_cb//TEMPLATE
		Description: 
	*/			
		public function load___cb( $atts ){
			return 'We are calling the * CB function!!';
			
		}
					

		
		
	}
}

?>