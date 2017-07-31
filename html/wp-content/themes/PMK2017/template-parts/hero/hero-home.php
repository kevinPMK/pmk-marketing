<?php

	/*---------------------------------------------------------------
		HOME PAGE HERO
	---------------------------------------------------------------*/

?>


<section class="home-hero" data-parallax="true" data-speed="-0.6" data-direction="up">
	<img src="<?php echo get_bloginfo('template_directory'); ?>/src/images/school-home-hero.svg">
	<div class="home-hero__haze"></div>
	<div class="home-hero__gradient"></div>
	<div class="home-hero__content" data-parallax="true" data-speed="0.2" data-direction="up">
		<h1 class="home-hero__heading">
			<span class="home-hero__sub-heading">The Comprehensive</span>
			<span class="home-hero__main-heading">School Safety Platform</span>
		</h1>
		<div class="cta-buttons">
			<a id="watch-video-button" href="https://www.youtube.com/watch?v=0h1cmiiP6VM" class="cta-button cta-button--secondary" href="#">
				Watch Video
				<?php echo pmk_get_svg( array( 'icon' => '32-play', 'size' => '32' ) );?>
			</a>
			<a class="cta-button cta-button--primary" href="<?php echo get_permalink( get_page_by_path( 'request-a-demo' ) ); ?>">
				Request Demo
				<?php echo pmk_get_svg( array( 'icon' => '32-rarrow', 'size' => '32' ) );?>
			</a>
		</div>
	</div>
	<button type="button" class="scroll-more">
		<div class="scroll-more__text">Scroll</div>
		<div class="scroll-more__line"></div>
	</button>
</section>




<?php ?>
