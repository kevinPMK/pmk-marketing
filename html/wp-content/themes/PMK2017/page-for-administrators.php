<?php

/*---------------------------------------------------------------
	FEATURE OVERVIEW PAGE TEMPLATE
---------------------------------------------------------------*/

get_header();


$args = array(
	'post_parent' => $post->ID,
	'post_type' => 'page',
	'orderby' => 'menu_order'
);

$child_query = new WP_Query( $args );

?>

	<main id="main" class="site-main" role="main">

		<section class="slide slide-center">
			<div class="slide__content">
				<div class="slide__copy">
					<h2>Prrrnts</h2>
					<hr class="hr-gradient" />
					<p>Etiam condimentum leo urna, a laoreet odio sodales ut. Morbi vel tellus at velit mattis ultricies et at dui. Morbi ex ligula, aliquam eu velit id, dictum gravida ipsum. Duis diam dolor, pellentesque vel fermentum sed, posuere eget lectus.</p>
				</div>
			</div>
		</section>
	</main><!-- #main -->

<?php
	wp_reset_postdata();
	get_footer();
?>
