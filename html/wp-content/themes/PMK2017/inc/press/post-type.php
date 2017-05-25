<?php

/*---------------------------------------------------------------
	REGISTER POST TYPE -- PRESS
---------------------------------------------------------------*/


function press_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Press', 'Post Type General Name', 'pmk_press' ),
		'singular_name'       => _x( 'Press Article', 'Post Type Singular Name', 'pmk_press' ),
		'menu_name'           => __( 'Press', 'pmk_press' ),
		'all_items'           => __( 'All Press Articles', 'pmk_press' ),
		'view_item'           => __( 'View Press Article', 'pmk_press' ),
		'add_new_item'        => __( 'Add New Press Article', 'pmk_press' ),
		'add_new'             => __( 'Add New', 'pmk_press' ),
		'edit_item'           => __( 'Edit Press Article', 'pmk_press' ),
		'update_item'         => __( 'Update Press Article', 'pmk_press' ),
		'search_items'        => __( 'Search Press Articles', 'pmk_press' ),
		'not_found'           => __( 'Not Found', 'pmk_press' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'pmk_press' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'press', 'pmk_press' ),
		'description'         => __( 'PikMyKid in the Press', 'pmk_press' ),
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
	register_post_type( 'press', $args );

}

add_action( 'init', 'press_post_type', 0 );


?>
