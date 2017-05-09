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
    $output .= '<p>' . do_shortcode($content) . '</p>';
    $output .= '</div>';

    return $output;

}

add_shortcode("SectionContent", "SectionContent");


/*-- SECTION HERO --*/

function SectionHero( $atts, $content = null ) {

    $output = '';

    $output .= '<div class="slide__hero">';
    $output .= do_shortcode($content);
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



/*---------------------------------------------------------------
	FAQ section
---------------------------------------------------------------*/


/*-- SECTION CONTENT --*/

function FaqSection( $atts, $content = null ) {
    extract(shortcode_atts(array(
        "title" => 'Please Select a Title'
    ), $atts));

    /*-- FAQ Query --*/

    $faq_nav = '';
    $faqs = '';

    $term_args = array(
        'taxonomy' => 'pmk_faq_tax',
        'orderby' => 'term_order'
    );

    $custom_terms = get_terms($term_args);

    foreach($custom_terms as $custom_term) {
        wp_reset_query();
        $query_args = array(
            'post_type' => 'faqs',
            'posts_per_page'    =>   -1,
            'orderby'           =>   'menu_order',
            'order'             =>   'ASC',
            'no_found_rows'     =>   true,
            'tax_query' => array(
                array(
                    'taxonomy' => 'pmk_faq_tax',
                    'field' => 'slug',
                    'terms' => $custom_term->slug,
                ),
            ),
         );

        $faq_posts = new WP_Query($query_args);

        if($faq_posts->have_posts()) {

            /*-- Render FAQ Navigation --*/

            $faq_nav .= '<a class="faq-nav__link scroll-to-link" href="#' . $custom_term->slug . '">';
            $faq_nav .= '<span class="faq-nav__icon"></span>';
            $faq_nav .= '<span class="faq-nav__content">';
            $faq_nav .= '<span class="faq-nav__text">' . $custom_term->name . '</span>';
            if($custom_term->description){
                $faq_nav .= '<span class="faq-nav__description">' . $custom_term->description . '</span>';
            }
            $faq_nav .= '</span>';
            $faq_nav .= '</a>';

            /*-- Render FAQ LIST --*/

            $faqs .= '<div class="slide-faq__group" id="' . $custom_term->slug . '">';
            $faqs .= '<header class="slide-faq__header">';
            $faqs .= '<h2 class="slide-faq__name">' . $custom_term->name . '</h2>';
            $faqs .= '<hr class="hr-gradient">';

            $faqs .= '</header>';
            $faqs .= '<ul class="slide-faq__list">';

            while($faq_posts->have_posts()) : $faq_posts->the_post();

                $faq_item_title = get_the_title();
                $faq_item_slug = get_post_field( 'post_name', get_post());
                $faq_item_content = get_the_content();

                $faqs .= '<li class="slide-faq__list-item" id="' . $faq_item_slug . '">';
                $faqs .= '<h3 class="slide-faq__question">' . $faq_item_title . '</h3>';
                $faqs .= $faq_item_content;
                $faqs .= '</li>';

            endwhile;

            $faqs .= '</ul>';
            $faqs .= '</div>';

        }

    }



    /*-- Render Output --*/

    $output = '';

    /*-- Render FAQ Nav Intro Section --*/

    $output .= '<section class="slide slide-center slide-faq-nav">';
    $output .= '<div class="slide__content">';
    $output .= '<div class="slide__copy">';
    $output .= '<h2>' . $title . '</h2>';
    $output .= '<hr class="hr-gradient">';
    $output .= '<p>' . do_shortcode($content) . '</p>';
    $output .= '</div>';
    $output .= '<div class="faq-nav">';
    $output .= $faq_nav;
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';

    /*-- Render FAQ Section --*/


    $output .= '<section class="slide slide-faq">';
    $output .= '<div class="slide-faq__content">';
    $output .= $faqs;
    $output .= '<div class="slide-faq__conclusion">';
    $output .= '<div class="inner">';
    $output .= 'Didn\'t see your question?';
    $output .= '<a class="button--learn-more">Contact Us</a>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';


    return $output;

}

add_shortcode("FaqSection", "FaqSection");



/*---------------------------------------------------------------
	Contact Block
---------------------------------------------------------------*/


function ContactBlock( $atts, $content = null ) {

    extract(shortcode_atts(array(
        "heading" => 'Please Select a Heading'
    ), $atts));

    $output = '';

    $output = '<div class="contact-block" itemscope itemtype="http://schema.org/ContactPoint">';
    $output .= do_shortcode($content);
    $output .= '</div>';

    return $output;

}

add_shortcode("ContactBlock", "ContactBlock");



function ContactCard( $atts ) {

    extract(shortcode_atts(array(
        "heading" => 'Please Select a Heading',
        "email" => '',
        "phone" => ''
    ), $atts));

    $output = '';

    $output = '<div class="contact-card">';
    $output .= '<h4 class="contact-card__heading" itemprop="contactType">';
    $output .= $heading;
    $output .= '</h4>';
    $output .= '<div class="contact-card__content">';
    $output .= '<span class="contact-card__info"><a itemprop="email" href="mailto:' . $email . '?Subject=I%20Have%20a%20Sales%20Question">' . $email . '</a></span>';
    $output .= '<span class="contact-card__info" itemprop="telephone"><a href="tel+1-' . $phone . '">' . $phone . '</a></span>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;

}

add_shortcode("ContactCard", "ContactCard");



?>
