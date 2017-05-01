<?php

/*---------------------------------------------------------------
	SUB NAVIGATION
---------------------------------------------------------------*/

?>

<nav class="sub-menu" role="navigation" aria-label="Sub Menu">

	<?php wp_nav_menu( array(
 		'container'      => false,
		'theme_location' => 'sub',
		'walker' => new Sub_Menu_Walker,
		'items_wrap' => '%3$s'
	) ); ?>

</nav><!-- #site-navigation -->
