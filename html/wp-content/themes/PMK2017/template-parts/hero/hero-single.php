<?php

	/*---------------------------------------------------------------
		SINGLE PAGE HERO
	---------------------------------------------------------------*/

	if(is_single()){
		$heroClass = 'sub-page-hero sub-page-hero--large';
	}else{
		$heroClass = 'sub-page-hero';
	}

?>

<div class="<?php echo $heroClass; ?>" data-parallax="true" data-speed="0.1" data-direction="up">
	<?php the_post_thumbnail( 'pmk-featured-image' ); ?>
	<div class="sub-page-hero__haze"></div>
	<div class="sub-page-hero__gradient"></div>
	<div class="sub-page-hero__content" data-parallax="true" data-speed="0.2" data-direction="up">
		<?php if ( $post->post_parent ) : ?>
			<a class="sub-page-hero__parent-page-link" href="<?php echo get_permalink( $post->post_parent ); ?>">
				<?php echo pmk_get_svg( array( 'icon' => '24-leftcaret', 'size' => '24' ) );?>
				<?php echo get_the_title( $post->post_parent ); ?>
			</a>
		<?php endif; ?>
		<h1><?php the_title(); ?></h1>
		<?php if(has_excerpt()): ?>
		<p><?php echo get_the_excerpt(); ?></p>
		<?php endif; ?>
	</div>
</div>

<?php ?>
