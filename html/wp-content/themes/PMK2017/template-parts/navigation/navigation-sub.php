<?php

/*---------------------------------------------------------------
	SUB NAVIGATION
---------------------------------------------------------------*/

?>

<nav class="sub-menu" role="navigation" aria-label="Sub Menu">

	<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="sub-menu__text-link">
		Blog
	</a>

	<?php if ( get_page_by_path( 'free-car-line' ) != NULL ): ?>
		<a class="sub-menu__text-link" target="_blank" href="<?php echo get_permalink( get_page_by_path( 'free-car-line' ) ); ?>">
			Free Car Line
		</a>
	<?php endif; ?>

	<a href="https://schools.pikmykid.com/pikmykid/" target="_blank" class="sub-menu__text-link">
		Sign In
	</a>

	<div class="sub-menu__search-wrap">
		<button type="button" class="sub-menu__search-toggle">
			<?php echo pmk_get_svg( array( 'icon' => '24-search-icon', 'size' => '24' ) );?>
		</button>
		<button tabindex="-1" type="button" class="sub-menu__search-close">
			<div class="bar bar1"></div>
			<div class="bar bar2"></div>
		</button>
		<form role="search" method="get" class="sub-menu__search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label for="sub-header-search">
				<span class="screen-reader-text">Search for:</span>
			</label>
			<input tabindex="-1" type="search" id="sub-header-search" class="sub-menu__search-field" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" />
		</form>
	</div>

</nav><!-- #site-navigation -->
