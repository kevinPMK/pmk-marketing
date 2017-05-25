<?php

	/*---------------------------------------------------------------
		Search Hero
	---------------------------------------------------------------*/

?>

<div class="sub-page-hero" data-parallax="true" data-speed="0.1" data-direction="up">
	<!-- TODO add search images -->
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
