<?php

/*---------------------------------------------------------------
	BLOG CARD
---------------------------------------------------------------*/

$post_author_id = get_post_meta( get_the_ID(), 'custom_post_author' );
$author_name = 'PikMyKid';

if(!empty($post_author_id[0])){
	if($post_author_id[0] != 'default'){
		$author_post = get_post($post_author_id[0]);
		$author_name = $author_post->post_title;
	}
}

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
				<span class="blog-card__author-wrap">
					<span class="blog-card__author"><?php echo $author_name ?></span>
				</span> -
				<span class="blog-card__date-wrap"><?php echo get_the_date(); ?></span>
			</div>
			<h4 class="blog-card__heading"><?php the_title(); ?></h4>
		</div>
		<footer class="blog-card__footer">
			<?php
				$i = 0;
				$sep = ', ';
				$cats = '';
				foreach ( ( get_the_category() ) as $category ) {
					if (0 < $i) $cats .= $sep;
					$cats .= $category->cat_name;
					$i++;
				}
				echo $cats;
			?>
		</footer>
	</a>
</div>
