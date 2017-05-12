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

			$post_author_id = get_post_meta( get_the_ID(), 'custom_post_author' );
			$author_name = '';

			if(!empty($post_author_id[0])){
				$author_post= get_post($post_author_id[0]);
				$author_name = $author_post->post_title;
			}


			/*--
			if(!empty($post_author_id[0])){
				$post_author = get_post($post_author_id[0]);
				echo($post_author->post_title);
			}
			--*/

			?>

			<div class="blog-card">
				<a class="inner" href="<?php echo get_permalink(); ?>">
					<div class="blog-card__thumb">
						<div class="inner">
							<?php the_post_thumbnail(); ?>
						</div>
					</div>
					<div class="blog-card__content">
						<div class="blog-card__meta">
							<?php if(!empty($author_name)) : ?>
								<span class="blog-card__author-wrap">
									<span class="blog-card__author"><?php echo $author_name ?></span>
								</span> -
							<?php endif; ?>
							<span class="blog-card__date-wrap"><?php echo get_the_date(); ?></span>
						</div>
						<h4 class="blog-card__heading"><?php the_title(); ?></h4>
					</div>
					<footer class="blog-card__footer">
						<?php
							foreach((get_the_category()) as $category) {
							    echo $category->cat_name . ' ';
							}
						?>
					</footer>
				</a>
			</div>

			<?php endwhile; ?>

		</div> <!-- blog-overview__deck -->
		<footer class="blog-overview__footer">
			<div class="paged-links">
				<?php posts_nav_link(' ','<svg class="icon icon-32-larrow icon--32" aria-hidden="true" role="img"> <use href="#svg-icon-32-larrow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-32-larrow"></use> </svg> Previous ','Next <svg class="icon icon-32-rarrow icon--32" aria-hidden="true" role="img"> <use href="#svg-icon-32-rarrow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-icon-32-rarrow"></use> </svg>'); ?>
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
