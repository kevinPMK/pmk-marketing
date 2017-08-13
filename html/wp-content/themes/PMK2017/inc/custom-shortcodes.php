<?php

/*---------------------------------------------------------------
	SHORTCODES
---------------------------------------------------------------*/

/*-- SECTION SHORTCODE --*/

function section( $atts, $content = null ) {
    extract(shortcode_atts(array(
        "type" => 'default',
        "direction" => '',
        "theme" => ''
    ), $atts));

    $output = '';

    if($type == 'default'){

        if($theme == 'grad'){
            $output .= '<section class="slide slide-center slide--grad">';
        }else if($theme == 'negative'){
            $output .= '<section class="slide slide-center slide--negative">';
        }else{
            $output .= '<section class="slide slide-center">';
        }
        $output .= '<div class="slide__content">';
        $output .= do_shortcode($content);
        $output .= '</div>';
        $output .= '</section>';

    }else if($type == 'half') {

        $classes="slide slide-half";


        if($theme == 'grad'){
            $classes .= ' slide--grad';
        }else if($theme == 'negative'){
            $classes .= ' slide--negative';
        }else if($theme == 'vanilla'){
            $classes .= ' slide--vanilla';
        }

        if($direction == 'reverse'){
            $classes .= ' slide--reverse';
        }

        $output .= '<section class="' . $classes . '">';
            $output .= '<div class="slide__content">';
            $output .= do_shortcode($content);
            $output .= '</div>';
        $output .= '</section>';

    }else if($type == 'mini') {

        $output .= '<section class="slide slide-mini type-mini">';
        $output .= '<div class="slide-mini__sfx-squiggle" aria-hidden="true"></div>';
        $output .= '<div class="slide-mini__sfx-circle-grad" aria-hidden="true"></div>';
        $output .= '<div class="slide-mini__grid">';
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
        "title" => 'Please Select a Title',
        "subtitle" => '',
        "divider" => 'true',
        "learnmoreurl" => '',
        "alignment" => 'center'
    ), $atts));

    $output = '';

    if( $alignment == "left" ){
        $output .= '<div class="slide__copy slide__copy--left typography">';
    }else{
        $output .= '<div class="slide__copy typography">';
    }

    if( !empty($subtitle) ){
        $output .= '<h6>' . $subtitle . '</h6>';
    }

    $output .= '<h2>' . $title . '</h2>';

    if( $divider == 'true' ){
        $output .= '<hr class="hr-gradient">';
    }

    $output .= '<p>' . do_shortcode($content) . '</p>';

    if( !empty($learnmoreurl)){
        $output .= '<a class="button button--primary" href=' . $learnmoreurl . '>Learn More</a>';
    }

    $output .= '</div>';

    return $output;

}

add_shortcode("SectionContent", "SectionContent");


/*-- SECTION HERO --*/

function SectionHero( $atts, $content = null ) {

    extract(shortcode_atts(array(
        "class" => '',
    ), $atts));

    $classOutput = 'slide__hero';
    if($class){
        $classOutput .= ' ' . $class;
    }

    $output = '';
    $output .= '<div class="' . $classOutput . '">';
    $output .= do_shortcode($content);
    $output .= '</div>';

    return $output;

}

add_shortcode("SectionHero", "SectionHero");


/*-- SECTION MINI HALF --*/

function SectionMiniHalf( $atts, $content = null ) {

    extract(shortcode_atts(array(
        "title" => 'Please Select a Title',
        "icon" => 'heart'
    ), $atts));

    $output = '<div class="slide-mini__card">';
    $output .= '<div class="slide-mini__thumb">';
    $output .= '<amp-img class="slide-mini__thumb-img" width="160" height="160" layout="responsive" src="' . get_bloginfo('template_directory') . '/src/images/split-section-' . $icon . '.svg"></amp-img>';
    $output .= '</div>';
    $output .= '<div class="slide-mini__content typography">';
    $output .= '<h4>' . $title . '</h4>';
    $output .= '<p>' . do_shortcode($content) . '</p>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;

}

