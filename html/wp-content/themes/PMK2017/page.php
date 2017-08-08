<?php

/*---------------------------------------------------------------
	PAGE TEMPLATE
---------------------------------------------------------------*/

get_header();

?>

<main id="main" class="site-main" role="main">

	<?php if(is_front_page()): ?>

		<section class="mobile-video-section">
			<a href="https://www.youtube.com/watch?v=0h1cmiiP6VM" class="watch-video-button mobile-video-section__button" href="#">
				Watch Video
			</a>
		</section>

	<?php endif; ?>


	<?php
	while ( have_posts() ) : the_post();

		the_content();

		// If comments are open or we have at least one comment, load up the comment template.
		// if ( comments_open() || get_comments_number() ) :
		//	 comments_template();
		// endif;

	endwhile; // End of the loop.
	?>



</main><!-- #main -->


<?php get_footer();
