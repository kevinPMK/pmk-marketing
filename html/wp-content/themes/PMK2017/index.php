<?php

/*---------------------------------------------------------------
	INDEX TEMPLATE
---------------------------------------------------------------*/

get_header();

?>


<main id="main" class="site-main" role="main">

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