add_shortcode("SectionMiniHalf", "SectionMiniHalf");


/*-- SECTION Quote --*/

function SectionQuote( $atts, $content = null ) {

    extract(shortcode_atts(array(
        "author" => 'Please Select an Author',
        "profession" => 'Please Select a Profession'
    ), $atts));

    $output = '';

    $output .= '<section class="slide slide-quote">';
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
    $output .= '</section>';

    return $output;

}

add_shortcode("SectionQuote", "SectionQuote");



/*-- Template Intro --*/

function TemplateIntro( $atts, $content = 'null' ) {

    extract(shortcode_atts(array(
        "title" => 'Please Select a Title'
    ), $atts));

    $output = '<div class="slide__copy">';
    $output .= '<h2>' . $title . '</h2>';
    $output .= '<hr class="hr-gradient" />';
    $output .= '<p>' . do_shortcode($content) . '</p>';
    $output .= '</div>';

    return $output;

}

add_shortcode("TemplateIntro", "TemplateIntro");



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
            $faq_nav .= '<amp-img width="192" height="192" layout="responsive" class="faq-nav__icon" src="' . get_bloginfo('template_directory') . '/src/images/faq--' . $custom_term->slug . '.svg"></amp-img>';
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
                $faqs .= wpautop($faq_item_content);
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
    $output .= '<div class="slide__copy typography">';
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
    $output .= '<a class="button" href="' . get_permalink( get_page_by_path( 'contact' ) ) . '">Contact Us</a>';
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


/*---------------------------------------------------------------
	Slide Image Grid
---------------------------------------------------------------*/


function SlideImageGrid( $atts ) {

    extract(shortcode_atts(array(
    ), $atts));

    $output = '';

    $output = '<div class="slide__image-grid">';
    $output .= '<div class="slide__image-grid-cell slide__image-grid-cell--half">';
    $output .= '<div class="inner"></div>';
    $output .= '</div>';
    $output .= '<div class="slide__image-grid-cell slide__image-grid-cell--half">';
    $output .= '<div class="inner"></div>';
    $output .= '</div>';
    $output .= '<div class="slide__image-grid-cell slide__image-grid-cell--full">';
    $output .= '<div class="inner"></div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;

}

add_shortcode("SlideImageGrid", "SlideImageGrid");


/*---------------------------------------------------------------
	Slide Image Grid
---------------------------------------------------------------*/


function SectionGroup( $atts, $content = null ) {

    $output = '<div class="slide__group">';
    $output .= do_shortcode($content);
    $output .= '</div>';

    return $output;

}

add_shortcode("SectionGroup", "SectionGroup");



/*---------------------------------------------------------------
	Slide Image Grid
---------------------------------------------------------------*/


function SlideFullImage( $atts, $content = null ) {

    extract(shortcode_atts(array(
    ), $atts));

    $output = '';

    $output = '<div class="slide__full-image">';
    $output .= do_shortcode($content);
    $output .= '</div>';

    return $output;

}

add_shortcode("SlideFullImage", "SlideFullImage");

/*---------------------------------------------------------------
	Half Mini Section
---------------------------------------------------------------*/


function HalfMiniSection( $atts ) {

    extract(shortcode_atts(array(
    ), $atts));

    $output = '';

    $output = '<div class="slide__image-grid">';
    $output .= '<div class="slide__image-grid-cell slide__image-grid-cell--half">';
    $output .= '<div class="inner"></div>';
    $output .= '</div>';
    $output .= '<div class="slide__image-grid-cell slide__image-grid-cell--half">';
    $output .= '<div class="inner"></div>';
    $output .= '</div>';
    $output .= '<div class="slide__image-grid-cell slide__image-grid-cell--full">';
    $output .= '<div class="inner"></div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;

}

add_shortcode("SlideImageGrid", "SlideImageGrid");



/*---------------------------------------------------------------
	Customer Shortcode
---------------------------------------------------------------*/


