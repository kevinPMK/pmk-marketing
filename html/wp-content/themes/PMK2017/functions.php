<?php

/*---------------------------------------------------------------
	GLOBAL FUNCTIONS
---------------------------------------------------------------*/

function remove_image_size_attributes( $html ) {
    return preg_replace( '/(width|height)="\d*"/', '', $html );
}

// Remove image size attributes from post thumbnails
add_filter( 'post_thumbnail_html', 'remove_image_size_attributes' );

// Remove image size attributes from images added to a WordPress post
add_filter( 'image_send_to_editor', 'remove_image_size_attributes' );


/*---------------------------------------------------------------
	MAKE WORDPRESS REQUIRE 4.7+
---------------------------------------------------------------*/

if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}


/*---------------------------------------------------------------
	THEME SETUP
---------------------------------------------------------------*/

function pmk_setup() {

	//Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//Let WordPress handle the page title tag
	add_theme_support( 'title-tag' );

	//Post Thumbnail Support
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'pmk-featured-image', 2000, 1200, true );
	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );

	//Set the default content width.
	$GLOBALS['content_width'] = 525;

	//This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Main Menu', 'pmk' ),
		'sub'    => __( 'Sub Menu', 'pmk' ),
		'footer'    => __( 'Footer Menu', 'pmk' ),
		'social' => __( 'Social Links Menu', 'pmk' ),
	) );

	//Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}

add_action( 'after_setup_theme', 'pmk_setup' );


/*---------------------------------------------------------------
	ADD EXCERPTS TO PAGES
---------------------------------------------------------------*/

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}



/*---------------------------------------------------------------
	PRE CONNECT TO FONTS.COM
---------------------------------------------------------------*/

 function pmk_resource_hints( $urls, $relation_type ) {
 	if ( wp_style_is( 'pmk-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
 		$urls[] = array(
 			'href' => 'https://fast.fonts.net/jsapi/4364cd06-c6c0-44e7-94f3-290ffa52ab9a.js',
 			'crossorigin',
 		);
 	}

 	return $urls;
 }
 add_filter( 'wp_resource_hints', 'pmk_resource_hints', 10, 2 );


 /*---------------------------------------------------------------
 	CHANGE RED MORE ELLIPSIS TO NOT BEING SILLY
 ---------------------------------------------------------------*/

function pmk_excerpt_more( $link ) {
	return '...';
}

add_filter( 'excerpt_more', 'pmk_excerpt_more' );


/*---------------------------------------------------------------
   DETECT JAVASCRIPT
---------------------------------------------------------------*/

function pmk_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'pmk_javascript_detection', 0 );


/*---------------------------------------------------------------
   CREATE PINGBACK LINK
---------------------------------------------------------------*/

function pmk_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'pmk_pingback_header' );


/*---------------------------------------------------------------
   REMOVE P TAGS FROM SHORTCODES
---------------------------------------------------------------*/

function wpex_clean_shortcodes($content){
$array = array (
    '<p>[' => '[',
    ']</p>' => ']',
    ']<br />' => ']'
);
$content = strtr($content, $array);
return $content;
}
add_filter('the_content', 'wpex_clean_shortcodes');



/*---------------------------------------------------------------
   REMOVE P TAGS AROUND IMAGES
---------------------------------------------------------------*/

function filter_ptags_on_images($content){
    return preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


/*---------------------------------------------------------------
   HIGHLIGHT SEARCH TERMS
---------------------------------------------------------------*/

function search_excerpt_highlight() {
    $excerpt = get_the_excerpt();
    $keys = implode('|', explode(' ', get_search_query()));
    $excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $excerpt);

    echo '<p>' . $excerpt . '</p>';
}

function search_title_highlight() {
    $title = get_the_title();
    $keys = implode('|', explode(' ', get_search_query()));
    $title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);

    echo $title;
}



/*---------------------------------------------------------------
   SORT TAXONOMIES BY CREATION ORDER
---------------------------------------------------------------*/

function set_the_terms_in_order ( $terms, $id, $taxonomy ) {
    $terms = wp_cache_get( $id, "{$taxonomy}_relationships_sorted" );
    if ( false === $terms ) {
        $terms = wp_get_object_terms( $id, $taxonomy, array( 'orderby' => 'term_order' ) );
        wp_cache_add($id, $terms, $taxonomy . '_relationships_sorted');
    }
    return $terms;
}
add_filter( 'get_the_terms', 'set_the_terms_in_order' , 10, 4 );

function do_the_terms_in_order () {
    global $wp_taxonomies;  //fixed missing semicolon
    // the following relates to tags, but you can add more lines like this for any taxonomy
    $wp_taxonomies['post_tag']->sort = true;
    $wp_taxonomies['post_tag']->args = array( 'orderby' => 'term_order' );
}
add_action( 'init', 'do_the_terms_in_order');



/*---------------------------------------------------------------
   ADD CLASSES TO PREVIOUS AND NEXT PAGE LINKS
---------------------------------------------------------------*/

add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="button paged-links__next-page"';
}
function posts_link_attributes_2() {
    return 'class="button paged-links__previous-page"';
}


/*---------------------------------------------------------------
   LOAD SVG ICONS
---------------------------------------------------------------*/


/*-- SVG ICONS AND FILTERS --*/
require get_parent_theme_file_path( '/inc/icon-functions.php' );


// REMOVE EMOJI ICONS
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/*---------------------------------------------------------------
   ENQUEUE SCRIPTS AND STYLES
---------------------------------------------------------------*/

function pmk_scripts() {


	//Make skip to content accessable.
	wp_enqueue_script( 'pmk-skip-link-focus-fix', get_theme_file_uri( '/src/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	//Load Waypoints.
	wp_enqueue_script( 'pmk-waypoints', get_theme_file_uri( '/src/js/jquery.waypoints.min.js' ), array( 'jquery' ), '1.0', true );

	//Load jQuery scoll to.
	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/src/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	//Load default twentyseventeen scripts.
	wp_enqueue_script( 'pmk-global', get_theme_file_uri( '/src/js/global.js' ), array( 'jquery' ), '1.0', true );


	//Thread Wordpress Comments
	/*
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	*/

}
add_action( 'wp_enqueue_scripts', 'pmk_scripts' );

/*---------------------------------------------------------------
   ADDITIONAL FUNCTIONS
---------------------------------------------------------------*/


/*-- CUSTOM MENU WALKERS --*/
require get_parent_theme_file_path( '/inc/custom-walkers.php' );

/*-- GLOBAL SHORTCODES --*/
require get_parent_theme_file_path( '/inc/custom-shortcodes.php' );

/*-- GLOBAL METABOXES --*/
require get_parent_theme_file_path( '/inc/post-metaboxes.php' );
require get_parent_theme_file_path( '/inc/page-metaboxes.php' );

/*-- BUILD CUSTOM POST TYPES --*/
require get_parent_theme_file_path( '/inc/press/manifest.php' );
require get_parent_theme_file_path( '/inc/faq/manifest.php' );
require get_parent_theme_file_path( '/inc/customers/manifest.php' );
require get_parent_theme_file_path( '/inc/staff/manifest.php' );
