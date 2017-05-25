<?php

/*---------------------------------------------------------------
	REGISTER POST TYPE -- CUSTOMERS
---------------------------------------------------------------*/


function customer_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Customers', 'Post Type General Name', 'pmk_customers' ),
		'singular_name'       => _x( 'Customer', 'Post Type Singular Name', 'pmk_customers' ),
		'menu_name'           => __( 'Customers', 'pmk_customers' ),
		'all_items'           => __( 'All Customers', 'pmk_customers' ),
		'view_item'           => __( 'View Customer', 'pmk_customers' ),
		'add_new_item'        => __( 'Add New Customer', 'pmk_customers' ),
		'add_new'             => __( 'Add New', 'pmk_customers' ),
		'edit_item'           => __( 'Edit Customer', 'pmk_customers' ),
		'update_item'         => __( 'Update Customer', 'pmk_customers' ),
		'search_items'        => __( 'Search Customers', 'pmk_customers' ),
		'not_found'           => __( 'Not Found', 'pmk_customers' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'pmk_customers' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'customers', 'pmk_customers' ),
		'description'         => __( 'Company Staff Members', 'pmk_customers' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
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
	register_post_type( 'customers', $args );

}

add_action( 'init', 'customer_post_type', 0 );


/*-- Update the Placeholder Text for the Title of the Custom Post Type --*/

function customer_edit_title( $input ) {

    global $post_type;

    if( is_admin() && 'Enter title here' == $input && 'customers' == $post_type )
        return 'Enter the Customer\'s Name';

    return $input;
}

add_filter('gettext','customer_edit_title');


?>
