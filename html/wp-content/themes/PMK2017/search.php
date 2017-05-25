<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<section class="slide slide-search-results">
        <div class="slide__content">
            <div class="slide__copy typography">

        <?php if(!empty(get_search_query())) :

                while ( have_posts() ) : the_post(); ?>

                <a class="search-result" href="<?php echo get_permalink(); ?>">
                    <h4>
                        <?php search_title_highlight(); ?>
                    </h4>
                    <?php search_excerpt_highlight(); ?>
                </a>

                <?php endwhile; ?>

                LOOKS LIKE THERE ARE NO <?php echo get_search_query(); ?>

        <?php else : ?>

            YOUR SEARCH IS EMPTY

        <?php endif; ?>

            </div>
        </div>
	</section>
</main>

<?php get_footer();
