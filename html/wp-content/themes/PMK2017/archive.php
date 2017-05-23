<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>


<main id="main" class="site-main" role="main">
	<div class="slide blog-overview">
		<div class="slide__content">


			<?php
				if ( have_posts() ) :
			?>

			<?php get_template_part( 'template-parts/blog/blog-header', get_post_format() ); ?>
			<div class="blog-overview__deck">

			<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/blog/blog-card', get_post_format() );
					endwhile;
			?>

			</div> <!-- blog-overview__deck -->
			<?php get_template_part( 'template-parts/blog/blog-footer', get_post_format()); ?>

			<?php
				else :
			?>

				<!-- get_template_part( 'template-parts/post/blog-footer', 'none' ); -->

			<?php
				endif;
			?>

		</div><!-- .slide__content -->
	</div><!-- .slide blog-overview -->
</main><!-- #main -->


<?php get_footer();
