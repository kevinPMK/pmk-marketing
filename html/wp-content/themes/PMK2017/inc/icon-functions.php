<?php

/*---------------------------------------------------------------
	SVG ICON FUNCTIONS AND FILTERS
---------------------------------------------------------------*/



/*-- RETURN SVG MARKUP --*/

/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $size  Optional SVG icon size.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */

function pmk_get_svg( $args = array() ) {

	//Make sure $args are an array.
	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'pmk' );
	}

	//Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return __( 'Please define an SVG icon filename.', 'pmk' );
	}

	//Set defaults.
	$defaults = array(
		'icon'        => '',
		'size'		  => '',
		'title'       => '',
		'desc'        => '',
		'fallback'    => false,
	);

	//Parse args.
	$args = wp_parse_args( $args, $defaults );

	//Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';

	//Set ARIA.
	$aria_labelledby = '';

	//Set Title and Description
	if ( $args['title'] ) {
		$aria_hidden     = '';
		$unique_id       = uniqid();
		$aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

		if ( $args['desc'] ) {
			$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
		}
	}

	//Begin SVG markup.
	$svgClass = 'icon icon-' . esc_attr( $args['icon'] );

	if ( $args['size'] ) {
		$svgClass .= ' icon--' . esc_attr( $args['size'] );
	}

	$svg = '<svg class="' . $svgClass . '" ' . $aria_hidden . $aria_labelledby . ' role="img">';

	//Display the title.
	if ( $args['title'] ) {
		$svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

		//Display the desc only if the title is already set.
		if ( $args['desc'] ) {
			$svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
		}
	}

	//Render Icon
	$svg .= ' <use href="#svg-icon-' . esc_html( $args['icon'] ) . '" xlink:href="#svg-icon-' . esc_html( $args['icon'] ) . '"></use> ';

	//Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
	}

	$svg .= "</svg>\n";

	return $svg;

}
