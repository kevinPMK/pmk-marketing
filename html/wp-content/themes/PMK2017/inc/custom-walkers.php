<?php

/*---------------------------------------------------------------
	CUSTOM WALKERS
---------------------------------------------------------------*/

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
