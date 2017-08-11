<?php

/*---------------------------------------------------------------
	FEATURE OVERVIEW PAGE TEMPLATE
---------------------------------------------------------------*/

get_header();

?>

	<main id="main" class="site-main" role="main">

		<section class="slide slide-center">
			<div class="slide__content">

				<?php
				while ( have_posts() ) : the_post();

					the_content();

				endwhile; // End of the loop.
				?>

				<div class="feature-grid">

					<?php

						$args = array(
							'post_parent' => $post->ID,
							'post_type' => 'page',
							'orderby' => 'menu_order'
						);

						$child_query = new WP_Query( $args );

						while ( $child_query->have_posts() ) : $child_query->the_post();

						$currentPost = get_post_field( 'post_name', get_post() );
						$thumbUrl = '';
						$titleMeta = '';

						if($currentPost == 'for-parents'){
							$thumbUrl = '/src/images/feature-grid-ph-parents.jpg';
							$titleMeta = 'Peace of Mind';
						}else if($currentPost == 'for-teachers'){
							$thumbUrl = '/src/images/feature-grid-ph-teachers.jpg';
							$titleMeta = 'Top-notch Efficiencies';
						}else if($currentPost == 'for-administrators'){
							$thumbUrl = '/src/images/feature-grid-ph-admins.jpg';
							$titleMeta = 'Seamless Control';
						}else if($currentPost == 'for-districts'){
							$thumbUrl = '/src/images/feature-grid-ph-districts.jpg';
							$titleMeta = 'Transparency';
						}else{
							return;
						}

					?>

					<div class="feature-grid__block">
						<a href="<?php the_permalink(); ?>" class="inner" title="<?php the_title(); ?>">
							<amp-img class="feature-grid__img" layout="responsive" width="432" height="559" src="<?php echo get_template_directory_uri() . $thumbUrl; ?>"></amp-img>
							<div class="feature-grid__haze"></div>
							<div class="feature-grid__content">
								<span><?php echo $titleMeta; ?></span>
								<h3><?php the_title(); ?></h3>
							</div>
						</a>
					</div>

					<?php

						endwhile;
						wp_reset_query();

					?>

				</div>
			</div>
		</section>

	</main><!-- #main -->

<?php
	wp_reset_postdata();
	get_footer();
?>
