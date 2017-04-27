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
					<h2>Tools of the Trade</h2>
					<hr class="hr-gradient" />
					<p>Etiam condimentum leo urna, a laoreet odio sodales ut. Morbi vel tellus at velit mattis ultricies et at dui. Morbi ex ligula, aliquam eu velit id, dictum gravida ipsum. Duis diam dolor, pellentesque vel fermentum sed, posuere eget lectus.</p>
				</div>
				<div class="feature-grid">

					<?php

						while ( $child_query->have_posts() ) : $child_query->the_post();

						$currentPost = get_post_field( 'post_name', get_post() );
						$thumbUrl = '';
						$titleMeta = '';

						if($currentPost == 'for-parents'){
							$thumbUrl = '/src/images/feature-grid-ph-parents.jpg';
							$titleMeta = 'Ease of Mind';
						}else if($currentPost == 'for-teachers'){
							$thumbUrl = '/src/images/feature-grid-ph-teachers.jpg';
							$titleMeta = 'Utmost Efficiencies';
						}else if($currentPost == 'for-administrators'){
							$thumbUrl = '/src/images/feature-grid-ph-admins.jpg';
							$titleMeta = 'Seemless Control';
						}else if($currentPost == 'for-districts'){
							$thumbUrl = '/src/images/feature-grid-ph-districts.jpg';
							$titleMeta = 'Transparency';
						}else{
							return;
						}

					?>

					<div class="feature-grid__block">
						<a href="<?php the_permalink(); ?>" class="inner" title="<?php the_title(); ?>">
							<img src="<?php echo get_template_directory_uri() . $thumbUrl; ?>"/>
							<div class="feature-grid__haze"></div>
							<div class="feature-grid__content">
								<span><?php echo $titleMeta; ?></span>
								<h3><?php the_title(); ?></h3>
							</div>
						</a>
					</div>

					<?php

						endwhile;

					?>

				</div>
			</div>
		</section>
	</main><!-- #main -->

<?php
	wp_reset_postdata();
	get_footer();
?>
