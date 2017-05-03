<?php

/*---------------------------------------------------------------
	CUSTOM POST TYPES
---------------------------------------------------------------*/

/*-- Custon Taxonomy --*/

if ( ! function_exists( 'pmk_faq_tax' ) ) {

    // register custom taxonomy
    function pmk_faq_tax() {

        // again, labels for the admin panel
        $labels = array(
            'name'                       => _x( 'FAQ Categories', 'Taxonomy General Name', 'pmk_faqs' ),
            'singular_name'              => _x( 'FAQ Category', 'Taxonomy Singular Name', 'pmk_faqs' ),
            'menu_name'                  => __( 'FAQ Categories', 'pmk_faqs' ),
            'all_items'                  => __( 'All FAQ Categories', 'pmk_faqs' ),
            'parent_item'                => __( 'Parent FAQ Category', 'pmk_faqs' ),
            'parent_item_colon'          => __( 'Parent FAQ Category:', 'pmk_faqs' ),
            'new_item_name'              => __( 'New FAQ Category', 'pmk_faqs' ),
            'add_new_item'               => __( 'Add New FAQ Category', 'pmk_faqs' ),
            'edit_item'                  => __( 'Edit FAQ Category', 'pmk_faqs' ),
            'update_item'                => __( 'Update FAQ Category', 'pmk_faqs' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'pmk_faqs' ),
            'search_items'               => __( 'Search Items', 'pmk_faqs' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'pmk_faqs' ),
            'choose_from_most_used'      => __( 'Choose from the most used items', 'pmk_faqs' ),
            'not_found'                  => __( 'Not Found', 'pmk_faqs' ),

        );
        $args = array(
            // use the labels above
            'labels'                     => $labels,
            // taxonomy should be hierarchial so we can display it like a category section
            'hierarchical'               => true,
            // again, make the taxonomy public (like the post type)
            'public'                     => true,
            'meta_box_cb'                => 'post_categories_meta_box'
        );
        // the contents of the array below specifies which post types should the taxonomy be linked to
        register_taxonomy( 'pmk_faq_tax', array( 'pmk_faqs' ), $args );

    }

    // hook into the 'init' action
    add_action( 'init', 'pmk_faq_tax', 0 );

}


/*
* Creating a function to create our CPT
*/

function custom_post_type() {

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

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type', 0 );


?>
