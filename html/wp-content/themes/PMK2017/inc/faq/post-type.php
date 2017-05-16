<?php

/*---------------------------------------------------------------
	REGISTER POST TYPE -- FAQ
---------------------------------------------------------------*/


function faq_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'FAQs', 'Post Type General Name', 'pmk_faq' ),
		'singular_name'       => _x( 'FAQ', 'Post Type Singular Name', 'pmk_faq' ),
		'menu_name'           => __( 'FAQs', 'pmk_faq' ),
		'all_items'           => __( 'All FAQs', 'pmk_faq' ),
		'view_item'           => __( 'View FAQ', 'pmk_faq' ),
		'add_new_item'        => __( 'Add New FAQ', 'pmk_faq' ),
		'add_new'             => __( 'Add New', 'pmk_faq' ),
		'edit_item'           => __( 'Edit FAQ', 'pmk_faq' ),
		'update_item'         => __( 'Update FAQ', 'pmk_faq' ),
		'search_items'        => __( 'Search FAQ', 'pmk_faq' ),
		'not_found'           => __( 'Not Found', 'pmk_faq' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'pmk_faq' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'faqs', 'pmk_faq' ),
		'description'         => __( 'Frequently asked questions', 'pmk_faq' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'page-attributes' ),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'pmk_faq_tax' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'faqs', $args );

}

add_action( 'init', 'faq_post_type', 0 );


/*-- Update the Placeholder Text for the Title of the Custom Post Type --*/

function faq_edit_title( $input ) {

    global $post_type;

    if( is_admin() && 'Enter title here' == $input && 'customers' == $post_type )
        return 'Enter the Frequently Asked Question';

    return $input;
}

add_filter('gettext','faq_edit_title');


?>
