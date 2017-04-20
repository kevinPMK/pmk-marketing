<?php

/*---------------------------------------------------------------
	FRONT PAGE TEMPLATE
---------------------------------------------------------------*/

get_header();

?>

	<main id="main" class="site-main" role="main">

		<section class="slide slide--full">
			<div class="slide__content">
				<div class="slide__hero">
				</div>
				<div class="slide__copy">
					<h2>Stress Free Dismissal</h2>
					<hr />
					<p>Phasellus vestibulum porttitor commodo. Praesent ante magna, mattis placerat augue faucibus, bibendum pellentesque eros. Sed feugiat, elit porta congue eleifend, nunc arcu congue felis, a finibus metus magna.</p>
				</div>
			</div>
		</section>

		<?php

		/*
		// Get each of our panels and show the post data.
		if ( 0 !== twentyseventeen_panel_count() || is_customize_preview() ) : // If we have pages to show.

			$num_sections = apply_filters( 'twentyseventeen_front_page_sections', 4 );
			global $twentyseventeencounter;

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$twentyseventeencounter = $i;
				twentyseventeen_front_page_section( null, $i );
			}

		endif; // The if ( 0 !== twentyseventeen_panel_count() ) ends here.
		*/

		?>

	</main><!-- #main -->

<?php get_footer();
