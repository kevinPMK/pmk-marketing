<?php

	/*---------------------------------------------------------------
		POSTS PAGE HERO
	---------------------------------------------------------------*/

?>


<div class="blog-overview-hero" data-parallax="true" data-speed="0.1" data-direction="up">

	<?php
		$default_source = get_bloginfo('template_directory') . '/src/images/';
		$output = '';
		$output .= '<img class="wp-post-image" src="' . $default_source . 'default-sub-page-image.png"';
		$output .= 'srcset="';
		$output .= $default_source . 'default-sub-page-image--full.png 2000w, ';
		$output .= $default_source . 'default-sub-page-image--1024x614.png 1024w, ';
		$output .= $default_source . 'default-sub-page-image--768x461.png 768w, ';
		$output .= $default_source . 'default-sub-page-image--320x192.png 320w"';
		$output .= 'sizes="(max-width: 2000px) 100vw, 2000px"';
		$output .= '>';
		echo($output);

		$latest = new WP_Query( array( 'posts_per_page' => 1 ) );
		while( $latest->have_posts() ) : $latest->the_post();

		$post_author_id = get_post_meta( get_the_ID(), 'custom_post_author' );
		$author_name = '';

		if(!empty($post_author_id[0])){
			$author_post= get_post($post_author_id[0]);
			$author_name = $author_post->post_title;
		}

	?>
	<div class="blog-overview-hero__haze"></div>
	<div class="blog-overview-hero__gradient"></div>


	<div class="blog-overview-hero__content" data-parallax="true" data-speed="0.2" data-direction="up">






	<?php if(!empty($author_name)) : ?>
		<span class="blog-overview-hero__author">Words by: <span><?php echo $author_name; ?></span></span>
	<?php endif; ?>

		<h1 class="blog-overview-hero__heading">
			<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
		</h1>
		<?php if(has_excerpt()): ?>
			<p class="blog-overview-hero__excerpt">
				<?php echo get_the_excerpt(); ?>
			</p>
		<?php endif; ?>

	<?php endwhile; ?>

	</div>
</div>


<?php ?>
