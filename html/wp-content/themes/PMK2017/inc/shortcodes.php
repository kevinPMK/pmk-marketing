<?php

/*---------------------------------------------------------------
	SHORTCODES
---------------------------------------------------------------*/

/*-- SECTION SHORTCODE --*/

function section( $atts, $content = null ) {
    extract(shortcode_atts(array(
        "type" => 'default'
    ), $atts));

    $output = '';

    if($type == 'default'){

        $output .= '<section class="slide slide-center">';
        $output .= '<div class="slide__content">';
        $output .= do_shortcode($content);
        $output .= '</div>';
        $output .= '</section>';

    }else if($type == 'half') {

        $output .= '<section class="slide slide-half">';
        $output .= '<div class="slide__content">';
        $output .= do_shortcode($content);
        $output .= '</div>';
        $output .= '</section>';

    }else if($type == 'quote') {

        $output .= '<section class="slide slide-quote">';
        $output .= '<div class="slide__content">';
        $output .= do_shortcode($content);
        $output .= '</div>';
        $output .= '</section>';

    }

    return $output;

}

add_shortcode("Section", "Section");


/*-- SECTION CONTENT --*/

function SectionContent( $atts, $content = null ) {
    extract(shortcode_atts(array(
        "title" => 'Please Select a Title'
    ), $atts));

    $output = '';

    $output .= '<div class="slide__copy">';
    $output .= '<h2>' . $title . '</h2>';
    $output .= '<hr class="hr-gradient">';
    $output .= '<p>' . $content . '</p>';
    $output .= '</div>';

    return $output;

}

add_shortcode("SectionContent", "SectionContent");


/*-- SECTION HERO --*/

function SectionHero( $atts, $content = null ) {

    $output = '';

    $output .= '<div class="slide__hero">';
    $output .= '<div class="test-div">' . $content . '</div>';
    $output .= '</div>';

    return $output;

}

add_shortcode("SectionHero", "SectionHero");


/*-- SECTION Quote --*/

function SectionQuote( $atts, $content = null ) {

    extract(shortcode_atts(array(
        "author" => 'Please Select an Author',
        "profession" => 'Please Select a Profession'
    ), $atts));

    $output = '';

    $output .= '<div class="slide__content">';
    $output .= '<figure>';
    $output .= '<blockquote>';
    $output .= '<p>';
    $output .= '<svg class="icon icon-40-lquote icon--40" aria-hidden="true" role="img">';
    $output .= '<use href="#svg-icon-40-lquote" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-40-lquote"></use>';
    $output .= '</svg>';
    $output .= '<span>' . do_shortcode($content) . "</span>";
    $output .= '<svg class="icon icon-40-rquote icon--40" aria-hidden="true" role="img">';
    $output .= '<use href="#svg-icon-40-rquote" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-40-rquote"></use>';
    $output .= '</svg>';
    $output .= '</p>';
    $output .= '</blockquote>';
    $output .= '<hr>';
    $output .= '<footer>';
    $output .= '— <cite class="author">' . $author . '</cite>, <cite class="company">' . $profession . '</cite>';
    $output .= '</footer>';
    $output .= '</figure>';
    $output .= '</div>';

    return $output;

}

add_shortcode("SectionQuote", "SectionQuote");


?>
