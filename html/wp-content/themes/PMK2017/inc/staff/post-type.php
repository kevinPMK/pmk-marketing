<?php

/*---------------------------------------------------------------
	REGISTER POST TYPE -- STAFF
---------------------------------------------------------------*/


function staff_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Staff', 'Post Type General Name', 'pmk_staff' ),
		'singular_name'       => _x( 'Staff Member', 'Post Type Singular Name', 'pmk_staff' ),
		'menu_name'           => __( 'Staff', 'pmk_staff' ),
		'all_items'           => __( 'All Staff Members', 'pmk_staff' ),
		'view_item'           => __( 'View Staff Member', 'pmk_staff' ),
		'add_new_item'        => __( 'Add New Staff Member', 'pmk_staff' ),
		'add_new'             => __( 'Add New', 'pmk_staff' ),
		'edit_item'           => __( 'Edit Staff Member', 'pmk_staff' ),
		'update_item'         => __( 'Update Staff Member', 'pmk_staff' ),
		'search_items'        => __( 'Search Staff Members', 'pmk_staff' ),
		'not_found'           => __( 'Not Found', 'pmk_staff' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'pmk_staff' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'staff', 'pmk_staff' ),
		'description'         => __( 'Company Staff Members', 'pmk_staff' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'staff', $args );

}


add_action( 'init', 'staff_post_type', 0 );



/*-- Update the Placeholder Text for the Title of the Custom Post Type --*/

function staff_edit_title( $input ) {

    global $post_type;

    if( is_admin() && 'Enter title here' == $input && 'customers' == $post_type )
        return 'Enter the Staff Member\'s Name';

    return $input;
}

add_filter('gettext','staff_edit_title');



?>
