<?php

	/*---------------------------------------------------------------
		Search Hero
	---------------------------------------------------------------*/

?>

<div class="sub-page-hero hero" data-parallax="true" data-speed="0.1" data-direction="up">
	<!-- TODO add search images -->
	<?php
			$default_source = get_bloginfo('template_directory') . '/src/images/';
			$output = '';
			$output .= '<img class="wp-post-image" src="' . $default_source . 'default-sub-page-image.png"';
			$output .= 'srcset="';
			$output .= $default_source . 'default-sub-page-image--full.png 2000w, ';
			$output .= $default_source . 'default-sub-page-image--1024x614.png 1024w, ';
			$output .= $default_source . 'default-sub-page-image--768x461.png 768w, ';
			$output .= $default_source . 'default-sub-page-image--320x192.png 320w"';
			$output .= 'sizes="(max-width: 2000px) 100vw, 2000px"';
			$output .= '>';
			echo($output);
	?>
	<div class="sub-page-hero__haze"></div>
	<div class="sub-page-hero__gradient"></div>
	<div class="sub-page-hero__content" data-parallax="true" data-speed="0.2" data-direction="up">
		<form role="search" method="get" class="hero-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label for="hero-search-input">
				You Searched for:
			</label>
			<input type="search" id="hero-search-input" class="hero-search__field" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" />
			<button type="submit" class="hero-search__submit"><span class="screen-reader-text">Search</span>
				<?php echo pmk_get_svg( array( 'icon' => '40-search', 'size' => '40' ) );?></button>
		</form>
	</div>
</div>

<?php ?>
