<?php

/*---------------------------------------------------------------
	CUSTOM WALKERS
---------------------------------------------------------------*/


/*-- MAIN MENU WALKER --*/

class Main_Menu_Walker extends Walker {

    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : array();
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<li' . $id . $value . $class_names .'>';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function end_el(&$output, $object, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }

}

/*-- SUB MENU WALKER --*/

class Sub_Menu_Walker extends Walker_Nav_Menu{

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){

    	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    	$class_names = $value = '';

    	$classes = empty( $item->classes ) ? array() : (array) $item->classes;

    	$classes[] = 'menu-item-' . $item->ID;

		$classOutput = 'sub-menu__item';
		if(in_array('current-menu-item', $classes)){
			$classOutput .= ' sub-menu__item--current';
		}
		$classOutput = ' class="' . $classOutput . '"';

    	$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    	$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    	$atts = array();
    	$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
    	$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
    	$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
    	$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

    	$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

    	$attributes = '';
	    foreach ( $atts as $attr => $value ) {
	        if ( ! empty( $value ) ) {
	            $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
	            $attributes .= ' ' . $attr . '="' . $value . '"';
	        }
	    }

	    $item_output = $args->before;
	    $item_output .= '<a'. $attributes .$classOutput.'>';
	    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
	    $item_output .= '</a>';
	    $item_output .= $args->after;

	    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
	    $output .= "\n";
	}
}

?>