function Customers( $atts ) {

    extract(shortcode_atts(array(
        "total" => -1,
        "home" => 'false',
        "viewfullurl" => ''
    ), $atts));

    if($home == 'true'){
        $args = array(
            'post_type' => 'customers',
            'posts_per_page' => $total,
            'meta_key'   => 'display_on_front_page',
            'meta_value' => 'on'
        );
    }else{
        $args = array(
            'post_type' => 'customers',
            'posts_per_page' => $total
        );
    }

    $loop = new WP_Query( $args );

    $output = '';
    $output = '<div class="logo-grid">';

    while ( $loop->have_posts() ) : $loop->the_post();

        $customerUrl = get_post_meta(get_the_ID(), 'customer_url')[0];
        $thumb = '<amp-img class="logo-grid__logo-img" width="150" height="150" layout="responsive" src=" ' . get_the_post_thumbnail_url() . '"></amp-img>';
        $output .= '<div class="logo-grid__cell">';
        if(!empty($customerUrl)){
            $output .= '<a class="inner" title="' . get_the_title() . '" href="' . $customerUrl . '" target="_blank">';
            $output .= $thumb;
            $output .= '</a>';
        }else{
            $output .= '<div class="inner">';
            $output .= $thumb;
            $output .= '</div>';
        }
        $output .= '</div>';

    endwhile;


    $output .= '</div>';
    if(!empty($viewfullurl)){
        $output .= '<a href="' . $viewfullurl . '" class="button centered-view-more">View Our Partners</a>';
    }

    return $output;

}

add_shortcode("Customers", "Customers");



/*---------------------------------------------------------------
	Press Shortcode
---------------------------------------------------------------*/


function Press( $atts ) {

    extract(shortcode_atts(array(
        "total" => -1,
        "home" => 'false',
        "viewfullurl" => ''
    ), $atts));

    if($home == 'true'){
        $args = array(
            'post_type' => 'press',
            'posts_per_page' => $total,
            'meta_key'   => 'display_on_front_page',
            'meta_value' => 'on'
        );
    }else{
        $args = array(
            'post_type' => 'press',
            'posts_per_page' => $total
        );
    }

    $loop = new WP_Query( $args );

    $output = '';

    $output = '<div class="logo-grid">';

    while ( $loop->have_posts() ) : $loop->the_post();

        $pressUrl = get_post_meta(get_the_ID(), 'press_url')[0];
        $pressSyndicate = get_post_meta(get_the_ID(), 'press_syndicate')[0];

        $output .= '<div class="logo-grid__cell">';
        $thumb = '<amp-img class="logo-grid__logo-img" width="150" height="150" layout="responsive" src=" ' . get_the_post_thumbnail_url() . '"></amp-img>';
        if(!empty($pressUrl)){
            $output .= '<a class="inner" title="'. $pressSyndicate . ' - ' . get_the_title() . '" href="' . $pressUrl . '" target="_blank">';
            $output .= $thumb;
            $output .= '</a>';
        }else{
            $output .= '<div class="inner">';
            $output .= $thumb;
            $output .= '</div>';
        }
        $output .= '</div>';

    endwhile;

    $output .= '</div>';
    if(!empty($viewfullurl)){
        $output .= '<a href="' . $viewfullurl . '" class="button centered-view-more">View More Press Articles</a>';
    }

    return $output;

}

add_shortcode("Press", "Press");


/*---------------------------------------------------------------
	TEAM LIST SHORT CODE
---------------------------------------------------------------*/

function TeamList( $atts ) {

    extract(shortcode_atts(array(
        "total" => -1
    ), $atts));

    $args = array(
        'post_type' => 'staff',
        'posts_per_page' => $total,
        'meta_key'   => 'display_on_front_page',
        'meta_value' => 'on',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );

    $loop = new WP_Query( $args );

    $output = '<section class="slide team-list">';
    $output .= '<div class="inner">';

    while ( $loop->have_posts() ) : $loop->the_post();


        $author_title = get_post_meta( get_the_ID(), 'staff_title' )[0];

        $output .= '<div class="team-card">';
        $output .= '<div class="inner">';
        $output .= '<div class="team-card__thumb">';
        $output .= get_the_post_thumbnail();
        $output .= '</div>';
        $output .= '<div class="team-card__content">';
        $output .= '<div class="inner">';
        $output .= '<div class="team-card__name">';
        $output .= get_the_title();
        $output .= '</div>';
        if(!empty($author_title)){
            $output .= '<div class="team-card__title">';
            $output .= $author_title;
            $output .= '</div>';
        }
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="team-card__description">';
        $output .= get_the_content();
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

    endwhile;

    $output .= '</div>';
    $output .= '</section>';

    return $output;

}

