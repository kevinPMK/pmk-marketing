<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<div class="slide slide-center slide-center--grad">
		<div class="slide__copy typography">
			<h2>404: Ooops!</h2>
			<hr class="hr-gradient">
			<p>
				Sorry, We could not find the page you were looking for. <br />We promise it was not on purpose. ):<br>
			</p>
			<a class="button button--primary" href="<?php echo get_home_url(); ?>">
				Go Home
			</a>
		</div>
	</div>
</main>

<?php get_footer();
