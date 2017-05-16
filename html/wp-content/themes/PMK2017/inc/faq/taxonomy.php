<?php

/*---------------------------------------------------------------
	TAXONOMY -- FAQ
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

?>