add_shortcode("TeamList", "TeamList");


/*---------------------------------------------------------------
	Responsive Video Shortcode
---------------------------------------------------------------*/


function Video( $atts ) {

    extract(shortcode_atts(array(
        "url" => "Please Enter a URL"
    ), $atts));

    $output = '<div class="video video-responsive">';
    $output .= '<iframe src="' . $url . '" frameborder="0" allowfullscreen="allowfullscreen"></iframe>';
    $output .= '</div>';

    return $output;

}

add_shortcode("Video", "Video");


/*---------------------------------------------------------------
	Parent Navigation Shortcode
---------------------------------------------------------------*/


function FeatureNavigation() {

    global $post;

	if ( $post->post_parent ) :

    $currentID = get_the_ID();

    $output = '<section class="slide slide-next-features">';
    $output .= '<div class="slide__content">';

    $args = array(
        'post_parent' => $post->post_parent,
        'post_type' => 'page',
        'orderby' => 'menu_order'
    );
    $child_query = new WP_Query( $args );

    while ( $child_query->have_posts() ) : $child_query->the_post();

        global $post;

        if($currentID == get_the_ID()){
            $output .= '<div class="slide-next-features__block slide-next-features__block--current">';
            $output .= '<div class="inner">';
        }else{
            $output .= '<div class="slide-next-features__block">';
            $output .= '<a class="inner" href="' . get_the_permalink() . '">';
        }

        $output .= '<div>';
        $output .= '<div class="slide-next-features__icon svg-icon-'. $post_slug=$post->post_name .'">';
        $output .= '</div>';
        $output .= '<h4>' . get_the_title() . '</h4>';
        $output .= '</div>';

        if($currentID == get_the_ID()){
            $output .= '</div>';
            $output .= '</div>';
        }else{
            $output .= '</div>';
            $output .= '</a>';
        }

        endwhile;

        $output .= '</section>';
        $output .= '</div>';

        return $output;

    endif;

}

add_shortcode("FeatureNavigation", "FeatureNavigation");



/*---------------------------------------------------------------
    Intro SVG Section
---------------------------------------------------------------*/



function InsertSvgScene( $atts ) {

    extract(shortcode_atts(array(
        "scene" => "Please Enter a URL"
    ), $atts));

    $url = get_bloginfo('template_directory') . '/src/images/';
    $output = '';

    if($scene == 'triple-threat') {
        $output .= '<div class="triple-scene">';
            $output .= '<amp-img width="616" height="905.88" layout="responsive" class="triple-scene--1" src="' . $url . 'scene-home-intro-1.svg"></amp-img>';
            $output .= '<amp-img width="616" height="905.88" layout="responsive" class="triple-scene--2" src="' . $url . 'scene-home-intro-2.svg"></amp-img>';
            $output .= '<amp-img width="616" height="905.88" layout="responsive" class="triple-scene--3" src="' . $url . 'scene-home-intro-3.svg"></amp-img>';
        $output .= '</div>';
    }else if($scene = 'intro-devices'){
        $output .= '<div class="slide__full-image slide__full-image--no-shadow">';
            $output .= '<amp-img width="1216" height="811" layout="responsive" class="slide__fill-image-img" alt="Elements of the PikMyKid Safety Platform" src="' . $url . 'pmk-safety-platform.svg"></amp-img>';
        $output .= '</div>';
    }else{
        return;
    }

    return $output;

}

add_shortcode("InsertSvgScene", "InsertSvgScene");




?>
