<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
global $wp_query;
$pages = $wp_query->max_num_pages;

?>


<main id="main" class="site-main" role="main">
	<div class="slide blog-overview">
		<div class="slide__content">

			<?php if($paged != 1) : ?>

			<div class="slide__copy">
				<div class="blog-overview__page-count">
					Page <?php echo $paged ?> / <?php echo $pages ?>
				</div>
				<h2>Blog Archives</h2>
				<hr class="hr-gradient" />
			</div>

			<?php endif; ?>

			<div class="blog-overview__deck">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

			?>

			<div class="blog-card">
				<div class="inner">
					<a class="blog-card__thumb" href="<?php echo get_permalink(); ?>">
						<div class="inner">
							<?php the_post_thumbnail(); ?>
						</div>
					</a>
					<a class="blog-card__content" href="<?php echo get_permalink(); ?>">
						<div class="blog-card__meta">
							By <span class="blog-card__author"><?php the_author(); ?></span>, <?php echo get_the_date(); ?>
						</div>
						<h4 class="blog-card__heading"><?php the_title(); ?></h4>
					</a>
					<footer class="blog-card__footer">
						<?php echo get_the_category_list(','); ?>
					</footer>
				</div>
			</div>

			<?php endwhile; ?>

		</div> <!-- blog-overview__deck -->
		<footer class="blog-overview__footer">
			<div class="paged-links">
				<?php posts_nav_link(' ','<svg class="icon icon-32-larrow icon--32" aria-hidden="true" role="img"> <use href="#svg-icon-32-larrow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-32-larrow"></use> </svg> Previous Page','Next Page <svg class="icon icon-32-rarrow icon--32" aria-hidden="true" role="img"> <use href="#svg-icon-32-rarrow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-32-rarrow"></use> </svg>'); ?>
			</div>
		</footer>

			<?php

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;

		?>

		</div>
	</div>

</main><!-- #main -->


<?php get_footer();
