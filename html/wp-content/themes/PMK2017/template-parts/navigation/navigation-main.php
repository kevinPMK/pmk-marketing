<?php

/*---------------------------------------------------------------
	SUB NAVIGATION
---------------------------------------------------------------*/

?>

<nav class="main-navigation" role="navigation" aria-label="<?php _e( 'Top Menu', 'twentyseventeen' ); ?>">
	<a class="main-navigation__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php echo pmk_get_svg( array( 'icon' => 'logo' ) );?>
	</a>
	<?php wp_nav_menu( array(
 		'container'      => false,
		'theme_location' => 'top',
		'walker' => new Main_Menu_Walker
	) ); ?>
</nav>
