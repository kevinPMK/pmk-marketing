<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */


$post_author_id = get_post_meta( get_the_ID(), 'custom_post_author' );

$author_name = 'PikMyKid';
$author_description = 'PikMyKid is a school safety company that creates tools that empower teachers and parents to keep their kids safe during the school day. We have a mission to keep our K-12 kids safe and accounted for.';
$author_title = 'School Safety Company';
$author_thumb = '<img src="' . get_template_directory_uri() . '/src/images/company-author-logo.jpg">';

if(!empty($post_author_id[0])){
	if($post_author_id[0] != 'default'){
		$author_post= get_post($post_author_id[0]);
		$author_name = $author_post->post_title;
		$author_description = $author_post->post_content;
		$author_meta = get_post_meta( $post_author_id[0], 'staff_title' );
		if(!empty($author_meta)){
			$author_title = $author_meta[0];
		}
		if(has_post_thumbnail()){
			//TODO need to get a specific size
			$author_thumb = get_the_post_thumbnail($post_author_id[0]);
		}
	}
}

$current_category_id = get_the_category()[0]->cat_ID;

//Twitter Share Link
$ss_url = urlencode(get_permalink());
$ss_title = str_replace( ' ', '%20', get_the_title());

$twitterURL = 'https://twitter.com/intent/tweet?text='.$ss_title.'&amp;url='.$ss_url;

?>


<div class="blog-heading-bar">
	<div class="inner">
		<div class="blog-heading-bar__section">
			<div class="blog-heading-bar__thumb">
				<?php echo $author_thumb; ?>
			</div>
			<div class="blog-heading-bar__info">
				<div class="blog-heading-bar__words-by">
					Words By:
				</div>
				<a class="blog-heading-bar__name">
					<?php echo $author_name; ?>
				</a>
				<div class="blog-heading-bar__title">
					<?php echo $author_title; ?>
				</div>
			</div>
		</div>
		<div class="blog-heading-bar__section">
			<div class="blog-heading-bar__info">
				<div class="blog-heading-bar__words-by">
					Posted On:
				</div>
				<div class="blog-heading-bar__name">
					<?php echo get_the_date(); ?>
				</div>
				<div class="blog-heading-bar__title">
					<?php the_category(', '); ?>
				</div>
			</div>
		</div>
		<div class="blog-heading-bar__social-tower">
			<a id="shareBtn" title="Share on Facebook" class="blog-heading-bar__social-link">
				<?php echo pmk_get_svg( array( 'icon' => '32-facebook-mono', 'size' => '32' ) );?>
			</a>
			<a href="<?php echo $twitterURL; ?>" title="Share on Twitter" class="blog-heading-bar__social-link" target="_blank">
				<?php echo pmk_get_svg( array( 'icon' => '32-twitter-mono', 'size' => '32' ) );?>
			</a>
		</div>
	</div>
</div>

<div class="blog-single__content">
	<div class="blog-single__post typography">
		<?php
			the_content();
		?>
	</div>

	<div class="author-bio">
		<div class="author-bio__thumb">
			<?php echo $author_thumb; ?>
		</div>
		<div class="author-bio__content">
			<div class="author-bio__heading">
				<span class="author-bio__name"><?php echo $author_name; ?></span>
				<span class="author-bio__word-divide">&nbsp;-&nbsp;</span>
				<span class="author-bio__title"><?php echo $author_title; ?></span>
			</div>
			<p class="author-bio__description">
				<?php echo $author_description; ?>
			</p>
		</div>

	</div>

</div>


<?php


	$catquery = new WP_Query( 'cat=' . $current_category_id . '&posts_per_page=3' );
	if( ($catquery->have_posts())) :

	?>

	<div class="related-posts">
		<h6 class="related-posts_heading">Related Posts</h6>
			<div class="related-posts__grid">

	<?php while($catquery->have_posts()) : $catquery->the_post();

		$related_post_author_id = get_post_meta( get_the_ID(), 'custom_post_author' );

		if(!empty($related_post_author_id[0])){
			$related_author_post = get_post($related_post_author_id[0]);
			$related_author_name = $related_author_post->post_title;
		}

	?>

			<div class="related-posts__post">
				<a class="inner" href="<?php the_permalink(); ?>" rel="bookmark">
					<?php if(!empty($related_post_author_id)) : ?>
						<div class="related-posts__meta">
							By: <?php echo $related_author_name; ?>
						</div>
					<?php endif; ?>
					<h4>
						<?php the_title(); ?>
					</h4>
				</a>
			</div>

	<?php endwhile; ?>


		</div>
	</div>

<?php endif;
	$catquery->reset_postdata(); ?>
