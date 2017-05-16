<?php

	/*---------------------------------------------------------------
		HOME PAGE HERO
	---------------------------------------------------------------*/

?>


<section class="home-hero" data-parallax="true" data-speed="0.1" data-direction="up">
	<?php the_post_thumbnail( 'pmk-featured-image' ); ?>
	<div class="home-hero__haze"></div>
	<div class="home-hero__gradient"></div>
	<div class="home-hero__lightstreak"></div>
	<div class="home-hero__content" data-parallax="true" data-speed="0.2" data-direction="up">
		<h1 class="home-hero__heading"><span class="home-hero__sub-heading">Safe and Efficient</span> Student Dismissal</h1>
		<div class="cta-buttons">
			<a class="cta-button cta-button--secondary" type="button" href="#">
				Watch Video
				<?php echo pmk_get_svg( array( 'icon' => '32-play', 'size' => '32' ) );?>
			</a>
			<a class="cta-button cta-button--primary" type="button" href="#">
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
