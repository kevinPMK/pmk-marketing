<?php

/*---------------------------------------------------------------
	FRONT PAGE TEMPLATE
---------------------------------------------------------------*/

get_header();

?>

	<main id="main" class="site-main" role="main">



		<section class="slide">
			<div class="slide__content">
				<div class="slide__copy">
					<h2>Stress Free Dismissal</h2>
					<hr class="hr-gradient" />
					<p>Phasellus vestibulum porttitor commodo. Praesent ante magna, mattis placerat augue faucibus, bibendum pellentesque eros. Sed feugiat, elit porta congue eleifend, nunc arcu congue felis, a finibus metus magna.</p>
				</div>
				<div class="slide__hero">
				</div>
			</div>
		</section>

		<section class="slide slide--center">
			<div class="slide__content">
				<div class="slide__copy">
					<h2>A Sophisticated and Secure Software Suite</h2>
					<hr class="hr-gradient" />
					<p>Etiam condimentum leo urna, a laoreet odio sodales ut. Morbi vel tellus at velit mattis ultricies et at dui. Morbi ex ligula, aliquam eu velit id, dictum gravida ipsum. Duis diam dolor, pellentesque vel fermentum sed, posuere eget lectus.</p>
				</div>
				<div class="slide__grid">
					<div class="slide__grid-cell slide__grid-cell--half">
						<div class="inner"></div>
					</div>
					<div class="slide__grid-cell slide__grid-cell--half">
						<div class="inner"></div>
					</div>
					<div class="slide__grid-cell slide__grid-cell--full">
						<div class="inner"></div>
					</div>
				</div>
			</div>
		</section>

		<section class="slide slide--blocks">
		</section>

		<section class="slide slide--quote">
			<div class="slide__content">
				<figure>
					<blockquote>
						PikMyKid is the greatest thing I’ve ever used. Whomever designed it deserves a giant briefcase of money.
					</blockquote>
					<hr />
					<footer>
						— <cite class="author">Kevin Mercier</cite>, <cite class="company">Superintendent of Hillsborough County</cite>
					</footer>
				</figure>
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
