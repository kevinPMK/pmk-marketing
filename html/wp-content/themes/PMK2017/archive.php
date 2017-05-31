<?php

/*---------------------------------------------------------------
	ARCHIVE TEMPLATE
---------------------------------------------------------------*/

get_header();

?>


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

			<div class="blog__content">
				<div class="blog__copy">
					<h2>Oops, No Posts!</h2>
					<hr class="hr-gradient" />
					<p>It looks like there are no posts under this category. Apologies!</p>
				</div>
			</div>

			<?php
				endif;
			?>

		</div><!-- .slide__content -->
	</div><!-- .slide blog-overview -->
</main><!-- #main -->


<?php get_footer();
