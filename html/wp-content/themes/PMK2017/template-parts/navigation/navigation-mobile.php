<?php

/*---------------------------------------------------------------
	Mobile Menu
---------------------------------------------------------------*/

?>

<nav class="mobile-menu" aria-label="Mobile Menu">
	<div class="inner">
		<?php wp_nav_menu( array(
			'container'      => false,
			'menu_id' => 'mobile-menu-list',
			'theme_location' => 'top',
			'menu_class' => 'mobile-menu__main',
			'walker' => new Main_Menu_Walker
		) ); ?>
		<div class="mobile-menu__sub">
			<?php wp_nav_menu( array(
		 		'container'      => false,
				'theme_location' => 'sub',
				'walker' => new Mobile_Sub_Menu_Walker,
				'items_wrap' => '%3$s'
			) ); ?>
		</div>
	</div>
</nav>
