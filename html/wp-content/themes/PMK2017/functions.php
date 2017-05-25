<?php

/*---------------------------------------------------------------
	GLOBAL FUNCTIONS
---------------------------------------------------------------*/




/*-- THEME REQUIRES WORDPRESS 4.7+ --*/

if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}


/*-- THEME SETUP --*/

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

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( pmk_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'template_redirect', 'twentyseventeen_content_width', 0 );



/*-- ADD EXCERPTS TO PAGES --*/

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}



/*-- PRE CONNECT TO FONTS.COM --*/

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


/*-- REGISTER WIDGET AREAS --*/

function twentyseventeen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentyseventeen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/*-- EXCERPT UPDATE - Replace [...] with a read more link --*/

function pmk_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pmk' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}

add_filter( 'excerpt_more', 'pmk_excerpt_more' );


/*-- JAVASCRIPT DETECTION --*/

function pmk_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'pmk_javascript_detection', 0 );


/*-- SINGLE PINGBACK LINK --*/

function pmk_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'pmk_pingback_header' );


/*-- ENQUEUE SCRIPTS AND STYLES --*/

function pmk_scripts() {

	//Add custom fonts, used in the main stylesheet.
	wp_enqueue_script('pmk-fonts', '//fast.fonts.net/jsapi/4364cd06-c6c0-44e7-94f3-290ffa52ab9a.js', array(), '1.0', true );

	//Theme stylesheet.
	wp_enqueue_style( 'pmk-style', get_theme_file_uri( '/src/main.css' ) );


	/*-- IE9 SUPPORT:

	if ( is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '1.0' );
		wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
	}

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	--*/

	//Make skip to content accessable.
	wp_enqueue_script( 'pmk-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	//Load Waypoints.
	wp_enqueue_script( 'pmk-waypoints', get_theme_file_uri( '/src/js/jquery.waypoints.min.js' ), array( 'jquery' ), '1.0', true );

	//Introduce Google Parallax
	wp_enqueue_script( 'pmk-parallax', get_theme_file_uri( '/src/js/parallax.js' ), array(), '1.0', true );

	//Load default twentyseventeen scripts.
	wp_enqueue_script( 'pmk-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	//Load jQuery scoll to.
	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	//Thread Wordpress Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'pmk_scripts' );


/*-- Remove P tags from happening in and around shortcodes --*/

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



/*-- Remove P tags from around images --*/

function filter_ptags_on_images($content){
    return preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


// Stringify the Thumbnail Source
function get_the_post_thumbnail_src($img)
{
  return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}


/*-- ADD CUSTOM IMAGE SIZES FOR CONTENT IMAGES

function twentyseventeen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2 );

--*/

/*-- ADD CUSTOM IMAGE SIZES FOR POST THUMBNAILS

function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

 --*/


/*-- Highlight Search Terms --*/

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

/*-- Remove Readmore Links --*/

function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

// customize read more link
add_filter('the_excerpt', 'pmk_custom_readmore');
function pmk_custom_readmore($output) {
	$markup = substr($output,0,-5);
	$markup .= '</p>';
	return $markup;
}

/*-- USE FRONT-PAGE.PHP WHEN FRONT PAGE DISPLAY IS SET TO A STATIC PAGE --*/

function twentyseventeen_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'twentyseventeen_front_page_template' );



/*-- Add classes to previous and next posts --*/

add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="button paged-links__next-page"';
}
function posts_link_attributes_2() {
    return 'class="button paged-links__previous-page"';
}

/**
 * Sort Taxonomies by creation order.
 */

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

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Custom Walkers
 */
require get_parent_theme_file_path( '/inc/custom-walkers.php' );

/**
 * Custom Shortcodes
 */
require get_parent_theme_file_path( '/inc/custom-shortcodes.php' );

/*-- Default Post Metaboxes --*/
require get_parent_theme_file_path( '/inc/post-metaboxes.php' );


/*-- Custom Post Types --*/

require get_parent_theme_file_path( '/inc/press/manifest.php' );
require get_parent_theme_file_path( '/inc/faq/manifest.php' );
require get_parent_theme_file_path( '/inc/customers/manifest.php' );
require get_parent_theme_file_path( '/inc/staff/manifest.php' );
