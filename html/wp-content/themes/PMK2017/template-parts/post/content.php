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
$author_name = '';

if(!empty($post_author_id[0])){
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

?>


<div class="blog-heading-bar">
	<div class="inner">
		<?php if(!empty($post_author_id)) : ?>
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
		<?php endif; ?>
		<div class="blog-heading-bar__section">
			<div class="blog-heading-bar__info">
				<div class="blog-heading-bar__words-by">
					Posted On:
				</div>
				<div class="blog-heading-bar__name">
					<?php echo get_the_date(); ?>
				</div>
				<div class="blog-heading-bar__title">
					in
					<?php
						foreach((get_the_category()) as $category) {
							echo '<a href="' . get_category_link($category->cat_ID) . '">';
							echo $category->cat_name;
							echo '</a> ';
						}
					?>
				</div>
			</div>
		</div>
		<div class="blog-heading-bar__social-tower">
			<a class="blog-heading-bar__social-link">
				<?php echo pmk_get_svg( array( 'icon' => '32-facebook-mono', 'size' => '32' ) );?>
			</a>
			<a class="blog-heading-bar__social-link">
				<?php echo pmk_get_svg( array( 'icon' => '32-twitter-mono', 'size' => '32' ) );?>
			</a>
		</div>
	</div>
</div>

<div class="blog-single__content">
	<?php
		the_content();
	?>
</div>
