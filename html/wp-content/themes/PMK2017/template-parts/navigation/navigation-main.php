<?php

/*---------------------------------------------------------------
	SUB NAVIGATION
---------------------------------------------------------------*/

?>

<nav class="main-menu" role="navigation" aria-label="Main Menu">
	<a class="main-menu__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php echo pmk_get_svg( array( 'icon' => 'logo' ) );?>
	</a>
	<?php wp_nav_menu( array(
		'menu_id' => 'main-menu-list',
 		'container'      => false,
		'theme_location' => 'top',
		'walker' => new Main_Menu_Walker
	) ); ?>
</nav>
