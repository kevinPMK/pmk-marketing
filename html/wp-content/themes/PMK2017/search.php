<?php

/*---------------------------------------------------------------
	SEARCH PAGE TEMPLATE
---------------------------------------------------------------*/

get_header(); 

?>

<main id="main" class="site-main" role="main">
	<section class="slide search-results">
        <div class="search-results__content typography">

        <?php if(!empty(get_search_query())) :

                if ( have_posts() ) :

                    while ( have_posts() ) : the_post();

                    $post_author_id = get_post_meta( get_the_ID(), 'custom_post_author' );
                    $author_name = 'PikMyKid';

                    if(!empty($post_author_id[0])){
                    	if($post_author_id[0] != 'default'){
                    		$author_post = get_post($post_author_id[0]);
                    		$author_name = $author_post->post_title;
                    	}
                    }

                    ?>

                    <div class="search-result">
                    <div class="search-result__content">
                        <h4>
                            <a href="<?php echo get_permalink(); ?>">
                                <?php search_title_highlight(); ?>
                            </a>
                        </h4>
                        <div class="search-result__meta">
                            <em>By:</em> <span><?php echo $author_name?></span> –
                            <span class="search-result__category">
                                <?php
                    				$i = 0;
                    				$sep = ', ';
                    				$cats = '';
                    				foreach ( ( get_the_category() ) as $category ) {
                    					if (0 < $i) $cats .= $sep;
                    					$cats .= $category->cat_name;
                    					$i++;
                    				}
                                    if(!empty($cats)){
                                        echo $cats;
                                    }else{
                                        echo "PikMyKid Foundation";
                                    }
                    			?>
                            </span>
                        </div>
                        <?php search_excerpt_highlight(); ?>
                    </div>
                </div>

                    <?php endwhile; ?>

                <div class="search-results__conclusion">
                    <div class="inner">Couldn't find what you were looking for?<a class="button">Contact Us</a>
                    </div>
                </div>



                <?php else : ?>

                    <div class="search-result">
                        <div class="search-result__content">
                            <h4>Uh oh! We couldn't find anything with "<?php echo get_search_query(); ?>". Perhaps try another term?</h4>
                            <p>Our robots tried their hardest. Feel free to try another search above.</p>
                        </div>
                    </div>
                    <div class="search-results__conclusion">
                        <div class="inner">Couldn't find what you were looking for?<a class="button">Contact Us</a>
                        </div>
                    </div>

                <?php endif; ?>

        <?php else : ?>

            <div class="search-result">
                <div class="search-result__content">
                    <h4>Oops! looks like you didn't search for anything. Let's give that another try.</h4>
                    <p>It's ok, sometimes we don't know what we're looking for (: Feel free to try another search above.</p>
                </div>
            </div>
            <div class="search-results__conclusion">
                <div class="inner">Couldn't find what you were looking for?<a class="button">Contact Us</a>
                </div>
            </div>

        <?php endif; ?>

        </div>
	</section>
</main>

<?php get_footer();
